<?php
  /**
   * Event Manager
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: main.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */

 define("_VALID_PHP", true);

 require_once("init.php");


 require_once(HCODE . "/admin/modules/events/lang/" . $core->language . ".lang.php");
  require_once(HCODE . "/admin/modules/events/admin_class.php");

  require_once(THEMEDIR . "/header.php");


  $calendar = new eventManager();  
?>
<!-- Start Event Manager -->


<div style="float:left;width:100%;padding:0px  10px">
    <div style="float:left;" class='left'></div>
    <div id="vmenunav">
        <div class="header"></div>
        <div class="cat_title">You are in:<br>
            <div class="cat">
                Calendar
            </div>
        </div>
        <?php $menus = $db->fetch_all("SELECT id,event_name FROM event_types"); ?>
        <ul>
            <li><a href="<?php echo SITEURL ;?>/calendar.php">All</a> </li>
            <?php foreach($menus as $menu): ?>
                <li><a href="<?php echo SITEURL ;?>/calendar.php?eType=<?php echo $menu['id']; ?>"><?php echo $menu['event_name'] ?></a></li>
            <?php endforeach; ?>
        </ul>

    </div>

    <div style="float:left;width: 78%;margin-top: 20px;" class="main">

        <h1 class="post-header">Calendar</h1>
        <div id="cal-wrap"><?php $calendar->renderCalendar();?></div>

    </div>

</div>
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
<?php require_once(THEMEDIR . "/footer.php");