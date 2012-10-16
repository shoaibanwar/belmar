<?php

/**
 * Functions
 *
 * @package HollyCode CMS
 * @author HollyCode.com
 * @copyright 2010
 * @version $Id: functions.php, v2.00 2011-04-20 10:12:05 gewa Exp $
 */
if (!defined("_VALID_PHP"))
    die('Direct access to this location is not allowed.');

/**
 * redirect_to()
 *
 * @param mixed $location
 * @return
 */
function redirect_to($location)
{
    if (!headers_sent()) {
        header('Location: ' . $location);
        exit;
    } else
        echo '<script type="text/javascript">';
    echo 'window.location.href="' . $location . '";';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
    echo '</noscript>';
}


function getSortValue($key, $url, $filter = "dep_id")
{
    $getVars = '';
    if (isset($_GET['search']))
        $getVars .= "&search={$_GET['search']}";
    if (isset($_GET["$filter"]))
        $getVars .= "&$filter={$_GET[$filter]}";
    if (isset($_GET['ipp']))
        $getVars .= "&ipp={$_GET['ipp']}";

    $dir = 'DESC';
    if (isset($_GET['sort'])) {
        $arr = explode('-', $_GET['sort']);
        $getVal = $arr[0];
        $getDir = $arr[1];
        if ($key == $getVal) {
            $dir = $getDir == "ASC" ? "DESC" : "ASC";
        }
    }
    $sort = htmlentities($_SERVER['PHP_SELF']) . $url . "&sort=$key-$dir" . $getVars;
    return $sort;
}


function getSortDirection($key)
{
    if (isset($_GET['sort'])) {
        $arr = explode('-', $_GET['sort']);
        $dir = "<img src=\"images/up.png\"/>";
        if ($arr[0] == $key)
            $dir = $arr[1] == "ASC" ? "<img src=\"images/up.png\"/>" : "<img src=\"images/down.png\"/>";
    }
    else $dir = "<img src=\"images/up.png\"/>";
    echo $dir;
}

/**
 * countEntries()
 *
 * @param mixed $table
 * @param string $where
 * @param string $what
 * @return
 */
function countEntries($table, $where = '', $what = '')
{
    global $db;
    if (!empty($where) && isset($what)) {
        $q = "SELECT COUNT(*) FROM " . $table . "  WHERE " . $where . " = '" . $what . "' LIMIT 1";
    } else
        $q = "SELECT COUNT(*) FROM " . $table . " LIMIT 1";

    $record = $db->query($q);

    $total = $db->fetchrow($record);
    return $total[0];
}

function sortByOneKey(array $array, $key, $asc = true) {
    $result = array();

    $values = array();
    foreach ($array as $id => $value) {
        $values[$id] = isset($value[$key]) ? $value[$key] : '';
    }

    if ($asc) {
        asort($values);
    }
    else {
        arsort($values);
    }

    foreach ($values as $key => $value) {
        $result[$key] = $array[$key];
    }

    return $result;
}

/**
 * getChecked()
 *
 * @param mixed $row
 * @param mixed $status
 * @return
 */
function getChecked($row, $status)
{
    if ($row == $status) {
        echo "checked=\"checked\"";
    }
}

/**
 *
 * @param $row
 * @param $status
 */
function returnChecked($row, $status)
{
    if ($row == $status) {
        return "checked=\"checked\"";
    }
}


/**
 * post()
 *
 * @param mixed $var
 * @return
 */
function post($var)
{
    if (isset($_POST[$var]))
        return $_POST[$var];
}

/**
 * get()
 *
 * @param mixed $var
 * @return
 */
function get($var)
{
    if (isset($_GET[$var]))
        return $_GET[$var];
}

/**
 * sanitize()
 *
 * @param mixed $string
 * @param bool $trim
 * @return
 */
function sanitize($string, $trim = false, $int = false, $str = false)
{
    $string = filter_var($string, FILTER_SANITIZE_STRING);
    $string = trim($string);
    $string = stripslashes($string);
    $string = strip_tags($string);
    $string = str_replace(array('â€˜', 'â€™', 'â€œ', 'â€�'), array("'", "'", '"', '"'), $string);

    if ($trim)
        $string = substr($string, 0, $trim);
    if ($int)
        $string = preg_replace("/[^0-9\s]/", "", $string);
    if ($str)
        $string = preg_replace("/[^a-zA-Z\s]/", "", $string);

    return $string;
}

/**
 * cleanSanitize()
 *
 * @param mixed $string
 * @param bool $trim
 * @return
 */
function cleanSanitize($string, $trim = false, $end_char = '&#8230;')
{
    $string = cleanOut($string);
    $string = filter_var($string, FILTER_SANITIZE_STRING);
    $string = trim($string);
    $string = stripslashes($string);
    $string = strip_tags($string);
    $string = str_replace(array('â€˜', 'â€™', 'â€œ', 'â€�'), array("'", "'", '"', '"'), $string);

    if ($trim) {
        if (strlen($string) < $trim) {
            return $string;
        }

        $string = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $string));

        if (strlen($string) <= $trim) {
            return $string;
        }

        $out = "";
        foreach (explode(' ', trim($string)) as $val) {
            $out .= $val . ' ';

            if (strlen($out) >= $trim) {
                $out = trim($out);
                return (strlen($out) == strlen($string)) ? $out : $out . $end_char;
            }
        }
    }
    return $string;
}

/**
 * getValue()
 *
 * @param mixed $stwhatring
 * @param mixed $table
 * @param mixed $where
 * @return
 */
function getValue($what, $table, $where)
{
    global $db;
    $sql = "SELECT $what FROM $table WHERE $where";
    $row = $db->first($sql);
    return $row[$what];
}

/**
 * self()
 *
 * @return
 */
function self()
{
    return htmlspecialchars($_SERVER['PHP_SELF']);
}

/**
 * tooltip()
 *
 * @param mixed $tip
 * @return
 */
function tooltip($tip)
{
    return '<img src="' . ADMINURL . '/images/info2.png" alt="Tip" class="tooltip" title="' . $tip . '" />';
}

/**
 * required()
 *
 * @return
 */
function required()
{
    return '<img src="' . ADMINURL . '/images/required.png" alt="' . _REQ_FIELD . '" class="tooltip" title="' . _REQ_FIELD . '" />';
}

/**
 * createPageLink()
 *
 * @param mixed $slug
 * @return
 */
function createPageLink($slug)
{
    global $db, $core;

    $sql = "SELECT slug FROM pages WHERE slug = '" . sanitize($slug, 50) . "'";
    $row = $db->first($sql);

    if ($core->seo == 1) {
        $display = $core->site_url . '/' . sanitize($row['slug'], 50) . '.html';
    }
    else {
        $display = $core->site_url . '/content.php?pagename=' . sanitize($row['slug'], 50);
    }
    return $display;
}

/**
 * stripTags()
 *
 * @param mixed $start
 * @param mixed $end
 * @param mixed $string
 * @return
 */
function stripTags($start, $end, $string)
{
    $string = stristr($string, $start);
    $doend = stristr($string, $end);
    return substr($string, strlen($start), -strlen($doend));
}

/**
 * getTemplates()
 *
 * @param mixed $dir
 * @param mixed $site
 * @return
 */
function getTemplates($dir, $site)
{
    $getDir = dir($dir);
    while (false !== ($templDir = $getDir->read())) {
        if ($templDir != "." && $templDir != ".." && $templDir != "index.php") {
            $selected = ($site == $templDir) ? " selected=\"selected\"" : "";
            echo "<option value=\"{$templDir}\"{$selected}>{$templDir}</option>\n";
        }
    }
    $getDir->close();
}

/**
 * stripExt()
 *
 * @param mixed $filename
 * @return
 */
function stripExt($filename)
{
    if (strpos($filename, ".") === false) {
        return ucwords($filename);
    } else
        return substr(ucwords($filename), 0, strrpos($filename, "."));
}

/**
 * loadEditor()
 *
 * @param mixed $field
 * @param mixed $value
 * @param mixed $width
 * @param mixed $height
 * @param mixed $toolbar
 * @param mixed $var
 * @return
 */
function loadEditor($field, $width = "100%", $height = "450", $var = "oEdit1")
{
    print '
                    <script type="text/javascript">
                        // <![CDATA[
                            var ' . $var . ' = new InnovaEditor("' . $var . '");
                            ' . $var . '.width="' . $width . '";
                            ' . $var . '.height=' . $height . ';
                            ' . $var . '.arrCustomButtons = [
                            ["CustomName1","modelessDialogShow(\'editor/scripts/youtube_video.htm\',380,110)","Insert Youtube","btnYuytube.gif"],
                            ["CustomName2","modelessDialogShow(\'editor/scripts/paypal.htm\',350,270)","PayPal Button","btnPayPal.gif"],
                            ["CustomName3","oUtil.obj.insertHTML(\"<img src=\'images/pagesplit.gif\' style=\'display:block;margin-left:auto;margin-right:auto\' />\")","Page Split","btnPagebreak.gif"]
                            ]
                            ' . $var . '.toolbarMode = 2;
                            ' . $var . '.groups=[
                            ["grpEdit", "", ["XHTMLSource", "FullScreen", "Preview", "Search", "RemoveFormat", "BRK", "Undo", "Redo", "Cut", "Copy", "Paste", "PasteWord", "PasteText"]],
                            ["grpFont", "", ["FontName", "FontSize", "Strikethrough", "Superscript", "BRK", "Bold", "Italic", "Underline", "ForeColor", "BackColor"]],
                            ["grpPara", "", ["Paragraph", "Indent", "Outdent", "Styles", "StyleAndFormatting", "Absolute", "BRK", "JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyFull", "Numbering", "Bullets"]],
                            ["grpInsert", "", ["Hyperlink", "Bookmark", "BRK", "Image", "Form"]],
                            ["grpTables", "", ["Table", "BRK", "Guidelines", "Guidelines", "CustomName2"]],
                            ["grpMedia", "", ["Media", "Flash", "CustomName1", "BRK", "Characters", "Line"]]
                            ];

                            ' . $var . '.css="' . THEMEURL . '/css/custom.css";
                            ' . $var . '.cmdAssetManager = "modalDialogShow(\'editor/filemanager.php\',800,500)";
                            ' . $var . '.arrCustomTag=[
                            ["First Last Name","[NAME]"],
                            ["Username","[USERNAME]"],
                            ["Site Name","[SITE_NAME]"],
                            ["Site Url","[URL]"]
                            ];
                            ' . $var . '.customColors=["#ff4500","#ffa500","#808000","#4682b4","#1e90ff","#9400d3","#ff1493","#a9a9a9"];
                            ' . $var . '.mode="XHTMLBody";
                            ' . $var . '.REPLACE("' . $field . '");
                            // ]]>
                    </script>
                    ';
}


/**
 * cleanOut()
 *
 * @param mixed $text
 * @return
 */
function cleanOut($text)
{
    $text = strtr($text, array('\r\n' => "", '\r' => "", '\n' => ""));
    $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    $text = str_replace('<br>', '<br />', $text);
    return stripslashes($text);
}

/**
 * isActive()
 *
 * @param mixed $id
 * @return
 */
function isActive($id)
{
    if ($id == 1) {
        $display = '<img src="images/yes.png" alt="" class="tooltip" title="' . _PUBLISHED . '"/>';
    }
    else {
        $display = '<img src="images/no.png" alt="" class="tooltip" title="' . _NOTPUBLISHED . '"/>';
    }

    return $display;

}

/**
 * isAdmin()
 *
 * @param mixed $id
 * @return
 */
function isAdmin($userlevel)
{
    if ($userlevel == 9) {
        $display = '<img src="images/superadmin.png" alt="" class="tooltip" title="Super Admin"/>';
    }
    elseif ($userlevel == 8) {
        $display = '<img src="images/admin.png" alt="" class="tooltip" title="Admin"/>';
    }
    else {
        $display = '<img src="images/user.png" alt="" class="tooltip" title="Sub-Admin"/>';
    }

    return $display;

}

/**
 * userStatus()
 *
 * @param mixed $id
 * @return
 */
function userStatus($status)
{
    switch ($status) {
        case "y":
            $display = '<img src="images/u_active.png" alt="" class="tooltip" title="' . _USER_A . '"/>';
            break;

        case "n":
            $display = '<img src="images/u_inactive.png" alt="" class="tooltip" title="' . _USER_I . '"/>';
            break;

        case "t":
            $display = '<img src="images/u_pending.png" alt="" class="tooltip" title="' . _USER_P . '"/>';
            break;

        case "b":
            $display = '<img src="images/u_banned.png" alt="" class="tooltip" title="' . _USER_B . '"/>';
            break;
    }

    return $display;

}

function groupStatus($status)
{
    switch ($status) {
        case "y":
            $display = '<img src="images/u_active.png" alt="" class="tooltip" title="' . _DEPARTMENT_A . '"/>';
            break;

        case "n":
            $display = '<img src="images/u_inactive.png" alt="" class="tooltip" title="' . _DEPARTMENT_I . '"/>';
            break;
    }

    return $display;
}

/**
 * delete_directory()
 *
 * @param mixed $dirname
 * @return
 */
function delete_directory($dirname)
{
    if (is_dir($dirname))
        $dir_handle = opendir($dirname);
    if (!$dir_handle)
        return false;
    while ($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname . "/" . $file))
                @unlink($dirname . "/" . $file);
            else
                delete_directory($dirname . '/' . $file);
        }
    }
    closedir($dir_handle);
    @rmdir($dirname);
    return true;
}

/**
 * randName()
 *
 * @return
 */
function randName()
{
    $code = '';
    for ($x = 0; $x < 6; $x++) {
        $code .= '-' . substr(strtoupper(sha1(rand(0, 999999999999999))), 2, 6);
    }
    $code = substr($code, 1);
    return $code;
}

/**
 * checkDir()
 *
 * @param mixed $dir
 * @return
 */
function checkDir($dir)
{
    if (!is_dir($dir)) {
        echo "path does not exist<br/>";
        $dirs = explode('/', $dir);
        $tempDir = $dirs[0];
        $check = false;

        for ($i = 1; $i < count($dirs); $i++) {
            echo " Checking " . $tempDir . "<br/>";
            if (is_writeable($tempDir)) {
                $check = true;
            }
            else {
                $error = $tempDir;
            }

            $tempDir .= '/' . $dirs[$i];
            if (!is_dir($tempDir)) {
                if ($check) {
                    echo " Creating " . $tempDir . "<br/>";
                    @mkdir($tempDir, 0755);
                    @chmod($tempDir, 0755);
                }
                else
                    echo " Not enough permissions";
            }
        }
    }
}

/**
 * dodate()
 *
 * @param mixed $format
 * @param mixed $date
 * @return
 */
function dodate($format, $date)
{
    return strftime($format, strtotime($date));
}

/**
 * getTime()
 *
 * @return
 */
function getTime()
{
    $timer = explode(' ', microtime());
    $timer = $timer[1] + $timer[0];
    return $timer;
}

function getMenuID($slug)
{
    global $db;
    $sql = "SELECT 	id	,parent_id from menus where page_slug='$slug'";

    $result = $db->first($sql);
    if (intval($result['parent_id']) == 0)
        return $result['id'];
    return $result['parent_id'];
}

function sort_date($a,$b)
{

    if(strtotime($a['created'])>strtotime($b['created']))
        return -1;
    elseif(strtotime($a['created'])<strtotime($b['created']))
        return 1;
    return 0;
}

function getTopLevelParent($id)
{
    global $db;
    $sql = "SELECT 	id	,parent_id from menus where id=$id";

    $result = $db->first($sql);
    if (intval($result['parent_id']) == 0)
        return $result['id'];
    return getTopLevelParent($result['parent_id']);
}

function getActualMenuID($slug)
{
    global $db;
    $sql = "SELECT 	id	 from menus where page_slug='$slug'";
    $result = $db->first($sql);
    if(!$result) return false;
    return $result['id'];
}

function isPageAssignedToMenu($id)
{
    global $db;
    $sql = "SELECT 	page_id	 from menus where page_id='$id'";
    $result = $db->first($sql);
    if(!$result) return false;
    return $result['page_id'];
}

function getSlugFromMenuID($id)
{
    global $db;
    $sql = "SELECT 	page_slug from menus where id=$id";
    $result = $db->first($sql);
    return $result['page_slug'];
}


function in_array_recursive($needle, $haystack)
{
    $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($haystack));
    foreach ($it AS $element) {
        if ($element == $needle) {
            return true;
        }
    }
    return false;
}

function days_to_seconds($days)
{
    if (is_numeric($days)) {
        return 86400 * $days;
    } else {
        return '0';
    }

}

function hours_to_seconds($hours)
{
    if (is_numeric($hours)) {
        return 3600 * $hours;
    } else {
        return '0';
    }

}

function minutes_to_seconds($minutes)
{
    if (is_numeric($minutes)) {
        return 60 * $minutes;
    } else {
        return '0';
    }
}

function seconds_to_days($seconds)
{
    if (is_numeric($seconds) && $seconds != "0") {
        return $seconds / 86400;
    } else {
        return '0';
    }

}


function seconds_to_hours($seconds)
{
    if (is_numeric($seconds) && $seconds != "0") {

        return $seconds / 3600;
    } else {
        return '0';
    }
}

function seconds_to_minuties($seconds)
{
    if (is_numeric($seconds) && $seconds != "0") {
        return ($seconds / 60);
    } else {
        return '0';
    }
}


function  calleditor()
{
    $List = "<textarea  id=\"bodycontent\" name=\"on_site_content\" rows=\"4\" cols=\"30\" style=\"display: none;\" ></textarea>";
    $List .= loadEditor('bodycontent');

    return $List;
}
function availableDeps(){
    $deps=  array(30=>'Tourism',31=>'Local Businesses',29=>'Recreation',24=>'Municipal',27=>'Beach',28=>'Marina',41=>'Belmar Alerts',42=>'Press Room');
    asort($deps);
    return $deps;
}

function getDeps($select = 'none', $onchange='') {

    $deps = '<select name="section" style="width:150px" class="custombox" '.$onchange.'>';
    $deps.='<option value="NA">--none--</option>';
        foreach(availableDeps() as $id=>$name){
           $deps.="<option value='$id'".($select==$name?' selected':'').">$name</option>";
        }
    $deps.='</select>';
    return $deps;
}



