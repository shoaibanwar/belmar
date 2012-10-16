<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HollyCode2
 * Date: 7/2/12
 * Time: 11:53 AM
 * To change this template use File | Settings | File Templates.
 */
class mailing_list
{

    public static function getSubscribers()
    {
        global $db, $pager, $core , $user;

        if(!$user->checkOperationPermission('mailing_list'))
            exit('You do not have permission to do this.');

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();
        $counter = countEntries("mailing_list");
        $pager->items_total = $counter;
        $pager->default_ipp = $core->perpage;
        $pager->paginate();

        if ($counter == 0)
        {
            $pager->limit = null;
        }
        if (isset($_GET['sort']))
        {
            list($sort, $order) = explode("-", $_GET['sort']);
            $sort = sanitize($sort);
            $order = sanitize($order);
            if (in_array($sort, array("fname","lname","email"))) {
                $ord = ($order == 'DESC') ? " DESC" : " ASC";
                $sorting = " u." . $sort . $ord;
            } else {
                $sorting = " u.fname DESC";
            }
        }
        else
        {
            $sorting = " u.fname DESC";
        }

        $clause = " WHERE u.active=1 ";
        $clause = (isset($clause)) ? $clause : null;

        if (isset($_REQUEST['search']))
        {
            $clause .= " AND (u.fname like '%" . $_REQUEST['search'] . "%' OR u.lname like '%" . $_REQUEST['search'] . "%' OR u.email like '%" . $_REQUEST['search'] . "%')";
        }

        $sql = "SELECT * "
            . "\n    FROM mailing_list as u"
            . "\n " . $clause
            . "\n ORDER BY " . $sorting . $pager->limit;



        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;

    }
    public static function getPages()
    {
        global $db;
        $sql = "SELECt count(id) as count FROM mailing_list";
        $count = $db->first($sql);
        $count = $count['count'];
        $pages = (isset($_GET['ipp']))?ceil($count/$_GET['ipp']):ceil($count / 10);
        return $pages;

    }
}
