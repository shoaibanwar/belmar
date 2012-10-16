<?php
  /**
   * Comments Form
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: form.tpl.php,<?php echo  2011-01-20 16:17:34 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<div id="reply">
  <h3><?php echo MOD_CM_REPLY;?></h3>
  <form action="" method="post" name="commentform" id="commentform">
    <p>
      <input name="username" type="text"  class="inputbox" id="username" value="<?php if ($user->logged_in) echo $user->username;?>" size="45" maxlength="20" />
      <label for="username"><?php echo MOD_CM_NAME;?>
        <?php if($com->username_req) echo required();?>
      </label>
    </p>
    <p>
      <input name="email" type="text" class="inputbox" id="email" value="<?php if ($user->logged_in) echo $user->email;?>" size="45" maxlength="30" />
      <label for="email"><?php echo MOD_CM_EMAIL;?>:
        <?php if($com->email_req) echo required();?>
        <small><?php echo MOD_CM_E_NOT_V;?></small> </label>
    </p>
    <p>
      <input name="www" type="text" class="inputbox" id="www" value="" size="45" maxlength="30" />
      <label for="www"><?php echo MOD_CM_WEB;?></label>
    </p>
    <?php if($com->show_captcha):?>
    <p>
      <input name="captcha" type="text" class="inputbox" id="captcha" value="" size="10" maxlength="5" />
      <img src="<?php echo SITEURL;?>/includes/captcha.php" alt="" class="captcha" />
      <label for="captcha"><?php echo MOD_CM_CAPTCHA_N;?> <?php echo required();?></label>
    </p>
    <?php endif;?>
    <p>
      <textarea name="body" id="body" rows="8" cols="60"></textarea>
      <label for="body"><?php echo MOD_CM_COMMENT;?>: <?php echo required();?></label>
    </p>
    <p id="counter"></p>
    <div> <span id="sub-button" style="float:left;margin-bottom:5px">
      <input name="submit" type="submit" class="button shadow"  value="<?php echo MOD_CM_ADDCOMMENT;?>" />
      </span> <span id="smloading" style="float:left;margin-left:10px;margin-top:-3px;display:none"> <img src="<?php echo SITEURL;?>/modules/comments/images/ajax-loader-sm.gif" alt=""/></span> <br clear="left" />
    </div>
    <input name="page_id" type="hidden" value="<?php echo $pageid;?>" />
  </form>
</div>