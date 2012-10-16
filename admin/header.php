<?php
  /**
   * Header
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: header.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */

  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $core->company;?></title>
<script language="javascript" type="text/javascript">
var IMGURL = "<?php echo ADMINURL; ?>/images";
var ADMINURL = "<?php echo ADMINURL; ?>";
</script>
<link href="assets/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../assets/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../assets/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="../assets/tooltip.js"></script>
<script type="text/javascript" src="../assets/global.js"></script>


  <link href="assets/uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="assets/uploadify/jquery.uploadify-3.1.min.js"></script>

<link href="../assets/redmond/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="../assets/pirobox/css_pirobox/style_2/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../assets/pirobox/js/pirobox_extended_min.js"></script>
<script type="text/javascript" src="editor/scripts/innovaeditor.js"></script>
<link href="assets/jquery.jqplot.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="assets/tree.css" type="text/css" media="screen" />
<script type="text/javascript" src="assets/jquery.tree.js"></script>
<script type="text/javascript" src="../assets/jquery.editinplace.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
	  $().piroBox_ext({
	      piro_speed : 700,
		  bg_alpha : 0.5,
		  piro_scroll : true
	  });
      $('.pirobox_gall1').piroBox_ext({
	      piro_speed : 700,
		  bg_alpha : 0.5,
		  piro_scroll : true
	  });

	  $('input[type="checkbox"]').ezMark();
	  $('input[type="radio"]').ezMark();
	  $('select.custombox').customStyle();

	  $("#dialog").dialog({
		  bgiframe: true,
		  autoOpen: false,
		  width: "auto",
		  height: "auto",
		  zindex: 9998,
		  modal: false
	  });
	  $('a.langchange').click(function() {
		  var target = $(this).attr('href');
		  $('body').fadeOut(1000, function() {
			  window.location.href = target;
		  });
		  return false
	  });

	  $("a.langchange").click(function() {
		  $.cookie("LANG_CMSPRO", $(this).attr('rel'), {
			  expires: 120,
			  path: '/'
		  });
		  return false;
	  });
  });
  /* Main Menu */
  $(function(){
	  $("ul#nav li").hover(function(){
		  $(this).addClass("hover");
		  $('ul:first',this).css('visibility', 'visible');
	  }, function(){
		  $(this).removeClass("hover");
		  $('ul:first',this).css('visibility', 'hidden');
	  });
	  $("ul#nav li:has(ul)").find("a:first").append("&nbsp;...");
  });
  /* Lang Switcher */
  $.fn.langSwitcher = function() {
	  $(this).click(function() {
		  return false;
	  });
  }
  $('#lang-switcher').langSwitcher();
</script>
<?php
if(file_exists("plugins/".sanitize(get("plug"))."/style.css"))
echo "<link href=\"plugins/".sanitize(get("plug"))."/style.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
if(file_exists("plugins/".sanitize(get("plug"))."/script.js"))
echo "<script type=\"text/javascript\" src=\"plugins/".sanitize(get("plug"))."/script.js\"></script>\n";
if(file_exists("modules/".sanitize(get("mod"))."/style.css"))
echo "<link href=\"modules/".sanitize(get("mod"))."/style.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
if(file_exists("modules/".sanitize(get("mod"))."/script.js"))
echo "<script type=\"text/javascript\" src=\"modules/".sanitize(get("mod"))."/script.js\"></script>\n";
?>
</head>
<body>
<div id="header">
  <div class="top-menu">
    <div class="logo"><span  onclick ='location.href="index.php"' style='font-size: 47px;font-weight: bold;color: white;cursor:pointer'>
        <?php
       // echo ($core->logo) ? '<img src="'.SITEURL.'/uploads/'.$core->logo.'" alt="'.$core->company.'" />':
         echo   $core->company;?></span></div>
    <div class="usermenu">
      <ul>
        <li><strong><?php echo _WELCOME.' '.$user->username;?>:</strong></li>
        <li><a href="../index.php" target="_blank"><img src="images/view-site.png" alt="" class="icon" /><?php echo _N_VIEWS;?></a></li>
        <?php if($user->getAcl("Backup")):?><li><a href="index.php?do=backup"><img src="images/db-backup.png" alt="" class="icon" /><?php echo _N_BACK;?></a></li><?php endif;?>
        <?php if($user->getAcl("FM")):?><li><a href="index.php?do=filemanager"><img src="images/filemngr-sml.png" alt="" class="icon" /><?php echo _N_FM;?></a></li><?php endif;?>
        <li><a href="logout.php"><img src="images/log-out.png" alt="" class="icon" /><?php echo _N_LOGOUT;?></a></li>
      </ul>
    </div>
  </div>
  <div class="mainmenu">
    <ul id="nav">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="javascript:void(0);">Modules</a>
	          <ul>
	            <?php if($user->checkOperationPermission("menus")):?><li><a href="index.php?do=menus"><?php echo _N_MENUS;?></a></li><?php endif;?>
	            <?php if($user->checkOperationPermission("pages")):?><li><a href="index.php?do=pages"><?php echo _N_PAGES;?></a></li><?php endif;?>
                <?php if($user->checkOperationPermission("events")):?><li><a href="index.php?do=modules&amp;action=config&amp;mod=events">Events</a></li><?php endif;?>
                <?php if($user->checkOperationPermission("gallery")):?><li><a href="index.php?do=modules&amp;action=config&amp;mod=gallery">Photos</a></li><?php endif;?>
	            <li><a href="index.php?do=pressroom"><?php echo _pressroom;  ?></a></li>
	            <li><a href="index.php?do=alerts">Alerts</a></li>
	          </ul>
      </li>
        <?php if($user->checkOperationPermission("contact_form_own") ||
                 $user->checkOperationPermission("contact_form_all") ||
                 $user->checkOperationPermission("mailing_list") ||
                 $user->checkOperationPermission("get_alerts_list") ||
                 $user->checkOperationPermission("survey_list") ||
                 $user->checkOperationPermission("opt_out_list") ||
                 $user->checkOperationPermission("public_works_list")
          ):?>
  <li><a href="javascript:void(0);">Form Submissions & Lists</a>
	          <ul>
        <?php if($user->checkOperationPermission("contact_form_own") || $user->checkOperationPermission("contact_form_all")):?><li><a href="<?php echo ADMINURL; ?>/index.php?do=lists/contact">Contact Form List</a></li><?php endif; ?>
        <?php if($user->checkOperationPermission("mailing_list")):?><li><a href="<?php echo ADMINURL; ?>/index.php?do=lists/mailing_list">Home Page Mailing List</a></li><?php endif; ?>
        <?php if($user->checkOperationPermission("get_alerts_list")):?><li><a href="<?php echo ADMINURL; ?>/index.php?do=lists/get_alerts">Get Belmar Alerts List</a></li><?php endif; ?>
        <?php if($user->checkOperationPermission("survey_list")):?><li><a href="<?php echo ADMINURL; ?>/index.php?do=belmarsurvey">Belmar Survey List</a></li><?php endif; ?>
        <?php if($user->checkOperationPermission("opt_out_list")):?><li><a href="<?php echo ADMINURL; ?>/index.php?do=lists/opt_out">Opt-Out List</a></li><?php endif; ?>
        <?php if($user->checkOperationPermission("public_works_list")):?> <li><a href="<?php echo ADMINURL; ?>/index.php?do=publicworks">Public Works</a></li><?php endif; ?>
	          </ul>
      </li>   <?php endif; ?>
<?php if(  $user->checkOperationPermission("email_templates")
            || $user->checkOperationPermission("send_lists_emails")
            || $user->checkOperationPermission("auto_response")
        ):?>
       <li><a href="javascript:void(0);">Email/Newsletter System</a>
	  	          <ul>
          <?php if($user->checkOperationPermission("email_templates")):?> <li><a href="index.php?do=templates"><?php echo _N_EMAILS;?></a></li><?php endif;?>
          <?php if($user->checkOperationPermission("send_lists_emails")):?><li><a href="index.php?do=newsletter">Send Email/<?php echo _N_NEWSL;?></a></li><?php endif;?>
          <?php if($user->checkOperationPermission("auto_response")):?><li><a href="index.php?do=templates&action=autoResponse">Automatic Form Response(s)</a></li> <?php endif;?>
	  	          </ul>
      </li>
           <?php endif; ?>

      <?php if($user->checkOperationPermission("users")):?><li><a href="javascript:void(0);">CMS Accounts</a>

<ul>
	<?php if($user->checkOperationPermission("Users")):?><li><a href="index.php?do=groups">Groups/Departments</a></li><?php endif; ?>
	            <li><a href="index.php?do=users">User Accounts</a></li>

	          </ul>
      </li>

</li><?php endif;?>


      <?php if($user->userlevel ==9):?>
      <li><a href="javascript:void(0);"><?php echo _N_CONF;?></a>
        <ul>
          <li><a href="index.php?do=config"><?php echo _CG_TITLE1;?></a></li>

          <li><a href="index.php?do=logs"><?php echo _N_LOGS;?></a></li>
        </ul>
      </li>
      <?php endif;?>
    </ul>
    <div class="clear"></div>
  </div>
</div>
<div id="content">