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
<?php
  if ($user->is_Admin())
      redirect_to("index.php");
	  
  if (isset($_POST['submit']))
      : $result = $user->login($_POST['username'], $_POST['password']);
  //Login successful 
  if ($result)
      : $hollysec->writeLog(_USER . ' ' . $user->username. ' ' . _LG_LOGIN, "user", "no", "user");
	  redirect_to("index.php");
  endif;
  endif;

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $core->site_name;?></title>
<link href="assets/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../assets/jquery.js"></script>
<script type="text/javascript" src="../assets/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="../assets/global.js"></script>
</head>
<body>
<div id="wrap">
  <div id="content-wrap">
    <h1><?php echo $core->company;?> - Admin Panel</h1>
    <div id="content">
      <form action="" method="post" name="login_form">
        <div class="block">
          <label for="user"><?php echo _USERNAME;?>:</label>
          <input name="username" type="text" class="inputbox" id="user"  size="25" />
        </div>
        <div class="block">
          <label for="password"><?php echo _PASSWORD;?>:</label>
          <input name="password" type="password" class="inputbox" id="password"  size="25" />
        </div>
        <div class="block" style="text-align:right;margin:0">
          <input name="submit" type="submit" class="button" value="Login" id="submit" />
        </div>
      </form>
      <div>&lsaquo; <a href="../index.php"><?php echo _LG_BACK;?></a></div>
    </div>
  </div>
  <div id="footer">Copyright &copy;<?php echo date('Y').' '.$core->site_name;?></div>
</div>
<div id="message-box"><?php print $core->showMsg;?></div>
</body>
</html>