<?php
  /**
   * Backup
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: backup.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  if(!$user->getAcl("Backup")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<?php
  require_once(HCODE . "lib/class_dbtools.php");
  $tools = new dbTools();
  
  if (isset($_GET['backupok']) && $_GET['backupok'] == "1")
      $core->msgOk(_BK_BACKUP_OK,1,1);

  if (isset($_GET['restore']) && $_GET['restore'] == "1")
      $core->msgOk(_BK_RESTORE_OK,1,1);
	    
  if (isset($_GET['create']) && $_GET['create'] == "1")
      $tools->doBackup('',false);

  if (isset($_POST['backup_file']))
      $tools->doRestore($_POST['backup_file']);
?>

<h1><img src="images/backup-sml.png" alt="" /><?php echo _BK_TITLE1;?></h1>
<p class="info"><?php echo _BK_INFO1;?></p>
<h2><span>
  <button onclick="window.location='index.php?do=backup&amp;create=1';" type="button" class="button-alt-sml"><?php echo _BK_CREATE;?></button>
  </span><?php echo _BK_SUBTITLE1;?></h2>
<div id="backup">
  <?php
        $dir = HCODE . 'admin/backups/';
        if (is_dir($dir))
            : $getDir = dir($dir);
        while (false !== ($file = $getDir->read()))
            : if ($file != "." && $file != ".." && $file != "index.php")
            : if ($file == $core->backup)
            : echo '<div class="db-backup new">';
        echo '<span class="filename">';
        echo str_replace(".sql", "", $file) . '</span>';
        echo '<a href="' . ADMINURL . '/backups/' . $file . '" title="'._DOWNLOAD.': ' . $file . '" class="download">'._DOWNLOAD.'</a>';
        echo '</div>';
        else
            : echo '<div class="db-backup" id="item_' . $file . '">';
        echo '<span class="filename">' . str_replace(".sql", "", $file) . '</span>';
        echo ' <a href="' . ADMINURL . '/backups/' . $file . '" title="'._DELETE.': ' . $file . '" class="download">'._DOWNLOAD.'</a>';
        echo '<a href="javascript:void(0);" title="Delete: ' . $file . '" class="delete">'._DELETE.'</a>';
        echo '</div>';
        
        endif;
        endif;
        endwhile;
        $getDir->close();
        endif;
      ?>
  <br clear="left" />
</div>
<div class="box">
  <form action="" method="post" id="admin_form" name="admin_form">
    <strong><?php echo _BK_RESTORE_DB;?>:</strong>
    <?php
        if (is_dir($dir))
            : $getDir = dir($dir);
			echo '&nbsp;&nbsp;<select name="backup_file" class="custombox" style="width:250px">';
        while (false !== ($file = $getDir->read()))
            : if ($file != "." && $file != ".." && $file != "index.php"): 
        echo '<option value="' . $file . '">' . $file . '</option>';
        endif;
        endwhile;
		echo '</select>';
        $getDir->close();
        endif;
      ?>
    &nbsp;&nbsp;
    <button type="submit" class="button-sml"><?php echo _BK_RESTORE_BK;?></button>
  </form>
</div>
<div id="dialog-confirm" style="display:none;" title="<?php echo _BK_DELETE_BK;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {
    $('a.delete').live('click', function () {
        var parent = $(this).parent();
		var id = parent.attr('id').replace('item_', '')
		var title = $(this).attr('rel');
        $("#dialog-confirm").data({
            'delid': id,
            'parent': parent,
			'title': title
        }).dialog('open');
        return false;
    });

    $("#dialog-confirm").dialog({
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

                $.ajax({
                    type: 'post',
                    url: "ajax.php",
                    data: 'deleteBackup=' + id,
                    beforeSend: function () {
                        parent.animate({
                            'backgroundColor': '#FFBFBF'
                        }, 400);
                    },
                    success: function (msg) {
                        parent.fadeOut(400, function () {
                            parent.remove();
                        });
						$("html, body").animate({scrollTop:0}, 600);
						$("#msgholder").html(msg);
                    }
                });

                $(this).dialog('close');
            },
            '<?php echo _CANCEL;?>': function () {
                $(this).dialog('close');
            }
        }
    });
});
// ]]>
</script>