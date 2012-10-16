<?php
  /**
   * jQuery Slider
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: admin.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  if(!$user->getAcl("jqueryslider")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
  
  require_once("lang/" . $core->language . ".lang.php");
  require_once("admin_class.php");
  
  $slider = new jQuerySlider();
?>
<?php switch($core->paction): case "edit": ?>
<?php $slrow = $core->getRowById("plug_slider", $slider->sliderid);?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo PLG_JQ_TITLE;?></h1>
<p class="info"><?php echo PLG_JQ_INFO3;?></p>
<h2><?php echo PLG_JQ_TITLE.' '.PLG_JQ_UPDATE;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
<table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo PLG_JQ_CAPTION;?>: <?php echo required();?></td>
      <td><input type="text" name="title<?php echo $core->dblang;?>" class="inputbox" value="<?php echo $slrow['title'.$core->dblang];?>"  size="55"/></td>
    </tr>
    <tr>
      <td><?php echo PLG_JQ_DESC;?>:</td>
      <td><textarea name="description<?php echo $core->dblang;?>" cols="50" rows="6"><?php echo $slrow['description'.$core->dblang];?></textarea></td>
    </tr>
    <tr>
      <td><?php echo PLG_JQ_URL_T;?>:</td>
      <td><span class="input-out">
        <label for="urltype-1"><?php echo PLG_JQ_EXTLINK;?></label>
        <input name="urltype" type="radio" id="urltype-1" value="external" onclick="$('#urlchange').show();$('#urlchange2').hide()" <?php getChecked($slrow['urltype'], "ext");?> />
        <label for="urltype-2"><?php echo PLG_JQ_INTLINK;?></label>
        <input name="urltype" type="radio" id="urltype-2" value="internal" onclick="$('#urlchange2').show();$('#urlchange').hide()" <?php getChecked($slrow['urltype'], "int");?> />
        </span></td>
    </tr>
    <tr id="urlchange"<?php echo ($slrow['urltype'] == "ext") ? "" : " style=\"display:none\""; ?>>
      <td><?php echo PLG_JQ_EXTLINK;?>:</td>
      <td><input type="text" name="url" class="inputbox" value="<?php echo $slrow['url'];?>" size="55"/>
        &nbsp;&nbsp;<?php echo tooltip(PLG_JQ_EXTLINK_T);?></td>
    </tr>
    <tr id="urlchange2"<?php echo ($slrow['urltype'] == "int") ? "" : " style=\"display:none\""; ?>>
      <td><?php echo PLG_JQ_INTPAGE;?>:</td>
      <td><select name="page_id" class="select" style="width:200px">
          <?php $pagerow = $content->getPages();?>
          <?php foreach ($pagerow as $prow):?>
          <?php $sel = ($slrow['page_id'] == $prow['id']) ? ' selected="selected"' : '' ;?>
          <option value="<?php echo $prow['id'];?>"<?php echo $sel;?>><?php echo $prow['title'.$core->dblang];?></option>
          <?php endforeach;?>
        </select></td>
    </tr>
    <tr>
      <td><?php echo PLG_JQ_IMG_SEL;?>:</td>
      <td><input name="filename" type="file" class="fileinput mask" size="45" /></td>
    </tr>
    <tr>
      <td><input name="updateimage" type="submit" value="<?php echo PLG_JQ_UPDATE;?>" class="button" /></td>
      <td><a href="index.php?do=plugins&amp;action=config&amp;plug=jqueryslider" class="button-alt"><?php echo _CANCEL;?></a></td>
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
<?php echo $core->doForm("processSliderImage","plugins/jqueryslider/controller.php");?>
<?php break;?>
<?php case"add": ?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo PLG_JQ_TITLE;?></h1>
<p class="info"><?php echo PLG_JQ_INFO3;?></p>
<h2><?php echo PLG_JQ_TITLE.' '.PLG_JQ_IMGUPLOAD;?></h2>
<form action="" method="post" id="admin_form" name="admin_form" enctype="multipart/form-data">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo PLG_JQ_CAPTION;?>: <?php echo required();?></td>
      <td><input type="text" name="title<?php echo $core->dblang;?>" class="inputbox" title="<?php echo PLG_JQ_CAPTION_R;?>" size="55"/></td>
    </tr>
    <tr>
      <td><?php echo PLG_JQ_DESC;?>:</td>
      <td><textarea name="description<?php echo $core->dblang;?>" cols="50" rows="6"></textarea></td>
    </tr>
    <tr>
      <td><?php echo PLG_JQ_URL_T;?>:</td>
      <td><span class="input-out">
        <label for="urltype-1"><?php echo PLG_JQ_EXTLINK;?></label>
        <input name="urltype" type="radio" id="urltype-1" value="external" onclick="$('#urlchange').show();$('#urlchange2').hide()" />
        <label for="urltype-2"><?php echo PLG_JQ_INTLINK;?></label>
        <input name="urltype" type="radio" id="urltype-2" value="internal" onclick="$('#urlchange2').show();$('#urlchange').hide()"  />
        </span></td>
    </tr>
    <tr id="urlchange" style="display:none">
      <td><?php echo PLG_JQ_EXTLINK;?>:</td>
      <td><input type="text" name="url" class="inputbox" size="55"/>
        &nbsp;&nbsp;<?php echo tooltip(PLG_JQ_EXTLINK_T);?></td>
    </tr>
    <tr id="urlchange2" style="display:none">
      <td><?php echo PLG_JQ_INTPAGE;?>:</td>
      <td><select name="page_id" class="select" style="width:200px">
          <?php $pagerow = $content->getPages();?>
          <?php foreach ($pagerow as $prow):?>
          <option value="<?php echo $prow['id'];?>"><?php echo $prow['title'.$core->dblang];?></option>
          <?php endforeach;?>
        </select></td>
    </tr>
    <tr>
      <td><?php echo PLG_JQ_IMG_SEL;?>:</td>
      <td><input name="filename" type="file" class="fileinput mask" size="45" /></td>
    </tr>
    <tr>
      <td><input name="addimage" type="submit" value="<?php echo PLG_JQ_IMGUPLOAD;?>" class="button" /></td>
      <td><a href="index.php?do=plugins&amp;action=config&amp;plug=jqueryslider" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
</form>
<?php echo $core->doForm("processSliderImage","plugins/jqueryslider/controller.php");?>
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
<?php case"configure": ?>
<?php $conf = $slider->getConfiguration();?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo PLG_JQ_TITLE;?></h1>
<p class="info"><?php echo PLG_JQ_INFO3;?></p>
<h2><?php echo PLG_JQ_TITLE.' '.PLG_JQ_CONF;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="2" cellpadding="2" class="formtable">
    <tr>
      <td width="200"><?php echo PLG_JQ_TRANS_EF;?>:</td>
      <td><select name="animation" class="select" style="width:150px">
          <option value="fold"<?php if($conf['animation'] == 'fold') echo ' selected="selected"';?>>Fold Effect</option>
          <option value="fade"<?php if($conf['animation'] == 'fade') echo ' selected="selected"';?>>Fade Effect</option>
          <option value="sliceDown"<?php if($conf['animation'] == 'sliceDown') echo ' selected="selected"';?>>Slice Down</option>
          <option value="sliceUp"<?php if($conf['animation'] == 'sliceUp') echo ' selected="selected"';?>>Slice Up</option>
          <option value="random"<?php if($conf['animation'] == 'random') echo ' selected="selected"';?>>Random</option>
        </select></td>
    </tr>
    <tr>
      <td><?php echo PLG_JQ_ANI_SPEED;?>:</td>
      <td><input type="text" name="anispeed" class="inputbox" value="<?php echo $conf['anispeed'];?>" size="5"/>
        <?php echo tooltip(PLG_JQ_ANI_SPEED_T);?></td>
    </tr>
    <tr>
      <td><?php echo PLG_JQ_ANI_TIME;?>:</td>
      <td><input type="text" name="anitime" class="inputbox" value="<?php echo $conf['anitime'];?>" size="5"/>
        <?php echo tooltip(PLG_JQ_ANI_TIME_T);?></td>
    </tr>
    <tr>
      <td><?php echo PLG_JQ_S_NAV;?>:</td>
      <td><span class="input-out">
        <label for="shownav-1"><?php echo _YES;?></label>
        <input name="shownav" type="radio" id="shownav-1" value="1" <?php getChecked($conf['shownav'], 1); ?> />
        <label for="shownav-2"><?php echo _NO;?></label>
        <input name="shownav" type="radio" id="shownav-2" value="0" <?php getChecked($conf['shownav'], 0); ?>  />
        <?php echo tooltip(PLG_JQ_S_NAV_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo PLG_JQ_S_NAV_H;?>:</td>
      <td><span class="input-out">
        <label for="shownavhide-1"><?php echo _YES;?></label>
        <input name="shownavhide" type="radio" id="shownavhide-1" value="1" <?php getChecked($conf['shownavhide'], 1); ?> />
        <label for="shownavhide-2"><?php echo _NO;?></label>
        <input name="shownavhide" type="radio" id="shownavhide-2" value="0" <?php getChecked($conf['shownavhide'], 0); ?>  />
        <?php echo tooltip(PLG_JQ_S_NAV_H_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo PLG_JQ_S_CONTROLL;?>:</td>
      <td><span class="input-out">
        <label for="controllnav-1"><?php echo _YES;?></label>
        <input name="controllnav" type="radio" id="controllnav-1" value="1" <?php getChecked($conf['controllnav'], 1); ?> />
        <label for="controllnav-2"><?php echo _NO;?></label>
        <input name="controllnav" type="radio" id="controllnav-2" value="0" <?php getChecked($conf['controllnav'], 0); ?>  />
        <?php echo tooltip(PLG_JQ_S_CONTROLL_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo PLG_JQ_PAUSE;?>:</td>
      <td><span class="input-out">
        <label for="hoverpause-1"><?php echo _YES;?></label>
        <input name="hoverpause" type="radio" id="hoverpause-1" value="1" <?php getChecked($conf['hoverpause'], 1); ?> />
        <label for="hoverpause-2"><?php echo _NO;?></label>
        <input name="hoverpause" type="radio" id="hoverpause-2" value="0" <?php getChecked($conf['hoverpause'], 0); ?>  />
        <?php echo tooltip(PLG_JQ_PAUSE_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo PLG_JQ_S_CAPTION;?>:</td>
      <td><span class="input-out">
        <label for="showcaption-1"><?php echo _YES;?></label>
        <input name="showcaption" type="radio" id="showcaption-1" value="1" <?php getChecked($conf['showcaption'], 1); ?> />
        <label for="showcaption-2"><?php echo _NO;?></label>
        <input name="showcaption" type="radio" id="showcaption-2" value="0" <?php getChecked($conf['showcaption'], 0); ?>  />
        <?php echo tooltip(PLG_JQ_S_CAPTION_T);?></span></td>
    </tr>
    <tr>
      <td><input name="conf_update" type="submit" value="<?php echo PLG_JQ_BUT_CONF_U;?>" class="button" /></td>
      <td><a href="index.php?do=plugins&amp;action=config&amp;plug=jqueryslider" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
</form>
<?php echo $core->doForm("updateConfig","plugins/jqueryslider/controller.php");?>
<?php break;?>
<?php default: ?>
<?php $getimgs = $slider->getSliderImages();?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo PLG_JQ_TITLE;?></h1>
<p class="info"><?php echo PLG_JQ_INFO3 . PLG_JQ_INFO3_1;?></p>
<h2><span><a href="index.php?do=plugins&amp;action=config&amp;plug=jqueryslider&amp;plug_action=configure" class="button-alt-sml"><?php echo PLG_JQ_CONF;?></a> <a href="index.php?do=plugins&amp;action=config&amp;plug=jqueryslider&amp;plug_action=add" class="button-sml"><?php echo PLG_JQ_IMGUPLOAD;?></a> </span><?php echo PLG_JQ_SUBTITLE3 . $content->getPluginName(get("plug"));?></h2>
<table cellpadding="0" cellspacing="0" class="display" id="pagetable">
  <thead>
    <tr>
      <th width="15">#</th>
      <th class="left"><?php echo PLG_JQ_CAPTION;?></th>
      <th><?php echo PLG_JQ_POS;?></th>
      <th class="left"><?php echo PLG_JQ_LINK;?></th>
      <th><?php echo PLG_JQ_EDIT;?></th>
      <th><?php echo PLG_JQ_DEL;?></th>
    </tr>
  </thead>
  <tbody>
    <?php if($getimgs == 0):?>
    <tr style="background-color:transparent">
      <td colspan="6"><?php echo $core->msgAlert(PLG_JQ_NOIMG,false);?></td>
    </tr>
    <?php else:?>
    <?php foreach ($getimgs as $slrow):?>
    <tr id="node-<?php echo $slrow['id'];?>">
      <td align="center" class="id-handle"><?php echo $slrow['id'];?>.</td>
      <td><?php echo $slrow['title'.$core->dblang];?></td>
      <td align="center"><?php echo $slrow['position'];?></td>
      <td align="left"><a href="<?php echo $slrow['url'];?>"><?php echo $slrow['url'];?></a></td>
      <td align="center"><a href="index.php?do=plugins&amp;action=config&amp;plug=jqueryslider&amp;plug_action=edit&amp;sliderid=<?php echo $slrow['id'];?>"><img src="images/edit.png" class="tooltip"  alt="" title="<?php echo PLG_JQ_EDIT.': '.$slrow['title'.$core->dblang];?>"/></a></td>
      <td align="center"><a href="javascript:void(0);" class="delete" rel="<?php echo $slrow['title'.$core->dblang];?>" id="item_<?php echo $slrow['id'].':'.$slrow['filename'];?>"><img src="images/delete.png" alt="" class="tooltip" title="<?php echo PLG_JQ_DEL.': '.$slrow['title'.$core->dblang];?>" /></a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($slrow);?>
    <tr style="background-color:transparent">
      <td colspan="6"><a href="javascript:void(0);" id="serialize" class="button-sml"><?php echo PLG_JQ_SAVE_POS;?></a></td>
    </tr>
    <?php endif;?>
  </tbody>
</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '.PLG_JQ_SLIDE;?>">
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
            url: "plugins/jqueryslider/controller.php?sortslides",
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
                    url: "plugins/jqueryslider/controller.php",
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