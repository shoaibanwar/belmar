<?php
  /**
   * Transactions
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: transactions.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  if(!$user->getAcl("Transactions")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<?php switch($core->action): case "salesyear": ?>
<h1><img src="images/pay-sml.png" alt="" /><?php echo _TR_TITLE2;?></h1>
<p class="info"><?php echo _TR_INFO2;?></p>
<h2><span><a href="index.php?do=transactions&amp;action=salesmonth"><img src="images/monthly_cal.png" alt="" title="<?php echo _TR_MONTHVIEW;?>" class="tooltip" /></a></span><?php echo _TR_SUBTITLE2.' &rsaquo; '._TR_SALES3.' &rsaquo; '.$core->year;;?></h2>
<?php $reports = $member->yearlyStats();?>
<?php $row = $member->getYearlySummary();?>
<?php if($reports != 0):?>
<script language="javascript" type="text/javascript" src="assets/jquery.jqplot.min.js"></script>
<script language="javascript" type="text/javascript" src="assets/jqplot.barRenderer.min.js"></script>
<script language="javascript" type="text/javascript" src="assets/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="assets/jqplot.pointLabels.min.js"></script>
<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="assets/excanvas.min.js"></script><![endif]-->
<script type="text/javascript">
  $(document).ready(function(){
    var s1 = [
	<?php
		$res = '';
		foreach($reports as $report) {
			if(strlen($res) > 0) {
				$res .= ",";
			}
			$res .= $report['total'];
		}
		echo $res;
		?>
	];
    var s2 = [
	<?php
		$res2 = '';
		foreach($reports as $report) {
			if(strlen($res2) > 0) {
				$res2 .= ",";
			}
			$res2 .= $report['totalprice'];
		}
		echo $res2;
		?>
	];
    var ticks = [
	<?php
		$res3 = '';
		foreach($reports as $rep) {
			if(strlen($res3) > 0) {
				$res3 .= "','";
			}
			$res3 .= date("M", mktime(0, 0, 0, $rep['month'], 10));
		}
		?>
		'<?php print $res3;?>'
	];
    <?php unset($res, $res2, $res3);?>
    plot1 = $.jqplot('chart', [s1, s2], {
      seriesDefaults:{
        renderer:$.jqplot.BarRenderer,
        rendererOptions: {fillToZero: true},
		pointLabels: {show: true}
      },
	  title: '<?php echo _TR_SALES3.' › '.$core->year;?>',
      series:[
        {label:'<?php echo _TR_TOTSALES;?>'},
        {label:'<?php echo _TR_TOTREV;?>'}
      ],
      legend: {
        show: true,
		placement:'outsideGrid',
		location: 'ne'
      },
      axes: {
        xaxis: {
          renderer: $.jqplot.CategoryAxisRenderer,
          ticks: ticks
        },
        yaxis: {
			tickOptions:{
            formatString:'$%.2f'
            },
          autoscale: true
        }
      }
    });
  });
</script>
<?php endif;?>
<?php if($reports == 0):?>
<?php echo $core->msgAlert(_TR_NOYEARSALES,false);?>
<?php else:?>
<div id="chart"></div>
<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
      <th width="150" nowrap="nowrap" class="left"><?php echo _TR_MONTHYEAR;?></th>
      <th><?php echo _TR_TOTSALES;?></th>
      <th width="200" nowrap="nowrap"><?php echo _TR_TOTREV;?></th>
    </tr>
  </thead>
  <?php foreach($reports as $report):?>
  <tr>
    <td><?php echo date("M", mktime(0, 0, 0, $report['month'], 10));?> / <?php echo $core->year;?></td>
    <td align="center"><?php echo $report['total'];?></td>
    <td align="center"><?php echo $core->formatMoney($report['totalprice']);?></td>
  </tr>
  <?php endforeach ?>
  <?php unset($report);?>
  <tr>
    <td><strong><?php echo _TR_TOTALYEAR;?></strong></td>
    <td align="center"><strong><?php echo $row['total'];?></strong></td>
    <td align="center"><strong><?php echo $core->formatMoney($row['totalprice']);?></strong></td>
  </tr>
</table>
<?php endif;?>
<div class="box" style="text-align:right">
  <form method="get" action="" name="date">
    <select name="year" class="custombox" style="width:80px">
      <?php echo $core->yearList(2010, strftime('%Y')); ?>
    </select>
    <input name="submit" value="<?php echo _SUBMIT;?>" type="submit" class="button-sml"/>
    <input name="do" type="hidden" value="transactions" />
    <input name="action" type="hidden" value="salesyear" />
  </form>
</div>
<?php break;?>
<?php case"salesmonth": ?>
<?php $month_name = date("M", mktime(0, 0, 0, $core->month, 10));?>
<h1><img src="images/pay-sml.png" alt="" /><?php echo _TR_TITLE2;?></h1>
<p class="info"><?php echo _TR_INFO2;?></p>
<h2><span><a href="index.php?do=transactions&amp;action=salesyear"> <img src="images/yearly_cal.png" alt="" title="<?php echo _TR_YEARVIEW;?>" class="tooltip" /></a></span><?php echo _TR_SUBTITLE2.' &rsaquo; '. _TR_MONTHSALES3 . $month_name.' / '.$core->year;;?></h2>
<?php $monthly = $member->monthlyStats();?>
<?php if($monthly != 0):?>
<script language="javascript" type="text/javascript" src="assets/jquery.jqplot.min.js"></script>
<script language="javascript" type="text/javascript" src="assets/jqplot.barRenderer.min.js"></script>
<script language="javascript" type="text/javascript" src="assets/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="assets/jqplot.pointLabels.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    var s1 = [<?php echo $monthly['total'].','.$monthly['totalprice'].','.$monthly['totalprice']/$monthly['total'];?>];
    var ticks = ['<?php echo _TR_TOTSALES;?>','<?php echo _TR_TOTREV;?>','<?php echo _TR_AVERAGE;?>'];
    plot1 = $.jqplot('chart', [s1], {
      seriesDefaults:{
        renderer:$.jqplot.BarRenderer,
        rendererOptions: {fillToZero: true},
		pointLabels: {show: true}
      },
	  title: '<?php echo _TR_MONTHSALES3 . $month_name.' / '.$core->year;?>',
      series:[
        {label:'<?php echo $month_name;?> / <?php echo $core->year;?>'}
      ],
      legend: {
        show: true,
		location: 'ne',
        placement: 'outsideGrid'
      },
      axes: {
        xaxis: {
          renderer: $.jqplot.CategoryAxisRenderer,
          ticks: ticks
        },
        yaxis: {
			tickOptions:{
            formatString:'$%.2f'
            },
          autoscale: true
        }
      }
    });
  });
</script>
<?php endif;?>
<?php if($monthly == 0):?>
<?php echo $core->msgAlert(_TR_NOMONTHSALES,false);?>
<?php else:?>
<div id="chart"></div>
<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
      <th colspan="2" class="left"><?php echo _TR_MONTHSTATS;?></th>
    </tr>
  </thead>
  <tr>
    <td width="200"><?php echo _TR_TOTSALES;?></td>
    <td><?php echo $monthly['total'] . _TR_SALEITEMS;?></td>
  </tr>
  <tr>
    <td><?php echo _TR_TOTREV;?></td>
    <td><?php echo $core->formatMoney($monthly['totalprice']);?></td>
  </tr>
  <tr>
    <td><?php echo _TR_AVERAGE;?></td>
    <td><?php echo $core->formatMoney($monthly['totalprice']/$monthly['total']);?></td>
  </tr>
</table>
<?php endif;?>
<div class="box" style="text-align:right">
  <form method="get" action="" name="admin_form">
    <select name="month" class="custombox">
      <?php echo $core->monthList();?>
    </select>
    <select name="year" class="custombox" style="width:80px">
      <?php echo $core->yearList(2009, strftime('%Y')); ?>
    </select>
    <input name="submit" value="<?php echo _SUBMIT;?>" type="submit" class="button-sml"/>
    <input name="do" type="hidden" value="transactions" />
    <input name="action" type="hidden" value="salesmonth" />
  </form>
</div>
<?php break;?>
<?php default: ?>
<?php
  $search = (isset($_POST['search'])) ? intval($_POST['search']) : false;
  $payrow = $member->getPayments($search);
?>
<h1><img src="images/pay-sml.png" alt="" /><?php echo _TR_TITLE1;?></h1>
<p class="info"><?php echo _TR_INFO1;?></p>
<h2><span><a href="ajax.php?exportTransactions" title="<?php echo _TR_EXPORTXLS;?>" class="tooltip"><img src="images/xls.png" alt="" /></a> <a href="index.php?do=transactions&amp;action=salesyear" title="<?php echo _TR_VIEW_REPORT;?>" class="tooltip"><img src="images/chart.png" alt=""/></a></span><?php echo _TR_SUBTITLE1;?></h2>
<div class="box">
  <table cellpadding="0" cellspacing="0" class="formtable">
    <tr style="background-color:transparent">
      <td><form action="" method="post">
          <input name="search" type="text" class="inputbox" id="search-input" size="40"/>
          <input name="submit" type="submit" class="button-sml" value="<?php echo _TR_FIND;?>" />
        </form></td>
      <td align="right"><form action="" method="get" name="filter_browse" id="filter_browse">
          <strong><?php echo _TR_PAY_FILTER;?>:</strong>&nbsp;&nbsp;
          <select name="select" class="custombox" onchange="if(this.value!='NA') window.location = 'index.php?do=transactions&amp;sort='+this[this.selectedIndex].value; else window.location = 'index.php?do=transactions';" style="width:180px">
            <option value="NA"><?php echo _TR_RESET_FILTER;?></option>
            <?php echo $member->getPaymentFilter();?>
          </select>
        </form></td>
    </tr>
    <tr style="background-color:transparent">
      <td><form action="" method="post" id="dForm">
          <strong> <?php echo _TR_SHOW_FROM;?> </strong>
          <input name="fromdate" type="text" style="margin-right:3px" class="inputbox" size="10" id="fromdate" />
          <strong> <?php echo _TR_SHOW_TO;?> </strong>
          <input name="enddate" type="text" style="margin-right:3px" class="inputbox" size="10" id="enddate" />
          <input name="find" type="submit" class="button-sml" value="<?php echo _TR_FIND;?>" />
        </form></td>
      <td align="right"><?php echo $pager->items_per_page();?> &nbsp;&nbsp;
        <?php if($pager->num_pages >= 1) echo $pager->jump_menu();?></td>
    </tr>
  </table>
</div>
<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
      <th width="20" class="left">#</th>
      <th class="left"><strong><?php echo _TR_MEMNAME;?></strong></th>
      <th class="left"><strong><?php echo _TR_USERNAME;?></strong></th>
      <th class="left"><strong><?php echo _TR_AMOUNT;?></strong></th>
      <th class="left"><strong><?php echo _TR_PAYDATE;?></strong></th>
      <th><strong><?php echo _TR_PROCESSOR;?></strong></th>
      <th><?php echo _TR_STATUS;?></th>
      <th><?php echo _DELETE;?></th>
    </tr>
  </thead>
  <tbody>
    <?php if($payrow == 0):?>
    <tr>
      <td colspan="8"><?php echo $core->msgAlert(_TR_NOTRANS,false);?></td>
    </tr>
    <?php else:?>
    <?php foreach ($payrow as $row):?>
    <?php $image = ($row['status'] == 0) ? "pending":"completed";?>
    <?php $status = ($row['status'] == 0) ? 1:0;?>
    <tr>
      <td><?php echo $row['id'];?>.</td>
      <td><?php echo $row['title'];?></td>
      <td><?php echo $row['username'];?></td>
      <td><?php echo $core->formatMoney($row['rate_amount']);?></td>
      <td><?php echo dodate($core->short_date, $row['created']);?></td>
      <td align="center"><img src="images/<?php echo $row['pp'];?>.png" alt="" class="tooltip" title="<?php echo $row['pp'];?>"/></td>
      <td align="center"><img src="images/<?php echo $image;?>.png" alt="" class="tooltip" title="Status: <?php echo ucfirst($image);?>"/></td>
      <td align="center"><a href="javascript:void(0);" class="delete" rel="<?php echo $row['created'];?>" id="item_<?php echo $row['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo _DELETE;?>"/></a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($row);?>
    <?php if($pager->items_total > $pager->items_per_page):?>
    <tr style="background-color:transparent">
      <td colspan="8" style="padding:10px;"><div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
    </tr>
    <?php endif;?>
    <?php endif;?>
  </tbody>
</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '._TRANSACTION;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {
	$("#search-input").watermark("<?php echo _TR_FINDPAY;?>");
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
                    data: 'deleteTransaction=' + id + '&posttitle=' + title,
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