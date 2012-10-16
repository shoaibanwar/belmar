<?php
  /**
   * Controller
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: controller.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  
  require_once("../../init.php");
  if ( !$user->is_Admin() && !isset($_POST['hash']) && $_POST['hash'] != $this->getHash() )
      redirect_to("../../login.php");

  require_once("lang/" . $core->language . ".lang.php");
  require_once("admin_class.php");
  $gal = new Gallery();
?>
<?php
  /* Update Configuration*/
  if (isset($_POST['processGallery'])):
  $gal->galid = (isset($_POST['galid'])) ? $_POST['galid'] : 0; 
  $gal->updateConfig();
  endif;
?>
<?php
    /*Check if a gallery exists*/
    if(isset($_POST['title'])&&isset($_POST['galExists'])):
    $gallery = $db->first("SELECT id FROM mod_gallery_config WHERE title_en='{$_POST['title']}'");

    if($gallery)
    {
        echo json_encode(array('exists'=>$gallery['id']));
    }
    else
    {
        echo json_encode(array('exists'=>0));
    }
    exit();
    endif;
?>
<?php
  /* Delete Gallery */
  if (isset($_POST['deleteGallery']))
      : if (intval($_POST['deleteGallery']) == 0 || empty($_POST['deleteGallery']))
      : redirect_to("index.php?do=modules&action=config&mod=galler");
  endif;
  
  $id = intval($_POST['deleteGallery']);
  $folder = getValue("folder", "mod_gallery_config", "id='" . $id . "'");
  $dirname = HCODE . $gal->galpath . $folder;
  
  delete_directory($dirname);

  $action = $db->delete("mod_gallery_config", "id='" . $id . "'");
  $db->delete("mod_gallery_images", "gallery_id='" . $id . "'");
  $pageId = $db->first("SELECT id FROM pages WHERE module_data='$id'");
  $pageId = $pageId['id'];
  $db->delete('pages',"module_data='". $id . "'");
  $db->delete('posts',"page_id='". $pageId . "'");
  $db->delete('menus',"page_id='". $pageId . "'");

  $title = sanitize($_POST['galtitle']);
  
  print ($action) ? $hollysec->writeLog(_GALLERY .' <strong>'.$title.'</strong> '._DELETED, "", "no", "module") . $core->msgOk(_GALLERY .' <strong>'.$title.'</strong> '._DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
  endif;
?>
<?php
  /* Update Gallery Order */
  if (isset($_GET['sortgallery']) && $_GET['sortgallery'] == 1) :
      foreach ($_POST['item'] as $k => $v) :
          $p = $k + 1;
          
          $data['sorting'] = $p;
          
          $db->update("mod_gallery_images", $data, "id='" . intval($v) . "'");
      endforeach;
 endif;
?>
<?php
  /* Delete Image */
  if (isset($_POST['deleteImage'])): 
  
  list($id, $folder) = explode(":", $_POST['deleteImage']);
  
  $id = intval($id);
  $folder = sanitize($folder);
  $dirname = HCODE . $gal->galpath . $folder;
  
  $img = getValue("thumb", "mod_gallery_images", "id='" . $id . "'");
  
  @unlink($dirname . '/'.$img);
  @unlink($dirname . '/thumbs/'.$img);

  $db->delete("mod_gallery_images", "id='" . $id . "'");
  $title = sanitize($_POST['imgtitle']);
  
  print ($db->affected()) ? $hollysec->writeLog(_IMAGE .' <strong>'.$title.'</strong> '._DELETED, "", "no", "module") . $core->msgOk(_IMAGE .' <strong>'.$title.'</strong> '._DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
  endif;

  /* Update Image */
  if (isset($_POST['imgid']))
      : if ((intval($_POST['imgid']) == 0))
      : redirect_to("index.php?do=modules&action=config&mod=gallery");
  endif;
  
  $id = intval($_POST['imgid']);
  
  $data['title'.$core->dblang] = sanitize($_POST['title']);
  $data['description'.$core->dblang] = sanitize($_POST['desc']);
  
  $db->update("mod_gallery_images", $data, "id='" . $id . "'");
    
  print ($db->affected()) ? $hollysec->writeLog(_IMAGE .' <strong>'.$data['title'.$core->dblang].'</strong> '._UPDATED, "", "no", "module") . $core->msgOk(_IMAGE .' <strong>'.$data['title'.$core->dblang].'</strong> '._UPDATED) : $core->msgAlert(_SYSTEM_PROCCESS);
  endif;
?>
<?php
	if (isset($_POST['uploadimage'])) {
        //file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR.'error.txt',print_r($_SESSION,1))    ;
		set_time_limit(240);

		$id = intval($_POST['id']);
		$row = $db->first("SELECT * FROM mod_gallery_config WHERE id = '" . $id . "'");

		include(HCODE . "lib/class_imageUpload.php");
		include(HCODE . "lib/class_imageResize.php");
		
		$galdir = HCODE . $gal->galpath . $row['folder'] . "/";
		$newName = "IMG_" . randName();
		$ext = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
		$name = $newName.".".strtolower($ext);
		
		$bdp = new Upload();
		$bdp->File = $_FILES['image'];
		$bdp->method = $row['method'];
		$bdp->SavePath = $galdir;
		$bdp->ThumbPath = $galdir . "thumbs/";
		$bdp->TWidth = $row['thumb_w'];
		$bdp->THeight = $row['thumb_h'];
		$bdp->NewWidth = $row['image_w'];
		$bdp->NewHeight = $row['image_h'];
		$bdp->NewName = $newName;
		$bdp->OverWrite = true;

		$err = $bdp->UploadFile();


		
		$data['gallery_id'] = $id;
		$data = array(
			  'gallery_id' => $id,
			  'thumb' => sanitize($name), 
			  'title'.$core->dblang => "Img Title",
			  'description'.$core->dblang => "Img Description"
		);
		$db->insert("mod_gallery_images",$data);
		
		if (count($err) > 0 and is_array($err)) {
			foreach ($err as $key => $val) {
				print $val;
			}
		}
        if(preg_match("/(.jpg|.jpeg|.gif|.bmp|.png)$/i",$name))
        {

            if(preg_match("/(.jpg|.jpeg)$/i",$name))
                $type=2;
            else if(preg_match("/.gif$/i",$name))
                $type=3;
            else if(preg_match("/.bmp$/i",$name))
                $type=5;
            else if(preg_match("/.png$/i",$name))
                $type=4;

            require HCODE . "/includes/class.rwatermark.php";

//            file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR.'error.txt',print_r('sds',1))    ;
            $handle = new RWatermark(2, $galdir.$name);

            $handle->SetPosition($core->watermark_position);
            $handle->SetTransparentColor(255, 0, 255);
            $handle->SetTransparency($core->watermark_transparency);
            $handle->AddWatermark(FILE_PNG, HCODE."admin/modules/gallery/watermark.png");
            ob_start();
            $handle->GetMarkedImage(IMG_PNG);
            $image = ob_get_clean();
            file_put_contents($galdir.$name,$image);

            $handle->Destroy();
        }
		print "OK|".$data['thumb']."|".$db->insertid()."|".$data['title'.$core->dblang]."|".$data['description'.$core->dblang];
	}

if(isset($_POST['cover']))
{
    if($gal->setCoverImage($_POST['pid']))
        echo "1";
    else
        echo false;
}
?>