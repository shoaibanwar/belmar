<?php
if (!defined("_VALID_PHP"))
    die('Direct access to this location is not allowed.');
//    $sql = "SELECT * FROM get_alerts ";
//    $users = $db->enableEscape()->fetch_all($sql);
if(!$user->checkOperationPermission('get_alerts_list')): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
$alerts=new Content();
$allalerts=$alerts->getallalert();
?>

<?php switch($core->maction):
  case "view": ?>
  <?php $row = $core->getRowById("get_alerts",$_GET['alertid']) ;?>
  <h1><img src="images/mod-sml.png" alt="" /><?php echo alert_EM_View ;?></h1>
  <p class="info"><?php echo _PR_INFO1. _REQ1.required(). _REQ2;?></p>
  <h2><?php echo alert_EM_SUBTITLE1 . $row['fname'];?></h2>

  <form action="" method="post" id="admin_form" name="admin_form">
      <table cellspacing="0" cellpadding="0" class="formtable">
          <tr>
              <td width="150"><?php echo _FNAME?>:</td>
              <td><?php echo $row['fname'];?> </td>

          </tr>

          <tr>
              <td width="150"><?php echo _UR_LNAME ;?>:</td>
              <td><?php echo $row['lname'] ?></td>
          </tr>

          <tr>
              <td width="150"><?php echo emailaddress;?>:</td>
              <td><?php echo $row['email'] ?></td>
          </tr>

          
          <tr>
              <td width="150"><?php echo mobile;?>:</td>
              <td><?php echo $row['mobile'] ?></td>
          </tr>
          
          <tr>
              <td width="150"><?php echo address;?>:</td>
              <td><?php echo $row['address'] ?></td>
           </tr>

          <tr>
              <td width="150"><?php echo city;?>:</td>
              <td><?php echo $row['city'] ?> </td>
          </tr>

          <tr>
              <td width="150"><?php echo state;?>:</td>
              <td><?php echo $row['state'] ?></td>
          </tr>

          <tr>
              <td width="150"><?php echo zip_code;?>:</td>
              <td><?php echo $row['zipcode'] ?></td>
          </tr>
          
           <tr>
              <td width="150"><?php echo alertme;?>:</td>
              <td><?php echo $row['alertme'] ?></td>
          </tr>
          
           <tr>
              <td width="150"><?php echo alertvia;?>:</td>
              <td><?php echo $row['alertvia'] ?></td>
          </tr>
          

      </table>

  </form>
  <?php break; ?>

<?php
    default : ?>
<!--<h1><img src="images/mod-sml.png" alt="" />--><?php //echo  Palertlist_EM_TITLE1;?><!--</h1>-->
<!--<p class="info"><span>--><?php //echo $core->langIcon();?><!--</span>--><?php //echo Palerts_EM_INFO3;?><!--</p>-->
    <h1><img src="images/mod-sml.png" alt="" /><?php echo Palertlist_EM_TITLE1;?></h1>
    <p class="info"><?php echo Palerts_EM_INFO3;?></p>
    <h2><?php echo GERLAERTS_EM_SUBTITLE3?></h2>

    <div class="box">
    <table cellpadding="0" cellspacing="0" class="formtable">
        <tr style="background-color:transparent">
            <td>

                <form action="" method="post" id="dForm">
                    <table>
                        <td><input name="search" type="text" class="inputbox"  value="" size="40" />

                        </td>

                        <td>
                            <input name="find" type="submit" class="button-sml" value="<?php echo _UR_FIND;?>" />
                        </td>
                    </table>
                </form>

            </td>

            <td align="right" colspan="3">
                <strong><?php echo _UR_USR_FILTER;?>:</strong>&nbsp;&nbsp;
                <select name="sort" onchange="if(this.value!='NA') window.location='index.php?do=lists/get_alerts&amp;sort='+this[this.selectedIndex].value; else window.location='index.php?do=lists/get_alerts';" style="width:220px" class="custombox">
                    <option value="NA"><?php echo _UR_RESET_FILTER;?></option>
                    <?php echo $alerts->getalertFilter();  ?>
                </select>
                </td>
        </tr>
        <tr style="background-color:transparent">
            <td colspan="2"></td>

            <td align="right">
                <?php echo $pager->items_per_page()?> &nbsp;&nbsp;
                <?php if($pager->num_pages >= 1) echo $pager->jump_menu();?>

            </td>

        </tr>
    </table>
</div>
<table cellpadding="0" cellspacing="0" class="display">

    <thead>
    <tr>
     <th align="left">#</th>
       <?php if(isset($_GET['sort']) && $_GET['sort']=='fname-DESC')
    {?>
        <th align="left"><a href="index.php?do=lists/get_alerts&sort=fname-ASC"><img src="images/down.png"/><?php echo _Press_alert_fname;?></a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=lists/get_alerts&sort=fname-DESC"><img src="images/up.png"/><?php echo _Press_alert_fname;?></a></th>
        <? } ?>

       <?php if(isset($_GET['sort']) && $_GET['sort']=='email-DESC')
    {?>
        <th align="left"><a href="index.php?do=lists/get_alerts&sort=email-ASC"><img src="images/down.png"/>Email</a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=lists/get_alerts&sort=email-DESC"><img src="images/up.png"/>Email</a></th>
        <? } ?>

       <?php if(isset($_GET['sort']) && $_GET['sort']=='city-DESC')
    {?>
        <th align="left"><a href="index.php?do=lists/get_alerts&sort=city-ASC"><img src="images/down.png"/>City</a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=lists/get_alerts&sort=city-DESC"><img src="images/up.png"/>City</a></th>
        <? } ?>


       <?php if(isset($_GET['sort']) && $_GET['sort']=='state-DESC')
    {?>
        <th align="left"><a href="index.php?do=lists/get_alerts&sort=state-ASC"><img src="images/down.png"/>State</a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=lists/get_alerts&sort=state-DESC"><img src="images/up.png"/>State</a></th>
        <? } ?>


       <?php if(isset($_GET['sort']) && $_GET['sort']=='alertvia-DESC')
    {?>
        <th align="left"><a href="index.php?do=lists/get_alerts&sort=alertvia-ASC"><img src="images/down.png"/>Alert Via</a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=lists/get_alerts&sort=alertvia-DESC"><img src="images/up.png"/>Alert Via</a></th>
        <? } ?>


        <th align="left">Delete</th>
    </tr>
    </thead>
     <tbody>
      <?php if($allalerts==0):?>
    <tr>
      <td colspan="10"><?php echo $core->msgAlert(_PG_NOPAGES,false);?></td>
    </tr>
    <?php else:?>
    <?php $counter=1; ?>
    <?php foreach($allalerts as $alertrows): ?>
    <tr>
   <td align="left"><?php echo $counter ?></td>
   <td align="left"><a href="index.php?do=lists/get_alerts&mod_action=view&amp;&alertid=<?php echo $alertrows['id'] ?>"><?php echo $alertrows['fname'] ." ".$alertrows['lname']; ?></a></td>
        <td align="left"><?php echo $alertrows['email']; ?></td>
        <td align="left"><?php echo $alertrows['city']; ?></td>
        <td align="left"><?php echo $alertrows['state']; ?></td>
        <td align="left"><?php echo $alertrows['alertvia']; ?></td>
        <td align="left"> <a href="javascript:void(0);" class="delete" rel="<?php echo $alertrows['fname'];?>" id="item_<?php echo $alertrows['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo _DELETE.': '.$alertrows['fname'];?>"/></a></td>
    </tr>
<?php $counter++; ?>
    <?php endforeach; ?>

      <?php unset($alertrows);?>

    <?php if($pager->items_total >= $pager->items_per_page):?>
    <tr style="background-color:transparent">
        <td colspan="8" style="padding:10px;">
            <div class="pagination">
            <span class="inner"><?php echo $pager->display_pages();?></span>
            </div>
        </td>
    </tr>

<?php endif;?>
<?php endif;?> 

</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' alert? ';?>">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {

    $("#search-input").watermark("<?php echo UR_FIND_Receiver;?>");
    $("#search-input").keyup(function () {
        var srch_string = $(this).val();
        var data_string = 'alertsearch=' + srch_string;
        if (srch_string.length > 0) {
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
                    data: 'deletealert=' + id + '&alerttitle=' + title,
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
<?php endswitch; ?>
