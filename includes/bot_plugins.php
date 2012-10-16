<?php
  /**
   * Bottom Plugin Layout
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: bot_plugins.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>	  
  <?php $total = count($plugbot);?>
  <div id="botplugin">
    <div class="wrap">
      <div class="botplugin-outer">
        <?php foreach ($plugbot as $brow): ?>
        <div class="botplugin-wrap<?php if($brow['alt_class'] !="") echo ' '.$brow['alt_class'];?>" <?php if($total > 1) echo " style=\"width:".round(100/$total)."%;float:left;\"";?>>
          <div class="botplugin-inner<?php if($brow['alt_class'] !="") echo ' '.$brow['alt_class'];?>">
            <?php if ($brow['show_title'] == 1) echo "<h3>".$brow['title'.$core->dblang]."</h3>";?>
            <?php if ($brow['body'.$core->dblang]) echo "<div class=\"plug-body\">".cleanOut($brow['body'.$core->dblang])."</div>";?>
            <?php if ($brow['jscode']) echo cleanOut($brow['jscode']);?>
            <?php if ($brow['system'] == 1):?>
            <?php $plugfile = PLUGDIR .$brow['plugalias']."/main.php";?>
            <?php if(file_exists($plugfile)) include_once($plugfile);?>
            <?php endif;?>
          </div>
        </div>
        <?php endforeach; ?>
        <?php unset($brow);?>
        <div class="clear"></div>
      </div>
    </div>
  </div>