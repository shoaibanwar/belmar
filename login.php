<?php
  /**
   * Login
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2011
   * @version $Id: login.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("init.php");
?>
<?php include(THEMEDIR."/header.php");?>
<?php
  if ($user->logged_in)
      redirect_to("account.php");
	  
  if (isset($_POST['doLogin']))
      : $result = $user->login($_POST['username'], $_POST['password']);
  /* Login Successful */
  if ($result)
      : redirect_to("account.php");
  endif;
  endif;
  
  require_once(THEMEDIR."/login.tpl.php");
?>
<?php include(THEMEDIR."/footer.php");?>