<?php
  /**
    *
   * @package HollyCode CMS
    *
   * @author HollyCode.com
   * @copyright 2011
   * @version $Id: 404.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("init.php");
?>
<?php include(THEMEDIR."/header.php");?>
<!-- Full Layout -->
<div id="main-col">
  <div class="wrap">
    <div class="main-col-inner">
      <h1><span><?php echo _ER_404;?></span></h1>
      <p class="info"><?php echo _ER_404_1;?></p>
    </div>
  </div>
</div>
<!-- Full Layout /--> 
<?php include(THEMEDIR."/footer.php");?>
