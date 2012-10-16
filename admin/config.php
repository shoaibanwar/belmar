<?php
  /**
   * Configuration
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: config.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
//  if(!$user->getAcl("Configuration")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;

  if($user->userlevel !=9): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;

  //for twitter
//  include_once HCODE.'/admin/plugins/twitts/admin_class.php';
//  $twitt = new latestTwitts();
?>
<h1><img src="images/settings-sml.png" alt="" /><?php echo _CG_TITLE1;?></h1>
<p class="info"><?php echo _CG_INFO1 . _REQ1 . required() . _REQ2;?></p>
<h2><?php echo _CG_SUBTITLE1;?></h2>
<form action="" method="post" id="admin_form" name="admin_form" enctype="multipart/form-data">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo _CG_SITENAME;?>: <?php echo required();?></td>
      <td><input name="site_name" type="text" class="inputbox" value="<?php echo $core->site_name;?>" size="55" />
      <?php echo tooltip(_CG_SITENAME_T);?></td>
    </tr>
    <tr>
      <td><?php echo _CG_COMPANY;?>:</td>
      <td><input name="company" type="text" class="inputbox" value="<?php echo $core->company;?>" size="55"/>
      <?php echo tooltip(_CG_COMPANY_T);?></td>
    </tr>
    <tr>
      <td><?php echo _CG_WEBURL;?>: <?php echo required();?></td>
      <td><input name="site_url" type="text" class="inputbox" value="<?php echo $core->site_url;?>" size="55" />
      <?php echo tooltip(_CG_WEBURL_T);?></td>
    </tr>
    <tr>
      <td><?php echo _CG_WEBEMAIL;?>: <?php echo required();?></td>
      <td><input name="site_email" type="text" class="inputbox" value="<?php echo $core->site_email;?>" size="55" />
      <?php echo tooltip(_CG_WEBEMAIL_T);?></td>
    </tr>

    <tr>
      <td><?php echo _CG_DEFAULT_TAB;?>:</td>
      <td><select name="default_tab" class="custombox" style="width:200px">
          <?php
          $defaultTab = $db->first('select default_tab from settings');
          $defaultTab = $defaultTab['default_tab'];
          $tabs = $db->fetch_all('select * from event_types');
          foreach($tabs as $tab) {
              $selected = '';
              if($defaultTab == $tab['id'] ) $selected=" selected='selected'";
              echo "<option value='{$tab['id']}' $selected>{$tab['event_name']}</option>";
          }
          ?>



        </select></td>
    </tr>


      <tr>
          <td><?php echo PLG_TW_COUNT;?>:<?php echo required();?></td>
          <td><input name="tweet_count" type="text" value="<?php echo $core->tweet_count; ?>" class="inputbox"  size="5" />
              <?php echo tooltip(PLG_TW_COUNT_T);?></td>
      </tr>
    <tr>
          <td><?php echo _LIMIT_TABS;?>:</td>
          <td><input name="limit_tabs" type="text" value="<?php echo $core->limit_tabs; ?>" class="inputbox"  size="5" />
              <?php echo tooltip(_LIMIT_TABS_INFO);?></td>
      </tr>
    <tr>
          <td><?php echo _PUBLISH_TIME;?>:</td>
          <td><input value="<?php echo $core->publish_duration/3600; ?>" type="text" name="publish_duration" class="inputbox" size="2"/>
                <?php echo _HOUR_S; ?>
              <?php echo tooltip(_PUBLISH_TIME_INFO);?></td>
      </tr>
    <tr>
      <td><?php echo _CG_PERPAGE;?>:</td>
      <td><input name="perpage" type="text" class="inputbox" value="<?php echo $core->perpage;?>" size="5" />
      <?php echo tooltip(_CG_PERPAGE_T);?></td>
    </tr>
    <tr>
      <td><?php echo _CG_SHORTDATE;?>:</td>
      <td><select class="custombox" name="short_date" style="width:200px">
          <?php echo $core->getShortDate();?>
        </select></td>
    </tr>
    <tr>
      <td><?php echo _CG_LONGDATE;?>:</td>
      <td><select class="custombox" name="long_date" id="long_date" style="width:200px">
          <?php echo $core->getLongDate();?>
        </select></td>
    </tr>
    <tr>
      <td><?php echo _CG_DTZ;?>:</td>
      <td><?php echo $core->getTimezones();?></td>
    </tr>
    <tr>
      <td><?php echo _CG_WEEKSTART;?>:</td>
      <td><select class="custombox" name="weekstart" style="width:200px">
          <?php echo $core->weekList();?>
        </select></td>
    </tr>
    <tr>
      <td><?php echo _CG_THUMB_WH;?>: <?php echo required();?></td>
      <td><input name="thumb_w" type="text" class="inputbox" value="<?php echo $core->thumb_w;?>" size="5"/>
        /
        <input name="thumb_h" type="text" class="inputbox" value="<?php echo $core->thumb_h;?>" size="5"/>
        <?php echo tooltip(_CG_THUMB_WH_T);?></td>
    </tr>
    <tr>
      <td><?php echo _CG_IMG_WH;?>: <?php echo required();?></td>
      <td><input name="img_w" type="text" class="inputbox" value="<?php echo $core->img_w;?>" size="5"/>
        /
        <input name="img_h" type="text" class="inputbox" value="<?php echo $core->img_h;?>" size="5"/>
        <?php echo tooltip(_CG_IMG_WH_T);?></td>
    </tr>

    <tr>
        <td><?php echo _CG_facebook_h;?>: <?php echo required();?></td>
        <td><input name="facebook_h" type="text" class="inputbox" value="<?php echo $core->facebook_h;?>" size="5"/>

            <?php echo tooltip(_CG_facebook_h);?></td>
    </tr>

    <tr>
      <td><?php echo _CG_LOGIN_ATTEMPT;?>:</td>
      <td><input name="flood" type="text" class="inputbox" value="<?php echo $core->flood;?>" size="5"/>
      <input name="attempt" type="text" class="inputbox" value="<?php echo $core->attempt;?>" size="5"/>
      <?php echo tooltip(_CG_LOGIN_ATTEMPT_T);?></td>
    </tr>
    <tr>
      <td><?php echo _CG_LOG_ON;?>:</td>
      <td><span class="input-out">
        <label for="logging-1"><?php echo _YES;?></label>
        <input name="logging" type="radio" id="logging-1"  value="1" <?php getChecked($core->logging, 1); ?> />
        <label for="logging-2"><?php echo _NO;?></label>
        <input name="logging" type="radio" id="logging-2" value="0" <?php getChecked($core->logging, 0); ?> />
        <?php echo tooltip(_CG_LOG_ON_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo _CG_MAILER;?>:</td>
      <td><select class="custombox" name="mailer" id="mailerchange" style="width:200px">
          <option value="PHP"<?php if ($core->mailer == "PHP") echo "selected=\"selected\"";?>>PHP Mailer</option>
          <option value="SMTP"<?php if ($core->mailer == "SMTP") echo "selected=\"selected\"";?>>SMTP Mailer</option>
        </select>
        <?php echo tooltip(_CG_MAILER_T);?></td>
    </tr>
    <tr class="showsmtp">
      <td><?php echo _CG_SMTP_HOST;?>:</td>
      <td><input name="smtp_host" type="text" class="inputbox" value="<?php echo $core->smtp_host;?>" size="55" />
      <?php echo tooltip(_CG_SMTP_HOST_T);?></td>
    </tr>
    <tr class="showsmtp">
      <td><?php echo _CG_SMTP_USER;?>:</td>
      <td><input name="smtp_user" type="text" class="inputbox" value="<?php echo $core->smtp_user;?>" size="55" /></td>
    </tr>
    <tr class="showsmtp">
      <td><?php echo _CG_SMTP_PASS;?>:</td>
      <td><input name="smtp_pass" type="text" class="inputbox" value="<?php echo $core->smtp_pass;?>" size="55"/></td>
    </tr>
    <tr class="showsmtp">
      <td><?php echo _CG_SMTP_PORT;?>:</td>
      <td><input name="smtp_port" type="text" class="inputbox" value="<?php echo $core->smtp_port;?>" size="5" />
      <?php echo tooltip(_CG_SMTP_PORT_T);?></td>
    </tr>
    <tr>
      <td><?php echo _CG_GA;?>:</td>
      <td><textarea name="analytics" cols="50" rows="6"><?php echo $core->analytics;?></textarea>
      <?php echo tooltip(_CG_GA_T);?><br />
        <small><?php echo _CG_GA_I;?></small></td>
    </tr>
    <tr>
      <td><?php echo _CG_METAKEY;?>:</td>
      <td><input name="metakeys" type="text" class="inputbox" value="<?php echo $core->metakeys;?>" size="55" />
      <?php echo tooltip(_CG_METAKEY_T);?></td>
    </tr>
    <tr>
      <td><?php echo _CG_METADESC;?>:</td>
      <td><textarea name="metadesc" cols="50" rows="6"><?php echo $core->metadesc;?></textarea>
      <?php echo tooltip(_CG_METADESC_T);?></td>
    </tr>
    <tr>
        <td colspan="2"><b>Watermark</b></td>
    </tr>
    <tr>
        <td>Watermark image:</td>
        <td> <input id="wmUpload" name="file_upload" type="file" class="inputbox"  /></td>
    </tr>
    <tr>
        <td>Watermark position: </td>
        <td>
            <select class="custombox" name="watermark_position" style="width: 150px;">
                <option <?php echo $core->watermark_position=="TL"?"selected='selected'":""; ?> value="TL">Top Left</option>
                <option <?php echo $core->watermark_position=="TM"?"selected='selected'":""; ?> value="TM">Top Middle</option>
                <option <?php echo $core->watermark_position=="TR"?"selected='selected'":""; ?> value="TR">Top Right</option>
                <option <?php echo $core->watermark_position=="CL"?"selected='selected'":""; ?> value="CL">Center Left</option>
                <option <?php echo $core->watermark_position=="CM"?"selected='selected'":""; ?> value="CM">Center Middle</option>
                <option <?php echo $core->watermark_position=="CR"?"selected='selected'":""; ?> value="CR">Center Right</option>
                <option <?php echo $core->watermark_position=="BL"?"selected='selected'":""; ?> value="BL">Bottom Left</option>
                <option <?php echo $core->watermark_position=="BM"?"selected='selected'":""; ?> value="BM">Bottom Middle</option>
                <option <?php echo $core->watermark_position=="BR"?"selected='selected'":""; ?> value="BR">Bottom Right</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Watermark transparency:</td>
        <td> <input class="inputbox" name="watermark_transparency" type="text" size="3" value="<?php echo $core->watermark_transparency; ?>" /> %</td>
    </tr>
      <tr>
          <td colspan="2"><b>CONTACT FORM</b></td>
      </tr>
    <?php $contactSettings = $db->first("SELECT * FROM contact_form_settings"); ?>
      <tr>
          <td>Notification & Copy Email</td>
          <td><input value="<?php echo $contactSettings['notification_copy_email']; ?>" type="text" name="contact_not_copy_email" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td>From Email</td>
          <td><input value="<?php echo $contactSettings['from_email']; ?>" type="text" name="contact_from_email" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td>From Name</td>
          <td><input value="<?php echo $contactSettings['from_name']; ?>" type="text" name="contact_from_name" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td colspan="2"><b>HOMEPAGE MAILING LIST</b></td>
      </tr>
    <?php $mailingListSettings = $db->first("SELECT * FROM mailing_list_settings"); ?>
      <tr>
          <td>Notification & Copy Email</td>
          <td><input value="<?php echo $mailingListSettings['notification_copy_email']; ?>" type="text" name="mailing_list_not_copy_email" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td>From Email</td>
          <td><input value="<?php echo $mailingListSettings['from_email']; ?>" type="text" name="mailing_list_from_email" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td>From Name</td>
          <td><input value="<?php echo $mailingListSettings['from_name']; ?>" type="text" name="mailing_list_from_name" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td colspan="2"><b>BELMAR SURVEY</b></td>
      </tr>
    <?php $surveySettings = $db->first("SELECT * FROM survey_settings"); ?>
      <tr>
          <td>Notification & Copy Email</td>
          <td><input value="<?php echo $surveySettings['notification_copy_email']; ?>" type="text" name="survey_list_not_copy_email" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td>From Email</td>
          <td><input value="<?php echo $surveySettings['from_email']; ?>" type="text" name="survey_list_from_email" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td>From Name</td>
          <td><input value="<?php echo $surveySettings['from_name']; ?>" type="text" name="survey_list_from_name" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td colspan="2"><b>GET BELMAR ALERTS</b></td>
      </tr>
    <?php $alertsSettings = $db->first("SELECT * FROM get_alerts_settings"); ?>
      <tr>
          <td>Notification & Copy Email</td>
          <td><input value="<?php echo $alertsSettings['notification_copy_email']; ?>" type="text" name="get_alerts_not_copy_email" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td>From Email</td>
          <td><input value="<?php echo $alertsSettings['from_email']; ?>" type="text" name="get_alerts_from_email" class="inputbox" size="55" /></td>
      </tr>
      <tr>
          <td>From Name</td>
          <td><input value="<?php echo $alertsSettings['from_name']; ?>" type="text" name="get_alerts_from_name" class="inputbox" size="55" /></td>
      </tr>
    <tr>
      <td colspan="2"><input type="submit" name="update" class="button" value="<?php echo _CG_UPDATE;?>" /></td>
    </tr>
  </table>
  <input name="doconfig" type="hidden" value="1" />
</form>
<?php echo $core->doForm("processConfig");?>
<script type="text/javascript" src="modules/events/script.js"></script>
<script type="text/javascript">
// <![CDATA[
 $(".mask").filestyle({
     image: "images/file-button.png",
     imageheight : 29,
     imagewidth : 75,
     width : 230
 });
$(document).ready(function () {
  <?php echo $core->offline;?> == 1 ? $('.offline-data').fadeIn().show() : $('.offline-data').hide();
  $('#mdate').dateplustimepicker({
	  <?php
      	  $caldata = "dateFormat: 'yy:mm:dd',timeFormat: 'hh:mm:ss',";
		  $caldata .= "dayNames: ['"._MONDAY."', '"._TUESDAY."', '"._WEDNESDAY."', '"._THURSDAY."', '"._FRIDAY."', '"._SATURDAY."', '"._SUNDAY."'],";
		  $caldata .= "dayNamesMin: ['"._MO."', '"._TU."', '"._WE."', '"._TH."', '"._FR."', '"._SA."', '"._SU."'],";
		  $caldata .= "dayNamesShort: ['"._MON."', '"._TUE."', '"._WED."', '"._THU."', '"._FRI."', '"._SAT."', '"._SUN."'],";
		  $caldata .= "monthNames: ['"._JAN."', '"._FEB."', '"._MAR."', '"._APR."', '"._MAY."', '"._JUN."', '"._JUL."', '"._AUG."', '"._SEP."', '"._OCT."', '"._NOV."', '"._DEC."'],";
		  $caldata .= "monthNamesShort: ['"._JA_."', '"._FE_."', '"._MA_."', '"._AP_."', '"._MY_."', '"._JU_."', '"._JL_."', '"._AU_."', '"._SE_."', '"._OC_."', '"._NO_."', '"._DE_."'],";
		  $caldata .= "firstDay: 0,";
		  $caldata .= "hourGrid: 4,";
		  $caldata .= "minuteGrid: 10,";
		  $caldata .= "secondGrid: 60";
		  print $caldata;?>
  });
	var res2 = '<?php echo $core->mailer;?>';
		(res2 == "SMTP" ) ? $('.showsmtp').fadeIn().show() : $('.showsmtp').hide();
    $('#mailerchange').change(function () {
		var res = $("#mailerchange option:selected").val();
		(res == "SMTP" ) ? $('.showsmtp').fadeIn().show() : $('.showsmtp').hide();
    });
    $("#wmUpload").uploadify({
        height        : 30,
        swf           : '<?php echo ADMINURL; ?>/assets/uploadify/uploadify.swf',
        uploader      : '<?php echo ADMINURL; ?>/assets/uploadify/uploadify.php',
        width         : 120,
        'auto'     : true,
        'fileObjName' : 'image',
        'onSubmit ': function(){status.text('<?php echo _CG_LOGO_R;?>')},
        'onUploadSuccess' : function (file, response) {
            console.log(response);
            alert('file uploaded');
        }
    });

});
// ]]>
</script>