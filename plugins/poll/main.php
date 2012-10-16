<?php
  /**
   * jQuery Poll
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: main.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

?>
<script type="text/javascript">
$(function () {
    var pollcontainer = $('#pollcontainer');
    $.get('<?php echo SITEURL;?>/plugins/poll/get_poll.php', '', function (data, status) {
        pollcontainer.html(data);
        animateResults(pollcontainer);
        pollcontainer.find('#viewresult').click(function () {
            $.get('<?php echo SITEURL;?>/plugins/poll/get_poll.php', 'result=1', function (data, status) {
                pollcontainer.fadeOut("fast", function () {
                    $(this).html(data);
                    animateResults(this);
                });
            });
            return false;
        }).end().find('#pollform').submit(function () {
            var selected_val = $(this).find('input[name=poll]:checked').val();
            if (selected_val != undefined) {
                $.post('<?php echo SITEURL;?>/plugins/poll/get_poll.php', $(this).serialize(), function (data, status) {
                    $('#formcontainer').fadeOut(100, function () {
                        $(this).html(data);
                        animateResults(this);
                    });
                });
            }
            return false;
        });
    });

    function animateResults(data) {
        $(data).find('.bar').hide().end().customFadeIn('fast', function () {
			$(".optionbar").each(function () {
				var percentage = $(this).css('width');
				$(this).css({
					width: "0%"
				}).animate({
					width: percentage
				}, 1500);
			});
        });
    }
});
</script>
<!-- Start jQuery Poll -->
<?php echo "<div id=\"pollcontainer\"></div>";?>
<!-- End jQuery Poll /-->