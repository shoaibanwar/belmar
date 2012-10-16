<?php
/**
 * Content Class
 *
 * @package HollyCode CMS
 * @author HollyCode.com
 * @copyright 2010
 * @version $Id: class_content.php, v2.00 2011-04-20 10:12:05 gewa Exp $
 */

if (!defined("_VALID_PHP"))
    die('Direct access to this location is not allowed.');

class Content
{
    private $ProomTable = "pressroom";
    private $publicworkTable = "publicworks";
    private $BelmarsurvayTable = "belmarsurvey";
    private $BelmaralertsTable = "belmaralerts";
    private $pageTable = "pages";

    public $proomid = null;
    public $publicworkdid = null;
    public $belmaralertId = null;

    public $pageid = null;
    public $modpageid = null;
    public $modalias = null;
    public $moduledata = array();
    public $id = null;
    public $slug = null;
    public $homeslug = null;
    public $homeid = null;
    public $postid = null;
    private $menutree = array();
    private $menulist = array();

    private $map = false;


    /**
     * Content::__construct()
     *
     * @param bool $menutre
     * @return
     */
    public function __construct($menutre = true)
    {
        $this->getPressroomId();
        $this->getbelmaralertId();
        $this->getPageId();
        $this->getId();
        $this->getPageSlug();
        $this->getHomePageSlug();
        $this->getModAlias();
        $this->getPostId();
        ($menutre) ? $this->menutree = $this->getMenuTree() : $this->menutree = null;
        $this->getPageSettings();
        ($this->modalias) ? $this->moduledata = $this->getModuleMetaData() : null;
    }

    /**
     * Content::getPageSlug()
     *
     * @return
     */
    private function getPageSlug()
    {
        global $db;

        if (isset($_GET['pagename'])) {
            $this->slug = sanitize($_GET['pagename'], 50);
            return $db->escape($this->slug);
        }
    }


    /**
     * Content::getModAlias()
     *
     * @return
     */
    private function getModAlias()
    {
        global $db;

        if (isset($_GET['module'])) {
            $this->modalias = sanitize($_GET['module'], 20);
            return $db->escape($this->modalias);
        }
    }

    /**
     * Content::getHomePageSlug()
     *
     * @return
     */
    private function getHomePageSlug()
    {
        global $db;

        $row = $db->first("SELECT page_id, page_slug FROM menus WHERE home_page = '1'");
        $this->homeslug = $row['page_slug'];
        $this->homeid = $row['page_id'];
    }

    /**
     * Content::getPageId()
     *
     * @return
     */
    private function getPageId()
    {
        global $core, $DEBUG;
        if (isset($_GET['pageid'])) {
            $_GET['pageid'] = sanitize($_GET['pageid'], 6, true);
            $pageid = (is_numeric($_GET['pageid']) && $_GET['pageid'] > -1) ? intval($_GET['pageid']) : false;

            if ($pageid) {
                return $this->pageid = $pageid;
            } else {
                if ($DEBUG)
                    $core->error("You have selected an Invalid Id", "Content::getPageId()");
            }
        }
    }

    /**
     * Content::getPostId()
     *
     * @return
     */
    private function getPostId()
    {
        global $core;
        if (isset($_GET['postid'])) {
            $postid = (is_numeric($_GET['postid']) && $_GET['postid'] > -1) ? intval($_GET['postid']) : false;
            $postid = sanitize($postid, 8, true);

            if ($postid == false) {
                $core->error("You have selected an Invalid PostId", "Content::getPostId()");
            } else
                return $this->postid = $postid;
        }
    }

    /**
     * Content::getId()
     *
     * @return
     */
    private function getId()
    {
        global $core;
        if (isset($_GET['id'])) {
            $id = (is_numeric($_GET['id']) && $_GET['id'] > -1) ? intval($_GET['id']) : false;
            $id = sanitize($id, 8, true);

            if ($id == false) {
                $core->error("You have selected an Invalid Id", "Content::getId()");
            } else
                return $this->id = $id;
        }
    }

// new commentfady/////////////////////


    public function processPressRoom()
    {

        global $db, $core, $hollysec;
        if (empty($_POST['title' . $core->dblang]))
            $core->msgs['title' . $core->dblang] = _MU_PROOM_R;

        if ($_POST['content_type'] == "NA")
            $core->msgs['content_type'] = _MU_TYPE_R;

        if (empty($_POST['post_date']))
            $core->msgs['post_date'] = _PostDate_TYPE_R;
        $unpublished_insecond = hours_to_seconds($_POST['un_publishtime']);

        if (empty($core->msgs)) {

            $data = array(
                'title' . $core->dblang => (sanitize($_POST['title' . $core->dblang])),
                'slug' => paranoia($_POST['title' . $core->dblang]),
                'post_date' => $_POST['post_date'],
                'user_id' => sanitize($_POST['user_id']),
                'type' => sanitize($_POST['content_type']),
                'on_site_content' => (isset($_POST['on_site_content'])) ? sanitize($_POST['on_site_content']) : "NULL",
                'off_site_url' => (isset($_POST['Off-site_URL'])) ? sanitize($_POST['Off-site_URL']) : "NULL",
                'file_upload' => $_POST['uploadlink'],
                'target' => (isset($_POST['target'])) ? sanitize($_POST['target']) : "DEFAULT(target)",
                'status' => intval($_POST['active']),
                'home_feature' => intval($_POST['hfeature']),
                'un_publishtime' => intval($unpublished_insecond),


            );
            ($this->proomid) ? $db->update($this->ProomTable, $data, "id='" . (int)$this->proomid . "'") : $db->insert($this->ProomTable, $data);
            $message = ($this->proomid) ? _PRoom_UPDATED : _PROOM_ADDED;

            ($db->affected()) ? $hollysec->writeLog($message, "", "no", "pressroom") . $core->msgOk($message) : $core->msgAlert(_SYSTEM_PROCCESS);


        } else
            print $core->msgStatus();
    }

    public function processBelamralert()
    {

        global $db, $core, $hollysec;
        if (empty($_POST['title']))
            $core->msgs['title'] = _MU_BelmarAlert_R;

        $unpublished_insecond = hours_to_seconds($_POST['un_publishtime']);
        if (empty($core->msgs)) {

            $data = array(
                'title' => (sanitize($_POST['title'])),
                'slug' => paranoia($_POST['title']),
                'post_date' => $_POST['post_date'],
                'user_id' => sanitize($_POST['user_id']),
                'un_publishtime' => sanitize($unpublished_insecond),
                'alert_content' => (isset($_POST['alert_content'])) ? sanitize($_POST['alert_content']) : "NULL",
                'item_published' => intval($_POST['active']),
                'feature_homepage' => intval($_POST['hfeature']),


            );
            ($this->belmaralertId) ? $db->update($this->BelmaralertsTable, $data, "id='" . (int)$this->belmaralertId . "'") : $db->insert($this->BelmaralertsTable, $data);
            $message = ($this->belmaralertId) ? _Belamrt_UPDATED : _BelmarAerts_ADDED;

            ($db->affected()) ? $hollysec->writeLog($message, "", "no", "belmaralerts") . $core->msgOk($message) : $core->msgAlert(_SYSTEM_PROCCESS);


            //send email
            if ($this->belmaralertId)
                return;

            require_once(HCODE . "lib/class_mailer.php");
            $mailer = $mail->sendMail();

            $row = $core->getRowById("email_templates", 31);

            $alerts_settings = $db->first("SELECT * FROM get_alerts_settings ");


            $subscribers = $db->fetch_all("SELECT * FROM get_alerts");
            $settings = $db->first("SELECT * FROM get_alerts_settings");

            $body = str_replace(array('[UNSUBSCRIBE]', '[CONTENT]', '[SENDER]', '[NAME]', '[SITE_NAME]', '[URL]'),
                array("", $data['alert_content'], $alerts_settings['from_email'], $alerts_settings['from_email'], $core->site_name, $core->site_url), $row['body' . $core->dblang]);

            $message = Swift_Message::newInstance()
                ->setSubject($row['subject' . $core->dblang])
                ->setTo(array($settings['notification_copy_email'] => "Belmar"))
                ->setFrom(array($settings['from_email'] => $settings['from_name']))
                ->setBody(cleanOut($body), 'text/html');

            $mailSent = $mailer->send($message);

            foreach ($subscribers as $subscriber) {
                $unsubscribeUrl = SITEURL . "unsubscribe.php?sid=" . $subscriber['id'] . "&st=" . substr(md5($subscriber['email']), 0, 8) . "&list=alerts";
                $body = str_replace(array('[UNSUBSCRIBE]', '[CONTENT]', '[SENDER]', '[NAME]', '[SITE_NAME]', '[URL]'),
                    array($unsubscribeUrl, $data['alert_content'], $alerts_settings['from_email'], $alerts_settings['from_email'], $core->site_name, $core->site_url), $row['body' . $core->dblang]);

                $message = Swift_Message::newInstance()
                    ->setSubject($row['subject' . $core->dblang])
                    ->setTo(array($subscriber['email'] => $subscriber['fname']))
                    ->setFrom(array($settings['from_email'] => $settings['from_name']))
                    ->setBody(cleanOut($body), 'text/html');

                $mailSent = $mailer->send($message);
            }


            if ($mailSent) {
                print 'OK';
                $hollysec->writeLog(_USER . ' ' . $user->username . ' ' . _LG_CONTACT_SENT, "", "no", "user");
            }

        } else
            print $core->msgStatus();
    }


    public function getPRoomContentType($selected = false)
    {

        $arr = array(
            'On-site_Content' => _ON_SITE_CONTENT,
            'Off-site_URL' => OFF_Site_URL,
            'file_upload' => File_Upload,

        );


        $contenttype = '';
        foreach ($arr as $key => $val) {
            if ($key == $selected) {
                $contenttype .= "<option selected=\"selected\" value=\"" . $key . "\">" . $val . "</option>\n";
            } else
                $contenttype .= "<option value=\"" . $key . "\">" . $val . "</option>\n";
        }
        unset($val);
        return $contenttype;
    }

    public function getPRoom($from = false)
    {
        global $db, $pager, $core;

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();

        $counter = countEntries($this->ProomTable);
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
            if (in_array($sort, array("title_en", "post_date", "user_id"))) {
                $ord = ($order == 'DESC') ? " DESC" : " ASC";
                $sorting = " u." . $sort . $ord;
            } else {
                $sorting = " u.user_id DESC";
            }
        } else {
            $sorting = " u.user_id DESC";
        }

        $clause = (isset($clause)) ? $clause : null;

        if (isset($_REQUEST['search'])) {


            $clause .= " WHERE u.title_en like '" . $_REQUEST['search'] . "%'";
        }

        $sql = "SELECT * "
            . "\n FROM " . $this->ProomTable . " as u"
            . "\n " . $clause
            . "\n ORDER BY " . $sorting . $pager->limit;

        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getbelmaralerts($from = false)
    {
        global $db, $pager, $core;

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();

        $counter = countEntries($this->BelmaralertsTable);
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
            if (in_array($sort, array("title", "post_date", 'user_id'))) {
                $ord = ($order == 'DESC') ? " DESC" : " ASC";
                $sorting = " u." . $sort . $ord;
            } else {
                $sorting = " u.user_id DESC";
            }
        } else {
            $sorting = " u.user_id DESC";
        }

        $clause = (isset($clause)) ? $clause : null;

        if (isset($_REQUEST['search'])) {


            $clause .= " WHERE u.title like '" . $_REQUEST['search'] . "%'";
        }

        $sql = "SELECT * "
            . "\n FROM " . $this->BelmaralertsTable . " as u"
            . "\n " . $clause
            . "\n ORDER BY " . $sorting . $pager->limit;

        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getPRoomFilter()
    {
        $arr = array(
            'title_en-ASC' => _Press_Room_title . ' &uarr;',
            'title_en-DESC' => _Press_Room_title . ' &darr;',
            'post_date-ASC' => _Post_date . ' &uarr;',
            'post_date-DESC' => _Post_date . ' &darr;',
            'user_id-ASC' => Posted_by . ' &uarr;',
            'user_id-DESC' => Posted_by . ' &darr;',
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


    //new comment fady///

    public function getbelamralertsFilter()
    {
        $arr = array(
            'title-ASC' => _belamr_Alerts_title . ' &uarr;',
            'title-DESC' => _belamr_Alerts_title . ' &darr;',
            'post_date-ASC' => _Post_date . ' &uarr;',
            'post_date-DESC' => _Post_date . ' &darr;',
            'user_id-ASC' => Posted_by . ' &uarr;',
            'user_id-DESC' => Posted_by . ' &darr;',

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

    //end comment


//new comment fady
    public function getPageFilter()
    {
        $arr = array(
            'title_en-ASC' => _Press_page_title . ' &uarr;',
            'title_en-DESC' => _Press_page_title . ' &darr;',


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

    //end comment


    //new commant fady


    private function getPressroomId()
    {
        global $core;
        if (isset($_GET['proomid'])) {
            $proomid = (is_numeric($_GET['proomid']) && $_GET['proomid'] > -1) ? intval($_GET['proomid']) : false;
            $proomid = sanitize($proomid);

            if ($proomid == false) {
                $core->error("You have selected an Invalid EventId", "eventManager::getEventId()");
            } else
                return $this->proomid = $proomid;
        }
    }

//endcomment////


//new comment
    private function getbelmaralertId()
    {
        global $core;
        if (isset($_GET['belmaralertId'])) {
            $belmaralertId = (is_numeric($_GET['belmaralertId']) && $_GET['belmaralertId'] > -1) ? intval($_GET['belmaralertId']) : false;
            $belmaralertId = sanitize($belmaralertId);

            if ($belmaralertId == false) {
                $core->error("You have selected an Invalid belmaralertid", "content::getbelmaralertid()");
            } else
                return $this->belmaralertId = $belmaralertId;
        }
    }

//end comment

    /**
     * Content::getPageSettings()
     *
     * @return
     */


    private function getPageSettings()
    {
        global $db, $core;

        $sql = "SELECT * FROM pages WHERE slug = '" . $this->slug . "'";
        $row = $db->first($sql);

        $this->title = $row['title' . $core->dblang];
        $this->slug = $row['slug'];
        $this->contact_form = $row['contact_form'];
        $this->membership_id = $row['membership_id'];
        $this->module_id = $row['module_id'];
        $this->module_data = $row['module_data'];
        $this->module_name = $row['module_name'];
        $this->access = $row['access'];
        $this->body_en = $row['body_en'];

        $this->keywords = $row['keywords' . $core->dblang];
        $this->description = $row['description' . $core->dblang];
        $this->created = $row['created'];
        $this->active = $row['active'];
        $this->modpageid = $row['id'];

    }

    private function getPage()
    {
        global $db, $core, $user;

        $sql = "SELECT * FROM pages WHERE slug = '" . $this->slug . "'";

        $row = $db->first($sql);

        if (empty($row))
            return false;
        $data = array();
        $data['title_en'] = $row['title' . $core->dblang];
        $data['slug'] = $row['slug'];
        $data['body_en'] = $row['body_en'];
        $data['jscode'] = $row['jscode'];

        $data['keywords'] = $row['keywords' . $core->dblang];
        $data['description'] = $row['description' . $core->dblang];
        $data['created'] = $row['created'];
        return $data;
    }

    /**
     * Content::getHomePage()
     *
     * @return
     */
    private function getHomePage()
    {
        global $db, $core;

        $sql = "SELECT p.title{$core->dblang}, p.body{$core->dblang}, p.show_title, m.home_page AS home, p.jscode"
            . "\n FROM pages AS pg"
            . "\n LEFT JOIN menus AS m ON pg.slug = m.page_slug"
            . "\n LEFT JOIN posts AS p ON p.page_slug = pg.slug"
            . "\n WHERE m.home_page = '1' AND p.active = '1' ORDER BY p.position";
        $result = $db->fetch_all($sql);

        if ($result) {
            foreach ($result as $row) {
                if ($row['show_title'] == 1)
                    print "<h1 class=\"home-header\"><span>" . $row['title' . $core->dblang] . "</span></h1>\n";

                print "<div class=\"home-bod\">" . cleanOut($row['body' . $core->dblang]) . "\n";
                print ($row['jscode']) ? cleanOut($row['jscode']) : "";
                print "</div>\n";
            }
        } else
            print _CONTENT_NOT_FOUND;
    }

    /**
     * Content::displayPage()
     *
     * @return
     */
    public function displayPage()
    {
        if (isset($_GET['pageId'])) {
            global $db;
            $sql = "SELECT * FROM pages WHERE slug = '" . $_GET['pageId'] . "'";
            $page = $db->first($sql);
            if (empty($page))
                print _CONTENT_NOT_FOUND;

            else if ($page['body_en'] === NULL) {
                $this->slug = $page['slug'];
                $this->module_id = $page['module_id'];
                $this->module_data = $page['module_data'];
                echo "<div style='margin: 50px;'> ";
                $this->getPagePosts();
                echo "</div>";
            } else {
                print "<h1 class=\"post-header\"><span>" . $page['title_en'] . "</span></h1>\n";
                print "<div class=\"post-body\">" . cleanOut($page['body_en']) . "\n";
                print ($page['jscode']) ? cleanOut($page['jscode']) : "";
                print "</div>\n";
            }
        } else {
            if ($this->slug) {
                if ($this->getPagePosts() === false) {
                    $page = $this->getPage();
                    if (!$page)
                        print _CONTENT_NOT_FOUND;
                    print "<h1 class=\"post-header\"><span>" . $page['title_en'] . "</span></h1>\n";
                    print "<div class=\"post-body\">" . cleanOut($page['body_en']) . "\n";
                    print ($page['jscode']) ? cleanOut($page['jscode']) : "";
                    print "</div>\n";
                }
            } elseif (isset($_GET['mode'])) {
                $this->getSitemap();
            }
            else {
                $this->getHomePage();
            }
        }
    }

    public function getEvents()
    {
        global $db, $pager, $core;

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();

        $counter = countEntries("mod_events");
        $pager->items_total = $counter;
        $pager->default_ipp = $core->perpage;
        $pager->paginate();

        if ($counter == 0) {
            $pager->limit = null;
        }
        $sql = "SELECT * FROM mod_events ORDER BY date_start" . $pager->limit;

        return $db->enableEscape()->fetch_all($sql);
    }

    public function countEventPages($limit)
    {
        global $db;
        $sql = "SELECT count(id) as count FROM mod_events";
        $count = $db->first($sql);
        return $count['count'] / $limit;
    }

    public function getEvent($id, $slug = null)
    {
        global $db;
        if ($slug !== null) {
            $sql = "SELECT * FROM mod_events WHERE slug='$slug'";
        } else {
            $id = intval($id);
            $sql = "SELECT * FROM mod_events WHERE id=$id";
        }
        return $db->first($sql);
    }

    public function getPRItems()
    {
        global $db, $pager, $core;

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();

        $counter = countEntries($this->ProomTable);
        $pager->items_total = $counter;
        $pager->default_ipp = $core->perpage;
        $pager->paginate();

        if ($counter == 0) {
            $pager->limit = null;
        }


        //  $page--;
        //   $page *= 10;
        $sql = "SELECT * FROM pressroom ORDER BY post_date" . $pager->limit;


        return $db->enableEscape()->fetch_all($sql);
    }


    public function getBelmartAlerts()
    {
        global $db, $pager, $core;

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();

        $counter = countEntries("belmaralerts");
        $pager->items_total = $counter;
        $pager->default_ipp = $core->perpage;
        $pager->paginate();

        if ($counter == 0) {
            $pager->limit = null;
        }

        $sql = "SELECT * FROM belmaralerts ORDER BY post_date" . $pager->limit;
        return $db->enableEscape()->fetch_all($sql);
    }

    public function countPRPages($limit)
    {
        global $db;
        $sql = "SELECT count(id) as count FROM pressroom";
        $count = $db->first($sql);
        return $count['count'] / $limit;
    }

    public function getPRItem($slug)
    {
        global $db;
        $sql = "SELECT * FROM pressroom WHERE slug = '$slug' ";
        return $db->first($sql);
    }


    public function getBelmaralertItem($slug)
    {
        global $db;
        $sql = "SELECT * FROM belmaralerts WHERE slug='$slug'";
        return $db->first($sql);
    }

    /**
     * Content::displayModule()
     *
     * @return
     */
    public function displayModule()
    {
        global $db, $core, $user, $pager;

        if (file_exists(MODDIR . $this->moduledata['modalias'] . '/main.php')) {
            require(MODDIR . $this->moduledata['modalias'] . '/main.php');
        } else {
            redirect_to(SITEURL);
        }
    }

    /**
     * Content::getPagePosts()
     *
     * @return
     */
    private function getPagePosts()
    {
        global $db, $core, $user, $pager;

        $sql = "SELECT * FROM posts"
            . "\n WHERE page_slug = '" . $this->slug . "'"
            . "\n AND active = '1'"
            . "\n ORDER BY position";
        $result = $db->fetch_all($sql);

        $sql2 = "SELECT p.*, m.modalias, m.active as mactive FROM posts as p"
            . "\n LEFT JOIN modules AS m ON m.id = '" . $this->module_id . "'"
            . "\n WHERE p.page_slug = '" . $this->slug . "'"
            . "\n AND p.active = '1'"
            . "\n AND m.system = '0'";
        $row2 = $db->first($sql2);

        if ($result) {
            if ($this->getAccess()) {
                foreach ($result as $row) {
                    if ($row['show_title'] == 1)
                        print "<h1 class=\"post-header\"><span>" . $row['title' . $core->dblang] . "</span></h1>\n";
                    print "<div class=\"post-body\">" . cleanOut($row['body' . $core->dblang]) . "\n";
                    print ($row['jscode']) ? cleanOut($row['jscode']) : "";
                    print "</div>\n";
                }

                if ($this->contact_form <> 0)
                    include("contact_form.php");

                if ($row2['mactive'] and file_exists(MODDIR . $row2['modalias'] . '/main.php')) {
                    include(MODDIR . $row2['modalias'] . '/main.php');
                }
            }
        } else
            return false;
    }

    /**
     * Content::getBreadcrumbs()
     *
     * @return
     */
    public function getBreadcrumbs()
    {
        global $db, $core;

        $pageid = ($this->slug) ? $this->slug : "";
        $data = ($this->modalias) ? $this->moduledata['title' . $core->dblang] : $pageid;

        return $data;
    }

    /**
     * Content::getAccess()
     *
     * @return
     */
    public function getAccess()
    {
        global $db, $user, $core;
        $m_arr = explode(",", $this->membership_id);
        reset($m_arr);

        switch ($this->access) {
            case "Registered":
                if (!$user->logged_in) {
                    $core->msgError(_UA_ACC_ERR1, false);
                    return false;
                } else
                    return true;
                break;

            case "Membership":
                if ($user->logged_in and $user->validateMembership() and in_array($user->membership_id, $m_arr)) {
                    return true;
                } else
                    $core->msgError(_UA_ACC_ERR2, false);
                return false;
                break;

            case "Public":
                return true;
                break;

            default:
                return true;
                break;
        }
    }

    /**
     * Content::getPages()
     *
     * @return
     */
    public function getPages($from = false, $section='')
    {
        global $db, $pager, $core, $user;

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();

        $notPermitted = $user->get_not_permitted_pages();
        $notPermittedCSV = implode(',', $notPermitted);
        if (empty($notPermittedCSV))
            $notPermittedCSV = '0';
        $counter = countEntries($this->pageTable . " WHERE id NOT IN ($notPermittedCSV)");
//        $counter = countEntries($this->pageTable);
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
            if (in_array($sort, array("title_en"))) {
                $ord = ($order == 'DESC') ? " DESC" : " ASC";
                $sorting = " u." . $sort . $ord;
            } else {
                $sorting = " u.title_en ASC";
            }
        } else {
            $sorting = " u.title_en ASC";
        }

        $clause = (isset($clause)) ? $clause : null;

        if (isset($_REQUEST['search'])) {
            $clause .= " WHERE u.title_en like '" . $_REQUEST['search'] . "%'";
        }
        if (isset($clause)) {
            $clause .= " AND u.id NOT IN ($notPermittedCSV) ";
        } else {
            $clause .= " WHERE u.id NOT IN ($notPermittedCSV) ";
        }
        
        if($section!='')
        	$clause .= " AND 1";


        $sql = "SELECT *, "
            . "\n  DATE_FORMAT(created, '" . $core->long_date . "') as date  FROM " . $this->pageTable . " as u"
            . "\n " . $clause
            . "\n ORDER BY " . $sorting . $pager->limit;


        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;
    }


    public function  getallalert($from = false)
    {

        global $db, $pager, $core;

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();

        $counter = countEntries("get_alerts");
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
            if (in_array($sort, array("fname", "lname", "email", "city", "state", "alertvia"))) {
                $ord = ($order == 'DESC') ? " DESC" : " ASC";
                $sorting = " u." . $sort . $ord;
            } else {
                $sorting = " u.fname DESC";
            }
        } else {
            $sorting = " u.fname DESC";
        }

        $clause = (isset($clause)) ? $clause : null;

        if (isset($_REQUEST['search'])) {

            $clause = " WHERE (u.fname like '%" . $_REQUEST['search'] . "%' OR u.lname like '%" . $_REQUEST['search'] . "%' OR u.email like '%" . $_REQUEST['search'] . "%'  OR u.city like '%" . $_REQUEST['search'] . "%'  OR u.state like '%" . $_REQUEST['search'] . "%' )";

        }

        $sql = "SELECT * "
            . "\n    FROM get_alerts as u"
            . "\n " . $clause
            . "\n ORDER BY " . $sorting . $pager->limit;


        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;

    }


    public function  getalloptlist($from = false)
    {
        global $db, $pager, $core;
        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();

        $counter = countEntries("get_alerts", "active", "0");
        $counter += countEntries("mailing_list", "active", "0");
        $pager->items_total = $counter;
        $pager->items_per_page = $core->perpage;
        $pager->default_ipp = $core->perpage;
        $pager->paginate();

        if ($counter == 0) {
            $pager->limit = 0;
            return array();
        }

        if (isset($_GET['sort'])) {
            list($sort, $order) = explode("-", $_GET['sort']);
            $sort = sanitize($sort);
            $order = sanitize($order);
        } else {
            $sort = "fname";
            $order = "DESC";
        }


        if (isset($_REQUEST['search'])) {
            $clause = "where fname like '" . $_REQUEST['search'] . "%'";
        }


        $var = explode(' ', $pager->limit);
        $var = $var[2];
        $var = explode(',', $var);
        $skip = $var[0];
        $limit = $var[1];


        $clause = (isset($clause)) ? $clause . " AND active=0" : "WHERE active=0";

        $sql = "SELECT fname , lname , email FROM get_alerts $clause ";
        $row1 = $db->fetch_all($sql);
        foreach ($row1 as &$row11) {
            $row11['table'] = 'get_alerts';
        }
        $sql = "SELECT fname , lname , email FROM mailing_list $clause ";
        $row2 = $db->fetch_all($sql);
        foreach ($row2 as &$row21) {
            $row21['table'] = 'mailing_list';
        }
        $rows = array_merge($row1, $row2);

        $dir = $order == "ASC" ? true : false;
        $rows = sortByOneKey($rows, $sort, $dir);
        $res = array();
        foreach ($rows as $row) {
            $res[] = $row;
        }

        $res = array_slice($res, $skip, $limit);

        return ($res) ? $res : 0;

    }


    public function getalertFilter()
    {
        $arr = array(
            'fname-ASC' => 'First Name' . ' &uarr;',
            'fname-DESC' => 'First Name' . ' &darr;',

            'lname-ASC' => 'Last Name' . ' &uarr;',
            'lname-DESC' => 'Last Name' . ' &darr;',

            'email-ASC' => 'Email' . ' &uarr;',
            'email-DESC' => 'Email' . ' &darr;',

            'city-ASC' => 'City' . ' &uarr;',
            'city-DESC' => 'City' . ' &darr;',

            'state-ASC' => 'State' . ' &uarr;',
            'state-DESC' => 'State' . ' &darr;',

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


    public function getoutlistFilter()
    {
        $arr = array(
            'fname-ASC' => _Press_opt_out_fname . ' &uarr;',
            'fname-DESC' => _Press_opt_out_fname . ' &darr;',


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

    public static function getallmenus()
    {
        global $db;
        $sql = "SELECT * FROM menus ";
        $deps = $db->fetch_all($sql);

        return $deps;
    }


    /**
     * Content::getModuleList()
     *
     * @param bool $sel
     * @return
     */
    public function getModuleList($sel = false)
    {
        global $db, $core;

        $sql = "SELECT id, modalias, title{$core->dblang} FROM modules"
            . "\n WHERE active = '1' AND hasconfig = '1' AND system = '0' ORDER BY title{$core->dblang}";
        $sqldata = $db->fetch_all($sql);

        $data = '';
        $data .= '<select name="module_id" style="width:200px" class="custombox" id="modulename">';
        $data .= "<option value=\"0\"> --- No Module Assigned---</option>\n";
        foreach ($sqldata as $val) {
            if ($val['id'] == $sel) {
                $data .= "<option selected=\"selected\" value=\"" . $val['id'] . "\">" . $val['title' . $core->dblang] . "</option>\n";
            } else
                $data .= "<option value=\"" . $val['id'] . "\">" . $val['title' . $core->dblang] . "</option>\n";
        }
        unset($val);
        $data .= "</select>";
        return $data;
    }

    /**
     * Content::displayMenuModule()
     *
     * @return
     */
    public function displayMenuModule()
    {
        global $db, $core;

        $sql = "SELECT id, title{$core->dblang} FROM modules"
            . "\n WHERE active = '1' AND system = '1' ORDER BY title{$core->dblang}";
        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    /**
     * Content::getSitemap()
     *
     * @return
     */
    private function getSitemap()
    {
        global $db, $core;

        $sql = "SELECT pt.*, pt.id as id, pg.id as pageid, pg.title" . $core->dblang . " as pagetitle, pg.slug as pgslug"
            . "\n FROM posts AS pt"
            . "\n LEFT JOIN pages AS pg ON pg.id = pt.page_id"
            . "\n WHERE pg.access = 'Public' AND pg.active = 1"
            . "\n ORDER BY pt.page_id, pt.position";
        $pagerow = $db->fetch_all($sql);

        print "<h1><span>" . $core->site_name . "  - " . _SM_SITE_MAP . "</span></h1>";
        print "The " . $core->site_name . " " . _SM_SITE_MAP_TITLE;
        print "<div class=\"sitemap\">";
        foreach ($pagerow as $row) {
            print "<div class=\"inner\">";
            print "<h3><a href=\"" . createPageLink($row['pgslug']) . "\">" . $row['pagetitle'] . "</a></h3>";
            print "<h4>" . $row['title' . $core->dblang] . "</h4>";
            $body = cleanOut($row['body' . $core->dblang]);
            print "<p>" . sanitize($body, 200) . "</p>";
            print "</div>";
            print "<hr />";
        }
        print "</div>";
    }

    /**
     * Content::processPage()
     *
     * @return
     */
    public function processPage()
    {
        global $db, $core, $hollysec, $user;

        if ($this->pageid) {
            $notPermitted = $user->get_not_permitted_pages();
            if (in_array_recursive($this->pageid, $notPermitted)) {
                $core->msgs['title'] = "You do not have permission to do this.";
            }
        }

        if (empty($_POST['title' . $core->dblang]))
            $core->msgs['title'] = _PG_TITLE_R;


        if (empty($core->msgs)) {
            $data = array(
                'title' . $core->dblang => sanitize($_POST['title' . $core->dblang]),
                'keywords' . $core->dblang => sanitize($_POST['keywords' . $core->dblang]),
                'description' . $core->dblang => sanitize($_POST['description' . $core->dblang]),
                'body' . $core->dblang => $core->in_url($_POST['body' . $core->dblang]),
                'jscode' => $_POST['jscode'],
                'slug' => (empty($_POST['slug'])) ? paranoia($_POST['title' . $core->dblang]) : paranoia($_POST['slug']),
                //'module_id' => intval($_POST['module_id']),
                'module_data' => (isset($_POST['module_data'])) ? intval($_POST['module_data']) : 0,
                // 'module_name' => getValue("modalias","modules","id='".intval($_POST['module_id'])."'"),
                // 'contact_form' => intval($_POST['contact_form']),
                // 'access' => sanitize($_POST['access']),
                'active' => intval($_POST['active'])
            );

            if (isset($_POST['membership_id'])) {
                $mids = $_POST['membership_id'];
                $total = count($mids);
                $i = 1;
                if (is_array($mids)) {
                    $midata = '';
                    foreach ($mids as $mid) {
                        if ($i == $total) {
                            $midata .= $mid;
                        } else
                            $midata .= $mid . ",";
                        $i++;
                    }
                }
                $data['membership_id'] = $midata;
            } else {
            }
            //$data['membership_id'] = 0;

            /* if ($data['contact_form'] == 1) {
                     $contactform['contact_form'] = "DEFAULT(contact_form)";
                     $db->update("pages", $contactform);
                 }*/

            if (!$this->pageid) {
                $data['created'] = "NOW()";
            }

            if ($this->pageid) {
                $sdata['page_slug'] = $data['slug'];
                $db->update("layout", $sdata, "page_id='" . (int)$this->pageid . "'");
                $db->update("menus", $sdata, "page_id='" . (int)$this->pageid . "'");
                $db->update("posts", $sdata, "page_id='" . (int)$this->pageid . "'");
            }

            ($this->pageid) ? $db->update("pages", $data, "id='" . (int)$this->pageid . "'") : $db->insert("pages", $data);
            $message = ($this->pageid) ? _PG_UPDATED : _PG_ADDED;

            ($db->affected()) ? $hollysec->writeLog($message, "", "no", "content") . $core->msgOk($message) : $core->msgAlert(_SYSTEM_PROCCESS);
        } else
            print $core->msgStatus();
    }

    /**
     * Content::getPosts()
     *
     * @return
     */
    public function getPosts()
    {
        global $db;

        $where = ($this->pageid) ? "WHERE page_id = '" . $this->pageid . "'" : null;
        $sql = "SELECT * FROM posts"
            . "\n {$where}"
            . "\n ORDER BY position";
        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    /**
     * Content::getPagePost()
     *
     * @return
     */
    public function getPagePost()
    {
        global $db, $core, $pager;

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();

        $counter = countEntries("posts");
        $pager->items_total = $counter;
        $pager->default_ipp = $core->perpage;
        $pager->paginate();

        if ($counter == 0) {
            $pager->limit = null;
        }

        $where = ($this->pageid) ? "WHERE page_id = '" . $this->pageid . "'" : NULL;
        $sql = "SELECT pt.*, pt.id as id, pg.id as pageid, pg.title" . $core->dblang . " as pagetitle, pg.slug as pgslug"
            . "\n FROM posts AS pt"
            . "\n LEFT JOIN pages AS pg ON pg.id = pt.page_id"
            . "\n $where"
            . "\n ORDER BY pt.page_id, pt.position" . $pager->limit;
        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    /**
     * Content::processPost()
     *
     * @return
     */
    public function processPost()
    {
        global $db, $core, $hollysec;

        if (empty($_POST['title' . $core->dblang]))
            $core->msgs['title'] = _PO_TITLE_R;

        if (empty($core->msgs)) {
            $data = array(
                'title' . $core->dblang => sanitize($_POST['title' . $core->dblang]),
                'page_id' => intval($_POST['page_id']),
                'page_slug' => getValue("slug", "pages", "id = '" . intval($_POST['page_id']) . "'"),
                'show_title' => intval($_POST['show_title']),
                'body' . $core->dblang => $core->in_url($_POST['body' . $core->dblang]),
                'jscode' => $_POST['jscode'],
                'active' => intval($_POST['active'])
            );

            ($this->postid) ? $db->update("posts", $data, "id='" . (int)$this->postid . "'") : $db->insert("posts", $data);
            $message = ($this->postid) ? _PO_UPDATED : _PO_ADDED;

            ($db->affected()) ? $hollysec->writeLog($message, "", "no", "content") . $core->msgOk($message) : $core->msgAlert(_SYSTEM_PROCCESS);
        } else
            print $core->msgStatus();
    }

    /**
     * Content::getPagePlugins()
     *
     * @return
     */
    public function getPagePlugins()
    {
        global $db, $core, $pager;

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();

        $counter = countEntries("plugins");
        $pager->items_total = $counter;
        $pager->default_ipp = $core->perpage;
        $pager->paginate();

        if ($counter == 0) {
            $pager->limit = null;
        }

        $sql = "SELECT *, DATE_FORMAT(created, '" . $core->long_date . "') as date"
            . "\n FROM plugins"
            . "\n ORDER BY hasconfig DESC, title" . $core->dblang . $pager->limit;
        ;
        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    /**
     * Content::processPlugin()
     *
     * @return
     */
    public function processPlugin()
    {
        global $db, $core, $hollysec;

        if (empty($_POST['title' . $core->dblang]))
            $core->msgs['title'] = _PL_TITLE_R;

        if (empty($core->msgs)) {
            $data = array(
                'title' . $core->dblang => sanitize($_POST['title' . $core->dblang]),
                'show_title' => intval($_POST['show_title']),
                'alt_class' => sanitize($_POST['alt_class']),
                'body' . $core->dblang => $core->in_url($_POST['body' . $core->dblang]),
                'info' . $core->dblang => sanitize($_POST['info' . $core->dblang]),
                'jscode' => isset($_POST['jscode']) ? $_POST['jscode'] : "NULL",
                'active' => intval($_POST['active'])
            );

            if (!$this->id) {
                $data['created'] = "NOW()";
            }

            ($this->id) ? $db->update("plugins", $data, "id='" . (int)$this->id . "'") : $db->insert("plugins", $data);
            $message = ($this->id) ? _PL_UPDATED : _PL_ADDED;

            ($db->affected()) ? $hollysec->writeLog($message, "", "no", "plugin") . $core->msgOk($message) : $core->msgAlert(_SYSTEM_PROCCESS);
        } else
            print $core->msgStatus();
    }

    /**
     * Content::getPageModules()
     *
     * @return
     */
    public function getPageModules()
    {
        global $db, $core, $pager;

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();

        $counter = countEntries("modules");
        $pager->items_total = $counter;
        $pager->default_ipp = $core->perpage;
        $pager->paginate();

        if ($counter == 0) {
            $pager->limit = null;
        }

        $sql = "SELECT *, DATE_FORMAT(created, '" . $core->long_date . "') as date"
            . "\n FROM modules"
            . "\n ORDER BY title" . $core->dblang . $pager->limit;
        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    /**
     * Content::processModule()
     *
     * @return
     */
    public function processModule()
    {
        global $db, $core, $hollysec;

        if (empty($_POST['title' . $core->dblang]))
            $core->msgs['title'] = _MO_TITLE_R;

        if (empty($core->msgs)) {
            $data = array(
                'title' . $core->dblang => sanitize($_POST['title' . $core->dblang]),
                'info' . $core->dblang => sanitize($_POST['info' . $core->dblang]),
                'theme' => (isset($_POST['theme']) and !empty($_POST['theme'])) ? sanitize($_POST['theme']) : 'NULL',
                'metakey' . $core->dblang => sanitize($_POST['metakey' . $core->dblang]),
                'metadesc' . $core->dblang => sanitize($_POST['metadesc' . $core->dblang])
            );

            $db->update("modules", $data, "id='" . (int)$this->id . "'");
            ($db->affected()) ? $hollysec->writeLog(_MO_UPDATED, "", "no", "module") . $core->msgOk(_MO_UPDATED) : $core->msgAlert(_SYSTEM_PROCCESS);
        } else
            print $core->msgStatus();
    }

    /**
     * Content::getAvailablePlugins()
     *
     * @return
     */
    public function getAvailablePlugins()
    {
        global $db;
        $pageid = ($this->pageid) ? "page_id='" . $this->pageid . "'" : "page_id='" . $this->homeid . "'";
        $data = (isset($_GET['modid'])) ? "mod_id='" . intval($_GET['modid']) . "'" : $pageid;

        $sql = "SELECT * FROM plugins"
            . "\n WHERE id NOT IN (SELECT plug_id FROM layout"
            . "\n WHERE $data)";
        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    /**
     * Content::getPluginName()
     *
     * @param mixed $name
     * @return
     */
    public function getPluginName($name)
    {
        global $db, $core;
        $name = sanitize($name);
        $sql = "SELECT title{$core->dblang} FROM plugins"
            . "\n WHERE plugalias = '" . $db->escape($name) . "'";
        $row = $db->first($sql);

        return ($row) ? $row['title' . $core->dblang] : "NA";
    }

    /**
     * Content::getModuleName()
     *
     * @param mixed $name
     * @return
     */
    public function getModuleName($name)
    {
        global $db, $core;
        $name = sanitize($name);
        $sql = "SELECT title{$core->dblang} FROM modules"
            . "\n WHERE modalias = '" . $db->escape($name) . "'";
        $row = $db->first($sql);

        return ($row) ? $row['title' . $core->dblang] : "NA";
    }

    /**
     * Content::getModuleMetaData()
     *
     * @return
     */
    public function getModuleMetaData()
    {
        global $db, $core;

        $sql = "SELECT * FROM modules"
            . "\n WHERE modalias = '" . $this->modalias . "'"
            . "\n AND active = 1 AND system = 1";
        $row = $db->first($sql);

        return $this->moduledata = $row;
    }

    /**
     * Content::getLayoutOptions()
     *
     * @return
     */
    public function getLayoutOptions()
    {
        global $db, $core;

        $pageid = ($this->pageid) ? "l.page_id='" . $this->pageid . "'" : "l.page_id='" . $this->homeid . "'";
        $data = (isset($_GET['modid'])) ? "l.mod_id='" . intval($_GET['modid']) . "'" : $pageid;

        $sql = "SELECT l.*, p.id as plid, p.title{$core->dblang}"
            . "\n FROM layout AS l"
            . "\n INNER JOIN plugins AS p ON p.id = l.plug_id"
            . "\n WHERE $data"
            . "\n ORDER BY l.position ASC, p.title{$core->dblang} ASC";
        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    /**
     * Content::getPluginLayout()
     *
     * @param mixed $place
     * @param bool $modalias
     * @return
     */
    public function getPluginLayout($place, $modalias = false)
    {
        global $db, $core;

        $pageid = ($this->slug) ? "l.page_slug = '" . $this->slug . "'" : "l.page_slug = '" . $this->homeslug . "'";
        $data = ($modalias) ? "l.modalias = '" . $this->modalias . "'" : $pageid;

        $sql = "SELECT l.*, p.id as plid, p.title{$core->dblang}, p.body{$core->dblang}, p.plugalias, p.hasconfig, p.system, p.show_title, p.alt_class, p.jscode"
            . "\n FROM layout AS l"
            . "\n LEFT JOIN plugins AS p ON p.id = l.plug_id"
            . "\n WHERE l.place = '" . $place . "'"
            . "\n AND {$data}"
            . "\n AND p.active = '1'"
            . "\n ORDER BY l.position ASC";
        $row = $db->fetch_all($sql);

        return ($row) ? $row : null;

    }

    /**
     * Content::getPluginAssets()
     *
     * @return
     */
    public function getPluginAssets()
    {
        global $db, $core;

        $pageid = ($this->slug) ? "l.page_slug = '" . $this->slug . "'" : "l.page_slug = '" . $this->homeslug . "'";
        $data = ($this->modalias) ? "l.modalias = '" . $this->modalias . "'" : $pageid;

        $sql = "SELECT l.*,  p.plugalias"
            . "\n FROM layout AS l"
            . "\n LEFT JOIN plugins AS p ON p.id = l.plug_id"
            . "\n WHERE {$data}"
            . "\n AND p.system = '1'"
            . "\n AND p.active = '1'";
        $result = $db->fetch_all($sql);

        if ($result) {
            foreach ($result as $row) {
                $tcssfile = PLUGDIR . $row['plugalias'] . "/theme/" . $core->theme . "/style.css";
                $tjsfile = PLUGDIR . $row['plugalias'] . "/theme/" . $core->theme . "/script.js";

                $cssfile = PLUGDIR . $row['plugalias'] . "/style.css";
                $jsfile = PLUGDIR . $row['plugalias'] . "/script.js";

                if (is_file($tcssfile)) {
                    print "<link href=\"" . SITEURL . "/plugins/" . $row['plugalias'] . "/theme/" . $core->theme . "/style.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
                } elseif (is_file($cssfile)) {
                    print "<link href=\"" . SITEURL . "/plugins/" . $row['plugalias'] . "/style.css\" rel=\"stylesheet\" type=\"text/css\" />\n";

                }

                if (is_file($tjsfile)) {
                    print "<script type=\"text/javascript\" src=\"" . SITEURL . "/plugins/" . $row['plugalias'] . "/theme/" . $core->theme . "/script.js\"></script>\n";
                } elseif (is_file($jsfile)) {
                    print "<script type=\"text/javascript\" src=\"" . SITEURL . "/plugins/" . $row['plugalias'] . "/script.js\"></script>\n";
                }

            }
        }
    }

    /**
     * Content::getModuleAssets()
     *
     * @return
     */
    public function getModuleAssets()
    {
        if ($this->modalias) {
            $cssfile = MODDIR . $this->modalias . "/style.css";
            $jsfile = MODDIR . $this->modalias . "/script.js";

            if (file_exists($cssfile))
                print "<link href=\"" . SITEURL . "/modules/" . $this->modalias . "/style.css\" rel=\"stylesheet\" type=\"text/css\" />\n";

            if (file_exists($jsfile))
                print "<script type=\"text/javascript\" src=\"" . SITEURL . "/modules/" . $this->modalias . "/script.js\"></script>\n";

        } elseif ($this->module_name != '' or $this->module_id <> 0) {
            $cssfile = MODDIR . $this->module_name . "/style.css";
            $jsfile = MODDIR . $this->module_name . "/script.js";

            if (file_exists($cssfile))
                print "<link href=\"" . SITEURL . "/modules/" . $this->module_name . "/style.css\" rel=\"stylesheet\" type=\"text/css\" />\n";

            if (file_exists($jsfile))
                print "<script type=\"text/javascript\" src=\"" . SITEURL . "/modules/" . $this->module_name . "/script.js\"></script>\n";
        }
    }

    /**
     * Content::getMenuTree()
     *
     * @return
     */
    protected function getMenuTree()
    {

        global $db, $core, $user;
        if ($user->userlevel==0) return;
        $query = $db->query('SELECT * FROM menus WHERE id <>2 ORDER BY parent_id, position');

        $permitted = $user->get_permitted_menus();
        while ($row = $db->fetch($query)) {
            if (!in_array_recursive($row['id'], $permitted))
                continue;
            $this->menutree[$row['id']] = array(
                'id' => $row['id'],
                'name' . $core->dblang => $row['name' . $core->dblang],
                'parent_id' => $row['parent_id']
            );
        }
        return $this->menutree;
    }

    /**
     * Content::getMenuList()
     *
     * @return
     */
    public function getMenuList()
    {
        global $db, $core;
        $query = $db->query("SELECT *"
            . "\n FROM menus "
            . "\n WHERE active = '1'"
            . "\n ORDER BY parent_id, position");

        while ($row = $db->fetch($query)) {
            $menulist[$row['id']] = array(
                'id' => $row['id'],
                'name' . $core->dblang => $row['name' . $core->dblang],
                'parent_id' => $row['parent_id'],
                'page_id' => $row['page_id'],
                'mod_id' => $row['mod_id'],
                'content_type' => $row['content_type'],
                'file_upload' => $row['file_upload'],
                'link' => $row['link'],
                'home_page' => $row['home_page'],
                'active' => $row['active'],
                'target' => $row['target'],
                'icon' => $row['icon'],
                'pslug' => $row['page_slug']
            );
        }
        return $menulist;
    }

    /**
     * Content::getSortMenuList()
     *
     * @param integer $parent_id
     * @return
     */
    public function getSortMenuList($parent_id = 0)
    {
        global $core, $user;

        $submenu = false;
        $class = ($parent_id == 0) ? "parent" : "child";

        $permitted = $user->get_permitted_menus();
//        print_r($permitted);
        foreach ($this->menutree as $key => $row) {
            if (!in_array_recursive($row['id'], $permitted)) {
                continue;
            }
            if ($row['parent_id'] == $parent_id) {
                if ($submenu === false) {
                    $submenu = true;
                    print "<ul>\n";
                }

                $delete = $row['parent_id'] != 0 ? '<img src="images/delete.png" alt="" class="tooltip" title="' . _DELETE . '"/></a>' : '';
                $toPrint = '<li id="list_' . $row['id'] . '">'
                    . '<div><a href="javascript:void(0)" id="item_' . $row['id'] . '" rel="' . $row['name' . $core->dblang] . '" class="delete">'
                    . $delete
                    . '<a href="index.php?do=menus&amp;action=edit&amp;id=' . $row['id'] . '" class="' . $class . '">' . $row['name' . $core->dblang] . '</a></div>';

                print $toPrint;
                $this->getSortMenuList($key);
                print "</li>\n";
            }
        }
        unset($row);

        if ($submenu === true)
            print "</ul>\n";
    }


    private function _prepare_menu_array($array)
    {
        $tmpArray = Array();
        foreach ($array as $value) {
            $tmpArray[$value['parent_id']][] = $value['id'];
        }
        return $tmpArray;

    }

    public function getMenuBU($array, $parent_id = 0, $menuID, $submenu = false)
    {

        if ($this->map == false) $this->map = $this->_prepare_menu_array($array);

        echo "<ul>";

        foreach ($array as $menu) {
            if ($menu['parent_id'] != $parent_id)
                continue;

            $hasChildren = 0;
            if (array_key_exists($menu['id'], $this->map))
                $hasChildren = 1;

            echo "<li>";
            $icon = 'theme/belmar/images/icon-down-arrow.png';
            if (!empty($menu['icon'])) {
                $icon = SITEURL . "/uploads/menuicons/" . $menu['icon'];
            }
            $arrow = $hasChildren ? "<img style='float: right;' src='$icon' />" : (!empty($menu['icon'])? "<img style='float: right;' src='".SITEURL . "/uploads/menuicons/"  . $menu['icon'] ."' />":"" );
            switch ($menu['content_type']) {
                case 'page':
                    echo "<a href='" . SITEURL . "/" . $menu['pslug'] . ".html' >" . $menu['name_en'] . $arrow . " </a>";
                    break;
                case 'web':
                    echo "<a href='http://" . $menu['link'] . "' target='{$menu['target']}' >" . $menu['name_en'] . $arrow . " </a>";
                    break;
                case 'file_upload_name':
                    echo "<a href='" . SITEURL . "/download.php?file=" . $menu['file_upload'] . "' >" . $menu['name_en'] . $arrow . " </a>";
                    break;
            }

            echo "</li>";

            if ($hasChildren && ($menu['id'] == $menuID || $menu['id'] == getMenuID(getSlugFromMenuID($menuID)) || $menu['id'] == getMenuID(getSlugFromMenuID(getMenuID(getSlugFromMenuID($menuID)))))) {
                echo "<ul style='background-color:#89ADBF;width: 100%;list-style-type: none;margin: 0;padding: 0;'>";
                foreach ($array as $smenu) {
                    if ($smenu['parent_id'] != $menu['id']) {
                        continue;
                    }
                    $hasChildren = (array_key_exists($smenu['id'], $this->map)) ? 1 : 0;
                    echo "<li>";
                    $icon = 'theme/belmar/images/icon-down-arrow.png';
                    if (!empty($smenu['icon'])) {
                        $icon = SITEURL . "/uploads/menuicons/" . $smenu['icon'];
                    }
                    $arrow = $hasChildren ? "<img style='float: right;' src='$icon' />" : (!empty($smenu['icon'])? "<img style='float: right;' src='".SITEURL . "/uploads/menuicons/"  . $smenu['icon'] ."' />":"" );
                    switch ($smenu['content_type']) {
                        case 'page':
                            echo "<a href='" . SITEURL . "/" . $smenu['pslug'] . ".html' >" . $smenu['name_en'] . $arrow . " </a>";
                            break;
                        case 'web':
                            echo "<a href='http://" . $smenu['link'] . "' target='{$smenu['target']}' >" . $smenu['name_en'] . $arrow . " </a>";
                            break;
                        case 'file_upload_name':
                            echo "<a href='" . SITEURL . "/download.php?file=" . $smenu['file_upload'] . "' >" . $smenu['name_en'] . $arrow . " </a>";
                            break;
                    }
                    echo "</li>";
                    if ($hasChildren && ($smenu['id'] == $menuID || $smenu['id'] == getMenuID(getSlugFromMenuID($menuID)))) {
                        echo "<ul style='background-color:#7ac3e7 ;width: 100%;list-style-type: none;margin: 0;padding: 0;'>";
                        foreach ($array as $ssmenu) {
                            if ($ssmenu['parent_id'] != $smenu['id']) {
                                continue;
                            }
                            echo "<li>";
                            $icon = 'theme/belmar/images/icon-down-arrow.png';
                            if (!empty($ssmenu['icon'])) {
                                $icon = SITEURL . "/uploads/menuicons/" . $ssmenu['icon'];
                            }
                            $arrow = $hasChildren ? "<img style='float: right;' src='$icon' />" : (!empty($ssmenu['icon'])? "<img style='float: right;' src='".SITEURL . "/uploads/menuicons/"  . $ssmenu['icon'] ."' />":"" );
                            switch ($ssmenu['content_type']) {
                                case 'page':
                                    echo "<a href='" . SITEURL . "/" . $ssmenu['pslug'] . ".html' >" . $ssmenu['name_en'] . $arrow . " </a>";
                                    break;
                                case 'web':
                                    echo "<a href='http://" . $ssmenu['link'] . "' target='{$ssmenu['target']}' >" . $ssmenu['name_en'] . $arrow . " </a>";
                                    break;
                                case 'file_upload_name':
                                    echo "<a href='" . SITEURL . "/download.php?file=" . $ssmenu['file_upload'] . "' >" . $ssmenu['name_en'] . $arrow . " </a>";
                                    break;
                            }
                            echo "</li>";
                        }
                        echo "</ul>";
                    }
                }

                echo "</ul>";
            }
        }
        echo "</ul>";

    }

    public function getMenuRecursive($array, $parent_id = 0, $menuID = false, $level = 0)
    {
        global $core, $db;


        $submenu = $array;
        if ($this->map == false) $this->map = $this->_prepare_menu_array($array);
        //print_r($map);die;

        if ($level > 0 && array_key_exists($menuID, $this->map)) {

            $submenu_ = $this->map[$menuID];
            $submenu_content = array();
            foreach ($submenu_ as $_id) {
                $submenu_content[$_id] = $array[$_id];

            }
            $submenu = $submenu_content;

        } else if ($level > 0 && !array_key_exists($menuID, $this->map)) {
            return '';

        }


        echo "<ul>";

        foreach ($submenu as $menu) {
            if ($menu['parent_id'] != $parent_id)
                continue;
            $hasChildren = array_key_exists($menu['id'], $this->map);


            echo "<li>";
            $arrow = $hasChildren ? "<img style='float: right;' src='theme/belmar/images/icon-down-arrow.png' />" : "";
            echo "<a href='" . SITEURL . "/" . $menu['pslug'] . ".html' >" . $menu['name_en'] . $arrow . " </a>";
            if ($level == 0 || $hasChildren) $this->getMenuBU($array, $parent_id, $menu['id'], ++$level);
            echo "</li>";


        }
        echo "</ul>";

    }


    /**
     * Content::getMenu()
     *
     * @param mixed $array
     * @param integer $parent_id
     * @return
     */
    public function getMenuOriginal($array, $parent_id = 0)
    {
        global $core, $db;
        $submenu = false;
        $arrow = "";

        foreach ($array as $key => $row) {

            if ($row['parent_id'] == $parent_id) {
                if ($submenu === false) {
                    $submenu = true;

                    print "<ul class='arrow'>\n";
                }

                $url = ($core->seo == 1) ? $core->site_url . '/' . sanitize($row['pslug'], 50) . '.html' : $url = $core->site_url . '/content.php?pagename=' . sanitize($row['pslug'], 50);
                $active = ($row['pslug'] == $this->slug) ? " class=\"active\"" : "";
                $mactive = ($row['pslug'] == $this->modalias) ? " class=\"active\"" : "";
                $homeactive = (preg_match('/index.php/', $_SERVER['PHP_SELF'])) ? " class=\"active\"" : "";
                $icon = ($row['icon']) ? '<img src="' . UPLOADURL . 'menuicons/' . $row['icon'] . '" alt="" class="menuicon" />' : "";


                switch ($row['content_type']) {
                    case 'module':
                        $murl = ($core->seo == 1) ? $core->site_url . '/content/' . sanitize($row['pslug'], 50) . '/' : $murl = $core->site_url . '/modules.php?module=' . $row['pslug'];
                        $link = '<li' . $mactive . '><a href="' . $murl . '"><span>' . $icon . $arrow . $row['name' . $core->dblang] . '</span></a>';
                        break;

                    case 'page':
                        ($row['home_page'] == 1) ? $link = '<li' . $homeactive . '><a href="' . SITEURL . '/index.php"><span>' . $icon . $arrow . $row['name' . $core->dblang] . '</span></a>' :
                            $link = '<li' . $active . '><a href="' . $url . '"><span>' . $icon . $row['name' . $core->dblang] . $arrow . '</span></a>';
                        break;

                    case 'web':
                        $link = '<li><a href="' . $row['link'] . '" target="' . $row['target'] . '"><span>' . $icon . $arrow . $row['name' . $core->dblang] . '</span></a>';
                        break;
                }

                print $link;
                print "</li>\n";
                $this->getMenu($array, $key);
            }
        }
        unset($row);

        if ($submenu === true)
            print "</ul>\n";
    }

    public function getGalsList()
    {
        global $db;
        $sql = "SELECT id FROM menus WHERE slug = '" . $this->slug . "'";
        $id = $db->first($sql);
        if (empty($id))
            return;
        $id = $id['id'];
        $sql = "SELECT * from mod_gallery_config WHERE menu_id = $id and published =1";
        $gals = $db->fetch_all($sql);
        foreach ($gals as $gal) {
            echo "<li><a href='" . SITEURL . "'>" . $gal['title_en'] . "</a></li>";
        }
    }

    /**
     * Content::getMenuDropList()
     *
     * @param mixed $parent_id
     * @param integer $level
     * @param mixed $spacer
     * @param bool $selected
     * @return
     */
    public function getMenuDropList($parent_id, $level = 0, $spacer, $selected = false)
    {
        global $core;
        foreach ($this->menutree as $key => $row) {
            $sel = ($row['id'] == $selected) ? " selected=\"selected\"" : "";
            if ($parent_id == $row['parent_id']) {
                print "<option value=\"" . $row['id'] . "\"" . $sel . ">";

                for ($i = 0; $i < $level; $i++)
                    print $spacer;

                print $row['name' . $core->dblang] . "</option>\n";
                $level++;
                $this->getMenuDropList($key, $level, $spacer, $selected);
                $level--;
            }
        }
        unset($row);
    }

    /**
     * Content::processMenu()
     *
     * @return
     */
    public function processMenu()
    {
        global $db, $core, $hollysec;
        $canNotMove = array(2,30,31,32,33,34,35,29,24,27,28,41,42);
        if (empty($_POST['name' . $core->dblang]))
            $core->msgs['name'] = _MU_NAME_R;

        if ($_POST['content_type'] == "NA")
            $core->msgs['content_type'] = _MU_TYPE_R;

        if(isset($_POST['id']) && in_array($_POST['id'],$canNotMove)) {
            $core->msgs['content_type'] = _MU_CANT_MOVE;
        }
        if (empty($core->msgs)) {
            $data = array(
                'name' . $core->dblang => sanitize($_POST['name' . $core->dblang]),
                'parent_id' => intval($_POST['parent_id']),
                'page_id' => (isset($_POST['page_id'])) ? intval($_POST['page_id']) : "DEFAULT(page_id)",
//                'page_slug' => (isset($_POST['page_id'])) ? getValue("slug", "pages","id = '".intval($_POST['page_id'])."'") : getValue("modalias", "modules","id = '".intval($_POST['mod_id'])."'"),
                'page_slug' => (isset($_POST['page_id'])) ? getValue("slug", "pages", "id = '" . intval($_POST['page_id']) . "'") : getValue("modalias", "modules", "id = '" . intval($_POST['mod_id']) . "'"),
                'mod_id' => (isset($_POST['mod_id'])) ? intval($_POST['mod_id']) : "DEFAULT(mod_id)",
                'slug' => paranoia($_POST['name' . $core->dblang]),
                'content_type' => sanitize($_POST['content_type']),
                'link' => (isset($_POST['web'])) ? sanitize($_POST['web']) : "NULL",
                'target' => (isset($_POST['target'])) ? sanitize($_POST['target']) : "DEFAULT(target)",
                'icon' => (isset($_POST['icon'])) ? sanitize($_POST['icon']) : "NULL",
                'file_upload' => (isset($_POST['fileuploadname'])) ? sanitize($_POST['fileuploadname']) : "NULL",
                //'home_page' => intval($_POST['home_page']),
                'iconposition' => sanitize($_POST['iconposition']),
                'active' => intval($_POST['active'])
            );

//			  if ($data['home_page'] == 1) {
//				  $home['home_page'] = "DEFAULT(home_page)";
//				  $db->update("menus", $home);
//			  }

            ($this->id) ? $db->update("menus", $data, "id='" . (int)$this->id . "'") : $db->insert("menus", $data);
            $message = ($this->id) ? _MU_UPDATED : _MU_ADDED;

            ($db->affected()) ? $hollysec->writeLog($message, "", "no", "content") . $core->msgOk($message) : $core->msgAlert(_SYSTEM_PROCCESS);

        } else
            print $core->msgStatus();
    }

    /**
     * Content::getMenuIcons()
     *
     * @return
     */
    function getMenuIcons($selected = false)
    {
        $path = UPLOADS . 'menuicons/';
        checkDir($path);
        $res = '';
        $handle = opendir($path);
        $class = 'odd';
        while (false !== ($file = readdir($handle))) {
            $class = ($class == 'even' ? 'odd' : 'even');
            if ($file != "." && $file != ".." && $file != "_notes" && $file != "index.php" && $file != "blank.png") {
                $sel = ($selected == $file) ? ' sel' : '';
                $res .= "<div class=\"" . $class . $sel . "\">";
                if ($selected == $file) {
                    $res .= "<input type=\"radio\" name=\"icon\" value=\"" . $file . "\" checked=\"checked\" />"
                        . " <img src=\"" . UPLOADURL . "/menuicons/" . $file . "\" alt=\"\"/> " . $file;
                } else {
                    $res .= "<input type=\"radio\" name=\"icon\" value=\"" . $file . "\" />"
                        . " <img src=\"" . UPLOADURL . "/menuicons/" . $file . "\" alt=\"\"/> " . $file;
                }
                $res .= "</div>\n";
            }
        }
        closedir($handle);
        return $res;
    }

    /**
     * Content::getContentType()
     *
     * @param bool $selected
     * @return
     */
    public function getContentType($selected = false)
    {
        $modlist = $this->displayMenuModule();
        if ($modlist) {
            $arr = array(
                'page' => _CON_PAGE,
                'module' => _MODULE,
                'web' => _EXT_LINK
            );
        } else {
            $arr = array(
                'page' => _CON_PAGE,
                'web' => _EXT_LINK,
                'file_upload_name' => _File_Upload
            );
        }

        $contenttype = '';
        foreach ($arr as $key => $val) {
            if ($key == $selected) {
                $contenttype .= "<option selected=\"selected\" value=\"" . $key . "\">" . $val . "</option>\n";
            } else
                $contenttype .= "<option value=\"" . $key . "\">" . $val . "</option>\n";
        }
        unset($val);
        return $contenttype;
    }

    /**
     * Content::getHomePageMeta()
     *
     * @return
     */
    private function getHomePageMeta()
    {
        global $db, $core;

        $sql = "SELECT p.title{$core->dblang}, p.description{$core->dblang}, p.keywords{$core->dblang}"
            . "\n FROM pages AS p"
            . "\n LEFT JOIN menus AS m ON p.id = m.page_id"
            . "\n WHERE m.home_page = '1'";
        $row = $db->first($sql);

        return $row;
    }

    /**
     * Content::getPageMeta()
     *
     * @return
     */
    private function getPageMeta()
    {
        global $core;

        $meta = "<title>" . $core->site_name . "  |  ";
        if ($this->slug) {
            $meta .= $this->title;
        } else {
            if (isset($_GET['mode'])) {
                $meta .= "Sitemap of " . $core->site_name;
            } else {
                $home = $this->getHomePageMeta();
                $meta .= $home['title' . $core->dblang];
            }
        }
        $meta .= "</title>\n";

        $meta .= "<meta name=\"description\" content=\"";
        if ($this->slug) {
            if ($this->description) {
                $meta .= $this->description;
            } else
                $meta .= $core->metadesc;
        } else {
            $home = $this->getHomePageMeta();
            $meta .= $home['description' . $core->dblang];
        }
        $meta .= "\" />\n";

        $meta .= "<meta name=\"keywords\" content=\"";
        if ($this->slug) {
            if ($this->keywords) {
                $meta .= $this->keywords;
            } else
                $meta .= $core->metadesc;
        } else {
            $home = $this->getHomePageMeta();
            $meta .= $home['keywords' . $core->dblang];
        }
        $meta .= "\" />\n";
        return $meta;
    }

    /**
     * Content::getModuleMeta()
     *
     * @return
     */
    private function getModuleMeta()
    {
        global $core;

        $modmeta = HCODE . 'admin/modules/' . $this->modalias . '/meta.php';
        if (file_exists($modmeta))
            include($modmeta);
    }

    /**
     * Content::getMeta()
     *
     * @return
     */
    public function getMeta()
    {
        global $core;

        $meta = '';
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
        if ($this->modalias) {
            $meta .= $this->getModuleMeta();
        } else {
            $meta .= $this->getPageMeta();
        }
        $meta .= "<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"" . SITEURL . "/assets/favicon.ico\" />\n";
        $meta .= "<meta name=\"publisher\" content=\"" . $core->company . "\" />\n";
        $meta .= "<meta name=\"copyright\" content=\"" . $core->company . " &copy; All Rights Reserved\" />\n";
        $meta .= "<meta name=\"language\" content=\"English\" />\n";
        $meta .= "<meta name=\"robots\" content=\"index\" />\n";
        $meta .= "<meta name=\"robots\" content=\"follow\" />\n";
        $meta .= "<meta name=\"revisit-after\" content=\"1 day\" />\n";
        $meta .= "<meta name=\"generator\" content=\"Powered by Matt Jason Interactive CMS!" . $core->version . "\" />\n";
        return $meta;
    }

    public function getBelmarsurvay($from = false)
    {
        global $db, $pager, $core;

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();

        $counter = countEntries($this->BelmarsurvayTable);
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
            if (in_array($sort, array("fname", "lname", "email", "dept_id",'date_added'))) {
                $ord = ($order == 'DESC') ? " DESC" : " ASC";
                $sorting = " u." . $sort . $ord;
            } else {
                $sorting = " u.fname DESC";
            }
        } else {
            $sorting = " u.fname DESC";
        }

        $clause = (isset($clause)) ? $clause : null;

        if (isset($_REQUEST['search'])) {


            $clause .= " WHERE u.fname like '" . $_REQUEST['search'] . "%'";
        }

        $sql = "SELECT * "
            . "\n FROM " . $this->BelmarsurvayTable . " as u"
            . "\n " . $clause
            . "\n ORDER BY " . $sorting . $pager->limit;

        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getBelmarsurveyFilter()
    {
        $arr = array(
            'fname-ASC' => _FNAME . ' &uarr;',
            'fname-DESC' => _FNAME . ' &darr;',
            'dept_id-ASC' => "Department" . ' &uarr;',
            'dept_id-DESC' => "Department" . ' &darr;',
            'email-ASC' => "Email" . ' &uarr;',
            'email-DESC' => "Email" . ' &darr;',

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

    public function getpublicworks($from = false)
    {
        global $db, $pager, $core;

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();

        $counter = countEntries($this->publicworkTable);
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
            if (in_array($sort, array("fname", "lname", "city", "state"))) {
                $ord = ($order == 'DESC') ? " DESC" : " ASC";
                $sorting = " u." . $sort . $ord;
            } else {
                $sorting = " u.fname DESC";
            }
        } else {
            $sorting = " u.fname DESC";
        }

        $clause = (isset($clause)) ? $clause : null;

        if (isset($_REQUEST['search'])) {

            $clause .= " WHERE (u.fname like '%" . $_REQUEST['search'] . "%' OR u.city like '%" . $_REQUEST['search'] . "%' OR u.state like '%" . $_REQUEST['search'] . "%')";
        }

        $sql = "SELECT * "
            . "\n FROM " . $this->publicworkTable . " as u"
            . "\n " . $clause
            . "\n ORDER BY " . $sorting . $pager->limit;

        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getPublicWorksFilter()
    {
        $arr = array(
            'fname-ASC' => _FNAME . ' &uarr;',
            'fname-DESC' => _FNAME . ' &darr;',
            'city-ASC' => _CITY . ' &uarr;',
            'city-DESC' => _CITY . ' &darr;',
            'state-ASC' => "State" . ' &uarr;',
            'state-DESC' => "State" . ' &darr;',

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

?>