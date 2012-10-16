<script type="text/javascript" src="<?php echo SITEURL;?>/admin/modules/events/script.js"></script>
<?php
// from session  echo "welcome".$user->uid;
/**
 * Event Manager
 *
 * @package HollyCode CMS
 * @author HollyCode.com
 * @copyright 2010
 * @version $Id: admin.php, v2.00 2011-04-20 10:12:05 gewa Exp $
 */
  if (!defined("_VALID_PHP"))

      die('Direct access to this location is not allowed.');


  if(!$user->checkOperationPermission("alerts")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;

require_once("../lang/" . $core->language . ".lang.php");

$contentalerts=new Content();
$alersrow=$contentalerts->getbelmaralerts();

?>
<?php switch($core->maction):


    case "edit": ?>

<?php $row = $core->getRowById("belmaralerts",$contentalerts->belmaralertId);?>


<h1><img src="images/mod-sml.png" alt="" /><?php echo Belmaralert_EM_TITLE1 ;?></h1>
<p class="info"><?php echo _Bemalerts_INFO1. _REQ1.required(). _REQ2;?></p>
<h2><?php echo BelmarAlert_EM_SUBTITLE1 . $row['title'];?></h2>

<form action="" method="post" id="admin_form" name="admin_form">
   <table cellspacing="0" cellpadding="0" class="formtable">
      <tr>
        <td width="150"><?php echo _MU_BelmarAlerts;?>: <?php echo required();?></td>
        <td><input name="title" type="text" class="inputbox" value="<?php echo $row['title'] ?>" size="55"/>
          <?php echo tooltip(_MU_BelmarAlerts_T);?></td>
      </tr>

       <tr>
        <td width="150"><?php echo _BelmarAlerts_POSTDATE;?>:</td>
        <td><input name="post_date" type="text" class="inputbox" id="post_date" size="55" value="<?php echo $row['post_date'] ?>" />

<!--   --><?php //echo tooltip(_POST_DATE_belmarAlerts);?><!--</td>-->
      </tr>



      <tr>

          <td><?php echo _Belmaralerts_PUB;?>:</td>
        <td><span class="input-out">
          <label for="active-1"  ><?php echo _ACTIVE;?></label>
          <input name="active" type="radio" id="active-1" value="1" <?php getChecked($row['item_published'], 1); ?>/>
          <label for="active-2"><?php echo _INACTIVE;?></label>
          <input name="active" type="radio" id="active-2" value="0" <?php getChecked($row['item_published'],0); ?>  />
          </span></td>
      </tr>


       <tr>
           <td><?php echo _BelmarAlerts_Feature;?>:</td>
           <td><span class="input-out">
          <label for="hfeature-1"><?php echo _YES;?></label>
          <input name="hfeature" type="radio" id="active-1" value="1" <?php getChecked($row['feature_homepage'], 1); ?> />
          <label for="hfeature-2"><?php echo _NO;?></label>
          <input name="hfeature" type="radio" id="active-2" value="0" <?php getChecked($row['feature_homepage'], 0); ?>   />
          </span></td>
       </tr>

       <tr>
<?
           $seconds_to_hours="";
           $seconds_to_hours=floor(seconds_to_hours($row['un_publishtime']));
  ?>
           <td><?php echo Unpublished_time;?>:</td>
           <td>
               <select name="un_publishtime" class="custombox" style="width: 125px;">
                   <option value="0" <? if($seconds_to_hours=="0"){ echo "selected=selected";} ?> >System Default</option>
                   <option value="1" <? if($seconds_to_hours=="1"){ echo "selected=selected";} ?> >1</option>
                   <option value="2"  <? if($seconds_to_hours=="2"){ echo "selected=selected";} ?> >2</option>
                   <option value="3"  <? if($seconds_to_hours=="3"){ echo "selected=selected";} ?> >3</option>
                   <option value="4"  <? if($seconds_to_hours=="4"){ echo "selected=selected";} ?> >4</option>
                   <option value="5"  <? if($seconds_to_hours=="5"){ echo "selected=selected";} ?> >5</option>
                   <option value="6"  <? if($seconds_to_hours=="6"){ echo "selected=selected";} ?> >6</option>
                   <option value="7"  <? if($seconds_to_hours=="7"){ echo "selected=selected";} ?> >7</option>
                   <option value="8"  <? if($seconds_to_hours=="8"){ echo "selected=selected";} ?> >8</option>
                   <option value="9"  <? if($seconds_to_hours=="9"){ echo "selected=selected";} ?> >9</option>
                   <option value="10"  <? if($seconds_to_hours=="10"){ echo "selected=selected";} ?> >10</option>
                   <option value="11"  <? if($seconds_to_hours=="11"){ echo "selected=selected";} ?> >11</option>
                   <option value="12"  <? if($seconds_to_hours=="12"){ echo "selected=selected";} ?> >12</option>
                   <option value="13"  <? if($seconds_to_hours=="13"){ echo "selected=selected";} ?> >13</option>
                   <option value="14"  <? if($seconds_to_hours=="14"){ echo "selected=selected";} ?> >14</option>
                   <option value="15"  <? if($seconds_to_hours=="15"){ echo "selected=selected";} ?> >15</option>
                   <option value="16"  <? if($seconds_to_hours=="16"){ echo "selected=selected";} ?> >16</option>
                   <option value="17"  <? if($seconds_to_hours=="17"){ echo "selected=selected";} ?> >17</option>
                   <option value="18"  <? if($seconds_to_hours=="18"){ echo "selected=selected";} ?> >18</option>
                   <option value="19"  <? if($seconds_to_hours=="19"){ echo "selected=selected";} ?> >19</option>
                   <option value="20"  <? if($seconds_to_hours=="20"){ echo "selected=selected";} ?> >20</option>
                   <option value="21"  <? if($seconds_to_hours=="21"){ echo "selected=selected";} ?> >21</option>
                   <option value="22"  <? if($seconds_to_hours=="22"){ echo "selected=selected";} ?> >22</option>
                   <option value="23"  <? if($seconds_to_hours=="23"){ echo "selected=selected";} ?> >23</option>
                   <option value="24"  <? if($seconds_to_hours=="24"){ echo "selected=selected";} ?> >24</option>
                   <option value="25"  <? if($seconds_to_hours=="25"){ echo "selected=selected";} ?>  >25</option>
                   <option value="26"  <? if($seconds_to_hours=="26"){ echo "selected=selected";} ?> >26</option>
                   <option value="27"  <? if($seconds_to_hours=="27"){ echo "selected=selected";} ?> >27</option>
                   <option value="28"  <? if($seconds_to_hours=="28"){ echo "selected=selected";} ?> >28</option>
                   <option value="29"  <? if($seconds_to_hours=="29"){ echo "selected=selected";} ?> >29</option>
                   <option value="30"  <? if($seconds_to_hours=="30"){ echo "selected=selected";} ?> >30</option>
                   <option value="31"  <? if($seconds_to_hours=="31"){ echo "selected=selected";} ?> >31</option>
                   <option value="32"  <? if($seconds_to_hours=="32"){ echo "selected=selected";} ?> >32</option>
                   <option value="33"  <? if($seconds_to_hours=="33"){ echo "selected=selected";} ?> >33</option>
                   <option value="34"  <? if($seconds_to_hours=="34"){ echo "selected=selected";} ?> >34</option>
                   <option value="35"  <? if($seconds_to_hours=="35"){ echo "selected=selected";} ?> >35</option>
                   <option value="36"  <? if($seconds_to_hours=="36"){ echo "selected=selected";} ?> >36</option>
                   <option value="37"  <? if($seconds_to_hours=="37"){ echo "selected=selected";} ?> >37</option>
                   <option value="38"  <? if($seconds_to_hours=="38"){ echo "selected=selected";} ?> >38</option>
                   <option value="39"  <? if($seconds_to_hours=="39"){ echo "selected=selected";} ?> >39</option>
                   <option value="40"  <? if($seconds_to_hours=="40"){ echo "selected=selected";} ?> >40</option>
                   <option value="41"  <? if($seconds_to_hours=="41"){ echo "selected=selected";} ?> >41</option>
                   <option value="42"  <? if($seconds_to_hours=="42"){ echo "selected=selected";} ?>>42</option>
                   <option value="43"  <? if($seconds_to_hours=="43"){ echo "selected=selected";} ?> >43</option>
                   <option value="44"  <? if($seconds_to_hours=="44"){ echo "selected=selected";} ?>>44</option>
                   <option value="45"  <? if($seconds_to_hours=="45"){ echo "selected=selected";} ?>>45</option>
                   <option value="46"  <? if($seconds_to_hours=="46"){ echo "selected=selected";} ?> >46</option>
                   <option value="47"  <? if($seconds_to_hours=="47"){ echo "selected=selected";} ?> >47</option>
                   <option value="48"  <? if($seconds_to_hours=="48"){ echo "selected=selected";} ?> >48</option>
               </select>&nbsp; <span>hours after start time</span>
           </td>
       </tr>





       <tr>
           <td colspan="2" class="editor">
               <textarea id="bodycontent" name="alert_content" rows="4" cols="30"><?php echo $row['alert_content']; ?></textarea>
               <?php loadEditor("bodycontent"); ?></td>

       </tr>

      <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo BelmarAlerts_EM_UPDATE;?>" /></td>
      <td><a href="index.php?do=alerts" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>

    </table>
     <input name="belmaralertId" type="hidden" value="<?php echo $contentalerts->belmaralertId; ?>" />
    <input name="user_id" type="hidden" class="inputbox"  size="55" value="<?php echo $user->uid; ?>" />



  </form>

<?php echo $core->doForm("processBelmaralerts","alertscontroller.php");?>



    <script type="text/javascript">

        $('#post_date').dateplustimepicker({
          dateFormat: 'yy-mm-dd',timeFormat: 'hh:mm:ss',dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],dayNamesMin: ['S','M', 'T', 'W', 'T', 'F', 'S'],dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],prevText: 'Earlier',nextText: 'Later',timeText: 'Time',hourText: 'Hour',minuteText: 'minute',secondText: 'second',firstDay: 0,hourGrid: 4,minuteGrid: 10,secondGrid: 10  });


    </script>

<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
 function loadList() {
        $.ajax({
            type: 'post',
            url: "ajax.php",
            data: 'getmenus=1',
            cache: false,
            success: function (html) {
                $("div.sortable").html(html);
            }
        });
    }

    loadList();



    $("#admin_form").ajaxForm({
        target: "#msgholder",
        url: "alertscontroller.php",
        data: {
            processBelmaralerts: 1
        },
        success: showResponse
    });
    function showResponse(msg) {
        $(this).html(msg);
        setTimeout(function () {
            $(loadList()).fadeIn("slow");
        }, 2000);
        $("html, body").animate({
            scrollTop: 0
        }, 600);
    }

    $('div.sortable').nestedSortable({
        forcePlaceholderSize: true,
        handle: 'div',
        helper: 'clone',
        items: 'li',
        opacity: .6,
        placeholder: 'placeholder',
        tabSize: 25,
        tolerance: 'pointer',
        toleranceElement: '> div'
    });

    $('#serialize').live('click', function () {
        serialized = $('.sortable').nestedSortable('serialize');
        serialized += '&sortmenuitems=1';
        $.ajax({
            type: 'post',
            url: "ajax.php",
            data: serialized,
            success: function (msg) {
			$("#msgholder").html(msg);
			  setTimeout(function () {
				  $(loadList()).fadeIn("slow");
			  }, 2000);
            }

        });
    })

    $('a.delete').live('click', function () {
        var id = $(this).attr('id').replace('item_', '')
        var parent = $(this).parent();
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
                    data: 'deleteMenu=' + id + '&menutitle=' + title,
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





</script>
<?php break;?>

<?php
    case"add": ?>

<h1><img src="images/mod-sml.png" alt="" /><?php echo PLG_EM_TITLEalert;?></h1>
<p class="info"><?php echo PLG_EM_INFO2 . _REQ1. required() . _REQ2;?></p>
<h2><?php echo PELMARALERTs_EM_SUBTITLE2;?></h2>
<div style="margin-right:295px">
<form action="" method="post" id="admin_form" name="admin_form">
    <table cellspacing="0" cellpadding="0" class="formtable">


        <tr>
            <td width="150"><?php echo _MU_BelmarAlerts;?>: <?php echo required();?></td>
            <td><input name="title" type="text" class="inputbox" value="" size="55"/>
                <?php echo tooltip(_MU_BelmarAlerts_T);?></td>
        </tr>

        <tr>
            <td width="150"><?php echo _BelmarAlerts_POSTDATE;?>:</td>
            <td><input name="post_date" type="text" class="inputbox" id="post_date" size="55" value="" />

<!--                --><?php //echo tooltip(_POST_DATE_belmarAlerts);?><!--</td>-->
        </tr>


<tr>
          <td><?php echo _Belmaralerts_PUB;?>:</td>
          <td><span class="input-out">
          <label for="active-1"  ><?php echo _YES;?></label>
          <input name="active" type="radio" id="active-1" value="1" checked="checked"/>
          <label for="active-2"><?php echo _NO;?></label>
          <input name="active" type="radio" id="active-2" value="0" />
          </span></td>
        </tr>


        <tr>
            <td><?php echo _BelmarAlerts_Feature;?>:</td>
            <td><span class="input-out">
          <label for="hfeature-1"><?php echo _YES;?></label>
          <input name="hfeature" type="radio" id="active-1" value="1"/>
          <label for="hfeature-2"><?php echo _NO;?></label>
          <input name="hfeature" type="radio" id="active-2" value="0"  checked="checked"  />
          </span></td>
        </tr>

        <tr>


<tr>
       <td><?php echo Unpublished_time;?>:</td>
       <td>
   <select name="un_publishtime" class="custombox" style="width: 125px;">
        <option value="0">System Default</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
        <option value="32">32</option>
        <option value="33">33</option>
        <option value="34">34</option>
        <option value="35">35</option>
        <option value="36">36</option>
        <option value="37">37</option>
        <option value="38">38</option>
        <option value="39">39</option>
        <option value="40">40</option>
        <option value="41">41</option>
        <option value="42">42</option>
        <option value="43">43</option>
        <option value="44">44</option>
        <option value="45">45</option>
        <option value="46">46</option>
        <option value="47">47</option>
        <option value="48">48</option>
 </select>&nbsp; <span>hours after start time</span>
       </td>
    </tr>

        <tr>
            <td colspan="2" class="editor">
                <textarea id="bodycontent" name="alert_content" rows="4" cols="30"></textarea>
                <?php loadEditor("bodycontent"); ?></td>

        </tr>



     <tr>
         <td><input type="submit" name="submit" value="<?php echo _BelmarAlert_ADD;?>" class="button"/></td>
         <td><a href="index.php?do=alerts" class="button-alt"><?php echo _CANCEL;?></a></td>
      </tr>

        <input name="user_id" type="hidden" class="inputbox"  size="55" value="<?php echo $user->uid; ?>" />


    </table>
  </form>
</div>

<?php echo $core->doForm("processBelmaralerts","alertscontroller.php");?>

    <script type="text/javascript">

    $('#post_date').dateplustimepicker({
        dateFormat: 'yy-mm-dd',timeFormat: 'hh:mm:ss',dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],dayNamesMin: ['S','M', 'T', 'W', 'T', 'F', 'S'],dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],prevText: 'Earlier',nextText: 'Later',timeText: 'Time',hourText: 'Hour',minuteText: 'minute',secondText: 'second',firstDay: 0,hourGrid: 4,minuteGrid: 10,secondGrid: 10  });
</script>

 <script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
 function loadList() {
        $.ajax({
            type: 'post',
            url: "ajax.php",
            data: 'getmenus=1',
            cache: false,
            success: function (html) {
                $("div.sortable").html(html);
            }
        });
    }

    loadList();




    $("#admin_form").ajaxForm({
        target: "#msgholder",
        url: "alertscontroller.php",
        data: {
            processBelmaralerts: 1
        },
        success: showResponse
    });
    function showResponse(msg) {
        $(this).html(msg);
        setTimeout(function () {
            $(loadList()).fadeIn("slow");
        }, 2000);
        $("html, body").animate({
            scrollTop: 0
        }, 600);
    }

    $('div.sortable').nestedSortable({
        forcePlaceholderSize: true,
        handle: 'div',
        helper: 'clone',
        items: 'li',
        opacity: .6,
        placeholder: 'placeholder',
        tabSize: 25,
        tolerance: 'pointer',
        toleranceElement: '> div'
    });

    $('#serialize').live('click', function () {
        serialized = $('.sortable').nestedSortable('serialize');
        serialized += '&sortmenuitems=1';
        $.ajax({
            type: 'post',
            url: "ajax.php",
            data: serialized,
            success: function (msg) {
			$("#msgholder").html(msg);
			  setTimeout(function () {
				  $(loadList()).fadeIn("slow");
			  }, 2000);
            }

        });
    })
    $('a.delete').live('click', function () {
        var id = $(this).attr('id').replace('item_', '')
        var parent = $(this).parent();
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





</script>

<?php break;?>

<?php default: ?>

<?php  // $eventrow = $event->getEvent();?>

<h1><img src="images/mod-sml.png" alt="" /><?php echo Belmaralert_EM_TITLE1;?></h1>
<p class="info"><?php echo Pbelamralerts_EM_INFO3;?></p>
<h2><span><a href="index.php?do=alerts&mod_action=add" class="button-sml"><? echo _BelmarAlert_ADD ?></a></span><?php echo Pelmaralerts_EM_SUBTITLE3?></h2>
 <div class="box">
  <table cellpadding="0" cellspacing="0" class="formtable">
        <tr style="background-color:transparent">
<td>

    <form action="" method="post" id="dForm">
        <table>
 <td><span>Search by keyword</span>
     <input name="search" type="text" class="inputbox" id="search-input" value="" size="40"  onclick="disAutoComplete(this);"/>
  <div id="suggestions" style="margin-left: 109px;!important;"></div>
        </td>

            <td>
                <input name="find" type="submit" class="button-sml" value="<?php echo _UR_FIND;?>" />
            </td>
        </table>
    </form>

            </td>

            <td align="right" colspan="3">
                <!--<strong><?php echo _UR_USR_FILTER;?>:</strong>&nbsp;&nbsp;
                <select name="sort" onchange="if(this.value!='NA') window.location='index.php?do=alerts&amp;sort='+this[this.selectedIndex].value; else window.location='index.php?do=alerts';" style="width:220px" class="custombox">
                    <option value="NA"><?php echo _UR_RESET_FILTER;?></option>
                    <?php echo $contentalerts->getbelamralertsFilter();  ?>
                </select>-->
                <?php echo $pager->items_per_page();?> &nbsp;&nbsp;
				<strong><?php echo _C_ACTION;?></strong>&nbsp;&nbsp;
				<select name="sort" style="width:120px" class="custombox group_actions">
					<option value="NA">--none--</option>
					<option value="delete"><?php echo _PG_DELETE;?></option>
					<option value="publish"><?php echo _PUB;?></option>
					<option value="unpublish"><?php echo _UNPUB;?></option>

				</select>
            </td>
        </tr>
    </table>
</div>

<table cellpadding="0" cellspacing="0" class="display">
    <thead>
      <tr>
        <th width="15">#</th>


<?php if(isset($_GET['sort']) && $_GET['sort']=='title-DESC')
    {?>
 <th class="left"><a href="index.php?sort=title-ASC&do=alerts"><img src="images/down.png"/><?php echo belamrAlert_EM_TITLE;?></a></th>
 <?}else{ ?>

 <th class="left"><a href="index.php?sort=title-DESC&do=alerts"><img src="images/up.png"/><?php echo belamrAlert_EM_TITLE;?></a></th>
  <? } ?>



          <?php if(isset($_GET['sort']) && $_GET['sort']=='post_date-DESC')
      {?>
          <th class="left"><a href="index.php?sort=post_date-ASC&do=alerts"><img src="images/down.png"/><?php echo PLG_EM_DSTART;?></a></th>
          <?}else{ ?>
          <th class="left"><a href="index.php?sort=post_date-DESC&do=alerts"><img src="images/up.png"/><?php echo PLG_EM_DSTART;?></a></th>

          <? } ?>
          <?php if(isset($_GET['sort']) && $_GET['sort']=='user_id-DESC')
      {?>
          <th class="center"><a href="index.php?sort=user_id-ASC&do=alerts"><img src="images/down.png"/><?php echo _POSTED_BY;?></a></th>
          <?}else{ ?>

          <th class="center"><a href="index.php?sort=user_id-DESC&do=alerts"><img src="images/up.png"/><?php echo _POSTED_BY;?></a></th>
          <? } ?>



          <th class="center"><?php echo "Status";?></th>
          <th><?php echo PLG_EM_EDIT;?></th>
          <th class="center"><?php echo _DELETE;?></th>
		  <th align=left> <input type='checkbox' class='check_all'/></th>

      </tr>
    </thead>
    <tbody>

      <?php if($alersrow==0):?>
      <tr>
        <td colspan="6"><div class="msgInfo"><?php echo Pemaralerts_EM_NOEVENT2;?></div></td>
      </tr>
      <?php else:?>
        <?php $counter = 0;?>
      <?php foreach ($alersrow as $emrow):?>
            <?php $counter++; ?>
            <?php $sql='select * from users where id='.$emrow['user_id'];
                  $resusers=mysql_query($sql);
        if($resusers)
            {
               $rowsusers=mysql_fetch_array($resusers);
            }
            ?>

<!--    <tr>-->
       <td><?php echo $counter;?>.</td>
       <td><?php echo $emrow['title'];?></td>
        <td><?php echo dodate($core->short_date, $emrow['post_date']);?></td>

      <td align="center"><?php echo $rowsusers['username']; ?></td>




      <?php if($emrow['item_published']==1)
                    {
                        $eventstatus='<img src="images/active.png" alt="" class="tooltip" title="'._Belamr_A.'"/>';
                    }else
                    {
                        $eventstatus='<img src="images/inactive.png" alt="" class="tooltip" title="'._belmaralert_I.'"/>';
                    } ?>
          <td align="center"> <?php echo $eventstatus; ?> </td>
        <td align="center"><a href="index.php?do=alerts&amp;mod_action=edit&amp;belmaralertId=<?php echo $emrow['id'];?>">
            <img src="images/edit.png" class="tooltip"  alt="" title="<?php echo PLG_EM_EDIT.': '.$emrow['title'];?>"/></a>
        </td>   <td align="center">
            <a href="javascript:void(0);" class="delete" rel="<?php echo $emrow['title'];?>" id="item_<?php echo $emrow['id'];?>"><img src="images/delete.png" alt="" class="tooltip" title="<?php echo _DELETE.': '.$emrow['title'];?>" /></a>
        </td>
      <td>
        <input type='checkbox' id='check_<?php echo $row['id'];?>' class='to_be_checked'/>
      </td>
      </tr>
      <?php endforeach;?>
      <?php unset($emrow);?>
        <?php if($pager->items_total >= $pager->items_per_page):?>
        <tr style="background-color:transparent">
            <td colspan="8" style="padding:10px;"><div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
        </tr>


            <?php endif;?>
      <?php endif;?>
    </tbody>

  </table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '.PBelmart_Alerts;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>


<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
    $('table.display th a').css('color','#444');
     $("#search-input").watermark("<?php echo UR_FIND_belmaralertsTitle;?>");
     $("#search-input").keyup(function () {
        var srch_string = $(this).val();
        var data_string = 'belmaralertsearch=' + srch_string;
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

                ;$.ajax({
                    type: 'post',
                    url: "alertscontroller.php",
                    data: 'deleteBelamralert=' + id + '&Belmaralertitle=' + title,
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
                })

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
