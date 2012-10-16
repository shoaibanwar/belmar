<?php
  /**
   * latestTwitts
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: admin.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  if(!$user->getAcl("twitts")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
    
  require_once("lang/" . $core->language . ".lang.php");
  require_once("admin_class.php");
  
  $twitt = new latestTwitts();
?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo PLG_TW_TITLE1;?></h1>
<p class="info"><?php echo PLG_TW_INFO1 . _REQ1. required() . _REQ2;?></p>
<h2><?php echo PLG_TW_SUBTITLE1;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo PLG_TW_USER;?>:<?php echo required();?></td>
      <td><input name="username" type="text" class="inputbox" value="<?php echo $twitt->username;?>" size="20" />
      <?php echo tooltip(PLG_TW_USER_T);?></td>
    </tr>
      <!-- twitter -->
    <tr>
      <td><?php echo PLG_TW_COUNT;?>:<?php echo required();?></td>
      <td><input name="counter" type="text" class="inputbox" value="<?php echo $twitt->counter;?>" size="5" />
        <?php echo tooltip(PLG_TW_COUNT_T);?></td>
    </tr>
    <tr>
      <td><?php echo PLG_TW_TRANS_S;?>: <?php echo required();?></td>
      <td><input name="speed" type="text" class="inputbox" value="<?php echo $twitt->speed;?>" size="5"/>
        <?php echo tooltip(PLG_TW_TRANS_S_T);?></td>
    </tr>
    <tr>
      <td><?php echo PLG_TW_SHOW_IMG;?>:</td>
      <td><span class="input-out">
        <label for="show_image-1"><?php echo _YES;?></label>
        <input name="show_image" type="radio" id="show_image-1"  value="1" <?php getChecked($twitt->show_image, 1); ?> />
        <label for="show_image-2"><?php echo _NO;?></label>
        <input name="show_image" type="radio" id="show_image-2" value="0" <?php getChecked($twitt->show_image, 0); ?> />
        <?php echo tooltip(PLG_TW_SHOW_IMG_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo PLG_TW_TRANS_T;?>: <?php echo required();?></td>
      <td><input name="timeout" type="text" class="inputbox" value="<?php echo $twitt->timeout;?>" size="5" />
        <?php echo tooltip(PLG_TW_TRANS_S_T);?></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo PLG_TW_UPDATE;?>" /></td>
      <td><a href="index.php?do=plugins" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
</form>
<?php echo $core->doForm("processConfig","plugins/twitts/controller.php");?>