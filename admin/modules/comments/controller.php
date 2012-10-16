<?php
  /**
   * Controller
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: controller.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  
  require_once("../../init.php");
  if (!$user->is_Admin())
      redirect_to("../../login.php");

  require_once("lang/" . $core->language . ".lang.php");
  require_once("admin_class.php");
  $com = new Comments();
?>
<?php
  /* Update Configuration*/
  if (isset($_POST['updateConfig'])):
  $com->updateConfig();
  endif;
?>
<?php
  /* Comments Actions*/
  if (isset($_POST['comproccess']) && intval($_POST['comproccess']) == 1) :
  $action = '';
  if (empty($_POST['comid']))
      : $core->msgAlert(MOD_CM_NA);
  endif;

  if (!empty($_POST['comid']))
      : foreach ($_POST['comid'] as $val)
      : $id = intval($val);
	  
  if (isset($_POST['action']) && $_POST['action'] == "disapprove")
      : $data['active'] = 0;
	  $action = MOD_CM_DISAPPROVED;
  elseif (isset($_POST['action']) && $_POST['action'] == "approve")
      : $data['active'] = 1;
	  $action = MOD_CM_APPROVED;
  endif;
  
  if (isset($_POST['action']) && $_POST['action'] == "delete")
      : $db->delete("mod_comments", "id='".$id."'");
	  $action = MOD_CM_DELETED;
  else
      : $db->update("mod_comments", $data, "id='".$id."'");
  endif;
  
  endforeach;
  
  ($db->affected()) ? $hollysec->writeLog($action, "", "no", "module") . $core->msgOk($action) : $core->msgAlert(_SYSTEM_PROCCESS);

  endif;

  endif;
?> 