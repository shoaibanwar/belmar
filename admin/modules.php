<?php
  /**
   * Modules
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: modules.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
//  if(!$user->getAcl("Modules")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<?php switch($core->action): case "edit": ?>
<?php $row = $core->getRowById("modules", $content->id);?>
<h1><img src="images/mod-sml.png" alt="" /><?php echo _MO_TITLE1;?></h1>
<p class="info"><?php echo _MO_INFO1 . _REQ1 . required() . _REQ2;?></p>
<h2><span><small>v.<?php echo $row['ver'];?></small></span><?php echo _MO_SUBTITLE1 . $row['title'.$core->dblang];?></h2>

<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo _MO_TITLE;?>: <?php echo required();?></td>
      <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $row['title'.$core->dblang];?>" size="55"/></td>
    </tr>
    <tr>
      <td><?php echo _MO_DESC;?>:</td>
      <td><textarea cols="60" name="info<?php echo $core->dblang;?>" rows="3"><?php echo $row['info'.$core->dblang];?></textarea></td>
    </tr>
    
    
    <?php if($row['system']):?>
    <tr>
      <td><?php echo _MO_THEME;?></td>
      <td><select name="theme" class="custombox" style="width:250px">
          <option value=""><?php echo _MO_THEME_DEFAULT;?></option>
          <?php getTemplates(HCODE."/theme/", $row['theme']);?>
        </select></td>
    </tr>
    <?php endif;?>
    <tr>
      <td><?php echo _METAKEYS;?>:</td>
      <td><input name="metakey<?php echo $core->dblang;?>" type="text" value="<?php echo $row['metakey'.$core->dblang];?>" class="inputbox" size="45"  />
      <?php echo tooltip(_CG_METAKEY_T);?></td>
    </tr>     
    <tr>
      <td><?php echo _METADESC;?>:</td>
      <td><textarea name="metadesc<?php echo $core->dblang;?>" cols="60" rows="5" class="inputbox"><?php echo $row['metadesc'.$core->dblang];?></textarea>
        <?php echo tooltip(_CG_METADESC_T);?></td>
    </tr>
    

    
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo _MO_UPDATE;?>" /></td>
      <td><a href="index.php?do=modules" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
  <input name="id" type="hidden" value="<?php echo $content->id;?>" />
</form>
<?php echo $core->doForm("processModule","controller.php");?>
<?php break;?>
<?php case"config": ?>
<?php $admfile = HCODE . "admin/modules/".sanitize(get("mod"))."/admin.php";?>
<?php if(file_exists($admfile)) include_once($admfile);?>
<?php break;?>
<?php default: ?>
<?php $module = $content->getPageModules();?>
<h1><img src="images/mod-sml.png" alt="" /><?php echo _MO_TITLE3;?></h1>
<p class="info"><?php echo _MO_INFO3;?></p>
<h2><?php echo _MO_SUBTITLE3;?></h2>
<div style="float:left;margin-bottom:5px">
<?php echo $pager->items_per_page();?> &nbsp;&nbsp;
<?php if($pager->num_pages >= 1) echo $pager->jump_menu();?>
<br  clear="left"/>
</div>
<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
      <th width="20" class="left">#</th>
      <th class="left"><?php echo _MO_TITLE;?></th>
      <th class="left"><?php echo _MO_CREATED;?></th>
      <th><?php echo _MO_PUB2;?></th>
      <th><?php echo _MO_EDIT;?></th>
      <th><?php echo _MO_CONFIG;?></th>
      <th><?php echo _DELETE;?></th>
    </tr>
  </thead>
  <tbody>
    <?php if(!$module):?>
    <tr>
      <td colspan="7"><?php echo $core->msgAlert(_MO_NOMOD,false);?></td>
    </tr>
    <?php else:?>
    <?php foreach ($module as $row):?>
    <tr>
      <td><?php echo $row['id'];?>.</td>
      <td><?php echo $row['title'.$core->dblang];?></td>
      <td><?php echo dodate($core->short_date, $row['created']);?></td>
      <td align="center"><?php echo isActive($row['active']);?></td>
      <td align="center"><a href="index.php?do=modules&amp;action=edit&amp;id=<?php echo $row['id'];?>"><img src="images/edit.png" class="tooltip"  alt="" title="<?php echo _MO_EDIT;?>"/></a></td>
      <td align="center"><?php if($row['hasconfig'] == 1):?>
        <a href="index.php?do=modules&amp;action=config&amp;mod=<?php echo $row['modalias'];?>"><img src="images/mod-config.png" class="tooltip" alt="" title="<?php echo _MO_CONFIG.': '.$row['title'.$core->dblang];?>"/></a>
        <?php endif;?></td>
      <td align="center"><a href="javascript:void(0);" class="delete" rel="<?php echo $row['title'.$core->dblang];?>" id="item_<?php echo $row['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo _DELETE;?>"/></a></td>
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
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '._MODULE;?>">
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
                    data: 'deleteModule=' + id + '&modtitle=' + title,
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