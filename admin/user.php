<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HollyCode2
 * Date: 6/20/12
 * Time: 11:01 AM
 * To change this template use File | Settings | File Templates.
 */
?>


<?php if(!$user->checkOperationPermission('user')): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;  ?>

<h1><img src="images/users-sml.png" alt="" /><?php echo _UR_TITLE22;?></h1>
<p class="info"><?php echo _UR_INFO22;?></p>


<?php $row = $user->getUpdateItems($user->userid,'users');?>
<h2><?php echo _UR_SUBTITLE22 . $row['depData']['username'];?></h2>
<form action="" method="post" id="admin_form" name="admin_form"  enctype="multipart/form-data">
    <table cellspacing="0" cellpadding="0" class="formtable" style="margin-bottom: 25px;">
        <tr>
            <td width="200"><?php echo _USERNAME;?>: </td>
            <td><?php echo $row['depData']['username'];?></td>
        </tr>
        <tr>
            <td><?php echo _UR_EMAIL;?>:</td>
            <td class="hc_info"><?php echo $row['depData']['email'];?></td>
        </tr>
        <tr>
            <td><?php echo _UR_FNAME;?>:</td>
            <td><?php echo $row['depData']['fname']; ?></td>
        </tr>
        <tr>
            <td><?php echo _UR_LNAME;?>:</td>
            <td><?php echo $row['depData']['lname']; ?></td>
        </tr>
        <tr>
            <td><?php echo _ADDRESS;?></td>
            <td><?php echo $row['depData']['address']; ?></td>
        </tr>
        <tr>
            <td><?php echo _CITY;?></td>
            <td><?php echo $row['depData']['city']; ?></td>
        </tr>
        <tr>
            <td><?php echo _STATE;?></td>
            <td><?php echo $row['depData']['state']; ?></td>
        </tr>
        <tr>
            <td><?php echo _ZIPCODE;?></td>
            <td><?php echo $row['depData']['zipcode']; ?></td>
        </tr>
        <tr>
            <td><?php echo _PHONE;?></td>
            <td><?php echo $row['depData']['phone']; ?></td>
        </tr>
        <tr>
            <td><?php echo _MOBILE;?></td>
            <td><?php echo $row['depData']['mobile']; ?></td>
        </tr>
        <tr>
            <td><?php echo _FAX;?></td>
            <td><?php echo $row['depData']['fax']; ?></td>
        </tr>
        <tr>
            <td><?php echo _DEP;?>:</td>
            <td>
                <?php echo Users::getDepartmentName($row['depData']['department_id']); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo _UR_LEVEL;?>:</td>
            <td><?php echo $row['depData']['userlevel'] ==8?_UR_ADMIN:_SUBADMIN; ?></td>
        </tr>

        <tr>
            <td><?php echo _UR_PERMISSION2;?></td>
            <td><?php echo Users::hasOwnPermissions($row['depData']['id']); ?></td>
        </tr>

        <?php if(Users::hasOwnPermissions($row['depData']['id'])=='Yes'): ?>
        <?php //-----------------------start permissions-------------------------------------------------------------------------------------------------- ?>

        <tr class="permission">
            <td rowspan="9"><?php echo _UR_PERM1;?>: <?php echo required();?></td>
        </tr>
        <?php $menus = $db->fetch_all("SELECT id , name_en FROM menus WHERE id IN ( 24,27,28,29,30,31,33,34 )"); ?>

        <?php foreach($menus as $menu): ?>
            <tr class="permission"><td><?php echo (in_array_recursive($menu['id'],$row['menus']))?"<img src='".ADMINURL."/images/completed.png' />":"<img src='".ADMINURL."/images/del-mini.png' />  "; echo $menu['name_en'] ?></td></tr>
            <?php endforeach; ?>
        <tr class="permission">
            <td>Page Management:</td>
            <td>
                <?php echo ($row['permissions']['can_manage_pages']=='y')?"Yes":"No"; ?>
            </td>
        </tr>

        <tr class="permission">
            <td rowspan="6">Events/Calendars: <?php echo required();?></td>
        </tr>

        <?php $events = $db->fetch_all("SELECT id , event_name FROM event_types "); ?>
        <?php foreach($events as $event): ?>
            <tr class="permission"><td><?php echo (in_array_recursive($event['id'],$row['events']))?"<img src='".ADMINURL."/images/completed.png' />":"<img src='".ADMINURL."/images/del-mini.png' />  "; echo $event['event_name'] ?></td></tr>
            <?php endforeach; ?>


        <tr class="permission">
            <td>Press Room:</td>
            <td>
               <?php echo($row['permissions']['dep_can_manage_press_room']=='y')?"Yes":"No" ?>
            </td>
        </tr>

        <tr class="permission">
            <td>Belmar Alerts:</td>
            <td>
                <?php echo($row['permissions']['dep_can_manage_belmar_alerts']=='y')?"Yes":"No" ?>
            </td>
        </tr>

        <tr class="permission">
            <td rowspan="9">Gallery: <?php echo required();?></td>
        </tr>
        <?php $galls = $db->fetch_all("SELECT id , name_en FROM menus WHERE id IN ( 24,27,28,29,30,31,33,34 )"); ?>

        <?php foreach($galls as $gall): ?>
            <tr class="permission"><td><?php echo (in_array_recursive($gall['id'],$row['galleries']))?"<img src='".ADMINURL."/images/completed.png' />":"<img src='".ADMINURL."/images/del-mini.png' />  "; echo $gall['name_en'] ?></td></tr>
            <?php endforeach; ?>

        <tr class="permission">
            <td rowspan="6">From Submission & Lists</td>
            <td><?php echo ($row['permissions']['dep_can_view_all_contact_lists']=='y')?"<img src='".ADMINURL."/images/completed.png' />":"<img src='".ADMINURL."/images/del-mini.png' />  " ?>  Contact Form - All</td>
        </tr>
        <tr class="permission">
            <td><?php echo ($row['permissions']['dep_can_view_own_contact_lists']=='y')?"<img src='".ADMINURL."/images/completed.png' />":"<img src='".ADMINURL."/images/del-mini.png' />  " ?>  Contact Form - For Department Only </td>
        </tr>
        <tr class="permission">
            <td><?php echo ($row['permissions']['dep_can_view_mailing_list']=='y')?"<img src='".ADMINURL."/images/completed.png' />":"<img src='".ADMINURL."/images/del-mini.png' />  " ?>  Mailing List</td>
        </tr>
        <tr class="permission">
            <td><?php echo ($row['permissions']['dep_can_view_get_alerts_list']=='y')?"<img src='".ADMINURL."/images/completed.png' />":"<img src='".ADMINURL."/images/del-mini.png' />  " ?>  Get Belmar Alerts List</td>
        </tr>
        <tr class="permission">
            <td><?php echo ($row['permissions']['dep_can_view_belmar_survey_list']=='y')?"<img src='".ADMINURL."/images/completed.png' />":"<img src='".ADMINURL."/images/del-mini.png' />  " ?>  Belmar Survey List</td>
        </tr>
        <tr class="permission">
            <td><?php echo ($row['permissions']['dep_can_view_opt_out_list']=='y')?"<img src='".ADMINURL."/images/completed.png' />":"<img src='".ADMINURL."/images/del-mini.png' />  " ?>  Opt-Out List</td>
        </tr>

        <tr class="permission">
            <td rowspan="3">Email System & Templates</td>
            <td><?php echo ($row['permissions']['dep_can_send_lists_emails']=='y')?"<img src='".ADMINURL."/images/completed.png' />":"<img src='".ADMINURL."/images/del-mini.png' />  " ?>  Send Emails</td>
        </tr>
        <tr class="permission">
            <td><?php echo ($row['permissions']['dep_can_edit_email_templates']=='y')?"<img src='".ADMINURL."/images/completed.png' />":"<img src='".ADMINURL."/images/del-mini.png' />  " ?>  Email Templates</td>
        </tr>
        <tr class="permission">
            <td><?php echo ($row['permissions']['dep_can_edit_auto_response']=='y')?"<img src='".ADMINURL."/images/completed.png' />":"<img src='".ADMINURL."/images/del-mini.png' />  " ?>  Automatic Response Emails</td>
        </tr>
        <?php //-----------------------end permissions-------------------------------------------------------------------------------------------------- ?>



        <?php endif; ?>

        <tr>
            <td><?php echo _UR_STATUS;?>:</td>
            <td>
                <span>
                <?php echo $row['depData']['active']=='y'?_ACTIVE:_INACTIVE  ;?>
                </span>
            </td>
        </tr>
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
    </table>



<?php //--------------------------------------------------------------------------------------------------------------------// ?>
<?php //--------------------------------------------------Log----------------------------------------------------------------// ?>
<?php //--------------------------------------------------------------------------------------------------------------------// ?>



    <h2><span><a href="javascript:void(0)" class=" delete button-alt-sml"><?php echo _LG_EMPTY;?></a></span><?php echo _LG_SUBTITLE1;?></h2>


    <div class="box" style="margin-top:5px">
        <table cellpadding="0" cellspacing="0" class="formtable">
            <tr style="background-color:transparent">
                <td><form action="" method="post" id="dForm">
                    <strong> <?php echo _UR_SHOW_FROM;?></strong>
                    <input name="fromdate" type="text" style="margin-right:3px" class="inputbox" size="11" id="fromdate" />
                    <strong> <?php echo _UR_SHOW_TO;?></strong>
                    <input name="enddate" type="text" class="inputbox" size="11" id="enddate" />
                    <input name="find" type="submit" class="button-sml" value="<?php echo _UR_FIND;?>" />
                </form></td>
                <td align="right"><strong><?php echo _LG_FILTER;?>:</strong>&nbsp;&nbsp;
                    <select name="sort" class="custombox" onchange="if(this.value!='NA') window.location='index.php?do=user&amp;userid=<?php echo $row['id']; ?>&amp;sort='+this[this.selectedIndex].value; else window.location='index.php?do=logs';" style="width:250px">
                        <option value="NA"><?php echo _LG_FILTER_R;?></option>
                        <?php echo $hollysec->getLogFilter();?>
                    </select></td>
            </tr>
        </table>
    </div>


    <table cellpadding="0" cellspacing="0" class="display">
        <thead>
        <tr>
            <th class="left"><?php echo _LG_WHEN;?></th>
            <th class="left"><?php echo _LG_USER;?></th>
            <th class="left"><?php echo _LG_IP;?></th>
            <th class="left"><?php echo _LG_TYPE;?></th>
            <th class="left"><?php echo _LG_DATA;?></th>
            <th class="left"><?php echo _LG_MESSAGE;?></th>
        </tr>
        </thead>
        <tbody>
        <?php $logs = $hollysec->getLogs($row['depData']['username']);?>
       <?php if($logs != 0 ): ?>
        <?php foreach ($logs as $log):?>
            <?php $message = cleanSanitize($log['message']);?>
        <tr>
            <td><?php echo dodate($core->long_date, $log['created']);?></td>
            <td><?php echo $log['user_id'];?></td>
            <td><?php echo $log['ip'];?></td>
            <td><?php echo $log['type'];?></td>
            <td><?php echo $log['info_icon'];?></td>
            <td><?php echo $message;?></td>
        </tr>
            <?php endforeach;?>
       <?php else: echo "<tr><td colspan='6' align='center'>"._NOLOGS."</td></tr>"; ?>
       <?php endif; ?>
        <?php unset($log);?>
        <?php if($pager->items_total >= $pager->items_per_page):?>
        <tr style="background-color:transparent">
            <td colspan="6"><div style="float:left"><?php echo $pager->items_per_page();?> </div>
                <div style="float:right">
                    <div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div>
                </div>
                <div class="clear"></div></td>
        </tr>
            <?php endif;?>
        </tbody>
    </table>
    <div id="dialog-confirm" style="display:none;" title="<?php echo _LG_EMPTY_LOGS;?>">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
    </div>
    <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function () {
            $('a.delete').live('click', function () {
                $("#dialog-confirm").dialog('open');
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

                        $.ajax({
                            type: 'post',
                            url: "ajax.php",
                            data: 'deleteLogs=1',
                            success: function (msg) {
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