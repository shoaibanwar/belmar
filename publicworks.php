<?php
define("_VALID_PHP", true);
require_once("init.php");

if ($user->logged_in)
  //  redirect_to("account.php");
?>

<?php include_once(THEMEDIR."/header.php");?>
<script type="text/javascript" src='<?php echo SITEURL ;?>/assets/global.js'></script>

<table bgcolor="#FFFFFF" width="980" class="table1">
<tr>
    <td width="170" valign="top">

            <div id="vmenunav">
                <div class="header"></div>
                <div class="cat_title" style="height: 170px;">You are in:<br>

                    <div class="cat">

                        <span class="sidebar2"> Public Works</span></br>



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

    </td>
    <td valign="top" style="padding: 20px;">
        <h1 style="visibility: visible;">Department of Public Works Service Request Form</h1>

<div id="msgholder"></div>
<div  id="fullform" style="padding-top:10px">

        <p align="left"><span class="bodytext">Welcome to the Belmar Public Works Service Request Form. By filling out the form below, citizens can direct comments or request to the Department of Public Works for further action. Please be sure to enter your name and Email address and choose from one of the items listed below.</span></p>


        <p align="center">
        </p>
     <div class="form">
        <form action="" method="post" id="admin_form"  name="public-form">

            <table class="table2" style="width: 300px;">

            <tbody><tr>
                <td align="left" valign="top" style="white-space: nowrap; padding-right: 5px;" colspan="2">Reason For Submission:</td></tr>
            <tr><td align="left" valign="top" style="white-space: nowrap; padding-bottom: 15px; padding-right: 15px;">
                <input type="checkbox" value="Plowing Complaint" name="reason[]">&nbsp;Plowing Complaint<br>
                <input type="checkbox" value="Pot Hole Repair Request" name="reason[]">&nbsp;Pot Hole Repair Request<br>
                <input type="checkbox" value="Property Damage Notification" name="reason[]">&nbsp;Property Damage Notification <br>
                <input type="checkbox" value="Recycle Pick Up Miss Notification" name="reason[]">&nbsp;Recycle Pick Up Miss Notification <br>
                <input type="checkbox" value="Beach Issue" name="reason[]">&nbsp;Beach Issue <br>
                <input type="checkbox" value="Graffitti" name="reason[]">&nbsp;Plowing Complaint<br>
                <input type="checkbox" value="Water/Sewer Problem" name="reason[]">&nbsp;Water/Sewer Problem

            </td>
                <td align="left" valign="top" style="white-space: nowrap; padding-bottom: 15px; padding-right: 15px;">

                    <input type="checkbox" value="Storm Drain Cleanout Request" name="reason[]">&nbsp;Storm Drain Cleanout Request <br>
                    <input type="checkbox" value="Street Light Out Notification" name="reason[]">&nbsp;Street Llight Out Notification <br>
                    <input type="checkbox" value="Street Sign Request" name="reason[]">&nbsp;Street Sign Request <br>
                    <input type="checkbox" value="Street Sweeping Request" name="reason[]">&nbsp;Street Sweeping Request<br>
                    <input type="checkbox" value="Tree Cutting/Trimming Request" name="reason[]">&nbsp;Tree Cutting/Trimming Request<br>
                    <input type="checkbox" value="Trash Pick Up Miss Notification" name="reason[]">&nbsp;Trash Pick Up Miss Notification<br>
                    <input type="checkbox" value="Other" name="reason[]">&nbsp;Other: <input type="text" name="other" class="input1" size="20">
                </td>
            </tr>

            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">First Name*</td>
                <td width="99%"><input type="text" name="fname" class="input1" size="50"></td>
            </tr>

            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">Last Name*</td>
                <td width="99%"><input type="text" name="lname" class="input1" size="50"></td>
            </tr>


            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">Email*</td>
                <td width="99%"><input type="text" name="emailid" class="input1" size="50"></td>
            </tr>



            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">Address*</td>
                <td width="99%"><input type="text" name="address" class="input1" size="50" id="addressid"></td>
            </tr>


            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">City*</td>
                <td width="99%"><input type="text" name="city" class="input1" size="50"></td>
            </tr>


            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">State</td>
                   <td width="99%">
                    <select class="input1" name="state">
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
                <td align="left" style="white-space: nowrap; padding-right: 5px;">Zip Code*</td>
                <td width="99%"><input type="text" name="zip" class="input1" maxlength="5" size="50"></td>
            </tr>



            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">Telephone*</td>
                <td width="99%"><input type="text" name="ph1" class="input1" maxlength="3" size="4"> - <input type="text" name="ph2" class="input1" maxlength="3" size="4"> - <input type="text" name="ph3" class="input1" maxlength="4" size="5"></td>
            </tr>


            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">Mobile</td>
                <td width="99%"><input type="text" name="mobile1" class="input1" maxlength="3" size="4"> - <input type="text" name="mobile2" class="input1" maxlength="3" size="4"> - <input type="text" name="mobile3" class="input1" maxlength="4" size="5"></td>
            </tr>



            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">Location</td>
                <td width="99%"><textarea name="location" rows="3" cols="47" class="input1"></textarea></td>
            </tr>

            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">Your Message</td>
                <td width="99%"><textarea name="comments" rows="6" cols="47" class="input1"></textarea></td>
            </tr>


            <tr>
                <td align="left" style="white-space: nowrap; padding-right: 5px;">Verification Code</td>
                <td width="99%">
<!--                    <input type="text" style="margin-left:10px;float:left" class="input1" id="verif_box" name="verif_box"> <img align="absmiddle" width="50" hspace="10" height="24" style="float:left;" alt="verification image, type it in the box" src="verificationimage.php?2097" id="cpimg"> <a onclick="document.getElementById('cpimg').src='verificationimage.php?captcha_id=' + Math.random() * 2 + 1; return false;" href="javascript:"><img border="0" width="25px;" style="float:left;" src="images/refresh.png"></a>-->
<!--            -->
                    <input name="code" type="text" class="input1" id="code" title="<?php echo _CF_TOTAL_R;?>" size="10" maxlength="5" />
                    <img src="<?php echo SITEURL;?>/includes/captcha.php" alt="" class="captcha" />

                </td>
            </tr>


            <tr>
                <td align="center" colspan="2"><input type="submit" class="button1" value="SUBMIT">

                </td></tr>
            </tbody></table>
        <p></p>
    </form>
         
     
<!--       --><?php //echo $core->doForm("publicworks","ajax/publicformvalidation.php");?>

    </td>
</tr>
</table>
</div>
<script type="text/javascript">
    // <![CDATA[
    $(document).ready(function() {
        $("#admin_form").submit(function () {
            var str = $(this).serialize();

            $.ajax({
                type: "POST",
                url: SITEURL + "/ajax/publicformvalidation.php",
                data: str,
                success: function (msg) {
                      msg = msg.trim() 
                   $("#msgholder").ajaxComplete(function(event, request, settings) {
                        if(msg  == 'OK') {
                            result = '<div class="msgOk"><?php echo _CF_OK;?></div>';
                            $("#msgholder").css('height','600px').animate({'height':'200px'},500,function(){
                                $('html,body').scrollTop(0)
                            });

                            $("#fullform").hide();
                        } else {
                            result = $(msg).find('.error').removeClass('error').end();
                        }
                        $(this).html(result); $('html,body').scrollTop(200)
                    });
                }
            });
            return false;
        });
    });
    // ]]>
</script>
<?php include_once(THEMEDIR."/footer.php");?>