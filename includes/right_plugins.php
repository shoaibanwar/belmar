<?php
  /**
   * Right Plugin Layout
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: right_plugins.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php if($content->getAccess()):?>
<?php foreach ($plugright as $rrow): ?>
<div class="right-plug-wrap<?php if($rrow['alt_class'] !="") echo " ".$rrow['alt_class'];?>">
  <div class="right-plug-inner<?php if($rrow['alt_class'] !="") echo " ".$rrow['alt_class'];?>">
    <?php if ($rrow['show_title'] == 1) echo "<h3><span>".$rrow['title'.$core->dblang]."</span></h3>";?>
    <?php if ($rrow['body'.$core->dblang]) echo "<div class=\"plug-body\">".cleanOut($rrow['body'.$core->dblang])."</div>";?>
    <?php if ($rrow['jscode']) echo cleanOut($rrow['jscode']);?>
    <?php if ($rrow['system'] == 1):?>
    <?php $plugfile = PLUGDIR .$rrow['plugalias']."/main.php";?>
    <?php if(file_exists($plugfile)) include_once($plugfile);?>
    <?php endif;?>
  </div>
</div>
<?php endforeach; ?>
<?php endif;?>