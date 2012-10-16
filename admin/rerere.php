<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HollyCode2
 * Date: 6/20/12
 * Time: 11:01 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<h1><img src="images/users-sml.png" alt="" /><?php echo _UR_TITLE22;?></h1>
<p class="info"><?php echo _UR_INFO1. _REQ1. required() . _REQ2;?></p>


<?php $row = $core->getRowById("users", $user->userid);?>
<h2><?php echo _UR_SUBTITLE1 . $row['username'];?></h2>
<form action="" method="post" id="admin_form" name="admin_form"  enctype="multipart/form-data">
    <table cellspacing="0" cellpadding="0" class="formtable">
        <tr>
            <td width="200"><?php echo _USERNAME;?>: </td>
            <td><?php echo $row['username'];?></td>
        </tr>
        <tr>
            <td><?php echo _UR_EMAIL;?>: <?php echo required();?></td>
            <td class="hc_input hc_input_td" style="display: none;"><input name="email" type="text" class="inputbox" value="<?php echo $row['email'];?>" size="55"/><span class="hc_done hc_input">Cancel edit</span></td>
            <td class="hc_info"><?php echo $row['username'];?></td>
        </tr>
        <tr>
            <td><?php echo _UR_FNAME;?>: <?php echo required();?></td>
<!--            <td><input name="fname" type="text" class="inputbox" value="--><?php //echo $row['fname'];?><!--" size="55" /></td>-->
        <td><p id="editme5">edit me</p></td>
        </tr>
        <tr>
            <td><?php echo _UR_LNAME;?>: <?php echo required();?></td>
            <td><input name="lname" type="text" class="inputbox" value="<?php echo $row['lname'];?>" size="55" /></td>
        </tr>
        <tr>
            <td><?php echo _ADDRESS;?></td>
            <td><input name="address" type="text" class="inputbox" value="<?php echo $row['address'];?>" size="55" /></td>
        </tr>
        <tr>
            <td><?php echo _CITY;?></td>
            <td><input name="city" type="text" class="inputbox" value="<?php echo $row['city'];?>" size="55" /></td>
        </tr>
        <tr>
            <td><?php echo _STATE;?></td>
            <td><input name="state" type="text" class="inputbox"  value="<?php echo $row['state'];?>"  size="55" /></td>
        </tr>
        <tr>
            <td><?php echo _ZIPCODE;?></td>
            <td><input name="zipcode" type="text" class="inputbox"  value="<?php echo $row['zipcode'];?>" size="55" /></td>
        </tr>
        <tr>
            <td><?php echo _PHONE;?></td>
            <td><input name="phone" type="text" class="inputbox"  value="<?php echo $row['phone'];?>" size="55" /></td>
        </tr>
        <tr>
            <td><?php echo _MOBILE;?></td>
            <td><input name="mobile" type="text" class="inputbox"  value="<?php echo $row['mobile'];?>" size="55" /></td>
        </tr>
        <tr>
            <td><?php echo _FAX;?></td>
            <td><input name="fax" type="text" class="inputbox"   value="<?php echo $row['fax'];?>" size="55" /></td>
        </tr>
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
        <input name="userlevel" type="radio" id="userlevel-2" value="8" <?php getChecked($row['userlevel'], 8); ?> />
        <label for="userlevel-3"><?php echo _SUBADMIN;?></label>
        <input name="userlevel" type="radio" id="userlevel-3" value="1" <?php getChecked($row['userlevel'], 1); ?> />
                <?php echo tooltip(_UR_ADMIN_T);?></span></td>
        </tr>

        <tr>
            <td>Should the user have his own permissions?</td>
            <td><span class="input-out">
        <label for="en_c"><?php echo _YES;?></label>
        <input id="en_c" type="radio"  value="y" class='enable_cust_permissions'  />
        <label for="dis_c"><?php echo _NO;?></label>
        <input id="dis_c" type="radio"  value="n" class='disable_cust_permissions' checked="checked"/>
        </span></td>
        </tr>



        <tr class='deps'  <?php if((isset($_GET['userid']) && !$user->userHasPermissions($_GET['userid'])) || !isset($_GET['userid'])) echo "style='display:none'"; ?>>
            <td><?php echo _UR_PERM1;?>: <?php echo required();?></td>
            <td><?php echo $user->getMenuItemsList();?></td>
        </tr>

        <?php $menus = $user->getUpdateItems($_GET['userid'],'users'); ?>
        <?php foreach($menus as $menu): ?>
        <tr class='menu_<?php echo $menu['slug']; ?>' <?php echo ($menu['hidden']==1)?' style=\'display:none\'':''; ?>>
            <td><h3 style='display: inline;'><?php  echo $menu['slug']; ?></h3>&nbsp;&nbsp;&nbsp;<a href='javascript:' class='remove_menu' style='color:red;' menu='menu_<?php echo $menu['slug']; ?>'><img src="images/delete.png" alt="" title="Delete" width="12"></a></td> <td></td>
        </tr>
        <tr class='menu_<?php echo $menu['slug']; ?>' <?php echo ($menu['hidden']==1)?' style=\'display:none\'':''; ?>>
            <td><?php echo _UR_EDIT_AUTO_EVENTS_TITLE; ?>: <?php echo required();?></td>
            <td><span class="input-out">
        <label for="events-1"><?php echo _YES;?></label>
        <input name="menu[<?php echo $menu['id']; ?>][events]" type="radio"  value="y" <?php echo ($menu['hidden']==0)?returnChecked($menu['events'],'1'):''; ?>  />
        <label for="events-2"><?php echo _NO;?></label>
        <input name="menu[<?php echo $menu['id']; ?>][events]" type="radio"  value="n" <?php echo ($menu['hidden']==0)?returnChecked($menu['events'],'0'):'checked=\'checked\''; ?>/>


        </span><?php echo tooltip(_UR_EDIT_AUTO_EVENTS);?></td>

        </tr>
        <tr class='menu_<?php echo $menu['slug']; ?>' <?php echo ($menu['hidden']==1)?' style=\'display:none\'':''; ?>>
            <td><?php echo _UR_EDIT_AUTO_GALLERIES_TITLE;?>: <?php echo required();?></td>
            <td><span class="input-out">
        <label for="gallery-1"><?php echo _YES;?></label>
        <input name="menu[<?php echo $menu['id']; ?>][galleries]" type="radio" value="y"  <?php echo ($menu['hidden']==0)?returnChecked($menu['galleries'],'1'):''; ?> />
        <label for="gallery-2"><?php echo _NO;?></label>
        <input name="menu[<?php echo $menu['id']; ?>][galleries]" type="radio" value="n" <?php echo ($menu['hidden']==0)?returnChecked($menu['galleries'],'0'):'checked=\'checked\''; ?>/>


        </span><?php echo tooltip(_UR_EDIT_AUTO_GALLERIES);?></td>

        </tr>
        <tr class='menu_<?php echo $menu['slug']; ?>' <?php echo ($menu['hidden']==1)?' style=\'display:none\'':''; ?>>
            <td><?php echo _UR_EDIT_AUTO_PAGES_TITLE;?>: <?php echo required();?></td>
            <td><span class="input-out">
        <label for="gallery-1"><?php echo _YES;?></label>
        <input name="menu[<?php echo $menu['id']; ?>][pages]" type="radio"  value="y" <?php echo ($menu['hidden']==0)?returnChecked($menu['pages'],'1'):'';  ?>  />
        <label for="gallery-2"><?php echo _NO;?></label>
        <input name="menu[<?php echo $menu['id']; ?>][pages]" type="radio" value="n" <?php echo ($menu['hidden']==0)?returnChecked($menu['pages'],'0'):'checked=\'checked\'';  ?>/>


        </span><?php echo tooltip(_UR_EDIT_AUTO_GALLERIES);?></td>

        </tr>
        <?php endforeach; ?>
        <tr>
            <td><?php echo _UR_STATUS;?>:</td>
            <td><span class="input-out">
        <label for="active-1"><?php echo _USER_A;?></label>
        <input name="active" type="radio" id="active-1" value="y" <?php getChecked($row['active'], "y"); ?> />
        <label for="active-2"><?php echo _USER_I;?></label>
        <input name="active" type="radio" id="active-2" value="n" <?php getChecked($row['active'], "n"); ?> />
        </span></td>
        </tr>
        <tr>
            <td><?php echo _UR_DATE_REGGED;?>:</td>
            <td><span class="input-out"><?php echo dodate($core->long_date, $row['created']);?></span></td>
        </tr>
        <tr>
            <td><?php echo _UR_LASTLOGIN;?>:</td>
            <td><span class="input-out"><?php echo dodate($core->long_date, $row['lastlogin']);?></span></td>
        </tr>
        <tr>
            <td><?php echo _UR_LASTLOGIN_IP;?>:</td>
            <td><span class="input-out"><?php echo $row['lastip'];?></span></td>
        </tr>
        <tr>
            <td><input type="submit" name="dosubmit" class="button" value="<?php echo _UR_UPDATE;?>" /></td>
            <td><a href="index.php?do=users" class="button-alt"><?php echo _CANCEL;?></a></td>
        </tr>
    </table>
    <input name="username" type="hidden" value="<?php echo $row['username'];?>" />
    <input name="userid" type="hidden" value="<?php echo $user->userid;?>" />
</form>
<script type="text/javascript">
    $(document).ready(function(){

        $(".hc_info").click(function(){
            $(this).hide().parent().find('.hc_input').show();
        });
        $(".hc_done").click(function(){
            $(this).parent().parent().find('.hc_input').hide().parent().find('.hc_info').show();
        });
        $(".hc_input_td").focusout(function(){
            $(this).parent().find('.hc_input').hide().parent().find('.hc_info').show();
//            alert('fg');
        });
    });

</script>
<?php echo $core->doForm("processUser");?>