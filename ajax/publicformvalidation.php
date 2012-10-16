<?php

/**
 * public form validation
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
$reason="";
if(isset($_POST['reason']) && $_POST['reason']!=""){
foreach($_POST['reason'] as $key=>$value)
{
    $reason.=$_POST['reason'][$key].",";


}
}else{$reason="";}
?>
<?php
$post = (!empty($_POST)) ? true : false;

if ($post) {
   if ($reason== "")
       $core->msgs['reason'] =_Valid_Reason;
    if ($_POST['fname']== "")
        $core->msgs['fname'] =_Valid_fname;

    if ($_POST['lname'] == "")
        $core->msgs['lname'] =_Valid_lname;

    if ($_POST['emailid'] == "")
        $core->msgs['emailid'] =_Valid_email;

    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $_POST['emailid']))
        $core->msgs['emailid'] = _CF_EMAIL_ERR;

    if ($_POST['address'] == "")
        $core->msgs['address'] =_Valid_address;

    if ($_POST['city'] == "")
        $core->msgs['city'] =_Valid_city;
    if ($_POST['zip'] == "")
        $core->msgs['zip'] =_Valid_zipcode;


    if ($_POST['ph1'] == "" || $_POST['ph1']=="" || $_POST['ph3']== "")
            $core->msgs['ph1'] =_Valid_phone;

    if (isset($_POST['ph1']) && !empty($_POST['ph1']) &&  isset($_POST['ph2']) && !empty($_POST['ph2']) && isset($_POST['ph3']) && !empty($_POST['ph3']))
    {
        if(!preg_match("/^[0-9]{3}+$/",$_POST['ph1'])  && !preg_match("/^[0-9]{3}+$/",$_POST['ph2']) && !preg_match("/^[0-9]{4}+$/",$_POST['ph2'])  )
        $core->msgs['ph1'] = _Valid_format;

    }


    if (isset($_POST['mobile1']) && !empty($_POST['mobile1']) &&  isset($_POST['mobile2']) && !empty($_POST['mobile2']) && isset($_POST['mobile3']) && !empty($_POST['mobile3']))
    {
        if(!preg_match("/^[0-9]+$/",$_POST['mobile1'])  && !preg_match("/^[0-9]+$/",$_POST['mobile2']) && !preg_match("/^[0-9]+$/",$_POST['mobile3'])  )
            $core->msgs['mobile1'] = _Valid_format_Mobile;
    }

    if($_SESSION['captchacode'] !=$_POST['code'])
    {
        $core->msgs['code'] ="not code verification";

    }
    if (empty($core->msgs))
    {

        $data = array(
            'reason'=>substr($reason,0,strlen($reason)-1),
            'other'=>sanitize($_POST['other']),

            'fname' =>sanitize($_POST['fname']),
            'lname' =>sanitize($_POST['lname']),
            'email'=>sanitize($_POST['emailid']),
            'address'=>sanitize($_POST['address']),
            'city' =>sanitize($_POST['city']),
            'state' =>sanitize($_POST['state']),
            'zip_code' =>sanitize($_POST['zip']),
            'telephone' =>sanitize($_POST['ph1']."-".$_POST['ph2']."-".$_POST['ph3']),
            'mobile' =>sanitize($_POST['mobile1']."-".$_POST['mobile2']."-".$_POST['mobile3']),
            'location' =>sanitize($_POST['location']),
            'message' =>sanitize($_POST['comments']),
            'verification_code' =>sanitize($_POST['code']),
        );

         $db->insert("publicworks", $data);
               print 'OK';
         $message =_Public_Works_ADDED;
        $hollysec->writeLog($message, "", "no", "publicworks");

        return;


        $sender_email = sanitize($_POST['emailid']);
        $name = sanitize($_POST['fname']) . sanitize($_POST['lname']);
        $mailsubject = "Public Works Form";
        $ip = sanitize($_SERVER['REMOTE_ADDR']);

        require_once(HCODE . "lib/class_mailer.php");
        $mailer = $mail->sendMail();

        $row = $core->getRowById("email_templates", 32);

        $body = str_replace(array('[MESSAGE]', '[SENDER]', '[NAME]', '[PHONE]', '[MAILSUBJECT]', '[IP]', '[SITE_NAME]', '[URL]'),
            array($message, $sender_email, $name, $phone, $mailsubject, $ip, $core->site_name, $core->site_url), $row['body'.$core->dblang]);


        $message = Swift_Message::newInstance()
            ->setSubject($row['subject'.$core->dblang])
            ->setTo(array($core->site_email => $core->site_name))
            ->setFrom(array($sender_email => $name))
            ->setBody(cleanOut($body), 'text/html');

        $mailSent = $mailer->send($message);


        if($mailSent) {
            print 'OK';
            $hollysec->writeLog(_USER . ' ' . $user->username . ' ' . _LG_CONTACT_SENT, "", "no", "user");
        }
    }
    else
    {
        print $core->msgStatus();
    }


}
?>