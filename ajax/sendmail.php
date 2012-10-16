<?php
  /**
   * Send Mail
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: sendmail.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("../init.php");
?>
<?php
  $post = (!empty($_POST)) ? true : false;

  if ($post) {
      if ($_POST['fname'] == "")
          $core->msgs['fname'] = _CF_FNAME_R;

      if ($_POST['lname'] == "")
          $core->msgs['lname'] = _CF_LNAME_R;

      if ($_POST['code'] == "")
          $core->msgs['code'] = _CF_TOTAL_R;

	  if ($_SESSION['captchacode'] != $_POST['code'])
          $core->msgs['code'] = _CF_TOTAL_ERR;

      if ($_POST['email'] == "")
          $core->msgs['email'] = _CF_EMAIL_R;

      if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $_POST['email']))
          $core->msgs['email'] = _CF_EMAIL_ERR;

      if ($_POST['message'] == "")
          $core->msgs['message'] = _CF_MSG_R;

      if (empty($core->msgs)) {

          //save to db
           $data = array(
               'fname' => sanitize($_POST['fname']),
               'lname' => sanitize($_POST['lname']),
               'dep_id' => sanitize($_POST['department']),
               'email' => sanitize($_POST['email']),
               'date_of_birth' => sanitize($_POST['year']) .'-'. sanitize($_POST['month']) .'-'. sanitize($_POST['day']) ,
               'address' => sanitize($_POST['address']),
               'city' => sanitize($_POST['city']),
               'state' => sanitize($_POST['state']),
               'zipcode' => sanitize($_POST['zipcode']),
               'phone' => sanitize($_POST['ph1']) . sanitize($_POST['ph2']) . sanitize($_POST['ph3']),
               'fax' => sanitize($_POST['fx1']) . sanitize($_POST['fx2']) . sanitize($_POST['fx3']),
               'message' => sanitize($_POST['message']),
           );
          $db->insert('contact',$data);
          print 'OK';
          $hollysec->writeLog(_USER . ' ' . $user->username . ' ' . _LG_CONTACT_SENT, "", "no", "user");
          return;


          $sender_email = sanitize($_POST['email']);
          $name = sanitize($_POST['fname']) . sanitize($_POST['lname']);
		  $phone = sanitize($_POST['phone']);
          $message = strip_tags($_POST['message']);
		  $mailsubject = "Contact Us Form";
		  $ip = sanitize($_SERVER['REMOTE_ADDR']);

		  require_once(HCODE . "lib/class_mailer.php");
		  $mailer = $mail->sendMail();	
					  
		  $row = $core->getRowById("email_templates", 10);
		  
		  $body = str_replace(array('[MESSAGE]', '[SENDER]', '[NAME]', '[PHONE]', '[MAILSUBJECT]', '[IP]', '[SITE_NAME]', '[URL]'), 
		  array($message, $sender_email, $name, $phone, $mailsubject, $ip, $core->site_name, $core->site_url), $row['body'.$core->dblang]);


          //first set of emails.. the contact request
		  $message = Swift_Message::newInstance()
					->setSubject($row['subject'.$core->dblang])
					->setTo(array($core->site_email => $core->site_name))
					->setFrom(array($sender_email => $name))
					->setBody(cleanOut($body), 'text/html');

          if($_POST['dep_id'] !=0)
          {
              $dep_id = intval($_POST['dep_id']);
              $department = $db->first("SELECT dep_name as name,dep_email_address as email FROM departments WHERE id=$dep_id");
              if($department)
                $message->addTo($department['email'], $department['name']);
          }
          $mailSent1 = $mailer->send($message);



          //second set of emails.. response
          $mailer = $mail->sendMail();

          $row = $core->getRowById("email_templates", 24);

          $body = str_replace(array('[MESSAGE]', '[SENDER]', '[NAME]', '[PHONE]', '[MAILSUBJECT]', '[IP]', '[SITE_NAME]', '[URL]'),
              array($message, $sender_email, $name, $phone, $mailsubject, $ip, $core->site_name, $core->site_url), $row['body'.$core->dblang]);

          $message = Swift_Message::newInstance()
					->setSubject($row['subject'.$core->dblang])
					->setTo(array($sender_email => $name))
					->setFrom(array($contact_form_settings['from_email'] => $contact_form_settings['from_name']))
					->setBody(cleanOut($body), 'text/html');

          $contact_form_settings =  $db->first("SELECT * FROM contact_form_settings ");
          $message->addTo($contact_form_settings['notification_copy_email'], 'belmar');

          $mailSent2 = $mailer->batchSend($message);


          if($mailSent1 && $mailSent2) {
			  print 'OK';
			  $hollysec->writeLog(_USER . ' ' . $user->username . ' ' . _LG_CONTACT_SENT, "", "no", "user");
		  }
		  
      } else
          print $core->msgStatus();
  }
?>