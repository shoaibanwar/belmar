<?php
  /**
   * Newsletter
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: newsletter.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

if(!$user->checkOperationPermission("send_lists_emails")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<?php $row = (isset($request->get['tempId'])) ? $core->getRowById("email_templates", $_GET['tempId']) : $core->getRowById("email_templates", 4);?>
<h1><img src="images/news-sml.png" alt="" /><?php echo _NL_TITLE1;?></h1>
<p class="info"><?php echo _NL_INFO1;?></p>
<h2><?php echo _NL_SUBTITLE1;?></h2>
    <?php $templates = $db->fetch_all("SELECT * FROM email_templates"); ?>
<form action="" method="post" id="admin_form" name="admin_form">
<table cellspacing="0" cellpadding="0" class="formtable">

    <tr>
        <td>Select Template</td>
        <td>
            <select id="tempSelect" class="custombox" style="width: 300px">
                <?php foreach($templates as $template): ?>
                <option <?php if(isset($_GET['tempId'])):if($template['id'] == $_GET['tempId']): echo "selected='selected'";endif;endif; ?> tid="<?php echo $template['id']; ?>"><?php echo $template['name_en']; ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
  <tr>
    <td width="200"><?php echo _NL_SUBJECT;?>: <?php echo required();?></td>
    <td><input id="tempSubject" name="subject<?php echo $core->dblang;?>" type="text"  class="inputbox" value="<?php echo $row['subject'.$core->dblang];?>" size="60"/></td>
  </tr>
  <tr>
      <td colspan="2" class="editor">
      <textarea id="bodycontent" name="body<?php echo $core->dblang;?>" rows="4" cols="30"><?php echo $row['body'.$core->dblang];?></textarea>
      <?php loadEditor("bodycontent","100%",600); ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong><?php echo _ET_VAR_T;?></strong></td>
  </tr>
  <tr>
    <td colspan="2"><input name="submit" type="submit" value="<?php echo _NL_SEND;?>"  class="button"/></td>
  </tr>
</table>
</form>
    <script type="text/javascript">
        $(document).ready(function(){
             $("#tempSelect").change(function(){
                 var tid = $(this).find('option:selected').attr('tid');
                 document.location = "<?php echo ADMINURL.'/index.php?do=newsletter&tempId=' ?>"+tid;
//                 $.post(
//                     "ajax.php",
//                     { getTemp:1,tid : tid },
//                     function(data){
//                        $("#tempSubject").val(data.subject_en) ;
//                        $("#bodycontent").innerHTML(data.body_en) ;
//                     },
//                     "json"
//                 )
             })
        })
    </script>
<?php echo $core->doForm("processNewsletter","controller.php");?>