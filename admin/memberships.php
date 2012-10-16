<?php
  /**
   * Memberships
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: membership.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  if(!$user->getAcl("Memberships")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<?php switch($core->action): case "edit": ?>
<?php $row = $core->getRowById("memberships", $content->id);?>
<h1><img src="images/mem-sml.png" alt="" /><?php echo _MS_TITLE1;?></h1>
<p class="info"><?php echo _MS_INFO1. _REQ1 . required(). _REQ2;?></p>
<h2><?php echo _MS_SUBTITLE1 . $row['title'.$core->dblang];?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo _MS_TITLE;?>: <?php echo required();?></td>
      <td><input name="title<?php echo $core->dblang;?>" type="text"  class="inputbox" value="<?php echo $row['title'.$core->dblang];?>" size="45" /></td>
    </tr>
    <tr>
      <td><?php echo _MS_PRICE;?>: <?php echo required();?></td>
      <td><input name="price" type="text" class="inputbox" value="<?php echo $row['price'];?>" size="10" />
        <?php echo tooltip(_MS_PRICE_T);?></td>
    </tr>
    <tr>
      <td><?php echo _MS_PERIOD;?>: <?php echo required();?></td>
      <td><?php echo $member->getMembershipPeriod($row['period']);?>
      <input name="days" type="text" class="inputbox" value="<?php echo $row['days'];?>" size="10" />
        <?php echo tooltip(_MS_PERIOD_T);?></td>
    </tr>
    <tr>
      <td><?php echo _MS_TRIAL;?>:</td>
      <td><span class="input-out">
        <label for="trial-1"><?php echo _YES;?></label>
        <input name="trial" type="radio" id="trial-1" value="1" <?php getChecked($row['trial'], 1); ?> />
        <label for="trial-2"><?php echo _NO;?></label>
        <input name="trial" type="radio" id="trial-2" value="0" <?php getChecked($row['trial'], 0); ?> />
        <?php echo tooltip(_MS_TRIAL_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo _MS_RECURRING;?></td>
      <td><span class="input-out">
        <label for="recurring-1"><?php echo _YES;?></label>
        <input name="recurring" type="radio" id="recurring-1" value="1" <?php getChecked($row['recurring'], 1); ?> />
        <label for="recurring-2"><?php echo _NO;?></label>
        <input name="recurring" type="radio" id="recurring-2" value="0" <?php getChecked($row['recurring'], 0); ?> />
      <?php echo tooltip(_MS_RECURRING_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo _MS_PRIVATE;?></td>
      <td><span class="input-out">
        <label for="private-1"><?php echo _YES;?></label>
        <input name="private" type="radio" id="private-1" value="1" <?php getChecked($row['private'], 1); ?> />
        <label for="private-2"><?php echo _NO;?></label>
        <input name="private" type="radio" id="private-2" value="0" <?php getChecked($row['private'], 0); ?> />
      <?php echo tooltip(_MS_PRIVATE_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo _MS_ACTIVE;?></td>
      <td><span class="input-out">
        <label for="active-1"><?php echo _YES;?></label>
        <input name="active" type="radio" id="active-1" value="1" <?php getChecked($row['active'], 1); ?> />
        <label for="active-2"><?php echo _NO;?></label>
        <input name="active" type="radio" id="active-2" value="0" <?php getChecked($row['active'], 0); ?> />
        <?php echo tooltip(_MS_ACTIVE_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo _MS_DESC;?>:</td>
      <td><textarea class="inputbox" cols="50" id="description" name="description<?php echo $core->dblang;?>" rows="5"><?php echo $row['description'.$core->dblang];?></textarea></td>
    </tr>
    <tr>
      <td><input name="submit" type="submit" value="<?php echo _MS_UPDATE;?>"  class="button"/></td>
      <td><a href="index.php?do=memberships" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
  <input name="id" type="hidden" value="<?php echo $content->id;?>" />
</form>
<?php echo $core->doForm("processMembership");?>
<?php break;?>
<?php case"add": ?>
<h1><img src="images/mem-sml.png" alt="" /><?php echo _MS_TITLE2;?></h1>
<p class="info"><?php echo _MS_INFO2. _REQ1 . required(). _REQ2;?></p>
<h2><?php echo _MS_SUBTITLE2;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo _MS_TITLE;?>: <?php echo required();?></td>
      <td><input name="title<?php echo $core->dblang;?>" type="text"  class="inputbox"  size="45" /></td>
    </tr>
    <tr>
      <td><?php echo _MS_PRICE;?>: <?php echo required();?></td>
      <td><input name="price" type="text" class="inputbox" size="10" />
      <?php echo tooltip(_MS_PRICE_T);?></td>
    </tr>
    <tr>
      <td><?php echo _MS_PERIOD;?>: <?php echo required();?></td>
      <td><?php echo $member->getMembershipPeriod();?>
      <input name="days" type="text" class="inputbox" size="10" />
        <?php echo tooltip(_MS_PERIOD_T);?></td>
    </tr>
    <tr>
      <td><?php echo _MS_TRIAL;?>:</td>
      <td><span class="input-out">
        <label for="trial-1"><?php echo _YES;?></label>
        <input name="trial" type="radio" id="trial-1" value="1" />
        <label for="trial-2"><?php echo _NO;?></label>
        <input name="trial" type="radio" id="trial-2" value="0" checked="checked" />
        <?php echo tooltip(_MS_TRIAL_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo _MS_RECURRING;?></td>
      <td><span class="input-out">
        <label for="recurring-1"><?php echo _YES;?></label>
        <input name="recurring" type="radio" id="recurring-1" value="1" />
        <label for="recurring-2"><?php echo _NO;?></label>
        <input name="recurring" type="radio" id="recurring-2" value="0" checked="checked" />
        <?php echo tooltip(_MS_RECURRING_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo _MS_PRIVATE;?></td>
      <td><span class="input-out">
        <label for="private-1"><?php echo _YES;?></label>
        <input name="private" type="radio" id="private-1" value="1" />
        <label for="private-2"><?php echo _NO;?></label>
        <input name="private" type="radio" id="private-2" value="0" checked="checked" />
      <?php echo tooltip(_MS_PRIVATE_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo _MS_ACTIVE;?></td>
      <td><span class="input-out">
        <label for="active-1"><?php echo _YES;?></label>
        <input name="active" type="radio" id="active-1" value="1" />
        <label for="active-2"><?php echo _NO;?></label>
        <input name="active" type="radio" id="active-2" value="0" checked="checked" />
        <?php echo tooltip(_MS_ACTIVE_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo _MS_DESC;?>:</td>
      <td><textarea class="inputbox" cols="50" name="description<?php echo $core->dblang;?>" rows="5"></textarea></td>
    </tr>
    <tr>
      <td><input name="submit" type="submit" value="<?php echo _MS_ADD;?>"  class="button"/></td>
      <td><a href="index.php?do=memberships" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
</form>
<?php echo $core->doForm("processMembership");?>
<?php break;?>
<?php default: ?>
<h1><img src="images/mem-sml.png" alt="" /><?php echo _MS_TITLE3;?></h1>
<p class="info"><?php echo _MS_INFO3;?></p>
<h2><span><a href="index.php?do=memberships&amp;action=add" class="button-sml"><?php echo _MS_ADD_NEW;?></a></span><?php echo _MS_SUBTITLE3;?></h2>
<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
      <th width="20" class="left">#</th>
      <th class="left"><?php echo _MS_TITLE4;?></th>
      <th class="left"><?php echo _MS_PRICE2;?></th>
      <th class="left"><?php echo _MS_EXPIRY;?></th>
      <th class="left"><?php echo _MS_DESC2;?></th>
      <th><?php echo _MS_ACTIVE2;?></th>
      <th><?php echo _EDIT;?></th>
      <th><?php echo _DELETE;?></th>
    </tr>
  </thead>
  <tbody>
    <?php if(!$member->getMemberships()):?>
    <tr>
      <td colspan="8"><?php echo $core->msgAlert(_MS_NOMBS,false);?></td>
    </tr>
    <?php else:?>
    <?php foreach ($member->getMemberships() as $row):?>
    <tr>
      <td><?php echo $row['id'];?>.</td>
      <td><?php echo $row['title'.$core->dblang];?></td>
      <td><?php echo $core->formatMoney($row['price']);?></td>
      <td><?php echo $row['days'] . ' ' . $member->getPeriod($row['period']);?></td>
      <td><?php echo $row['description'.$core->dblang];?></td>
      <td align="center"><?php echo isActive($row['active']);?></td>
      <td align="center"><a href="index.php?do=memberships&amp;action=edit&amp;id=<?php echo $row['id'];?>"><img src="images/edit.png" alt="" class="tooltip" title="<?php echo _MS_EDIT.': '.$row['title'.$core->dblang];?>"/></a></td>
      <td align="center"><a href="javascript:void(0);" class="delete" rel="<?php echo $row['title'.$core->dblang];?>" id="item_<?php echo $row['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo _DELETE;?>"/></a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($row);?>
    <?php endif;?>
  </tbody>
</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '._MEMBERSHIP;?>">
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
                    data: 'deleteMembership=' + id + '&posttitle=' + title,
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