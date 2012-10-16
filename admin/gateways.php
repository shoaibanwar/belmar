<?php
  /**
   * Gateways
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: gateways.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  if(!$user->getAcl("Gateways")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<?php switch($core->action): case "edit": ?>
<?php $row = $core->getRowById("gateways", $content->id);?>
<h1><img src="images/pay-sml.png" alt="" /><?php echo _GW_TITLE1;?></h1>
<p class="info"><?php echo _GW_INFO1. _REQ1 . required(). _REQ2;?></p>
<h2><span><a href="javascript:void(0);" onclick="$('#dialog').dialog('open'); return false"><img src="images/help.png" alt="" /></a></span><?php echo _GW_SUBTITLE1 . $row['displayname'];?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo _GW_NAME;?>: <?php echo required();?></td>
      <td><input name="displayname" type="text"  class="inputbox" value="<?php echo $row['displayname'];?>" size="45" /></td>
    </tr>
    <tr>
      <td><?php echo $row['extra_txt'];?>: </td>
      <td><input name="extra" type="text" class="inputbox" value="<?php echo $row['extra'];?>" size="45"/></td>
    </tr>
    <tr>
      <td><?php echo $row['extra_txt2'];?>:</td>
      <td><input name="extra2" type="text" class="inputbox" value="<?php echo $row['extra2'];?>" size="45"/></td>
    </tr>
    <tr>
      <td><?php echo $row['extra_txt3'];?>:</td>
      <td><input name="extra3" type="text" class="inputbox" value="<?php echo $row['extra3'];?>" size="45"/></td>
    </tr>
    <tr>
      <td><?php echo _GW_LIVE;?>:</td>
      <td><span class="input-out">
        <label for="demo-1"><?php echo _YES;?></label>
        <input name="demo" type="radio" id="demo-1"  value="1" <?php getChecked($row['demo'], 1); ?> />
        <label for="demo-2"><?php echo _NO;?></label>
        <input name="demo" type="radio" id="demo-2" value="0" <?php getChecked($row['demo'], 0); ?> />
        <?php echo tooltip(_GW_LIVE_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo _GW_ACTIVE;?>:</td>
      <td><span class="input-out">
        <label for="active-1"><?php echo _YES;?></label>
        <input name="active" type="radio" id="active-1"  value="1" <?php getChecked($row['active'], 1); ?> />
        <label for="active-2"><?php echo _NO;?></label>
        <input name="active" type="radio" id="active-2" value="0" <?php getChecked($row['active'], 0); ?> />
        <?php echo tooltip(_GW_ACTIVE_T);?></span></td>
    </tr>
    <tr>
      <td><?php echo _GW_IPNURL;?>:</td>
      <td><?php echo SITEURL.'/gateways/'.$row['dir'].'/ipn.php';?></td>
    </tr>
    <tr>
      <td><input name="submit" type="submit" value="<?php echo _GW_UPDATE;?>"  class="button"/></td>
      <td><a href="index.php?do=gateways" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
  <input name="id" type="hidden" value="<?php echo $content->id;?>" />
</form>
<div id="dialog" title="<?php echo $row['displayname'];?>"><?php echo ($row['name'] == "paypal") ? _GW_HELP_PP : _GW_HELP_MB ;?></div>
<?php echo $core->doForm("processGateway","controller.php");?>
<?php break;?>
<?php default: ?>
<h1><img src="images/pay-sml.png" alt="" /><?php echo _GW_TITLE2;?></h1>
<p class="info"><?php echo _GW_INFO2;?></p>
<h2><?php echo _GW_SUBTITLE2;?></h2>
<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
      <th width="20" class="left">#</th>
      <th class="left"><?php echo _GW_NAME;?></th>
      <th class="right"><?php echo _EDIT;?></th>
    </tr>
  </thead>
  <tbody>
    <?php if(!$member->getGateways()):?>
    <tr>
      <td colspan="3"><?php echo $core->msgError(_GW_NOGATEWAY,false);?></td>
    </tr>
    <?php else:?>
    <?php foreach ($member->getGateways() as $row):?>
    <tr>
      <td><?php echo $row['id'];?>.</td>
      <td><?php echo $row['displayname'];?></td>
      <td align="right"><a href="index.php?do=gateways&amp;action=edit&amp;id=<?php echo $row['id'];?>"><img src="images/edit.png" alt="" class="tooltip" title="<?php echo _GW_EDIT.': '.$row['displayname'];?>"/></a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($row);?>
    <?php endif;?>
  </tbody>
</table>
<?php break;?>
<?php endswitch;?>