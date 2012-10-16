<?php
  /**
   * Posts
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: posts.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  if(!$user->getAcl("Posts")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<?php include("help/posts.php");?>
<?php switch($core->action): case "edit": ?>
<?php $row = $core->getRowById("posts", $content->postid);?>
<h1><img src="images/posts-sml.png" alt="" /><?php echo _PO_TITLE1;?></h1>
<p class="info"><?php echo _PO_INFO1 . _REQ1 . required() . _REQ2;?></p>
<h2><span><a href="javascript:void(0);" onclick="$('#dialog').dialog('open'); return false"><img src="images/help.png" alt="" /></a></span><?php echo _PO_SUBTITLE1 . $row['title'.$core->dblang];?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo _PO_TITLE;?>: <?php echo required();?></td>
      <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $row['title'.$core->dblang];?>" size="55" /></td>
    </tr>
    <tr>
      <td><?php echo _PO_PARENT;?>:</td>
      <td><select name="page_id" class="custombox" style="width:200px">
          <?php $pagerow = $content->getPages();?>
          <?php foreach ($pagerow as $prow):?>
          <?php $sel = ($row['page_id'] == $prow['id']) ? ' selected="selected"' : '' ;?>
          <option value="<?php echo $prow['id'];?>"<?php echo $sel;?>><?php echo $prow['title'.$core->dblang];?></option>
          <?php endforeach;?>
        </select></td>
    </tr>
    <tr>
      <td><?php echo _PO_PUB;?>:</td>
      <td><span class="input-out">
        <label for="active-1"><?php echo _YES;?></label>
        <input name="active" type="radio" id="active-1" value="1" <?php getChecked($row['active'], 1); ?> />
        <label for="active-2"><?php echo _NO;?></label>
        <input name="active" type="radio" id="active-2" value="0" <?php getChecked($row['active'], 0); ?> />
        </span></td>
    </tr>
    <tr>
      <td><?php echo _PO_SHOW_T;?>:</td>
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
      <td><?php echo _PO_JSCODE;?>:</td>
      <td><textarea name="jscode" rows="4" cols="45"><?php echo cleanOut($row['jscode']);?></textarea>
      <?php echo tooltip(_PO_JSCODE_T);?></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo _PO_UPDATE;?>" /></td>
      <td><a href="index.php?do=posts" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
  <input name="postid" type="hidden" value="<?php echo $content->postid;?>" />
</form>
<?php echo $core->doForm("processPost","controller.php");?>
<?php break;?>
<?php case"add": ?>
<h1><img src="images/posts-sml.png" alt="" /><?php echo _PO_TITLE2;?></h1>
<p class="info"><?php echo _PO_INFO2 . _REQ1 . required() . _REQ2;?></p>
<h2><span><a href="javascript:void(0);" onclick="$('#dialog').dialog('open'); return false"><img src="images/help.png" alt="" /></a></span><?php echo _PO_SUBTITLE2;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo _PO_TITLE;?>: <?php echo required();?></td>
      <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox"  size="55" title="<?php echo _PO_TITLE_R;?>"/></td>
    </tr>
    <tr>
      <td><?php echo _PO_PARENT;?>:</td>
      <td><select name="page_id" class="custombox" style="width:200px">
          <?php $pagerow = $content->getPages();?>
          <?php foreach ($pagerow as $prow):?>
          <?php $sel = ($content->pageid == $prow['id']) ? ' selected="selected"' : '' ;?>
          <option value="<?php echo $prow['id'];?>"<?php echo $sel;?>><?php echo $prow['title'.$core->dblang];?></option>
          <?php endforeach;?>
        </select></td>
    </tr>
    <tr>
      <td><?php echo _PO_PUB;?>:</td>
      <td><span class="input-out">
        <label for="active-1"><?php echo _YES;?></label>
        <input name="active" type="radio" id="active-1" value="1" checked="checked" />
        <label for="active-2"><?php echo _NO;?></label>
        <input name="active" type="radio" id="active-2" value="0" />
        </span></td>
    </tr>
    <tr>
      <td><?php echo _PO_SHOW_T;?>:</td>
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
      <td><?php echo _PO_JSCODE;?>:</td>
      <td><textarea name="jscode" rows="4" cols="45"></textarea>
      <?php echo tooltip(_PO_JSCODE_T);?></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo _PO_ADD;?>" /></td>
      <td><a href="index.php?do=posts" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
</form>

<?php echo $core->doForm("processPost","controller.php");?>
<?php break;?>
<?php default: ?>
<?php $postrow = $content->getPagePost();?>
<h1><img src="images/posts-sml.png" alt="" /><?php echo _PO_TITLE3;?></h1>
<p class="info"><?php echo _POINFO3;?></p>
<h2><span><a href="index.php?do=posts&amp;action=add" class="button-sml"><?php echo _PO_ADD;?></a></span><?php echo _PO_SUBTITLE3;?></h2>
<div style="float:left;margin-bottom:5px">
<?php echo $pager->items_per_page();?> &nbsp;&nbsp;
<?php if($pager->num_pages >= 1) echo $pager->jump_menu();?>
<br  clear="left"/>
</div>
<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
      <th width="20" class="left">#</th>
      <th class="left"><?php echo _PO_TITLE;?></th>
      <th class="left"><?php echo _PO_PAGE_TITLE;?></th>
      <th><?php echo _PUBLISHED;?></th>
      <th><?php echo _PO_EDIT;?></th>
      <th><?php echo _DELETE;?></th>
    </tr>
  </thead>
  <tbody>
    <?php if(!$postrow):?>
    <tr style="background-color:transparent">
      <td colspan="6"><?php echo $core->msgAlert(_PO_NOPOST,false);?></td>
    </tr>
    <?php else:?>
    <?php foreach ($postrow as $row):?>
    <tr>
      <td><?php echo $row['id'];?>.</td>
      <td><?php echo $row['title'.$core->dblang];?></td>
      <td><?php echo $row['pagetitle'] ;?></td>
      <td align="center"><?php echo isActive($row['active']);?></td>
      <td align="center"><a href="index.php?do=posts&amp;action=edit&amp;postid=<?php echo $row['id'];?>"><img src="images/edit.png" class="tooltip"  alt="" title="<?php echo _PO_EDIT;?>"/></a></td>
      <td align="center"><a href="javascript:void(0);" class="delete" rel="<?php echo $row['title'.$core->dblang];?>" id="item_<?php echo $row['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo _DELETE;?>"/></a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($row);?>
      <?php if($pager->items_total > $pager->items_per_page):?>
      <tr style="background-color:transparent">
        <td colspan="6" style="padding:10px;"><div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
      </tr>
      <?php endif;?>
    <?php endif;?>
  </tbody>
</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '._POST;?>">
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
                    data: 'deletePost=' + id + '&posttitle=' + title,
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