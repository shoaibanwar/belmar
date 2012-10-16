<script src="<?php echo SITEURL;?>/assets/jquery.maskedinput-1.3.min.js" type="text/javascript"></script>
<?php
  /**
   * Event Manager
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @version $Id: admin.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))

      die('Direct access to this location is not allowed.');

//////////  if(!$user->getAcl("events") && $user->userlevel !=8 && $user->userlevel !=1): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;




  require_once("lang/" . $core->language . ".lang.php");
 require_once("admin_class.php");

//if($user->getPermittedTypes('events') == '0' && $user->userlevel !=9 ): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;

$event_ev = new eventManager();
  $eventrow = $event_ev->getEvents($user->uid);

$pager->paginate();
?>
<?php switch($core->maction):


 case "edit": ?>

 <?php //--------------------------------------------Edit----------------------------------------------------------// ?>

<?php if(!$event_ev->checkEventPermission()): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif; ?>


 <?php $row = $core->getRowById("mod_events", $event_ev->eventid);?>

<h1><img src="images/mod-sml.png" alt="" /><?php echo PLG_EM_TITLE1;?></h1>
<p class="info"><?php echo _UR_INFO1. _REQ1. required() . _REQ2;?></p>
<h2><?php echo PLG_EM_SUBTITLE1 . $row['title'.$core->dblang];?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo PLG_EM_TITLE;?>: <?php echo required();?></td>
      <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $row['title'.$core->dblang];?>" size="55" /></td>
    </tr>

    <tr>
          <td>Item Type: <?php echo required();?></td>
          <?php
          $sqleventtypes='select * from event_types';
          if($user->userlevel!=9)
          {
              $types = $user->get_permitted_events();
              $types = implode(',',$types);
              $sqleventtypes="select * from event_types where id in ($types)";

          }
          $resulttype=  mysql_query($sqleventtypes);
          $event_id=$_REQUEST['eventid'];
          $sqlevent="select * from mod_events where id=$event_id";
          $resultevent=mysql_query($sqlevent);
          $rowevent= mysql_fetch_array($resultevent);

          ?>
          <td><select name="type" class="custombox" style="width:200px">
              <?
              $event_id=$_REQUEST['eventid'];
              $sqlevent="select * from mod_events where id=$event_id";
              $resultevent=mysql_query($sqlevent);
              $rowevent= mysql_fetch_array($resultevent);


              while($rows=  mysql_fetch_array($resulttype))
              {

                  if($rowevent['type']==$rows['id'])
                  {$sel="selected=selected";}
                  else{$sel="";}

                  ?>
                  <option <?= $sel ?> value="<?= $rows['id'];  ?>"><?= $rows['event_name']; ?></option>

                  <?}
              ?>
          </select> </td>



      </tr>
    <tr>
      <td><?php echo PLG_EM_VENUE;?>:</td>
      <td><input name="venue<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $row['venue'.$core->dblang];?>" size="55" /></td>
    </tr>



      <tr>
          <td><?php echo PLG_EM_VENUEaddress;?>:</td>
          <td><input name="venueaddress" type="text" class="inputbox"  size="55" value="<?php echo $row['address']; ?>" /></td>
      </tr>
      <tr>


      <tr>
          <td><?php echo PLG_EM_VENUEcity;?>:</td>
          <td><input name="venuecity" type="text" class="inputbox"  size="55" value="New Jersey"  /></td>
      </tr>
      <tr>



      <tr>
          <td><?php echo PLG_EM_VENUEstate;?>:</td>
          <td><input name="venuestate" type="text" class="inputbox"  size="55" value="USA"  /></td>
      </tr>
      <tr>



      <tr>
          <td><?php echo PLG_EM_VENUEzipcode;?>:</td>
          <td><input name="venuezipcode" type="text" class="inputbox"  size="55" value="<?php echo $row['zipcode']; ?>" /></td>
      </tr>
      <tr>

    <tr>
        <td>Venue Telephone:</td>
        <td>
            <!--<input name="contact_phone" id="phone-input" type="text" class="inputbox" value="--><?php //echo $row['contact_phone'];?><!--" size="55" />-->
            <?php         $telephone1="";
            $telephone2="";
            $telephone3="";
            if($row['contact_phone']!="" || $row['contact_phone']!=null){
                $telephone=explode("-",$row['contact_phone']);

                if($telephone[0]!="" || $telephone[0]!=null)
                    $telephone1=$telephone[0];
                else $telephone1="";

                if($telephone[1]!="" || $telephone[1]!=null)
                    $telephone2=$telephone[1];
                else $telephone2="";

                if($telephone[2]!="" || $telephone[2]!=null)
                    $telephone3=$telephone[2];
                else $telephone3="";?>

                <?          }else
            {
                $telephone1="";
                $telephone2="";
                $telephone3="";
            }

            ?>

            <input name="contact_phone1" type="text" class="inputbox" size="3"  maxlength="3" value="<?php echo $telephone1; ?>" />-
            <input name="contact_phone2" type="text" class="inputbox" size="3"  maxlength="3" value="<?php echo $telephone2; ?>" />-
            <input name="contact_phone3" type="text" class="inputbox" size="4"  maxlength="4" value="<?php echo $telephone3  ?>"  />

        </td>
    </tr>

      <tr>


          <td>Item Published:</td>
          <td><span class="input-out">
        <label for="active-1"><?php echo _YES;?></label>
        <input name="active" type="radio" id="active-1" value="1" <?php getChecked($row['active'], 1); ?> />
        <label for="active-2"><?php echo _NO;?></label>
        <input name="active" type="radio" id="active-2" value="0" <?php getChecked($row['active'], 0); ?> />
        </span></td>
      </tr>

    <tr>
        <td>Feature On Home Page:</td>
        <td><span class="input-out">
        <label for="feature_on_homepage-1"><?php echo _YES;?></label>
        <input name="feature_on_homepage" type="radio" id="active-1" value="1"<?php getChecked($row['feature_on_homepage'], 1); ?>  />
        <label for="feature_on_homepage-2"><?php echo _NO;?></label>
        <input name="feature_on_homepage" type="radio" id="active-2" value="0" <?php getChecked($row['feature_on_homepage'], 0); ?>  />
        </span></td>
    </tr>

      <td>Date/Time Start:<?php echo required();?></td>
      <td><input name="date_start" type="text" class="inputbox" id="date_start" value="<?php echo $row['date_start'].' '.$row['time_start'];?>" size="25"/></td>
    </tr>

    <tr>
        <td>Date/Time End:<?php echo required();?></td>
        <td><input name="date_end" type="text" class="inputbox" id="date_end" value="<?php echo $row['date_end'].' '.$row['time_end'];?>" size="25"/></td>

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
      <textarea id="bodycontent" name="body<?php echo $core->dblang;?>" rows="4" cols="30"><?php echo $core->in_url($row['body'.$core->dblang]);?></textarea>
      <?php  loadEditor("bodycontent"); ?></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo PLG_EM_UPDATE;?>" /></td>
      <td><a href="index.php?do=modules&amp;action=config&amp;mod=events" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
  <input name="eventid" type="hidden" value="<?php echo $event_ev->eventid;?>" />
</form>
<?php echo $core->doForm("processEvent","modules/events/controller.php");?>

<?php break;?>




<?php case"add": ?>


<?php //-------------------------------------------Add---------------------------------------------------------//?>


<h1><img src="images/mod-sml.png" alt="" /><?php echo PLG_EM_EVEntaddTITLE;?></h1>
<p class="info"><?php echo PLG_EM_EVENtsaddINFO2 . _REQ1. required() . _REQ2;?></p>
<h2><?php echo PLG_EM_SUBTITLEadd2;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200">Item Title: <?php echo required();?></td>
      <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox" size="55" /></td>
  </tr>


    <tr>
        <td>Item type: <?php echo required();?></td>
        <?php
        $sqleventtypes='select * from event_types';

        if($user->userlevel!=9)
        {
            $types = $user->get_permitted_events();
            $types = implode(',',$types);
            $sqleventtypes="select * from event_types where id in ($types)";

        }
        $result=  mysql_query($sqleventtypes);
        ?>
        <td><select name="type" class="custombox" style="width:200px" >
            <!--        <option value='0'>Community(ALL)</option>-->
            <?
            while($rows=  mysql_fetch_array($result))
            {?>
                <option value="<?= $rows['id'];  ?>"><?= $rows['event_name']; ?></option>

                <?}
            ?>
        </select> </td>

    </tr>


      <tr>
          <td><?php echo PLG_EM_VENUE;?>:</td>
          <td><input name="venue<?php echo $core->dblang;?>" type="text" class="inputbox" value="" size="55" /></td>
      </tr>



      <tr>
      <td><?php echo PLG_EM_VENUEaddress;?>:</td>
      <td><input name="venueaddress" type="text" class="inputbox"  size="55" /></td>
    </tr>
    <tr>


      <tr>
          <td><?php echo PLG_EM_VENUEcity;?>:</td>
          <td><input name="venuecity" type="text" class="inputbox"  size="55" value=""  /></td>
      </tr>
      <tr>



      <tr>
          <td><?php echo PLG_EM_VENUEstate;?>:</td>


<td>

      <select name="venuestate" class="custombox" style="width: 200px">
          <option value="" selected="selected">Select a State</option>
         <option value="Alabama">Alabama</option>
         <option value="Alaska">Alaska</option>
         <option value="Arizona">Arizona</option>
         <option value="Arkansas">Arkansas</option>
         <option value="California">California</option>
         <option value="Colorado">Colorado</option>
         <option value="Connecticut">Connecticut</option>
         <option value="Delaware">Delaware</option>
          <option value="District Of Columbia">District Of Columbia</option>
          <option value="Florida">Florida</option>
          <option value="Georgia">Georgia</option>
          <option value="Hawaii">Hawaii</option>
          <option value="Idaho">Idaho</option>
         <option value="Illinois">Illinois</option>
          <option value="Indiana">Indiana</option>
          <option value="Iowa">Iowa</option>
          <option value="Kansas">Kansas</option>
          <option value="Kentucky">Kentucky</option>
          <option value="Louisiana">Louisiana</option>
          <option value="Maine">Maine</option>
          <option value="Maryland">Maryland</option>
          <option value="Massachusetts">Massachusetts</option>
          <option value="Michigan">Michigan</option>
          <option value="Minnesota">Minnesota</option>
         <option value="Mississippi">Mississippi</option>
          <option value="Missouri">Missouri</option>
          <option value="Montana">Montana</option>
          <option value="Nebraska">Nebraska</option>
          <option value="Nevada">Nevada</option>
          <option value="New Hampshire">New Hampshire</option>
          <option value="New Jersey" selected="selected" >New Jersey</option>
          <option value="New Mexico">New Mexico</option>
          <option value="New York">New York</option>
          <option value="North Carolina">North Carolina</option>
          <option value="North Dakota">North Dakota</option>
          <option value="Ohio">Ohio</option>
          <option value="Oklahoma">Oklahoma</option>
          <option value="Oregon">Oregon</option>
          <option value="Pennsylvania">Pennsylvania</option>
          <option value="Rhode Island">Rhode Island</option>
          <option value="South Carolina">South Carolina</option>
          <option value="South Dakota">South Dakota</option>
          <option value="Tennessee">Tennessee</option>
          <option value="Texas">Texas</option>
          <option value="Utah">Utah</option>
          <option value="Vermont">Vermont</option>
          <option value="Virginia">Virginia</option>
          <option value="Washington">Washington</option>
          <option value="West Virginia">West Virginia</option>
          <option value="Wisconsin">Wisconsin</option>
          <option value="Wyoming">Wyoming</option>
          </select>

</td>

      </tr>
      <tr>
      <tr>
          <td><?php echo PLG_EM_VENUEzipcode;?>:</td>
          <td><input name="venuezipcode" type="text" class="inputbox"  size="55" /></td>
      </tr>
    <tr>
        <td>Venue Telephone:</td>
        <td>
<!--        <input name="contact_phone" type="text" class="inputbox" size="55" id="phone-input"  />-->
            <input name="contact_phone1" type="text" class="inputbox" size="3"  maxlength="3"  />-
            <input name="contact_phone2" type="text" class="inputbox" size="3"  maxlength="3" />-
            <input name="contact_phone3" type="text" class="inputbox" size="4"  maxlength="4"  />


        </td>

    </tr>
    <tr>
        <td>Item Published:</td>
        <td><span class="input-out">
        <label for="active-1"><?php echo _YES;?></label>
        <input name="active" type="radio" id="active-1" value="1" checked="checked" />
        <label for="active-2"><?php echo _NO;?></label>
        <input name="active" type="radio" id="active-2" value="0" />
        </span></td>
    </tr>



    <tr>
        <td>Feature On Home Page:</td>
        <td><span class="input-out">
        <label for="feature_on_homepage-1"><?php echo _YES;?></label>
        <input name="feature_on_homepage" type="radio" id="active-1" value="1" checked="checked" />
        <label for="feature_on_homepage-2"><?php echo _NO;?></label>
        <input name="feature_on_homepage" type="radio" id="active-2" value="0" />
        </span></td>
    </tr>
    
<!--    <tr>-->
<!--      <td>--><?php //echo PLG_EM_CONTACT;?><!--:</td>-->
<!--      <td><input name="contact_person" type="text" class="inputbox" size="55" /></td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--      <td>--><?php //echo PLG_EM_EMAIL;?><!--:</td>-->
<!--      <td><input name="contact_email" type="text" class="inputbox" size="55" /></td>-->
<!--    </tr>-->


    <tr>
      <td>Date/Time Start:<?php echo required();?> </td>
      <td><input name="date_start" type="text" class="inputbox" id="date_start" size="25" /></td>
    </tr>

    <tr>
      <td>Date/Time End:<?php echo required();?></td>
      <td><input name="date_end" type="text" class="inputbox" id="date_end" size="25" /></td>
    </tr>

<!--      <tr>-->
<!--          <td>--><?php //echo PLG_EM_duration;?><!--:</td>-->
<!--      <td>    --><?php //echo PLG_EM_days;?><!--:-->
<!--         <input name="days" type="text" class="inputbox" id="" size="5" />-->
<!---->
<!--          --><?php //echo PLG_EM_hours;?><!--:-->
<!---->
<!--     <select name="hours">-->
<!--          <option value="0">00</option>-->
<!--          <option value="1">01</option>-->
<!--          <option value="2">02</option>-->
<!--          <option value="3">03</option>-->
<!--          <option value="4">04</option>-->
<!--          <option value="5">05</option>-->
<!--          <option value="6">06</option>-->
<!--          <option value="7">07</option>-->
<!--          <option value="8">08</option>-->
<!--          <option value="9">09</option>-->
<!--          <option value="10">10</option>-->
<!--          <option value="11">11</option>-->
<!--          <option value="12">12</option>-->
<!--          <option value="13">13</option>-->
<!--          <option value="14">14</option>-->
<!--          <option value="15">15</option>-->
<!--          <option value="16">16</option>-->
<!--          <option value="17">17</option>-->
<!--          <option value="18">18</option>-->
<!--          <option value="19">19</option>-->
<!--          <option value="20">20</option>-->
<!--          <option value="21">21</option>-->
<!--          <option value="22">22</option>-->
<!--          <option value="23">23</option>-->
<!--          -->
<!--          -->
<!--      </select>-->
<!---->
<!--         --><?php //echo PLG_EM_minuties;?><!--:-->
<!---->
<!--          <select name="minutes">-->
<!--          <option value="0">00</option>-->
<!--          <option value="1">01</option>-->
<!--          <option value="2">02</option>-->
<!--          <option value="3">03</option>-->
<!--          <option value="4">04</option>-->
<!--          <option value="5">05</option>-->
<!--          <option value="6">06</option>-->
<!--          <option value="7">07</option>-->
<!--          <option value="8">08</option>-->
<!--          <option value="9">09</option>-->
<!--          <option value="10">10</option>-->
<!--          <option value="11">11</option>-->
<!--          <option value="12">12</option>-->
<!--          <option value="13">13</option>-->
<!--          <option value="14">14</option>-->
<!--          <option value="15">15</option>-->
<!--          <option value="16">16</option>-->
<!--          <option value="17">17</option>-->
<!--          <option value="18">18</option>-->
<!--          <option value="19">19</option>-->
<!--          <option value="20">20</option>-->
<!--          <option value="21">21</option>-->
<!--          <option value="22">22</option>-->
<!--          <option value="23">23</option>-->
<!--          <option value="24">24</option>-->
<!--          <option value="25">25</option>-->
<!--          <option value="26">26</option>-->
<!--          <option value="27">27</option>-->
<!--          <option value="28">28</option>-->
<!--          <option value="29">29</option>-->
<!--          <option value="30">30</option>-->
<!--          <option value="31">31</option>-->
<!--          <option value="32">32</option>-->
<!--          <option value="33">33</option>-->
<!--          <option value="34">34</option>-->
<!--          <option value="35">35</option>-->
<!--          <option value="36">36</option>-->
<!--          <option value="37">37</option>-->
<!--          <option value="38">38</option>-->
<!--          <option value="39">39</option>-->
<!--          <option value="40">40</option>-->
<!--          <option value="41">41</option>-->
<!--          <option value="42">42</option>-->
<!--          <option value="43">43</option>-->
<!--          <option value="44">44</option>-->
<!--          <option value="45">45</option>-->
<!--          <option value="46">46</option>-->
<!--           <option value="47">47</option>-->
<!--          <option value="48">48</option>-->
<!--          <option value="49">49</option>-->
<!--          <option value="50">50</option>-->
<!--          <option value="51">51</option>-->
<!--          <option value="52">52</option>-->
<!--          <option value="53">53</option>-->
<!--          <option value="54">54</option>-->
<!--          <option value="55">55</option>-->
<!--          <option value="56">56</option>-->
<!--          <option value="57">57</option>-->
<!--          <option value="58">58</option>-->
<!--          <option value="59">59</option>-->
<!--         -->
<!--          -->
<!--      </select>-->
<!--       </td>-->
<!--      </tr>-->



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
      <textarea id="bodycontent" name="body<?php echo $core->dblang;?>" rows="4" cols="30"></textarea>
      <?php loadEditor("bodycontent"); ?></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo PLG_EM_ADD;?>" /></td>
      <td><a href="index.php?do=modules&amp;action=config&amp;mod=events" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
</form>
<?php echo $core->doForm("processEvent","modules/events/controller.php");?>





<?php break;?>



<?php

    case"view": ?>
<h1><img src="images/mod-sml.png" alt="" /><?php echo PLG_EM_TITLE4;?></h1>
<p class="info"><?php echo PLG_EM_INFO4;?></p>
<div id="cal-wrap"><?php $event_ev->renderCalendar();?></div>
<script type="text/javascript">
// <![CDATA[
  function loadList() {
	  $.ajax({
		  url: "modules/events/calendar.php",
		  cache: false,
		  success: function (html) {
			  $("#cal-wrap").html(html);
		  }
	  });
  }

  $(function () {
	  $(".loadevent").live("click", function (event) {
		  var id = $(this).attr('id').replace('eventid_', '');
		  var mytext = $("#eid_" + id).html();
		  var title = $("#eid_" + id).attr('title');

		  $('<div id="event-dialog" title="' + title + '">' + mytext + '</div>').appendTo('body');
		  event.preventDefault();

		  $("#event-dialog").dialog({
			  width: 450,
			  height: "auto",
			  modal: true,
			  close: function (event, ui) {
				  $("#event-dialog").remove();
			  }
		  });
	  });
  });

  $(document).ready(function () {
	  $("a.changedate").live("click", function () {
		  var parent = $(this);
		  var caldata = $(this).attr('id').replace('item_', '');
		  var month = caldata.split(":")[0];
		  var year = caldata.split(":")[1];
		  $.ajax({
			  type: "POST",
			  url: "modules/events/calendar.php",
			  data: {
				  'year': year,
				  'month': month
			  },
			  success: function (data, status) {
				  $("#cal-wrap").fadeIn("fast", function () {
					  $(this).html(data);
				  });
			  }
		  });
		  return false;
	  });
  });
// ]]>
</script>
<?php break;?>

<?php default: ?>

<?php //---------------------------------------------Manage----------------------------------------------------// ?>


<?php  $eventrow = $event_ev->getEvents();?>

<h1><img src="images/mod-sml.png" alt="" /><?php echo PLG_EM_TITLE3;?></h1>
<p class="info"><?php echo Pevents_EM_INFO3;?></p>
<h2><span><a target="_blank" href="index.php?do=modules&amp;action=config&amp;mod=events&amp;mod_action=view" class="button-sml"><?php echo PLG_EM_VIEWCAL;?></a>
<a href="index.php?do=modules&amp;action=config&amp;mod=events&amp;mod_action=add" class="button-sml"><?php echo PLG_EM_ADD;?></a></span><?php echo Pevent_EM_SUBTITLE3;?></h2>
<div class="box">
    <table cellpadding="0" cellspacing="0" class="formtable">
        <tr style="background-color:transparent">
<td>

    <form action="" method="post" id="dForm">
        <table>
           
                        <td><span>Search by keyword</span><input name="search" type="text" class="inputbox" id="search-input" value="" size="40"  onclick="disAutoComplete(this);"/>


          
            <?php //comment for commit ?>
        </td>

            <td>
               <input name="find" type="submit" class="button-sml" value="Go" />

            </td>
    </table>
            </form>
            </td>

            <td>
                <span>Show By Type: </span>
                <?php
                $sqleventtypes='select * from event_types';

                if($user->userlevel!=9)
                {
                    $types = $user->get_permitted_events();
                    $types = implode(',',$types);
                    $sqleventtypes="select * from event_types where id in ($types)";

                }
                $result=  mysql_query($sqleventtypes);
                ?>
            <td><select name="type" class="custombox" style="width:200px" onchange="javascript:handleTypeSelect(this)">
                <!--        <option value='0'>Community(ALL)</option>-->
                <?
                while($rows=  mysql_fetch_array($result))
                {?>
<!--                    <option value="--><?//= $rows['id'];  ?><!--">--><?//= $rows['event_name']; ?><!--</option>-->


                    <option <?php if(isset($_GET['type_id']) && $rows['id'] == $_GET['type_id']) echo "selected='selected'"; ?> value="<?php echo $rows['id']; ?>"><?php echo $rows['event_name']; ?></option>


                    <?}
                ?>
            </select>


            <td align="right" colspan="3">
                <strong><?php echo _UR_USR_FILTER;?>:</strong>&nbsp;&nbsp;
                <select name="sort" onchange="if(this.value!='NA') window.location='index.php?do=modules&action=config&mod=events&amp;sort='+this[this.selectedIndex].value; else window.location='index.php?do=modules&action=config&mod=events';" style="width:220px" class="custombox">
                    <option value="NA"><?php echo _UR_RESET_FILTER;?></option>
                    <?php echo $event_ev->getEventFilter();?>


                </select>
            </td>
        </tr>
        <tr style="background-color:transparent">
            <td colspan="3">
                <img src="images/active.png" class="tooltip" alt="" title="<?php echo _Event_A;?>"/> <?php echo _Event_A;?> <img src="images/inactive.png" class="tooltip" alt="" title="<?php echo _Event_I;?>"/> <?php echo _Event_I;?>

            </td>

            <td align="right">
                <?php echo $pager->items_per_page();?> &nbsp;&nbsp;
                <?php if($pager->num_pages >= 1) echo $pager->jump_menu();?></td>

        </tr>
    </table>
</div>

<table cellpadding="0" cellspacing="0" class="display">
    <thead>
      <tr>
        <th width="15">#</th>
        
       
<?php if(isset($_GET['sort']) && $_GET['sort']=='title_en-DESC')
    {?>  
 <th class="left"><a href="index.php?sort=title_en-ASC&do=modules&action=config&mod=events"><img src="images/down.png"/><?php echo PLG_EM_TITLE;?></a></th>
 <?}else{ ?>
    
 <th class="left"><a href="index.php?sort=title_en-DESC&do=modules&action=config&mod=events"><img src="images/up.png"/><?php echo PLG_EM_TITLE;?></a></th>
  <? } ?>


          <?php if(isset($_GET['sort']) && $_GET['sort']=='type-DESC')
      {?>
          <th class="left"><a href="index.php?sort=type-ASC&do=modules&action=config&mod=events"><img src="images/down.png"/><?php echo PLG_Type;?></a></th>
          <?}else{ ?>

          <th class="left"><a href="index.php?sort=type-DESC&do=modules&action=config&mod=events"><img src="images/up.png"/><?php echo PLG_Type;?></a></th>
          <? } ?>





     <?php if(isset($_GET['sort']) && $_GET['sort']=='date_start-DESC')
    {?>  
          <th class="left"><a href="index.php?sort=date_start-ASC&do=modules&action=config&mod=events"><img src="images/down.png"/><?php echo PLG_EM_DateSTART;?></a></th>
     <?}else{ ?>
          <th class="left"><a href="index.php?sort=date_start-DESC&do=modules&action=config&mod=events"><img src="images/up.png"/><?php echo PLG_EM_DateSTART;?></a></th>
         
         <? } ?>


          <?php if(isset($_GET['sort']) && $_GET['sort']=='time_start-DESC')
      {?>
          <th class="left"><a href="index.php?sort=time_start-ASC&do=modules&action=config&mod=events"><img src="images/down.png"/><?php echo PLG_EM_TSTART;?></a></th>
          <?}else{ ?>
          <th class="left"><a href="index.php?sort=time_start-DESC&do=modules&action=config&mod=events"><img src="images/up.png"/><?php echo PLG_EM_TSTART;?></a></th>

          <? } ?>

<!--          <th class="left">--><?php //echo PLG_EM_TSTART;?><!--</th>-->
<!--         <th class="left">--><?php //echo PLG_EM_TEND;?><!--</th>-->
<!--              --><?php //if(isset($_GET['sort']) && $_GET['sort']=='duration_insecond-DESC') {?>
<!---->
<!--        <th class="left"><a href="index.php?do=modules&action=config&mod=events&sort=duration_insecond-ASC">↓--><?php //echo PLG_Duration; ?><!--</a></th>-->
<!--        --><?// }else{ ?>
<!--          <th class="left"><a href="index.php?do=modules&action=config&mod=events&sort=duration_insecond-DESC">↑--><?php //echo PLG_Duration; ?><!--</a></th>-->
<!--        --><?// } ?>


          <th class="center">Status</th>
        <th><?php echo PLG_EM_EDIT;?></th>

          <th> <?php echo _DELETE;?></th>

      </tr>
    </thead>
    <tbody>
      <?php if($eventrow == 0):?>
      <tr>
        <td colspan="6"><div class="msgInfo"><?php echo PLG_EM_NOEVENT;?></div></td>
      </tr>
      <?php else:?>
        <?php $counter=1; ?>
      <?php foreach ($eventrow as $emrow):?>
            <?php $selectcalender='select * from event_types where id='.$emrow['type'];

            $resulcalender=mysql_query($selectcalender);
            $rowscalender=mysql_fetch_array($resulcalender);
            ?>
      <tr>
        <td><?php echo $counter;?></td>
       <td><?php echo $emrow['title'.$core->dblang];?></td>
          <td><?php echo $rowscalender['event_name'] !='All'?$rowscalender['event_name']:"Community(All)";?></td>
        <td><?php echo dodate($core->short_date, $emrow['date_start']);?></td>
        <td><?php echo $emrow['time_start'];?></td>


<!--          --><?php //$secondtodays="";
//                 $secondtodays=floor(seconds_to_days($emrow['duration_insecond']));  ?>
          <?php

//             $seconds_to_hours="";
//             $seconds_to_hours=floor(seconds_to_hours($emrow['duration_insecond']));
//                 if($seconds_to_hours>24)
//                 {
//                   $seconds_to_hours=floor(seconds_to_hours($emrow['duration_insecond']))-(24*$secondtodays);
//                 }
//                 else
//                 {
//                     $seconds_to_hours=floor(seconds_to_hours($emrow['duration_insecond']));
//                 }
//
//          ?>
<!---->
         <?php
//          $second_to_minutes=$emrow['duration_insecond'];
//          $second_to_minutes=floor((seconds_to_minuties($second_to_minutes))%60);
//
//
//
//          ?>
<!---->
<!-- <td>--><?php //  echo $secondtodays." days,".$seconds_to_hours." hours,".$second_to_minutes." minuties";?><!--</td>-->

<!--          <td>--><?php //echo $rowscalender['event_name'] !='All'?$rowscalender['event_name']:"Community(All)";?><!--</td>-->


          <?php if($emrow['active']==1)
                    {
                        $eventstatus='<img src="images/active.png" alt="" class="tooltip" title="'._Event_A.'"/>';
                    }else
                    {
                        $eventstatus='<img src="images/inactive.png" alt="" class="tooltip" title="'._Event_I.'"/>';
                    } ?>
          <td align="center"> <?php echo $eventstatus; ?> </td>
        <td align="center"><a href="index.php?do=modules&amp;action=config&amp;mod=events&amp;mod_action=edit&amp;eventid=<?php echo $emrow['id'];?>">
            <img src="images/edit.png" class="tooltip"  alt="" title="<?php echo PLG_EM_EDIT.': '.$emrow['title'.$core->dblang];?>"/></a>
          </td><td align="center">
            <a href="javascript:void(0);" class="delete" rel="<?php echo $emrow['title'.$core->dblang];?>" id="item_<?php echo $emrow['id'];?>"><img src="images/delete.png" alt="" class="tooltip" title="<?php echo _DELETE.': '.$emrow['title'.$core->dblang];?>" /></a>
        </td>

      </tr>
          <?php $counter++; ?>
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
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '.PLG_EM_EVENT;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>


<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {

    $("#search-input").watermark("<?php echo UR_FIND_EventTitle;?>");
     $("#search-input").keyup(function () {
        var srch_string = $(this).val();
        var data_string = 'eventSearch=' + srch_string;
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
                    url: "modules/events/controller.php",
                    data: 'deleteEvent=' + id + '&eventtitle=' + title,
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
function handleTypeSelect(elm)
{
    if(elm.value == 'all')
        window.location = "<?php echo ADMINURL; ?>?do=modules&action=config&mod=events";
    window.location = "<?php echo ADMINURL; ?>?do=modules&action=config&mod=events&type_id=" + elm.value;
}

// ]]>
</script>
<?php break;?>


<?php endswitch;?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#phone-input").mask("999-999-9999");

        $('#date_start').dateplustimepicker({
        <?php echo $event_ev->getCalData();?>
        });

        $('#date_end').dateplustimepicker({
        <?php echo $event_ev->getCalData();?>
        });
        $('table.display th a').css('color','#444');


    });
</script>
