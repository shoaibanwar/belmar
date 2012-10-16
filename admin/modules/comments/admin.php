<?php
  /**
   * Admin
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: admin.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  if(!$user->getAcl("comments")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;

  require_once("lang/" . $core->language . ".lang.php");
  require_once("admin_class.php");
  $com = new Comments();
?>
<?php switch($core->maction): case "config": ?>
<h1><img src="images/mod-sml.png" alt="" /><?php echo MOD_CM_TITLE1;?></h1>
<p class="info"><?php echo MOD_CM_INFO1;?></p>
<h2><?php echo MOD_CM_SUBTITLE1;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo MOD_CM_UNAME_R;?>:</td>
      <td><span class="input-out">
        <label for="username_req-1"><?php echo _YES;?></label>
        <input name="username_req" type="radio" id="username_req-1" value="1" <?php getChecked($com->username_req, 1); ?> />
        <label for="username_req-2"><?php echo _NO;?></label>
        <input name="username_req" type="radio" id="username_req-2" value="0" <?php getChecked($com->username_req, 0); ?> />
        &nbsp; <?php echo tooltip(MOD_CM_UNAME_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo MOD_CM_EMAIL_R;?>:</td>
      <td><span class="input-out">
        <label for="email_req-1"><?php echo _YES;?></label>
        <input name="email_req" type="radio" id="email_req-1" value="1" <?php getChecked($com->email_req, 1); ?> />
        <label for="email_req-2"><?php echo _NO;?></label>
        <input name="email_req" type="radio" id="email_req-2" value="0" <?php getChecked($com->email_req, 0); ?> />
        &nbsp; <?php echo tooltip(MOD_CM_EMAIL_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo MOD_CM_CAPTCHA;?>:</td>
      <td><span class="input-out">
        <label for="show_captcha-1"><?php echo _YES;?></label>
        <input name="show_captcha" type="radio" id="show_captcha-1" value="1" <?php getChecked($com->show_captcha, 1); ?> />
        <label for="show_captcha-2"><?php echo _NO;?></label>
        <input name="show_captcha" type="radio" id="show_captcha-2" value="0" <?php getChecked($com->show_captcha, 0); ?> />
        &nbsp; <?php echo tooltip(MOD_CM_CAPTCHA_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo MOD_CM_WWW;?>:</td>
      <td><span class="input-out">
        <label for="show_www-1"><?php echo _YES;?></label>
        <input name="show_www" type="radio" id="show_www-1" value="1" <?php getChecked($com->show_www, 1); ?> />
        <label for="show_www-2"><?php echo _NO;?></label>
        <input name="show_www" type="radio" id="show_www-2" value="0" <?php getChecked($com->show_www, 0); ?> />
        &nbsp; <?php echo tooltip(MOD_CM_WWW_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo MOD_CM_UNAME_S;?>:</td>
      <td><span class="input-out">
        <label for="show_username-1"><?php echo _YES;?></label>
        <input name="show_username" type="radio" id="show_username-1" value="1" <?php getChecked($com->show_username, 1); ?> />
        <label for="show_username-2"><?php echo _NO;?></label>
        <input name="show_username" type="radio" id="show_username-2" value="0" <?php getChecked($com->show_username, 0); ?> />
        &nbsp; <?php echo tooltip(MOD_CM_UNAME_ST);?></span></td>
    </tr>
    <tr>
      <td><?php echo MOD_CM_EMAIL_S;?>:</td>
      <td><span class="input-out">
        <label for="show_email-1"><?php echo _YES;?></label>
        <input name="show_email" type="radio" id="show_email-1" value="1" <?php getChecked($com->show_email, 1); ?> />
        <label for="show_email-2"><?php echo _NO;?></label>
        <input name="show_email" type="radio" id="show_email-2" value="0" <?php getChecked($com->show_email, 0); ?> />
        &nbsp; <?php echo tooltip(MOD_CM_EMAIL_ST);?></span></td>
    </tr>
    <tr>
      <td><?php echo MOD_CM_REG_ONLY;?>:</td>
      <td><span class="input-out">
        <label for="public_access-1"><?php echo _YES;?></label>
        <input name="public_access" type="radio" id="public_access-1" value="1" <?php getChecked($com->public_access, 1); ?> />
        <label for="public_access-2"><?php echo _NO;?></label>
        <input name="public_access" type="radio" id="public_access-2" value="0" <?php getChecked($com->public_access, 0); ?> />
        &nbsp; <?php echo tooltip(MOD_CM_REG_ONLY_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo MOD_CM_SORTING;?>:</td>
      <td><select class="custombox" name="sorting" style="width:250px">
        <option value="DESC"<?php if($com->sorting == "DESC") echo ' selected="selected"';?>><?php echo MOD_CM_SORTING_T;?></option>
        <option value="ASC"<?php if($com->sorting == "ASC") echo ' selected="selected"';?>><?php echo MOD_CM_SORTING_B;?></option>
      </select></td>
    </tr>
    <tr>
      <td><?php echo MOD_CM_CHAR;?>:</td>
      <td><input name="char_limit" type="text" class="inputbox" value="<?php echo $com->char_limit; ?>" size="4" />
        &nbsp; <?php echo tooltip(MOD_CM_CHAR_T);?></td>
    </tr>
    <tr>
      <td><?php echo MOD_CM_PERPAGE;?>:</td>
      <td><input name="perpage" type="text" class="inputbox" value="<?php echo $com->perpage; ?>" size="4" />
        &nbsp; <?php echo tooltip(MOD_CM_PERPAGE_T);?></td>
    </tr>
    <tr>
      <td><?php echo MOD_CM_AA;?>:</td>
      <td><span class="input-out">
        <label for="auto_approve-1"><?php echo _YES;?></label>
        <input name="auto_approve" type="radio" id="auto_approve-1" value="1" <?php getChecked($com->auto_approve, 1); ?> />
        <label for="auto_approve-2"><?php echo _NO;?></label>
        <input name="auto_approve" type="radio" id="auto_approve-2" value="0" <?php getChecked($com->auto_approve, 0); ?> />
        &nbsp; <?php echo tooltip(MOD_CM_AA_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo MOD_CM_NOTIFY;?>:</td>
      <td><span class="input-out">
        <label for="notify_new-1"><?php echo _YES;?></label>
        <input name="notify_new" type="radio" id="notify_new-1" value="1" <?php getChecked($com->notify_new, 1); ?> />
        <label for="notify_new-2"><?php echo _NO;?></label>
        <input name="notify_new" type="radio" id="notify_new-2" value="0" <?php getChecked($com->notify_new, 0); ?> />
        &nbsp; <?php echo tooltip(MOD_CM_NOTIFY_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo MOD_CM_DATE;?>:</td>
      <td><select class="custombox" name="dateformat" style="width:250px">
          <?php echo $com->getDateFormat();?>
        </select>
        &nbsp; <?php echo tooltip(MOD_CM_DATE_T);?></td>
    </tr>
    <tr>
      <td><?php echo MOD_CM_WORDS;?>:</td>
      <td><textarea name="blacklist_words" cols="45" rows="6" class="inputbox"><?php echo $com->blacklist_words;?></textarea>
        &nbsp; <?php echo tooltip(MOD_CM_WORDS_T);?></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo MOD_CM_UPDATE_B;?>" /></td>
      <td><a href="index.php?do=modules&amp;action=config&amp;mod=comments" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
</form>
<?php echo $core->doForm("updateConfig","modules/comments/controller.php");?>
<?php break;?>
<?php default: ?>
<?php $sort = (isset($_GET['sort'])) ? str_replace("-", " ", $_GET['sort']) : false;?>	
<?php $commentrow = $com->getComments();?>
<h1><img src="images/mod-sml.png" alt="" /><?php echo MOD_CM_TITLE3;?></h1>
<p class="info"><?php echo MOD_CM_INFO3;?></p>
<h2><span><a href="index.php?do=modules&amp;action=config&amp;mod=comments&amp;mod_action=config" class="button-sml"><?php echo MOD_CM_CONFIG;?></a></span><?php echo MOD_CM_SUBTITLE3 . $content->getModuleName(get("mod"));?></h2>
<div class="box">
  <table cellpadding="0" cellspacing="0" class="display">
    <tr style="background-color:inherit">
      <td><form action="" method="post" id="dForm">
          <strong><?php echo MOD_CM_SHOWFROM;?></strong>
          <input name="fromdate" type="text" style="margin-right:3px" class="inputbox" size="10" id="fromdate" />
          <strong><?php echo MOD_CM_SHOWTO;?></strong>
          <input name="enddate" type="text" style="margin-right:3px" class="inputbox" size="10" id="enddate" />
          <input name="find" type="submit" class="button-sml" value="<?php echo MOD_CM_FIND;?>" />
        </form></td>
      <td align="right"><form action="" method="get" name="filter_browse" id="filter_browse">
          <strong><?php echo MOD_CM_FILTER;?></strong>
          <select name="select" class="select" onchange="if(this.value!='NA') window.location = 'index.php?do=modules&amp;action=config&amp;mod=comments&amp;sort='+this[this.selectedIndex].value; else window.location = 'index.php?do=modules&amp;action=config&amp;mod=comments';" style="width:200px">
            <option value="NA"><?php echo MOD_CM_FILTER_R;?></option>
            <?php echo $com->getCommentFilter();?>
          </select>
        </form></td>
    </tr>
  </table>
</div>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellpadding="0" cellspacing="0" class="display">
    <thead>
      <tr>
        <th width="25" class="left">#</th>
        <th class="left"><?php echo MOD_CM_UNAME;?></th>
        <th class="left"><?php echo MOD_CM_EMAIL;?></th>
        <th class="left"><?php echo MOD_CM_CREATED;?></th>
        <th class="left"><?php echo MOD_CM_PNAME;?></th>
        <th><?php echo MOD_CM_VIEW;?></th>
        <th><?php echo MOD_CM_STATUS;?></th>
        <th class="right"><input type="checkbox" name="masterCheckbox" id="masterCheckbox" class="checkbox"/></th>
      </tr>
    </thead>
    <tbody>
      <?php if($commentrow == 0):?>
      <tr style="background-color:transparent">
        <td colspan="8"><?php echo $core->msgInfo(MOD_CM_NONCOMMENTS,false);?></td>
      </tr>
      <?php else:?>
      <?php foreach ($commentrow as $crow):?>
      <tr>
        <td><?php echo $crow['cid'];?>.</td>
        <td><?php echo $crow['username'];?></td>
        <td><?php echo $crow['email'];?></td>
        <td><?php echo dodate($core->long_date, $crow['created']);?></td>
        <td><a href="index.php?do=pages&amp;action=edit&amp;pageid=<?php echo $crow['id'];?>"><?php echo $crow['title'];?></a></td>
        <td align="center"><div id="viewcomment-<?php echo $crow['cid'];?>" style="display:none" class="viewcomment" title="Comment View: <?php echo $crow['username'];?>"> <?php echo cleanOut($crow['body']);?>
            <div style="margin-top:10px;border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;font-size:11px">
              <p>Web: <?php echo $crow['www'];?></p>
              <p>IP: <?php echo $crow['ip'];?></p>
            </div>
          </div>
          <a href="javascript:void(0);" onclick="$('#viewcomment-<?php echo $crow['cid'];?>').dialog('open'); return false"><img src="images/edit.png" class="tooltip"  alt="" title="<?php echo MOD_CM_VIEW_P;?>"/></a></td>
        <td align="center"><?php echo isActive($crow['active']);?></td>
        <td class="right"><input name="comid[]" type="checkbox" class="checkbox" id="status<?php echo $crow['cid'];?>" value="<?php echo $crow['cid'];?>" /></td>
      </tr>
      <?php endforeach;?>
      <?php unset($crow);?>
      <tr style="background-color:transparent">
        <td colspan="8"><div style="float:left" class="box"><?php echo $pager->items_per_page();?> &nbsp;&nbsp;
            <?php if($pager->num_pages >= 1) echo $pager->jump_menu();?>
          </div>
          <div style="float:right" class="box">
            <input type="submit" name="approve" id="approve" value="<?php echo MOD_CM_APPROVE;?>" class="button-sml doform" />
            <input type="submit" name="disapprove" id="disapprove" value="<?php echo MOD_CM_DISAPPROVE;?>" class="button-sml doform" />
            <input type="submit" name="delete" id="delete" value="<?php echo _DELETE;?>" class="button-alt-sml doform" />
          </div></td>
      </tr>
      <?php if($pager->items_total >= $pager->items_per_page):?>
      <tr style="background-color:transparent">
        <td colspan="8" style="padding:10px;"><div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
      </tr>
      <?php endif;?>
	  <?php endif;?>
    </tbody>
  </table>
</form>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
    $('.doform').click(function () {
        var action = $(this).attr('id');
        var str = $("#admin_form").serialize();
        str += '&comproccess=1';
        str += '&action=' + action;
        $.ajax({
            type: "post",
            url: "modules/comments/controller.php",
            data: str,
            beforeSend: function () {
                $('.display tbody tr').each(function () {
                    if ($(this).find('input:checked').length) {
                        $(this).animate({
                            'backgroundColor': '#FFBFBF'
                        }, 400);
                    }
                });
            },
            success: function (msg) {
                $('.display tbody tr').each(function () {
                    if ($(this).find('input:checked').length) {
                        if (action == "delete") {
                            $(this).fadeOut(400, function () {
                                $(this).remove();
                            });
                        } else {
                            $(this).animate({
                                'backgroundColor': '#fff'
                            }, 400);

                        }
                    }
                });
                $("#msgholder").html(msg);
            }
        });
        return false;
    });

    $(".viewcomment").dialog({
        bgiframe: true,
        autoOpen: false,
        width: 450,
        height: "auto",
        zindex: 9998,
        modal: false
    });
});
$(function () {
	$('#masterCheckbox').click(function(e) {
		$(this).parent().toggleClass("ez-checked");
		$('input[name^="comid"]').each(function() {
			($(this).is(':checked')) ? $(this).removeAttr('checked') : $(this).attr({"checked":"checked"});
			 $(this).trigger('change');
		});
		return false;
	});
});
$(function() {
	var dates = $('#fromdate, #enddate').datepicker({
		defaultDate: "+1w",
		changeMonth: false,
		numberOfMonths: 2,
		dateFormat: 'yy-mm-dd',
		onSelect: function(selectedDate) {
			var option = this.id == "fromdate" ? "minDate" : "maxDate";
			var instance = $(this).data("datepicker");
			var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
			dates.not(this).datepicker("option", option, date);
		}
	});
});
// ]]>
</script>
<?php break;?>
<?php endswitch;?>