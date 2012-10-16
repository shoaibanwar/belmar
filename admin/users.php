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
	  
  if(!$user->checkOperationPermission("users")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<?php switch($core->action):

    case "edit": ?>

<?php //---------------------------------Edit-------------------------------------------------------------// ?>

<?php if(!$user->checkOperationPermission('user')): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;  ?>

<?php $row = $user->getUpdateItems($user->userid,'users');?>

<?php //$memrow = $member->getMemberships();?>
<h1><img src="images/users-sml.png" alt="" /><?php echo _UR_TITLE1;?></h1>
<p class="info"><?php echo _UR_INFO1. _REQ1. required() . _REQ2;?></p>
<h2><?php echo _UR_SUBTITLE1 . $row['depData']['username'];?></h2>

<form action="" method="post" id="admin_form" name="admin_form"  enctype="multipart/form-data">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo _USERNAME;?>: </td>
      <td><input name="username" type="text" disabled="disabled" class="inputbox" value="<?php echo $row['depData']['username'];?>" size="55" readonly="readonly" /></td>
    </tr>
    <tr>
      <td><?php echo _PASSWORD;?>:</td>
      <td><input name="password" type="text" class="inputbox" size="55" />
        <?php echo tooltip(_UR_PASS_T);?></td>
    </tr>
      <?php if($user->userid != $user->uid): ?>
    <tr>
      <td><?php echo _UR_EMAIL;?>: <?php echo required();?></td>
      <td><input name="email" type="text" class="inputbox" value="<?php echo $row['depData']['email'];?>" size="55"/></td>
    </tr>
        <?php endif; ?>
    <tr>
      <td><?php echo _UR_FNAME;?>: <?php echo required();?></td>
      <td><input name="fname" type="text" class="inputbox" value="<?php echo $row['depData']['fname'];?>" size="55" /></td>
    </tr>
    <tr>
      <td><?php echo _UR_LNAME;?>: <?php echo required();?></td>
      <td><input name="lname" type="text" class="inputbox" value="<?php echo $row['depData']['lname'];?>" size="55" /></td>
    </tr>
      <tr>
          <td><?php echo _ADDRESS;?></td>
          <td><input name="address" type="text" class="inputbox" value="<?php echo $row['depData']['address'];?>" size="55" /></td>
      </tr>
      <tr>
          <td><?php echo _CITY;?></td>
          <td><input name="city" type="text" class="inputbox" value="<?php echo $row['depData']['city'];?>" size="55" /></td>
      </tr>
      <tr>
          <td><?php echo _STATE;?></td>
          <td><input name="state" type="text" class="inputbox"  value="<?php echo $row['depData']['state'];?>"  size="55" /></td>
      </tr>
      <tr>
          <td><?php echo _ZIPCODE;?></td>
          <td><input name="zipcode" type="text" class="inputbox"  value="<?php echo $row['depData']['zipcode'];?>" size="55" /></td>
      </tr>
      <tr>
          <td><?php echo _PHONE;?></td>
          <td><input name="phone" type="text" class="inputbox"  value="<?php echo $row['depData']['phone'];?>" size="55" /></td>
      </tr>
      <tr>
          <td><?php echo _MOBILE;?></td>
          <td><input name="mobile" type="text" class="inputbox"  value="<?php echo $row['depData']['mobile'];?>" size="55" /></td>
      </tr>
      <tr>
          <td><?php echo _FAX;?></td>
          <td><input name="fax" type="text" class="inputbox"   value="<?php echo $row['depData']['fax'];?>" size="55" /></td>
      </tr>
    <?php if($user->userid != $user->uid): ?>
      <tr>
          <td><?php echo _DEP;?>:</td>
          <td><select name="department_id" class="custombox" style="width:250px">
              <option value="0"><?php echo _UR_NODEPARTMENT;?></option>
              <?php $deps = Users::getDepartments();?>
              <?php foreach($deps as $department):?>
                <?php if(isset($_GET['userid']) && $department['id'] == $user->getUserDepartment($_GET['userid'])): ?>
                    <option value="<?php echo $department['id'];?>" selected="selected"><?php echo $department['dep_name'];?></option>
                <?php else: ?>
                    <option value="<?php echo $department['id'];?>"><?php echo $department['dep_name'];?></option>
                <?php endif;?>
              <?php endforeach;?>
          </select></td>
      </tr>
    <tr>
      <td><?php echo _UR_LEVEL;?>:</td>
      <td><span class="input-out">
        <label for="userlevel-2"><?php echo _UR_ADMIN;?></label>
        <input name="userlevel" type="radio" id="userlevel-2" value="8" <?php getChecked($row['depData']['userlevel'], 8); ?> />
        <label for="userlevel-3"><?php echo _SUBADMIN;?></label>
        <input name="userlevel" type="radio" id="userlevel-3" value="7" <?php getChecked($row['depData']['userlevel'], 7); ?> />
        <?php echo tooltip(_UR_ADMIN_T);?></span></td>
    </tr>

      <tr>
          <td><?php echo _UR_PERMISSION1;?></td>
          <td><span class="input-out">
        <label for="en_c"><?php echo _YES;?></label>
        <input id="en_c" type="radio" name="custom_permissions"  value="y" class='enable_cust_permissions' <?php echo $user->userHasPermissions($user->userid)?"checked='checked'":"" ?> />
        <label for="dis_c"><?php echo _NO;?></label>
        <input id="dis_c" type="radio" name="custom_permissions"  value="n" class='disable_cust_permissions' <?php echo $user->userHasPermissions($user->userid)?"":"checked='checked'" ?>/>
        </span></td>
      </tr>


        <?php //-----------------------start permissions-------------------------------------------------------------------------------------------------- ?>

    <tr class="permission">
        <td rowspan="9"><?php echo _UR_PERM1;?>: <?php echo required();?></td>
    </tr>
        <?php $menus = $db->fetch_all("SELECT id , name_en FROM menus WHERE id IN ( 24,27,28,29,30,31,33,34 )"); ?>

        <?php foreach($menus as $menu): ?>
        <tr class="permission"><td><input <?php if(in_array_recursive($menu['id'],$row['menus'])) echo "checked='checked'" ?> type="checkbox" name="menu[<?php echo $menu['id'] ?>]" /><?php echo $menu['name_en'] ?></td></tr>
            <?php endforeach; ?>
    <tr class="permission">
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

    <tr class="permission">
        <td rowspan="6">Events/Calendars: <?php echo required();?></td>
    </tr>
        <?php $events = $db->fetch_all("SELECT id , event_name FROM event_types "); ?>
        <?php foreach($events as $event): ?>
        <tr class="permission"><td> <input <?php if(in_array_recursive($event['id'],$row['events'])) echo "checked='checked'" ?> type="checkbox" name="event[<?php echo $event['id'] ?>]"/><?php echo $event['event_name'] ?></td></tr>
            <?php endforeach; ?>


    <tr class="permission">
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

    <tr class="permission">
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

    <tr class="permission">
        <td rowspan="9">Gallery: <?php echo required();?></td>
    </tr>
        <?php $galls = $db->fetch_all("SELECT id , name_en FROM menus WHERE id IN ( 24,27,28,29,30,31,33,34 )"); ?>

        <?php foreach($galls as $gall): ?>
        <tr class="permission"><td><input <?php if(in_array_recursive($gall['id'],$row['galleries'])) echo "checked='checked'" ?> type="checkbox" name="gallery[<?php echo $gall['id'] ?>]"/><?php echo $gall['name_en'] ?></td></tr>
            <?php endforeach; ?>

    <tr class="permission">
        <td rowspan="7">From Submission & Lists</td>
        <td><input type="checkbox" name="dep_can_view_all_contact_lists" <?php if($row['permissions']['dep_can_view_all_contact_lists']=='y') echo "checked='checked'" ?>  /> Contact Form - All</td>
    </tr>
    <tr class="permission">
        <td><input type="checkbox" name="dep_can_view_own_contact_lists" <?php if($row['permissions']['dep_can_view_own_contact_lists']=='y') echo "checked='checked'" ?>  /> Contact Form - For Department Only </td>
    </tr>
    <tr class="permission">
        <td><input type="checkbox" name="dep_can_view_mailing_list" <?php if($row['permissions']['dep_can_view_mailing_list']=='y') echo "checked='checked'" ?>  /> Mailing List</td>
    </tr>
    <tr class="permission">
        <td><input type="checkbox" name="dep_can_view_get_alerts_list" <?php if($row['permissions']['dep_can_view_get_alerts_list']=='y') echo "checked='checked'" ?>  /> Get Belmar Alerts List</td>
    </tr>
    <tr class="permission">
        <td><input type="checkbox" name="dep_can_view_belmar_survey_list" <?php if($row['permissions']['dep_can_view_belmar_survey_list']=='y') echo "checked='checked'" ?>  /> Belmar Survey List</td>
    </tr>
    <tr class="permission">
        <td><input type="checkbox" name="dep_can_view_opt_out_list" <?php if($row['permissions']['dep_can_view_opt_out_list']=='y') echo "checked='checked'" ?>  /> Opt-Out List</td>
    </tr>
    <tr class="permission">
        <td><input type="checkbox" name="dep_can_view_public_works_list" <?php if($row['permissions']['dep_can_view_public_works_list']=='y') echo "checked='checked'" ?>  /> Public Works List</td>
    </tr>

    <tr class="permission">
        <td rowspan="3">Email System & Templates</td>
        <td><input type="checkbox" name="dep_can_send_lists_emails" <?php if($row['permissions']['dep_can_send_lists_emails']=='y') echo "checked='checked'" ?> /> Send Emails</td>
    </tr>
    <tr class="permission">
        <td><input type="checkbox" name="dep_can_edit_email_templates" <?php if($row['permissions']['dep_can_edit_email_templates']=='y') echo "checked='checked'" ?> /> Email Templates</td>
    </tr>
    <tr class="permission">
        <td><input type="checkbox" name="dep_can_edit_auto_response" <?php if($row['permissions']['dep_can_edit_auto_response']=='y') echo "checked='checked'" ?> /> Automatic Response Emails</td>
    </tr>
        <?php //-----------------------end permissions-------------------------------------------------------------------------------------------------- ?>


    <tr>
      <td><?php echo _UR_STATUS;?>:</td>
      <td><span class="input-out">
        <label for="active-1"><?php echo _USER_A;?></label>
        <input name="active" type="radio" id="active-1" value="y" <?php getChecked($row['depData']['active'], "y"); ?> />
        <label for="active-2"><?php echo _USER_I;?></label>
        <input name="active" type="radio" id="active-2" value="n" <?php getChecked($row['depData']['active'], "n"); ?> />
        </span></td>
    </tr>

      <?php endif; ?>
    <tr>
      <td><?php echo _UR_DATE_REGGED;?>:</td>
      <td><span class="input-out"><?php echo dodate($core->long_date, $row['depData']['created']);?></span></td>
    </tr>
    <tr>
      <td><?php echo _UR_LASTLOGIN;?>:</td>
      <td><span class="input-out"><?php echo dodate($core->long_date, $row['depData']['lastlogin']);?></span></td>
    </tr>
    <tr>
      <td><?php echo _UR_LASTLOGIN_IP;?>:</td>
      <td><span class="input-out"><?php echo $row['depData']['lastip'];?></span></td>
    </tr>
    <tr>
      <td><input type="submit" name="dosubmit" class="button" value="<?php echo _UR_UPDATE;?>" /></td>
      <td><a href="index.php?do=users" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
  <input name="username" type="hidden" value="<?php echo $row['depData']['username'];?>" />
  <input name="userid" type="hidden" value="<?php echo $user->userid;?>" />
</form>
<script type="text/javascript"> 
// <![CDATA[
  $(".mask").filestyle({ 
	  image: "images/file-button.png",
	  imageheight : 29,
	  imagewidth : 75,
	  width : 230
  });
$(document).ready(function(){
    <?php if (!$user->userHasPermissions($user->userid)): ?>
    $(".permission").hide();
    <?php endif;?>
    $('#en_c').click(function(){$(".permission").show()})
    $("#dis_c").click(function(){$(".permission").hide()})
})
// ]]>
</script> 
<?php echo $core->doForm("processUser");?>
<?php break;?>

<?php

    case"add": ?>

<?php //---------------------------------Add-------------------------------------------------------------// ?>

<?php if( $user->department_id == '0' && $user->userlevel !=9): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif; ?>

<h1><img src="images/users-sml.png" alt="" /><?php echo _UR_TITLE2;?></h1>
<p class="info"><?php echo _UR_INFO2. _REQ1. required() . _REQ2;?></p>
<h2><?php echo _UR_SUBTITLE2;?></h2>
<form action="" method="post" id="admin_form" name="admin_form"  enctype="multipart/form-data">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo _USERNAME;?>: <?php echo required();?></td>
      <td><input name="username" type="text" class="inputbox"  id="username" size="55" /></td>
    </tr>
    <tr>
      <td><?php echo _PASSWORD;?>: <?php echo required();?></td>
      <td><input name="password" type="password" class="inputbox" size="55" /></td>
    </tr>
    <tr>
      <td><?php echo _UR_EMAIL;?>: <?php echo required();?></td>
      <td><input name="email" type="text" class="inputbox" size="55" /></td>
    </tr>
    <tr>
      <td><?php echo _UR_FNAME;?>: <?php echo required();?></td>
      <td><input name="fname" type="text" class="inputbox" size="55"/></td>
    </tr>
    <tr>
      <td><?php echo _UR_LNAME;?>: <?php echo required();?></td>
      <td><input name="lname" type="text" class="inputbox" size="55" /></td>
    </tr>
      <tr>
          <td><?php echo _ADDRESS;?></td>
          <td><input name="address" type="text" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td><?php echo _CITY;?></td>
          <td><input name="city" type="text" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td><?php echo _STATE;?></td>
          <td><input name="state" type="text" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td><?php echo _ZIPCODE;?></td>
          <td><input name="zipcode" type="text" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td><?php echo _PHONE;?></td>
          <td><input name="phone" type="text" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td><?php echo _MOBILE;?></td>
          <td><input name="mobile" type="text" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td><?php echo _FAX;?></td>
          <td><input name="fax" type="text" class="inputbox" size="55" /></td>
      </tr>
    <tr>
      <td><?php echo _DEP;?>:</td>
      <td><select name="department_id" class="custombox" style="width:250px">
          <option value="0"><?php echo _UR_NODEPARTMENT;?></option>
          <?php $deps = Users::getDepartments();?>
          <?php foreach($deps as $department):?>
          <option value="<?php echo $department['id'];?>"><?php echo $department['dep_name'];?></option>
          <?php endforeach;?>
        </select></td>
    </tr>
    <tr>
      <td><?php echo _UR_LEVEL;?>:</td>
      <td><span class="input-out">
        <label for="userlevel-2"><?php echo _UR_ADMIN;?></label>
        <input name="userlevel" type="radio" id="userlevel-2" value="8" />
        <label for="userlevel-3"><?php echo _SUBADMIN;?></label>
        <input name="userlevel" type="radio" id="userlevel-3" value="7" checked="checked" />
        <?php echo tooltip(_UR_ADMIN_T);?></span></td>
    </tr>
      <tr>
          <td>Should the user have his own permissions?</td>
          <td><span class="input-out">
        <label for="en_c"><?php echo _YES;?></label>
        <input id="en_c" type="radio" name='permissions' value="y" class='enable_cust_permissions'  />
        <label for="dis_c"><?php echo _NO;?></label>
        <input id="dis_c" type="radio" name='permissions'  value="n" class='disable_cust_permissions' checked="checked"/>
        </span></td>
      </tr>

<?php //-----------------------start permissions-------------------------------------------------------------------------------------------------- ?>

      <tr class="permission">
          <td rowspan="9"><?php echo _UR_PERM1;?>: <?php echo required();?></td>
      </tr>
      <?php $menus = $db->fetch_all("SELECT id , name_en FROM menus WHERE id IN ( 24,27,28,29,30,31,33,34 )"); ?>

      <?php foreach($menus as $menu): ?>
      <tr class="permission"><td><input type="checkbox" name="menu[<?php echo $menu['id'] ?>]" /><?php echo $menu['name_en'] ?></td></tr>
      <?php endforeach; ?>
      <tr class="permission">
          <td>Page Management:</td>
          <td>
            <span class="input-out">
                <label for="pm1">Yes</label>
                <input type="radio" id="pm1" name="can_manage_pages" value="y" />
                <label for="pm2">No</label>
                <input type="radio" id="pm2" name="can_manage_pages" value="n" checked='checked' />
            </span>
          </td>
      </tr>

      <tr class="permission">
          <td rowspan="6">Events/Calendars: <?php echo required();?></td>
      </tr>

      <?php $events = $db->fetch_all("SELECT id , event_name FROM event_types "); ?>
      <?php foreach($events as $event): ?>
      <tr class="permission"><td> <input  type="checkbox" name="event[<?php echo $event['id'] ?>]"/><?php echo $event['event_name'] ?></td></tr>
      <?php endforeach; ?>


      <tr class="permission">
          <td>Press Room:</td>
          <td>
            <span class="input-out">
                <label for="pr1">Yes</label>
                <input type="radio" id="pr1" name="dep_can_manage_press_room" value="y"  />
                <label for="pr2">No</label>
                <input type="radio" id="pr2" name="dep_can_manage_press_room" value="n"  checked='checked' />
            </span>
          </td>
      </tr>

      <tr class="permission">
          <td>Belmar Alerts:</td>
          <td>
            <span class="input-out">
                <label for="al1">Yes</label>
                <input type="radio" id="al1" name="dep_can_manage_belmar_alerts" value="y"  />
                <label for="al2">No</label>
                <input type="radio" id="al2" name="dep_can_manage_belmar_alerts" value="n" />
            </span>
          </td>
      </tr>

      <tr class="permission">
          <td rowspan="9">Gallery: <?php echo required();?></td>
      </tr>
      <?php $galls = $db->fetch_all("SELECT id , name_en FROM menus WHERE id IN ( 24,27,28,29,30,31,33,34 )"); ?>

      <?php foreach($galls as $gall): ?>
      <tr class="permission"><td><input  type="checkbox" name="gallery[<?php echo $gall['id'] ?>]"/><?php echo $gall['name_en'] ?></td></tr>
      <?php endforeach; ?>

      <tr class="permission">
          <td rowspan="7">From Submission & Lists</td>
          <td><input type="checkbox" name="dep_can_view_all_contact_lists"  /> Contact Form - All</td>
      </tr>
      <tr class="permission">
          <td><input type="checkbox" name="dep_can_view_own_contact_lists"   /> Contact Form - For Department Only </td>
      </tr>
      <tr class="permission">
          <td><input type="checkbox" name="dep_can_view_mailing_list"  /> Mailing List</td>
      </tr>
      <tr class="permission">
          <td><input type="checkbox" name="dep_can_view_get_alerts_list"   /> Get Belmar Alerts List</td>
      </tr>
      <tr class="permission">
          <td><input type="checkbox" name="dep_can_view_belmar_survey_list"   /> Belmar Survey List</td>
      </tr>
      <tr class="permission">
          <td><input type="checkbox" name="dep_can_view_opt_out_list"  /> Opt-Out List</td>
      </tr>
      <tr class="permission">
          <td><input type="checkbox" name="dep_can_view_public_works_list"  /> Public Works List</td>
      </tr>

      <tr class="permission">
          <td rowspan="3">Email System & Templates</td>
          <td><input type="checkbox" name="dep_can_send_lists_emails"  /> Send Emails</td>
      </tr>
      <tr class="permission">
          <td><input type="checkbox" name="dep_can_edit_email_templates"  /> Email Templates</td>
      </tr>
      <tr class="permission">
          <td><input type="checkbox" name="dep_can_edit_auto_response" /> Automatic Response Emails</td>
      </tr>
<?php //-----------------------end permissions-------------------------------------------------------------------------------------------------- ?>


      <tr>
          <td><?php echo _UR_STATUS;?>:</td>
          <td><span class="input-out">
        <label for="active-1"><?php echo _USER_A;?></label>
        <input name="active" type="radio" id="active-1" value="y" checked="checked" />
        <label for="active-2"><?php echo _USER_I;?></label>
        <input name="active" type="radio" id="active-2" value="n" />
        </span></td>
      </tr>
      <tr>
          <td><?php echo _UR_NOTIFY;?>:</td>
          <td><span class="input-out">
        <input type="checkbox" class="checkbox" name="notify" value="1" />
              <?php echo tooltip(_UR_NOTIFY_T);?></span></td>
      </tr>
    <tr>
      <td><input type="submit" name="dosubmit" class="button" value="<?php echo _UR_ADD;?>" /></td>
      <td><a href="index.php?do=users" class="button-alt"><?php echo _CANCEL;?></a></td>
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

$(document).ready(function(){
    $(".permission").hide()  ;
    $('#en_c').parent('div.ez-radio').click(function(){$(".permission").show()})
    $("#dis_c").click(function(){$(".permission").hide()})
})
// ]]>
</script> 
<?php echo $core->doForm("processUser");?>
<?php break;?>
<?php

    default:?>

<?php //---------------------------------Show-------------------------------------------------------------// ?>
<?php  $userrow = $user->getUsers();?>
<h1><img src="images/users-sml.png" alt="" /><?php echo _UR_TITLE3;?></h1>
<p class="info"><?php echo _UR_INFO3;?></p>
    <?php if($user->userlevel ==9 || ($user->department_id != '0' && $user->userlevel ==8)): ?>
<h2><span><a href="index.php?do=users&amp;action=add" class="button-sml"><?php echo _UR_ADD;?></a></span><?php echo _UR_SUBTITLE3;?></h2>
    <?php endif; ?>
<div class="box">
  <table cellpadding="0" cellspacing="0" class="formtable">
    <tr style="background-color:transparent">
      <td style="position:relative"><input name="search" type="text" class="inputbox" id="search-input" size="40" style="width:240px" onclick="disAutoComplete(this);"/>
        <div id="suggestions"></div></td>
      <td align="center"><form action="" method="post" id="dForm">
          <strong> <?php echo _UR_SHOW_FROM;?></strong>
          <input name="fromdate" type="text" style="margin-right:3px" class="inputbox" size="10" id="fromdate" />
          <strong> <?php echo _UR_SHOW_TO;?></strong>
          <input name="enddate" type="text" class="inputbox" size="10" id="enddate" />
          <input name="find" type="submit" class="button-sml" value="<?php echo _UR_FIND;?>" />
        </form></td>
      <td align="right">
          <strong><?php echo _UR_USR_FILTER;?>:</strong>&nbsp;&nbsp;
          <select name="sort" onchange="if(this.value!='NA') window.location='index.php?do=users&amp;sort='+this[this.selectedIndex].value; else window.location='index.php?do=users';" style="width:220px" class="custombox">
            <option value="NA"><?php echo _UR_RESET_FILTER;?></option>
            <?php echo $user->getUserFilter();?>
          </select>
        </td>
    </tr>
    <tr style="background-color:transparent">
      <td colspan="2">
          <img src="images/u_active.png" class="tooltip" alt="" title="<?php echo _USER_A;?>"/> <?php echo _USER_A;?>
          <img src="images/u_inactive.png" class="tooltip" alt="" title="<?php echo _USER_I;?>"/> <?php echo _USER_I;?>
<!--          <img src="images/u_pending.png" class="tooltip" alt="" title="--><?php //echo _USER_P;?><!--"/> --><?php //echo _USER_P;?><!-- -->
<!--          <img src="images/u_banned.png" class="tooltip" alt="" title="--><?php //echo _USER_B;?><!--"/> --><?php //echo _USER_B;?>
      </td>
      <td align="right"><?php echo $pager->items_per_page();?> &nbsp;&nbsp;
        <?php if($pager->num_pages >= 1) echo $pager->jump_menu();?></td>
    </tr>
  </table>
</div>
<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
      <th width="20">#</th>
      <th class="left"><?php echo _USERNAME;?></th>
      <th class="left"><?php echo _UR_NAME;?></th>
        <th>E-mail</th>
        <th><?php echo _UR_DEPARTMENT;?></th>
        <th>Last Login</th>
      <th><?php echo _UR_STATUS;?></th>
      <th><?php echo _UR_LEVEL;?></th>
      <th>View</th>
      <th><?php echo _UR_EDIT;?></th>
      <th><?php echo _DELETE;?></th>
    </tr>
  </thead>
  <tbody>
    <?php if($userrow == 0):?>
    <tr>
      <td colspan="8"><?php echo $core->msgAlert(_UR_NOUSER,false);?></td>
    </tr>
    <?php else:?>
    <?php foreach ($userrow as $row):?>
    <tr>
      <td align="center"><?php echo $row['id'];?>.</td>
      <td><?php echo $row['username'];?></td>
      <td><?php echo $row['name'];?></td>
        <td align="center"><?php echo $row['email'];?></td>
        <td align="center"><?php echo Users::getDepartmentName($row['department_id']);?></td>
        <td align="center"><?php echo $row['lastlogin'];?></td>
      <td align="center"><?php echo userStatus($row['active']);?></td>
      <td align="center"><?php echo isAdmin($row['userlevel']);?></td>
        <td align="center"><a href="index.php?do=user&amp;userid=<?php echo $row['id'];?>"><img src="images/view.png" class="tooltip"  alt="" title="view"/></a></td>
      <td align="center"><a href="index.php?do=users&amp;action=edit&amp;userid=<?php echo $row['id'];?>"><img src="images/edit.png" class="tooltip"  alt="" title="<?php echo _UR_EDIT;?>"/></a></td>
      <td align="center"><?php if($row['id'] == 1):?>
        <img src="images/delete.png" class="tooltip"  alt="" title="<?php echo _DELETE;?>"/>
        <?php else:?>
        <a href="javascript:void(0);" class="delete" rel="<?php echo $row['username'];?>" id="item_<?php echo $row['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo _DELETE;?>"/></a>
        <?php endif;?></td>
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
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '._USER;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {
    $("#search-input").watermark("<?php echo _UR_FIND_UNAME;?>");
    $("#search-input").keyup(function () {
        var srch_string = $(this).val();
        var data_string = 'userSearch=' + srch_string;
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
                    data: 'deleteUser=' + id + '&username=' + title,
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
<?php
endswitch;?>
