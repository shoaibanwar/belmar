<?php
  /**
   * Left Plugin Layout
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: left_plugins.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php if($content->getAccess()):?>
<?php foreach ($plugleft as $lrow): ?>
<div class="left-plug-wrap<?php if($lrow['alt_class'] !="") echo " ".$lrow['alt_class'];?>">
  <div class="left-plug-inner<?php if($lrow['alt_class'] !="") echo " ".$lrow['alt_class'];?>">
    <?php if ($lrow['show_title'] == 1) echo "<h3><span>".$lrow['title'.$core->dblang]."</span></h3>";?>
    <?php if ($lrow['body'.$core->dblang]) echo "<div class=\"plug-body\">".cleanOut($lrow['body'.$core->dblang])."</div>";?>
    <?php if ($lrow['jscode']) echo cleanOut($lrow['jscode']);?>
    <?php if ($lrow['system'] == 1):?>
    <?php $plugfile = PLUGDIR .$lrow['plugalias']."/main.php";?>
    <?php if(file_exists($plugfile)) include_once($plugfile);?>
    <?php endif;?>
  </div>
</div>
<?php endforeach; ?>
<?php endif;?>