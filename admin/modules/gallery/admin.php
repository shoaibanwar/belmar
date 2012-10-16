<?php
  /**
   * Gallery
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: gallery.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

//  if(!$user->getAcl("gallery")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
    
  require_once("lang/" . $core->language . ".lang.php");
  require_once("admin_class.php");
  $gal = new Gallery();

    if($user->checkOperationPermission('gallery') == '0' && $user->userlevel !=9 ): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;

?>
<?php switch($core->maction): case "edit":?>


<?php //--------------------------------------------Editing-------------------------------------------------------// ?>


<?php
$permitted = $user->get_permitted_galleries();
if(!in_array_recursive($gal->type,$permitted)) : print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>

<h1><img src="images/mod-sml.png" alt="" /><?php echo MOD_GA_TITLE1;?></h1>
<p class="info"><?php echo MOD_GA_INFO1 . _REQ1 . required() . _REQ2;?></p>
<h2><?php echo MOD_GA_SUBTITLE1.' &rsaquo; '.$gal->title;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo MOD_GA_NAME;?>: <?php echo required();?></td>
      <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $gal->title;?>" size="55" /></td>
    </tr>
    <tr>
      <td width="200"><?php echo MOD_GA_TITLE;?>: </td>
      <td><input name="nav_title" type="text" value="<?php echo $gal->nav_title;?>" class="inputbox" size="55" />
      &nbsp;&nbsp; <?php echo tooltip(MOD_GA_TITLE_T);?></td>
    </tr>
    <tr>
      <td><?php echo _GALTYPE;?>: <?php echo required();?></td>
      <td>
          <select name="type" class="custombox" style="width:200px">
                  <?php 
                  $types = Gallery::getGalleryTypes();
                  foreach($types as $type)
                  {
                  	  $typetitle = strtoupper($type['name_en']);
                      $selected = $gal->type == $type['id']?"selected='selected'":'';
                      echo "<option $selected value='{$type['id']}'>{$typetitle}</option>";
                  }
                   ?>
              </select> 
        &nbsp;&nbsp; <?php echo tooltip(MOD_GA_TYPE_T);?></td>
    </tr>
    <tr>
      <td><?php echo MOD_GA_PUBLISHED;?>: <?php echo required();?></td>
      <td><span class="input-out">
        <label for="published_yes"><?php echo _YES;?></label>
        <input name="published" type="radio" id="published_yes"  value="1" <?php echo $gal->published?"checked='checked'":''; ?> />
        <label for="published_no"><?php echo _NO;?></label>
        <input name="published" type="radio" id="published_no" value="0"  <?php echo !$gal->published?"checked='checked'":''; ?>/>
        <?php echo tooltip(MOD_GA_PUBLISHED_T);?></span></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo MOD_GA_UPDATE;?>" /></td>
      <td><a href="index.php?do=modules&amp;action=config&amp;mod=gallery" class="button-alt"><?php echo _CANCEL;?></a></td>
    </tr>
  </table>
  <input name="galid" type="hidden" value="<?php echo $gal->galid;?>" />
</form>
<?php echo $core->doForm("processGallery","modules/gallery/controller.php");?>
<?php break;?>
<?php case"add": ?>


<?php //----------------------------------------Adding-----------------------------------------------------------// ?>



<h1><img src="images/mod-sml.png" alt="" /><?php echo MOD_GA_TITLE2;?></h1>
<p class="info"><?php echo MOD_GA_INFO2 . _REQ1 . required() . _REQ2;?></p>
<h2><?php echo MOD_GA_SUBTITLE2;?></h2>
<form action="" method="post" id="admin_form" name="admin_form">
  <table cellspacing="0" cellpadding="0" class="formtable">
    <tr>
      <td width="200"><?php echo MOD_GA_NAME;?>: <?php echo required();?></td>
      <td><input id="title_input" name="title<?php echo $core->dblang;?>" type="text" class="inputbox" size="55" /></td>
    </tr>
    <tr>
      <td width="200"><?php echo MOD_GA_TITLE;?>: </td>
      <td><input name="nav_title" type="text" class="inputbox" size="55" />
      &nbsp;&nbsp; <?php echo tooltip(MOD_GA_TITLE_T);?></td>
    </tr>
    <tr>
      <td><?php echo _GALTYPE;?>: <?php echo required();?></td>
      <td>
          <select name="type" class="custombox" style="width:200px">
                  <?php 
                  $types = Gallery::getGalleryTypes();
                  foreach($types as $type)
                  {
                  	  $typetitle = strtoupper($type['name_en']);
                      echo "<option value='{$type['id']}'>{$typetitle}</option>";
                  }
                   ?>
              </select> 
        &nbsp;&nbsp; <?php echo tooltip(MOD_GA_TYPE_T);?></td>
    </tr>
      <tr>
          <td><?php echo MOD_GA_PUBLISHED;?>: <?php echo required();?></td>
          <td><span class="input-out">
        <label for="published_yes"><?php echo _YES;?></label>
        <input name="published" type="radio" id="published_yes"  value="1" checked="checked" />
        <label for="published_no"><?php echo _NO;?></label>
        <input name="published" type="radio" id="published_no" value="0" />
              <?php echo tooltip(MOD_GA_PUBLISHED_T);?></span></td>
      </tr>
      <tr>
          <td><?php echo MOD_GA_WATERMARK;?>:</td>
          <td><span class="input-out">
        <label for="watermark-1"><?php echo _YES;?></label>
        <input name="watermark" type="radio" id="watermark-1"  value="1" checked="checked"  />
        <label for="watermark-2"><?php echo _NO;?></label>
        <input name="watermark" type="radio" id="watermark-2" value="0"/>
              <?php echo tooltip(MOD_GA_WATERMARK_T);?></span></td>
      </tr>
    <tr>
      <td>Thumbnails per row: <?php echo required();?></td>
      <td>
      <select name="rows">
      	<?php for($tpri = 1; $tpri<=10; $tpri++){?>
      		<option value="<?php echo $tpri;?>" <?php if($tpri==5){echo 'selected';}?>><?php echo $tpri;?></option>
      	<?php }?>
      </select>
      &nbsp;&nbsp; <?php echo tooltip(MOD_GA_IPR_T);?></td>
    </tr>
    <tr>
      <td>Number of Rows Per Page: <?php echo required();?></td>
      <td><input name="vert_rows" type="text" class="inputbox" size="5" />
      &nbsp;&nbsp; &lt;How many rows to display per page</td>
    </tr>
      <tr>
          <td><?php echo 'Thumbnail size';?>:</td>
          <td>
          	  <div class="input-out" style="float:left; margin-right:10px">
		        <label for="thumb-resize-1"><?php echo "Exact";?></label>
		        <input name="thumb-resize" type="radio" id="thumb-resize-1"  value="1" checked="checked"  />
		        <label for="thumb-resize-2"><?php echo "Propotional";?></label>
		        <input name="thumb-resize" type="radio" id="thumb-resize-2" value="0"/>
              </div>
              <div style="float:left;" id="thumb-resize-option-1">
              	Width: <input type="text" name="thumbexactwidth" class="inputbox" size="5"/> px&nbsp;
              	Height: <input type="text" name="thumbexactheight" class="inputbox" size="5"/> px
              </div>
              <div style="float:left;" id="thumb-resize-option-2">
              	Select the Resize proportion&nbsp;
              	<input type="text" name="thumbproportionsize" class="inputbox" size="5"/>
              	<select id="thumbporportionto">
              		<option value="width">Width</option>
              		<option value="height">Height</option>
              	</select>
              	<select id="thumbporportionpercentpixel">
              		<option value="%">%</option>
              		<option value="px">px</option>
              	</select>
              </div>
           </td>
      </tr>
      <tr>
          <td><?php echo 'Enlarged Image size';?>:</td>
          <td>
          	  <div class="input-out" style="float:left; margin-right:10px">
		        <label for="large-resize-1"><?php echo "Exact";?></label>
		        <input name="large-resize" type="radio" id="large-resize-1"  value="1" checked="checked"  />
		        <label for="large-resize-2"><?php echo "Propotional";?></label>
		        <input name="large-resize" type="radio" id="large-resize-2" value="0"/>
              </div>
              <div style="float:left;" id="large-resize-option-1">
              	Width: <input type="text" name="largeexactwidth" class="inputbox" size="5"/> px&nbsp;
              	Height: <input type="text" name="largeexactheight" class="inputbox" size="5"/> px
              </div>
              <div style="float:left;" id="large-resize-option-2">
              	Select the Resize proportion&nbsp;
              	<input type="text" name="largeproportionsize" class="inputbox" size="5"/>
              	<select id="largeporportionto">
              		<option value="width">Width</option>
              		<option value="height">Height</option>
              	</select>
              	<select id="largeporportionpercentpixel">
              		<option value="%">%</option>
              		<option value="px">px</option>
              	</select>
              </div>
           </td>
      </tr>
    <tr>
      <td><input type="submit" name="submit" class="button" value="<?php echo MOD_GA_ADDMOD_GALLERY;?>" /></td>
      <td><button id="addUpload" class="button"><?php echo MOD_GA_ADDMOD_GALLERY_ADDPHOTOS;?></button></td>
<!--      <td><a href="index.php?do=modules&amp;action=config&amp;mod=gallery" class="button-alt">--><?php //echo _CANCEL;?><!--</a></td>-->
    </tr>
  </table>
</form>
<?php echo $core->doForm("processGallery","modules/gallery/controller.php");?>
    <script type="text/javascript">
         var isAdd =true;
        $(document).ready(function(){
            $("#thumb-resize-option-2").hide();
            $("#large-resize-option-2").hide();
            $("#addUpload").click(function(e){
                isAdd = false;
                e.preventDefault();
                $.post(
                    '<?php echo ADMINURL; ?>/modules/gallery/controller.php',
                    {'title':$('#title_input').val(),'galExists':1},
                    function(data){
                       if(data.exists!=0)
                           location.href = '<?php echo ADMINURL; ?>/index.php?do=modules&action=config&mod=gallery&mod_action=images&galid=' +
                               data.exists;
                        else
                       {
                           $('#addUpload').parents('tr').find('input[type=submit]').click();
                       }
                    },
                    'json');

            });
        });

        $("#thumb-resize-1").click(function(e){
            $("#thumb-resize-option-2").hide();
            $("#thumb-resize-option-1").show();
        });

        $("#thumb-resize-2").click(function(e){
            $("#thumb-resize-option-2").show();
            $("#thumb-resize-option-1").hide();			
        });

        $("#large-resize-1").click(function(e){
            $("#large-resize-option-2").hide();
            $("#large-resize-option-1").show();				
        });

        $("#large-resize-2").click(function(e){
            $("#large-resize-option-2").show();
            $("#large-resize-option-1").hide();	
        });
        function onAdd(id)
        {

            if(isAdd) return;
           location.href = '<?php echo ADMINURL; ?>/index.php?do=modules&action=config&mod=gallery&mod_action=images&galid=' +
                id;
            }
    </script>
<?php break;?>
<?php

    case"images": ?>


<?php //----------------------------------------Showing images-----------------------------------------------------------// ?>


    <?php
    $permitted = $user->get_permitted_galleries();
    if(!in_array_recursive($gal->type,$permitted)) : print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
    ?>
    <?php $imagerow = $gal->getGalleryImages();?>
<h1><img src="images/gallery-sml.png" alt="" /><?php echo MOD_GA_TITLE3 . $gal->title;?></h1>
<p class="info"><?php echo MOD_GA_INFO3;?></p>
<h2><span><a href="javascript:void(0);" onclick="$('#gallery').dialog('open'); return false" id='add_images' class="button-sml"><?php echo MOD_GA_ADD_IMG;?></a></span><?php echo MOD_GA_SUBTITLE3_. $gal->title . MOD_GA_SUBTITLE31_;?></h2>
<div id="gallery" title="<?php echo MOD_GA_IMG_UPLOAD;?>">
<div style="padding-bottom:10px;padding-top:10px">
  <div id="upload"><span class="button-alt"><?php echo MOD_GA_IMG_ADD;?></span></div>
  <div id="status"><img src="images/ajax-loader.gif" alt="" /></div>
  </div>
  <ul id="img-list">
  <li style="display:none"></li>
  </ul>
</div>

<li id="imageDummy" class="gallery-item"  style="display:none;width:<?php echo $gal->thumb_w;?>px;height:<?php echo $gal->thumb_h;?>px"> <a  id="tDummy" rel="gallery" class="pirobox_gallery" ><img src=""/></a>
    <div class="item-options">
        <a class="setCover icon-button tooltip" href="javascript:" title="set cover"><img src="images/inactive.png" /></a><a class="icon-button edit tooltip" href="javascript:void(0);" title="<?php echo _EDIT;?>">Edit</a><a class="icon-button delete tooltip" href="javascript:void(0);"   title="<?php echo _DELETE;?>">Delete</a>
    </div>
    <p id="optionsDummy" class="" title="<?php echo MOD_GA_EDIT_IMG;?>">
        <span style="display:block; margin-bottom:10px">
            <strong style="float:left; width:200px">
                <?php echo MOD_GA_IMG_TITLE;?>:
            </strong>
            <input name="title<?php echo $core->dblang;?>" id="titleDummy" type="text"  value="" class="inputbox" size="50"/>
        </span>
        <span style="display:block">
            <strong style="float:left; width:200px">
                <?php echo MOD_GA_IMG_DESC;?>:
            </strong>
            <input name="description<?php echo $core->dblang;?>" id="descDummy" type="text"  value="" class="inputbox" size="50"/>
        </span>
        <br clear="all"/>
        <span style="display:block">
            <strong style="float:left; width:200px">
                <img id="thumbDummy" src="" style="border: 1px solid #CFCFCF; background-color: #FFF; padding:5px;-moz-border-radius:5px;-khtml-border-radius:5px;-webkit-border-radius:5px"/>
            </strong>
            <input id="submitDummy" type="button" value="<?php echo _SUBMIT;?>" class="button" onclick=""/>
            <span class="msgDisplay"></span>
        </span>
    </p>
</li>
    <ul id="galleryrow">
<?php if($imagerow == 0):?>
<?php echo $core->msgAlert(MOD_GA_NOIMG,false);?>

<?php else:?>

  <?php foreach($imagerow as $row):?>
  <li class="gallery-item" id="item_<?php echo $row['id'];?>" style="width:<?php echo $gal->thumb_w;?>px;height:<?php echo $gal->thumb_h;?>px"> <a title="<?php echo $row['title'.$core->dblang];?>" rel="gallery" class="pirobox_gallery" href="<?php echo SITEURL.'/'.$gal->galpath . $gal->folder.'/'.$row['thumb'];?>"><img src="<?php echo SITEURL.'/'.$gal->galpath . $gal->folder.'/thumbs/'.$row['thumb'];?>" alt="<?php echo $row['description'.$core->dblang];?>" /></a>
    <div class="item-options">
        <a class="setCover icon-button tooltip" pid="<?php echo $row['id']; ?>" href="javascript:" title="set cover"><img src="images/<?php echo $row['cover']?"active.png":"inactive.png"; ?>"  /></a><a class="icon-button edit tooltip" href="javascript:void(0);" onclick="$('#options-<?php echo $row['id'];?>').dialog('open'); return false" title="<?php echo _EDIT;?>">Edit</a><a class="icon-button delete tooltip" href="javascript:void(0);" rel="<?php echo $row['title'.$core->dblang];?>" id="item_<?php echo $row['id'].':'.$gal->folder;?>" title="<?php echo _DELETE;?>">Delete</a>
    </div>
    <p id="options-<?php echo $row['id'];?>" class="options" title="<?php echo MOD_GA_EDIT_IMG;?>">
        <span style="display:block; margin-bottom:10px">
            <strong style="float:left; width:200px">
                <?php echo MOD_GA_IMG_TITLE;?>:
            </strong>
            <input name="title<?php echo $core->dblang;?>" id="title_<?php echo $row['id'];?>" type="text"  value="<?php echo $row['title'.$core->dblang];?>" class="inputbox" size="50"/>
        </span>
        <span style="display:block">
            <strong style="float:left; width:200px">
                <?php echo MOD_GA_IMG_DESC;?>:
            </strong>
            <input name="description<?php echo $core->dblang;?>" id="desc_<?php echo $row['id'];?>" type="text"  value="<?php echo $row['description'.$core->dblang];?>" class="inputbox" size="50"/>
        </span>
        <br clear="all"/>
        <span style="display:block">
            <strong style="float:left; width:200px">
                <img src="<?php echo SITEURL.'/'.$gal->galpath . $gal->folder.'/thumbs/'.$row['thumb'];?>" alt="<?php echo $row['title'.$core->dblang];?>" style="border: 1px solid #CFCFCF; background-color: #FFF; padding:5px;-moz-border-radius:5px;-khtml-border-radius:5px;-webkit-border-radius:5px"/>
            </strong>
            <input type="button" value="<?php echo _SUBMIT;?>" class="button" onclick="updateOptions(<?php echo $row['id'];?>);"/>
            <span class="msgDisplay"></span>
        </span>
    </p>
  </li>
  <?php endforeach;?>

<div class="clear"></div>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '._IMAGE;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>
<?php endif;?>
    </ul>
<script type="text/javascript" src="assets/upload.js"></script>
<script type="text/javascript"> 
// <![CDATA[
$(function () {
   var btnUpload = $('#upload');
    var status = $('#status');
    <?php if(isset($_GET['add'])): ?>
        setTimeout(function(){  $("#gallery").dialog('open'); },500);
    <?php endif; ?>
    $(".setCover").live('click',function(e){
        e.preventDefault();
        var newCover = $(this);
        $.post('<?php echo ADMINURL.'/modules/gallery/controller.php'; ?>',{ cover:1,pid:$(this).attr('pid') },
        function(data){
            if(data==1)
            {
                $(".setCover").find('img').attr('src',"images/inactive.png")
                newCover.find('img').attr('src',"images/active.png")
                showMessage('ok',"<?php echo MOD_GA_COVER_SET; ?>");
            }
            else {
                showMessage('error',"<?php echo _ERROR; ?>");
            }
        }
        );
    });
    status.hide();

    $(btnUpload).uploadify({
        height        : 30,
        swf           : '<?php echo ADMINURL; ?>/assets/uploadify/uploadify.swf',
        uploader      : '<?php echo ADMINURL; ?>/modules/gallery/controller.php',
        width         : 120,
        'auto'     : true,
        'fileObjName' : 'image',
        'formData'      : {'id' : <?php echo $gal->galid ?> , 'uploadimage': 1 ,'hash': '<?php echo $user->getHash();?>' },
        'onSubmit ': function(){status.text('<?php echo _CG_LOGO_R;?>')},
        'onUploadSuccess' : function (file, response) {
            status.hide();
            console.log(response);
            var arr = response.split('|')   ;
            var new_elem=  $('li#imageDummy') .clone().show();

            $("div.msgAlert").hide();

                    $(new_elem).attr('id','item_' + arr[2])
                    .find('#tDummy')
                        .attr('id','')
                        .attr('title',arr[3])
                        .attr('href','<?php echo SITEURL.'/'.$gal->galpath . $gal->folder.'/';?>' + arr[1])
                    .find('img')
                        .attr('src','<?php echo SITEURL.'/'.$gal->galpath . $gal->folder.'/thumbs/';?>' + arr[1])
                        .attr('alt',arr[4])
                    .parents('li').find('a.setCover')
                        .attr('pid',arr[2])
                    .parents('div.item-options').find('a.edit')
                        .attr('onClick',"$('#options-"+ arr[2] +"').dialog('open'); return false")
                    .parents().find('a.delete')
                        .attr('id',"item_" + arr[2] + ":" + "<?php echo $gal->folder;?>")
                        .attr('rel',arr[4])

                    .parents('li').find('p#optionsDummy')
                        .attr('id',"options-"+ arr[2] +"")
                        .attr('class',"options")
                    .find('input#titleDummy')
                        .attr('id',"title_" + arr[2] + "")
                        .attr('value',arr[3])
                    .parents('p').find('input#descDummy')
                        .attr('id',"desc_" + arr[2] + "")
                        .attr('value',arr[4])
                    .parents('p').find('img#thumbDummy')
                        .attr('id','')
                        .attr('src',"<?php echo SITEURL.'/'.$gal->galpath . $gal->folder.'/thumbs/';?>" + arr[1] +"")
                    .parents('p').find('input#submitDummy')
                        .attr('id','')
                        .attr('onClick',"updateOptions(" + arr[2] +");")
                        .parents('p').hide()
                    ;
           $('#galleryrow').prepend($(new_elem));

            $(".options").dialog({
                bgiframe: true,
                autoOpen: false,
                width: "auto",
                height: "auto",
                zindex: 9998,
                modal: false

            });

        }
    });

});

var galHelper = function (e, li) {
    li.children().each(function () {
        $(this).width($(this).width());
    });
    return li;
};
$(document).ready(function () {
	$("#gallery").dialog({
	  bgiframe: true, 
	  autoOpen: false, 
	  width:<?php echo $gal->thumb_w * 4 + 55;?>, 
	  height:"auto",  
	  zindex:9998, 
	  modal: false
	});
	
    $("#galleryrow").sortable({
        opacity: 0.6,
        helper: galHelper,
        update: function() {
            var order = $('#galleryrow').sortable('serialize');
                $.ajax({
                    type: 'post',
                    url: "modules/gallery/controller.php?sortgallery=1",
                    data: order,

                    success: function (msg) {
						$("#msgholder").html(msg);
                    }
                });
			$("#galleryrow").disableSelection();
        }
    });
	
    $(".options").dialog({
        bgiframe: true,
        autoOpen: false,
        width: "auto",
        height: "auto",
        zindex: 9998,
        modal: false

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
                    url: "modules/gallery/controller.php",
                    data: 'deleteImage=' + id + '&imgtitle=' + title,
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
                        console.log(msg);
                       //showMessage('',$(msg).find('div').text());

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
function updateOptions(id) {
    var desc = $('#desc_' + id).attr('value');
    var title = $('#title_' + id).attr('value');
    var pars = 'desc=' + desc + '&title=' + title + '&imgid=' + id;
    $.ajax({
        type: "POST",
        url: "modules/gallery/controller.php",
        data: pars,
        success: function (msg) {
            $("#msgholder").ajaxComplete(function (event, request, settings) {
					$(this).html(msg);
                    $(".options").dialog("close");
            });
        }
    });
}
// ]]>
</script>
<?php break;?>
<?php

    default: ?>


<?php //----------------------------------------Manage-----------------------------------------------------------// ?>


<?php
//filter by type
if(isset($_GET['type']) && $_GET['type'] !='all')
    $galleries = $gal->getGalleries($_GET['type']) ;
//filter by search
elseif(isset($_GET['search']))
    $galleries = $gal->getGalleries('',$_GET['search']) ;
//no filtering
else
    $galleries =  $gal->getGalleries();
?>


<h1><img src="images/mod-sml.png" alt="" /><?php echo MOD_GA_TITLE4;?></h1>
<p class="info"><?php echo MOD_GA_INFO4;?></p>
<h2><span><a href="index.php?do=modules&amp;action=config&amp;mod=gallery&amp;mod_action=add" class="button-sml"><?php echo MOD_GA_SUBTITLE4;?></a></span><?php echo MOD_GA_SUBTITLE3;?></h2>
<table style="width:100%" class="formtable">
    <tbody>
    <td>
             Search By Keyword
            <input name="search" type="text" class="inputbox" id="galSearch"  size="40" />
            <button onclick="handleSearch()" class=button-sml>Go</button>


    </td>
    <td>
                 Show By Type:
        </form>
            <select name="type" class="custombox" style="width:200px;" onchange="javascript:handleTypeSelect(this)">
                <option value="all">--none--</option>
                <?php $types = $gal->getGalleryTypes(); ?>
                <?php foreach($types as $galType): ?>
                <option <?php if(isset($_GET['type']) && $galType['id'] == $_GET['type']) echo "selected='selected'"; ?> value="<?php echo $galType['id']; ?>"><?php echo $galType['name_en']; ?></option>
            <?php endforeach; ?>
            </select>
    </td>

    <td align="right">
        <?php echo $pager->items_per_page();?> &nbsp;&nbsp;
        <?php if($pager->num_pages >= 1) echo $pager->jump_menu();?></td>
    </td>
    </tbody>
</table>
    <?php

    ?>
<table cellpadding="0" cellspacing="0" class="display">
  <thead>
    <tr>
      <th width="20" class="left"><a href="<?php echo getSortValue('id','?do=modules&action=config&mod=gallery','type'); ?>">#<?php getSortDirection('id'); ?></a></th>
      <th class="left"><a href="<?php echo getSortValue('title_en','?do=modules&action=config&mod=gallery','type'); ?>"><?php echo MOD_GA_NAME;getSortDirection('title_en');?></a></th>
        <th><?php echo MOD_GA_COVER;?></th>
        <th><a href="<?php echo getSortValue('type','?do=modules&action=config&mod=gallery','type'); ?>"><?php echo _GALTYPE;getSortDirection('type');?></a></th>
      <th><a href="<?php echo getSortValue('totalpics','?do=modules&action=config&mod=gallery','type'); ?>"><?php echo MOD_GA_TOTAL_IMG;getSortDirection('totalpics');?></a></th>
      <th><a href="<?php echo getSortValue('created','?do=modules&action=config&mod=gallery','type'); ?>"><?php echo _CREATED;getSortDirection('created');?></a></th>
      <th><a href="<?php echo getSortValue('published','?do=modules&action=config&mod=gallery','type'); ?>"><?php echo MOD_GA_PUBLISHED;getSortDirection('published');?></a></th>
        <th><?php echo MOD_GA_EDITMOD_GAL;?></th>
        <th><?php echo MOD_GA_DELETE_GAL;?></th>
        <th style="background: #C0D0E0"><?php echo MOD_GA_OPS_IMGS;?></th>
    </tr>
  </thead>
  <tbody>




      <?php if(!$galleries): ?>
          <tr>
              <td colspan="7"><?php echo $core->msgAlert(MOD_GA_NOMOD_GAL,false);?></td>
          </tr>
      <?php else:?>
      <?php foreach ($galleries as $row):?>
    <tr>
      <td><?php echo $row['id'];?>.</td>
      <td><?php echo $row['title'.$core->dblang];?></td>
        <td align="center"><img style="width:50px;height: 50px;" src="<?php echo $gal->getCoverImage($row['id'],$row['folder']); ?>" /></td>
        <td align="center"><?php echo $row['type'];?></td>
      <td align="center"><?php echo $row['totalpics'];?></td>
      <td align="center"><?php echo dodate($core->short_date, $row['created']);?></td>
      <td align="center"><?php echo $row['published']?"<img src='".ADMINURL."/images/active.png'/>":"<img src='".ADMINURL."/images/inactive.png'/>";?></td>
      <td align="center"><a href="index.php?do=modules&amp;action=config&amp;mod=gallery&amp;mod_action=edit&amp;galid=<?php echo $row['id'];?>"><img src="images/edit.png" class="tooltip"  alt="" title="<?php echo MOD_GA_EDITMOD_GAL;?>"/></a></td>
      <td align="center"><a href="javascript:void(0);" class="delete" rel="<?php echo $row['title'.$core->dblang];?>" id="item_<?php echo $row['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo _DELETE;?>"/></a></td>
      <td align="center" style="background: #D2E4FC;border-top:1px solid #CCC">
          <a href="index.php?do=modules&amp;action=config&amp;mod=gallery&amp;mod_action=images&amp;galid=<?php echo $row['id'];?>"><img src="images/view_images.png" class="tooltip"  alt="" title="<?php echo MOD_GA_VIEW_IMGS;?>"/></a>
          <a href="index.php?do=modules&amp;action=config&amp;mod=gallery&amp;mod_action=images&amp;galid=<?php echo $row['id'];?>&amp;add=1"><img src="images/add_image.png" class="tooltip"  alt="" title="Add image"/></a>
          <a href="index.php?do=modules&amp;action=config&amp;mod=gallery&amp;mod_action=images&amp;galid=<?php echo $row['id'];?>&amp;add=1"><img src="images/addmultiple.png" class="tooltip"  alt="" title="Add multiple images"/></a>
      </td>
    </tr>
    <?php endforeach;?>
    <?php unset($row);?>

    <?php if($pager->items_total >= $pager->items_per_page):?>

      <tr style="background-color:transparent">
          <td colspan="10" style="padding:10px;"><div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
      </tr>



          <?php endif;?>

      <?php endif;?>

  </tbody>
</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '._GALLERY;?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>
<script type="text/javascript"> 
// <![CDATA[
function handleTypeSelect(elm)
{
    if(elm.value == 'all')
        window.location = "<?php echo ADMINURL; ?>?do=modules&action=config&mod=gallery";
    window.location = "<?php echo ADMINURL; ?>?do=modules&action=config&mod=gallery&type=" + elm.value;
}
function handleSearch()
{
    var keyword = document.getElementById("galSearch").value;
    window.location = "<?php echo ADMINURL; ?>?do=modules&action=config&mod=gallery&search=" + keyword;
}
function handleItemPerPage(elm)
{
    window.location = "<?php echo ADMINURL; ?>?do=modules&action=config&mod=gallery&ipp=" + elm.value;
}
function handlePagination(elm)
{
    <?php $getVars = '';
     if(isset($_GET['search']))
         $getVars .= "&search={$_GET['search']}";
     if(isset($_GET['type']))
         $getVars .= "&type={$_GET['type']}";
     if(isset($_GET['ipp']))
         $getVars .= "&ipp={$_GET['ipp']}";
     if(isset($_GET['sort']))
         $getVars .= "&sort={$_GET['sort']}";
    ?>
    window.location = "<?php echo ADMINURL; ?>?do=modules&action=config&mod=gallery&pageNumber=" + elm.value + "<?php echo $getVars; ?>";
}
$(document).ready(function () {

    $('table.display th a').css('color','#444');

    $("#galSearch").watermark("Gallery Search Title");
//    $("#galSearch").keyup(function () {
//        var srch_string = $(this).val();
//        var data_string = 'gallarysearch=' + srch_string;
//        if (srch_string.length > 0) {
//            $.ajax({
//                type: "POST",
//                url: "ajax.php",
//                data: data_string,
//                beforeSend: function () {
//                    $('#galSearch').addClass('loading');
//                },
//                success: function (res) {
//                    $('#suggestions').html(res).show();
//                    $("input").blur(function () {
//                        $('#suggestions').customFadeOut();
//                    });
//                    if ($('#galSearch').hasClass("loading")) {
//                        $("#galSearch").removeClass("loading");
//                    }
//                }
//            });
//        }
//        return false;
//    });




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
                    url: "modules/gallery/controller.php",
                    data: 'deleteGallery=' + id + '&galtitle=' + title,
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