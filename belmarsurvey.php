<?php
define("_VALID_PHP", true);
require_once("init.php");

if ($user->logged_in)
    //  redirect_to("account.php");
    ?>
<?php include_once(THEMEDIR."/header.php");?>
<script type="text/javascript" src='<?php echo SITEURL ;?>/assets/global.js'></script>

<table bgcolor="#FFFFFF" width="980" class="table1">
    <tbody><tr>
        <td width="980" valign="top" height="100" style="background-image: url(images/ctop.png); background-repeat: no-repeat; background-position: center top;">

<!--     <script language="javascript">-->
<!--                function validatecontactform(frm)-->
<!--                {-->
<!--                    if(frm.fname.value=='')-->
<!--                    {-->
<!--                        alert("Please enter your first name");-->
<!--                        frm.fname.focus();-->
<!--                        return false;-->
<!--                    }-->
<!--                    if(frm.lname.value=='')-->
<!--                    {-->
<!--                        alert("Please enter your last name");-->
<!--                        frm.lname.focus();-->
<!--                        return false;-->
<!--                    }-->
<!--                    if(frm.emailid.value=='')-->
<!--                    {-->
<!--                        alert("Please enter your email");-->
<!--                        frm.emailid.focus();-->
<!--                        return false;-->
<!--                    }-->
<!---->
<!--                    if(frm.verif_box.value=='' || frm.verif_box.value != getCookie('tntcon'))-->
<!--                    {-->
<!--                        alert("Invalid Security Code. Please Re-enter.");-->
<!--                        frm.verif_box.focus();-->
<!--                        return false;-->
<!--                    }-->
<!---->
<!--                }-->
<!--            </script>-->

    <table width="980" class="table1">
                <tbody><tr>
                    <td style="padding: 0px 20px 0px;">

         <table width="100%" class="table1">
                            <tbody><tr>
                            </tr><tr>
                                <td width="170" valign="top">
                                    <table width="170" class="table1">
                                        <tbody>
                                        <tr>
                                            <td><img src="uploads/sidebartop.png"></td></tr>

                                        <tr>
                                            <td height="30" style="background-color: #d3a77b; border-top: 1px solid #FFFFFF; padding: 5px 5px 5px 8px;">
                                            <p align="left">
                                                <span class="sidebar1">You are in:</span><br>
                                                <span class="sidebar2">Belmar Survey</span>
                                            </p>
                                        </td></tr>

                                        <tr>
                                            <td bgcolor="#d3a77b" valign="top" height="200">

                                                <div class="qmmc" id="qm0" style="z-index: 11;">
                                              <li> <a href="contact.html">Contact Us</a></li>
                                                    <li><a href="get_belmar_alerts.php">Get Alerts</a></li>
                                                    <li><a href="belmarsurvey.php">"How's Belmar Doing?" Survey</a></li>
                                                    <li><a href="publicworks.php">DPW Service Request</a></li>
                                                    <span class="qmclear">&nbsp;</span>
                                                </div>

                                                <!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
                                                <script type="text/javascript">qm_create(0,false,0,500,'all',false,false,false,false);</script>


                                            </td></tr>


                                        <tr>
                                            <td><img src="uploads/sidebarbottom.png"></td></tr>
                                        </tbody></table></td>

                                <td valign="top" style="padding: 20px;">
                                    <h1 style="visibility: visible;">"How's Belmar Doing?" Survey</h1>

<div id="msgholder"></div>
<div  id="fullform" style="padding-top:10px">

                                    <p align="center"><span class="bodytext"><b>How are we doing?</b> We enjoy hearing your feedback on your experience in Belmar.  Please choose the department you would like to give feedback for and answer the short survey.  We encourage you to share any comments in the box provided.</span></p>


                                    <p align="center">
                                    </p>
                                  
                                    <form  method="post"  id="admin_form" name="belmarsurvey-form">
                                    <table width="300" class="table2">
                                        <tbody><tr>
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
                                            <td align="left" style="white-space: nowrap; padding-right: 5px; padding-bottom: 15px;">Select Department*</td>
                                            <td width="99%" style="padding-bottom: 15px;">
                                                <?php $departments = Users::getDepartments(); ?>
                                                <select class="input1" name="department">
                                                    <?php foreach ($departments as $department): ?>
                                                    <option value="<?php echo $department['id']; ?>"><?php echo $department['dep_name']; ?></option>
                                                    <?php endforeach; ?>

                                                </select>


                                            </td>
                                        </tr>


                                        <tr>
                                            <td align="left" valign="top" style="white-space: nowrap; padding-right: 5px;" colspan="2">1. My overall experience was positive.</td></tr>
                                        <tr><td align="left" valign="top" style="padding-bottom: 15px;" colspan="2">
                                            <input type="radio" value="stronglyagree" name="experience" checked="checked">&nbsp;Strongly Agree<br>
                                            <input type="radio" value="agree" name="experience" >&nbsp;Agree<br>
                                            <input type="radio" value="neutral" name="experience">&nbsp;Neutral<br>
                                            <input type="radio" value="disagree" name="experience">&nbsp;Disagree<br>
                                            <input type="radio" value="stronglydisagree" name="experience">&nbsp;Strongly Disagree


                                        </td>
                                        </tr>

                                        <tr>
                                            <td align="left" valign="top" style="white-space: nowrap; padding-right: 5px;" colspan="2">2. The staff was courteous and helpful.</td></tr>
                                        <tr><td align="left" valign="top" style="padding-bottom: 15px;" colspan="2">
                                            <input type="radio" value="stronglyagree" name="staff" checked="checked">&nbsp;Strongly Agree<br>
                                            <input type="radio" value="agree" name="staff" >&nbsp;Agree<br>
                                            <input type="radio" value="neutral" name="staff">&nbsp;Neutral<br>
                                            <input type="radio" value="disagree" name="staff">&nbsp;Disagree<br>
                                            <input type="radio" value="stronglydisagree" name="staff">&nbsp;Strongly Disagree


                                        </td>
                                        </tr>

                                        <tr>
                                            <td align="left" valign="top" style="white-space: nowrap; padding-right: 5px;" colspan="2">3. My questions or concerns were dealt with promptly and efficiently.</td></tr>
                                        <tr><td align="left" valign="top" style="padding-bottom: 15px;" colspan="2">
                                            <input type="radio" value="stronglyagree" name="questions" checked="checked">&nbsp;Strongly Agree<br>
                                            <input type="radio" value="agree" name="questions" checked="checked">&nbsp;Agree<br>
                                            <input type="radio" value="neutral" name="questions">&nbsp;Neutral<br>
                                            <input type="radio" value="disagree" name="questions">&nbsp;Disagree<br>
                                            <input type="radio" value="stronglydisagree" name="questions">&nbsp;Strongly Disagree


                                        </td>
                                        </tr>

                                        <tr>
                                            <td align="left" valign="top" colspan="2" style="white-space: nowrap; padding-right: 5px;">Comments</td></tr><tr>
                                            <td align="left" width="99%" valign="top" colspan="2"><textarea rows="10" cols="80" class="input1" name="comments"></textarea>


                                            </td>
                                        </tr>

                                        <tr>
                                            <td align="left" style="white-space: nowrap; padding-right: 5px;">Verification Code</td>
                                            <td width="99%">

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

                                </td>
                               </tr>
                                </tbody></table>





                    </td>
                </tr>
                </tbody></table>



        </td>
    </tr>
    </tbody></table>




<script type="text/javascript">
    // <![CDATA[
    $(document).ready(function() {
        $("#admin_form").submit(function () {
            var str = $(this).serialize();

            $.ajax({
                type: "POST",
                url: SITEURL + "/ajax/belmarsurveyformvalidation.php",
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
                        $(this).html(result);
                    });
                }
            });
            return false;
        });
    });
    // ]]>
</script>



<?php include_once(THEMEDIR."/footer.php");?>