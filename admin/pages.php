<?php
  /**
   * Pages
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: pages.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
//  if(!$user->getAcl("Pages")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
    if(!$user->checkOperationPermission("pages")):print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>

<?php include_once("help/pages.php");?>
<?php $contentpage=new Content(); ?>
<?php $pagerows= $content->getPages() ?>

<?//require_once("../lib/class_paginate.php "); ?>
<?php //$pager=new Paginator();?>

<?php switch($core->action):

    case "view": ?>


<?php $row = $core->getRowById("pages", $_GET['pageid']);?>
<?php //$postrow = $contentpage->getPosts();?>
<h1><img src="images/pages-sml.png" alt="" /><?php echo _PG_TITLEview;?></h1>
<p class="info"><?php echo _PG_INFO1view?></p>
<h2><span><a href="javascript:void(0);" onclick="$('#dialog').dialog('open'); return false"><img src="images/help.png" alt="" /></a></span><?php echo _PG_SUBTITLE1Page . $row['title'.$core->dblang];?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
    <table cellspacing="0" cellpadding="0" class="formtable">
        <tr>
            <td width="200"><?php echo page_title;?></td>
            <td><?php echo $row['title'.$core->dblang];?></td>
        </tr>
        <tr>
            <td><?php echo _PG_SLUG;?>:</td>
            <td><?php echo $row['slug'];?>

        </tr>
        <tr>
            <td><?php echo _PG_PUB;?>:</td>
            <td><span class="input-out">
        <label for="active-1"><?php echo _YES;?></label>
        <input name="active" type="radio" id="active-1" value="1" <?php getChecked($row['active'], 1); ?> />
        <label for="active-2"><?php echo _NO;?></label>
        <input name="active" type="radio" id="active-2" value="0" <?php getChecked($row['active'], 0); ?> />
        </span></td>
        </tr>
        <tr>
            <td><?php echo _PG_KEYS;?>:</td>
            <td><?php echo $row['keywords'.$core->dblang];?>

        </tr>
        <tr>
            <td><?php echo _PG_DESC;?>:</td>
            <td><?php echo $row['description'.$core->dblang];?></td>
        </tr>
        <tr>
            <td colspan="2" class="editor">
                <textarea id="bodycontent" name="body<?php echo $core->dblang;?>" rows="4" cols="30"><?php echo $core->out_url($row['body'.$core->dblang]);?></textarea>
                <?php loadEditor("bodycontent"); ?></td>
        </tr>
        <tr>
            <td><?php echo _PO_JSCODE;?>:</td>
            <td><textarea name="jscode" rows="4" cols="45"><?php echo cleanOut($row['jscode']);?></textarea>

        </tr>
        <tr>
<!--            <td><input type="submit" name="submit" class="button" value="--><?php //echo _PG_UPDATE;?><!--" /></td>-->
<!--            <td><a href="index.php?do=pages" class="button-alt">--><?php //echo _CANCEL;?><!--</a></td>-->
        </tr>
    </table>
<!--    <input name="pageid" type="hidden" value="--><?php //echo $contentpage->pageid;?><!--" />-->
</form>
<?php echo $core->doForm("processPage");?>

<?php break;?>

?>


<!--////////////////////////////////////////////////////////////end comment fady-->

<?php //----------------------------------------Edit-----------------------------------------------------------------------// ?>
<?php

    case "edit": ?>
<?php $row = $core->getRowById("pages", $contentpage->pageid);?>
<?php $postrow = $contentpage->getPosts();?>
<h1><img src="images/pages-sml.png" alt="" /><?php echo _PG_TITLE1;?></h1>
<p class="info"><?php echo _PG_INFO1. _REQ1 . required(). _REQ2;?></p>
<h2><span><a href="javascript:void(0);" onclick="$('#dialog').dialog('open'); return false"><img src="images/help.png" alt="" /></a></span><?php echo _PG_SUBTITLE1 . $row['title'.$core->dblang];?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo _PG_TITLE;?>: <?php echo required();?></td>
      <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $row['title'.$core->dblang];?>" size="55" /></td>
    </tr>
    <tr>
      <td><?php echo _PG_SLUG;?>:</td>
      <td><input name="slug" type="text" class="inputbox" value="<?php echo $row['slug'];?>" size="55" />
      &nbsp; <?php echo tooltip(_PG_SLUG_T);?></td>
    </tr>
    <tr>
      <td><?php echo _PG_PUB;?>:</td>
      <td><span class="input-out">
        <label for="active-1"><?php echo _YES;?></label>
        <input name="active" type="radio" id="active-1" value="1" <?php getChecked($row['active'], 1); ?> />
        <label for="active-2"><?php echo _NO;?></label>
        <input name="active" type="radio" id="active-2" value="0" <?php getChecked($row['active'], 0); ?> />
        </span></td>
    </tr>
    <tr>
      <td><?php echo _PG_KEYS;?>:</td>
      <td><input name="keywords<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $row['keywords'.$core->dblang];?>" size="55" />
        &nbsp;&nbsp; <?php echo tooltip(_PG_KEYS_T);?></td>
    </tr>
    <tr>
      <td><?php echo _PG_DESC;?>:</td>
      <td><textarea name="description<?php echo $core->dblang;?>" cols="55" rows="6"><?php echo $row['description'.$core->dblang];?></textarea></td>
    </tr>
      <tr>
          <td colspan="2" class="editor">
              <textarea id="bodycontent" name="body<?php echo $core->dblang;?>" rows="4" cols="30"><?php echo $core->out_url($row['body'.$core->dblang]);?></textarea>
              <?php loadEditor("bodycontent"); ?></td>
         
      </tr>
      <tr>
          <td><?php echo _PO_JSCODE;?>:</td>
          <td><textarea name="jscode" rows="4" cols="45"><?php echo cleanOut($row['jscode']);?></textarea>
              <?php echo tooltip(_PO_JSCODE_T);?></td>
      </tr>
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo _PG_UPDATE;?>" /></td>
      <td><a href="index.php?do=pages" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
  <input name="pageid" type="hidden" value="<?php echo $contentpage->pageid;?>" />
</form>
<?php echo $core->doForm("processPage");?>

<?php break;?>


<?php case"add": ?>


<?php //----------------------------------------Add-----------------------------------------------------------------------// ?>



<h1><img src="images/pages-sml.png" alt="" /><?php echo _PG_TITLE2;?></h1>
<p class="info"><?php echo _PG_INFO2. _REQ1 . required(). _REQ2;?></p>
<h2><span><a href="javascript:void(0);" onclick="$('#dialog').dialog('open'); return false"><img src="images/help.png" alt="" /></a></span><?php echo _PG_SUBTITLE2;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo _PG_TITLE;?>: <?php echo required();?></td>
      <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox"  size="55" /></td>
    </tr>

    <tr>
      <td><?php echo _PG_PUB;?>:</td>
      <td><span class="input-out">
        <label for="active-1"><?php echo _YES;?></label>
        <input name="active" type="radio" id="active-1" value="1" checked="checked" />
        <label for="active-2"><?php echo _NO;?></label>
        <input name="active" type="radio" id="active-2" value="0"  />
        </span></td>
    </tr>

      <tr id="modshow">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    <tr>
      <td><?php echo _PG_KEYS;?>:</td>
      <td><input name="keywords<?php echo $core->dblang;?>" type="text" class="inputbox" size="80" />
        <?php echo tooltip(_PG_KEYS_T);?></td>
    </tr>
    <tr>
      <td><?php echo _PG_DESC;?>:</td>
      <td><textarea name="description<?php echo $core->dblang;?>" cols="55" rows="6"></textarea></td>
    </tr>
      <tr>
          <td colspan="2" class="editor">
              <textarea id="bodycontent" name="body<?php echo $core->dblang;?>" rows="4" cols="30"></textarea>
              <?php loadEditor("bodycontent"); ?></td>
      </tr>
      <tr>
          <td><?php echo _PO_JSCODE;?>:</td>
          <td><textarea name="jscode" rows="4" cols="45"></textarea>
              <?php echo tooltip(_PO_JSCODE_T);?></td>
      </tr>
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo _PG_ADD;?>" /></td>
      <td><a href="index.php?do=pages" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>

  </table>
</form>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function() {
    $('#memrow').hide();
    $('#access_id').change(function() {
        var option = $(this).val();
        var result = 'pageid=<?php echo $contentpage->pageid;?>';
        result += '&membershiplist=' + option;
		  $.ajax({
			  type: "post",
			  url: "ajax.php",
			  data: result,
			  cache: false,
			  success: function (res) {
				  (option == "Membership") ? $('#memrow').show(): $('#memrow').hide();
				  $('#membership').html(res);
			  }
		  });
    });
	
	$('#modshow').hide();
    $('#modulename').change(function() {
		var option = $(this).val();
		var result = 'module_data=0';
        result += '&modulelist=' + option;
		  $.ajax({
			  type: "post",
			  url: "ajax.php",
			  data: result,
			  cache: false,
			  success: function (res) {
				  (option == 0) ? $('#modshow').hide(): $('#modshow').show();
				  $('#modshow').html(res);
			  }
		  });
    });
});
// ]]>
</script>
<?php echo $core->doForm("processPage");?>
<?php break;?>


<?php default: ?>

<?php //----------------------------------------Manage-----------------------------------------------------------------------// ?>

<h1><img src="images/pages-sml.png" alt="" /><?php echo _PG_TITLE3;?></h1>
<p class="info"><?php echo _PG_INFO3;?></p>
<h2><span><a href="index.php?do=pages&amp;action=add" class="button-sml"><?php echo _PG_ADD;?></a></span><?php echo _PG_SUBTITLE3;?></h2>
<div class="right toRight page_actions">
    <table cellpadding="0" cellspacing="0" class="formtable_">
        <tr style="background-color:transparent">
            <td>

                <form action="" method="post" id="dForm">
                    <table>
                        <td>
                            <strong><?php echo _BY_KEYWORD;?></strong>&nbsp;&nbsp;
                            <input name="search" type="text" class="inputbox" id="search-input" value="" size="40"  onclick="disAutoComplete(this);"/>
                            <div id="suggestions"></div>
                        </td>

                        <td class='pr20'>
                            <input name="find" type="submit" class="button-sml" value="<?php  echo _UR_FIND;?>" />
                        </td>
                        <td class='pr20'>
                            <strong><?php echo _BY_SECTION;?></strong>&nbsp;&nbsp;
                            <?php echo getDeps(isset($_GET['section'])?$_GET['section']:'none'," onchange=\"window.location='$_SERVER[PHP_SELF]?section='+this[this.selectedIndex].label+'&do=pages' \"");?>
                        </td>
                        <td >
                            <?php echo $pager->items_per_page()?> &nbsp;&nbsp;


                        </td>
                        <td class='pr20'>
                            <strong><?php echo _C_ACTION;?></strong>&nbsp;&nbsp;
                            <select name="sort" style="width:120px" class="custombox group_actions">
                                <option value="NA">--none--</option>
                                <option value="delete"><?php echo _PG_DELETE;?></option>
                                <option value="publish"><?php echo _PUB;?></option>
                                <option value="unpublish"><?php echo _UNPUB;?></option>

                            </select>
                        </td>
                    </table>
                </form>

            </td>


        </tr>

    </table>
</div>


<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
    <th width="20" class="left">#</th>

   <?php if(!isset($_GET['sort']) || (isset($_GET['sort']) && $_GET['sort']=='title_en-ASC'))
    {?>
        <th class="left"><a href="index.php?do=pages&sort=title_en-DESC"  class='block relative'><span class='sorting asc'></span><?php echo _PG_TITLE;?></a></th>
        <?}else{ ?>

        <th class="left"><a href="index.php?do=pages&sort=title_en-ASC" class='block relative'><span class='sorting desc'></span><?php echo _PG_TITLE;?></a></th>
        <? } ?>






        <th class="left"><?php echo _PG_SECTION;?></th>
        <th class="left"><?php echo _LAST_MOD;?></th>
        <th class="left"><?php echo _MOD_BY;?></th>
      <th><?php echo _PUBLISHED;?></th>
      <th><?php echo _PG_VIEW2 ;?></th>
      <th><?php echo _PG_EDIT2;?></th>
      <th><?php echo _PG_DELETE;?></th>
      <th align=left> <input type='checkbox' class='check_all'/></th>
    </tr>
  </thead>
  <tbody>
    <?php if($pagerows==0):?>
    <tr>
      <td colspan="10"><?php echo $core->msgAlert(_PG_NOPAGES,false);?></td>
    </tr>
    <?php else:?>
    <?php foreach ($pagerows as $row):?>
    <?php
          if(isPageAssignedToMenu($row['id'])!==false){
          $topLevel = getTopLevelParent(getActualMenuID($row['slug']));

          $section = $db->first("SELECT name_en FROM menus WHERE  id = $topLevel");
     ?>
    <?php $section = $section['name_en'];
          }
          else {
             $section ='<span style="color:red;font-weight:bold;font-size:10px;">.xNOT ASSIGNEDx.</span>';
          }
          if(!isset($_GET['section']) || (isset($_GET['section']) && $_GET['section']==$section) || (isset($_GET['section']) && $_GET['section']=='--none--'))
          {
              ?>
    <tr>
      <td><?php echo $row['id'];?>.</td>
     
      <td><?php echo $row['title'.$core->dblang];?></td>
     
      <td><?php echo $section;?></td>
      <td>2012</td>
      <td>admin</td>

       <td align="center"><?php echo isActive($row['active']);?></td>
      <td align="center">
             <a  target="_blank"  href="<?php echo SITEURL .'/page/'.$row['slug'];?>.html"><img src="images/viewPage.png" class="tooltip"  alt="" title="<?php echo _PG_VIEW;?>"/></a>
            </a>
      </td>
        <td align="center">
              <a href="index.php?do=pages&amp;action=edit&amp;pageid=<?php echo $row['id'];?>"><img src="images/edit.png" class="tooltip"  alt="" title="<?php echo _PG_EDIT;?>"/></a>

      </td>
        <td align="center">
              <a href="javascript:void(0);" class="delete" rel="<?php echo $row['title'.$core->dblang];?>" id="item_<?php echo $row['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo Delete.': '.$row['title'.$core->dblang];?>"/></a>
      </td>
      <td>
        <input type='checkbox' id='check_<?php echo $row['id'];?>' class='to_be_checked'/>
      </td>
    </tr>
    <?php 
          }//section filter if ends here
    	endforeach;
    ?>
    <?php unset($row);?>


 <?php endif;?>
  </tbody>
</table>
 <div class='clearfix blew_table'>
    <div class='toLeft'>
    <?php if($pager->num_pages >= 1) echo $pager->jump_menu();?>
    </div>
    <div  class='toRight'>
     <?php if($pager->items_total >= $pager->items_per_page):?>
    <tr style="background-color:transparent">
        <td colspan="8" style="padding:10px;"><div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
    </tr>

    <?php endif;?>
   </div>
 </div>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '._PAGE;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {

    $("#search-input").watermark("<?php echo UR_FIND_all;?>");
    $("#search-input").keyup(function () {
        var srch_string = $(this).val();
        var data_string = 'pagesearch=' + srch_string;
        if (srch_string.length > 0) {
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: data_string,
                beforeSend: function () {
                    $('#search-input').addClass('loading');
                },
                success: function (res) {
                    $('#suggestions').html(res).show();
                    $("input").blur(function () {
                        $('#suggestions').customFadeOut();
                    });
                    if ($('#search-input').hasClass("loading")) {
                        $("#search-input").removeClass("loading");
                    }
                }
            });
        }
        return false;
    });

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
                    data: 'deletePage=' + id + '&pagetitle=' + title,
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
<?php endswitch;?>