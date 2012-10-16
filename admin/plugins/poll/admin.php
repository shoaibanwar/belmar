<?php
  /**
   * jQuery Poll
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: admin.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  if(!$user->getAcl("poll")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
  
  require_once("lang/" . $core->language . ".lang.php");
  require_once("admin_class.php");
  
  $poll = new poll();
  $pollrow = $poll->getPolls();
?>
<?php switch($core->paction): case "edit": ?>
<?php $row = $core->getRowById("plug_poll_questions", $poll->pollid);?>
<?php $pollopt = $poll->getPollOptions();?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo PLG_PL_TITLE1;?></h1>
<p class="info"><?php echo PLG_PL_INFO1 . _REQ1. required() . _REQ2;?></p>
<h2><?php echo PLG_PL_SUBTITLE1 . $row['question'.$core->dblang];?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo PLG_PL_QUESTION;?>: <?php echo required();?></td>
      <td><input name="question<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $row['question'.$core->dblang];?>" size="55" title="<?php echo PLG_PL_QUESTION_R;?>"/></td>
    </tr>
    <tr>
      <td><?php echo PLG_PL_OPTIONS;?>:</td>
      <td valign="top">
      <div id="sort-options">
	  <?php foreach ($pollopt as $k => $v): ?>
          <?php $k++;?>
          <div style="margin-bottom:4px;" id="input_<?php echo $v['id']; ?>" class="newQuestion">
          <input name="value<?php echo $core->dblang;?>[<?php echo $v['id']; ?>]" type="text"  id="value<?php echo $k; ?>" class="inputbox" value="<?php echo $v['value'.$core->dblang] ?>" size="55" />
          <img src="images/handle.png" alt="" class="smallHandle" style="margin-right:8px;margin-top:4px"/>
          </div>
          <?php endforeach;?>
          <?php unset($v);?>
          <?php unset($k);?>
          </div>
<?php /*?>         <input type="button" id="btnAdd" class="button-sml" value="<?php echo PLG_PL_ADD_Q;?>" />
		<input type="button" id="btnDel" class="button-alt-sml" value="<?php echo PLG_PL_DEL_Q;?>" /><?php */?>
        </td>
    </tr>
    <tr>
      <td><?php echo PLG_PL_ACTIVE;?>:</td>
      <td><span class="input-out">
        <label for="status-1"><?php echo _YES;?></label>
        <input name="status" type="radio" id="status-1" value="1" <?php getChecked($row['status'], 1); ?> />
        <label for="status-2"><?php echo _NO;?></label>
        <input name="status" type="radio" id="status-2" value="0" <?php getChecked($row['status'], 0); ?> />
        </span></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" class="button updatePoll" value="<?php echo PLG_PL_UPDATE;?>" /></td>
      <td><a href="index.php?do=plugins&amp;action=config&amp;plug=poll" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
  <input name="pollid" type="hidden" value="<?php echo $poll->pollid;?>" />
</form>
<?php echo $core->doForm("updatePoll","plugins/poll/controller.php");?>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
	/*
    $('#btnAdd').click(function () {
        var value = $('.newQuestion').length;
        var newValue = new Number(value + 1);

        var newElem = $('#input_' + value).clone().attr('id', 'input_' + newValue);

        newElem.children(':first').attr('id', 'value' + newValue).attr('name', 'value<?php //echo $core->dblang;?>[' + newValue + ']');
        $('#input_' + value).after(newElem);
        (value) ? $('#btnDel').show() : $('#btnDel').hide();
    });

    $('#btnDel').click(function () {
        var value = $('.newQuestion').length;

        $('#input_' + value).remove();
        (value - 1 == 1) ? $('#btnDel').hide() : $('#btnDel').show();
    });
	*/
    $("div#sort-options").sortable({
        handle: '.smallHandle',
        opacity: 0.6,
        helper: 'helper',
        update: function() {
            var result = $('div#sort-options').sortable('serialize');
			result += '&sortpoll=1';
			$.ajax({
				type: "post",
				url: "plugins/poll/controller.php",
				data: result,
				cache: false,
				success: function (res) {
					$('#msgDisplay').html(res);
				}
			});
		  
			
            //$.post("plugins/poll/controller.php?sortpoll=1&" + order, function(theResponse) {
               // $("#msgDisplay").html(theResponse);
            //});
        }

    });
});
// ]]>
</script>
<?php break;?>
<?php case"add": ?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo PLG_PL_TITLE2;?></h1>
<p class="info"><?php echo PLG_PL_INFO2 . _REQ1. required() . _REQ2;?></p>
<h2><?php echo PLG_PL_SUBTITLE2;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo PLG_PL_QUESTION;?>: <?php echo required();?></td>
      <td><input name="question<?php echo $core->dblang;?>" type="text" class="inputbox" size="55" /></td>
    </tr>
        <tr>
          <td><?php echo PLG_PL_OPTIONS;?>:</td>
          <td valign="top">
          <div style="margin-bottom:4px;" id="input1" class="newQuestion">
              <input name="value<?php echo $core->dblang;?>[1]" type="text"  id="value1" class="inputbox" size="55" />
            </div>
            <input type="button" id="btnAdd" class="button-sml" value="<?php echo PLG_PL_ADD_Q;?>" />
		    <input type="button" id="btnDel" class="button-alt-sml" value="<?php echo PLG_PL_DEL_Q;?>" /></td>
        </tr>
    <tr>
      <td><?php echo PLG_PL_ACTIVE;?>:</td>
      <td><span class="input-out">
        <label for="status-1"><?php echo _YES;?></label>
        <input name="status" type="radio" id="status-1" value="1" checked="checked" />
        <label for="status-2"><?php echo _NO;?></label>
        <input name="status" type="radio" id="status-2" value="0" />
      </span></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" class="button addPoll" value="<?php echo PLG_PL_ADD;?>" /></td>
      <td><a href="index.php?do=plugins&amp;action=config&amp;plug=poll" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
</form>
<?php echo $core->doForm("addPoll","plugins/poll/controller.php");?>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
    $('#btnAdd').click(function () {
        var value = $('.newQuestion').length;
        var newValue = new Number(value + 1);
        var newElem = $('#input' + value).clone().attr('id', 'input' + newValue);

        newElem.children(':first').attr('id', 'value' + newValue).attr('name', 'value<?php echo $core->dblang;?>[' + newValue + ']');
        $('#input' + value).after(newElem);
		(value) ? $('#btnDel').show() : $('#btnDel').hide();
    });

    $('#btnDel').click(function () {
        var value = $('.newQuestion').length;
        $('#input' + value).remove();
        (value - 1 == 1) ? $('#btnDel').hide() : $('#btnDel').show();
        
    });
});
// ]]>
</script>
<?php break;?>
<?php default: ?>
<h1><img src="images/plug-sml.png" alt="" /><?php echo PLG_PL_TITLE3;?></h1>
<p class="info"><?php echo PLG_PL_INFO3;?></p>
<h2><span><a href="index.php?do=plugins&amp;action=config&amp;plug=poll&amp;plug_action=add" class="button-sml"><?php echo PLG_PL_ADD1;?></a></span><?php echo PLG_PL_SUBTITLE3 . $content->getPluginName(get("plug"));?></h2>
  <table cellpadding="0" cellspacing="0" class="display">
    <thead>
      <tr>
        <th width="15">#</th>
        <th class="left"><?php echo PLG_PL_QUESTION;?></th>
        <th class="left"><?php echo PLG_PL_DATE;?></th>
        <th><?php echo PLG_PL_VIEW;?></th>
        <th><?php echo PLG_PL_EDIT;?></th>
        <th><?php echo _DELETE;?></th>
      </tr>
    </thead>
    <tbody>
      <?php if($pollrow == 0):?>
      <tr style="background-color:transparent">
        <td colspan="6"><?php echo $core->msgAlert(PLG_PL_NOPOLL,false);?></td>
      </tr>
      <?php else:?>
      <?php foreach ($pollrow as $prow):?>
      <tr>
        <td><?php echo $prow['id'];?>.</td>
        <td><?php echo $prow['question'.$core->dblang];?></td>
        <td><?php echo dodate($core->short_date, $prow['created']);?></td>
        <td align="center"><div id="pollinfo-<?php echo $prow['id'];?>" class="dialog" title="<?php echo $prow['question'.$core->dblang];?>"><?php echo $poll->showPollResults($prow['id']);?></div>
        <a href="javascript:void(0);" onclick="$('#pollinfo-<?php echo $prow['id'];?>').dialog('open'); return false">
          <img src="images/view.png" alt="" class="tooltip" title="<?php echo PLG_PL_VIEW;?>" />
          </a>
          </td>
        <td align="center"><a href="index.php?do=plugins&amp;action=config&amp;plug=poll&amp;plug_action=edit&amp;pollid=<?php echo $prow['id'];?>"><img src="images/edit.png" class="tooltip"  alt="" title="<?php echo PLG_PL_EDIT.': '.$prow['question'.$core->dblang];?>"/></a></td>
        <td align="center"><a href="javascript:void(0);" class="delete" rel="<?php echo $prow['question'.$core->dblang];?>" id="item_<?php echo $prow['id'];?>"><img src="images/delete.png" alt="" class="tooltip" title="<?php echo _DELETE.': '.$prow['question'.$core->dblang];?>" /></a></td>
      </tr>
      <?php endforeach;?>
      <?php unset($prow);?>
      <?php endif;?>
    </tbody>
  </table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '.PLG_PL_POLL;?>">
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
                    url: "plugins/poll/controller.php",
                    data: 'deletePoll=' + id + '&polltitle=' + title,
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

	$(".dialog").dialog({
	  bgiframe: true, autoOpen: false, width:"auto", height:"auto", zindex:9998, modal: false
	});
});
// ]]>
</script>
<?php break;?>
<?php endswitch;?>