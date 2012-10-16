<?php
  /**
   * Content Slider
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: main.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  require_once(HCODE . "admin/plugins/contentslider/admin_class.php");
  $cslider = new ContentSlider();
  $csliderdata = $cslider->getSliderImages();
?>
<!-- Start Content Slider -->
<?php if($csliderdata == 0):?>
<div class="msgError">You don't have any slides yet</div>
<?php else:?>
<div id="content-slider-wrapper">
<div id="content-slider">
  <?php foreach ($csliderdata as $slrow):?>
  <?php $image = ($slrow['filename']) ? 'background-image:url('.SITEURL.'/plugins/contentslider/slides/'.$slrow['filename'].');': '';?>
  <div id="slide-list<?php echo $slrow['id']?>" class="slide-data" style="<?php echo $image;?>width:100%"> 
  <div class="slider-content">
    <div class="slider-body" style="float:<?php echo ($slrow['align']) ? 'right' : 'left';?>">
    <h1><?php echo $slrow['title'.$core->dblang]?></h1>
    <?php echo cleanOut($slrow['description'.$core->dblang])?>
    </div>
    </div>
    </div>
  <?php endforeach;?>
  <?php unset($slrow);?>
</div>
<div class="content-slide-pager"> <a href="#" id="slide-Prev">&lsaquo;</a> <a href="#" id="slide-Next">&rsaquo;</a> </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        if ($('#content-slider').length > 0) {
            $('#content-slider').cycle({
                fx: 'fade',
                speed: 300,
                randomizeEffects: true,
                timeout: 6000,
                cleartype: true,
                cleartypeNoBg: true,
				pause: true,
                next: '#slide-Next',
                prev: '#slide-Prev'
            });
        }
    });
</script>
<?php endif;?>
<!-- End Content Slider /-->