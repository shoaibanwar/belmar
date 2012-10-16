<?php
  /**
   * Event Manager
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: main.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  require_once(HCODE . "admin/modules/events/lang/" . $core->language . ".lang.php");
  require_once(HCODE . "admin/modules/events/admin_class.php");
  
  $calendar = new eventManager();  
?>
<!-- Start Event Manager -->

<div id="cal-wrap"><?php $calendar->renderCalendar();?></div>
<script type="text/javascript">
// <![CDATA[
  function loadList() {
	  $.ajax({
		  url: SITEURL + "/modules/events/calendar.php",
		  cache: false,
		  success: function (html) {
			  $("#cal-wrap").html(html);
		  }
	  });
  }

  $(function () {
	  $(".loadevent").live("click", function (event) {
		  var id = $(this).attr('id').replace('eventid_', '');
		  var mytext = $("#eid_" + id).html();
		  var title = $("#eid_" + id).attr('title');

		  $('<div id="event-dialog" title="' + title + '">' + mytext + '</div>').appendTo('body');
		  event.preventDefault();

		  $("#event-dialog").dialog({
			  width: 450,
			  height: "auto",
			  modal: true,
			  close: function (event, ui) {
				  $("#event-dialog").remove();
			  }
		  });
	  });
  });

  $(document).ready(function () {
	  $("a.changedate").live("click", function () {
		  var parent = $(this);
		  var caldata = $(this).attr('id').replace('item_', '');
		  var month = caldata.split(":")[0];
		  var year = caldata.split(":")[1];
		  $.ajax({
			  type: "POST",
			  url: SITEURL + "/modules/events/calendar.php",
			  data: {
				  'year': year,
				  'month': month
			  },
			  success: function (data, status) {
				  $("#cal-wrap").fadeIn("fast", function () {
					  $(this).html(data);
				  });
			  }
		  });
		  return false;
	  });
  });
// ]]>
</script>
<!-- End Event Manager /-->