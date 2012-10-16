<?php
  /**
   * Layout
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: layout.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  if(!$user->getAcl("Layout")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<?php include_once("help/layout.php");?>
<?php 
  if(isset($_GET['modid'])) {
	  $modid = intval($_GET['modid']);
	  $modslug = getValue("modalias", "modules","id = '".intval($modid)."'");
  } else {
	  $modid = 0;
  }
  if(isset($_GET['pageid'])) {
	  $pageid = intval($_GET['pageid']);
	  $pageslug = getValue("slug", "pages","id = '".intval($pageid)."'");
  } else {
	  $pageid = $content->homeid;
	  $pageslug = getValue("slug", "pages","id = '".intval($pageid)."'");
  }

  $pluginrow = $content->getAvailablePlugins();
  $layrow = $content->getLayoutOptions();
?>
<h1><img src="images/layout-sml.png" alt="" /><?php echo _LY_TITLE;?></h1>
<p class="info"><?php echo _LY_INFO;?></p>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td><h2><?php echo _LY_VIEW_FOR;?></h2></td>
    <td align="right"><a href="javascript:void(0);" onclick="$('#dialog').dialog('open'); return false"><img src="images/help.png" alt="" /></a>
      <select name="page_id" id="page_id" class="custombox" style="width:200px" onchange="if(this.value!='0') window.location = 'index.php?do=layout&amp;pageid='+this[this.selectedIndex].value; else window.location = 'index.php?do=layout';">
        <?php $pagerow = $content->getPages();?>
        <option value="0"><?php echo _LY_SEL_PAGE;?></option>
        <?php foreach ($pagerow as $prow):?>
        <?php $sel = ($content->pageid == $prow['id']) ? ' selected="selected"' : '' ;?>
        <option value="<?php echo $prow['id'];?>"<?php echo $sel;?>><?php echo $prow['title'.$core->dblang];?></option>
        <?php endforeach;?>
      </select>
      <?php $modlist = $content->displayMenuModule();?>
      <?php if($modlist) :?>
      <select name="modid" id="mod_id" class="custombox" style="width:200px" onchange="if(this.value!='0') window.location = 'index.php?do=layout&amp;modid='+this[this.selectedIndex].value; else window.location = 'index.php?do=layout';">
        <option value="0"><?php echo _LY_SEL_MODULE;?></option>
        <?php foreach ($modlist as $mrow):?>
        <?php $sel = ($modid == $mrow['id']) ? ' selected="selected"' : '' ;?>
        <option value="<?php echo $mrow['id'];?>"<?php echo $sel;?>><?php echo $mrow['title'.$core->dblang];?></option>
        <?php endforeach;?>
      </select>
      <?php endif;?></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250" valign="top" style="padding-top:6px"><?php if ($pluginrow == 0): ?>
      <div class="msgInfo"><?php echo _LY_NOMODS;?></div>
      <?php else:?>
      <ul id="default-<?php echo ($modid) ? $modid : $pageid;?>" class="modList">
        <?php foreach ($pluginrow as $mrow): ?>
        <li id="list-<?php echo $mrow['id'];?>"><?php echo $mrow['title'.$core->dblang];?></li>
        <?php endforeach; ?>
        <?php unset($mrow);?>
      </ul>
      <?php endif;?></td>
    <td valign="top"><table border="0" cellpadding="0" cellspacing="3" id="layout">
        <tr>
          <td colspan="3" valign="top" class="top-position"><ul id="top-<?php echo ($modid) ? $modid : $pageid;?>" class="modList">
              <li style="display:none"></li>
              <?php if ($layrow != 0): ?>
              <?php foreach ($layrow as $trow): ?>
              <?php if ($trow['place'] == "top"): ?>
              <li id="list-<?php echo $trow['plid'];?>"><?php echo $trow['title'.$core->dblang];?></li>
              <?php endif; ?>
              <?php endforeach; ?>
              <?php unset($trow);?>
              <?php endif; ?>
            </ul></td>
        </tr>
        <tr>
          <td width="240" valign="top" class="left-position"><ul id="left-<?php echo ($modid) ? $modid : $pageid;?>" class="modList">
              <li style="display:none"></li>
              <?php if ($layrow != 0): ?>
              <?php foreach ($layrow as $lrow): ?>
              <?php if ($lrow['place'] == "left"): ?>
              <li id="list-<?php echo $lrow['plid'];?>"><?php echo $lrow['title'.$core->dblang];?></li>
              <?php endif; ?>
              <?php endforeach; ?>
              <?php unset($lrow);?>
              <?php endif;?>
            </ul></td>
          <td valign="top" nowrap="nowrap" class="main-position">&nbsp;</td>
          <td width="240" valign="top" class="right-position"><ul id="right-<?php echo ($modid) ? $modid : $pageid;?>" class="modList">
              <li style="display:none"></li>
              <?php if ($layrow != 0): ?>
              <?php foreach ($layrow as $rrow): ?>
              <?php if ($rrow['place'] == "right"): ?>
              <li id="list-<?php echo $rrow['plid'];?>"><?php echo $rrow['title'.$core->dblang];?></li>
              <?php endif; ?>
              <?php endforeach; ?>
              <?php unset($rrow);?>
              <?php endif; ?>
            </ul></td>
        </tr>
        <tr>
          <td colspan="3" valign="top" class="bottom-position"><ul id="bottom-<?php echo ($modid) ? $modid : $pageid;?>" class="modList">
              <li style="display:none"></li>
              <?php if ($layrow != 0): ?>
              <?php foreach ($layrow as $brow): ?>
              <?php if ($brow['place'] == "bottom"): ?>
              <li id="list-<?php echo $brow['plid'];?>"><?php echo $brow['title'.$core->dblang];?></li>
              <?php endif; ?>
              <?php endforeach; ?>
              <?php unset($brow);?>
              <?php endif; ?>
            </ul></td>
        </tr>
      </table></td>
  </tr>
</table>
<script type="text/javascript">
// <![CDATA[
<?php if(isset($_GET['pageid'])) :?>
 var field = $('#mod_id');
 field.val($('option:first', field).val());
<?php endif;?>
$(function() {
	$("#default-<?php echo ($modid) ? $modid : $pageid;?>,#bottom-<?php echo ($modid) ? $modid : $pageid;?>,#left-<?php echo ($modid) ? $modid : $pageid;?>,#right-<?php echo ($modid) ? $modid : $pageid;?>,#top-<?php echo ($modid) ? $modid : $pageid;?>").sortable({
		connectWith: '.modList',
		placeholder: 'modPlace',
		update: savePosition
	});
	
});
<?php $slug = ($modid) ? 'modslug='.$modslug : 'pageslug='.$pageslug;?>
function savePosition() {
	var place = "";
	var count = 0;
	$("[id^=list-]").each(function() {
		count++;
		place += (this.parentNode.id + "[]" + "=" + count + "|" + this.id + "&");
	});
	$.ajax({
		type: "post",
		url: "ajax.php?<?php echo $slug;?>&layout=" + this.id,
		data: place
	});
}
// ]]>
</script>