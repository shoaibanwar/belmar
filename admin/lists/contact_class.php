<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HollyCode2
 * Date: 6/27/12
 * Time: 12:56 PM
 * To change this template use File | Settings | File Templates.
 */
class Contact
{

    public static function getContacts($dep_id = '')
    {
        global $db;


        //handle pagination
        $paginate = "LIMIT 0";
        if(isset($_GET['pageNumber']))
        {
            $pageNum =$_GET['pageNumber']-1;
            $paginate = (isset($_GET['ipp']))?"LIMIT ".$pageNum * $_GET['ipp']:"LIMIT ".$pageNum*10;
        }
        if(isset($_GET['ipp']))
        {
            $ipp = $_GET['ipp'];
            $paginate .= ", $ipp";
        }
        else
        {
            $paginate .= ",10";
        }

        $clause = (isset($clause)) ? $clause : null;

        if (isset($_REQUEST['search'])) {

            $clause .= " WHERE fname like '" . $_REQUEST['search'] . "%'";
        }

        //Handle department filtering
        if($dep_id !='')
        {
            $dep_id = $dep_id;
            $where = " WHERE dep_id=$dep_id";
        }
        else
            $where = " ";

        $sql = "SELECT * FROM contact " . $where ." " . $paginate ;


        $contacts = $db->enableEscape()->fetch_all($sql);

        return $contacts;
    }

    public static function getContact($id)
    {
        global $db , $user;
        $sql = "SELECT * FROM contact WHERE id= $id";
        $contact = $db->enableEscape()->first($sql);

        if(!$user->checkOperationPermission('contact_form_all') && !$user->checkOperationPermission('contact_form_own'))
            exit('You do not have permission to do this.');
        if(!$user->checkOperationPermission('contact_form_all'))
        {
            $dep_id = $db->first("SELECT department_id FROM users WHERE id = '$user->uid'");
            $dep_id = $dep_id['department_id'];
            if($contact['dep_id'] != $dep_id)
                exit('You do not have permission to do this.');
        }

        return $contact;
    }


    public  static function  getallcontacts()
    {

        global $db, $pager, $core , $user;


        if(!$user->checkOperationPermission('contact_form_own') && !$user->checkOperationPermission('contact_form_all'))
        {
            exit('You do not have permission to do this.');
        }

        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();

        if(!$user->checkOperationPermission('contact_form_all'))
        {
            $dep_id = $db->first("SELECT department_id FROM users WHERE id= $user->uid");
            $dep_id = $dep_id['department_id'];
            if($dep_id ==0)
                exit('You do not have permission to do this.');
            $counter = countEntries("contact WHERE dep_id=$dep_id");
        }
        else
        {
            $counter = countEntries("contact");
        }

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
            if (in_array($sort, array("fname","lname","email","dep_id","date_created"))) {
                $ord = ($order == 'DESC') ? " DESC" : " ASC";
                $sorting = " u." . $sort . $ord;
            } else {
                $sorting = " u.date_created DESC";
            }
        }
        else
        {
            $sorting = " u.date_created DESC";
        }

        $clause = (isset($clause)) ? $clause : null;

        if (isset($_REQUEST['search']))
        {
            $clause= " WHERE u.fname like '%" . $_REQUEST['search'] . "%'";
        }
        if (isset($_GET['dep_id']) && $_GET['dep_id']!="all")
        {
            $clause= " WHERE u.dep_id ='" . $_GET['dep_id'] . "'";
        }
        if(isset($_REQUEST['search']) && isset($_GET['dep_id']) && $_GET['dep_id']!="all")
        {
            $clause= " WHERE u.fname like '%" . $_REQUEST['search'] . "%' and u.dep_id ='" . $_GET['dep_id'] . "'";
        }


        if(!$user->checkOperationPermission('contact_form_all'))
        {
            $dep_id = $db->first("SELECT department_id FROM users WHERE id= $user->uid");
            $dep_id = $dep_id['department_id'];
            if(isset($clause))
            {
               $clause .= " AND dep_id=$dep_id";
            }
            else
            {
                $clause = " WHERE dep_id=$dep_id";
            }
        }

        $sql = "SELECT * "
            . "\n    FROM contact as u"
            . "\n " . $clause
            . "\n ORDER BY " . $sorting . $pager->limit;




        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;

    }



    
    public static  function getcontactFilter()
    {
        $arr = array(
            'fname-ASC' => _Press_contact_fname . ' &uarr;',
            'fname-DESC' => _Press_contact_fname . ' &darr;',
            'lname-ASC' => _Press_contact_lname . ' &uarr;',
            'lname-DESC' => _Press_contact_lname . ' &darr;',
            'email-ASC' => _Press_contact_email . ' &uarr;',
            'email-DESC' => _Press_contact_email . ' &darr;',
            'dep_id-ASC' => _Press_contact_dep_id . ' &uarr;',
            'dep_id-DESC' => _Press_contact_dep_id . ' &darr;',
            'date_created-ASC' => _Press_contact_date_created . ' &uarr;',
            'date_created-DESC' => _Press_contact_date_created . ' &darr;',
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

    public static function deletePost($id)
    {
        global $db;
        if($db->delete('contact',"id=$id"))
            return true;
        return false;
    }
    public static function getPages()
    {
        global $db;
        $sql = "SELECt count(id) as count FROM contact";
        $count = $db->first($sql);
        $count = $count['count'];
        $pages = (isset($_GET['ipp']))?ceil($count/$_GET['ipp']):ceil($count / 10);
        return $pages;

    }
}
