<?php
  /**
   * jQuery Slider
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: main.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  require_once(HCODE . "admin/plugins/jqueryslider/admin_class.php");
  $slider = new jQuerySlider();
  $slides = $slider->getSliderImages();
  $conf = $slider->getConfiguration();
?>
<!-- Start jQuery Slider -->
<?php if($slides == 0):?>
<div class="error">You don't have any images uploaded yet</div>
<?php else:?>
<div id="slider-wrapper">
  <div id="slider" class="nivoSlider">
    <?php foreach ($slides as $slrow):?>
    <a href="<?php echo $slrow['url']?>" <?php echo ($slrow['urltype'] == "ext") ? "target=\"_blank\"" : "target=\"_self\"";?>><img src="<?php echo SITEURL;?>/plugins/jqueryslider/slides/<?php echo $slrow['filename']?>" alt="" title="#htmlcaption<?php echo $slrow['id']?>" /></a>
    <?php endforeach;?>
  </div>
  <?php foreach ($slides as $slrow):?>
    <div id="htmlcaption<?php echo $slrow['id']?>" class="nivo-html-caption">
        <?php if($conf['showcaption']):?><h4 class="slider-title"><?php echo $slrow['title'.$core->dblang];?></h4><?php endif;?>
        <?php if($slrow['description'.$core->dblang]):?><p><?php echo $slrow['description'.$core->dblang]?></p><?php endif;?>
    </div>
  <?php endforeach;?>
</div>
<script type="text/javascript">
$(window).load(function() {
    $('#slider').nivoSlider({
        effect:'<?php echo $conf['animation'];?>', //Specify sets like: 'fold,fade,sliceDown,sliceUp,random'
        slices:15,
        animSpeed:<?php echo $conf['anispeed'];?>, //Slide transition speed
        pauseTime:<?php echo $conf['anitime'];?>,
        directionNav:<?php echo $conf['shownav'];?>, //Next & Prev
        directionNavHide:<?php echo $conf['shownavhide'];?>, //Only show on hover
        controlNav:<?php echo $conf['controllnav'];?>, //1,2,3...
        keyboardNav:true, //Use left & right arrows
        pauseOnHover:<?php echo $conf['hoverpause'];?>, //Stop animation while hovering
        captionOpacity:0.7 //Universal caption opacity
    });
});
</script>
<?php endif;?>
<!-- End jQuery Slider /-->