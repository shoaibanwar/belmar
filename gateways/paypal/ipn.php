<?php
  /**
   * PayPal IPN
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: ipn.php,<?php echo  2010-08-10 21:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  
  
  if (isset($_POST['payment_status'])) {
      require_once("../../init.php");
	  
      /* only for debuggin purpose. Create logfile.txt and chmot to 0777
       ob_start();
       echo '<pre>';
       print_r($_POST);
       echo '</pre>';
       $logInfo = ob_get_contents();
       ob_end_clean();
       
       $file = fopen('logfile.txt', 'a');
       fwrite($file, $logInfo);
       fclose($file);
       */

      $req = 'cmd=_notify-validate';
      
      foreach ($_POST as $key => $value) {
          $value = urlencode(stripslashes($value));
          $req .= '&' . $key . '=' . $value;
      }
      $demo = getValue("demo", "gateways", "name = 'paypal'");
      $url = ($demo) ? 'www.paypal.com' : 'www.sandbox.paypal.com';
      
      $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
      $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
      $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
      $fp = fsockopen($url, 80, $errno, $errstr, 30);
      
      $payment_status = $_POST['payment_status'];
      $receiver_email = $_POST['business'];
      list($membership_id, $user_id) = explode("_", $_POST['item_number']);
      $mc_gross = $_POST['mc_gross'];
      $txn_id = $_POST['txn_id'];
      
      $getxn_id = $member->verifyTxnId($txn_id);
      $price = getValue("price", "memberships", "id = '" . (int)$membership_id . "'");
      $pp_email = getValue("extra", "gateways", "name = 'paypal'");
      
      if (!$fp) {
          echo $errstr . ' (' . $errno . ')';
      } else {
          fputs($fp, $header . $req);
          
          while (!feof($fp)) {
              $res = fgets($fp, 1024);
              
              if (strcmp($res, "VERIFIED") == 0) {
                  if (preg_match('/Completed/', $payment_status)) {
                      if ($receiver_email == $pp_email && $mc_gross == $price && $getxn_id == true) {
                          $sql = "SELECT * FROM memberships WHERE id='" . (int)$membership_id . "'";
                          $row = $db->first($sql);
						  
						  $username = getValue("username", "users", "id = " . (int)$user_id);
                          
                          $data = array(
								'txn_id' => $txn_id, 
								'membership_id' => $row['id'], 
								'user_id' => (int)$user_id, 
								'rate_amount' => (float)$mc_gross, 
								'ip' => $_SERVER['REMOTE_ADDR'], 
								'date' => "NOW()", 
								'pp' => "PayPal", 
								'currency' => $_POST['mc_currency'], 
								'status' => 1
						  );
                          
                          $db->insert("payments", $data);
                          
                          $udata = array(
								'membership_id' => $row['id'], 
								'mem_expire' => $user->calculateDays($row['id']), 
								'trial_used' => ($row['trial'] == 1) ? 1 : 0
						  );
                          
                          $db->update("users", $udata, "id='" . (int)$user_id . "'");

                          /* == Notify Administrator == */
                          require_once(HCODE . "lib/class_mailer.php");
                          $row2 = $core->getRowById("email_templates", 5);
                          
                          $body = str_replace(array('[USERNAME]', '[ITEMNAME]', '[PRICE]', '[STATUS]', '[PP]', '[IP]'), 
						  array($username, $row['title'.$core->dblang], $core->formatMoney($mc_gross), "Completed", "PayPal", $_SERVER['REMOTE_ADDR']), $row2['body'.$core->dblang]);
                          
                          $newbody = cleanOut($body);
                          
                          $mailer = $mail->sendMail();
                          $message = Swift_Message::newInstance()
								  ->setSubject($row2['subject'.$core->dblang])
								  ->setTo(array($core->site_email => $core->site_name))
								  ->setFrom(array($core->site_email => $core->site_name))
								  ->setBody($newbody, 'text/html');
                          
                          $mailer->send($message);
                          $hollysec->writeLog($username . ' ' . _LG_PAYMENT_OK . ' ' . $row['title'.$core->dblang], "", "yes", "payment");
                      }
					 
                  } else {
                      /* == Failed Transaction= = */
                      require_once(HCODE . "lib/class_mailer.php");
                      $row2 = $core->getRowById("email_templates", 6);
                      $itemname = getValue("title".$core->dblang, "memberships", "id = " . $membership_id);
                      
                      $body = str_replace(array('[USERNAME]', '[ITEMNAME]', '[PRICE]', '[STATUS]', '[PP]', '[IP]'), 
					  array($username, $itemname, $core->formatMoney($mc_gross), "Failed", "PayPal", $_SERVER['REMOTE_ADDR']), $row2['body'.$core->dblang]);
                      
                      $newbody = cleanOut($body);
                      
                      $mailer = $mail->sendMail();
                      $message = Swift_Message::newInstance()
							  ->setSubject($row2['subject'.$core->dblang])
							  ->setTo(array($core->site_email => $core->site_name))
							  ->setFrom(array($core->site_email => $core->site_name))
							  ->setBody($newbody, 'text/html');
                      
                      $mailer->send($message);
                      
                      $hollysec->writeLog(_LG_PAYMENT_ERR . $username, "", "yes", "payment");

                  }
				  
              }
          }
          fclose($fp);
      }
  }
?>