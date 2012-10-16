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
  require("admin_class.php");
  
  $poll = new poll();
?>
<?php
  /* Add Poll*/
  if (isset($_POST['addPoll'])):
  $poll->addPoll();
  endif;
?>
<?php
  /* Update Poll*/
  if (isset($_POST['updatePoll'])):
  $poll->pollid = (isset($_POST['pollid'])) ? $_POST['pollid'] : 0; 
  $poll->updatePoll();
  endif;
?>
<?php
  /* Sort poll*/
  if (isset($_POST['sortpoll']) && $_POST['sortpoll'] == 1) :
      $sortid = $_POST['input'];
      for ($i = 0; $i < count($sortid); $i++) :
          $v = $sortid[$i];
          $data['position'] = $i + 1;
          
          $db->update("plug_poll_options", $data, "id='" . intval($v) . "'");
      endfor;
 endif;
?>
<?php
  /* Delete poll*/
  if (isset($_POST['deletePoll'])):
  
  $id = sanitize($_POST['deletePoll']);
  
  $action = $db->delete("plug_poll_questions", "id='" . (int)$id . "'");
  $db->delete("mod_poll_votes", "option_id IN(SELECT id FROM plug_poll_options WHERE question_id='" . (int)$id . "')");
  $db->delete("plug_poll_options", "question_id='" . (int)$id . "'");

  $title = sanitize($_POST['polltitle']);
  
  print ($action) ? $hollysec->writeLog(PLG_PL_POLL .' <strong>'.$title.'</strong> '._DELETED, "", "no", "module") . $core->msgOk(PLG_PL_POLL .' <strong>'.$title.'</strong> '._DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
  endif;
?>