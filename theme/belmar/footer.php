<?php
/**
 * Footer
 *
 * @package HollyCode CMS
 * @author HollyCode.com
 * @copyright 2010
 * @version $Id: footer.php, v2.00 2011-04-20 10:12:05 gewa Exp $
 */

if (!defined("_VALID_PHP"))
    die('Direct access to this location is not allowed.');
?>

</td>

</tr>
</table>


<table width=980 class=table1>
    <tr>
        <td height=20 background="<?php echo THEMEURL;?>/images/cbot.png"></td></tr>
    <tr>
        <td height=40 valign=middle align=center><img src="<?php echo THEMEURL;?>/images/address.png"></td></tr>
</table>


<div class="push"></div>

</div>

</div>




<table width=100% cellpadding=0 cellspacing=0 border=0 background="<?php echo THEMEURL;?>/images/footerback.png" height=62>
    <tr>
        <td align=center>



            <table width=1004 cellpadding=0 cellspacing=0 border=0 style="margin-top: 4px;">
                <tr>
                    <td align=left valign=middle style="padding-right: 20px;" width=99%>
                        <p align=left><span class=bottomlinks>
	<a href="index.php">Home</a>&nbsp;&nbsp;&bull;&nbsp;
	<a href="calendar.php">Calendar</a>&nbsp;&nbsp;&bull;&nbsp;
	<a href="webcams.php">Webcams</a>&nbsp;&nbsp;&bull;&nbsp;
	<a href="getalerts.php">Get Belmar Alerts</a>&nbsp;&nbsp;&bull;&nbsp;
	<a href="pressroom.php">Press Room</a>&nbsp;&nbsp;&bull;&nbsp;
	<a href="belmaralerts.php">Current Alerts</a><br>
	<a href="municipal.php">Municipal</a>&nbsp;&nbsp;&bull;&nbsp;
	<a href="beach.php">Beach</a>&nbsp;&nbsp;&bull;&nbsp;
	<a href="marina.php">Marina</a>&nbsp;&nbsp;&bull;&nbsp;
	<a href="recreation.php">Recreation</a>&nbsp;&nbsp;&bull;&nbsp;
	<a href="tourism.php">Tourism</a>&nbsp;&nbsp;&bull;&nbsp;
	<a href="localbusinesses.php">Local Businesses</a>&nbsp;&nbsp;&bull;&nbsp;
	<a href="contact.php">Contact</a>

	</span></p>

                    </td>

                    <td valign=middle><a href="" target="_blank"><img src="<?php echo THEMEURL;?>/images/fbb.png" border=0></a></td>
                    <td valign=middle><a href="" target="_blank"><img src="<?php echo THEMEURL;?>/images/twb.png" border=0></a></td>
                    <td valign=middle><a href="http://www.njtransit.com" target="_blank"><img src="<?php echo THEMEURL;?>/images/njtransit.png" border=0></a></td>
                    <td valign=middle><a href="http://www.511nj.org" target="_blank"><img src="<?php echo THEMEURL;?>/images/511.png" border=0></a></td>

                    <td align=right valign=middle nowrap=nowrap style="padding-left: 5px;">
                        <p align=center style="line-height: 12px;"><span class=copyright>Copyright &copy; 2012<br>
All Rights Reserved<br>
The Borough of
<br>Belmar New Jersey</span></p>

                    </td>
                </tr>
            </table>

        </td></tr></table>


<?php if($core->analytics):?>
<!-- Google Analytics -->
<?php echo cleanOut($core->analytics);?>
<!-- Google Analytics /-->
<?php endif;?>

</body>
</html>