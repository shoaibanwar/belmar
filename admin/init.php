<?php
  /**
   * Init
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: init.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
error_reporting(E_ALL);
ini_set('log_errors', 'On');
ini_set('short_open_tag','On');
ini_set('error_log',dirname(__FILE__).DIRECTORY_SEPARATOR.'error_logs.txt');

  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');


  // Magic Quotes Fix
  if (ini_get('magic_quotes_gpc')) {
      function clean($data)
      {
          if (is_array($data)) {
              foreach ($data as $key => $value) {
                  $data[clean($key)] = clean($value);
              }
          } else {
              $data = stripslashes($data);
          }
          
          return $data;
      }
      
      $_GET = clean($_GET);
      $_POST = clean($_POST);
      $_COOKIE = clean($_COOKIE);
  }
  
  if (substr(PHP_OS, 0, 3) == "WIN") {
      $HCODE = str_replace("admin\\init.php", "", realpath(__FILE__));
  } else {
      $HCODE = str_replace("admin/init.php", "", realpath(__FILE__));
  }
  
  define("HCODE", $HCODE);
  
  $configFile = HCODE . "lib/config.ini.php";
  if (file_exists($configFile)) {
      require_once($configFile);
  } else {
      header("Location: ../setup/");
  }
  
  require_once(HCODE . "lib/class_db.php");
  $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
  $db->connect();
  
  include(HCODE . "lib/headerRefresh.php");
  require_once(HCODE . "lib/class_filter.php");
  $request = new Filter();

  //Include Functions
  require_once(HCODE . "lib/functions.php");
  require_once(HCODE . "lib/fn_seo.php");
  
  //StartUser Class 
  require_once(HCODE . "lib/class_user.php");
  $user = new Users();

  //Start Core Class 
  require_once(HCODE . "lib/class_core.php");
  $core = new Core();
  
  //Load Content Class
  require_once(HCODE . "lib/class_content.php");
  $content = new Content();

  //Load Membership Class
  require_once(HCODE . "lib/class_membership.php");
  $member = new Membership();

  //Load Security Class
  require_once(HCODE . "lib/class_security.php");
  $hollysec = new Security($core->attempt, $core->flood);
   
  define("SITEURL", $core->site_url);
  define("ADMINURL", $core->site_url."/admin");
  define("UPLOADS", HCODE."uploads/");
  define("UPLOADURL", SITEURL."/uploads");
  define("MODPATH", HCODE."admin/modules/");
  define("THEMEURL", SITEURL."/theme/".$core->theme);
?>