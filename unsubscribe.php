<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HollyCode2
 * Date: 7/4/12
 * Time: 2:32 PM
 * To change this template use File | Settings | File Templates.
 */
define("_VALID_PHP", true);
require_once("init.php");

if (!defined("_VALID_PHP"))
    die('Direct access to this location is not allowed.');

include(THEMEDIR ."/header.php");


if(!isset($_GET['sid']) || !isset($_GET['st']) || !isset($_GET['list']))
    die('Error!');

if(empty($_GET['sid']) || empty($_GET['st']) || empty($_GET['list']))
    die('Error!');

$id = $_GET['sid'];
$t = $_GET['st'];

if($_GET['list']=="news")
    $table = "mailing_list";

else if($_GET['list']=="alerts")
    $table = "get_alerts";
else
    die("Error");

$user = $db->first("SELECT email FROM $table WHERE id = $id");
if(substr(md5($user['email']),0,8) != $t)
    die("Error!");

$succes = $db->delete($table,"id=$id");
if($succes)
    echo "You have been successfully unsubscribed from this mailing list!";
else
    echo "Error.Please try again!";


include(THEMEDIR ."/footer.php");