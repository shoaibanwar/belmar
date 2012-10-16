<?php
  /**
   * loadComments
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: loadComments.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("../../init.php");
  
  require_once(HCODE . "admin/modules/comments/admin_class.php");
  require_once(HCODE . "admin/modules/comments/lang/" . $core->language . ".lang.php");
  $com = new Comments();
  
  $page = sanitize($_GET['pg']);
  $page = (int)$page;

  $page_id = sanitize($_GET['pageid']);
  $page_id = (int)$page_id;
  
  $commentTree = array();

  /**
   * getCommentTree()
   *
   * @param integer $page
   * @param integer $page_id
   * @return
   */
  function getCommentTree($page, $page_id)
  {
      global $db, $com;

      $start = ($page - 1) * $com->perpage;
	  $limit = $start.','.$com->perpage;

      $sql = "SELECT c.*, DATE_FORMAT(c.created, '" . $com->dateformat . "') as cdate, u.avatar" 
	  . "\n FROM mod_comments as c" 
	  . "\n LEFT JOIN users as u ON u.id = c.user_id" 
	  . "\n WHERE page_id = " . $db->escape($page_id)
	  . "\n AND c.active = '1'" 
	  . "\n ORDER BY c.created " . $com->sorting . " LIMIT  ". $limit;
	  
      $query = $db->query($sql);
      $commentTree = '';
      while ($row = $db->fetch($query)) {
          $commentTree[$row['id']] = array(
			  'id' => $row['id'], 
			  'parent_id' => $row['parent_id'], 
			  'page_id' => $row['page_id'], 
			  'username' => $row['username'], 
			  'avatar' => $row['avatar'], 
			  'email' => $row['email'], 
			  'www' => $row['www'],
			  'body' => $row['body'], 
			  'cdate' => $row['cdate'],
			  'created' => $row['created']
		  );
      }
      return $commentTree;
  }
  
  /**
   * renderComments()
   *
   * @param mixed $array
   * @param integer $parent_id
   * @return
   */
  function renderComments($array, $parent_id = 0)
  {
      global $com, $user;
      
      if ($array) {
          $subtree = false;
          
          foreach ($array as $key => $row) {
              if ($row['parent_id'] == $parent_id) {
                  if ($subtree === false) {
                      $subtree = true;
                      
                      print "<ul>\n";
                  }
                  
                  ob_start();
                  include(MODDIR . "/comments/template.tpl.php");
                  $html = ob_get_contents();
                  ob_end_clean();
                  
                  print '<li class="comment" id="comment-' . $row['id'] . '">';
                  print $html;
                  renderComments($array, $key);
                  print "</li>\n";
              }
          }
          unset($row);
          
          if ($subtree === true)
              print "</ul>\n";
      }
  }
  $data = getCommentTree($page, $page_id);
?>
<?php echo renderComments($data,0);?>