<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HollyCode2
 * Date: 7/2/12
 * Time: 12:21 PM
 * To change this template use File | Settings | File Templates.
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

      if (empty($core->msgs)) {

          //save to db
          $data = array(
              'fname' => sanitize($_POST['fname']),
              'lname' => sanitize($_POST['lname']),
              'email' => sanitize($_POST['email']),
          );
          $db->insert('mailing_list',$data);
          print 'OK';
          $hollysec->writeLog(_USER . ' ' . $user->username . ' ' . _LG_NEWSLETTER_SENT, "", "no", "user");

          return;


          $sender_email = sanitize($_POST['email']);
          $name = sanitize($_POST['fname']) . sanitize($_POST['lname']);
          $mailsubject = "Newsletter Form";
          $ip = sanitize($_SERVER['REMOTE_ADDR']);

          require_once(HCODE . "lib/class_mailer.php");
          $mailer = $mail->sendMail();

          $row = $core->getRowById("email_templates", 25);

          $body = str_replace(array('[MESSAGE]', '[SENDER]', '[NAME]', '[PHONE]', '[MAILSUBJECT]', '[IP]', '[SITE_NAME]', '[URL]'),
              array($message, $sender_email, $name, $phone, $mailsubject, $ip, $core->site_name, $core->site_url), $row['body'.$core->dblang]);


          $mailing_list_settings =  $db->first("SELECT * FROM mailing_list_settings ");

          $message = Swift_Message::newInstance()
              ->setSubject($row['subject'.$core->dblang])
              ->setTo(array($sender_email => $name))
              ->setFrom(array($mailing_list_settings['from_email'] => $mailing_list_settings['from_name']))
              ->setBody(cleanOut($body), 'text/html');

          $message->addTo($mailing_list_settings['notification_copy_email'], 'belmar');

          $mailSent = $mailer->batchSend($message);


          if($mailSent) {
              print 'OK';
              $hollysec->writeLog(_USER . ' ' . $user->username . ' ' . _LG_CONTACT_SENT, "", "no", "user");
          }

      } else
          print $core->msgStatus();
  }
?>