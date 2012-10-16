<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HollyCode2
 * Date: 6/28/12
 * Time: 11:36 AM
 * To change this template use File | Settings | File Templates.
 */

define("_VALID_PHP", true);

require_once("../init.php");

if(isset($_POST['eventFE']))
{
    $sql = "select * from mod_events where id= {$_POST['eventFE']}";
    $event = $db->first($sql);
    $response = $event['title_en'];
    $body = html_entity_decode($event['body_en']);
    $response .= <<<HTML
      |

        <div class="event-list">
        <h3 class="event-title" style="visibility: visible; ">
        <span>Time Start/End: {$event['date_start']}</span>{$event['title_en']}
        </h3>
        <h6 class="event-venue" style="visibility: visible; ">{$event['venue_en']}</h6>
        <hr>
        <div class="event-desc">{$body}</div>
        <span class="contact-info-toggle">Contact Person</span>
        <div class="event-contact"><div>{$event['contact_person']}</div><div>{$event['contact_email']}</div><div>{$event['contact_phone']}</div></div></div>

HTML;

    echo $response;exit;
}
