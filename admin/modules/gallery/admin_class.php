<?php

/**
 * Gallery Class
 *
 * @package HollyCode CMS
 * @author HollyCode.com
 * @copyright 2010
 * @version $Id: class_admin.php, v2.00 2011-04-20 10:12:05 gewa Exp $
 */
if (!defined("_VALID_PHP"))
    die('Direct access to this location is not allowed.');

class Gallery
{

    private $mTable = "mod_gallery_images";
    private $cTable = "mod_gallery_config";
    public $galid = null;
    public $galpath = "modules/gallery/galleries/";

    /**
     * Gallery::__construct()
     * 
     * @param bool $galid
     * @return
     */
    function __construct($galid = false)
    {
        $this->getGalleryId();
        $this->getConfig($galid);
    }

    /**
     * Gallery::getGalleryId()
     * 
     * @return
     */
    private function getGalleryId()
    {
        global $core;
        if (isset($_GET['galid']))
        {
            $galid = (is_numeric($_GET['galid']) && $_GET['galid'] > -1) ? intval($_GET['galid']) : false;
            $galid = sanitize($galid);

            if ($galid == false)
            {
                $core->error("You have selected an Invalid CommentId", "newsSlider::getCommentId()");
            } else
                return $this->galid = $galid;
        }
    }

    /**
     * Gallery::getConfig()
     * 
     * @param bool $galid
     * @return
     */
    private function getConfig($galid = false)
    {
        global $db, $core;
        $id = ($galid) ? $galid : $this->galid;
        $sql = "SELECT * FROM " . $this->cTable . " WHERE id = '" . $id . "'";
        $row = $db->first($sql);

        $this->title = $row['title' . $core->dblang];
        $this->folder = 'gallery'.$row['id'];
        $this->rows = $row['rows'];
        $this->thumb_w = $row['thumb_w'];
        $this->thumb_h = $row['thumb_h'];
        $this->image_w = $row['image_w'];
        $this->image_h = $row['image_h'];
        $this->watermark = $row['watermark'];
        $this->method = $row['method'];
        $this->created = $row['created'];
        $this->type = $row['type'];
        $this->published = $row['published'];
        $this->nav_title = $row['nav_title'];
    }

    public function getPages()
    {
        global $db;
        $sql = "SELECt count(id) as count FROM $this->cTable";
        $count = $db->first($sql);
        $count = $count['count'];
        $pages = (isset($_GET['ipp']))?ceil($count/$_GET['ipp']):ceil($count / 10);
        return $pages;

    }

    public function getGalleries($type = '',$search = '')
    {
        global $db, $core ,$pager, $user;
        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();
        $counter = countEntries("mod_gallery_config");
        $pager->items_total = $counter;
        $pager->default_ipp = $core->perpage;
        $pager->paginate();

        $permitted = $user->get_permitted_galleries();

        if ($counter == 0) {
            $pager->limit = null;
        }

        //Handle sorting
        $sort = "";
        if(isset($_GET['sort']))
        {
            $sortv = explode('-',$_GET['sort']);
            $sortName = $sortv[0];

            $sortDirection = $sortv[1];
            $sort = "ORDER BY $sortName $sortDirection";
        }

        //handle filtering by type
        if($user->userlevel ==9)
            if(!empty($type)) $where = " WHERE $this->cTable.type = $type ";
        else
        {
            if(in_array_recursive($type,$permitted))
                if(!empty($type)) $where = " WHERE $this->cTable.type = $type ";
        }



        //Handle search
        if(!empty($search))
        {
            if(isset($where))
                $where .= (!empty($type) || $user->userlevel !=9)?" AND $this->cTable.title_en LIKE '%$search%'":" WHERE $this->cTable.title_en LIKE '%$search%' ";
            else
                $where = (!empty($type) || $user->userlevel !=9)?" WHERE $this->cTable.title_en LIKE '%$search%'":" WHERE $this->cTable.title_en LIKE '%$search%' ";
        }
        if(isset($where))
        {
            $permitted = implode(',',$permitted);
            $where .= " AND type IN ($permitted) ";
        }
        else
        {
            $permitted = implode(',',$permitted);
            $where = " WHERE type IN ($permitted) ";
        }



        $sql = "SELECT *, DATE_FORMAT(created, '" . $core->long_date . "') as date,"
            . "\n (SELECT COUNT(" . $this->mTable . ".gallery_id) FROM " . $this->mTable . " WHERE " . $this->mTable . ".gallery_id = " . $this->cTable . ".id) as totalpics"
            . "\n FROM " . $this->cTable  .$where
            . "\n $sort $pager->limit";




        $row = $db->fetch_all($sql);
        foreach ($row as &$gal)
        {
            $types = $db->first("SELECT name_en FROM menus WHERE id = {$gal['type']}");
            $gal['type'] = $types['name_en'];
        }
        return ($row) ? $row : 0;
    }

    public static function getGalleryTypes()
    {
        global $db , $user;

        $permitted = $user->get_permitted_galleries();
        $permitted = implode(',',$permitted);
        $sql = "SELECT name_en,id FROM menus WHERE id IN($permitted)";
//        $sql = "SELECT name_en,id FROM menus WHERE id IN(24,27,28,29,30,31,33,34)";

        $types = $db->fetch_all($sql);
        return $types;
    }

    public function setCoverImage($pid)
    {
        global $db;

        $gallery = $db->enableEscape()->first("SELECT gallery_id FROM $this->mTable WHERE id = $pid");
        $gallery = $gallery['gallery_id'];

        $unset = "UPDATE $this->mTable SET cover = 0 WHERE gallery_id = $gallery ";
        $set = "UPDATE $this->mTable SET cover = 1 WHERE id = $pid";

        $db->query($unset);

        $db->query($set);
        if($db->affected())
            return true;
        return false;
    }

    public function getCoverImage($gid,$folder)
    {
        global $db;
        $sql = "SELECT thumb FROM $this->mTable WHERE gallery_id = $gid AND cover=1";
        $image = $db->first($sql);
        $image = $image['thumb'];
        if(trim($image)=='')
            return  ADMINURL.'/images/'."no-image.jpg";
        return SITEURL.'/'.$this->galpath.''.$folder.'/thumbs/'.$image;
    }

    public function checkGalleryPermission()
    {
        global $db , $user;
        if ($user->userlevel == 9)
            return true;
        $sql = "SELECT menu_id FROM $this->cTable WHERE id=$this->galid";
        $type = $db->first($sql);
        $type=$type['menu_id'];
        $permittedTypes = explode(',', $user->getPermittedTypes('gallery'));
        if (!in_array($type, $permittedTypes))
            return false;
        return true;
    }

    /**
     * Gallery::updateConfig()
     * 
     * @return
     */
    public function updateConfig()
    {
        global $db, $core, $hollysec;

        if (empty($_POST['title' . $core->dblang]))
            $core->msgs['title'] = MOD_GA_NAME_R;

        if(!$this->galid)
        {
            $title = $db->first("SELECT id FROM mod_gallery_config WHERE title_en='{$_POST['title_en']}'");
            if($title)
                $core->msgs['title'] = "Please choose another title! This one already exists.";
        }

        if (!in_array_recursive($_POST['type'], $this->getGalleryTypes()))
            $core->msgs['type'] = MOD_GA_TYPE_R;

        if (!$this->galid)
        {
            if (empty($_POST['rows']))
                $core->msgs['rows'] = MOD_GA_IPR_R;

        }

        if (empty($core->msgs))
        {

            if ($this->galid)
            {
                $data = array(
                    'title' . $core->dblang => sanitize($_POST['title' . $core->dblang]),
                    'type' => intval($_POST['type']),
                    'published' => intval($_POST['published']),
                    'nav_title' => sanitize($_POST['nav_title'])
                );
            }
            else
            {


                $data = array(
                    'title' . $core->dblang => sanitize($_POST['title' . $core->dblang]),
                    'rows' => intval($_POST['rows']),
                    'vert_rows' => intval($_POST['vert_rows']),
                    'thumb_w' => 100,
                    'thumb_h' => 100,
                    'image_w' => 650,
                    'image_h' => 650,
                    'method' => 1,
                    'watermark' => intval($_POST['watermark']),
                    'type' => intval($_POST['type']),
                    'published' => intval($_POST['published']),
                    'nav_title' => sanitize($_POST['nav_title'])
                );
            }
            if (!$this->galid)
            {
                $data['created'] = "NOW()";
            }

            ($this->galid) ? $res = $db->update($this->cTable, $data, "id='" . (int) $this->galid . "'") : $res = $db->insert($this->cTable, $data);
            $lsid = $db->insertid();
            $affected = $db->affected();
            if (!$this->galid)
                $db->update($this->cTable,array('folder'=>"gallery$lsid"),"id=$lsid");
            $message = ($this->galid) ? MOD_GA_UPDATED : MOD_GA_ADDED;



            if (!$this->galid)
            {
                //create page
                $pageData = array(
                    'title_en'=>!empty($_POST['nav_title'])?$_POST['nav_title']:$_POST['title_en'],
                    'slug'=>str_replace(' ','-',$_POST['title_en']),
                    'module_id'=>2,
                    'module_data'=>$lsid,
                    'module_name'=>'gallery',
                    'active'=>1,
                );
                $db->insert('pages', $pageData);

                $pageId = $db->insertid();
                //create post
                $postData = array(
                    'page_id'=>$pageId,
                    'page_slug'=> str_replace(' ','-',$_POST['title_en']),
                    'title_en'=> 'photos',
                    'active'=> 1
                );
                $db->insert('posts', $postData);


                //create menu
                $menuData = array(
                    'parent_id' => $_POST['type'],
                    'page_id' => $pageId,
                    'page_slug' => str_replace(' ','-',$_POST['title_en']),
                    'name_en' => !empty($_POST['nav_title'])?$_POST['nav_title']:$_POST['title_en'],
                    'slug' => $_POST['title_en'],
                    'content_type' => 'page',
                    'target' => '',
                    'active' => 1,
                );
                $db->insert('menus', $menuData);


                if (!is_dir(HCODE . $this->galpath . 'gallery'.$lsid))
                {
                    mkdir(HCODE . $this->galpath . 'gallery'.$lsid, 0755);
                    chmod(HCODE . $this->galpath . 'gallery'.$lsid, 0755);
                }
                if (!is_dir(HCODE . $this->galpath . 'gallery'.$lsid . "/thumbs"))
                {
                    mkdir(HCODE . $this->galpath . 'gallery'.$lsid . "/thumbs", 0755);
                    chmod(HCODE . $this->galpath . 'gallery'.$lsid . "/thumbs", 0755);
                }
            }
            else
            {
                $mid = $db->first("SELECT own_menu_id FROM mod_gallery_config WHERE id=$this->galid");
                $mid = $mid['own_menu_id'];
                $db->update('menus',array('parent_id'=>$_POST['type']),"id=$mid");
            }

            ($affected) ? $hollysec->writeLog($message, "", "no", "module") . $core->msgOk($message."<script>if(typeof onAdd !='undefined') {onAdd('".$lsid."');}</script>" ): $core->msgAlert(_SYSTEM_PROCCESS);
        } else
            print $core->msgStatus();
    }

    /**
     * Gallery::getGalleryImages()
     * 
     * @param bool $galid
     * @return
     */
    public function getGalleryImages($galid = false)
    {
        global $db, $pager, $core;
        require_once(HCODE . "lib/class_paginate.php");
        $pager = new Paginator();
        $id = ($galid) ? $galid : $this->galid;
        $sql="select * from mod_gallery_config where id=".$id;
        $res=  mysql_query($sql);
        if($res){
        $rowipp=  mysql_fetch_array($res);
        }
      //  echo $rowipp['rows'];die;
     //   echo $rowipp['vert_rows'];die;
        $itemperpage=$rowipp['rows']*$rowipp['vert_rows'];
//       echo $itemperpage;die;
        $counter = countEntries("mod_gallery_images","gallery_id",$id);
        $pager->items_total = $counter;
        $pager->default_ipp = $itemperpage;
        $pager->paginate();

        if ($counter == 0) {
            $pager->limit = null;
        }
    $sql = "SELECT * FROM " . $this->mTable
            . "\n WHERE gallery_id = '" . (int) $id . "'"
            . "\n ORDER BY sorting". $pager->limit;

        $row = $db->fetch_all($sql);

        return ($row) ? $row : 0;

    }


}
