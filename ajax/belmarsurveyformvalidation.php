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
$post = (!empty($_POST)) ? true : false;

if ($post) {

    if ($_POST['fname']== "")
        $core->msgs['fname'] =_Valid_fname;

    if ($_POST['lname'] == "")
        $core->msgs['lname'] =_Valid_lname;

    if ($_POST['emailid'] == "")
        $core->msgs['emailid'] =_Valid_email;

    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $_POST['emailid']))
        $core->msgs['emailid'] = _CF_EMAIL_ERR;


    if ($_POST['department'] == "")
        $core->msgs['department'] =_Valid_department;
    if($_SESSION['captchacode'] !=$_POST['code'])
    {
        $core->msgs['code'] ="not code verification";

    }
    if (empty($core->msgs)) {

        $data = array(

            'fname' =>sanitize($_POST['fname']),
            'lname' =>sanitize($_POST['lname']),
            'email'=>sanitize($_POST['emailid']),
            'dept_id'=>sanitize($_POST['department']),
            'experience' =>sanitize($_POST['experience']),
            'staff' =>sanitize($_POST['staff']),
            'questions' =>sanitize($_POST['questions']),
            'comments' =>sanitize($_POST['comments']),
            'verification_code' =>sanitize($_POST['code']),

        );

        $db->insert("belmarsurvey", $data);
        print 'OK';
        $message =_Belmar_Survay_ADDED;
        $hollysec->writeLog($message, "", "no", "belmarsurvey");


        $sender_email = sanitize($_POST['emailid']);
        $name = sanitize($_POST['fname']) . sanitize($_POST['lname']);
        $mailsubject = "Belmar Survey";
        $ip = sanitize($_SERVER['REMOTE_ADDR']);

        require_once(HCODE . "lib/class_mailer.php");
        $mailer = $mail->sendMail();

        $row = $core->getRowById("email_templates", 28);

        $body = str_replace(array('[EXPERIENCE]', '[STAFF]' , '[COMMENTS]', '[NAME]', '[QUESTIONS]', '[MAILSUBJECT]', '[IP]', '[SITE_NAME]', '[URL]'),
            array($data['experience'],$data['staff'],$data['comments'], $data['fname'].' '.$data['lname'],$data['questions'], $mailsubject, $ip, $core->site_name, $core->site_url), $row['body'.$core->dblang]);


        //first set of emails.. the survey request
        $message = Swift_Message::newInstance()
            ->setSubject($row['subject'.$core->dblang])
            ->setTo(array($core->site_email => $core->site_name))
            ->setFrom(array($data['email'] => $data['fname']))
            ->setBody(cleanOut($body), 'text/html');

        if($_POST['department'] !=0)
        {
            $dep_id = intval($_POST['department']);
            $department = $db->first("SELECT dep_name as name,dep_email_address as email FROM departments WHERE id=$dep_id");
            if($department)
                $message->addTo($department['email'], $department['name']);
        }
        $mailSent1 = $mailer->batchSend($message);



        //second set of emails.. response
        $mailer = $mail->sendMail();

        $row = $core->getRowById("email_templates", 26);

        $body = str_replace(array('[SENDER]','[NAME]', '[MAILSUBJECT]', '[IP]', '[SITE_NAME]', '[URL]'),
            array($sender_email, $name, $mailsubject, $ip, $core->site_name, $core->site_url), $row['body'.$core->dblang]);

        $survey_settings =  $db->first("SELECT * FROM survey_settings ");

        $message = Swift_Message::newInstance()
            ->setSubject($row['subject'.$core->dblang])
            ->setTo(array($sender_email => $name))
            ->setFrom(array($survey_settings['from_email'] => $survey_settings['from_name']))
            ->setBody(cleanOut($body), 'text/html');


        $message->addTo($survey_settings['notification_copy_email'], 'belmar');

        $mailSent2 = $mailer->batchSend($message);


        if($mailSent1 && $mailSent2) {
            print 'OK';
            $hollysec->writeLog(_USER . ' ' . $user->username . ' ' . _LG_CONTACT_SENT, "", "no", "user");
        }



    } else{
        print $core->msgStatus();
    }


}
?>