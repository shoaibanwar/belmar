<?php
  /**
   * Plugins
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: plugins.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  if(!$user->getAcl("Plugins")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<?php switch($core->action): case "edit": ?>
<?php $row = $core->getRowById("plugins", $content->id);?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo _PL_TITLE1;?></h1>
<p class="info"><?php echo _PL_INFO1 . _REQ1 . required() . _REQ2;?></p>
<h2><span><small>v.<?php echo $row['ver'];?></small></span><?php echo _PL_SUBTITLE1 . $row['title'.$core->dblang];?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo _PL_TITLE;?>: <?php echo required();?></td>
      <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $row['title'.$core->dblang];?>" size="55" /></td>
    </tr>
    <tr>
      <td><?php echo _PL_PUB;?>:</td>
      <td><span class="input-out">
        <label for="active-1"><?php echo _YES;?></label>
        <input name="active" type="radio" id="active-1" value="1" <?php getChecked($row['active'], 1); ?> />
        <label for="active-2"><?php echo _NO;?></label>
        <input name="active" type="radio" id="active-2" value="0" <?php getChecked($row['active'], 0); ?> />
        </span></td>
    </tr>
    <tr>
      <td><?php echo _PL_SHOW_TITLE;?>:</td>
      <td><span class="input-out">
        <label for="show_title-1"><?php echo _YES;?></label>
        <input name="show_title" type="radio" id="show_title-1" value="1" <?php getChecked($row['show_title'], 1); ?> />
        <label for="show_title-2"><?php echo _NO;?></label>
        <input name="show_title" type="radio" id="show_title-2" value="0" <?php getChecked($row['show_title'], 0); ?> />
        </span></td>
    </tr>
    <tr>
      <td><?php echo _PL_ALT_CLASS;?>:</td>
      <td><input name="alt_class" type="text" class="inputbox" value="<?php echo $row['alt_class'];?>" size="55"/>
      &nbsp;&nbsp; <?php echo tooltip(_PL_ALT_CLASS_T);?></td>
    </tr>
    <tr>
      <td colspan="2" class="editor">
      <textarea id="bodycontent" name="body<?php echo $core->dblang;?>" rows="4" cols="30"><?php echo $core->out_url($row['body'.$core->dblang]);?></textarea>
      <?php loadEditor("bodycontent"); ?></td>
    </tr>
    <tr>
      <td><?php echo _PL_DESC;?>:</td>
      <td><textarea cols="60" name="info<?php echo $core->dblang;?>" rows="3"><?php echo $row['info'.$core->dblang];?></textarea></td>
    </tr>
    <?php if(!$row['system']):?>
    <tr>
      <td><?php echo _PO_JSCODE;?>:</td>
      <td><textarea name="jscode" rows="4" cols="60"><?php echo cleanOut($row['jscode']);?></textarea>
      <?php echo tooltip(_PO_JSCODE_T);?></td>
    </tr>
    <?php endif;?>
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo _PL_UPDATE;?>" /></td>
      <td><a href="index.php?do=plugins" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
  <input name="id" type="hidden" value="<?php echo $content->id;?>" />
</form>
<?php echo $core->doForm("processPlugin");?>
<?php break;?>
<?php case"add": ?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo _PL_TITLE2;?></h1>
<p class="info"><?php echo _PL_INFO2 . _REQ1 . required() . _REQ2;?></p>
<h2> <?php echo _PL_SUBTITLE2;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo _PL_TITLE;?>: <?php echo required();?></td>
      <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox"  size="55" /></td>
    </tr>
    <tr>
      <td><?php echo _PL_PUB;?>:</td>
      <td><span class="input-out">
        <label for="active-1"><?php echo _YES;?></label>
        <input name="active" type="radio" id="active-1" value="1" checked="checked" />
        <label for="active-2"><?php echo _NO;?></label>
        <input name="active" type="radio" id="active-2" value="0" />
        </span></td>
    </tr>
    <tr>
      <td><?php echo _PL_SHOW_TITLE;?>:</td>
      <td><span class="input-out">
        <label for="show_title-1"><?php echo _YES;?></label>
        <input name="show_title" type="radio" id="show_title-1" value="1" checked="checked" />
        <label for="show_title-2"><?php echo _NO;?></label>
        <input name="show_title" type="radio" id="show_title-2" value="0" />
        </span></td>
    </tr>
    <tr>
      <td><?php echo _PL_ALT_CLASS;?>:</td>
      <td><input name="alt_class" type="text" class="inputbox" size="55"/>
      &nbsp;&nbsp; <?php echo tooltip(_PL_ALT_CLASS_T);?></td>
    </tr>
    <tr>
      <td colspan="2" class="editor">
      <textarea id="bodycontent" name="body<?php echo $core->dblang;?>" rows="4" cols="30"></textarea>
      <?php loadEditor("bodycontent"); ?></td>
    </tr>
    <tr>
      <td><?php echo _PL_DESC;?>:</td>
      <td><textarea cols="60" rows="3" name="info<?php echo $core->dblang;?>"></textarea></td>
    </tr>
    <tr>
      <td><?php echo _PO_JSCODE;?>:</td>
      <td><textarea name="jscode" rows="4" cols="60"></textarea>
      <?php echo tooltip(_PO_JSCODE_T);?></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo _PL_ADD;?>" /></td>
      <td><a href="index.php?do=plugins" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
</form>
<?php echo $core->doForm("processPlugin");?>
<?php break;?>
<?php case"config": ?>
<?php $admfile = HCODE . "admin/plugins/".sanitize(get("plug"))."/admin.php";?>
<?php if(file_exists($admfile)) include_once($admfile);?>
<?php break;?>
<?php default: ?>
<?php $plugin = $content->getPagePlugins();?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo _PL_TITLE3;?></h1>
<p class="info"><?php echo _PL_INFO3;?></p>
<h2><span><a href="index.php?do=plugins&amp;action=add" class="button-sml"><?php echo _PL_ADD;?></a></span><?php echo _PL_SUBTITLE3;?></h2>
<div style="float:left;margin-bottom:5px">
<?php echo $pager->items_per_page();?> &nbsp;&nbsp;
<?php if($pager->num_pages >= 1) echo $pager->jump_menu();?>
<br  clear="left"/>
</div>
<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
      <th width="20" class="left">#</th>
      <th class="left"><?php echo _PL_TITLE;?></th>
      <th class="left"><?php echo _PL_CREATED;?></th>
      <th><?php echo _PL_PUB2;?></th>
      <th><?php echo _PL_EDIT;?></th>
      <th><?php echo _PL_CONFIG;?></th>
      <th><?php echo _DELETE;?></th>
    </tr>
  </thead>
  <tbody>
    <?php if(!$plugin):?>
    <tr>
      <td colspan="7"><?php echo $core->msgAlert(_PL_NOPLUG,false);?></td>
    </tr>
    <?php else:?>
    <?php foreach ($plugin as $row):?>
    <tr>
      <td><?php echo $row['id'];?>.</td>
      <td><?php echo $row['title'.$core->dblang];?></td>
      <td><?php echo dodate($core->short_date, $row['created']);?></td>
      <td align="center"><?php echo isActive($row['active']);?></td>
      <td align="center"><a href="index.php?do=plugins&amp;action=edit&amp;id=<?php echo $row['id'];?>"><img src="images/edit.png" class="tooltip"  alt="" title="<?php echo _PL_EDIT;?>"/></a></td>
      <td align="center"><?php if($row['hasconfig'] == 1):?>
        <a href="index.php?do=plugins&amp;action=config&amp;plug=<?php echo $row['plugalias'];?>"><img src="images/mod-config.png" class="tooltip" alt="" title="<?php echo _PL_CONFIG.': '.$row['title'.$core->dblang];?>"/></a>
        <?php endif;?></td>
      <td align="center"><?php if($row['system'] == 0):?>
        <a href="javascript:void(0);" class="delete" rel="<?php echo $row['title'.$core->dblang];?>" id="item_<?php echo $row['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo _DELETE;?>"/></a>
        <?php else:?>
        <img src="images/sys-module.png" class="tooltip" alt="" title="<?php echo _PL_SYS.': '.$row['title'.$core->dblang];?>"/>
        <?php endif;?></td>
    </tr>
    <?php endforeach;?>
    <?php unset($row);?>
      <?php if($pager->items_total > $pager->items_per_page):?>
      <tr style="background-color:transparent">
        <td colspan="7" style="padding:10px;"><div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
      </tr>
      <?php endif;?>
    <?php endif;?>
  </tbody>
</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '._PLUGIN;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {
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
                    url: "ajax.php",
                    data: 'deletePlugin=' + id + '&plugtitle=' + title,
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