<?php
  /**
   * Menus
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: menus.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
//  if(!$user->getAcl("Menus")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<?php switch($core->action):
    case "edit": ?>
<?php $row = $core->getRowById("menus", $content->id);?>
<h1><img src="images/menus-sml.png" alt="" /><?php echo _MU_TITLE1;?></h1>
<p class="info"><?php echo _MU_INFO1 . _REQ1 . required() . _REQ2;?></p>
<h2><?php echo _MU_SUBTITLE1 . $row['name'.$core->dblang];?></h2>

<div style="margin-bottom: 25px;">
  <form action="" method="post" id="admin_form" name="admin_form">
    <table cellspacing="0" cellpadding="0" class="formtable">
      <tr>
        <td width="150"><?php echo _MU_NAME;?>: <?php echo required();?></td>
        <td><input name="name<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $row['name'.$core->dblang];?>" size="55"/>
          <?php echo tooltip(_MU_NAME_T);?></td>
      </tr>
      <tr>
        <td><?php echo _MU_PARENT;?>:</td>
        <td><select name="parent_id" class="custombox" style="width:200px">
            <option value="0"><?php echo _MU_TOP;?></option>
            <?php $content->getMenuDropList(0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;", $row['parent_id']);?>
          </select>
          &nbsp;<?php echo tooltip(_MU_TOP_T);?></td>
      </tr>
      <tr>
        <td><?php echo _MU_TYPE;?>: <?php echo required();?></td>
        <td><select name="content_type" class="custombox" style="width:200px" id="contenttype">
            <option value="NA" selected="selected"><?php echo _MU_TYPE_SEL;?></option>
            <?php echo $content->getContentType($row['content_type']);?>
          </select>
          &nbsp;<?php echo tooltip(_MU_TYPE_SEL_T);?></td>
      </tr>
      <tr id="fupload">
        <td  class='type_name'><!--<?php echo _MU_LINK;?>:--></td>
        <td><span id="contentId">
          <?php if($row['content_type'] == "web"):?>
          <input name="web" type="text" class="inputbox" size="45" value="<?php echo $row['link'];?>"/>
          &nbsp;<?php echo tooltip(_MU_LINK_T);?>
          <select name="target" style="width:120px" class="custombox" >
            <option value=""><?php echo _MU_TARGET;?></option>
            <option value="_blank"<?php if ($row['target'] == "_blank") echo ' selected="selected"';?>><?php echo _MU_TARGET_B;?></option>
            <option value="_self"<?php if ($row['target'] == "_self") echo ' selected="selected"';?>><?php echo _MU_TARGET_S;?></option>
          </select>
          <input name="page_id" type="hidden" value="0" />
          
          <?php elseif($row['content_type'] == "file_upload_name"):?>

                    <input type="text" id="uploadinput" name="uploadlink" size="45" class="inputbox required" >
                    <a href="<?php echo ADMINURL."/index.php?do=filemanager&mode=selection";  ?>" rel="iframe-full-full"
                       class="pirobox_gall1" title="Select Files">
                        <button class="button-sml" id="file_selector">Select  File</button>  </a>
                         <input name="page_id" type="hidden" value="0" />
          
          <?php else:?>
          <select name="page_id" class="custombox" style="width:200px">
              <?php
              $notPermitted = $user->get_not_permitted_pages();
              $notPermittedCSV = implode(',',$notPermitted);
              if(is_array($notPermitted) && count($notPermitted)==0) {
                  $notPermittedCSV = '-1';
              }

              $sql = "SELECT id, title{$core->dblang} FROM pages WHERE active = '1' AND id NOT IN ($notPermittedCSV) ORDER BY title{$core->dblang} ASC";
              ///echo $sql;die;
              $clist = $db->fetch_all($sql);
              ?>
            <?php foreach($clist as $crow):?>
            <?php $sel = ($crow['id'] == $row['page_id']) ? " selected=\"selected\"" : "" ?>
            <option value="<?php echo $crow['id'];?>"<?php echo $sel;?>><?php echo $crow['title'.$core->dblang];?></option>
            <?php endforeach;?>
            <?php unset($crow);?>
          </select>
          <?php endif;?>
          </span></td>
      </tr>
      <tr>
        <td><?php echo _MU_ICON;?>:</td>
        <td><div class="scrollbox"><div><input type="radio" name="icon" value=""  <?php if($row['icon'] =='') echo 'checked="checked"';?>/><?php echo _MU_NOICON;?></div>
		<?php print $content->getMenuIcons($row['icon']);?></div></td>
      </tr>
      <tr>
        <td><?php echo 'Icon Position';?>:</td>
        <td><span class="input-out">
          <label for="iconposition-1"><?php echo 'Right';?></label>
          <input name="iconposition" type="radio" id="iconposition-1" value="Right" <?php getChecked($row['iconposition'], 'Right'); ?> />
          
          <label for="iconposition-2"><?php echo 'Left';?></label>
          <input name="iconposition" type="radio" id="iconposition-2" value="Left" <?php getChecked($row['iconposition'], 'Left'); ?> />
          </span></td>
      </tr>
      <tr>
        <td><?php echo _MU_PUB;?>:</td>
        <td><span class="input-out">
          <label for="active-1"><?php echo _YES;?></label>
          <input name="active" type="radio" id="active-1" value="1" <?php getChecked($row['active'], 1); ?> />
          <label for="active-2"><?php echo _NO;?></label>
          <input name="active" type="radio" id="active-2" value="0" <?php getChecked($row['active'], 0); ?> />
          </span></td>
      </tr>
        <!-- <tr>
        <td><?php //echo _MU_HOME;?>:</td>
        <td><span class="input-out">
          <label for="home_page-1"><?php// echo _YES;?></label>
          <input name="home_page" type="radio" id="home_page-1" value="1" <?php// getChecked($row['home_page'], 1); ?> />
          <label for="home_page-2"><?php //echo _NO;?></label>
          <input name="home_page" type="radio" id="home_page-2" value="0" <?php //getChecked($row['home_page'], 0); ?> />
          <?php//echo tooltip(_MU_HOME_T);?></span></td>
      </tr>-->
      <tr>
        <td><input type="submit" name="submit" value="<?php echo _MU_UPDATE;?>" class="button"/></td>
        <td><a href="index.php?do=menus" class="button-alt"><?php echo _CANCEL;?></a></td>
      </tr>
    </table>
    <input name="id" type="hidden" value="<?php echo $content->id;?>" />
  </form>
</div>
    <div class="clear"></div>
    <div class="box"> <strong><?php echo _MU_MENUS;?></strong>
        <div class="sortable"></div>
        <img style="margin-right: 780px" src="images/save.png" alt="" id="serialize" title="<?php echo _MU_SAVE;?>" class="tooltip img-wrap" />
        <div class="clear"></div>
    </div>

<?php break;?>
<?php
    default:
        $add = true;
        ?>
<h1><img src="images/menus-sml.png" alt="" /><?php echo _MU_TITLE2;?></h1>
<p class="info"><?php echo _MU_INFO2;?></p>
<h2><?php echo _MU_SUBTITLE2;?></h2>

<div style="margin-bottom:25px">
  <form action="" method="post" id="admin_form" name="admin_form">
    <table cellspacing="0" cellpadding="0" class="formtable">
      <tr>
        <td width="150"><?php echo _MU_NAME;?>: <?php echo required();?></td>
        <td><input name="name<?php echo $core->dblang;?>" type="text" class="inputbox" size="45" />
          &nbsp;<?php echo tooltip(_MU_NAME_T);?></td>
      </tr>
      <tr>
        <td><?php echo _MU_PARENT;?>:</td>
        <td><select name="parent_id" class="custombox" style="width:200px">
            <option value="0"><?php echo _MU_TOP;?></option>
            <?php $content->getMenuDropList(0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;");?>
          </select>
          &nbsp;<?php echo tooltip(_MU_TOP_T);?></td>
      </tr>
      <tr>
        <td><?php echo _MU_TYPE;?>: <?php echo required();?></td>
        <td><select name="content_type" class="custombox" style="width:200px" id="contenttype">
            <option value="NA"  selected="selected"><?php echo _MU_TYPE_SEL;?></option>
            <?php echo $content->getContentType();?>
          </select>
          &nbsp;<?php echo tooltip(_MU_TYPE_SEL_T);?></td>
      </tr>
      <tr>
        <td class='type_name'><?php echo _MU_LINK;?>:</td>
        <td><span id="contentId">
          <select name="page_id" id="content_id" class="custombox" style="width:200px">
            <option value="0"><?php echo _MU_NONE;?></option>
          </select>
          </span></td>
      </tr>
      <tr>
        <td><?php echo _MU_ICON;?>:</td>
        <td><div class="scrollbox">
		<div><input name="icon" type="radio" value="" checked="checked"  /><?php echo _MU_NOICON;?></div>
		<?php print $content->getMenuIcons();?>
        </div></td>
      </tr>
      <tr>
        <td><?php echo 'Icon Position';?>:</td>
        <td><span class="input-out">
          <label for="iconposition-1"><?php echo 'Right';?></label>
          <input name="iconposition" type="radio" id="iconposition-1" value="Right" checked="checked" />
          
          <label for="iconposition-2"><?php echo 'Left';?></label>
          <input name="iconposition" type="radio" id="iconposition-2" value="Left" />
          </span></td>
      </tr>
      <tr>
        <td><?php echo _MU_PUB;?>:</td>
        <td><span class="input-out">
          <label for="active-1"><?php echo _YES;?></label>
          <input name="active" type="radio" id="active-1" value="1" checked="checked" />
          <label for="active-2"><?php echo _NO;?></label>
          <input name="active" type="radio" id="active-2" value="0" />
          </span></td>
      </tr>
     <!-- <tr>
        <td><?php //echo _MU_HOME;?>:</td>
        <td><span class="input-out">
          <label for="home_page-1"><?php //echo _YES;?></label>
          <input name="home_page" type="radio" id="home_page-1" value="1" />
          <label for="home_page-2"><?php //echo _NO;?></label>
          <input name="home_page" type="radio" id="home_page-2" value="0" checked="checked" />
          <?php //echo tooltip(_MU_HOME_T);?></span></td>
      </tr>-->
      <tr>
        <td><input type="submit" name="submit" value="<?php echo _MU_ADD;?>" class="button"/></td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
</div>
<div class="clear"></div>
        <div style="" class="box"> <strong><?php echo _MU_MENUS;?></strong>
            <div class="sortable"></div>
            <img style="margin-right: 780px" src="images/save.png" alt="" id="serialize" title="<?php echo _MU_SAVE;?>" class="tooltip img-wrap" /><div class="clear"></div></div>
<?php break;?>
<?php endswitch;?>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '._MENU;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {
     <?php if(isset($add)): ?>
    $('#contentId').parents('tr').hide();
    <?php endif; ?>
    function loadList() {
        $.ajax({
            type: 'post',
            url: "ajax.php",
            data: 'getmenus=1',
            cache: false,
            success: function (html) {
                $("div.sortable").html(html);
            }
        });
    }

    loadList();

    $("#admin_form").ajaxForm({
        target: "#msgholder",
        url: "controller.php",
        data: {
            processMenu: 1
        },
        success: showResponse
    });

    function showResponse(msg) {
        $(this).html(msg);
        setTimeout(function () {
            $(loadList()).fadeIn("slow");
        }, 2000);
        $("html, body").animate({
            scrollTop: 0
        }, 600);
    }

    $('div.sortable').nestedSortable({
        forcePlaceholderSize: true,
        handle: 'div',
        helper: 'clone',
        items: 'li',
        opacity: .6,
        placeholder: 'placeholder',
        tabSize: 25,
        tolerance: 'pointer',
        toleranceElement: '> div'
    });

    $('#serialize').live('click', function () {
        serialized = $('.sortable').nestedSortable('serialize');
        serialized += '&sortmenuitems=1';
        $.ajax({
            type: 'post',
            url: "ajax.php",
            data: serialized,
            success: function (msg) {
			$("#msgholder").html(msg);
			  setTimeout(function () {
				  $(loadList()).fadeIn("slow");
			  }, 2000);
            }

        });
    })

    $('#contenttype').change(function () {
        var option = $(this).val();
        if(option == 'NA')
            $('#contentId').parents('tr').hide();
        else
        $.get('ajax.php', {
            contenttype: option
        }, function (data) {
			$('.type_name').html('');
            //if(option =='page') $('.type_name').html('Select Page:')
            //else if(option =='web') $('.type_name').html('Enter URL:')
            //else if(option =='file_upload_name') $('.type_name').html('File Name:')
            $('#contentId').html(data).parents('tr').show().find('select.custombox').customStyle();
        });

    });

    $('a.delete').live('click', function () {
        var id = $(this).attr('id').replace('item_', '')
        var parent = $(this).parent();
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
                    data: 'deleteMenu=' + id + '&menutitle=' + title,
                    beforeSend: function () {
                        parent.animate({
                            'backgroundColor': '#FFBFBF'
                        }, 400);
                    },
                    success: function (msg) {
                        parent.fadeOut(400, function () {
                            parent.remove();
                        });
                        $("html, body").animate({
                            scrollTop: 0
                        }, 600);
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
   $('.pirobox_gall1').live('click',function(){
       $(document).find('.piro_prev').hide();
       $(document).find('.piro_prev_fake').hide();
       $(document).find('.piro_next').hide();
       $(document).find('.piro_next_fake').hide();
   });

});
// ]]>
</script>