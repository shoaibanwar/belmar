<?php
  /**
   * Core Class
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: core_class.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  class Membership
  {
	  private $mTable = "memberships";
	  private $pTable = "payments";
	  private $eTable = "email_templates";
	  private $gTable = "gateways";
	  

      /**
       * Membership::__construct()
       * 
       * @return
       */
      function __construct()
      {
		  

      }

      /**
       * Membership::getMemberships()
       * 
       * @return
       */
      public function getMemberships()
      {
          global $db;
          $sql = "SELECT * FROM ".$this->mTable." ORDER BY price";
          $row = $db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }

      /**
       * Membership::getMembershipListFrontEnd()
       * 
       * @return
       */
      public function getMembershipListFrontEnd()
      {
          global $db;
          $sql = "SELECT * FROM ".$this->mTable." WHERE private = 0 AND active = 1 ORDER BY price";
          $row = $db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }
	  
	  /**
	   * Membership::processMembership()
	   * 
	   * @return
	   */
	  public function processMembership()
	  {
		  global $db, $core, $content, $hollysec;
		  if (empty($_POST['title'.$core->dblang]))
			  $core->msgs['title'] = _MS_TITLE_R;
		  
		  if (empty($_POST['price']))
			  $core->msgs['price'] = _MS_PRICE_R;

		  if (empty($_POST['days']))
			  $core->msgs['days'] = _MS_PERIOD_R;

		  if (!is_numeric($_POST['days']))
			  $core->msgs['days'] = _MS_PERIOD_R2;
			  			  			  		  
		  if (empty($core->msgs)) {
			  $data = array(
					  'title'.$core->dblang => sanitize($_POST['title'.$core->dblang]), 
					  'price' => floatval($_POST['price']),
					  'days' => intval($_POST['days']),
					  'period' => sanitize($_POST['period']),
					  'trial' => intval($_POST['trial']),
					  'recurring' => intval($_POST['recurring']),
					  'private' => intval($_POST['private']),
					  'description'.$core->dblang => sanitize($_POST['description'.$core->dblang]),
					  'active' => intval($_POST['active'])
			  );

			  if ($data['trial'] == 1) {
				  $trial['trial'] = "DEFAULT(trial)";
				  $db->update($this->mTable, $trial);
			  }
			  
			  ($content->id) ? $db->update($this->mTable, $data, "id='" . (int)$content->id . "'") : $db->insert($this->mTable, $data);
			  $message = ($content->id) ? _MS_UPDATED : _MS_ADDED;
			  
			  ($db->affected()) ? $hollysec->writeLog($message, "", "no", "content") . $core->msgOk($message) :  $core->msgAlert(_SYSTEM_PROCCESS);
		  } else
			  print $core->msgStatus();
	  }
	  
      /**
       * Membership::getAccessList()
       * 
       * @param bool $sel
       * @return
       */
      public function getAccessList($sel = false)
	  {
		  $arr = array(
				 'Public' => _PUBLIC,
				 'Registered' => _REGISTERED,
				 'Membership' => _MEMBERSHIP
		  );
		  
		  $data = '';
		  $data .= '<select name="access" style="width:200px" class="custombox" id="access_id">';
		  foreach ($arr as $key => $val) {
              if ($key == $sel) {
                  $data .= "<option selected=\"selected\" value=\"" . $key . "\">" . $val . "</option>\n";
              } else
                  $data .= "<option value=\"" . $key . "\">" . $val . "</option>\n";
          }
          unset($val);
		  $data .= "</select>";
          return $data;
      }
	  
      /**
       * Membership::getMembershipList()
       * 
       * @param bool $memid
       * @return
       */
      public function getMembershipList($memid = false)
	  {
		  global $db, $core;
		  
		  $sqldata = $db->fetch_all("SELECT id, title{$core->dblang} FROM memberships ORDER BY title{$core->dblang}");
		  
		  if($memid) {
			$arr = explode(",",$memid);
			reset($arr);
		  }
		  $data = '';
		  if($sqldata) {
			  $data .= '<select name="membership_id[]" size="6" multiple="multiple" class="select" style="width:200px">';
			  foreach ($sqldata as $val) {
				  if($memid) {
				  $selected =  (in_array($val['id'], $arr))  ? " selected=\"selected\"" : "";
				  } else {
					$selected = null;
				  }
					  $data .= "<option $selected value=\"" . $val['id'] . "\">" . $val['title'.$core->dblang] . "</option>\n";
	
			  }
			  unset($val);
			  $data .= "</select>";
			  $data .= "&nbsp;&nbsp;";
			  $data .= tooltip(_PG_MEM_LEVEL_T);
		  
          return $data;
		  } 
      }

      /**
       * Membership::getMembershipPeriod()
       * 
       * @param bool $sel
       * @return
       */
      public function getMembershipPeriod($sel = false)
	  {
		  $arr = array(
				 'D' => _DAYS,
				 'W' => _WEEKS,
				 'M' => _MONTHS,
				 'Y' => _YEARS
		  );
		  
		  $data = '';
		  $data .= '<select name="period" style="width:80px" class="custombox">';
		  foreach ($arr as $key => $val) {
              if ($key == $sel) {
                  $data .= "<option selected=\"selected\" value=\"" . $key . "\">" . $val . "</option>\n";
              } else
                  $data .= "<option value=\"" . $key . "\">" . $val . "</option>\n";
          }
          unset($val);
		  $data .= "</select>";
          return $data;
      }

      /**
       * Membership::getPeriod()
       * 
       * @param bool $value
       * @return
       */
      public function getPeriod($value)
	  {
		  switch($value) {
			  case "D" :
			  return _DAYS;
			  break;
			  case "W" :
			  return _WEEKS;
			  break;
			  case "M" :
			  return _MONTHS;
			  break;
			  case "Y" :
			  return _YEARS;
			  break;
		  }

      }

	  /**
	   * Membership::calculateDays()
	   * 
	   * @return
	   */
	  public function calculateDays($period, $days)
	  {
		  global $db;
		  
		  $now = date('Y-m-d H:i:s');
			  switch($period) {
				  case "D" :
				  $diff = $days;
				  break;
				  case "W" :
				  $diff = $days * 7;
				  break; 
				  case "M" :
				  $diff = $days * 30;
				  break;
				  case "Y" :
				  $diff = $days * 365;
				  break;
			  }
			return date("d M Y", strtotime($now . + $diff . " days"));
	  }

	  /**
	   * Membership::getTotalDays()
	   * Used for MoneyBookers
	   * @return
	   */
	  public function getTotalDays($period, $days)
	  {
		  switch($period) {
			  case "D" :
			  $diff = $days;
			  break;
			  case "W" :
			  $diff = $days * 7;
			  break; 
			  case "M" :
			  $diff = $days * 30;
			  break;
			  case "Y" :
			  $diff = $days * 365;
			  break;
		  }
		return $diff;
	  }	  	  	  	  	  
      /**
       * Membership::getPayments()
       * 
       * @param bool $where
       * @param bool $from
       * @return
       */
      public function getPayments($where = false, $from = false)
      {
		  global $db, $core, $pager;
		  
		  require_once(HCODE . "lib/class_paginate.php");

          $pager = new Paginator();
          $counter = countEntries($this->pTable);
          $pager->items_total = $counter;
          $pager->default_ipp = $core->perpage;
          $pager->paginate();
          
          if ($counter == 0) {
              $pager->limit = null;
          }

		  if (isset($_GET['sort'])) {
			  list($sort, $order) = explode("-", $_GET['sort']);
			  $sort = sanitize($sort);
			  $order = sanitize($order);
			  if (in_array($sort, array("user_id", "rate_amount", "pp", "date"))) {
				  $ord = ($order == 'DESC') ? " DESC" : " ASC";
				  $sorting = " p." . $sort . $ord;
			  } else {
				  $sorting = " p.date DESC";
			  }
		  } else {
			  $sorting = " p.date DESC";
		  }
		  
          $clause = ($where) ? " WHERE p.rate_amount LIKE '%" . intval($where) . "%'" : "";
		  
          if (isset($_POST['fromdate']) && $_POST['fromdate'] <> "" || isset($from) && $from != '') {
              $enddate = date("Y-m-d");
              $fromdate = (empty($from)) ? $_POST['fromdate'] : $from;
              if (isset($_POST['enddate']) && $_POST['enddate'] <> "") {
                  $enddate = $_POST['enddate'];
              }
              $clause .= " WHERE p.date BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'";
          } 
		  
          $sql = "SELECT p.*, p.id as id, u.username, m.title{$core->dblang} as title,"
		  . "\n DATE_FORMAT(p.date, '%d %b %Y') as created"
		  . "\n FROM ".$this->pTable." as p"
		  . "\n LEFT JOIN users as u ON u.id = p.user_id" 
		  . "\n LEFT JOIN ".$this->mTable." as m ON m.id = p.membership_id" 
		  . "\n " . $clause . " ORDER BY " . $sorting . $pager->limit;
		   
          $row = $db->fetch_all($sql);
          
		  return ($row) ? $row : 0;
      }
	  
      /**
       * Membership::getPaymentFilter()
       * 
       * @return
       */
      public function getPaymentFilter()
	  {
		  $arr = array(
				 'user_id-ASC' => _TR_USERNAME.'&uarr;',
				 'user_id-DESC' => _TR_USERNAME.'&darr;',
				 'rate_amount-ASC' => _TR_AMOUNT.' &uarr;',
				 'rate_amount-DESC' => _TR_AMOUNT.' &darr;',
				 'pp-ASC' => _TR_PROCESSOR . ' &uarr;',
				 'pp-DESC' => _TR_PROCESSOR . ' &darr;',
				 'date-ASC' => _TR_PAYDATE . ' &uarr;',
				 'date-DESC' => _TR_PAYDATE . ' &darr;',
		  );
		  
		  $filter = '';
		  foreach ($arr as $key => $val) {
				  if ($key == get('sort')) {
					  $filter .= "<option selected=\"selected\" value=\"$key\">$val</option>\n";
				  } else
					  $filter .= "<option value=\"$key\">$val</option>\n";
		  }
		  unset($val);
		  return $filter;
	  }
	  
      /**
       * Membership::monthlyStats()
       * 
       * @return
       */
      public function monthlyStats()
      {
          global $db, $core;
		  
          $sql = "SELECT id, COUNT(id) as total, SUM(rate_amount) as totalprice" 
		  . "\n FROM ".$this->pTable 
		  . "\n WHERE status = '1'" 
		  . "\n AND date > '" . $core->year . "-" . $core->month . "-01'" 
		  . "\n AND date < '" . $core->year . "-" . $core->month . "-31 23:59:59'";
          
          $row = $db->first($sql);
          
		  return ($row['total'] > 0) ? $row : false;
      }

      /**
       * Membership::yearlyStats()
       * 
       * @return
       */
      public function yearlyStats()
      {
          global $db, $core;
		  
          $sql = "SELECT *, YEAR(date) as year, MONTH(date) as month," 
		  . "\n COUNT(id) as total, SUM(rate_amount) as totalprice" 
		  . "\n FROM ".$this->pTable 
		  . "\n WHERE status = '1'" 
		  . "\n AND YEAR(date) = '" . $core->year . "'" 
		  . "\n GROUP BY year DESC ,month DESC ORDER by date";
          
          $row = $db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }

      /**
       * Membership::getYearlySummary()
       * 
       * @return
       */
      public function getYearlySummary()
      {
          global $db, $core;
          
          $sql = "SELECT YEAR(date) as year, MONTH(date) as month," 
		  . "\n COUNT(id) as total, SUM(rate_amount) as totalprice" 
		  . "\n FROM ".$this->pTable
		  . "\n WHERE status = '1'" 
		  . "\n AND YEAR(date) = '" . $core->year . "'";
          
          $row = $db->first($sql);
          
          return ($row) ? $row : 0;
      }
	   
      /**
       * Membership::totalIncome()
       * 
       * @return
       */
      public function totalIncome()
      {
          global $db, $core;
          $sql = "SELECT SUM(rate_amount) as totalsale"
		  . "\n FROM ".$this->pTable
		  . "\n WHERE status = '1'";
          $row = $db->first($sql);
          
          $total_income = $core->formatMoney($row['totalsale']);
          
          return $total_income;
      }
  
	  /**
	   * Membership::membershipCron()
	   * 
	   * @param mixed $days
	   * @return
	   */
	  function membershipCron($days)
	  {
		  global $db, $core;
		  
		  $sql = "SELECT u.id, CONCAT(u.fname,' ',u.lname) as name, u.email, u.membership_id, u.trial_used, m.title{$core->dblang}, m.days," 
		  . "\n DATE_FORMAT(u.mem_expire, '%d %b %Y') as edate" 
		  . "\n FROM users as u" 
		  . "\n LEFT JOIN ".$this->mTable." AS m ON m.id = u.membership_id" 
		  . "\n WHERE u.active = 'y' AND u.membership_id !=0" 
		  . "\n AND TO_DAYS(NOW()) - TO_DAYS(u.mem_expire) = '".(int)$days."'";

		  $listrow = $db->fetch_all($sql);
		  require_once(HCODE . "lib/class_mailer.php");
	  
		  if ($listrow) {
			  switch ($days) {
				  case 7:
					  $mailer = $mail->sendMail();
					  $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100));
					  
					  $trow = $core->getRowById("email_templates", 8);
					  $body = cleanOut($trow['body'.$core->dblang]);
					  
					  $replacements = array();
					  foreach ($listrow as $cols) {
						  $replacements[$cols['email']] = array('[NAME]' => $cols['name'],'[SITE_NAME]' => $core->site_name,'[URL]' => $core->site_url);
					  }
					  
					  $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
					  $mailer->registerPlugin($decorator);
					  
					  $message = Swift_Message::newInstance()
								->setSubject($trow['subject'.$core->dblang])
								->setFrom(array($core->site_email => $core->site_name))
								->setBody($body, 'text/html');
					  
					  foreach ($listrow as $row)
						  $message->addTo($row['email'], $row['name']);
					  unset($row);
					  
					  $numSent = $mailer->batchSend($message);				  
					  break;
					  
				  case 0:
					  $mailer = $mail->sendMail();
					  $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100));
					  
					  $trow = $core->getRowById("email_templates", 9);
					  $body = cleanOut($trow['body'.$core->dblang]);
					  
					  $replacements = array();
					  foreach ($listrow as $cols) {
						  $replacements[$cols['email']] = array('[NAME]' => $cols['name'],'[SITE_NAME]' => $core->site_name,'[URL]' => $core->site_url);
					  }
					  
					  $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
					  $mailer->registerPlugin($decorator);
					  
					  $message = Swift_Message::newInstance()
								->setSubject($trow['subject'.$core->dblang])
								->setFrom(array($core->site_email => $core->site_name))
								->setBody($body, 'text/html');
					  
					  foreach ($listrow as $row) {
						  $message->addTo($row['email'], $row['name']);
                          $data = array(
								'membership_id' => 0, 
								'mem_expire' => "0000-00-00 00:00:00"
						  );
						  $db->update("users", $data, "id = '".(int)$row['id']."'");	
					  }
					  unset($row);
					  $numSent = $mailer->batchSend($message);	

					  break;
			  }
		  }
	  }

	  /**
	   * Membership::emailUsers()
	   * 
	   * @return
	   */
	  public function emailUsers()
	  {
		  global $db, $core, $hollysec;
		  if (empty($_POST['subject'.$core->dblang]))
			  $core->msgs['subject'] = _NL_SUBJECT_R;
		  
		  if (empty($_POST['body'.$core->dblang]))
			  $core->msgs['body'] = _NL_BODY_R;
		  
		  if (empty($core->msgs)) {

				  $subject = sanitize($_POST['subject'.$core->dblang]);
				  $body = cleanOut($_POST["body".$core->dblang]);
				  $numSent = false;
			  

					  require_once(HCODE . "lib/class_mailer.php");
					  $mailer = $mail->sendMail();
					  $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100));
					  
					  $sql = "SELECT email, CONCAT(fname,' ',lname) as name FROM mailing_list WHERE active=1";
					  $userrow = $db->fetch_all($sql);
					  
					  $replacements = array();
					  if($userrow) {
						  foreach ($userrow as $cols) {
                              $unsubscribeUrl = SITEURL."unsubscribe.php?sid=".$cols['id']."&st=".substr(md5($cols['email']),0,8)."&list=news";
							  $replacements[$cols['email']] = array('[UNSUBSCRIBE]' => $unsubscribeUrl,'[NAME]' => $cols['name'],'[SITE_NAME]' => $core->site_name,'[URL]' => $core->site_url);
						  }

                          $fromSql = "SELECT * FROM mailing_list_settings";
                          $from = $db->first($fromSql);

						  $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
						  $mailer->registerPlugin($decorator);
						  
						  $message = Swift_Message::newInstance()
									->setSubject($subject)
									->setFrom(array($from['from_email'] => $from['from_name']))
									->setBody($body, 'text/html');
						  
						  foreach ($userrow as $row)
							  $message->addTo($row['email'], $row['name']);
						  unset($row);

						  
						  $numSent = $mailer->batchSend($message, $failures);
					  }

			  if($numSent) {
				  $hollysec->writeLog(_NL_SENT_OK, "", "no", "content") . $core->msgOk(_NL_SENT_OK);
			  } else {
				  $hollysec->writeLog(_NL_SENT_ERR, "", "yes", "content") . $core->msgAlert(_NL_SENT_ERR);
				  foreach ($failures as $failed) {
					  print $failed."\n";
				  }
				  unset($failed);
			  }
			  //($numSent) ? $hollysec->writeLog(_NL_SENT_OK, "", "no", "content") . $core->msgOk(_NL_SENT_OK) :  $hollysec->writeLog(_NL_SENT_ERR, "", "yes", "content") . $core->msgAlert(_NL_SENT_ERR);

		  } else
			  print $core->msgStatus();
	  }

      /**
       * Membership::getEmailTemplates()
       * 
       * @return
       */
      public function getEmailTemplates($fixed = 0)
      {
          global $db, $core;
          $sql = "SELECT * FROM " . $this->eTable . " WHERE fixed = $fixed ORDER BY name{$core->dblang} ASC";
          $row = $db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }

	  /**
	   * Membership::processEmailTemplate()
	   * 
	   * @return
	   */
	  public function processEmailTemplate()
	  {
		  global $db, $core, $content, $hollysec;

          if(!isset($_POST['fixed']))
          {
              if (empty($_POST['name'.$core->dblang]))
                  $core->msgs['name'] = _ET_TTITLE_R;
          }

		  //if (empty($_POST['subject'.$core->dblang]))
			  //$core->msgs['subject'] = _ET_SUBJECT_R;

		  if (empty($_POST['body'.$core->dblang]))
			  $core->msgs['body'] = _ET_BODY_R;
			  		  
		  if (empty($core->msgs)) {

              if(isset($_POST['fixed']))
              {
                  $data = array(
                      //'subject'.$core->dblang => sanitize($_POST['subject'.$core->dblang]),
                      'body'.$core->dblang => $_POST['body'.$core->dblang],
                      'active' => $_POST['active']
                  );
              }
              else
              {
                  $data = array(
                      'name'.$core->dblang => sanitize($_POST['name'.$core->dblang]),
                      //'subject'.$core->dblang => sanitize($_POST['subject'.$core->dblang]),
                      'body'.$core->dblang => $_POST['body'.$core->dblang],
                      'help'.$core->dblang => $_POST['help'.$core->dblang],
                      'active' => $_POST['active']
                  );
              }
              (isset($_REQUEST['id'])) ? $db->update($this->eTable, $data, "id='" . (int)$content->id . "'") : $db->insert("email_templates", $data);
              $message = isset($_REQUEST['id']) ? _ET_UPDATED : _ET_ADDED;
			  ($db->affected()) ? $hollysec->writeLog($message, "", "no", "content") . $core->msgOk($message) :  $core->msgAlert(_SYSTEM_PROCCESS);
		  } else
			  print $core->msgStatus();
	  }

      /**
       * Membership::getGateways()
       * 
       * @return
       */
      public function getGateways($active = false)
      {
          global $db;
		  
		  $where = ($active) ? "WHERE active = '1'" : null ;
          $sql = "SELECT * FROM " . $this->gTable 
		  . "\n " . $where
		  . "\n ORDER BY name";
          $row = $db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }

	  
	  /**
	   * Membership::processGateway()
	   * 
	   * @return
	   */
	  public function processGateway()
	  {
		  global $db, $core, $content, $hollysec;
		  
		  if (empty($_POST['displayname']))
			  $core->msgs['displayname'] = _GW_NAME_R;
			  		  
		  if (empty($core->msgs)) {
			  $data = array(
					  'displayname' => sanitize($_POST['displayname']), 
					  'extra' => sanitize($_POST['extra']),
					  'extra2' => sanitize($_POST['extra2']),
					  'extra3' => sanitize($_POST['extra3']),
					  'demo' => intval($_POST['demo']),
					  'active' => intval($_POST['active'])
			  );

			  $db->update($this->gTable, $data, "id='" . (int)$content->id . "'");
			  ($db->affected()) ? $hollysec->writeLog(_GW_UPDATED, "", "no", "content") . $core->msgOk(_GW_UPDATED) :  $core->msgAlert(_SYSTEM_PROCCESS);
		  } else
			  print $core->msgStatus();
	  }
	  
      /**
       * Membership::verifyTxnId()
       * 
       * @param mixed $txn_id
       * @return
       */
      public function verifyTxnId($txn_id)
      {
          global $db;
          
          $sql = $db->query("SELECT id" 
				. "\n FROM ".$this->pTable."" 
				. "\n WHERE txn_id = '" . sanitize($txn_id) . "'" 
				. "\n LIMIT 1");
		  		
          if ($db->numrows($sql) > 0)
              return false;
          else
              return true;
      }
  }
?>