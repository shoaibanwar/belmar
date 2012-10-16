<?php
  /**
   * News Slider
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: admin.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  if(!$user->getAcl("newsslider")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
   
  require_once("lang/" . $core->language . ".lang.php");
  require_once("admin_class.php");
  
  $slider = new newsSlider();
?>
<?php switch($core->paction): case "edit": ?>
<?php $row = $core->getRowById("plug_newsslider", $slider->sliderid);?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo PLG_NS_TITLE1;?></h1>
<p class="info"><?php echo PLG_NS_INFO1 . _REQ1. required() . _REQ2;?></p>
<h2><?php echo PLG_NS_SUBTITLE1 . $row['title'.$core->dblang];?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo PLG_NS_TITLE;?>: <?php echo required();?></td>
      <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $row['title'.$core->dblang];?>" size="55" /></td>
    </tr>
    <tr>
      <td><?php echo PLG_NS_PUB;?>:</td>
      <td><span class="input-out">
        <label for="active-1"><?php echo _YES;?></label>
        <input name="active" type="radio" id="active-1" value="1" <?php getChecked($row['active'], 1); ?> />
        <label for="active-2"><?php echo _NO;?></label>
        <input name="active" type="radio" id="active-2" value="0" <?php getChecked($row['active'], 0); ?> />
        </span></td>
    </tr>
    <tr>
      <td><?php echo PLG_NS_S_DATE;?>:</td>
      <td><span class="input-out">
        <label for="s_date-1"><?php echo _YES;?></label>
        <input name="show_created" type="radio" id="s_date-1" value="1" <?php getChecked($row['show_created'], 1); ?> />
        <label for="s_date-2"><?php echo _NO;?></label>
        <input name="show_created" type="radio" id="s_date-2" value="0" <?php getChecked($row['show_created'], 0); ?> />
        </span></td>
    </tr>
    <tr>
      <td><?php echo PLG_NS_S_TITLE;?>:</td>
      <td><span class="input-out">
        <label for="show_title-1"><?php echo _YES;?></label>
        <input name="show_title" type="radio" id="show_title-1" value="1" <?php getChecked($row['show_title'], 1); ?> />
        <label for="show_title-2"><?php echo _NO;?></label>
        <input name="show_title" type="radio" id="show_title-2" value="0" <?php getChecked($row['show_title'], 0); ?> />
        </span></td>
    </tr>
    <tr>
      <td colspan="2" class="editor">
      <textarea id="bodycontent" name="body<?php echo $core->dblang;?>" rows="4" cols="30"><?php echo $core->out_url($row['body'.$core->dblang]);?></textarea>
      <?php loadEditor("bodycontent"); ?></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo PLG_NS_UPDATE;?>" /></td>
      <td><a href="index.php?do=plugins&amp;action=config&amp;plug=newsslider" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
  <input name="sliderid" type="hidden" value="<?php echo $slider->sliderid;?>" />
</form>
<?php echo $core->doForm("processNews","plugins/newsslider/controller.php");?>
<?php break;?>
<?php case"add": ?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo PLG_NS_TITLE2;?></h1>
<p class="info"><?php echo PLG_NS_INFO2 . _REQ1. required() . _REQ2;?></p>
<h2><?php echo PLG_NS_SUBTITLE2;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo PLG_NS_TITLE;?>: <?php echo required();?></td>
      <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox" size="55" /></td>
    </tr>
    <tr>
      <td><?php echo PLG_NS_PUB;?>:</td>
      <td><span class="input-out">
        <label for="active-1"><?php echo _YES;?></label>
        <input name="active" type="radio" id="active-1" value="1" checked="checked" />
        <label for="active-2"><?php echo _NO;?></label>
        <input name="active" type="radio" id="active-2" value="0" />
        </span></td>
    </tr>
    <tr>
      <td><?php echo PLG_NS_S_DATE;?>:</td>
      <td><span class="input-out">
        <label for="s_date-1"><?php echo _YES;?></label>
        <input name="show_created" type="radio" id="s_date-1" value="1" checked="checked" />
        <label for="s_date-2"><?php echo _NO;?></label>
        <input name="show_created" type="radio" id="s_date-2" value="0"  />
        </span></td>
    </tr>
    <tr>
      <td><?php echo PLG_NS_S_TITLE;?>:</td>
      <td><span class="input-out">
        <label for="show_title-1"><?php echo _YES;?></label>
        <input name="show_title" type="radio" id="show_title-1" value="1" checked="checked" />
        <label for="show_title-2"><?php echo _NO;?></label>
        <input name="show_title" type="radio" id="show_title-2" value="0" />
        </span></td>
    </tr>
    <tr>
      <td colspan="2" class="editor">
      <textarea id="bodycontent" name="body<?php echo $core->dblang;?>" rows="4" cols="30"></textarea>
      <?php loadEditor("bodycontent"); ?></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo PLG_NS_ADD;?>" /></td>
      <td><a href="index.php?do=plugins&amp;action=config&amp;plug=newsslider" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
</form>
<?php echo $core->doForm("processNews","plugins/newsslider/controller.php");?>
<?php break;?>
<?php default: ?>
<?php $sliderow = $slider->getNewsItems();?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo PLG_NS_TITLE3;?></h1>
<p class="info"><?php echo PLG_NS_INFO3 . PLG_NS_INFO3_1;?></p>
<h2><span><a href="index.php?do=plugins&amp;action=config&amp;plug=newsslider&amp;plug_action=add" class="button-sml"><?php echo PLG_NS_ADD;?></a></span><?php echo PLG_NS_SUBTITLE3 . $content->getPluginName(get("plug"));?></h2>
<table cellpadding="0" cellspacing="0" class="display" id="pagetable">
  <thead>
    <tr>
      <th width="15">#</th>
      <th class="left"><?php echo PLG_NS_TITLE;?></th>
      <th><?php echo PLG_NS_POS;?></th>
      <th class="left"><?php echo PLG_NS_CONTENT;?></th>
      <th><?php echo PLG_NS_EDIT;?></th>
      <th><?php echo _DELETE;?></th>
    </tr>
  </thead>
  <tbody>
    <?php if($sliderow == 0):?>
    <tr>
      <td colspan="6"><div class="msgInfo"><?php echo PLG_NS_NONEWS;?></div></td>
    </tr>
    <?php else:?>
    <?php foreach ($sliderow as $slrow):?>
    <?php $body = cleanOut($slrow['body'.$core->dblang]);?>
    <tr id="node-<?php echo $slrow['id'];?>">
      <td align="center" class="id-handle"><?php echo $slrow['id'];?>.</td>
      <td><?php echo $slrow['title'.$core->dblang];?></td>
      <td align="center"><?php echo $slrow['position'];?></td>
      <td><?php echo sanitize($body,60);?></td>
      <td align="center"><a href="index.php?do=plugins&amp;action=config&amp;plug=newsslider&amp;plug_action=edit&amp;sliderid=<?php echo $slrow['id'];?>"><img src="images/edit.png" class="tooltip"  alt="" title="<?php echo PLG_NS_EDIT.': '.$slrow['title'.$core->dblang];?>"/></a></td>
      <td align="center"><a href="javascript:void(0);" class="delete" rel="<?php echo $slrow['title'.$core->dblang];?>" id="item_<?php echo $slrow['id'];?>"><img src="images/delete.png" alt="" class="tooltip" title="<?php echo _DELETE.': '.$slrow['title'.$core->dblang];?>" /></a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($slrow);?>
    <tr style="background-color:transparent">
      <td colspan="6"><a href="javascript:void(0);" id="serialize" class="button-sml"><?php echo PLG_NS_POS_SAVE;?></a></td>
    </tr>
    <?php endif;?>
  </tbody>
</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '.PLG_NS_ITEM;?>">
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
            url: "plugins/newsslider/controller.php?sortnews",
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
                    url: "plugins/newsslider/controller.php",
                    data: 'deleteNews=' + id + '&newstitle=' + title,
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