<?php
  /**
   * Comments Template
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: template.tpl.php, v2.00 2011-04-20 16:17:34 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<div class="commentWrap" id="wrapper_<?php echo $row['id'];?>">
  <div class="img-holder"> <?php echo ($row['avatar']) ? '<img src="'.UPLOADURL . 'avatars/'.$row['avatar'].'" alt="'.$row['username'].'" class="avatar"/>' : '<img src="'.UPLOADURL.'avatars/blank.png" alt="'.$row['username'].'" class="avatar"/>';?>
  <a class="reply-link" href="#reply" onclick="updateOptions(<?php echo $row['id'];?>);" id="doreplay-<?php echo $row['id'];?>"><?php echo MOD_CM_REPLY2;?></a>
  </div>
  <div class="comment-body">
    <div class="com-box">
      <div class="desc">
        <h4>
		<?php if($com->show_username):?>
		  <?php if($com->show_www):?>
            <a href="<?php echo $row['www'];?>" target="_blank"><?php echo $row['username'];?></a>
          <?php else:?>
            <?php echo $row['username'];?>
          <?php endif;?>
        <?php endif;?> 
		<?php if ($com->show_email) echo $row['email'];?>
        </h4>
        <small>(<?php echo dodate($com->dateformat, $row['created']);?>)</small></div>
      <p><?php echo cleanOut($row['body']);?></p>
      </div>
  </div>
</div>

