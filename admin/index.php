<?php
  /**
   * Index
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: index.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);

  if (is_dir("../setup"))
      : die("<div style='text-align:center'>" 
		  . "<span style='padding: 5px; border: 1px solid #999; background-color:#EFEFEF;" 
		  . "font-family: Verdana; font-size: 11px; margin-left:auto; margin-right:auto'>" 
		  . "<b>Warning:</b> Please delete setup directory!</span></div>");
  endif;
    
  require_once("init.php");
  if (!$user->is_Admin())
      redirect_to("login.php");
?>
<?php include("header.php");?>
  <!-- Start Content-->
  <div class="wrap">
  <span id="loader" style="display:none"></span>
  <div id="msgholder"></div>
  <?php ($core->do && file_exists($core->do.".php")) ? include($core->do.".php") : include("main.php");?>
  </div>
  <!-- End Content/-->
<?php include("footer.php");?>