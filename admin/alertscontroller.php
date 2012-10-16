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
  /* Proccess press room */
  if (isset($_POST['processBelmaralerts']))

      : if (intval($_POST['processBelmaralerts']) == 0 || empty($_POST['processBelmaralerts']))
      : redirect_to("index.php?do=alerts");

  endif;
  $content->belmaralertId = (isset($_POST['belmaralertId'])) ? $_POST['belmaralertId'] : 0;
  $content->processBelamralert();
  endif;
?>



<?php
  /* Delete pressroom*/
  if (isset($_POST['deleteBelamralert'])):
  $id = sanitize($_POST['deleteBelamralert']);
  $db->delete("belmaralerts", "id='" . (int)$id . "'");
  
  $title = sanitize($_POST['Belmaralertitle']);
  print ($db->affected()) ? $hollysec->writeLog(PLG_EM_BelmarAlert .' <strong>'.$title.'</strong> '._DELETED, "", "no", "module") . $core->msgOk(PLG_EM_BelmarAlert .' <strong>'.$title.'</strong> '._DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
  endif;
?>


