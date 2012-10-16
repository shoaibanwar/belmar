<?php
  /**
   * Calendar
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: calendar.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  
  require_once("../../init.php");

  require_once(HCODE . "admin/modules/events/lang/" . $core->language . ".lang.php");
  require_once(HCODE . "admin/modules/events/admin_class.php");
  
  $calendar = new eventManager(); 
  $calendar->weekDayNameLength = "short";
?>
<?php $calendar->renderCalendar('small');?>