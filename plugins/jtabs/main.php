<?php
  /**
   * jQuery Tabs
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: main.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  require_once(HCODE . "admin/plugins/jtabs/admin_class.php");
  $tab = new jTabs();
  $tabrow = $tab->renderTabs();
  $count = count($tabrow);
?>
<!-- Start Tab Slider -->
<?php if($tabrow):?>
<div class="tab">
  <ul class="tabs">
    <?php foreach ($tabrow as $tbrow):?>
    <li><a href="#"> <?php echo $tbrow['title'.$core->dblang];?></a></li>
    <?php endforeach;?>
  </ul>
  <div class="tab_content">
    <?php foreach ($tabrow as $tbrow):?>
    <div class="tabs_tab"><?php echo cleanOut($tbrow['body'.$core->dblang]);?></div>
    <?php endforeach;?>
  </div>
</div>
<?php unset($tbrow);?>
<script type="text/javascript">
$(document).ready(function(){
	$('ul.tabs li:first-child a').addClass('current');
	$('div.tabs_tab:first-child').show();
	$('ul.tabs li a').click(function(e){
		$tab = jQuery(this).parent().parent().parent();
		$tab.find('ul.tabs').find('a').removeClass('current');
		jQuery(this).addClass('current');
		var $index = jQuery(this).parent().index();
		$tab.find('.tab_content').find('div.tabs_tab').not('div.tabs_tab:eq('+$index+')').slideUp();
		$tab.find('.tab_content').find('div.tabs_tab:eq('+$index+')').slideDown();
		e.preventDefault();
	})
});
</script>
<?php endif;?>
<!-- End Tab Slider /-->