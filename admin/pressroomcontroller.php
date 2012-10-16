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
<?php $content=new Content(); ?>

<?php 
  /* Proccess press room */
  if (isset($_POST['processPressRoom']))
      : if (intval($_POST['processPressRoom']) == 0 || empty($_POST['processPressRoom']))
      : redirect_to("index.php?do=pressroom");
  endif;
  $content->proomid = (isset($_POST['proomid'])) ? $_POST['proomid'] : 0;
  $content->processPressRoom();
  endif;
?>



<?php
  /* Delete pressroom*/
  if (isset($_POST['deleteProom'])):
  $id = sanitize($_POST['deleteProom']);
  $db->delete("pressroom", "id='" . (int)$id . "'");
  
  $title = sanitize($_POST['proomtitle']);
  print ($db->affected()) ? $hollysec->writeLog(PLG_EM_PRoom .' <strong>'.$title.'</strong> '._DELETED, "", "no", "module") . $core->msgOk(PLG_EM_PRoom .' <strong>'.$title.'</strong> '._DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
  endif;
?>


