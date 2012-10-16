<?php
/**
 * Contact Form
 *
 * @package HollyCode CMS
 * @author HollyCode.com
 * @copyright 2010
 * @version $Id: contact_form.php, v2.00 2011-04-20 10:12:05 gewa Exp $
 */
define("_VALID_PHP", true);
require_once("init.php");
?>
<?php include_once(THEMEDIR."/header.php");?>
<script type="text/javascript" src='<?php echo SITEURL ;?>/assets/global.js'></script>


<div>

<table bgcolor="#FFFFFF" width="980" class="table1">
<tbody>
<td width="300" valign="top" >

    <div style="float:left;" class="left"></div>
    <div id="vmenunav">
        <div class="header"></div>
        <div class="cat_title" style="height: 170px;">You are in:<br>

            <div class="cat">

                <span class="sidebar2"> Get Belmar Alerts</span></br>



            </div>
            <div class="qmmc" id="qm0" style="z-index: 11;width: 158px;">

              <li> <a href="contact.html">Contact Us</a></li>
                 <li> <a href="get_belmar_alerts.php">Get Alerts</a></li>
                 <li>  <a href="belmarsurvey.php">"How's Belmar Doing?" Survey</a></li>
                 <li> <a href="publicworks.php">DPW Service Request</a></li>
                 <span class="qmclear">&nbsp;</span>
            </div>
            <!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
            <script type="text/javascript">qm_create(0,false,0,500,'all',false,false,false,false);</script>

        </div>
<div>
        <img src="uploads/sidebarbottom.png">

    </div>

    </div>
    <div id="msgholder"></div>
<div class="done bodytext">
    Thank you for filling out the form.
</div>

<div class="form" id="fullform" >


    <h1 style="visibility: visible; ">Get Belmar Alerts</h1>
    <p align="center"><span class="bodytext">If you would like to receive Belmar related alerts, please fill out the form below. <b>Fields with a * are required on this form.</b></span></p>
    <p align="center">
    </p>
    <form method="post" name="contest" id="admin_form" style="margin: 0px">
        <table class="table2" align="center" width="300">
            <tbody><tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">First Name*</td>
                <td width="99%"><input type="text" size="50" class="input1" name="fname" id="acpro_inp0"></td>
            </tr>

            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">Last Name*</td>
                <td width="99%"><input type="text" size="50" class="input1" name="lname" id="acpro_inp1"></td>
            </tr>

            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">Email*</td>
                <td width="99%"><input type="text" size="50" class="input1" name="email"></td>
            </tr>

            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">Mobile*</td>
                <td width="99%"><input type="text" size="4" maxlength="3" class="input1" name="ph1"> - <input type="text" size="4" maxlength="3" class="input1" name="ph2"> - <input type="text" size="5" maxlength="4" class="input1" name="ph3"></td>
            </tr>



            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">Address</td>
                <td width="99%"><input type="text" size="50" class="input1" name="address" id="acpro_inp6"></td>
            </tr>


            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">City</td>
                <td width="99%"><input type="text" size="50" class="input1" name="city" id="acpro_inp7"></td>
            </tr>


            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">State</td>
                <td width="99%"><select name="state" class="input1">
                    <option value="Alabama">Alabama</option><option value="Alaska">Alaska</option>
                    <option value="Arizona">Arizona</option><option value="Arkansas">Arkansas</option>
                    <option value="California">California</option><option value="Colorado">Colorado</option>
                    <option value="Connecticut">Connecticut</option><option value="Delaware">Delaware</option>
                    <option value="District Of Columbia">District Of Columbia</option><option value="Florida">Florida</option>
                    <option value="Georgia">Georgia</option><option value="Hawaii">Hawaii</option>
                    <option value="Idaho">Idaho</option><option value="Illinois">Illinois</option>
                    <option value="Indiana">Indiana</option><option Iowa="IA">Iowa</option>
                    <option value="Kansas">Kansas</option><option value="Kentucky">Kentucky</option>
                    <option value="Louisiana">Louisiana</option><option value="Maine">Maine</option>
                    <option value="Maryland">Maryland</option><option value="Massachusetts">Massachusetts</option>
                    <option value="Michigan">Michigan</option><option value="Minnesota">Minnesota</option>
                    <option value="Mississippi">Mississippi</option><option value="Missouri">Missouri</option>
                    <option value="Montana">Montana</option><option value="Nebraska">Nebraska</option>
                    <option value="Nevada">Nevada</option><option value="New Hampshire">New Hampshire</option>
                    <option selected="NJ" value="New Jersey">New Jersey</option><option value="New Mexico">New Mexico</option>
                    <option value="New York">New York</option><option value="North Carolina">North Carolina</option>
                    <option value="North Dakota">North Dakota</option><option value="Ohio">Ohio</option>
                    <option value="Oklahoma">Oklahoma</option><option value="Oregon">Oregon</option><option value="Pennsylvania">Pennsylvania</option>
                    <option value="Rhode Island">Rhode Island</option><option value="South Carolina">South Carolina</option>
                    <option value="South Dakota">South Dakota</option><option value="Tennessee">Tennessee</option>
                    <option value="Texas">Texas</option><option value="Utah">Utah</option><option value="Vermont">Vermont</option>
                    <option value="Virginia">Virginia</option><option value="Washington">Washington</option>
                    <option value="West Virginia">West Virginia</option><option value="Wisconsin">Wisconsin</option>
                    <option value="Wyoming">Wyoming</option>
                </select></td>

            </tr>



            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">Zip Code</td>
                <td width="99%"><input type="text" size="50" maxlength="5" class="input1" name="zipcode" id="acpro_inp8"></td>
            </tr>


            <tr>
                <td align="left" valign="top" style="white-space: nowrap; padding-right: 5px;">Alert Me For*</td>
                <td width="99%" valign="top">
                    <input name="all" id="togglechkbox" onclick="checkall();" value="All" type="checkbox">&nbsp;All<br>
                    <input name="alertme[]" id="alert1" value="Emergency" type="checkbox">&nbsp;Emergency<br>
                    <input name="alertme[]" id="alert2" value="Muncipal" type="checkbox">&nbsp;Municipal<br>
                    <input name="alertme[]" id="alert3" value="Beach" type="checkbox">&nbsp;Beach<br>
                    <input name="alertme[]" id="alert4" value="Marina" type="checkbox">&nbsp;Marina<br>
                    <input name="alertme[]" id="alert5" value="Recreation" type="checkbox">&nbsp;Recreation<br>
                    <input name="alertme[]" id="alert6" value="Tourism" type="checkbox">&nbsp;Tourism<br>
                    <input name="alertme[]" id="alert7" value="Local Business" type="checkbox">&nbsp;Local Businesses


                </td>
            </tr>

            <tr>
                <td align="left" valign="top" style="white-space: nowrap; padding-right: 5px;">Alert Me Via*</td>
                <td width="99%" valign="top">
                    <input type="radio" name="alertvia" value="both">&nbsp;Both<br>
                    <input type="radio" name="alertvia" value="emailonly">&nbsp;Email Only<br>
                    <input type="radio" name="alertvia" value="textmessageonly">&nbsp;Text Message Only


                </td>
            </tr>


            <tr>
                <td><strong><?php echo _CF_TOTAL;?>:</strong></td>
                <td>
        <span class="inputwrap">
            <input name="code" type="text" class="input1" id="code" title="<?php echo _CF_TOTAL_R;?>" size="10"
                   maxlength="5"/>
            <img style="vertical-align: middle;" src="<?php echo SITEURL;?>/includes/captcha.php" alt="" class="captcha"/>
        </span>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2"><input type="submit" value="SUBMIT" class="button1">

                </td></tr>
            </tbody></table>
        <p></p>


    </form>

</div>

</td>
</tr>
</tbody>
</table>

</div>
<script type="text/javascript">
function checkall() {
var str = "";
if(document.getElementById('togglechkbox').checked == true)
{
document.getElementById('alert1').checked=true;
document.getElementById('alert2').checked=true; 
document.getElementById('alert3').checked=true; 
document.getElementById('alert4').checked=true; 
document.getElementById('alert5').checked=true; 
document.getElementById('alert6').checked=true; 
document.getElementById('alert7').checked=true; 
}else
{
document.getElementById('alert1').checked="";
document.getElementById('alert2').checked=""; 
document.getElementById('alert3').checked=""; 
document.getElementById('alert4').checked=""; 
document.getElementById('alert5').checked=""; 
document.getElementById('alert6').checked=""; 
document.getElementById('alert7').checked="";   
    
}
    
}

</script>
<script type="text/javascript">
    // <![CDATA[
    $(document).ready(function () {
        $("#admin_form").submit(function () {
            var str = $(this).serialize();
            $.ajax({
                type:"POST",
                url:SITEURL + "/ajax/getalerts.php",
                data:str,
                success:function (msg) {
                    msg = msg.trim();

                    $("#msgholder").ajaxComplete(function (event, request, settings) {
                        if (msg.toLowerCase() == 'ok') {
                            result = '<div class="msgOk"><?php echo _CF_OK;?></div>';
                            $("#msgholder").css('height','600px').animate({'height':'200px'},500,function(){
                                $('html,body').scrollTop(0)
                            });
                            $("#fullform").hide();
                        } else {
                            result =$(msg).find('.error').removeClass('error').end();
                        }
                        $(this).html(result);
                    });
                }
            });
            return false;
        });
    });
    // ]]>
</script>