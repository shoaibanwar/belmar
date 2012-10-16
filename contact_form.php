<?php
/**
 * Contact Form
 *
 * @package HollyCode CMS
 * @author HollyCode.com
 * @copyright 2010
 * @version $Id: contact_form.php, v2.00 2011-04-20 10:12:05 gewa Exp $
 */
if (!defined("_VALID_PHP"))
    die('Direct access to this location is not allowed.');
?>
<div id="msgholder"></div>
<div id="fullform" style="padding-top:10px">

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tbody>
<tr>
<td valign="top" align="left" style="padding-right: 20px;">

    <p align="left"><span class="bodytext">Contacting us is easy! Our contact information is listed below, or, you can fill out the simple contact form to the right.</span>
    </p>

    <p align="left"><span class="bodytext"><b>Belmar Municipal Building</b><br>
601 Main Street<br>
Belmar, NJ 07719
</span></p>

    <p align="left"><span class="bodytext"><b>Telephone</b><br>
732-681-3700
</span></p>

    <p align="left"><span class="bodytext"><b>Fax</b><br>
732-681-3434
</span></p>


    <p align="left"><span class="bodytext"><b>General Email Inquiries</b><br>
<a href="mailto:info@belmar.com">info@belmar.com</a>
</span></p>

</td>
<td width="300" valign="top">

<div class="done bodytext">
    Thank you for filling out the form.
</div>

<div class="form">
<form action="" method="post" id="admin_form" name="admin_form">
<table class="table2" width="300">
<tbody>
<tr>
    <td align="left" style="white-space: nowrap; padding-right: 5px;">Select Department*</td>
    <td width="99%">
        <?php $departments = Users::getDepartments(); ?>
        <select class="input1" name="department">
            <option value='0'>General(All departments)</option>
            <?php foreach ($departments as $department): ?>
            <option value="<?php echo $department['id']; ?>"><?php echo $department['dep_name']; ?></option>
            <?php endforeach; ?>

        </select>
    </td>
</tr>
<tr>
    <td align="left" style="white-space: nowrap; padding-right: 5px;">First Name*</td>
    <td width="99%"><input type="text" size="50" class="input1" name="fname"></td>
</tr>

<tr>
    <td align="left" style="white-space: nowrap; padding-right: 5px;">Last Name*</td>
    <td width="99%"><input type="text" size="50" class="input1" name="lname"></td>
</tr>


<tr>
    <td align="left" style="white-space: nowrap; padding-right: 5px;">Email*</td>
    <td width="99%"><input type="text" size="50" class="input1" name="email"></td>
</tr>


<tr>
    <td align="left" style="white-space: nowrap; padding-right: 5px;">Date of Birth</td>
    <td width="99%"><select class="input1" name="month">
        <option>Month</option>
        <option value="01">Jan</option>
        <option value="02">Feb</option>
        <option value="03">Mar</option>
        <option value="04">Apr</option>

        <option value="05">May</option>
        <option value="06">Jun</option>
        <option value="07">Jul</option>
        <option value="08">Aug</option>
        <option value="09">Sep</option>
        <option value="10">Oct</option>

        <option value="11">Nov</option>
        <option value="12">Dec</option>
    </select>

        &nbsp;/&nbsp;

        <select class="input1" name="day">
            <option>Day</option>
            <option value="01">1</option>
            <option value="02">2</option>

            <option value="03">3</option>
            <option value="04">4</option>
            <option value="05">5</option>
            <option value="06">6</option>
            <option value="07">7</option>
            <option value="08">8</option>

            <option value="09">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>

            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>

            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>

            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
        </select>
        &nbsp;/&nbsp;

        <select class="input1" name="year" size="1">
            <option value="">Year</option>
            <option value="1930">1930</option>
            <option value="1931">1931</option>
            <option value="1932">1932</option>
            <option value="1933">1933</option>
            <option value="1934">1934</option>
            <option value="1935">1935</option>
            <option value="1936">1936</option>
            <option value="1937">1937</option>
            <option value="1938">1938</option>
            <option value="1939">1939</option>
            <option value="1940">1940</option>
            <option value="1941">1941</option>
            <option value="1942">1942</option>
            <option value="1943">1943</option>
            <option value="1944">1944</option>
            <option value="1945">1945</option>
            <option value="1946">1946</option>
            <option value="1947">1947</option>
            <option value="1948">1948</option>
            <option value="1949">1949</option>
            <option value="1950">1950</option>
            <option value="1951">1951</option>
            <option value="1952">1952</option>
            <option value="1953">1953</option>
            <option value="1954">1954</option>
            <option value="1955">1955</option>
            <option value="1956">1956</option>
            <option value="1957">1957</option>
            <option value="1958">1958</option>
            <option value="1959">1959</option>
            <option value="1960">1960</option>
            <option value="1961">1961</option>
            <option value="1962">1962</option>
            <option value="1963">1963</option>
            <option value="1964">1964</option>
            <option value="1965">1965</option>
            <option value="1966">1966</option>
            <option value="1967">1967</option>
            <option value="1968">1968</option>
            <option value="1969">1969</option>
            <option value="1970">1970</option>
            <option value="1971">1971</option>
            <option value="1972">1972</option>
            <option value="1973">1973</option>
            <option value="1974">1974</option>
            <option value="1975">1975</option>
            <option value="1976">1976</option>
            <option value="1977">1977</option>
            <option value="1978">1978</option>
            <option value="1979">1979</option>
            <option value="1980">1980</option>
            <option value="1981">1981</option>
            <option value="1982">1982</option>
            <option value="1983">1983</option>
            <option value="1984">1984</option>
            <option value="1985">1985</option>
            <option value="1986">1986</option>
            <option value="1987">1987</option>
            <option value="1988">1988</option>
            <option value="1989">1989</option>
            <option value="1990">1990</option>
            <option value="1991">1991</option>
            <option value="1992">1992</option>
            <option value="1993">1993</option>
            <option value="1994">1994</option>
            <option value="1995">1995</option>
            <option value="1996">1996</option>
            <option value="1997">1997</option>
            <option value="1998">1998</option>
            <option value="1999">1999</option>
            <option value="2000">2000</option>
            <option value="2001">2001</option>
            <option value="2002">2002</option>
            <option value="2003">2003</option>
            <option value="2004">2004</option>
            <option value="2005">2005</option>
            <option value="2006">2006</option>
            <option value="2007">2007</option>
            <option value="2008">2008</option>
            <option value="2009">2009</option>
            <option value="2010">2010</option>
            <option value="2011">2011</option>

        </select>
    </td>
</tr>


<tr>
    <td align="left" style="white-space: nowrap; padding-right: 5px;">Address</td>
    <td width="99%"><input type="text" size="50" class="input1" name="address"></td>
</tr>


<tr>
    <td align="left" style="white-space: nowrap; padding-right: 5px;">City</td>
    <td width="99%"><input type="text" size="50" class="input1" name="city"></td>
</tr>


<tr>
    <td align="left" style="white-space: nowrap; padding-right: 5px;">State</td>
    <td width="99%"><select name="state" class="input1">
        <option value="AL">Alabama</option>
        <option value="AK">Alaska</option>
        <option value="AZ">Arizona</option>
        <option value="AR">Arkansas</option>
        <option value="CA">California</option>
        <option value="CO">Colorado</option>
        <option value="CT">Connecticut</option>
        <option value="DE">Delaware</option>
        <option value="DC">District Of Columbia</option>
        <option value="FL">Florida</option>
        <option value="GA">Georgia</option>
        <option value="HI">Hawaii</option>
        <option value="ID">Idaho</option>
        <option value="IL">Illinois</option>
        <option value="IN">Indiana</option>
        <option value="IA">Iowa</option>
        <option value="KS">Kansas</option>
        <option value="KY">Kentucky</option>
        <option value="LA">Louisiana</option>
        <option value="ME">Maine</option>
        <option value="MD">Maryland</option>
        <option value="MA">Massachusetts</option>
        <option value="MI">Michigan</option>
        <option value="MN">Minnesota</option>
        <option value="MS">Mississippi</option>
        <option value="MO">Missouri</option>
        <option value="MT">Montana</option>
        <option value="NE">Nebraska</option>
        <option value="NV">Nevada</option>
        <option value="NH">New Hampshire</option>
        <option value="NJ" selected="NJ">New Jersey</option>
        <option value="NM">New Mexico</option>
        <option value="NY">New York</option>
        <option value="NC">North Carolina</option>
        <option value="ND">North Dakota</option>
        <option value="OH">Ohio</option>
        <option value="OK">Oklahoma</option>
        <option value="OR">Oregon</option>
        <option value="PA">Pennsylvania</option>
        <option value="RI">Rhode Island</option>
        <option value="SC">South Carolina</option>
        <option value="SD">South Dakota</option>
        <option value="TN">Tennessee</option>
        <option value="TX">Texas</option>
        <option value="UT">Utah</option>
        <option value="VT">Vermont</option>
        <option value="VA">Virginia</option>
        <option value="WA">Washington</option>
        <option value="WV">West Virginia</option>
        <option value="WI">Wisconsin</option>
        <option value="WY">Wyoming</option>
    </select></td>
</tr>


<tr>
    <td align="left" style="white-space: nowrap; padding-right: 5px;">Zip Code</td>
    <td width="99%"><input type="text" size="50" maxlength="5" class="input1" name="zipcode"></td>
</tr>


<tr>
    <td align="left" style="white-space: nowrap; padding-right: 5px;">Telephone</td>
    <td width="99%"><input type="text" size="4" maxlength="3" class="input1" name="ph1"> - <input type="text" size="4"
                                                                                                  maxlength="3"
                                                                                                  class="input1"
                                                                                                  name="ph2"> - <input
        type="text" size="5" maxlength="4" class="input1" name="ph3"></td>
</tr>

<tr>
    <td align="left" style="white-space: nowrap; padding-right: 5px;">Fax</td>
    <td width="99%"><input type="text" size="4" maxlength="3" class="input1" name="fx1"> - <input type="text" size="4"
                                                                                                  maxlength="3"
                                                                                                  class="input1"
                                                                                                  name="fx2"> - <input
        type="text" size="5" maxlength="4" class="input1" name="fx3"></td>
</tr>


<tr>
    <td align="left" style="white-space: nowrap; padding-right: 5px;">Your Message</td>
    <td width="99%"><textarea class="input1" cols="47" rows="6" name="message"></textarea></td>
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
    <td align="right" valign="top"><input type="checkbox" value="1" checked="" name="signlist" id="signlist"></td>
    <td valign="top" style="white-space: normal;">Add me to the Belmar E-Mailing List so that I can receive updates,
        announcements and alerts!
    </td>
</tr>

<tr>
    <td align="center" colspan="2"><input name="submit" type="submit" value="submit" class="button1">

    </td>
</tr>

</tbody>
</table>

</form>

</div>

</td>
</tr>
</tbody>
</table>

</div>
<script type="text/javascript">
    // <![CDATA[
    $(document).ready(function () {
        $("#admin_form").submit(function () {
            var str = $(this).serialize();
            $.ajax({
                type:"POST",
                url:SITEURL + "/ajax/sendmail.php",
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
                            result =$(msg).find('.error').removeClass('error').end(); $('html,body').scrollTop(200)
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