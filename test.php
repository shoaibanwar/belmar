<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HollyCode2
 * Date: 7/5/12
 * Time: 10:26 AM
 * To change this template use File | Settings | File Templates.
 */
//define("_VALID_PHP", true);
//require "init.php";
//$alerts = $db->fetch_all("SELECT * FROM mod_events");
//foreach ($alerts as $alert)
//{
//    $alert['slug']= paranoia($alert['title_en']);
//    $db->update('mod_events',$alert,"id={$alert['id']}");
//}
//echo "done";
//$arr = array(array('a'=>1,'b'=>2),array('a'=>1,'b'=>2));
//foreach($arr as &$ar){
//    $ar['c']=3 ;
////    echo $ar['c'];
//}
//print_r($arr);

echo html_entity_decode("&lt;p&gt;&lt;img width=&quot;150px&quot; height=&quot;98px&quot; src=&quot;http://localhost/projects/belmar/uploads/logo2.png&quot; alt=&quot;thumb_demo_1.jpg&quot; style=&quot;padding: 5px; margin-right: 15px; float: left; border: 1px solid rgb(226, 226, 226); background-image: none; background-attachment: scroll; background-color: rgb(238, 238, 238); background-position: 0% 0%; background-repeat: repeat repeat; &quot; title=&quot;thumb_demo_1.jpg&quot; /&gt;Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla posuere nibh auctor urna tincidunt fringilla. &lt;br /&gt;
	Donec imperdiet, orci quis aliquet laoreet, magna purus semper ligula, sit amet aliquam sapien enim in orci. Pellentesque at iaculis nibh.&lt;/p&gt;
&lt;p&gt;[URL]&lt;br /&gt;
	&lt;/p&gt;  ");