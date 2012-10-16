<?php
  /**
   * Rss
   *
   * @package HollyCode CMS
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: rss.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("init.php");


  header("Content-Type: text/xml");
  header('Pragma: no-cache');
  echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
  echo "<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\n\n";
  echo "<channel>\n";
  echo "<title><![CDATA[".$core->site_name."]]></title>\n";
  echo "<link><![CDATA[".$core->site_url."]]></link>\n";
  echo "<description><![CDATA[Latest 20 Rss Feeds - ".$core->company."]]></description>\n";
  echo "<generator>".$core->company."</generator>\n";
/*
$sql = "SELECT pt.*, pt.id as id, pg.id as pageid, pg.title{$core->dblang} as pagetitle, pg.slug,"
. "\n DATE_FORMAT(pg.created, '%a, %d %b %Y %T GMT') as created"
. "\n FROM posts AS pt"
. "\n LEFT JOIN pages AS pg ON pg.id = pt.page_id"
. "\n WHERE pt.active = 1"
. "\n ORDER BY pg.id LIMIT 20";*/


$sql = "SELECT title_en , body_en , slug , created FROM pages ORDER BY created DESC limit 20";

$pages = $db->fetch_all($sql);


$sql = "SELECT title as title_en , alert_content as body_en, post_date as created, slug FROM belmaralerts WHERE item_published=1 ORDER BY post_date DESC limit 20";

$alerts = $db->fetch_all($sql);

$sql = "SELECT title_en , on_site_content as body_en , post_date as created , slug FROM pressroom WHERE status=1 AND on_site_content<>'' ORDER BY post_date DESC limit 20";

$news = $db->fetch_all($sql);

$sql = "SELECT title_en ,  body_en , date_start as created , slug FROM mod_events WHERE active=1 ORDER BY date_start DESC limit 20";

$events = $db->fetch_all($sql);

foreach($pages as &$page)
{
    $page['type']='page';
}
foreach($alerts as &$alert)
{
    $alert['type']='alert';
}
foreach($news as &$new)
{
    $new['type']='news';
}
foreach($events as &$event)
{
    $event['type']='event';
}

$data = array_merge($pages,$alerts,$news,$events);


usort($data,'sort_date');

$count = 0;
  foreach ($data as $row) {

      if(++$count>20)
          break;

      $title = $row['title'.$core->dblang];
	  $text = $row['body'.$core->dblang];
      $body = cleanSanitize($text,400);
      $date = $row['created'];
      $slug = $row['slug'];
      $type = $row['type'];



      $url = "";
      switch($type)
      {
          case 'news':
              $url = $url = $core->site_url . '/pressroom/' . sanitize($slug,50) . '.html';
              break;
          case 'alert':
              $url = $url = $core->site_url . '/alert/' . sanitize($slug,50) . '.html';
              break;
          case 'page':
              $url = $url = $core->site_url . '/page/' . sanitize($slug,50) . '.html';
              break;
          case 'event':
              $url = $url = $core->site_url . '/events/' . sanitize($slug,50) . '.html';
              break;
      }

      echo "<item>\n";
      echo "<title><![CDATA[$title]]></title>\n";
      echo "<link><![CDATA[$url]]></link>\n";
      echo "<guid isPermaLink=\"true\"><![CDATA[$url]]></guid>\n";
      echo "<description><![CDATA[$body]]></description>\n";
      echo "<pubDate><![CDATA[$date]]></pubDate>\n";
      echo "</item>\n";
  }
  unset($row);
  echo "</channel>\n";
  echo "</rss>";
?>