<?php
  /**
   * File Manager
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: filemanager.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  if(!$user->getAcl("FM")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<h1><img src="images/filemngr-lrg.png" alt="" /><?php echo _FM_TITLE;?></h1>
<div id="maindata"></div>
<div id="dialog-confirm-single-delete" style="display:none;" title="<?php echo _FM_DELFILE_D;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>
<div id="dialog-confirm-single-chmod" style="display:none;" title="<?php echo _FM_CHMOD_D;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _FM_CHMOD_DM;?> <span style="display:block; margin-top:5px; text-align:center">
    <input name="oct" type="text" class="inputbox" id="octval" size="10" />
    </span></p>
</div>
<div id="dialog-view-item" style="display:none;" title="<?php echo _FM_VIEWING.' '._FM_FILE;?>"> </div>
<div id="dialog-edit-item" style="display:none;" title="<?php echo _FM_EDITING.' '._FM_FILE;?>"> </div>
<div id="dialog-confirm-create-dir" style="display:none;" title="<?php echo _FM_NEWDIR;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _FM_DIR_NAME_T;?> <span style="display:block; margin-top:5px; text-align:center">
    <input name="dirname" type="text" class="inputbox" id="dirname" size="20" />
    </span></p>
</div>
<div id="dialog-confirm-create-file" style="display:none;" title="<?php echo _FM_NEWFILE;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _FM_FILENAME_T;?> <span style="display:block; margin-top:5px; text-align:center">
    <input name="filename" type="text" class="inputbox" id="filename" size="30" />
    </span></p>
</div>
<script type="text/javascript">
// <![CDATA[
function requestDefault() {
    $('#dataholder tbody tr').each(function () {
        if ($(this).find('input:checked').length) {
            $(this).animate({
                'backgroundColor': '#FFBFBF'
            }, 400);
        }
    });
}

function responseDelete(msg) {
    $('#dataholder tbody tr').each(function () {
        if ($(this).find('input:checked').length) {
            $(this).fadeOut(400, function () {
                $(this).remove();
            });
        }
    });
    $("#msgholder").html(msg);
}

function responseDefault(msg) {
    $('#dataholder tbody tr').each(function () {
        if ($(this).find('input:checked').length) {
            $(this).animate({
                'backgroundColor': '#fff'
            }, 400);
        }
    });
    $(this).html(msg);
}

$(document).ready(function () {
    $(function () {
        $('#masterCheckbox').live('click', function () {
            $(this).parents('#admin_form:eq(0)').find(':checkbox').attr('checked', this.checked);
        });
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
            url: "manager/controller.php",
            data: 'rel_dir=' + dirdata,
            cache: false,
            success: function (html) {
                $("#maindata").html(html);
            }
        });
        hideLoader();
    }

    loadList('');
	
    /** Multiple Delete Start **/
    $('#delete-multi').live('click', function () {
		var str = $("#admin_form").serialize();
		    str += '&fmaction=deleteMulti';
		  $.ajax({
			  type: "post",
			  url: "manager/controller.php",
			  data: str,
			  beforeSend: requestDefault,
			  success: responseDelete
		  });
		  return false;
    }); 
	/** Multiple Delete End **/
	
    $('a.dirchange').live('click', function (e) {
        e.preventDefault();
        var dirdata = escape($(this).attr('id'))
        showLoader();
        $.ajax({
            type: 'post',
            url: "manager/controller.php",
            data: 'rel_dir=' + dirdata,
            cache: false,
            beforeSend: function () {
                $("#maindata").slideUp('slow');
            },

            success: function (html) {
                $("#maindata").html(html).slideDown('slow');
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
                    url: "manager/controller.php",
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
	
    // Chmod single file/folder
    $('a.chmod-single').live('click', function () {
        var id = $(this).attr('id')
        var parent = $(this).parent().parent();
        var title = $(this).attr('rel');
        $("#dialog-confirm-single-chmod").data({
            'id': id,
            'parent': parent,
            'title': title
        }).dialog('open');
        return false;
    });

    $("#dialog-confirm-single-chmod").dialog({
        resizable: false,
        bgiframe: true,
        autoOpen: false,
        width: 400,
        height: "auto",
        zindex: 9998,
        modal: false,
        buttons: {
            '<?php echo _CHMOD_I;?>': function () {
                var parent = $(this).data('parent');
                var id = $(this).data('id');
                var title = $(this).data('title');
				var octal = $("#octval").val();
				var path = id + title;

				var str = 'fmaction=chmodSingle';
					str +=  '&path=' + path;
					str +=  '&name=' + title;
					str +=  '&octal=' + octal;
					
                $.ajax({
                    type: 'post',
                    url: "manager/controller.php",
                    data: str,
                    beforeSend: function () {
                        parent.animate({
                            'backgroundColor': '#ffc'
                        }, 400);
                    },
					success: function (res) {
						parent.animate({
							'backgroundColor': '#fff'
						}, 400);
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
	
	// View single file
    $('a.view-single').live('click', function () {
        var id = $(this).attr('id')
        var parent = $(this).parent().parent();
        var title = $(this).attr('rel');
		  $.ajax({
			  type: 'post',
			  url: "manager/controller.php",
			  data: 'fmaction=viewItem&path=' + id + '&name=' + title,
			  success: function (res) {
				  $("#dialog-view-item").html(res).fadeIn("slow");
			  }
		  });	
        $("#dialog-view-item").dialog('open');
        return false;
    });
	
    $("#dialog-view-item").dialog({
        resizable: false,
        bgiframe: true,
        autoOpen: false,
        width: "auto",
        height: "auto",
        zindex: 9998,
        modal: false

    });
	
	// Edit single file
    $('a.edit-single').live('click', function () {
        var id = $(this).attr('id')
        var parent = $(this).parent().parent();
        var title = $(this).attr('rel');
		  $.ajax({
			  type: 'post',
			  url: "manager/controller.php",
			  data: 'fmaction=editItem&path=' + id + '&name=' + title,
			  success: function (res) {
				  $("#dialog-edit-item").html(res).fadeIn("slow");
			  }
		  });	
        $("#dialog-edit-item").data({
            'fileid': id,
            'parent': parent,
            'title': title
        }).dialog('open');
        return false;
    });
	
    $("#dialog-edit-item").dialog({
        resizable: false,
        bgiframe: true,
        autoOpen: false,
        width: "auto",
        height: "auto",
        zindex: 9998,
        modal: false,
        buttons: {
            '<?php echo _SAVE;?>': function () {
                var parent = $(this).data('parent');
                var id = $(this).data('fileid');
                var title = $(this).data('title');
				var str = $("#itemsave").serialize(); 
				    str +=  '&fmaction=saveItem';
					str +=  '&path=' + id;
					str +=  '&name=' + title;
					str +=  '&save=save';
				
                $.ajax({
                    type: 'post',
                    url: "manager/controller.php",
					data: str,
					success: function (res) {
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
                    url: "manager/controller.php",
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
	
    // Create File
    $('a#create-file').live('click', function () {
        var id = $(this).attr('rel');
        $("#dialog-confirm-create-file").data({
            'id': id
        }).dialog('open');
        return false;
    });

    $("#dialog-confirm-create-file").dialog({
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
				var title = $("#filename").val();
				var path = id;

				var str = 'fmaction=createFile';
					str +=  '&path=' + path;
					str +=  '&name=' + title;
					
                $.ajax({
                    type: 'post',
                    url: "manager/controller.php",
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
			url: "manager/controller.php",
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
    <?php if(isset($_GET['mode'])):if($_GET['mode']=='selection'): ?>
    $("#langswitch").hide();
    $("#header").hide();
    $("#footer").hide();
    $(".pirobox").live('click',function(e){
        e.preventDefault();
        var title = $(this).attr('title');
        $('#uploadinput', window.parent.document).val(
            function(index , value){
                return 'uploads/' + $('.currDir').text() + title});
        $('.piro_close', window.parent.document).click();
    });
    <?php endif;endif; ?>
});
// ]]>
</script>