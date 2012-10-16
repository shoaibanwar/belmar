<?php
  /**
   * Logs
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: logs.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

if($user->userlevel !=9): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<h1><img src="images/log-sml.png" alt="" /><?php echo _LG_TITLE1;?></h1>
<p class="info"><?php echo _LG_INFO1;?></p>
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
        <select name="sort" class="custombox" onchange="if(this.value!='NA') window.location='index.php?do=logs&amp;sort='+this[this.selectedIndex].value; else window.location='index.php?do=logs';" style="width:250px">
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
    <?php foreach ($hollysec->getLogs() as $row):?>
    <?php $message = cleanSanitize($row['message']);?>
    <tr>
      <td><?php echo dodate($core->long_date, $row['created']);?></td>
      <td><?php echo $row['user_id'];?></td>
      <td><?php echo $row['ip'];?></td>
      <td><?php echo $row['type'];?></td>
      <td><?php echo $row['info_icon'];?></td>
      <td><?php echo $message;?></td>
    </tr>
    <?php endforeach;?>
    <?php unset($row);?>
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