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
$alertme="";
if(isset($_POST['alertme']) && $_POST['alertme']!=""){
    foreach($_POST['alertme'] as $key=>$value)
    {

        $alertme.=$_POST['alertme'][$key].",";
   }
}else{$alertme="";}

?>

<?php
$post = (!empty($_POST)) ? true : false;

if ($post) {

    if ($_POST['fname'] == "")
        $core->msgs['fname'] = _CF_FNAME_R;

    if ($_POST['lname'] == "")
        $core->msgs['lname'] = _CF_LNAME_R;

    if (!isset($_POST['alertme']))
        $core->msgs['alertme'] = 'please set "Alert me for"box ';

    if (!isset($_POST['alertvia']))
        $core->msgs['alertvia'] = 'please Enter "Alert me via"';

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
            'mobile' => sanitize($_POST['ph1']) . sanitize($_POST['ph2']) . sanitize($_POST['ph3']),
            'address' => sanitize($_POST['address']),
            'city' => sanitize($_POST['city']),
            'state' => sanitize($_POST['state']),
            'zipcode' => sanitize($_POST['zipcode']),
            'alertme'=>substr($alertme,0,strlen($alertme)-1),
            'alertvia'=> sanitize($_POST['alertvia']),
            'verification_code' =>sanitize($_POST['code']),
        );
        //print_r($data);
        $db->insert('get_alerts',$data);
        print 'OK';

       $hollysec->writeLog(_USER . ' ' . $user->username . ' ' . _LG_CONTACT_SENT, "", "no", "user");
        return;


        $sender_email = sanitize($_POST['email']);
        $name = sanitize($_POST['fname']) . sanitize($_POST['lname']);
        $phone = sanitize($_POST['mobile']);
        $message = strip_tags($_POST['message']);
        $mailsubject = "Contact Us Form";
        $ip = sanitize($_SERVER['REMOTE_ADDR']);

        require_once(HCODE . "lib/class_mailer.php");
        $mailer = $mail->sendMail();

        $row = $core->getRowById("email_templates", 29);

        $body = str_replace(array( '[SENDER]', '[NAME]', '[PHONE]', '[MAILSUBJECT]', '[IP]', '[SITE_NAME]', '[URL]'),
            array( $sender_email, $name, $phone, $mailsubject, $ip, $core->site_name, $core->site_url), $row['body'.$core->dblang]);

        $message = Swift_Message::newInstance()
            ->setSubject($row['subject'.$core->dblang])
            ->setTo(array($core->site_email => $core->site_name))
            ->setFrom(array($sender_email => $name))
            ->setBody(cleanOut($body), 'text/html');

        $success1 = $mailer->send($message);




        //second set of mails response

        $mailer = $mail->sendMail();

        $row = $core->getRowById("email_templates", 30);

        $body = str_replace(array( '[SENDER]', '[NAME]', '[PHONE]', '[MAILSUBJECT]', '[IP]', '[SITE_NAME]', '[URL]'),
            array( $sender_email, $name, $phone, $mailsubject, $ip, $core->site_name, $core->site_url), $row['body'.$core->dblang]);

        $getAlerts_settings =  $db->first("SELECT * FROM get_alerts_settings ");

        $message = Swift_Message::newInstance()
            ->setSubject($row['subject'.$core->dblang])
            ->setTo(array($sender_email => $name))
            ->setFrom(array($getAlerts_settings['from_email'] => $getAlerts_settings['from_name']))
            ->setBody(cleanOut($body), 'text/html');

        $message->addTo($getAlerts_settings['notification_copy_email'], 'Belmar');

        $success2 = $mailer->batchSend($message);

        if($success1 && $success2) {
            print 'OK';
            $hollysec->writeLog(_USER . ' ' . $user->username . ' ' . _LG_CONTACT_SENT, "", "no", "user");
        }

    } else
        print $core->msgStatus();
}
?>