<?php
  /**
   * Maintenance
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: index.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
	  if($core->offline == 0)
	  redirect_to(SITEURL);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="assets/jquery.js"></script>
<script type="text/javascript" src="assets/ud//script.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $core->site_name;?></title>
<link href="http://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet" type="text/css" />
<link href="assets/ud/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrap">
  <div id="container">
  <div class="logo"><?php echo ($core->logo) ? '<img src="'.SITEURL.'/uploads/'.$core->logo.'" alt="'.$core->company.'" />': $core->company;?></div>
    <h1><?php echo _M_H1;?></h1>
    <h2 class="subtitle"><?php echo _M_H2;?></h2>
    
    <div id="dashboard">
      <div class="dash weeks_dash"> <span class="dash_title"><?php echo _M_WEEKS;?></span>
        <div class="digit">
          <div style="display:none" class="top">1</div>
          <div style="display:block" class="bottom">0</div>
        </div>
        <div class="digit">
          <div style="display:none" class="top">3</div>
          <div style="display:block" class="bottom">0</div>
        </div>
      </div>
      <div class="dash days_dash"> <span class="dash_title"><?php echo _M_DAYS;?></span>
        <div class="digit">
          <div style="display:none" class="top">0</div>
          <div style="display:block" class="bottom">0</div>
        </div>
        <div class="digit">
          <div style="display:none" class="top">0</div>
          <div style="display:block" class="bottom">0</div>
        </div>
      </div>
      <div class="dash hours_dash"> <span class="dash_title"><?php echo _M_HOURS;?></span>
        <div class="digit">
          <div style="display:none" class="top">2</div>
          <div style="display:block" class="bottom">0</div>
        </div>
        <div class="digit">
          <div style="display:none" class="top">3</div>
          <div style="display:block" class="bottom">0</div>
        </div>
      </div>
      <div class="dash minutes_dash"> <span class="dash_title"><?php echo _M_MINUTES;?></span>
        <div class="digit">
          <div style="display:none" class="top">2</div>
          <div style="display:block" class="bottom">0</div>
        </div>
        <div class="digit">
          <div style="display:none" class="top">9</div>
          <div style="display:block" class="bottom">0</div>
        </div>
      </div>
      <div class="dash seconds_dash"> <span class="dash_title"><?php echo _M_SECONDS;?></span>
        <div class="digit">
          <div style="display:none" class="top">0</div>
          <div style="display:block" class="bottom">0</div>
        </div>
        <div class="digit">
          <div style="display:none" class="top">7</div>
          <div style="display:block" class="bottom">0</div>
        </div>
      </div>
    </div>

    <div class="info-box">
      <div class="inner"><?php echo $core->offline_msg;?></div>
    </div>
    
  </div>
</div>
<?php 
  $v = str_replace(" ",":",$core->offline_data); 
  $d = explode(":",$v);
?>
<script language="javascript" type="text/javascript">
$(document).ready(function () {
	$('#dashboard').countDown({
		targetDate: {
			'day': <?php echo $d[2];?>,
			'month': <?php echo $d[1];?>,
			'year': <?php echo $d[0];?>,
			'hour': <?php echo $d[3];?>,
			'min': <?php echo $d[4];?>,
			'sec': 0
		}
	});
});
</script>
</body>
</html>