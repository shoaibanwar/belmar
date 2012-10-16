<?php

  /**
   * Captcha
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: captcha.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  //header("Content-type: image/jpeg");
  define("_VALID_PHP", true);
//  require_once("../init.php");

session_start();
  $text = rand(10000,99999); 
  $_SESSION['captchacode'] = $text; 
  $height = 25; 
  $width = 60; 
  $font_size = 14; 
  
  $im = imagecreate($width, $height); 
  $bg = imagecolorallocate($im, 245, 245, 245);
  $textcolor = imagecolorallocate($im, 0, 0, 0);
  imagestring($im, $font_size, 5, 5, $text, $textcolor); 
  
  header("Content-type: image/jpeg");
  imagejpeg($im, null, 80);
  imagedestroy($im);
?>