<?php
  /**
   * Languages
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: language.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  if(!$user->getAcl("Language")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<?php switch($core->action): case "edit": ?>
<?php $row = $core->getRowById("language", $content->id);?>
<h1><img src="images/lang-sml.png" alt="" /><?php echo _LA_TITLE1;?></h1>
<p class="info"><?php echo _LA_INFO1. _REQ1 . required(). _REQ2;?></p>
<h2><?php echo _LA_SUBTITLE1 . $row['name'];?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="150"><?php echo _LA_TTITLE;?>: <?php echo required();?></td>
      <td><input name="name" type="text"  class="inputbox" value="<?php echo $row['name'];?>" size="45" /></td>
    </tr>
    <tr>
      <td><?php echo _LA_COUNTRY_ABB;?>: <?php echo required();?></td>
      <td><input name="flag" type="text" disabled="disabled" class="inputbox" value="<?php echo $row['flag'];?>" size="2" maxlength="2" readonly="readonly"/>
        &nbsp;&nbsp; <?php echo tooltip(_LA_COUNTRY_ABB_T);?></td>
    </tr>
    <tr>
      <td><?php echo _LA_AUTHOR;?>:</td>
      <td><input name="author" type="text"  class="inputbox" value="<?php echo $row['author'];?>" size="45"/></td>
    </tr>
    <tr>
      <td><input name="submit" type="submit" value="<?php echo _LA_UPDATE;?>"  class="button"/></td>
      <td><a href="index.php?do=language" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
  <input name="id" type="hidden" value="<?php echo $content->id;?>" />
</form>
<?php echo $core->doForm("updateLanguage","controller.php");?>
<?php break;?>
<?php case "add": ?>
<h1><img src="images/lang-sml.png" alt="" /><?php echo _LA_TITLE2;?></h1>
<p class="info"><?php echo _LA_INFO2. _REQ1 . required(). _REQ2;?></p>
<h2><?php echo _LA_SUBTITLE2;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="150"><?php echo _LA_TTITLE;?>: <?php echo required();?></td>
      <td><input name="name" type="text"  class="inputbox" size="45" /></td>
    </tr>
    <tr>
      <td><?php echo _LA_COUNTRY_ABB;?>: <?php echo required();?></td>
      <td><input name="flag" type="text" class="inputbox"   size="2" maxlength="2"/>
        &nbsp;&nbsp; <?php echo tooltip(_LA_COUNTRY_ABB_T);?></td>
    </tr>
    <tr>
      <td><?php echo _LA_AUTHOR;?>:</td>
      <td><input name="author" type="text"  class="inputbox" size="45"/></td>
    </tr>
    <tr>
      <td colspan="2"><p class="info"><?php echo _LA_ADD_INFO;?></p></td>
    </tr>
    <tr>
      <td><input name="submit" type="submit" value="<?php echo _LA_ADD;?>"  class="button"/></td>
      <td><a href="index.php?do=language" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
</form>
<?php echo $core->doForm("addLanguage","controller.php");?>
<?php break;?>
<?php default: ?>
<h1><img src="images/lang-sml.png" alt="" /><?php echo _LA_TITLE3;?></h1>
<p class="info"><?php echo _LA_INFO3;?></p>
<h2><span><a href="index.php?do=language&amp;action=add" class="button-sml"><?php echo _LA_ADD_NEW;?></a></span><?php echo _LA_SUBTITLE3;?></h2>
<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
      <th width="20">#</th>
      <th class="left"><?php echo _LA_TTITLE;?></th>
      <th><?php echo _LA_FLAG;?></th>
      <th class="left"><?php echo _LA_AUTHOR;?></th>
      <th><?php echo _EDIT;?></th>
      <th><?php echo _DELETE;?></th>
    </tr>
  </thead>
  <tbody>
    <?php if(!$core->langList()):?>
    <tr>
      <td colspan="6"><?php echo $core->msgError(_LA_NOLANG,false);?></td>
    </tr>
    <?php else:?>
    <?php foreach ($core->langList() as $row):?>
    <tr>
      <td align="center"><?php echo $row['id'];?>.</td>
      <td><?php echo $row['name'];?></td>
      <td align="center"><img src="<?php echo SITEURL;?>/lang/<?php echo $row['flag'];?>.png" alt="" title="<?php echo $row['name'];?>" class="img-wrap tooltip"/></td>
      <td><?php echo $row['author'];?></td>
      <td align="center"><a href="index.php?do=language&amp;action=edit&amp;id=<?php echo $row['id'];?>"><img src="images/edit.png" alt="" class="tooltip" title="<?php echo _LA_EDIT.': '.$row['name'];?>"/></a></td>
      <td align="center"><a href="javascript:void(0);" class="delete" rel="<?php echo $row['name'];?>" id="item_<?php echo $row['flag'];?>"><img src="images/delete.png" alt="" class="tooltip" title="<?php echo _DELETE;?>"/></a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($row);?>
    <?php endif;?>
  </tbody>
</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '._LANGUAGE;?>">
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
                    data: 'deleteLanguage=' + id + '&posttitle=' + title,
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