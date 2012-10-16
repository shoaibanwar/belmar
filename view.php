<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HollyCode2
 * Date: 7/1/12
 * Time: 12:36 PM
 * To change this template use File | Settings | File Templates.
 */

define("_VALID_PHP", true);
require_once("init.php");

if (!defined("_VALID_PHP"))
    die('Direct access to this location is not allowed.');
?>

<?php include(THEMEDIR ."/header.php");?>

<?php $show = isset($_GET['show'])?$_GET['show']:'none'; ?>
<?php switch($show):
    case 'allEvents': ?>

<?php //---------------------------Show all events--------------------------------------------------------------------// ?>



     <div style="margin: 40px;margin-top: 20px;r">
         <h1 style="margin-bottom: 5px;">Belmar Events </h1>
         <p style="margin-bottom: 50px;">Below are important news items and information about the Borough of Belmar. Please click on any item to view it in detail.</p>

         <!--         --><?php //$page = isset($_GET['page'])?$_GET['page']:1; ?>
         <?php $events = $content->getEvents(); ?>
         <?php foreach($events as $event): ?>
         <?  $time_start=$event['time_start'];
         $time_start_format=date("h:i A",strtotime($time_start));
         $time_end=$event['time_end'];
         $time_end_format=date("h:i A",strtotime($time_end));

         ?>

         <p align="left"><span class="fbox">
                    <a  style="font-size: 20px!important;" href="<?php echo SITEURL; ?>/events/<?php echo $event['slug']; ?>.html"><b><?php echo $event['title_en']; ?></b></a><br>
             <?php echo $event['date_start']; ?> - <?php echo $time_start_format; ?> - <?php echo $time_end_format; ?><br>
                    </span></p>

         <div style="overflow: auto;"><?php echo html_entity_decode($event['body_en']); ?></div>
         <br />
          <p align="right" >
         <a href="<?php echo SITEURL; ?>/events/<?php echo $event['slug']; ?>.html"><span> Read more >> </span></a>
      </p>
         </br>

         <?php endforeach;?>

         <?php unset($event);?>
     <tr style="background-color:transparent">

             <td align="center">
                 <?php echo $pager->items_per_page();?> &nbsp;&nbsp;
                 <?php if($pager->num_pages >= 1) echo $pager->jump_menu();?></td>

         </tr>

         <?php if($pager->items_total >= $pager->items_per_page):?>

         <tr style="background-color:transparent">
             <td colspan="8" style="padding:10px;">
                 <div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
         </tr>



         <?php endif;?>



     </div>
<?php break; ?>

<?php
 case 'event': ?>

<?php //---------------------------Show one event--------------------------------------------------------------------// ?>

<div style="margin: 40px;margin-top: 20px;r">
    <h1 style="margin-bottom: 50px;">Belmar Event </h1>
    <?php
    if(isset($_GET['eventId']))
    {
        $event = $content->getEvent(0,$_GET['eventId']) ?>
        <?  $time_start=$event['time_start'];
        $time_start_format=date("h:i A",strtotime($time_start));
        $time_end=$event['time_end'];
        $time_end_format=date("h:i A",strtotime($time_end));

        ?>

        <p align="left"><span class="fbox">
             <b><?php echo $event['title_en']; ?></b><br>
            <?php echo $event['date_start']; ?> - <?php echo $time_start; ?> - <?php echo $time_end_format; ?><br>
            <?php echo $event['venue_en']; ?> <br>
         </span></p>

        <div style="overflow: auto;"><?php echo html_entity_decode($event['body_en']); ?></div>
        <br />
        <hr>
        <div style="text-align: right;">
            Contact Person: <?php echo $event['contact_person']; ?><br>
            Contact Email: <?php echo $event['contact_email']; ?><br>
            Contact Phone: <?php echo $event['contact_phone']; ?><br>
        </div>
        <?php } ?>
</div>

<?php break; ?>
<?php

    case 'page':

       $content->displayPage();
        break;


    case 'pressroom':
           ?>
         <div style="margin: 40px;margin-top: 20px;r">
         <h1 style="margin-bottom: 5px;">Belmar Pressroom </h1>
            <p style="margin-bottom: 50px;">Below are important news items and information about the Borough of Belmar. Please click on any item to view it in detail.</p>
<!--         --><?php //$page = isset($_GET['page'])?$_GET['page']:1; ?>
         <?php $items = $content->getPRItems(); ?>
         <?php foreach($items as $item): ?>
             <?php
             $post_data=$item['post_date'];
             $post_data_format=date("Y-m-d h:i A",strtotime($post_data));

             ?>
        <p align="left"  class="fbox"><span style="font-size: 13px;">
                    <a style="font-size: 20px!important;" href="<?php echo SITEURL; ?>/pressroom/<?php echo $item['slug']; ?>.html"><?php echo $item['title_en']; ?></a><br>
            Added on:<?php echo $post_data_format; ?><br>
                    </span></p>

        <div style="overflow: auto;">
        <?php if($item['type']=="Off-site_URL")
               {
                   ?>
                   <a href="http://<?php echo $item['off_site_url'] ?>" target="<?php echo $item['target'] ?> ">

                   <? echo  $item['off_site_url']; ?></a>
            <?
               }elseif($item['type']=="On-site_Content"){

                   echo html_entity_decode($item['on_site_content']); ?>
               <? }else{
            ?>
            <?php $path="uploads/";

            ?>
            <a href="<?php echo SITEURL ?>/download.php?file=<?php echo $path.$item['file_upload']; ?>" >
              <?     echo $item['file_upload'] ?>

            </a>

            <?  } ?>



</div>


        <br />
              <p align="right" >
             <a href="<?php echo SITEURL; ?>/pressroom/<?php echo $item['slug']; ?>.html"><span> Read more >> </span></a>
       </p>
             </br>
        <?php endforeach;?>
        <?php unset($item);?>
             <tr style="background-color:transparent">

                 <td align="center">
                     <?php echo $pager->items_per_page();?> &nbsp;&nbsp;
                     <?php if($pager->num_pages >= 1) echo $pager->jump_menu();?></td>
             </tr>
             <?php if($pager->items_total >= $pager->items_per_page):?>

             <tr style="background-color:transparent">
                 <td colspan="8" style="padding:10px;">
                     <div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
             </tr>
             <?php endif;?>

     </div>

<?php
        break;



    case 'pritem': ?>
        <div style="margin: 40px;margin-top: 20px;r">
    <h1 style="margin-bottom: 50px;">Press room item </h1>
         <?php
    if(isset($_GET['slug']))
    {
        $item = $content->getPRItem($_GET['slug']) ?>

      <?  $post_data=$item['post_date'];
        $post_data_format=date("Y-m-d h:i A",strtotime($post_data));
        ?>


    <p align="left" class="fbox" ><span style="font-size: 13px">
             <b><?php echo $item['title_en']; ?></b><br>
        <?php echo $post_data_format ?><br>
         </span></p>

    <div style="overflow: auto;">
        <?php if($item['type']=="Off-site_URL")
    {
        ?>
        <a href="http://<?php echo $item['off_site_url'] ?>" target="<?php echo $item['target'] ?> ">

            <? echo  $item['off_site_url']; ?></a>
        <?
    }elseif($item['type']=="On-site_Content"){

        echo $item['on_site_content'] ?>
        <? }else{
        ?>
        <?php $path="uploads/";

        ?>
        <a href="<?php echo SITEURL ?>/download.php?file=<?php echo $path.$item['file_upload']; ?>" >
            <?     echo $item['file_upload'] ?>

        </a>

        <?  } ?>


    </div>
    <br />
    <hr>
    <?php } ?>
</div>

<?php
        break;
    case 'alert': ?>
    <div style="margin: 40px;margin-top: 20px;r">
        <h1 style="margin-bottom: 50px;">Belmar Alert </h1>
        <?php
        if(isset($_GET['slug']))
        {
            $item = $content->getBelmaralertItem($_GET['slug']) ?>

            <?  $post_data=$item['post_date'];
            $post_data_format=date("Y-m-d h:i A",strtotime($post_data));
            ?>


            <p align="left" class="fbox" ><span style="font-size: 13px">
             <b><?php echo $item['title']; ?></b><br>
                <?php echo $post_data_format; ?><br>
         </span></p>

            <div style="overflow: auto;"><?php echo html_entity_decode($item['alert_content']); ?></div>
            <br />
            <hr>
            <?php } ?>
    </div>

    <?php
    break;



    case 'alerts':
        ?>
        <div style="margin: 40px;margin-top: 20px;r">
            <h1 style="margin-bottom: 5px;">Belmar Alerts </h1>
            <p style="margin-bottom: 50px;">Below are important news items and information about the Borough of Belmar. Please click on any item to view it in detail.</p>
<!--            --><?php //$page = isset($_GET['page'])?$_GET['page']:1; ?>
            <?php $items = $content->getBelmartAlerts(); ?>
            <?php foreach($items as $item): ?>
            <?  $post_data=$item['post_date'];
            $post_data_format=date("Y-m-d h:i A",strtotime($post_data));
            ?>


            <p align="left"  class="fbox"><span style="font-size: 13px;" >
                    <a style="font-size: 20px!important;" href="<?php echo SITEURL; ?>/alert/<?php echo $item['slug']; ?>.html"><h2><?php echo $item['title']; ?></h2></a><br>
            Added on:<?php echo $post_data_format; ?><br>
                    </span></p>

            <div style="overflow: auto;"><?php echo html_entity_decode($item['alert_content']); ?></div>
            <br />
                 <p align="right" >
            <a href="<?php echo SITEURL; ?>/alert/<?php echo $item['slug']; ?>.html"><span> Read more >> </span></a>
           </p>
            </br>
            <?php endforeach;?>
  <?php unset($item);?>
            <tr style="background-color:transparent">

                <td align="center">
                    <?php echo $pager->items_per_page();?> &nbsp;&nbsp;
                    <?php if($pager->num_pages >= 1) echo $pager->jump_menu();?></td>
            </tr>

            <?php if($pager->items_total >= $pager->items_per_page):?>

            <tr style="background-color:transparent">
                <td colspan="8" style="padding:10px;">
                    <div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
            </tr>
            <?php endif;?>
      </div>
        <?php
        break;
        default:
        echo _CONTENT_NOT_FOUND;
?>

<?php endswitch; ?>


<?php include(THEMEDIR ."/footer.php");?>