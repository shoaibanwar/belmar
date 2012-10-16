<?php
  /**
   * jQuery Poll
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: get_poll.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("../../init.php");
  
  require_once(HCODE . "admin/plugins/poll/lang/" . $core->language . ".lang.php");
  require_once(HCODE . "admin/plugins/poll/admin_class.php");
  $poll = new poll();
?>
<?php
  if (!isset($_POST['poll']) || !isset($_POST['pollid'])) {
      print $poll->showPollQuestion();
  } else {
      if (isset($_COOKIE["voted" . $_POST['pollid']]) != 'yes')
          $poll->updatePollResult();
      
      print $poll->getPollResults(intval($_POST['pollid']));
  }
?>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
    $('input[type="radio"]').ezMark();
});
// ]]>
</script>