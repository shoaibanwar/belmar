<?php
  /**
   * Email Templates
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: templates.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php switch($core->action):


    //---------------------------------Edit--------------------------------------------------------------------//
case "edit": ?>
        <?php if(!$user->checkOperationPermission("email_templates")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif; ?>
<?php $row = $core->getRowById("email_templates", $content->id);?>
<h1><img src="images/mail-sml.png" alt="" /><?php echo _ET_TITLE1;?></h1>
<p class="info"><?php echo _ET_INFO1. _REQ1 . required(). _REQ2;?></p>
<h2><?php echo _ET_SUBTITLE1 . $row['name'.$core->dblang];?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo _ET_TTITLE;?> <?php echo ($row['fixed']==0)?required():'';?></td>
      <td>
          <?php if($row['fixed']==0): ?>
          <input name="name<?php echo $core->dblang;?>" type="text"  class="inputbox" value="<?php echo $row['name'.$core->dblang];?>" size="45" />
          <?php else: ?>
          <?php echo $row['name_en']; ?>
          <input type="hidden" name="fixed" value="true" />
          <?php endif; ?>
      </td>
    </tr>
    <!-- <tr>
      <td><?php echo _ET_SUBJECT;?>: <?php echo required();?></td>
      <td><input name="subject<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $row['subject'.$core->dblang];?>" size="45" /></td>
    </tr> -->
      <tr>
        <td><?php echo "Active";?>:</td>
        <td><span class="input-out">
          <label for="active-1"><?php echo _YES;?></label>
          <input name="active" type="radio" id="active-1" value="1" <?php getChecked($row['active'], 1); ?> />
          <label for="active-2"><?php echo _NO;?></label>
          <input name="active" type="radio" id="active-2" value="0" <?php getChecked($row['active'], 0); ?> />
          </span></td>
      </tr>
    <tr>
      <td colspan="2" class="editor">
      <textarea id="bodycontent" name="body<?php echo $core->dblang;?>" rows="4" cols="30"><?php echo $row['body'.$core->dblang];?></textarea>
      <?php loadEditor("bodycontent","100%",600); ?></td>
    </tr>
    <!--<tr>
      <td colspan="2">
          <p class="info">
              <?php if($row['fixed']==0): ?>
              <textarea readonly name="help<?php echo $core->dblang;?>" cols="80" rows="1"><?php echo $row['help'.$core->dblang];?></textarea>
              <?php else: ?>
              <?php echo $row['help_en']; ?>
              <?php endif; ?>
          </p>
      </td>
    </tr> -->
    <tr>
      <td colspan="2"><strong><?php echo _ET_VAR_T;?></strong></td>
    </tr>
    <tr>
      <td><input name="submit" type="submit" value="<?php echo _ET_UPDATE;?>"  class="button"/></td>
      <td><a href="index.php?do=templates" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
  <input name="id" type="hidden" value="<?php echo $content->id;?>" />
</form>
<?php echo $core->doForm("processTemplate","controller.php");?>
<?php break;?>
<?php

  //----------------------------------Add----------------------------------------------------------------------//

    case "add": ?>
    <?php if(!$user->checkOperationPermission("email_templates")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif; ?>
    <h1><img src="images/mail-sml.png" alt="" /><?php echo _ET_TITLE1;?></h1>
    <p class="info"><?php echo _ET_INFO1. _REQ1 . required(). _REQ2;?></p>
    <h2>Add Template</h2>
    <form action="" method="post" id="admin_form" name="admin_form">
        <table cellspacing="0" cellpadding="0" class="formtable">
            <tr>
                <td width="200"><?php echo _ET_TTITLE;?>: <?php echo required();?></td>
                <td><input name="name<?php echo $core->dblang;?>" type="text"  class="inputbox" size="45" /></td>
            </tr>
            <!--<tr>
                <td><?php echo _ET_SUBJECT;?>: <?php echo required();?></td>
                <td><input name="subject<?php echo $core->dblang;?>" type="text" class="inputbox"  size="45" /></td>
            </tr>-->
		      <tr>
		        <td><?php echo "Active";?>:</td>
		        <td><span class="input-out">
		          <label for="active-1"><?php echo _YES;?></label>
		          <input name="active" type="radio" id="active-1" value="1" checked />
		          <label for="active-2"><?php echo _NO;?></label>
		          <input name="active" type="radio" id="active-2" value="0" />
		          </span></td>
		      </tr>
            <tr>
                <td colspan="2" class="editor">
                    <textarea id="bodycontent" name="body<?php echo $core->dblang;?>" rows="4" cols="30"></textarea>
                    <?php loadEditor("bodycontent","100%",600); ?></td>
            </tr>
            <tr>
                <td colspan="2"><p class="info"><textarea name="help<?php echo $core->dblang;?>" cols="80" rows="1"></textarea></p></td>
            </tr>
            <tr>
                <td colspan="2"><strong><?php echo _ET_VAR_T;?></strong></td>
            </tr>
            <tr>
                <td><input name="submit" type="submit" value="Add Template"  class="button"/></td>
                <td><a href="index.php?do=templates" class="button-alt"><?php echo _CANCEL;?></a></td>
            </tr>
        </table>
    </form>
    <?php echo $core->doForm("processTemplate","controller.php");?>
    <?php break;?>
    <?php




 //-------------------------------------Manage Fixed templates----------------------------------------------------------------//
    case 'autoResponse': ?>
    <?php if(!$user->checkOperationPermission("auto_response")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif; ?>
<h1><img src="images/mail-sml.png" alt="" /><?php echo _ET_TITLE2;?></h1>
<p class="info"><?php echo _ET_INFO2;?></p>

<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
      <th width="20" class="left">#</th>
      <th class="left"><?php echo _ET_TTITLE;?></th>
      <th width="200"><?php echo _EDIT;?></th>
    </tr>
  </thead>
  <tbody>
    <?php if(!$member->getEmailTemplates(1)):?>
    <tr>
      <td colspan="3"><?php echo $core->msgError(_ET_NOTEMPLATE,false);?></td>
    </tr>
    <?php else:?>
    <?php foreach ($member->getEmailTemplates(1) as $row):?>
    <tr>
      <td><?php echo $row['id'];?>.</td>
      <td><?php echo $row['name'.$core->dblang];?></td>
      <td align="center">
          <a href="index.php?do=templates&amp;action=edit&amp;id=<?php echo $row['id'];?>"><img src="images/edit.png" alt="" class="tooltip" title="<?php echo _ET_EDIT.': '.$row['name'.$core->dblang];?>"/></a>

      </td>
    </tr>
    <?php endforeach;?>
    <?php unset($row);?>
    <?php endif;?>
  </tbody>
</table>
    <div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '._PAGE;?>">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
    </div>
    <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function () {

            $('a.delete').live('click', function () {
                var id = $(this).attr('id').replace('item_', '')
                var parent = $(this).parent().parent();
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
                            data: 'deleteTemplate=' + id + '&TempName=' + title,
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
<?php break;?>


<?php
 //-------------------------------------Manage Changeable templates----------------------------------------------------------------//
    default: ?>
    <?php if(!$user->checkOperationPermission("email_templates")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif; ?>
<h1><img src="images/mail-sml.png" alt="" /><?php echo _ET_TITLE2;?></h1>
<p class="info"><?php echo _ET_INFO2;?></p>
<h2><span><a href="index.php?do=templates&amp;action=add" class="button-sml">Add New Template</a></span><?php echo _ET_SUBTITLE2;?></h2>


<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
      <th width="20" class="left">#</th>
      <th class="left"><?php echo _ET_TTITLE;?></th>
      <th class="left"><?php echo "Status";?></th>
      <th width="200"><?php echo _EDIT;?> / Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php if(!$member->getEmailTemplates()):?>
    <tr>
      <td colspan="3"><?php echo $core->msgError(_ET_NOTEMPLATE,false);?></td>
    </tr>
    <?php else:?>
    <?php foreach ($member->getEmailTemplates() as $row):?>
    <tr>
      <td><?php echo $row['id'];?>.</td>
      <td><?php echo $row['name'.$core->dblang];?></td>
      <td><?php echo isActive($row['active']);?></td>
      <td align="center">
          <a href="index.php?do=templates&amp;action=edit&amp;id=<?php echo $row['id'];?>"><img src="images/edit.png" alt="" class="tooltip" title="<?php echo _ET_EDIT.': '.$row['name'.$core->dblang];?>"/></a>
          / <a href="javascript:void(0);" class="delete" rel="<?php echo $row['name'.$core->dblang];?>" id="item_<?php echo $row['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo Delete.': '.$row['name'.$core->dblang];?>"/></a>
      </td>
    </tr>
    <?php endforeach;?>
    <?php unset($row);?>
    <?php endif;?>
  </tbody>
</table>
    <div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '._PAGE;?>">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
    </div>
    <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function () {

            $('a.delete').live('click', function () {
                var id = $(this).attr('id').replace('item_', '')
                var parent = $(this).parent().parent();
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
                            data: 'deleteTemplate=' + id + '&TempName=' + title,
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
<?php break;?>
<?php
endswitch;?>