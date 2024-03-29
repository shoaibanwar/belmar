<?php
  /**
   * Filemanager
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: filemanager.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  
  require_once("../init.php");
  if (!$user->is_Admin())
    redirect_to("../login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo _FM_TITLE;?></title>
<link href="filemanager/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../assets/jquery.js"></script>
<script type="text/javascript" src="../../assets/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="../../assets/tooltip.js"></script>
<script type="text/javascript" src="../../assets/global.js"></script>
<link href="../../assets/redmond/jquery-ui.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="msgholder"></div>
<span id="loader"></span>
<div id="maindata"></div>
<div id="dialog-confirm-single-delete" style="display:none;" title="<?php echo _FM_DELFILE_D;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>
<div id="dialog-confirm-create-dir" style="display:none;" title="<?php echo _FM_NEWDIR;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _FM_DIR_NAME_T;?> <span style="display:block; margin-top:5px; text-align:center">
    <input name="dirname" type="text" class="inputbox" id="dirname" size="20" />
    </span></p>
</div>
<script type="text/javascript">
// <![CDATA[
  $('a.getfile').live('click', function () {
	  (opener?opener:openerWin).setAssetValue('<?php echo SITEURL ?>'+'/uploads/' + $(this).attr('rel'));
	  self.closeWin();
  });
	
$(document).ready(function () {
  $(".thumbview").live({
	mouseenter: function() { 
	  $(this).find("p.control").fadeIn(200);
	},
	mouseleave: function () {
	  $(this).find("p.control").fadeOut(400);
	}
  });

    function showLoader() {
        $('#loader').fadeIn(200);
    }

    function hideLoader() {
        $('#loader').fadeOut(200);
    };

    function loadList(dirdata) {
        showLoader();
        $.ajax({
            type: 'post',
            url: "filemanager/controller.php",
            data: 'rel_dir=' + dirdata,
            cache: false,
            success: function (html) {
                $("#maindata").html(html);
            }
        });
        hideLoader();
    }

    loadList('');
	
    $('a.dirchange').live('click', function (e) {
        e.preventDefault();
        var dirdata = escape($(this).attr('id'))
        showLoader();
        $.ajax({
            type: 'post',
            url: "filemanager/controller.php",
            data: 'rel_dir=' + dirdata,
            cache: false,
            success: function (html) {
                $("#maindata").html(html);
            }
			
        });
        hideLoader();
    });

    // Delete single file/folder
    $('a.del-single').live('click', function () {
        var id = $(this).attr('id')
        var parent = $(this).parent().parent();
        var title = $(this).attr('rel');
        $("#dialog-confirm-single-delete").data({
            'delid': id,
            'parent': parent,
            'title': title
        }).dialog('open');
        return false;
    });

    $("#dialog-confirm-single-delete").dialog({
        resizable: false,
        bgiframe: true,
        autoOpen: false,
        width: 400,
        height: "auto",
        zindex: 9998,
        modal: false,
        buttons: {
            '<?php echo _DELETE;?>': function () {
                var parent = $(this).data('parent');
                var id = $(this).data('delid');
                var title = $(this).data('title');
				var path = id + title;

                $.ajax({
                    type: 'post',
                    url: "filemanager/controller.php",
                    data: 'fmaction=deleteSingle&path=' + path + '&name=' + title,
                    beforeSend: function () {
                        parent.animate({
                            'backgroundColor': '#FFBFBF'
                        }, 400);
                    },
                    success: function (res) {
                        parent.fadeOut(400, function () {
                            parent.remove();
                        });
                        $("#msgholder").html(res);
                    }
                });

                $(this).dialog('close');
            },
            '<?php echo _CANCEL;?>': function () {
                $(this).dialog('close');
            }
        }
    });
	
	
    // Create Directory
    $('a#create-dir').live('click', function () {
        var id = $(this).attr('rel');
        $("#dialog-confirm-create-dir").data({
            'id': id
        }).dialog('open');
        return false;
    });

    $("#dialog-confirm-create-dir").dialog({
        resizable: false,
        bgiframe: true,
        autoOpen: false,
        width: 400,
        height: "auto",
        zindex: 9998,
        modal: false,
        buttons: {
            '<?php echo _FM_CREATE;?>': function () {
                var id = $(this).data('id');
				var title = $("#dirname").val();
				var path = id;

				var str = 'fmaction=createDir';
					str +=  '&path=' + path;
					str +=  '&name=' + title;
					
                $.ajax({
                    type: 'post',
                    url: "filemanager/controller.php",
                    data: str,
					success: function (res) {
						$("#msgholder").html(res);
						setTimeout(function () {
							$(loadList(id)).fadeIn("slow");
						}, 2000);
					}
                });

                $(this).dialog('close');
            },
            '<?php echo _CANCEL;?>': function () {
                $(this).dialog('close');
            }
        }
    });
	
	// File Upload
	$('#fileupload').live('click', function () {
		var id = $(this).attr('rel');
		$('#admin_form').ajaxSubmit({
			target: "#msgholder",
			url: "filemanager/controller.php",
			clearForm: 1,
			data: {
				fmaction: "uploadFile"
			},
			success: function (res) {
			  setTimeout(function () {
				  $(loadList(id)).fadeIn("slow");
			  }, 2000);
			}
		});
		return false;
	});
});
// ]]>
</script>
</body>
</html>