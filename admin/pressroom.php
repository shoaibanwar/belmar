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


  if(!$user->checkOperationPermission("pressroom")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;

require_once("../lang/" . $core->language . ".lang.php");

$contentPRoom=new Content();
$PRoomrow=$contentPRoom->getPRoom();

?>
<?php switch($core->maction):


    case "edit": ?>

<?php $row = $core->getRowById("pressroom",$contentPRoom->proomid);?>


<h1><img src="images/mod-sml.png" alt="" /><?php echo PRoom_EM_TITLE1 ;?></h1>
<p class="info"><?php echo _PR_INFO1. _REQ1.required(). _REQ2;?></p>
<h2><?php echo PRoom_EM_SUBTITLE1 . $row['title'.$core->dblang];?></h2>

<form action="" method="post" id="admin_form" name="admin_form">
   <table cellspacing="0" cellpadding="0" class="formtable">
      <tr>
        <td width="150"><?php echo _MU_PROOM;?>: <?php echo required();?></td>
        <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $row['title'.$core->dblang] ?>" size="55"/>
          <?php echo tooltip(_MU_PROOM_T);?></td>
      </tr>

       <tr>
        <td width="150"><?php echo _POSTDATE;?>: <?php echo required();?></td>
        <td><input name="post_date" type="text" class="inputbox" id="post_date" size="55" value="<?php echo $row['post_date'] ?>" />

   <?php echo tooltip(_POST_DATE_PROOM);?></td>
      </tr>


      <tr>
        <td><?php echo _PROOM_TYPE;?>: <?php echo required();?></td>
          <td><select name="content_type" class="custombox" style="width:220px"  onchange="

             if(this.value=='On-site_Content')
           {
        ///   alert('gfdgfdg');
               document.getElementById('areaid').style.display='';
               document.getElementById('site_URL').style.display='none';
               document.getElementById('fupload').style.display='none';
               document.getElementById('idAreaoEdit1').style.display='inline';;
           }
      else if(this.value=='Off-site_URL')
         {
               document.getElementById('idAreaoEdit1').style.display='none'
               document.getElementById('areaid').style.display='none';
               document.getElementById('fupload').style.display='none';
               document.getElementById('site_URL').style.display='table-row';
         }
        else if(this.value=='file_upload')
             {
               document.getElementById('idAreaoEdit1').style.display='none'
               document.getElementById('site_URL').style.display='none';
               document.getElementById('areaid').style.display='none';
               document.getElementById('fupload').style.display='table-row';

             }
        else
             {
                document.getElementById('idAreaoEdit1').style.display='none';
                document.getElementById('site_URL').style.display='none';
                document.getElementById('fupload').style.display='none';
                document.getElementById('areaid').style.display='none';
             }

            ">

          <option value="NA" selected="selected"><?php echo _PROOM_SEL;?></option>
            <?php echo $content->getPRoomContentType($row['type']);?>
          </select>
          &nbsp;<?php echo tooltip(_PROOM_SEL_T);?></td>
      </tr>


<?php //if($row['type']=="On-site_Content"){?>
 <tr>
           <td colspan="2" class="editor" id="areaid" style="display:none;">
               <textarea id="bodycontent" name="on_site_content" rows="4" cols="30"><?php echo $row['on_site_content']; ?></textarea>
               <?php loadEditor("bodycontent"); ?></td>

       </tr>


<!--  --><?//} elseif($row['type']=="Off-site_URL"){?>
       <tr style="display:none; ;" id="site_URL">
           <td><?php echo _MU_LINK;?>:</td>
           <td>
               <input name="Off-site_URL" type="text" class="inputbox required"
	  value="<?php echo $row['off_site_url']?>" size="45" />
	  &nbsp;"<?php echo tooltip(_MU_LINK_T);?>
	  <select name="target" style="width:100px" class="select">
          <option value=""><?php echo  _MU_TARGET ?></option>

        <option value="_blank"<?php if ($row['target'] == "_blank") echo ' selected="selected"';?>><?php echo _MU_TARGET_B;?></option>
            <option value="_self"<?php if ($row['target'] == "_self") echo ' selected="selected"';?>><?php echo _MU_TARGET_S;?></option>



        </select></td>
          </tr>
	  <input name="page_id" type="hidden" value="0" />

       <tr style="display: none;" id="fupload">
           <td> <?php echo _File_Upload; ?>
           <td>
               <input type="text" id="uploadinput" name="uploadlink" size="45" class="inputbox required" >
               <a href="<?php echo ADMINURL."/index.php?do=filemanager&mode=selection";  ?>" rel="iframe-full-full"
                  class="pirobox_gall1" title="Google map full screen, the world :)">
                   <button class="button-sml" id="file_selector">Select / Upload File</button>  </a>
           </td>

           </td>

       </tr>


      <tr>
        <td><?php echo _PROOM_PUB;?>:</td>
        <td><span class="input-out">
          <label for="hfeature-1"><?php echo _YES;?></label>
          <input name="hfeature" type="radio" id="active-1" value="1" <?php getChecked($row['home_feature'], 1); ?> />
          <label for="hfeature-2"><?php echo _NO;?></label>
          <input name="hfeature" type="radio" id="active-2" value="0" <?php getChecked($row['home_feature'], 0); ?>   />
          </span></td>
      </tr>

      <tr>
        <td><?php echo _PROOM_STATUS;?>:</td>
        <td><span class="input-out">
          <label for="active-1"  ><?php echo _ACTIVE;?></label>
          <input name="active" type="radio" id="active-1" value="1" <?php getChecked($row['status'], 1); ?>/>
          <label for="active-2"><?php echo _INACTIVE;?></label>
          <input name="active" type="radio" id="active-2" value="0" <?php getChecked($row['status'],0); ?>  />
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
      <td><input type="submit" name="submit" class="button" value="<?php echo PRoom_EM_UPDATE;?>" /></td>
      <td><a href="index.php?do=modules&amp;action=config&amp;mod=events" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>

<!--       <tr><td><a href="download.php?file=--><?php //echo $row['file_upload']; ?><!--">Download File</a></td></tr>-->

    </table>
     <input name="proomid" type="hidden" value="<?php echo $contentPRoom->proomid; ?>" />
    <input name="user_id" type="hidden" class="inputbox"  size="55" value="<?php echo $user->uid; ?>" />



  </form>

<?php echo $core->doForm("processPressRoom","pressroomcontroller.php");?>



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
        url: "pressroomcontroller.php",
        data: {
            processPressRoom: 1
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


    $('#contenttype').change(function () {
        var option = $(this).val();
        $.get('ajax.php', {
            contenttype: option
        }, function (data) {
            $('#contentId').html(data).show();
        });

    });

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
<h1><img src="images/mod-sml.png" alt="" /><?php echo PLG_EM_TITLE2;?></h1>
<p class="info"><?php echo PLG_EM_INFO2 . _REQ1. required() . _REQ2;?></p>
<h2><?php echo PLG_EM_SUBTITLE2;?></h2>
<div style="margin-right:295px">
<form action="" method="post" id="admin_form" name="admin_form">
    <table cellspacing="0" cellpadding="0" class="formtable">
      <tr>
        <td width="150"><?php echo _MU_PROOM;?>: <?php echo required();?></td>
        <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox" value="" size="55"/>
          <?php echo tooltip(_MU_PROOM_T);?></td>
      </tr>

       <tr>
        <td width="150"><?php echo _POSTDATE;?>: <?php echo required();?></td>
        <td><input name="post_date" type="text" class="inputbox" id="post_date" size="55" />

   <?php echo tooltip(_POST_DATE_PROOM);?></td>
      </tr>

<!--      id="contenttype"-->
      <tr>
        <td><?php echo _PROOM_TYPE;?>: <?php echo required();?></td>
          <td><select name="content_type" class="custombox" style="width:220px" id="" onchange="
           if(this.value=='On-site_Content')
           {
        ///   alert('gfdgfdg');
               document.getElementById('areaid').style.display='';
               document.getElementById('site_URL').style.display='none';
               document.getElementById('fupload').style.display='none';
               document.getElementById('idAreaoEdit1').style.display='inline';;
           }
      else if(this.value=='Off-site_URL')
         {
               document.getElementById('idAreaoEdit1').style.display='none'
               document.getElementById('areaid').style.display='none';
               document.getElementById('fupload').style.display='none';
               document.getElementById('site_URL').style.display='table-row';
         }
        else if(this.value=='file_upload')
             {
               document.getElementById('idAreaoEdit1').style.display='none'
               document.getElementById('site_URL').style.display='none';
               document.getElementById('areaid').style.display='none';
               document.getElementById('fupload').style.display='table-row';

             }
        else
             {
                document.getElementById('idAreaoEdit1').style.display='none';
                document.getElementById('site_URL').style.display='none';
                document.getElementById('fupload').style.display='none';
                document.getElementById('areaid').style.display='none';
             }

            ">



            <option value="NA" selected="selected" ><?php echo _PROOM_SEL;?></option>
            <?php echo $content->getPRoomContentType();?>
          </select>
          &nbsp;<?php echo tooltip(_PROOM_SEL_T);?></td>
      </tr>

      <tr>
          <td colspan="2" class="editor" id="areaid" style="display: none;">
                <textarea id="bodycontent" name="on_site_content" rows="4" cols="30"></textarea>
                <?php loadEditor("bodycontent"); ?></td>

          </tr>

<tr style="display: none;" id="site_URL">
    <td><?php echo _MU_LINK;?>:</td>
    <td>
        <input name="Off-site_URL"  type="text" class="inputbox required" value="" size="45"/>
        &nbsp;"<?php echo tooltip(_MU_LINK_T);?>
        <select name="target" style="width:100px" class="select">
            <option value="" selected="selected"><?php echo  _MU_TARGET ?></option>
            <option value="_blank" ><?php echo _MU_TARGET_B;?></option>
            <option value="_self"><?php echo _MU_TARGET_S;?></option>



        </select>
    </td></tr>
<tr style="display: none;" id="fupload">
    <td> <?php echo _File_Upload; ?>
        <td>
            <input type="text" id="uploadinput" name="uploadlink" size="45" class="inputbox required" >
    <a href="<?php echo ADMINURL."/index.php?do=filemanager&mode=selection";  ?>" rel="iframe-full-full"
       class="pirobox_gall1" title="Google map full screen, the world :)">
        <button class="button-sml" id="file_selector">Select / Upload File</button>  </a>
        </td>

    </td>

</tr>


 <tr>
        <td><?php echo _PROOM_PUB;?>:</td>
        <td><span class="input-out">
          <label for="hfeature-1"><?php echo _YES;?></label>
          <input name="hfeature" type="radio" id="active-1" value="1" checked="checked" />
          <label for="hfeature-2"><?php echo _NO;?></label>
          <input name="hfeature" type="radio" id="active-2" value="0"   />
          </span></td>
      </tr>

      <tr>
        <td><?php echo _PROOM_STATUS;?>:</td>
        <td><span class="input-out">
          <label for="active-1"><?php echo _YES;?></label>
          <input name="active" type="radio" id="active-1" value="1" />
          <label for="active-2"><?php echo _NO;?></label>
          <input name="active" type="radio" id="active-2" value="0" checked="checked"  />
          </span></td>
      </tr>



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
         <td><input type="submit" name="submit" value="<?php echo _PROOM_ADD;?>" class="button"/></td>
         <td><a href="index.php?do=pressroom" class="button-alt"><?php echo _CANCEL;?></a></td>
      </tr>

        <input name="proomid" type="hidden" value="<?php echo $contentPRoom->proomid; ?>" />
        <input name="user_id" type="hidden" class="inputbox"  size="55" value="<?php echo $user->uid; ?>" />


    </table>
  </form>
</div>

<?php echo $core->doForm("processPressRoom","pressroomcontroller.php");

?>
    <script type="text/javascript">
        document.getElementById("idAreaoEdit1").style.display = "none";
//        textarea.style.visibility='hidden';
//        document.getElementById("site_URL").style.display = "none";


    </script>

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
        url: "pressroomcontroller.php",
        data: {
            processPressRoom: 1
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


    $('#contenttype').change(function () {
        var option = $(this).val();
        $.get('ajax.php', {
            contenttype: option
        }, function (data) {
            $('#contentId').html(data).show();
        });

    });

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
    default: ?>

<?php  // $eventrow = $event->getEvent();?>

<h1><img src="images/mod-sml.png" alt="" /><?php echo PRoom_EM_TITLE1;?></h1>
<p class="info"><?php echo PLG_EM_INFO3;?></p>
<h2><span><a href="index.php?do=pressroom&mod_action=add" class="button-sml"><? echo Add_New_Press_Room ?></a></span><?php echo PLG_EM_SUBTITLE3;?></h2>
 <div class="box">
  <table cellpadding="0" cellspacing="0" class="formtable">
        <tr style="background-color:transparent">
<td>

    <form action="" method="post" id="dForm">
        <table>
 <td><span>Search by keyword: </span>    <input name="search" type="text" class="inputbox" id="search-input" value="" size="40"  onclick="disAutoComplete(this);"/>
  <div id="suggestions" style="margin-left: 105px;!important;"></div>
        </td>

            <td>
                <input name="find" type="submit" class="button-sml" value="<?php echo _UR_FIND;?>" />
            </td>
        </table>
    </form>

            </td>

            <td align="right" colspan="3">
                <!--<strong><?php echo _UR_USR_FILTER;?>:</strong>&nbsp;&nbsp;
                <select name="sort" onchange="if(this.value!='NA') window.location='index.php?do=pressroom&amp;sort='+this[this.selectedIndex].value; else window.location='index.php?do=pressroom';" style="width:220px" class="custombox">
                    <option value="NA"><?php echo _UR_RESET_FILTER;?></option>
                    <?php echo $contentPRoom->getPRoomFilter();  ?>
                </select>-->
                <?php echo $pager->items_per_page();?> &nbsp;&nbsp;
                <?php //if($pager->num_pages >= 1) echo $pager->jump_menu();?>
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


<?php if(isset($_GET['sort']) && $_GET['sort']=='title_en-DESC')
    {?>
 <th class="left"><a href="index.php?sort=title_en-ASC&do=pressroom"><img src="images/down.png"/><?php echo PRoom_EM_TITLE;?></a></th>
 <?}else{ ?>

 <th class="left"><a href="index.php?sort=title_en-DESC&do=pressroom"><img src="images/up.png"/><?php echo PRoom_EM_TITLE;?></a></th>
  <? } ?>



     <?php if(isset($_GET['sort']) && $_GET['sort']=='post_date-DESC')
    {?>
          <th class="left"><a href="index.php?sort=post_date-ASC&do=pressroom"><img src="images/down.png"/><?php echo PLG_EM_DSTART;?></a></th>
     <?}else{ ?>
          <th class="left"><a href="index.php?sort=post_date-DESC&do=pressroom"><img src="images/up.png"/><?php echo PLG_EM_DSTART;?></a></th>

         <? } ?>
           <?php if(isset($_GET['sort']) && $_GET['sort']=='user_id-DESC')
      {?>
          <th class="center"><a href="index.php?sort=user_id-ASC&do=pressroom"><img src="images/down.png"/><?php echo _POSTED_BY;?></a></th>
          <?}else{ ?>

          <th class="center"><a href="index.php?sort=user_id-DESC&do=pressroom"><img src="images/up.png"/><?php echo _POSTED_BY;?></a></th>
          <? } ?>




          <th class="center"><?php echo "Status";?></th>
          <th><?php echo PLG_EM_EDIT;?></th>
          <th><?php echo _DELETE;?></th>
		  <th align=left> <input type='checkbox' class='check_all'/></th>

      </tr>
    </thead>
    <tbody>

      <?php if($PRoomrow == 0):?>
      <tr>
        <td colspan="6"><div class="msgInfo"><?php echo PLG_EM_NOEVENT;?></div></td>
      </tr>
      <?php else:?>
      <?php foreach ($PRoomrow as $emrow):?>
            <?php $sql='select * from users where id='.$emrow['user_id'];
                  $resusers=mysql_query($sql);
        if($resusers)
            {
               $rowsusers=mysql_fetch_array($resusers);
            }
            ?>

<!--    <tr>-->
       <td><?php echo $emrow['id'];?>.</td>
       <td><?php echo $emrow['title'.$core->dblang];?></td>
        <td><?php echo dodate($core->short_date, $emrow['post_date']);?></td>

      <td align="center"><?php echo $rowsusers['username']; ?></td>




      <?php if($emrow['status']==1)
                    {
                        $eventstatus='<img src="images/active.png" alt="" class="tooltip" title="'.PRoom_EM_TSTATUS.'"/>';
                    }else
                    {
                        $eventstatus='<img src="images/inactive.png" alt="" class="tooltip" title="'.PRoom_EM_TSTATUSUn.'"/>';
                    } ?>
          <td align="center"> <?php echo $eventstatus; ?> </td>
        <td align="center"><a href="index.php?do=pressroom&amp;mod_action=edit&amp;proomid=<?php echo $emrow['id'];?>">
            <img src="images/edit.png" class="tooltip"  alt="" title="<?php echo PLG_EM_EDIT.': '.$emrow['title'.$core->dblang];?>"/></a>
            </td><td align="center">
            <a href="javascript:void(0);" class="delete" rel="<?php echo $emrow['title'.$core->dblang];?>" id="item_<?php echo $emrow['id'];?>"><img src="images/delete.png" alt="" class="tooltip" title="<?php echo _DELETE.': '.$emrow['title'.$core->dblang];?>" /></a>
        </td>
        <td>
          <input type='checkbox' id='check_<?php echo $row['id'];?>' class='to_be_checked'/>
        </td>
      </tr>
      <?php endforeach;?>
      <?php unset($slrow);?>
        <?php if($pager->items_total >= $pager->items_per_page):?>
        <tr style="background-color:transparent">
            <td colspan="8" style="padding:10px;"><div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
        </tr>


            <?php endif;?>
      <?php endif;?>
    </tbody>

  </table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '.PLG_EM_PRoom;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>


<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
     $('table.display th a').css('color','#444');
     $("#search-input").watermark("<?php echo UR_FIND_PressRoomTitle;?>");
     $("#search-input").keyup(function () {
        var srch_string = $(this).val();
        var data_string = 'pressroomsearch=' + srch_string;
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
                    url: "pressroomcontroller.php",
                    data: 'deleteProom=' + id + '&proomtitle=' + title,
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

    $('#file_selector').live('click',function(){

    })
});
// ]]>
</script>
<?php break;?>


<?php endswitch;?>
