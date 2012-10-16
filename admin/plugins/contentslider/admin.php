<?php
  /**
   * Content Slider
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: admin.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  if(!$user->getAcl("contentslider")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
  
  require_once("lang/" . $core->language . ".lang.php");
  require_once("admin_class.php");
  
  $slider = new ContentSlider();
?>
<?php switch($core->paction): case "edit": ?>
<?php $slrow = $core->getRowById("plug_content_slider", $slider->sliderid);?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo PLG_CS_TITLE;?></h1>
<p class="info"><?php echo PLG_CS_INFO3;?></p>
<h2><?php echo PLG_CS_TITLE.' '.PLG_CS_UPDATE;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
<table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo PLG_CS_CAPTION;?>: <?php echo required();?></td>
      <td><input type="text" name="title<?php echo $core->dblang;?>" class="inputbox" value="<?php echo $slrow['title'.$core->dblang];?>"  size="55"/></td>
    </tr>
    <tr>
      <td><?php echo PLG_CS_DESC;?>:</td>
      <td class="editor"><textarea id="bodycontent" name="description<?php echo $core->dblang;?>" rows="4" cols="30"><?php echo $core->out_url($slrow['description'.$core->dblang]);?></textarea>
      <?php loadEditor("bodycontent"); ?></td>
    </tr>
    <tr>
      <td><?php echo PLG_CS_ALIGN_T;?>:</td>
      <td><span class="input-out">
        <label for="align-1"><?php echo PLG_CS_LEFT;?></label>
        <input name="align" type="radio" id="align-1"  value="0" <?php getChecked($slrow['align'], 0); ?> />
        <label for="align-2"><?php echo PLG_CS_RIGHT;?></label>
      <input name="align" type="radio" id="align-2" value="1" <?php getChecked($slrow['align'], 1); ?> /></span></td>
    </tr>
    <tr>
      <td><?php echo PLG_CS_IMG_SEL;?>:</td>
      <td><input name="filename" type="file" class="fileinput mask" size="45" /><span style="margin-left:80px"><?php echo tooltip(PLG_CS_IMG_SEL_T);?></span></td>
    </tr>
    <tr>
      <td><input name="updateimage" type="submit" value="<?php echo PLG_CS_UPDATE;?>" class="button" /></td>
      <td><a href="index.php?do=plugins&amp;action=config&amp;plug=contentslider" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
  <input name="sliderid" type="hidden" value="<?php echo $slider->sliderid;?>" />
</form>
<script type="text/javascript"> 
// <![CDATA[
  $(".mask").filestyle({ 
	  image: "images/file-button.png",
	  imageheight : 29,
	  imagewidth : 75,
	  width : 230
  });
// ]]>
</script>
<?php echo $core->doForm("processSliderImage","plugins/contentslider/controller.php");?>
<?php break;?>
<?php case"add": ?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo PLG_CS_TITLE;?></h1>
<p class="info"><?php echo PLG_CS_INFO3;?></p>
<h2><?php echo PLG_CS_TITLE.' '.PLG_CS_IMGUPLOAD;?></h2>
<form action="" method="post" id="admin_form" name="admin_form" enctype="multipart/form-data">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo PLG_CS_CAPTION;?>: <?php echo required();?></td>
      <td><input type="text" name="title<?php echo $core->dblang;?>" class="inputbox" title="<?php echo PLG_CS_CAPTION_R;?>" size="55"/></td>
    </tr>
    <tr>
      <td><?php echo PLG_CS_DESC;?>:</td>
      <td class="editor"><textarea id="bodycontent" name="description<?php echo $core->dblang;?>" cols="50" rows="6"></textarea>
      <?php loadEditor("bodycontent"); ?></td>
    </tr>
    <tr>
      <td><?php echo PLG_CS_ALIGN_T;?>:</td>
      <td><span class="input-out">
        <label for="align-1"><?php echo PLG_CS_LEFT;?></label>
        <input name="align" type="radio" id="align-1"  value="0" checked="checked" />
        <label for="align-2"><?php echo PLG_CS_RIGHT;?></label>
      <input name="align" type="radio" id="align-2" value="1"  /></span></td>
    </tr>
    <tr>
      <td><?php echo PLG_CS_IMG_SEL;?>:</td>
      <td><input name="filename" type="file" class="fileinput mask" size="45" /><span style="margin-left:80px"><?php echo tooltip(PLG_CS_IMG_SEL_T);?></span></td>
    </tr>
    <tr>
      <td><input name="addimage" type="submit" value="<?php echo PLG_CS_IMGUPLOAD;?>" class="button" /></td>
      <td><a href="index.php?do=plugins&amp;action=config&amp;plug=contentslider" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
</form>
<?php echo $core->doForm("processSliderImage","plugins/contentslider/controller.php");?>
<script type="text/javascript"> 
// <![CDATA[
  $(".mask").filestyle({ 
	  image: "images/file-button.png",
	  imageheight : 29,
	  imagewidth : 75,
	  width : 230
  });
// ]]>
</script>
<?php break;?>
<?php default: ?>
<?php $getimgs = $slider->getSliderImages();?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo PLG_CS_TITLE;?></h1>
<p class="info"><?php echo PLG_CS_INFO3 . PLG_CS_INFO3_1;?></p>
<h2><span><a href="index.php?do=plugins&amp;action=config&amp;plug=contentslider&amp;plug_action=add" class="button-sml"><?php echo PLG_CS_IMGUPLOAD;?></a> </span><?php echo PLG_CS_SUBTITLE3 . $content->getPluginName(get("plug"));?></h2>
<table cellpadding="0" cellspacing="0" class="display" id="pagetable">
  <thead>
    <tr>
      <th width="15">#</th>
      <th class="left"><?php echo PLG_CS_CAPTION;?></th>
      <th><?php echo PLG_CS_POS;?></th>
      <th><?php echo PLG_CS_VIEW;?></th>
      <th><?php echo PLG_CS_EDIT;?></th>
      <th><?php echo PLG_CS_DEL;?></th>
    </tr>
  </thead>
  <tbody>
    <?php if($getimgs == 0):?>
    <tr style="background-color:transparent">
      <td colspan="6"><?php echo $core->msgAlert(PLG_CS_NOIMG,false);?></td>
    </tr>
    <?php else:?>
    <?php foreach ($getimgs as $slrow):?>
    <tr id="node-<?php echo $slrow['id'];?>">
      <td align="center" class="id-handle"><?php echo $slrow['id'];?>.</td>
      <td><?php echo $slrow['title'.$core->dblang];?></td>
      <td align="center"><?php echo $slrow['position'];?></td>
      <td align="center"><?php if($slrow['filename']):?><a href="<?php echo SITEURL;?>/plugins/contentslider/slides/<?php echo $slrow['filename'];?>" class="pirobox" rel="single" title="<?php echo $slrow['title'.$core->dblang];?>"><img src="images/view.png" class="tooltip"  alt="" title="<?php echo PLG_CS_VIEW;?>"/></a><?php endif;?></td>
      <td align="center"><a href="index.php?do=plugins&amp;action=config&amp;plug=contentslider&amp;plug_action=edit&amp;sliderid=<?php echo $slrow['id'];?>"><img src="images/edit.png" class="tooltip"  alt="" title="<?php echo PLG_CS_EDIT.': '.$slrow['title'.$core->dblang];?>"/></a></td>
      <td align="center"><a href="javascript:void(0);" class="delete" rel="<?php echo $slrow['title'.$core->dblang];?>" id="item_<?php echo $slrow['id'].':'.$slrow['filename'];?>"><img src="images/delete.png" alt="" class="tooltip" title="<?php echo PLG_CS_DEL.': '.$slrow['title'.$core->dblang];?>" /></a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($slrow);?>
    <tr style="background-color:transparent">
      <td colspan="6"><a href="javascript:void(0);" id="serialize" class="button-sml"><?php echo PLG_CS_SAVE_POS;?></a></td>
    </tr>
    <?php endif;?>
  </tbody>
</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '.PLG_CS_SLIDE;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>
<script type="text/javascript"> 
// <![CDATA[
var tableHelper = function (e, tr) {
    tr.children().each(function () {
        $(this).width($(this).width());
    });
    return tr;
};
$(document).ready(function () {
    $("#pagetable tbody").sortable({
        helper: tableHelper,
        handle: '.id-handle',
        opacity: .6
    }).disableSelection();

    $('#serialize').click(function () {
        serialized = $("#pagetable tbody").sortable('serialize');
        $.ajax({
            type: "POST",
            url: "plugins/contentslider/controller.php?sortslides",
            data: serialized,
            success: function (msg) {
                $("#msgholder").html(msg);
            }
        });
    })
	
    $('a.delete').live('click', function () {
        var id = $(this).attr('id').replace('item_', '')
        var parent = $(this).parent().parent();
		var title = $(this).attr('rel');
        $("#dialog-confirm").data({
            'delid': id,
            'parent': parent,
			'title': title
        }).dialog('open');
        return false;
    });

    $("#dialog-confirm").dialog({
        resizable: false,
        bgiframe: true,
        autoOpen: false,
        width: 400,
        height: "auto",
        zindex: 9998,
        modal: false,
        buttons: {
            '<?php echo _DELETE;?>': function () {
                var parent = $(this).data('parent');
                var id = $(this).data('delid');
				var title = $(this).data('title');

                $.ajax({
                    type: 'post',
                    url: "plugins/contentslider/controller.php",
                    data: 'deleteSlide=' + id + '&slidetitle=' + title,
                    beforeSend: function () {
                        parent.animate({
                            'backgroundColor': '#FFBFBF'
                        }, 400);
                    },
                    success: function (msg) {
                        parent.fadeOut(400, function () {
                            parent.remove();
                        });
						$("html, body").animate({scrollTop:0}, 600);
						$("#msgholder").html(msg);
                    }
                });

                $(this).dialog('close');
            },
            '<?php echo _CANCEL;?>': function () {
                $(this).dialog('close');
            }
        }
    });
});
// ]]>
</script>
<?php break;?>
<?php endswitch;?>