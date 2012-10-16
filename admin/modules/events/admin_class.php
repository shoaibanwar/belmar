<?php


/**
 * EventManager Class
 *
 * @package HollyCode CMS
 * @author HollyCode.com
 * @copyright 2010
 * @version $Id: class_admin.php, v2.00 2011-04-20 10:12:05 gewa Exp $
 */
if (!defined("_VALID_PHP"))
    die('Direct access to this location is not allowed.');

class eventManager
{

    private $mTable = "mod_events";
    public $eventid = null;
    public $weekDayNameLength;
    public $monthNameLength;
    private $arrWeekDays = array();
    private $arrMonths = array();
    private $pars = array();
    private $today = array();
    private $prevYear = array();
    private $nextYear = array();
    private $prevMonth = array();
    private $nextMonth = array();
    public $eventMonth;

    /**
     * eventManager::__construct()
     * 
     * @return
     */
    function __construct()
    {
        $this->getEventId();
        $this->weekStartedDay = $this->setWeekStart();
        $this->weekDayNameLength = "long";
        $this->monthNameLength = "long";
        $this->init();
        $this->eventMonth = $this->getCalDataMonth();
    }

    /**
     * eventManager::init()
     * 
     * @return
     */
    private function init()
    {
        $year = (isset($_POST['year']) && $this->checkYear($_POST['year'])) ? intval($_POST['year']) : date("Y");
        $month = (isset($_POST['month']) && $this->checkMonth($_POST['month'])) ? intval($_POST['month']) : date("m");
        $day = (isset($_POST['day']) && $this->checkDay($_POST['day'])) ? intval($_POST['day']) : date("d");
        $ldim = $this->calcDays($month, $day);

        if ($day > $ldim)
        {
            $day = $ldim;
        }

        $cdate = getdate(mktime(0, 0, 0, $month, $day, $year));

        $this->pars["year"] = $cdate['year'];
        $this->pars["month"] = $this->toDecimal($cdate['mon']);
        $this->pars["nmonth"] = $cdate['mon'];
        $this->pars["month_full_name"] = $cdate['month'];
        $this->pars["day"] = $day;
        $this->today = getdate();

        $this->prevYear = getdate(mktime(0, 0, 0, $this->pars['month'], $this->pars["day"], $this->pars['year'] - 1));
        $this->nextYear = getdate(mktime(0, 0, 0, $this->pars['month'], $this->pars["day"], $this->pars['year'] + 1));
        $this->prevMonth = getdate(mktime(0, 0, 0, $this->pars['month'] - 1, $this->calcDays($this->pars['month'] - 1, $this->pars["day"]), $this->pars['year']));
        $this->nextMonth = getdate(mktime(0, 0, 0, $this->pars['month'] + 1, $this->calcDays($this->pars['month'] + 1, $this->pars["day"]), $this->pars['year']));

        $this->arrWeekDays[0] = array("mini" => _SU, "short" => _SUN, "long" => _SUNDAY);
        $this->arrWeekDays[1] = array("mini" => _MO, "short" => _MON, "long" => _MONDAY);
        $this->arrWeekDays[2] = array("mini" => _TU, "short" => _TUE, "long" => _TUESDAY);
        $this->arrWeekDays[3] = array("mini" => _WE, "short" => _WED, "long" => _WEDNESDAY);
        $this->arrWeekDays[4] = array("mini" => _TH, "short" => _THU, "long" => _THURSDAY);
        $this->arrWeekDays[5] = array("mini" => _FR, "short" => _FRI, "long" => _FRIDAY);
        $this->arrWeekDays[6] = array("mini" => _SA, "short" => _SAT, "long" => _SATURDAY);

        $this->arrMonths[1] = array("short" => _JA_, "long" => _JAN);
        $this->arrMonths[2] = array("short" => _FE_, "long" => _FEB);
        $this->arrMonths[3] = array("short" => _MA_, "long" => _MAR);
        $this->arrMonths[4] = array("short" => _AP_, "long" => _APR);
        $this->arrMonths[5] = array("short" => _MY_, "long" => _MAY);
        $this->arrMonths[6] = array("short" => _JU_, "long" => _JUN);
        $this->arrMonths[7] = array("short" => _JU_, "long" => _JUL);
        $this->arrMonths[8] = array("short" => _AU_, "long" => _AUG);
        $this->arrMonths[9] = array("short" => _SE_, "long" => _SEP);
        $this->arrMonths[10] = array("short" => _OC_, "long" => _OCT);
        $this->arrMonths[11] = array("short" => _NO_, "long" => _NOV);
        $this->arrMonths[12] = array("short" => _DE_, "long" => _DEC);
    }



    /**
     * eventManager::getSliderId()
     * 
     * @return
     */
    private function getEventId()
    {
        global $core;
        if (isset($_GET['eventid']))
        {
            $eventid = (is_numeric($_GET['eventid']) && $_GET['eventid'] > -1) ? intval($_GET['eventid']) : false;
            $eventid = sanitize($eventid);

            if ($eventid == false)
            {
                $core->error("You have selected an Invalid EventId", "eventManager::getEventId()");
            } else
                return $this->eventid = $eventid;
        }
    }



    public static function getEvent($id)
    {
        global $db;
        $sql = "select * from mod_events where id= $id";
        $event = $db->first($sql);
        return $event;
    }


    public function processEvent()
    {
        global $db, $core, $hollysec ,$user;
        $duration_inseconds="";
//        $duration_days=days_to_seconds($_POST['days']);
//        $duration_hours=hours_to_seconds($_POST['hours']);
//        $duration_minutes=minutes_to_seconds($_POST['minutes']);
//        $duration_inseconds=$duration_days+$duration_hours+$duration_minutes;
        $unpublished_insecond=hours_to_seconds($_POST['un_publishtime']);
        if ($_POST['title'.$core->dblang] == "")
            $core->msgs['title'] = PLG_EM_TITLE_R;

        if ($_POST['date_start'] == "")
            $core->msgs['date_start'] = PLG_EM_DATE_S_R;

        if ($_POST['date_end'] == "")
            $core->msgs['date_end'] = PLG_EM_DATE_e_R;

        if ($_POST['body'.$core->dblang] == "")
            $core->msgs['body'] = PLG_EM_BODY_R;
//        if (isset($_POST['contact_phone']) && !empty($_POST['contact_phone']))
//        {
//            if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i",$_POST['contact_phone']))
//                $core->msgs['contact_phone'] = Conatct_PHONEFORMAT;
//        }
        if (isset($_POST['contact_phone1']) && !empty($_POST['contact_phone1']))
        {
            if(!preg_match("/^[0-9]+$/",$_POST['contact_phone1']))
                $core->msgs['contact_phone1'] = telephone_valid;
        }
        if (isset($_POST['contact_phone2']) && !empty($_POST['contact_phone2']))
        {
            if(!preg_match("/^[0-9]+$/",$_POST['contact_phone2']))
                $core->msgs['contact_phone2'] = telephone2_valid;
        }
        if (isset($_POST['contact_phone3']) && !empty($_POST['contact_phone3']))
        {
            if(!preg_match("/^[0-9]+$/",$_POST['contact_phone3']))
                $core->msgs['contact_phone3'] = telephone3_valid;
        }
        if (isset($_POST['contact_phone1']) && !empty($_POST['contact_phone1']))
        {
            if(!preg_match("/^[0-9]+$/",$_POST['contact_phone1']))
                $core->msgs['contact_phone1'] = telephone_valid;
        }
        if ($_POST['type'] == "")
            $core->msgs['type'] = PLG_EM_TYPE_R;

        if(!$this->checkEventPermission())
            $core->msgs['type'] = PLG_EM_TYPE_R;

        //Check if type is permitted
        if ($user->userlevel != 9)
        {
            $type = $_POST['type'];
            $permittedTypes = explode(',', $user->getPermittedTypes('events'));
            if (!in_array($type, $permittedTypes))
                $core->msgs['type'] = PLG_EM_TYPE_R;
        }

        if (empty($core->msgs)) {

            list($date_start, $time_start) = explode(" ", $_POST['date_start']);
             list($date_end, $time_end) = explode(" ", $_POST['date_end']);

//            if(empty($_POST['time_start']))
//            {
//
//                $timestart=$_POST['time_start'];
//
//            }else
//            {
//                list($datestart, $timestart) = explode(" ", $_POST['time_start']);
//
//            }
            $data = array(
                'title'.$core->dblang => sanitize($_POST['title'.$core->dblang]),
                'venue'.$core->dblang => sanitize($_POST['venue'.$core->dblang]),
                'address'=> sanitize($_POST['venueaddress']),
                'city' => sanitize($_POST['venuecity']),
                'state' => sanitize($_POST['venuestate']),
                'zipcode' => sanitize($_POST['venuezipcode']),
                'type'=> sanitize($_POST['type']),
                'date_start' => sanitize($date_start),
                'time_start' => sanitize($time_start),
                'date_end' => sanitize($date_end),
                'time_end' => sanitize($time_end),
                'feature_on_homepage'=> sanitize($_POST['feature_on_homepage']),
//                'duration_insecond'=>  sanitize($duration_inseconds),

//                'contact_person' => sanitize($_POST['contact_person']),
//                'contact_email' => sanitize($_POST['contact_email']),
                'contact_phone' =>sanitize($_POST['contact_phone1']) ."-". sanitize($_POST['contact_phone2']) ."-". sanitize($_POST['contact_phone3']),
                'body'.$core->dblang => $core->in_url($_POST['body'.$core->dblang]),
                'active' => intval($_POST['active']),
                'un_publishtime'=>intval($unpublished_insecond)
            );

            ($this->eventid) ? $db->update($this->mTable, $data, "id='" . (int)$this->eventid . "'") : $db->insert($this->mTable, $data);
            $message = ($this->eventid) ? PLG_EM_UPDATED : PLG_EM_ADDED;

            ($db->affected()) ? $hollysec->writeLog($message, "", "no", "module") . $core->msgOk($message) :  $core->msgAlert(_SYSTEM_PROCCESS);
        } else
            print $core->msgStatus();
    }

    public function checkEventPermission()
    {
        global $db , $user;
        if ($user->userlevel == 9)
            return true;
        $sql = "SELECT type FROM $this->mTable WHERE id=$this->eventid";
        $type = $db->first($sql);
        $type=$type['type'];
        $permittedTypes = explode(',', $user->getPermittedTypes('events'));
        if (!in_array($type, $permittedTypes))
            return false;
        return true;
    }

    /**
     * eventManager::renderCalendar()
     * 
     * @param mixed $type
     * @return
     */
    public function renderCalendar($type = 'large')
    {
        ($type == 'large') ? $this->drawMonth() : $this->drawMonthSmall();
    }

    /**
     * eventManager::checkEventsMonths()
     * 
     * @param mixed $day
     * @return
     */
    private function checkEventsMonths($day)
    {
        if ($this->eventMonth)
        {
            foreach ($this->eventMonth as $v)
            {
                if ($day == $v['eday'])
                {
                    return true;
                }
            }

            return false;
        }
    }

    /**
     * eventManager::getCalDataMonth()
     * 
     * @return
     */
    private function getCalDataMonth()
    {
        global $db, $core;

        $typeWhere = "\n ";
        if(isset($_GET['eType']))
        {
            $type = intval($_GET['eType']);
            if($type!=1)
                $typeWhere = "\n AND type = $type";
        }

        $sql = "SELECT *, id as event_id, DAY(date_start) as eday, title{$core->dblang} as etitle, DAY(date_start) as eday,"
                . " \n DATE_FORMAT(time_start,'%H:%i') AS stime,"
                . " \n DATE_FORMAT(time_end,'%H:%i') AS etime"
                . "\n FROM " . $this->mTable
                . "\n WHERE YEAR(date_start) = " . $this->pars['year']
                . "\n AND MONTH(date_start) = " . $this->pars['month']
                . "\n AND active = 1"
                . $typeWhere
                . "\n ORDER BY date_start ASC";
        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;
    }


    public function getEvents($uid = null)
    {
        global $db, $pager, $core, $user;

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();


        $permitted = $user->get_permitted_events();
        $permittedCSV = implode(',',$permitted);
        $counter = countEntries($this->mTable." WHERE type IN ($permittedCSV)");

//        $counter = countEntries($this->mTable);
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
            if (in_array($sort, array("title_en","type","date_start","time_start"))) {
                $ord = ($order == 'DESC') ? " DESC" : " ASC";
                $sorting = " u." . $sort . $ord;
            } else {
                $sorting = " u.time_start DESC";
            }
        } else {
            $sorting = " u.time_start DESC";
        }

        $clause = (isset($clause)) ? $clause : null;

        if (isset($_REQUEST['search'])) {

            $clause .= " WHERE u.title_en like '%" . $_REQUEST['search'] . "%'";
        }



        if (isset($_GET['type_id'])) {

            if($_GET['type_id']!=1)
            {
                if(!isset($clause))
                    $clause = " WHERE u.type ='" . $_GET['type_id'] . "'";
                else
                    $clause .=  " AND u.type ='" . $_GET['type_id'] . "'";
            }
        }
        if(isset($_REQUEST['search']) && isset($_GET['type_id']))
        {
            if($_GET['type_id'] != 1)
                $clause= " WHERE u.fname like '%" . $_REQUEST['search'] . "%' and u.type ='" . $_GET['type_id'] . "'";
            else
                $clause= " WHERE u.fname like '%" . $_REQUEST['search'] . "%' ";
        }


            $sql = "SELECT * "
            . "\n FROM " . $this->mTable . " as u"
            . "\n " . $clause
            . "\n ORDER BY " . $sorting . $pager->limit;

        if ($user->userlevel !=9)
        {
            $sql = "SELECT * "
                . "\n FROM " . $this->mTable . " as u WHERE u.type IN ($permittedCSV)"
                . "\n " . $clause
                . "\n ORDER BY " . $sorting . $pager->limit;

        }

        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    /**
     * eventManager::drawMonth()
     * 
     * @return
     */
    private function drawMonth()
    {
        global $core;

        $is_day = 0;
        $first_day = getdate(mktime(0, 0, 0, $this->pars['month'], 1, $this->pars['year']));
        $last_day = getdate(mktime(0, 0, 0, $this->pars['month'] + 1, 0, $this->pars['year']));

        echo "<table class=\"month\" cellspacing=\"0\">";
        echo "<thead>";
        echo "<tr>";
        echo " <td><a href=\"javascript:void(0);\" id=\"item_" . $this->toDecimal($this->prevMonth['mon']) . ":" . $this->prevMonth['year'] . "\" class=\"changedate prev\"></a></td>";
        echo "<td colspan=\"5\">" . $this->arrMonths[$this->pars['nmonth']][$this->monthNameLength] . " - " . $this->pars['year'] . "</td>";
        echo "<td><a href=\"javascript:void(0);\" id=\"item_" . $this->toDecimal($this->nextMonth['mon']) . ":" . $this->nextMonth['year'] . "\" class=\"changedate next\"></a></td>";
        echo "</tr>";
        echo "<tr>";
        for ($i = $this->weekStartedDay - 1; $i < $this->weekStartedDay + 6; $i++)
        {
            echo "<th width=\"14%\">" . $this->arrWeekDays[($i % 7)][$this->weekDayNameLength] . "</th>";
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        if ($first_day['wday'] == 0)
        {
            $first_day['wday'] = 7;
        }
        $max_days = $first_day['wday'] - ($this->weekStartedDay - 1);
        if ($max_days < 7)
        {
            echo "<tr>";
            for ($i = 1; $i <= $max_days; $i++)
            {
                echo "<td class=\"empty\">&nbsp;</td>";
            }
            $is_day = 0;
            for ($i = $max_days + 1; $i <= 7; $i++)
            {
                $is_day++;
                $class = '';
                $tclass = '';
                $align = '';
                if (($is_day == $this->today['mday']) && ($this->today['mon'] == $this->pars["month"]))
                {
                    $tclass = " today";
                    $display = $is_day;
                }

                if ($this->checkEventsMonths($is_day))
                {
                    $res = '';
                    $data = '';
                    foreach ($this->eventMonth as $row)
                    {
                        if ($row['eday'] == $is_day)
                        {
                            $res .= "<small><a href=\"javascript:void(0);\" class=\"loadevent\" id=\"eventid_" . $row['event_id'] . "\">" . sanitize($row['etitle'], 25) . "</a></small>\n";

                            $data .= '<div class="event-wrapper" id="eid_' . $row['event_id'] . '" style="display:none" title="' . $row['title' . $core->dblang] . '">';
                            $data .= '<div class="event-list">';
                            $data .= '<h3 class="event-title"><span>' . PLG_EM_TSE . ': ' . $row['stime'] . '/' . $row['etime'] . '</span>' . $row['title' . $core->dblang] . '</h3>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<h6 class="event-venue">' . $row['venue' . $core->dblang] . '</h6>';
                            $data .= "<hr />";
                            $data .= '<div class="event-desc">' . cleanOut($core->out_url($row['body' . $core->dblang])) . '</div>';

                            $data .= '<span class="contact-info-toggle">' . PLG_EM_CONTACT . '</span>';
                            $data .= '<div class="event-contact">';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_person'] . '</div>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_email'] . '</div>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_phone'] . '</div>';
                            $data .= '</div>';
                            $data .= '</div>';
                            $data .= '</div>';
                        }
                    }
                    $display = $data . "<div><span>" . $is_day . "</span>" . $res . "</div>";
                    $class = " events";
                    $align = " valign=\"top\"";
                } else
                {
                    $display = $is_day;
                }
                echo "<td class=\"caldata" . $class . $tclass . "\"" . $align . ">" . $display . "</td>";
            }
            echo "</tr>";
        }

        $fullWeeks = floor(($last_day['mday'] - $is_day) / 7);

        for ($i = 0; $i < $fullWeeks; $i++)
        {
            echo "<tr>";
            for ($j = 0; $j < 7; $j++)
            {
                $is_day++;
                $class = '';
                $tclass = '';
                $align = '';
                if (($is_day == $this->today['mday']) && ($this->today['mon'] == $this->pars["month"]))
                {
                    $tclass = " today";
                    $display = $is_day;
                }

                if ($this->checkEventsMonths($is_day))
                {
                    $res = '';
                    $data = '';
                    foreach ($this->eventMonth as $row)
                    {
                        if ($row['eday'] == $is_day)
                        {
                            $res .= "<small><a href=\"javascript:void(0);\" class=\"loadevent\" id=\"eventid_" . $row['event_id'] . "\">" . sanitize($row['etitle'], 25) . "</a></small>\n";

                            $data .= '<div class="event-wrapper" id="eid_' . $row['event_id'] . '" style="display:none" title="' . $row['title' . $core->dblang] . '">';
                            $data .= '<div class="event-list">';
                            $data .= '<h3 class="event-title"><span>' . PLG_EM_TSE . ': ' . $row['stime'] . '/' . $row['etime'] . '</span>' . $row['title' . $core->dblang] . '</h3>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<h6 class="event-venue">' . $row['venue' . $core->dblang] . '</h6>';
                            $data .= "<hr />";
                            $data .= '<div class="event-desc">' . cleanOut($core->out_url($row['body' . $core->dblang])) . '</div>';

                            $data .= '<span class="contact-info-toggle">' . PLG_EM_CONTACT . '</span>';
                            $data .= '<div class="event-contact">';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_person'] . '</div>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_email'] . '</div>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_phone'] . '</div>';
                            $data .= '</div>';
                            $data .= '</div>';
                            $data .= '</div>';
                        }
                    }
                    $display = $data . "<div><span>" . $is_day . "</span>" . $res . "</div>";
                    $class = " events";
                    $align = " valign=\"top\"";
                } else
                {
                    $display = $is_day;
                }
                echo "<td class=\"caldata" . $class . $tclass . "\"" . $align . ">" . $display . "</td>";
            }
            echo "</tr>";
        }

        if ($is_day < $last_day['mday'])
        {
            echo "<tr>";
            for ($i = 0; $i < 7; $i++)
            {
                $is_day++;
                $class = '';
                $tclass = '';
                $align = '';
                if (($is_day == $this->today['mday']) && ($this->today['mon'] == $this->pars["month"]))
                {
                    $tclass = " today";
                    $display = $is_day;
                }
                if ($this->checkEventsMonths($is_day))
                {
                    $res = '';
                    $data = '';
                    foreach ($this->eventMonth as $row)
                    {
                        if ($row['eday'] == $is_day)
                        {
                            $res .= "<small><a href=\"javascript:void(0);\" class=\"loadevent\" id=\"eventid_" . $row['event_id'] . "\">" . sanitize($row['etitle'], 25) . "</a></small>\n";

                            $data .= '<div class="event-wrapper" id="eid_' . $row['event_id'] . '" style="display:none" title="' . $row['title' . $core->dblang] . '">';
                            $data .= '<div class="event-list">';
                            $data .= '<h3 class="event-title"><span>' . PLG_EM_TSE . ': ' . $row['stime'] . '/' . $row['etime'] . '</span>' . $row['title' . $core->dblang] . '</h3>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<h6 class="event-venue">' . $row['venue' . $core->dblang] . '</h6>';
                            $data .= "<hr />";
                            $data .= '<div class="event-desc">' . cleanOut($core->out_url($row['body' . $core->dblang])) . '</div>';

                            $data .= '<span class="contact-info-toggle">' . PLG_EM_CONTACT . '</span>';
                            $data .= '<div class="event-contact">';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_person'] . '</div>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_email'] . '</div>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_phone'] . '</div>';
                            $data .= '</div>';
                            $data .= '</div>';
                            $data .= '</div>';
                        }
                    }
                    $display = $data . "<div><span>" . $is_day . "</span>" . $res . "</div>";
                    $class = " events";
                    $align = " valign=\"top\"";
                } else
                {
                    $display = $is_day;
                }

                echo ($is_day <= $last_day['mday']) ? "<td class=\"caldata" . $class . $tclass . "\"" . $align . ">" . $display . "</td>" : "<td class=\"empty\">&nbsp;</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }

    /**
     * eventManager::DrawMonthSmall()
     * 
     * @return
     */
    private function drawMonthSmall()
    {
        global $core;

        $is_day = 0;
        $first_day = getdate(mktime(0, 0, 0, $this->pars['month'], 1, $this->pars['year']));
        $last_day = getdate(mktime(0, 0, 0, $this->pars['month'] + 1, 0, $this->pars['year']));

        echo "<table class=\"month-small\" cellspacing=\"0\">";
        echo "<thead>";
        echo "<tr>";
        echo " <td><a href=\"javascript:void(0);\" id=\"item_" . $this->toDecimal($this->prevMonth['mon']) . ":" . $this->prevMonth['year'] . "\" class=\"changedate prev\"></a></td>";
        echo "<td colspan=\"5\">" . $this->arrMonths[$this->pars['nmonth']][$this->monthNameLength] . " - " . $this->pars['year'] . "</td>";
        echo "<td><a href=\"javascript:void(0);\" id=\"item_" . $this->toDecimal($this->nextMonth['mon']) . ":" . $this->nextMonth['year'] . "\" class=\"changedate next\"></a></td>";
        echo "</tr>";
        echo "<tr>";
        for ($i = $this->weekStartedDay - 1; $i < $this->weekStartedDay + 6; $i++)
        {
            echo "<th width=\"14%\">" . $this->arrWeekDays[($i % 7)][$this->weekDayNameLength] . "</th>";
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        if ($first_day['wday'] == 0)
        {
            $first_day['wday'] = 7;
        }
        $max_days = $first_day['wday'] - ($this->weekStartedDay - 1);
        if ($max_days < 7)
        {
            echo "<tr>";
            for ($i = 1; $i <= $max_days; $i++)
            {
                echo "<td class=\"empty\">&nbsp;</td>";
            }
            $is_day = 0;
            for ($i = $max_days + 1; $i <= 7; $i++)
            {
                $is_day++;
                $class = '';
                $tclass = '';
                if (($is_day == $this->today['mday']) && ($this->today['mon'] == $this->pars["month"]))
                {
                    $tclass = " today";
                    $display = $is_day;
                }

                if ($this->checkEventsMonths($is_day))
                {
                    $res = '';
                    $data = '';
                    $date_form = $this->pars['year'] . '/' . $this->arrMonths[$this->pars['nmonth']][$this->monthNameLength] . '/' . $is_day;
                    $data .= '<div class="event-wrapper" id="eid_' . $is_day . '" style="display:none" title="' . PLG_EM_EVENT_FOR . ' ' . $date_form . '">';

                    foreach ($this->eventMonth as $row)
                    {
                        if ($row['eday'] == $is_day)
                        {

                            $data .= '<div class="event-list">';
                            $data .= '<h3 class="event-title"><span>' . PLG_EM_TSE . ': ' . $row['stime'] . '/' . $row['etime'] . '</span>' . $row['title' . $core->dblang] . '</h3>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<h6 class="event-venue">' . $row['venue' . $core->dblang] . '</h6>';

                            $data .= '<div class="event-desc">' . cleanOut($core->out_url($row['body' . $core->dblang])) . '</div>';

                            $data .= '<span class="contact-info-toggle">' . PLG_EM_CONTACT . '</span>';
                            $data .= '<div class="event-contact">';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_person'] . '</div>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_email'] . '</div>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_phone'] . '</div>';
                            $data .= '</div>';
                            $data .= '</div>';
                        }
                    }
                    $data .= '</div>';
                    $display = $data . "<a href=\"javascript:void(0);\" class=\"loadevent\" id=\"eventid_" . $is_day . "\">" . $is_day . "</a>";
                    $class = " events";
                } else
                {
                    $display = $is_day;
                }

                echo "<td class=\"caldata" . $class . $tclass . "\">" . $display . "</td>";
            }
            echo "</tr>";
        }

        $fullWeeks = floor(($last_day['mday'] - $is_day) / 7);

        for ($i = 0; $i < $fullWeeks; $i++)
        {
            echo "<tr>";
            for ($j = 0; $j < 7; $j++)
            {
                $is_day++;
                $class = '';
                $tclass = '';
                if (($is_day == $this->today['mday']) && ($this->today['mon'] == $this->pars["month"]))
                {
                    $tclass = " today";
                    $display = $is_day;
                }

                if ($this->checkEventsMonths($is_day))
                {
                    $res = '';
                    $data = '';
                    $date_form = $this->pars['year'] . '/' . $this->arrMonths[$this->pars['nmonth']][$this->monthNameLength] . '/' . $is_day;
                    $data .= '<div class="event-wrapper" id="eid_' . $is_day . '" style="display:none" title="' . PLG_EM_EVENT_FOR . ' ' . $date_form . '">';

                    foreach ($this->eventMonth as $row)
                    {
                        if ($row['eday'] == $is_day)
                        {

                            $data .= '<div class="event-list">';
                            $data .= '<h3 class="event-title"><span>' . PLG_EM_TSE . ': ' . $row['stime'] . '/' . $row['etime'] . '</span>' . $row['title' . $core->dblang] . '</h3>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<h6 class="event-venue">' . $row['venue' . $core->dblang] . '</h6>';

                            $data .= '<div class="event-desc">' . cleanOut($core->out_url($row['body' . $core->dblang])) . '</div>';

                            $data .= '<span class="contact-info-toggle">' . PLG_EM_CONTACT . '</span>';
                            $data .= '<div class="event-contact">';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_person'] . '</div>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_email'] . '</div>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_phone'] . '</div>';
                            $data .= '</div>';
                            $data .= '</div>';
                        }
                    }
                    $data .= '</div>';
                    $display = $data . "<a href=\"javascript:void(0);\" class=\"loadevent\" id=\"eventid_" . $is_day . "\">" . $is_day . "</a>";
                    $class = " events";
                } else
                {
                    $display = $is_day;
                }

                echo "<td class=\"caldata" . $class . $tclass . "\">" . $display . "</td>";
            }
            echo "</tr>";
        }

        if ($is_day < $last_day['mday'])
        {
            echo "<tr>";
            for ($i = 0; $i < 7; $i++)
            {
                $is_day++;
                $class = '';
                $tclass = '';
                $align = '';
                if (($is_day == $this->today['mday']) && ($this->today['mon'] == $this->pars["month"]))
                {
                    $tclass = " today";
                    $display = $is_day;
                }

                if ($this->checkEventsMonths($is_day))
                {
                    $res = '';
                    $data = '';
                    $date_form = $this->pars['year'] . '/' . $this->arrMonths[$this->pars['nmonth']][$this->monthNameLength] . '/' . $is_day;
                    $data .= '<div class="event-wrapper" id="eid_' . $is_day . '" style="display:none" title="' . PLG_EM_EVENT_FOR . ' ' . $date_form . '">';

                    foreach ($this->eventMonth as $row)
                    {
                        if ($row['eday'] == $is_day)
                        {

                            $data .= '<div class="event-list">';
                            $data .= '<h3 class="event-title"><span>' . PLG_EM_TSE . ': ' . $row['stime'] . '/' . $row['etime'] . '</span>' . $row['title' . $core->dblang] . '</h3>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<h6 class="event-venue">' . $row['venue' . $core->dblang] . '</h6>';

                            $data .= '<div class="event-desc">' . cleanOut($row['body' . $core->dblang]) . '</div>';

                            $data .= '<span class="contact-info-toggle">' . PLG_EM_CONTACT . '</span>';
                            $data .= '<div class="event-contact">';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_person'] . '</div>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_email'] . '</div>';
                            if ($row['venue' . $core->dblang])
                                $data .= '<div>' . $row['contact_phone'] . '</div>';
                            $data .= '</div>';
                            $data .= '</div>';
                        }
                    }
                    $data .= '</div>';
                    $display = $data . "<a href=\"javascript:void(0);\" class=\"loadevent\" id=\"eventid_" . $is_day . "\">" . $is_day . "</a>";
                    $class = " events";
                } else
                {
                    $display = $is_day;
                }
                echo ($is_day <= $last_day['mday']) ? "<td class=\"caldata" . $class . $tclass . "\">" . $display . "</td>" : "<td class=\"empty\">&nbsp;</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }

    /**
     * eventManager::getCalData()
     *
     * @return
     */
    public function getCalData()
    {
        $caldata = "dateFormat: 'yy-mm-dd',timeFormat: 'hh:mm:ss',";
        $caldata .= "dayNames: ['" . _SUNDAY . "', '" . _MONDAY . "', '" . _TUESDAY . "', '" . _WEDNESDAY . "', '" . _THURSDAY . "', '" . _FRIDAY . "', '" . _SATURDAY . "'],";
        $caldata .= "dayNamesMin: ['" . _SU . "','" . _MO . "', '" . _TU . "', '" . _WE . "', '" . _TH . "', '" . _FR . "', '" . _SA . "'],";
        $caldata .= "dayNamesShort: ['" . _SUN . "', '" . _MON . "', '" . _TUE . "', '" . _WED . "', '" . _THU . "', '" . _FRI . "', '" . _SAT . "'],";
        $caldata .= "monthNames: ['" . _JAN . "', '" . _FEB . "', '" . _MAR . "', '" . _APR . "', '" . _MAY . "', '" . _JUN . "', '" . _JUL . "', '" . _AUG . "', '" . _SEP . "', '" . _OCT . "', '" . _NOV . "', '" . _DEC . "'],";
        $caldata .= "monthNamesShort: ['" . _JA_ . "', '" . _FE_ . "', '" . _MA_ . "', '" . _AP_ . "', '" . _MY_ . "', '" . _JU_ . "', '" . _JL_ . "', '" . _AU_ . "', '" . _SE_ . "', '" . _OC_ . "', '" . _NO_ . "', '" . _DE_ . "'],";
        $caldata .= "prevText: '" . PLG_EM_PREV . "',";
        $caldata .= "nextText: '" . PLG_EM_NEXT . "',";
        $caldata .= "timeText: '" . PLG_EM_TIME . "',";
        $caldata .= "hourText: '" . PLG_EM_HOUR . "',";
        $caldata .= "minuteText: '" . PLG_EM_MIN . "',";
        $caldata .= "secondText: '" . PLG_EM_SEC . "',";
        $caldata .= "firstDay: 0,";
        $caldata .= "hourGrid: 4,";
        $caldata .= "minuteGrid: 10,";
        $caldata .= "secondGrid: 10";

        return $caldata;
    }

    /**
     * eventManager::setWeekStart()
     * 
     * @return
     */
    private function setWeekStart()
    {
        global $core;

        return $core->weekstart;
    }

    /**
     * eventManager::calcDays()
     * 
     * @param string $month
     * @param string $day
     * @return
     */
    private function calcDays($month, $day)
    {
        switch ($day)
        {
            case $day < 29:
                return ((int) $month == 2) ? 28 :
                        29;
                break;

            case 30:
                return ((int) $month != 2) ? 30 :
                        28;
                break;

            case 31:
                return ((int) $month == 2 ? 28 : ((int) $month == 4 || (int) $month == 6 || (int) $month == 9 || (int) $month == 11 ? 30 : 31));
                break;

            default:
                return 30;
                break;
        }
    }

    /**
     * eventManager::toDecimal()
     * 
     * @param mixed $number
     * @return
     */
    public function toDecimal($number)
    {
        return (($number < 10) ? "0" : "") . $number;
    }

    /**
     * eventManager::checkYear()
     * 
     * @param string $year
     * @return
     */
    private function checkYear($year = "")
    {
        return (strlen($year) == 4 or ctype_digit($year)) ? true : false;
    }

    /**
     * eventManager::checkMonth()
     * 
     * @param string $month
     * @return
     */
    private function checkMonth($month = "")
    {
        return ((strlen($month) == 2) or ctype_digit($month) or ($month < 12)) ? true : false;
    }

    /**
     * eventManager::checkDay()
     * 
     * @param string $day
     * @return
     */
    private function checkDay($day = "")
    {
        return ((strlen($day) == 2) or ctype_digit($day) or ($day < 31)) ? true : false;
    }


      public function getEventFilter()
      {
          $arr = array(
              'title_en-ASC' => _Eventtitle . ' &uarr;',
              'title_en-DESC' => _Eventtitle . ' &darr;',
              'date_start-ASC' => _Datestart . ' &uarr;',
              'date_start-DESC' => _Datestart . ' &darr;',
              'time_strat-ASC' => PLG_time_strat . ' &darr;',
              'time_end-DESC' => PLG_time_strat . ' &darr;',
              'type-ASC' => PLG_Type . ' &uarr;',
              'type-DESC' => PLG_Type . ' &darr;',


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

  }