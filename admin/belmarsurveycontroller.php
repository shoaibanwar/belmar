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
  
  require_once("init.php");
  if (!$user->is_Admin())
    redirect_to("login.php");

?>

<?php
  /* Delete public works*/
  if (isset($_POST['deletebelmarsurvey'])):
  $id = sanitize($_POST['deletebelmarsurvey']);
  $db->delete("belmarsurvey", "id='" . (int)$id . "'");
  
  $title = sanitize($_POST['belmarsurveyfname']);
  print ($db->affected()) ? $hollysec->writeLog(PLG_EM_belmarsurvey .' <strong>'.$title.'</strong> '._DELETED, "", "no", "module") . $core->msgOk(PLG_EM_belmarsurvey .' <strong>'.$title.'</strong> '._DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
  endif;
?>


