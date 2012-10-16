<?php
  /**
   * Top Plugin Layout
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: top_plugins.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>	
  <?php $total = count($plugtop);?>
	<div class="topplugin-outer"<?php if ($total == 1) echo " style=\"padding:0\"";?>>
	  <?php foreach ($plugtop as $trow): ?>
	  <div class="topplugin-wrap<?php if($trow['alt_class'] !="") echo ' '.$trow['alt_class'];?>" <?php if ($total > 1) echo " style=\"width:".round(100/$total)."%;float:left;\"";?>>
		<div class="topplugin-inner<?php if($trow['alt_class'] !="") echo ' '.$trow['alt_class'];?>" <?php if ($total == 1) echo " style=\"padding:0;margin:0\"";?>>
		  <?php if ($trow['show_title'] == 1) echo "<h3>".$trow['title'.$core->dblang]."</h3>";?>
		  <?php if ($trow['body'.$core->dblang]) echo "<div class=\"plug-body\">".cleanOut($trow['body'.$core->dblang])."</div>";?>
          <?php if ($trow['jscode']) echo cleanOut($trow['jscode']);?>
		  <?php if ($trow['system'] == 1):?>
		  <?php $plugfile = PLUGDIR .$trow['plugalias']."/main.php";?>
		  <?php if(file_exists($plugfile)) include_once($plugfile);?>
		  <?php endif;?>
		</div>
	  </div>
	  <?php endforeach; ?>
	  <?php unset($trow);?>
	  <div class="clear"></div>
  </div>
