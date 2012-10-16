<?php
  /**
   * Main
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: main.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<h1><?php echo _MN_TITLE;?></h1>
<p class="info"><?php echo _MN_INFO;?></p>
<h2><?php echo _MN_SUBTITLE;?></h2>
<p class="info"><?php echo _MN_INFO2;?></p>
<?php $monthly = $core->monthlyStats();?>
<?php $stats = $core->getStats();?>
<script language="javascript" type="text/javascript" src="assets/jquery.jqplot.min.js"></script>
<script language="javascript" type="text/javascript" src="assets/jqplot.barRenderer.min.js"></script>
<script language="javascript" type="text/javascript" src="assets/jqplot.categoryAxisRenderer.min.js"></script>
<script language="javascript" type="text/javascript" src="assets/jqplot.pointLabels.min.js"></script>
<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="assets/excanvas.min.js"></script><![endif]-->
<?php if($monthly):?>
<script type="text/javascript">
  $(document).ready(function(){
    var s1 = [
	<?php
		$res = '';
		foreach($stats as $row) {
			if(strlen($res) > 0) {
				$res .= ",";
			}
			$res .= $row['views'];
		}
		echo $res;
		?>
	];
    var s2 = [
	<?php
		$res2 = '';
		foreach($stats as $row) {
			if(strlen($res2) > 0) {
				$res2 .= ",";
			}
			$res2 .= $row['visits'];
		}
		echo $res2;
		?>
	];
    var ticks = [
	<?php
		$res3 = '';
		$i=0;
		foreach($stats as $rep) {
			$i++;
			if(strlen($res3) > 0) {
				$res3 .= ",";
			}
			$res3 .= $i;
		}
		?>
		<?php print $res3;?>
	];
    <?php unset($res, $res2, $res3);?>
    plot1 = $.jqplot('chart', [s1, s2], {
	  seriesDefaults: {
	  renderer: $.jqplot.BarRenderer,
	  pointLabels:{show:true}
		  },
	  title: '<?php echo _MN_M_STATS_FOR.' &rsaquo; '.doDate('%b',date("M", mktime(0, 0, 0, $core->month, 10))).' / '.$core->year;?>',
      series:[
        {label:'<?php echo _MN_TOTAL_H;?>'},
        {label:'<?php echo _MN_UNIQUE_V;?>'}
      ],
      legend: {
        show: true,
		location: 'ne'
      },
      axes: {
        xaxis: {
          renderer: $.jqplot.CategoryAxisRenderer,
          ticks: ticks
        }
      }
    });
  });
</script>
<div id="chart"></div>
<?php endif;?>
<table cellspacing="0" cellpadding="0" class="formtable">
  <tfoot>
    <tr style="background-color:transparent">
      <td nowrap="nowrap"><form method="get" action="" name="admin_form">
          <select name="month" class="custombox" style="width:120px">
            <?php echo $core->monthList();?>
          </select>
          <select name="year" class="custombox" style="width:70px">
            <?php echo $core->yearList(2009, strftime('%Y')); ?>
          </select>
          <input name="submit" value="<?php echo _SUBMIT;?>" type="submit" class="button-sml"/>
        </form></td>
      <td align="right"><a href="javascript:void(0)" class="button-alt-sml delete"><?php echo _MN_EMPTY_STATS;?></a></td>
    </tr>
  </tfoot>
  <?php if(!$monthly):?>
  <tr>
    <td colspan="2"><div class="msgAlert"><?php echo _MN_NOSTATS;?></div></td>
  </tr>
  <?php else:?>
  <tr>
    <td><?php echo _MN_TOTAL_V;?></td>
    <td style="width:100%"><?php echo $monthly['total'];?></td>
  </tr>
  <tr>
    <td><?php echo _MN_TOTAL_H;?></td>
    <td><?php echo $monthly['views'];?></td>
  </tr>
  <tr>
    <td><?php echo _MN_UNIQUE_V;?></td>
    <td><?php echo $monthly['visits'];?></td>
  </tr>
  <?php endif;?>
</table>
<?php //$core->getVersion();?>
<div id="dialog-confirm" style="display:none;" title="<?php echo _MN_EMPTY_STATS;?>">
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
                    data: 'deleteStats=1',
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
// ]]>
</script>