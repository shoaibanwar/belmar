<?php
  /**
   * Users
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: users.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  if(!$user->checkOperationPermission("Groups")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>

<?php switch($core->action):

    case "edit": ?>

<?php //--------------------------------------------for editing-------------------------------------------------------------------// ?>

<?php $row = $user->getUpdateItems($_GET['groupid']);?>
<?php // $memrow = $member->getMemberships(); ?>
<h1><img src="images/groups_small.png" alt="" /><?php echo _UR_TITLE11;?></h1>
<p class="info"><?php echo _UR_INFO1. _REQ1. required() . _REQ2;?></p>
<h2><?php echo _UR_SUBTITLE1 . $row['depData']['dep_name'];?></h2>

<form action="" method="post" id="admin_form" name="admin_form"  enctype="multipart/form-data">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="250"><?php echo _GROUPNAME;?>: </td>
      <td><input name="dep_name" type="text"  class="inputbox" value="<?php echo $row['depData']['dep_name'];?>" size="55"   /></td>
    </tr>

    <tr>
      <td><?php echo _UR_EMAIL;?>: <?php echo required();?></td>
      <td><input name="dep_email_address" type="text" class="inputbox" value="<?php echo $row['depData']['dep_email_address'];?>" size="55"/></td>
    </tr>



      <tr>
          <td rowspan="9"><?php echo _UR_PERM1;?>: <?php echo required();?></td>
      </tr>
      <?php $menus = $db->fetch_all("SELECT id , name_en FROM menus WHERE id IN ( 24,27,28,29,30,31,33,34 )"); ?>

      <?php foreach($menus as $menu): ?>
      <tr><td><input <?php if(in_array_recursive($menu['id'],$row['menus'])) echo "checked='checked'" ?> type="checkbox" name="menu[<?php echo $menu['id'] ?>]" /><?php echo $menu['name_en'] ?></td></tr>
      <?php endforeach; ?>
      <tr>
          <td>Page Management:</td>
          <td>
            <span class="input-out">
                <label for="pm1">Yes</label>
                <input type="radio" id="pm1" name="can_manage_pages" value="y" <?php if($row['permissions']['can_manage_pages']=='y') echo "checked='checked'" ?>/>
                <label for="pm2">No</label>
                <input type="radio" id="pm2" name="can_manage_pages" value="n" <?php if($row['permissions']['can_manage_pages']=='n') echo "checked='checked'" ?> />
            </span>
          </td>
      </tr>

      <tr>
          <td rowspan="6">Events/Calendars: <?php echo required();?></td>
      </tr>

      <?php $events = $db->fetch_all("SELECT id , event_name FROM event_types "); ?>
      <?php foreach($events as $event): ?>
      <tr><td> <input <?php if(in_array_recursive($event['id'],$row['events'])) echo "checked='checked'" ?> type="checkbox" name="event[<?php echo $event['id'] ?>]"/><?php echo $event['event_name'] ?></td></tr>
      <?php endforeach; ?>


      <tr>
          <td>Press Room:</td>
          <td>
            <span class="input-out">
                <label for="pr1">Yes</label>
                <input type="radio" id="pr1" name="dep_can_manage_press_room" value="y" <?php if($row['permissions']['dep_can_manage_press_room']=='y') echo "checked='checked'" ?> />
                <label for="pr2">No</label>
                <input type="radio" id="pr2" name="dep_can_manage_press_room" value="n"  <?php if($row['permissions']['dep_can_manage_press_room']=='n') echo "checked='checked'" ?> />
            </span>
          </td>
      </tr>

      <tr>
          <td>Belmar Alerts:</td>
          <td>
            <span class="input-out">
                <label for="al1">Yes</label>
                <input type="radio" id="al1" name="dep_can_manage_belmar_alerts" value="y" <?php if($row['permissions']['dep_can_manage_belmar_alerts']=='y') echo "checked='checked'" ?> />
                <label for="al2">No</label>
                <input type="radio" id="al2" name="dep_can_manage_belmar_alerts" value="n" <?php if($row['permissions']['dep_can_manage_belmar_alerts']=='n') echo "checked='checked'" ?> />
            </span>
          </td>
      </tr>

      <tr>
          <td rowspan="9">Gallery: <?php echo required();?></td>
      </tr>
      <?php $galls = $db->fetch_all("SELECT id , name_en FROM menus WHERE id IN ( 24,27,28,29,30,31,33,34 )"); ?>

      <?php foreach($galls as $gall): ?>
      <tr><td><input <?php if(in_array_recursive($gall['id'],$row['galleries'])) echo "checked='checked'" ?> type="checkbox" name="gallery[<?php echo $gall['id'] ?>]"/><?php echo $gall['name_en'] ?></td></tr>
      <?php endforeach; ?>

      <tr>
          <td rowspan="6">From Submission & Lists</td>
          <td><input type="checkbox" name="dep_can_view_all_contact_lists" <?php if($row['permissions']['dep_can_view_all_contact_lists']=='y') echo "checked='checked'" ?>  /> Contact Form - All</td>
      </tr>
      <tr>
          <td><input type="checkbox" name="dep_can_view_own_contact_lists" <?php if($row['permissions']['dep_can_view_own_contact_lists']=='y') echo "checked='checked'" ?>  /> Contact Form - For Department Only </td>
      </tr>
      <tr>
          <td><input type="checkbox" name="dep_can_view_mailing_list" <?php if($row['permissions']['dep_can_view_mailing_list']=='y') echo "checked='checked'" ?>  /> Mailing List</td>
      </tr>
      <tr>
          <td><input type="checkbox" name="dep_can_view_get_alerts_list" <?php if($row['permissions']['dep_can_view_get_alerts_list']=='y') echo "checked='checked'" ?>  /> Get Belmar Alerts List</td>
      </tr>
      <tr>
          <td><input type="checkbox" name="dep_can_view_belmar_survey_list" <?php if($row['permissions']['dep_can_view_belmar_survey_list']=='y') echo "checked='checked'" ?>  /> Belmar Survey List</td>
      </tr>
      <tr>
          <td><input type="checkbox" name="dep_can_view_opt_out_list" <?php if($row['permissions']['dep_can_view_opt_out_list']=='y') echo "checked='checked'" ?>  /> Opt-Out List</td>
      </tr>
      <tr>
          <td><input type="checkbox" name="dep_can_view_public_works_list" <?php if($row['permissions']['dep_can_view_public_works_list']=='y') echo "checked='checked'" ?>  /> Public Works List</td>
      </tr>

      <tr>
          <td rowspan="3">Email System & Templates</td>
          <td><input type="checkbox" name="dep_can_send_lists_emails" <?php if($row['permissions']['dep_can_send_lists_emails']=='y') echo "checked='checked'" ?> /> Send Emails</td>
      </tr>
      <tr>
          <td><input type="checkbox" name="dep_can_edit_email_templates" <?php if($row['permissions']['dep_can_edit_email_templates']=='y') echo "checked='checked'" ?> /> Email Templates</td>
      </tr>
      <tr>
          <td><input type="checkbox" name="dep_can_edit_auto_response" <?php if($row['permissions']['dep_can_edit_auto_response']=='y') echo "checked='checked'" ?> /> Automatic Response Emails</td>
      </tr>

      <tr>
          <td>Create Sub-Level CMS Administrators</td>
          <td>
            <span class="input-out">
                <label for="create1">Yes</label>
                <input type="radio" id="create1" name="dep_can_create_users" value="y" <?php if($row['depData']['dep_can_create_users']=='y') echo "checked='checked'" ?> />
                <label for="create2">No</label>
                <input type="radio" id="create2" name="dep_can_create_users" value="n" <?php if($row['depData']['dep_can_create_users']=='n') echo "checked='checked'" ?> />
            </span>
          </td>
      </tr>

    <tr>
      <td><input type="submit" name="dosubmit" class="button" value="<?php echo _UR_UPDATE1;?>" /></td>
      <td><a href="index.php?do=groups" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>

  <input name="groupid" type="hidden" value="<?php echo $_GET['groupid'];?>" />
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
<?php echo $core->doForm("processGroup");?>
<?php break;?>

<?php //--------------------------End of groups editing--------------------------------------/// ?>
<?php

    case"add":  ?>


<?php //------------------------------------Adding groups-------------------------------------// ?>


<h1><img src="images/groups_small.png" alt="" /><?php echo _UR_TITLE21;?></h1>
<p class="info"><?php echo _UR_INFO21. '<br>'._REQ1. required() . _REQ2;?></p>
<h2><?php echo _UR_SUBTITLE21;?></h2>
<form action="" method="post" id="admin_form" name="admin_form"  enctype="multipart/form-data">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="250"><?php echo _GROUPNAME;?>: <?php echo required();?></td>
      <td><input name="dep_name" type="text" class="inputbox"  id="dep_name" size="55" /></td>
    </tr>

    <tr>
      <td><?php echo _UR_EMAIL;?>: <?php echo required();?></td>
      <td><input name="dep_email_address" type="text" class="inputbox" size="55" /></td>
    </tr>


    <tr>
      <td rowspan="9"><?php echo _UR_PERM1;?>: <?php echo required();?></td>
    </tr>
      <?php $menus = $db->fetch_all("SELECT id , name_en FROM menus WHERE id IN ( 24,27,28,29,30,31,33,34 )"); ?>

      <?php foreach($menus as $menu): ?>
      <tr><td><input type="checkbox" name="menu[<?php echo $menu['id'] ?>]" /><?php echo $menu['name_en'] ?></td></tr>
      <?php endforeach; ?>
    <tr>
        <td>Page Management:</td>
        <td>
            <span class="input-out">
                <label for="pm1">Yes</label>
                <input type="radio" id="pm1" name="can_manage_pages" value="1" />
                <label for="pm2">No</label>
                <input type="radio" id="pm2" name="can_manage_pages" value="0" checked="checked" />
            </span>
        </td>
    </tr>

      <tr>
          <td rowspan="6">Events/Calendars: <?php echo required();?></td>
      </tr>

          <?php $events = $db->fetch_all("SELECT id , event_name FROM event_types "); ?>
              <?php foreach($events as $event): ?>
             <tr><td> <input type="checkbox" name="event[<?php echo $event['id'] ?>]"/><?php echo $event['event_name'] ?></td></tr>
              <?php endforeach; ?>


      <tr>
          <td>Press Room:</td>
          <td>
            <span class="input-out">
                <label for="pr1">Yes</label>
                <input type="radio" id="pr1" name="dep_can_manage_press_room" value="y" />
                <label for="pr2">No</label>
                <input type="radio" id="pr2" name="dep_can_manage_press_room" value="n" checked="checked" />
            </span>
          </td>
      </tr>

      <tr>
          <td>Belmar Alerts:</td>
          <td>
            <span class="input-out">
                <label for="al1">Yes</label>
                <input type="radio" id="al1" name="dep_can_manage_belmar_alerts" value="y" />
                <label for="al2">No</label>
                <input type="radio" id="al2" name="dep_can_manage_belmar_alerts" value="n" checked="checked" />
            </span>
          </td>
      </tr>

      <tr>
          <td rowspan="9">Gallery: <?php echo required();?></td>
      </tr>
      <?php $galls = $db->fetch_all("SELECT id , name_en FROM menus WHERE id IN ( 24,27,28,29,30,31,33,34 )"); ?>

      <?php foreach($galls as $gall): ?>
        <tr><td><input type="checkbox" name="gallery[<?php echo $gall['id'] ?>]"/><?php echo $gall['name_en'] ?></td></tr>
      <?php endforeach; ?>

      <tr>
          <td rowspan="6">From Submission & Lists</td>
          <td><input type="checkbox" name="dep_can_view_all_contact_lists" /> Contact Form - All</td>
      </tr>
      <tr>
          <td><input type="checkbox" name="dep_can_view_own_contact_lists" /> Contact Form - For Department Only </td>
      </tr>
      <tr>
          <td><input type="checkbox" name="dep_can_view_mailing_list" /> Mailing List</td>
      </tr>
      <tr>
          <td><input type="checkbox" name="dep_can_view_get_alerts_list" /> Get Belmar Alerts List</td>
      </tr>
      <tr>
          <td><input type="checkbox" name="dep_can_view_belmar_survey_list	" /> Belmar Survey List</td>
      </tr>
      <tr>
          <td><input type="checkbox" name="dep_can_view_opt_out_list" /> Opt-Out List</td>
      </tr>
      <tr>
          <td><input type="checkbox" name="dep_can_view_public_works_list" <?php if($row['permissions']['dep_can_view_public_works_list']=='y') echo "checked='checked'" ?>  /> Public Works List</td>
      </tr>

    <tr>
        <td rowspan="3">Email System & Templates</td>
        <td><input type="checkbox" name="dep_can_send_lists_emails" /> Send Emails</td>
    </tr>
    <tr>
        <td><input type="checkbox" name="dep_can_edit_email_templates" /> Email Templates</td>
    </tr>
    <tr>
        <td><input type="checkbox" name="dep_can_edit_auto_response" /> Automatic Response Emails</td>
    </tr>

      <tr>
          <td>Create Sub-Level CMS Administrators</td>
          <td>
            <span class="input-out">
                <label for="create1">Yes</label>
                <input type="radio" id="create1" name="dep_can_create_users" value="1" />
                <label for="create2">No</label>
                <input type="radio" id="create2" name="dep_can_create_users" value="0" checked="checked" />
            </span>
          </td>
      </tr>

    <tr>
      <td><input type="submit" name="dosubmit" class="button" value="<?php echo _UR_ADD1;?>" /></td>
      <td><a href="index.php?do=groups" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
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
<?php echo $core->doForm("processGroup");?>
<?php break;?>

<?php //----------------------------End adding--------------------------------------// ?>
<?php //----------------------------Show users--------------------------------------// ?>

<?php

    case "showUsers":?>
<h1><img src="images/groups_small.png" alt="" /><?php echo _UR_TITLE31;?></h1>
<p class="info"><?php echo _UR_INFO32;?></p>
<table cellpadding="0" cellspacing="0" class='display'>
    <thead>
    <tr>
        <th width="20">#</th>
        <th align="center"><?php echo _UR_USERNAME; ?></th>
        <th align="center"><?php echo _UR_FNAME; ?></th>
        <th align="center"><?php echo _UR_LNAME; ?></th>
        <th align="center"><?php echo _UR_EMAIL; ?></th>
        <th align="center"><?php echo _UR_LASTLOGIN; ?></th>
    </tr>
    </thead>
    <?php if(!isset($_GET['groupid']) || empty($_GET['groupid'])) exit('Invalid call!'); ?>
    <?php require_once HCODE .'lib/groups.php' ;?>
    <?php $users = Groups::getUsers($_GET['groupid']); ?>
    <? if(empty($users)) echo '<tr><td colspan="5">'. _UR_NOUSERS.'</td></tr>'; ?>
    <?php foreach($users as $user): ?>

    <tr>
        <td align="center"><?php echo $user['id']; ?></td>
        <td align="center"><?php echo $user['username']; ?></td>
        <td align="center"><?php echo $user['fname']; ?></td>
        <td align="center"><?php echo $user['lname']; ?></td>
        <td align="center"><?php echo $user['email']; ?></td>
        <td align="center"><?php echo $user['lastlogin']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php break;?>

<?php //----------------------------End Showing users--------------------------------------// ?>

<?php

    default:?>

<?php //--------------------------------Showing groups----------------------------------// ?>


<?php  $grouprow = $user->getGroups();?>
<h1><img src="images/groups_small.png" alt="" /><?php echo _UR_TITLE31;?></h1>
<p class="info"><?php echo _UR_INFO31;?></p>
<h2><span><a href="index.php?do=groups&amp;action=add" class="button-sml"><?php echo _UR_ADD1;?></a></span><?php echo _UR_SUBTITLE31;?></h2>
<div class="box">
  <table cellpadding="0" cellspacing="0" class="formtable">
    <tr style="background-color:transparent">
      <td style="position:relative">

              <input name="search" type="text" class="inputbox" id="search-input" size="40" style="width:240px" />
              <input type="submit" value="Go" class="button-sml" onclick="location.href='<?php echo ADMINURL ?>/index.php?do=groups&search=' + $('#search-input').val()">

        <div id="suggestions"></div></td>
      <td align="center"><form action="" method="post" id="dForm">
          <strong> <?php echo _UR_SHOW_FROM;?></strong>
          <input name="fromdate" type="text" style="margin-right:3px" class="inputbox" size="10" id="fromdate" />
          <strong> <?php echo _UR_SHOW_TO;?></strong>
          <input name="enddate" type="text" class="inputbox" size="10" id="enddate" />
          <input name="find" type="submit" class="button-sml" value="<?php echo _UR_FIND;?>" />
        </form></td>
      <td align="right">
          <strong><?php echo _UR_USR_FILTER1;?>:</strong>&nbsp;&nbsp;
          <select name="sort" onchange="if(this.value!='NA') window.location='index.php?do=groups&amp;sort='+this[this.selectedIndex].value; else window.location='index.php?do=groups';" style="width:220px" class="custombox">
            <option value="NA"><?php echo _UR_RESET_FILTER1;?></option>
            <?php echo $user->getGroupFilter();?>
          </select>
        </td>
    </tr>
    <tr style="background-color:transparent">
      <td colspan="2"></td>
      <td align="right"><?php echo $pager->items_per_page();?> &nbsp;&nbsp;
        <?php if($pager->num_pages >= 1) echo $pager->jump_menu();?></td>
    </tr>
  </table>
</div>
<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
      <th width="20">#</th>
      <th class="left"><?php echo _GROUPNAME;?></th>

      <th># of users</th>
      <th><?php echo _UR_DATE_CREATED;?></th>

      <th><?php echo _UR_VIEWEDITDELETEGROUP;?></th>
    </tr>
  </thead>
  <tbody>
    <?php if($grouprow == 0):?>
    <tr>
      <td colspan="8"><?php echo $core->msgAlert(_UR_NOGROUP,false);?></td>
    </tr>
    <?php else:?>
    <?php foreach ($grouprow as $row):?>
    <tr>
      <td align="center"><?php echo $row['id'];?>.</td>
<!--      <td><a href="index.php?do=groups&amp;action=edit&amp;groupid=--><?php //echo $row['id'];?><!--">--><?php //echo $row['dep_name'];?><!--</a></td>-->
      <td><?php echo $row['dep_name'];?></a></td>
        <?php require_once HCODE .'lib/groups.php' ;?>
      <td align="center"><?php echo Groups::countUsers($row['id']); ?></td>
      <td align="center"><?php echo dodate($core->long_date, $row['created']);?></td>


      <td align="center"><a href="index.php?do=groups&amp;action=showUsers&amp;groupid=<?php echo $row['id'];?>"><img src="images/user.png" class="tooltip"  alt="" title="<?php echo _UR_VIEW1;?>"/></a>     /
      <a href="index.php?do=groups&amp;action=edit&amp;groupid=<?php echo $row['id'];?>"><img src="images/edit.png" class="tooltip"  alt="" title="<?php echo _UR_EDIT1;?>"/></a>                            /
      <a href="javascript:void(0);" class="delete" rel="<?php echo $row['dep_name'];?>" id="item_<?php echo $row['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo _DELETE;?>"/></a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($row);?>
    <?php if($pager->items_total >= $pager->items_per_page):?>
    <tr style="background-color:transparent">
      <td colspan="8" style="padding:10px;"><div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
    </tr>
    <?php endif;?>
    <?php endif;?>
  </tbody>
</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '._GROUP;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM_GROUP;?></p>
</div>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {
    $("#search-input").watermark("<?php echo _UR_FIND_UNAME1;?>");
    $("#search-input").keyup(function () {
        var srch_string = $(this).val();
        var data_string = 'groupSearch=' + srch_string;
        if (srch_string.length > 3) {
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: data_string,
                beforeSend: function () {
                    $('#search-input').addClass('loading');
                },
                success: function (res) {
                    $('#suggestions').html(res).show();
                    $("input").blur(function () {
                        $('#suggestions').customFadeOut();
                    });
                    if ($('#search-input').hasClass("loading")) {
                        $("#search-input").removeClass("loading");
                    }
                }
            });
        }
        return false;
    });
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
                    data: 'deleteGroup=' + id + '&dep_name=' + title,
                    beforeSend: function () {
                        parent.animate({
                            'backgroundColor': '#FFBFBF'
                        }, 400);
                    },
                    success: function (msg) {
                        parent.fadeOut(400, function () {
                            parent.remove();
                        });
                        $("html, body").animate({
                            scrollTop: 0
                        }, 600);
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
$(function () {
    var dates = $('#fromdate, #enddate').datepicker({
        defaultDate: "+1w",
        changeMonth: false,
        numberOfMonths: 2,
        dateFormat: 'yy-mm-dd',
        onSelect: function (selectedDate) {
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