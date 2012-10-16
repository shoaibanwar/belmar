<?php
/**
 * Ajax
 *
 * @package HollyCode CMS
 * @author HollyCode.com
 * @copyright 2010
 * @version $Id: process.php, v2.00 2011-04-20 10:12:05 gewa Exp $
 */
define("_VALID_PHP", true);

require_once("init.php");
if (!$user->is_Admin())
    redirect_to("login.php");
?>
<?php
/* Load Menu */
if (isset($_POST['getmenus'])
)
    : $content->getSortMenuList();
endif;
?>
<?php
/* Sort Menu */
if (isset($_POST['sortmenuitems'])) :
    $i = 0;
    $canNotMove = array(2, 30, 31, 32, 33, 34, 35, 29, 24, 27, 28, 41, 42);
    foreach ($_POST['list'] as $k => $v) :
        $i++;
        if (in_array($k, $canNotMove) && $v != 0) continue;
        $data['parent_id'] = intval($v);
        $data['position'] = intval($i);

        $res = $db->update("menus", $data, "id='" . (int)$k . "'");
    endforeach;
    print ($res) ? $core->msgOk(_MU_SORTED) : $core->msgAlert(_SYSTEM_PROCCESS);
endif;
?>
<?php
/* Delete Menu */
if (isset($_POST['deleteMenu'])
)
    : if (intval($_POST['deleteMenu']) == 0 || empty($_POST['deleteMenu'])
)
    : redirect_to("index.php?do=menus");
endif;

    $id = intval($_POST['deleteMenu']);

    if (!in_array_recursive($id, $user->get_permitted_menus()))
        exit("You do not have permission to do this.");

    $action = $db->delete("menus", "id='" . $id . "'");
    $db->delete("menus", "parent_id='" . $id . "'");

    $title = sanitize($_POST['menutitle']);
    print ($action) ? $hollysec->writeLog(_MENU . ' <strong>' . $title . '</strong> ' . _DELETED, "", "no", "content") . $core->msgOk(_MENU . ' <strong>' . $title . '</strong> ' . _DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
endif;
?>
<?php
/* Delete Content Page */
if (isset($_POST['deletePage'])
)
    : if (intval($_POST['deletePage']) == 0 || empty($_POST['deletePage'])
)
    : redirect_to("index.php?do=pages");
endif;

    $id = intval($_POST['deletePage']);

    $notPermitted = $user->get_not_permitted_pages();
    if (in_array_recursive($id, $notPermitted)) {
        exit("You do not have permission to do this.");
    }

    $db->delete("posts", "page_id='" . $id . "'");
    $db->delete("layout", "page_id='" . $id . "'");
    $db->delete("pages", "id='" . $id . "'");

    $title = sanitize($_POST['pagetitle']);
    print ($db->affected()) ? $hollysec->writeLog(_PAGE . ' <strong>' . $title . '</strong> ' . _DELETED, "", "no", "content") . $core->msgOk(_PAGE . ' <strong>' . $title . '</strong> ' . _DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
endif;
?>
<?php
/* Delete Content Page */
if (isset($_POST['deletealert'])
)
    : if (intval($_POST['deletealert']) == 0 || empty($_POST['deletealert'])
)
    : redirect_to("index.php?do=pages");
endif;

    $id = intval($_POST['deletealert']);

    $db->delete("get_alerts", "id='" . $id . "'");

    $title = sanitize($_POST['alerttitle']);
    print ($db->affected()) ? $hollysec->writeLog(_PAGE . ' <strong>' . $title . '</strong> ' . _DELETED, "", "no", "content") . $core->msgOk(_PAGE . ' <strong>' . $title . '</strong> ' . _DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
endif;
?>

<?php
/* Delete opt_outlist Page */
if (isset($_POST['deleteoptout'])
)
    : if (intval($_POST['deleteoptout']) == 0 || empty($_POST['deleteoptout'])
)
    : redirect_to("index.php?do=pages");
endif;

    $id = intval($_POST['deleteoptout']);

    $db->delete("get_alerts", "id='" . $id . "'");

    $title = sanitize($_POST['optouttitle']);
    print ($db->affected()) ? $hollysec->writeLog(_PAGE . ' <strong>' . $title . '</strong> ' . _DELETED, "", "no", "content") . $core->msgOk(_PAGE . ' <strong>' . $title . '</strong> ' . _DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
endif;


/* Get Membership List */
if (isset($_POST['membershiplist'])) :
    if ($_POST['membershiplist'] == "Membership"):
        $memid = getValue("membership_id", "pages", "id='" . (int)$_POST['pageid'] . "'");
        print $member->getMembershipList($memid);
    endif;
endif;
?>
<?php
/* Delete Content Post */
if (isset($_POST['deletePost'])
)
    : if (intval($_POST['deletePost']) == 0 || empty($_POST['deletePost'])
)
    : redirect_to("index.php?do=posts");
endif;

    $id = intval($_POST['deletePost']);
    $db->delete("posts", "id='" . $id . "'");
    $title = sanitize($_POST['posttitle']);

    print ($db->affected()) ? $hollysec->writeLog(_POST . ' <strong>' . $title . '</strong> ' . _DELETED, "", "no", "content") . $core->msgOk(_POST . ' <strong>' . $title . '</strong> ' . _DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
endif;
?>
<?php
/* Delete Module */
if (isset($_POST['deleteModule'])
)
    : if (intval($_POST['deleteModule']) == 0 || empty($_POST['deleteModule'])
)
    : redirect_to("index.php?do=modules");
endif;

    $id = intval($_POST['deleteModule']);
    $data['module_id'] = 0;
    $data['module_data'] = 0;
    $db->update("pages", $data, "module_id = '" . $id . "'");
    $db->delete("modules", "id='" . $id . "'");
    $title = sanitize($_POST['modtitle']);

    print ($db->affected()) ? $hollysec->writeLog(_MODULE . ' <strong>' . $title . '</strong> ' . _DELETED, "", "no", "module") . $core->msgOk(_MODULE . ' <strong>' . $title . '</strong> ' . _DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
endif;
?>
<?php
/* Delete Template */
if (isset($_POST['deleteTemplate'])
)
    : if (intval($_POST['deleteTemplate']) == 0 || empty($_POST['deleteTemplate'])
)
    : redirect_to("index.php?do=templates");
endif;

    $id = intval($_POST['deleteTemplate']);
    $db->delete("email_templates", "id='" . $id . "'");
    $title = sanitize($_POST['TempName']);

    print ($db->affected()) ? $hollysec->writeLog('Template <strong>' . $title . '</strong> ' . _DELETED, "", "no", "module") . $core->msgOk(' Template <strong>' . $title . '</strong> ' . _DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
endif;
?>
<?php
/* Get Template */
if (isset($_POST['getTemp'])
)
    : if (intval($_POST['tid']) == 0 || empty($_POST['tid'])
)
    : exit;
endif;
    $id = intval($_POST['tid']);
    $temp = $db->first("SELECT * FROM email_templates WHERE id= $id");
    print json_encode($temp);
endif;
?>
<?php
/* Get Module List */
if (isset($_POST['modulelist'])) :
    $alias = getValue('modalias', 'modules', 'id="' . intval($_POST['modulelist']) . '"');
    $module_data = intval($_POST['module_data']);
    if (file_exists(MODPATH . $alias . '/config.php'))
        include(MODPATH . $alias . '/config.php');
endif;
?>
<?php
/* Delete Plugin */
if (isset($_POST['deletePlugin'])
)
    : if (intval($_POST['deletePlugin']) == 0 || empty($_POST['deletePlugin'])
)
    : redirect_to("index.php?do=plugins");
endif;

    $id = intval($_POST['deletePlugin']);
    $db->delete("plugins", "id='" . $id . "'");
    $title = sanitize($_POST['plugtitle']);

    print ($db->affected()) ? $hollysec->writeLog(_PLUGIN . ' <strong>' . $title . '</strong> ' . _DELETED, "", "no", "plugin") . $core->msgOk(_PLUGIN . ' <strong>' . $title . '</strong> ' . _DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
endif;
?>
<?php
/* Delete Membership */
if (isset($_POST['deleteMembership'])
)
    : if (intval($_POST['deleteMembership']) == 0 || empty($_POST['deleteMembership'])
)
    : redirect_to("index.php?do=memberships");
endif;

    $id = intval($_POST['deleteMembership']);
    $db->delete("memberships", "id='" . $id . "'");
    $title = sanitize($_POST['posttitle']);

    print ($db->affected()) ? $hollysec->writeLog(_MEMBERSHIP . ' <strong>' . $title . '</strong> ' . _DELETED, "", "no", "content") . $core->msgOk(_MEMBERSHIP . ' <strong>' . $title . '</strong> ' . _DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
endif;
?>
<?php
/* Delete Transaction */
if (isset($_POST['deleteTransaction'])
)
    : if (intval($_POST['deleteTransaction']) == 0 || empty($_POST['deleteTransaction'])
)
    : redirect_to("index.php?do=transactions");
endif;

    $id = intval($_POST['deleteTransaction']);
    $db->delete("payments", "id='" . $id . "'");
    $title = sanitize($_POST['posttitle']);

    print ($db->affected()) ? $hollysec->writeLog(_TRANSACTION . ' <strong>' . $title . '</strong> ' . _DELETED, "", "no", "content") . $core->msgOk(_TRANSACTION . ' <strong>' . $title . '</strong> ' . _DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
endif;
?>
<?php
/* Export Transactions */
if (isset($_GET['exportTransactions'])) {
    $sql = "SELECT * FROM payments";
    $result = $db->query($sql);

    $type = "vnd.ms-excel";
    $date = date('m-d-Y H:i');
    $title = "Exported from the " . $core->site_name . " on $date";

    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Type: application/$type");
    header("Content-Disposition: attachment;filename=temp_" . time() . ".xls");
    header("Content-Transfer-Encoding: binary ");

    echo("$title\n");
    $sep = "\t";

    for ($i = 0; $i < $db->numfields($result); $i++) {
        echo mysql_field_name($result, $i) . "\t";
    }
    print("\n");

    while ($row = $db->fetchrow($result)) {
        $schema_insert = "";
        for ($j = 0; $j < $db->numfields($result); $j++) {
            if (!isset($row[$j]))
                $schema_insert .= "NULL" . $sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]" . $sep;
            else
                $schema_insert .= "" . $sep;
        }
        $schema_insert = str_replace($sep . "$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }
    exit();
}
?>
<?php
/* Delete User */
if (isset($_POST['deleteUser'])
)
    : if (intval($_POST['deleteUser']) == 0 || empty($_POST['deleteUser'])
)
    : redirect_to("index.php?do=users");
endif;

    $id = intval($_POST['deleteUser']);
    if ($id == 1):
        $core->msgError(_UR_ADMIN_E);
    else:
        $db->delete("users", "id='" . $id . "'");
        $db->delete('permissions', "ent_id=$id AND ent_type=1");
        $db->delete('users_modules', "user_id=$id ");

        $username = sanitize($_POST['username']);

        print ($db->affected()) ? $hollysec->writeLog(_USER . ' <strong>' . $username . '</strong> ' . _DELETED, "", "no", "content") . $core->msgOk(_USER . ' <strong>' . $username . '</strong> ' . _DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
    endif;
endif;


/* Delete Group */
if (isset($_POST['deleteGroup'])
)
    : if (intval($_POST['deleteGroup']) == 0 || empty($_POST['deleteGroup'])
)
    : redirect_to("index.php?do=groups");
endif;

    $id = intval($_POST['deleteGroup']);

    $users = $db->fetch_all("SELECT id FROM users WHERE department_id = $id");
    foreach ($users as $admin) {
        $db->delete("users_menus", "user_id='" . $admin['id'] . "'");
        $db->delete("users", "id='" . $admin['id'] . "'");
    }

    $db->delete("departments", "id='" . $id . "'");

    $db->delete('departments_menus', "dep_id=$id");
    $db->delete('departments_modules', "dep_id=$id");
    $db->delete('permissions', "ent_id=$id AND ent_type=0");

    $dep_name = sanitize($_POST['dep_name']);

    print ($db->affected()) ? $hollysec->writeLog(_DEP . ' <strong>' . $dep_name . '</strong> ' . _DELETED, "", "no", "content") . $core->msgOk(_DEP . ' <strong>' . $dep_name . '</strong> ' . _DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);


endif;
?>
<?php
/* User Search */
if (isset($_POST['userSearch'])
)
    : $string = sanitize($_POST['userSearch'], 15);

    if (strlen($string) > 3
    )
        : $sql = "SELECT id, username, email, CONCAT(fname,' ',lname) as name"
        . "\n FROM users"
        . "\n WHERE MATCH (username) AGAINST ('" . $db->escape($string) . "*' IN BOOLEAN MODE)"
        . "\n ORDER BY username LIMIT 10";
        $display = '';
        if ($result = $db->fetch_all($sql)):
            $display .= '<ul id="searchresults">';
            foreach ($result as $row):
                $link = 'index.php?do=users&amp;action=edit&amp;userid=' . (int)$row['id'];
                $display .= '<li><a href="' . $link . '" >' . $row['username'] . '<small>' . $row['name'] . ' - ' . $row['email'] . '</small></a></li>';
            endforeach;
            $display .= '</ul>';
            print $display;
        endif;
    endif;
endif;
?>
<?php
/* Group Search */
if (isset($_POST['groupSearch'])
)
    : $string = sanitize($_POST['groupSearch'], 15);

    if (strlen($string) > 3
    )
        : $sql = "SELECT id, dep_name"
        . "\n FROM departments"
        . "\n WHERE MATCH (dep_name) AGAINST ('" . $db->escape($string) . "*' IN BOOLEAN MODE)"
        . "\n ORDER BY dep_name LIMIT 10";

        $display = '';
        if ($result = $db->fetch_all($sql)):
            $display .= '<ul id="searchresults">';
            foreach ($result as $row):
                $editLink = 'index.php?do=groups&amp;action=edit&amp;groupid=' . (int)$row['id'];
                $viewLink = 'index.php?do=groups&amp;action=showUsers&amp;groupid=' . (int)$row['id'];
                $deleteLink = 'javascript:void(0);';
                $display .= '<li>' . $row['dep_name'] . '<a style="display:inline" class="delete"  rel="' . $row['dep_name'] . '" id="item_' . $row['id'] . '" href="' . $deleteLink . '"><img src="images/delete.png" style="float:right;"  class="tooltip" title="delete" /></a> ';
                $display .= '<a style="display:inline" href="' . $editLink . '"><img src="images/edit.png" style="float:right;" class="tooltip" title="edit" /></a>';
                $display .= '<a style="display:inline" href="' . $viewLink . '"><img src="images/user.png" style="float:right;"  class="tooltip" title="view"/></a></li>';
            endforeach;
            $display .= '</ul>';
            print $display;
        endif;
    endif;
endif;
?>
<?php
/* User Search */
if (isset($_POST['eventSearch'])
)
    : $string = sanitize($_POST['eventSearch'], 15);

    if (strlen($string) > 0
    )
        : $sql = "SELECT *"
        . "\n FROM mod_events where title_en like '$_POST[eventSearch]%'";
        //   echo $sql;die;
        $display = '';
        if ($result = $db->fetch_all($sql)):
            $display .= '<ul id="searchresults">';
            foreach ($result as $row):
                $linkedit = 'index.php?do=modules&action=config&mod=events&mod_action=edit&amp;eventid=' . (int)$row['id'];
                $display .= '<li><a href="' . $linkedit . '" style="display: inline;" class="tooltip" title="Edit:' . $row['title' . $core->dblang] . '">' . $row['title' . $core->dblang] . '</a>
                <a href="javascript:void(0);"  class="delete" rel="' . $row['title' . $core->dblang] . '" style="display: inline;float: right; " id="item_' . (int)$row['id'] . '"><img src="images/delete.png" alt="" class="tooltip" title="DELETE:' . $row['title' . $core->dblang] . '"/></a></li>';

            endforeach;
            $display .= '</ul>';
            print $display;
        endif;
    endif;
endif;
?>
<?php
if (isset($_POST['pressroomsearch'])
)
    : $string = sanitize($_POST['pressroomsearch'], 15);

    if (strlen($string) > 0
    )
        : $sql = "SELECT *"
        . "\n FROM pressroom where title_en like '$_POST[pressroomsearch]%'";
        //   echo $sql;die;
        $display = '';
        if ($result = $db->fetch_all($sql)):
            $display .= '<ul id="searchresults">';
            foreach ($result as $row):
                $link = 'index.php?do=pressroom&mod_action=edit&amp;proomid=' . (int)$row['id'];

                $display .= '<li><a href="' . $link . '" style="display: inline;" class="tooltip" title="Edit:' . $row['title' . $core->dblang] . '" >' . $row['title' . $core->dblang] . '</a><a href="javascript:void(0);"  class="delete" rel="' . $row['title' . $core->dblang] . '" style="display: inline;align: right; " id="item_' . (int)$row['id'] . '"><img src="images/delete.png" alt="" class="tooltip" title="DELETE:' . $row['title' . $core->dblang] . '"/></a></li>';

            endforeach;
            $display .= '</ul>';
            print $display;
        endif;
    endif;
endif;
?>
<?php
if (isset($_POST['gallarysearch'])
)
    : $string = sanitize($_POST['gallarysearch'], 15);

    if (strlen($string) > 0
    )
        : $sql = "SELECT *"
        . "\n FROM mod_gallery_config where title_en like '$_POST[gallarysearch]%'";
        //   echo $sql;die;
        $display = '';
        if ($result = $db->fetch_all($sql)):
            $display .= '<ul id="searchresults">';
            foreach ($result as $row):
                $link = 'index.php?do=modules&action=config&mod=gallery&mod_action=edit&galid=' . (int)$row['id'];

                $display .= '<li><a href="' . $link . '" style="display: inline;" class="tooltip" title="Edit:' . $row['title' . $core->dblang] . '" >' . $row['title_en'] . '</a><a href="javascript:void(0);"  class="delete" rel="' . $row['title' . $core->dblang] . '" style="display: inline;align: right; " id="item_' . (int)$row['id'] . '"><img src="images/delete.png" alt="" class="tooltip" title="DELETE:' . $row['title' . $core->dblang] . '"/></a></li>';

            endforeach;
            $display .= '</ul>';
            print $display;
        endif;
    endif;
endif;
?>
<?php
if (isset($_POST['belmaralertsearch'])
)
    : $string = sanitize($_POST['belmaralertsearch'], 15);

    if (strlen($string) > 0
    )
        : $sql = "SELECT *"
        . "\n FROM belmaralerts where title like '$_POST[belmaralertsearch]%'";
        //   echo $sql;die;
        $display = '';
        if ($result = $db->fetch_all($sql)):
            $display .= '<ul id="searchresults">';
            foreach ($result as $row):
                $link = 'index.php?do=alerts&mod_action=edit&amp;belmaralertId=' . (int)$row['id'];
                $display .= '<li><a href="' . $link . '" style="display: inline;" class="tooltip" title="Edit:' . $row['title'] . '" >' . $row['title'] . '</a><a href="javascript:void(0);"  class="delete" rel="' . $row['title'] . '" style="display: inline;align: right; " id="item_' . (int)$row['id'] . '"><img src="images/delete.png" alt="" class="tooltip" title="DELETE:' . $row['title'] . '"/></a></li>';
            endforeach;
            $display .= '</ul>';
            print $display;
        endif;
    endif;
endif;
?>
<?php
if (isset($_POST['optoutsearch'])
)
    : $string = sanitize($_POST['optoutsearch'], 15);

    if (strlen($string) > 0
    )
        : $sql = "SELECT *"
        . "\n FROM countalertsmaillist   where fname like '$_POST[optoutsearch]%'";
        //   echo $sql;die;
        $display = '';
        if ($result = $db->fetch_all($sql)):
            $display .= '<ul id="searchresults">';
            foreach ($result as $row):
                $link = 'index.php?do=lists/opt_out&mod_action=view&amp;optoutid=' . (int)$row['id'] . '&email=' . $row['email'];
                $display .= '<li><a href="' . $link . '" style="display: inline;" class="tooltip" title="View:' . $row['fname'] . '" >' . $row['fname'] . '</a></li>';
            endforeach;
            $display .= '</ul>';
            print $display;
        endif;
    endif;
endif;
?>
<?php
if (isset($_POST['pagesearch'])
)
    : $string = sanitize($_POST['pagesearch'], 15);

    if (strlen($string) > 0 ) :
        $foundSomthing = false;
        ///find in sections
        $sections = preg_grep("/^.*$string.*$/i", availableDeps());
        $ul = '<ul id="searchresults">';
        if(count($sections)!=0){
            $foundSomthing=true;
            foreach ($sections as $id=>$name):
                $linkview = 'index.php?do=pages&section=' . $id;

                $ul .= '<li><a href="' . $linkview . '" style="display: inline;" class="tooltip" title="Section:' . $name . '">' . $name . '</a>';

            endforeach;

        }
        $sql = "SELECT *"
        . "\n FROM pages where title_en like '$_POST[pagesearch]%'";
        //   echo $sql;die;

        if ($result = $db->fetch_all($sql)):
            $foundSomthing = true;
            foreach ($result as $row):
                $linkview = 'index.php?do=pages&action=view&amp;pageid=' . (int)$row['id'];
                $linkedit = 'index.php?do=pages&action=edit&amp;pageid=' . (int)$row['id'];
                $ul .= '<li><a href="' . $linkview . '" style="display: inline;" class="tooltip" title="View:' . $row['title' . $core->dblang] . '">' . $row['title' . $core->dblang] . '</a>
                <a href="' . $linkedit . '" style="display: inline;"><img src="images/edit.png" alt="" class="tooltip" title="Edit:' . $row['title' . $core->dblang] . '"/></a>
                <a href="javascript:void(0);"  class="delete" rel="' . $row['title' . $core->dblang] . '" style="display: inline;align: right; " id="item_' . (int)$row['id'] . '"><img src="images/delete.png" alt="" class="tooltip" title="DELETE:' . $row['title' . $core->dblang] . '"/></a></li>';

            endforeach;
        endif;

    if($foundSomthing) echo  $ul . '</ul>';
    endif;
endif;
?>
<?
if (isset($_POST['alertsearch']) )
    :
    $string = sanitize($_POST['alertsearch'], 15);

    if (strlen($string) > 0 )
        :
        $sql = "SELECT *"
        . "\n FROM get_alerts where fname like '$_POST[alertsearch]%'";
        //   echo $sql;die;
        $display = '';
        if ($result = $db->fetch_all($sql)):
            $display .= '<ul id="searchresults">';
            foreach ($result as $row):
                $link = 'index.php?do=lists/get_alerts&mod_action=view&amp;alertid=' . (int)$row['id'];

                $display .= '<li><a href="' . $link . '" style="display: inline;" class="tooltip" title="View:' . $row['fname'] . '">' . $row['fname'] . '</a><a href="javascript:void(0);"  class="delete" rel="' . $row['fname'] . '" style="display: inline;align: right; " id="item_' . (int)$row['id'] . '"><img src="images/delete.png" alt="" class="tooltip" title="DELETE:' . $row['fname'] . '"/></a></li>';
                //   $display.='<li><a href="javascript:void(0);" class="delete" rel="'.$row['title'.$core->dblang].'" id="item_"'.$row['id'].'"><img src="images/delete.png" alt="" class="tooltip" title="_DELETE:"'.$row['title'.$core->dblang].'"/></a></li>';

            endforeach;
            $display .= '</ul>';
            print $display;
        endif;
    endif;
endif;
?>
<?
if (isset($_POST['contactsearch'])
)
    : $string = sanitize($_POST['contactsearch'], 15);

    if (strlen($string) > 0
    )
        : $sql = "SELECT *"
        . "\n FROM contact where fname like '$_POST[contactsearch]%'";

        $display = '';
        if ($result = $db->fetch_all($sql)):
            $display .= '<ul id="searchresults">';
            foreach ($result as $row):
                $link = 'index.php?do=lists/contact&action=view&cid=' . (int)$row['id'];
                $display .= '<li><a href="' . $link . '" style="display: inline;" class="tooltip" title="view:' . $row['fname'] . '">' . $row['fname'] . '</a><a href="javascript:void(0);"  class="delete" rel="' . $row['fname'] . '" style="display: inline;align: right; " id="item_' . (int)$row['id'] . '"><img src="images/delete.png" alt="" class="tooltip" title="DELETE:' . $row['fname'] . '"/></a></li>';

            endforeach;
            $display .= '</ul>';
            print $display;
        endif;
    endif;
endif;
?>
<?
if (isset($_POST['publicworkssearch'])
)
    : $string = sanitize($_POST['publicworkssearch'], 15);

    if (strlen($string) > 0
    )
        : $sql = "SELECT *"
        . "\n FROM publicworks where fname like '$_POST[publicworkssearch]%'";
        //   echo $sql;die;
        $display = '';
        if ($result = $db->fetch_all($sql)):
            $display .= '<ul id="searchresults">';
            foreach ($result as $row):
                $link = 'index.php?do=publicworks&mod=events&mod_action=view&amp;publicworksid=' . (int)$row['id'];
                $display .= '<li><a href="' . $link . '" style="display: inline;">' . $row['fname'] . '</a><a href="javascript:void(0);"  class="delete" rel="' . $row['fname'] . '" style="display: inline;align: right; " id="item_' . (int)$row['id'] . '"><img src="images/delete.png" alt="" class="tooltip" title="_DELETE:' . $row['fname'] . '"/></a></li>';
            endforeach;
            $display .= '</ul>';
            print $display;
        endif;
    endif;
endif;
?>
<?
if (isset($_POST['belmarsurveysearch'])
)
    : $string = sanitize($_POST['belmarsurveysearch'], 15);

    if (strlen($string) > 0
    )
        : $sql = "SELECT *"
        . "\n FROM belmarsurvey where fname like '$_POST[belmarsurveysearch]%'";
        //   echo $sql;die;
        $display = '';
        if ($result = $db->fetch_all($sql)):
            $display .= '<ul id="searchresults">';
            foreach ($result as $row):
                $link = 'index.php?do=belmarsurvey&mod_action=view&belmarsurveyid=' . (int)$row['id'];
                $display .= '<li><a href="' . $link . '" style="display: inline;" class="tooltip" title="View:' . $row['fname'] . '">' . $row['fname'] . '</a><a href="javascript:void(0);"  class="delete" rel="' . $row['fname'] . '" style="display: inline;align: right; " id="item_' . (int)$row['id'] . '"><img src="images/delete.png" alt="" class="tooltip" title="Delete:' . $row['fname'] . '"/></a></li>';
            endforeach;
            $display .= '</ul>';
            print $display;
        endif;
    endif;
endif;
?>
<?php
/* Check Username */
if (isset($_POST['checkUsername'])):

    $username = trim(strtolower($_POST['checkUsername']));
    $username = $db->escape($username);

    $sql = "SELECT username FROM users WHERE username = '" . $username . "' LIMIT 1";
    $result = $db->query($sql);
    $num = $db->numrows($result);

    echo $num;

endif;
?>
<?php
/* Update Post Order */
if (isset($_GET['sortposts']) && $_GET['sortposts'] == 1) :
    foreach ($_GET['pid'] as $k => $v) :
        $p = $k + 1;

        $data['position'] = $p;

        $db->update("posts", $data, "id='" . intval($v) . "'");
    endforeach;
endif;
?>
<?php
/* Get Content Type */
if (isset($_GET['contenttype'])
)
    : $type = sanitize($_GET['contenttype']);
    $display = "";
    switch ($type)
        : case "page":
        $sql = "SELECT id, title{$core->dblang} FROM pages WHERE active = '1' ORDER BY title{$core->dblang} ASC";
        $result = $db->fetch_all($sql);

        $display .= "<select name=\"page_id\" class=\"custombox\" style=\"width:250px\">";
        if ($result
        )
            : foreach ($result as $row)
            : $display .= "<option value=\"" . $row['id'] . "\">page.&nbsp;&nbsp;" . $row['title' . $core->dblang] . "</option>\n";
        endforeach;
        endif;
        $display .= "</select>\n";
        break;
        case "web":

            $display .= "<input name=\"web\" type=\"text\" class=\"inputbox required\"
	  value=\"" . post('Off-site_URL') . "\" size=\"45\" />
	  &nbsp;" . tooltip(_MU_LINK_T) . "
	  <select name=\"target\" style=\"width:100px\" class=\"custombox\">
          <option value=\"\">" . _MU_TARGET . "</option>
		  <option value=\"_blank\">" . _MU_TARGET_B . "</option>
		  <option value=\"_self\">" . _MU_TARGET_S . "</option>
        </select>
	  <input name=\"page_id\" type=\"hidden\" value=\"0\" />";


            break;
        case "module" :
            $sql = "SELECT id, title{$core->dblang}, modalias FROM modules WHERE active = '1' AND system = '1' ORDER BY title{$core->dblang} ASC";
            $result = $db->fetch_all($sql);

            if ($result):
                $display .= "<select name=\"mod_id\" class=\"custombox\" style=\"width:250px\">";

                foreach ($result as $row)
                    : $display .= "<option value=\"" . $row['id'] . "\">module.&nbsp;&nbsp;" . $row['title' . $core->dblang] . "</option>\n";
                endforeach;

                $display .= "</select>\n";
            endif;

            break;

        case "On-site_Content":

//  $display.=calleditor();


            break;
        case "file_upload":

            $display .= "<input type=\"file\" name=\"file_upload\" size=\"45\" >";
            //  $display .="<input type=\"text\" name=\"filename\" size=\"45\">";

            break;
        case "file_upload_name":

//    $display .="<input type=\"text\" name=\"fileuploadname\" size=\"45\" class=\"inputbox required\">"
//      ."<input name=\"page_id\" type=\"hidden\" value=\"0\" />";


            $display .= "<input type=\"text\" id=\"uploadinput\" name=\"fileuploadname\" size=\"45\" class=\"inputbox required\" /><a href=\"" . ADMINURL . "/index.php?do=filemanager&mode=selection" . "\" rel=\"iframe-full-full\" class=\"pirobox_gall1\" title=\"Select or upload a file\" rev=\"0\"><button class=\"button-sml\" id=\"file_selector\">Select  File</button></a><input name=\"page_id\" type=\"hidden\" value=\"0\" />
    <script>
    $().piroBox_ext({
        piro_speed : 700,
        bg_alpha : 0.5,
        piro_scroll : true
    });
    </script>
    ";


            break;

        case "Off-site_URL":

            $display .= "<input name=\"Off-site_URL\" type=\"text\" class=\"inputbox required\"
	  value=\"" . post('Off-site_URL') . "\" size=\"45\" />
	  &nbsp;" . tooltip(_MU_LINK_T) . "
	  <select name=\"target\" style=\"width:100px\" class=\"custombox\">
          <option value=\"\">" . _MU_TARGET . "</option>
		  <option value=\"_blank\">" . _MU_TARGET_B . "</option>
		  <option value=\"_self\">" . _MU_TARGET_S . "</option>
        </select>
	  <input name=\"page_id\" type=\"hidden\" value=\"0\" />";

            break;
        default:
            $display .= "<select name=\"page_id\" id=\"content_id\" class=\"custombox\" style=\"width:220px\">";
            $display .= "<option value=\"0\">" . _MU_NONE . "</option>";
            $display .= "</select>";
    endswitch;

    print $display;

endif;
?>
<?php
/* Update Layout */

if (isset($_GET['layout'])
)
    : $sort = sanitize($_GET['layout']);
    $idata = (isset($_GET['modslug'])) ? 'mod_id' : 'page_id';

    @$sorted = str_replace("list-", "", $_POST[$sort]);
    if ($sorted
    )
        : foreach ($sorted as $plug_id)
        : list($order, $plug_id) = explode("|", $plug_id);
        $stylename = explode("-", $sort);
        $page_id = $stylename[1];
        if ($stylename[0] == "default"
        )
            //continue;
            $db->delete("layout", "plug_id='" . (int)$plug_id . "' AND $idata = '" . (int)$page_id . "'");

        $data = array(
            'plug_id' => $plug_id,
            'page_id' => (isset($_GET['pageslug'])) ? $page_id : 0,
            'mod_id' => (isset($_GET['modslug'])) ? $page_id : 0,
            'page_slug' => (isset($_GET['pageslug'])) ? sanitize($_GET['pageslug']) : "",
            'modalias' => (isset($_GET['modslug'])) ? sanitize($_GET['modslug']) : "",
            'place' => $stylename[0],
            'position' => $order
        );

        if ($stylename[0] != "default") :
            $db->delete("layout", "plug_id='" . (int)$plug_id . "' AND $idata = '" . (int)$page_id . "'");
            $db->insert("layout", $data);
        endif;
    endforeach;
    endif;

endif;

?>
<?php
/* Remote Links */
if (isset($_GET['linktype']) && $_GET['linktype'] == "internal"):
    $display = "";
    $display .= "<select name=\"content_id\" class=\"inpSel\" id=\"content_id\"onChange=\"updateChooser(this.value);\">";
    $display .= "<option value=\"NA\">" . _RL_SELECT . "</option>\n";

    $sql = $db->query("SELECT slug, title{$core->dblang}"
        . "\n FROM pages"
        . "\n ORDER BY title{$core->dblang} ASC");

    while ($row = $db->fetch($sql))
        : $title = $row['title' . $core->dblang];

        $link = str_replace(SITEURL, "", createPageLink($row['slug']));
        $display .= "<option value=\"" . $link . "\">" . $title . "</option>\n";
    endwhile;
    $display .= "</select>\n";
    echo $display;
endif;
?>
<?php
/* Delete Language */
if (isset($_POST['deleteLanguage'])):
    $flag_id = sanitize($_POST['deleteLanguage'], 2);
    set_time_limit(120);
    $core->deleteLanguage($flag_id);
endif;
?>
<?php
/* Delete Statistics */
if (isset($_POST['deleteStats'])):
    $action = $db->query("TRUNCATE TABLE stats");
    print ($action) ? $hollysec->writeLog(_MN_STATS_EMPTY, "", "no", "content") . $core->msgOk(_MN_STATS_EMPTY) : $core->msgAlert(_SYSTEM_PROCCESS);
endif;
?>
<?php
/* Delete SQL Backup */
if (isset($_POST['deleteBackup'])) :
    $action = @unlink(HCODE . 'admin/backups/' . sanitize($_POST['deleteBackup']));

    print ($action) ? $hollysec->writeLog(_BK_DELETE_OK, "", "no", "database") . $core->msgOk(_BK_DELETE_OK) : $core->msgAlert(_SYSTEM_PROCCESS);
endif;
?>
<?php
/* Delete Logs */
if (isset($_POST['deleteLogs'])):
    $action = $db->query("TRUNCATE TABLE log");
    print ($action) ? $hollysec->writeLog(_LG_STATS_EMPTY, "", "no", "content") . $core->msgOk(_LG_STATS_EMPTY) : $core->msgAlert(_SYSTEM_PROCCESS);
endif;
?>




