<html>
<head>
    <title> The Borough of Belmar New Jersey </title>
    <?php echo $content->getMeta(); ?>
    <?php $content->getPluginAssets();?>
    <?php $content->getModuleAssets();?>
    <link href="<?php echo SITEURL ;?>/plugins/vmenu/style.css" type=text/css rel=stylesheet>
    <link href="<?php echo SITEURL ;?>/modules/events/style.css" type=text/css rel=stylesheet>
    <link href="<?php echo THEMEURL;?>/css/styles2.css" type=text/css rel=stylesheet>
    <link href="<?php echo THEMEURL;?>/css/main-menu.css" type=text/css rel=stylesheet>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/redmond/jquery-ui.css" type=text/css rel=stylesheet>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
    <script type='text/javascript' src='<?php echo SITEURL ;?>/assets/jquery-ui-1.8.13.custom.min.js'></script>
    <script type="text/javascript" src="<?php echo SITEURL ;?>/assets/pirobox/js/pirobox_extended_min.js"></script>
    <link href="<?php echo SITEURL; ?>/assets/pirobox/css_pirobox/style_2/style.css" rel="stylesheet" type="text/css" />

    <script type='text/javascript' src='<?php echo SITEURL ;?>/assets/global.js'></script>

    <script src="<?php echo THEMEURL;?>/js/cufon-yui.js" type="text/javascript"></script>
    <script src="<?php echo THEMEURL;?>/js/typeface-0.15.js" type="text/javascript"></script>
    <script type='text/javascript' src='<?php echo THEMEURL;?>/js/infinite-rotator.js'></script>
    <script type="text/javascript" src="<?php echo THEMEURL;?>/js/tabs.js"></script>
    <link href="../admin/assets/style.css" rel="stylesheet" type="text/css" xmlns="http://www.w3.org/1999/html"/>
    <link href="admin/assets/style.css" rel="stylesheet" type="text/css" xmlns="http://www.w3.org/1999/html"/>

    <script language="javascript" type="text/javascript">
        var THEMEURL = "<?php echo THEMEURL; ?>";
        var SITEURL = "<?php echo SITEURL; ?>";
    </script>

    <script language="javascript">
        function getCookie(c_name)
        {
            var i,x,y,ARRcookies=document.cookie.split(";");
            for (i=0;i<ARRcookies.length;i++)
            {
                x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
                y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
                x=x.replace(/^\s+|\s+$/g,"");
                if (x==c_name)
                {
                    return unescape(y);
                }
            }
        }

        function validatefrmnewsletter(frm)
        {
            if(frm.fname.value=='')
            {
                alert("Please enter your first name");
                frm.fname.focus();
                return false;
            }
            if(frm.lname.value=='')
            {
                alert("Please enter your last name");
                frm.lname.focus();
                return false;
            }
            if(frm.email.value=='')
            {
                alert("Please enter your email");
                frm.email.focus();
                return false;
            }
//            if(frm.verif_box.value=='' || (frm.verif_box.value != getCookie('tntcon')))
//            {
//                alert("Invalid Security Code. Please Re-enter.");
//                frm.verif_box.focus();
//                return false;
//            }
            submitform();
            return false;
        }

        function submitform()
        {
            var values = {};
            var data='';
            $.each($('#frmnewsletter').serializeArray(), function(i, field) {
                values[field.name] = field.value;
                data +='&'+field.name+'='+field.value;

            });


            //organize the data properly
            //  data = 'q_name=' + name.val() + '&q_address=' + address.val() + '&q_email=' + email.val() + '&q_phone='
//        + phone.val() + '&q_company='+ company.val() +'&q_comments='  + encodeURIComponent(comment.val());

            //     disabled all the text fields
            $('.text').attr('disabled','true');

            //show the loading sign
            $('.loading').show();

            //start the ajax
            $.ajax({
                //this is the php file that processes the data and send mail
                url: SITEURL + "/ajax/mailing_list.php",

                //POST method is used
                type: "POST",

                //pass the data
                data: data,

                //Do not cache the page
                cache: false,

                //success
                success: function (html) {

//                    $('.form').fadeOut('slow');

                    //show the success message
                    if(html=='OK')
                    {
                        console.log('ok');
                        $('.done').fadeIn('slow');
                        $('.done').delay(3000).fadeOut('slow');
                        $('.form').delay(3000).fadeIn('slow');
                        document.getElementById('frmnewsletter').reset();
                        $('.loading').hide();
                    }
                    else
                    {
                        console.log('err');
                        $('.error').html(html);
                        $('.error').children().removeClass();
                        $('.error').fadeIn('slow');
                        $('.error').delay(3000).fadeOut('slow');
                        $('.form').delay(3000).fadeIn('slow');
                        //document.getElementById('frmnewsletter').reset();
                        $('.loading').hide();
                    }


                }
            });

            //cancel the submit button default behaviours
            return false;

        }



    </script>

    <style>
        .done {

            font-size: 12px;
            height: 40px;
            margin: 20px auto;
            padding-left: 20px;
            padding-top: 20px;
            text-align: center;
            display:none;
        }
        .error {

            font-size: 12px;
            /*height: 40px;*/
            /*margin: 20px auto;*/
            padding-left: 20px;
            /*padding-top: 20px;*/
            text-align: left;
            display:none;
            width: 250px !important;
            margin-bottom: 15px;

            color:#FF0000;
        }
        .hightlight {
            border:2px solid #9F1319;

        }
        .loading {
            float:right;
            background:url(<?php echo THEMEURL;?>/images/loading.gif) no-repeat 1px;
            height:28px;
            width:28px;
            display:none;
            margin-top: -20px;
            padding-left: 150px;
        }
    </style>

</head>
<body class="fe">




<div class="wrapper" align=center valign=top>


    <div class="content">


        <table width=1004 class=table1>
            <tr>
                <td height=40 valign=bottom align=right><img src="<?php echo THEMEURL;?>/images/phototop.png" style="margin-right: 62px"></td>

                <td align=left valign=middle width=55 valign=middle style="padding: 0px 10px"><a href="<?php echo SITEURL ;?>"><img src="<?php echo THEMEURL;?>/images/home1.png" onMouseOver="javascript: this.src='<?php echo THEMEURL;?>/images/home2.png'" onMouseOut="javascript: this.src='<?php echo THEMEURL;?>/images/home1.png'" border=0 alt="Home"></a></td>

                <td align=left width=85 valign=middle style="padding: 0px 10px"><a href="<?php echo SITEURL ;?>/calendar.html"><img src="<?php echo THEMEURL;?>/images/calendar1.png" onMouseOver="javascript: this.src='<?php echo THEMEURL;?>/images/calendar2.png'" onMouseOut="javascript: this.src='<?php echo THEMEURL;?>/images/calendar1.png'" border=0 alt="Calendar"></a></td>

                <td align=left width=90 valign=middle style="padding: 0px 10px;"><a href="<?php echo SITEURL ;?>/webcams.html"><img src="<?php echo THEMEURL;?>/images/webcams1.png" onMouseOver="javascript: this.src='<?php echo THEMEURL;?>/images/webcams2.png'" onMouseOut="javascript: this.src='<?php echo THEMEURL;?>/images/webcams1.png'" border=0 alt="Webcams"></a></td>

                <td align=left width=85 valign=middle style="padding: 0px 10px"><a href="<?php echo SITEURL ;?>/contact.html"><img src="<?php echo THEMEURL;?>/images/contact1.png" onMouseOver="javascript: this.src='<?php echo THEMEURL;?>/images/contact2.png'" onMouseOut="javascript: this.src='<?php echo THEMEURL;?>/images/contact1.png'" border=0 alt="Contact"></a></td>

                <td align=left width=170 valign=middle style="padding: 0px 10px"><a href="<?php echo SITEURL ;?>/get_belmar_alerts.php"><img src="<?php echo THEMEURL;?>/images/getalerts1.png" onMouseOver="javascript: this.src='<?php echo THEMEURL;?>/images/getalerts2.png'" onMouseOut="javascript: this.src='<?php echo THEMEURL;?>/images/getalerts1.png'" border=0 alt="Get Belmar Alerts"></a></td>

            </tr>
        </table>

        <table width=1004 class=table1 style="background-image: url(<?php echo THEMEURL;?>/images/mnavt.png); background-repeat: no-repeat; background-position: center bottom;">
            <tr>
                <td width=387 height=260 background="<?php echo THEMEURL;?>/images/header4.png">


                    <div id="rotating-item-wrapper">
                        <img src="<?php echo THEMEURL;?>/images/header1.png" alt="" class="rotating-item" width="387" height="260" />
                        <img src="<?php echo THEMEURL;?>/images/header2.png" alt="" class="rotating-item" width="387" height="260" />
                        <img src="<?php echo THEMEURL;?>/images/header3.png" alt="" class="rotating-item" width="387" height="260" />
                        <img src="<?php echo THEMEURL;?>/images/header4.png" alt="" class="rotating-item" width="387" height="260" />

                    </div>








                </td>
                <td valign=middle align=left><a href="/"><img src="<?php echo THEMEURL;?>/images/logo.png" border=0></a></td>

                <td align=right valign=bottom>
                    <table celpadding=0 cellspacing=0 border=0 style="margin: 0px 10px 5px 0px;">
                        <tr>
                            <td align=left style="padding: 0px;"><a href="http://apps.facebook.com/belmar-nj/" target="_blank"><img src="<?php echo THEMEURL;?>/images/facebook1.png" onMouseOver="javascript: this.src='<?php echo THEMEURL;?>/images/facebook2.png'" onMouseOut="javascript: this.src='<?php echo THEMEURL;?>/images/facebook1.png'" border=0 alt="Like Us On Facebook!"></a></td>

                            <td align=left style="padding: 0px;"><a href="http://twitter.com/#!/Belmar_NJ" target="_blank"><img src="<?php echo THEMEURL;?>/images/twitter1.png" onMouseOver="javascript: this.src='<?php echo THEMEURL;?>/images/twitter2.png'" onMouseOut="javascript: this.src='<?php echo THEMEURL;?>/images/twitter1.png'" border=0 alt="Follow Us On Twitter!"></a></td>

                            <td align=left style="padding: 0px;"><a href="" target="_blank"><img src="<?php echo THEMEURL;?>/images/rss1.png" onMouseOver="javascript: this.src='<?php echo THEMEURL;?>/images/rss2.png'" onMouseOut="javascript: this.src='<?php echo THEMEURL;?>/images/rss1.png'" border=0 alt="Get Our RSS Feed!"></a></td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>


        <table width=1004 class=table1 height=60>
            <tr>
                <td height=60 background="<?php echo THEMEURL;?>/images/mnavback.png" align=center valign=middle>

                    <table class=table1>
                        <tr>
                            <td align=left valign=middle valign=middle style="padding: 0px 20px"><a href="<?php echo SITEURL ;?>/municipal.html"><img src="<?php echo THEMEURL;?>/images/municipal1.png" onMouseOver="javascript: this.src='<?php echo THEMEURL;?>/images/municipal2.png'" onMouseOut="javascript: this.src='<?php echo THEMEURL;?>/images/municipal1.png'" border=0 alt="Municipal"></a></td>

                            <td align=center valign=middle><img src="<?php echo THEMEURL;?>/images/nbreak.png"></td>

                            <td align=left valign=middle valign=middle style="padding: 0px 20px"><a href="<?php echo SITEURL ;?>/beach.html"><img src="<?php echo THEMEURL;?>/images/beach1.png" onMouseOver="javascript: this.src='<?php echo THEMEURL;?>/images/beach2.png'" onMouseOut="javascript: this.src='<?php echo THEMEURL;?>/images/beach1.png'" border=0 alt="Beach"></a></td>

                            <td align=center valign=middle><img src="<?php echo THEMEURL;?>/images/nbreak.png"></td>

                            <td align=left valign=middle valign=middle style="padding: 0px 20px"><a href="<?php echo SITEURL ;?>/marina.html"><img src="<?php echo THEMEURL;?>/images/marina1.png" onMouseOver="javascript: this.src='<?php echo THEMEURL;?>/images/marina2.png'" onMouseOut="javascript: this.src='<?php echo THEMEURL;?>/images/marina1.png'" border=0 alt="Marina"></a></td>

                            <td align=center valign=middle><img src="<?php echo THEMEURL;?>/images/nbreak.png"></td>

                            <td align=left valign=middle valign=middle style="padding: 0px 20px"><a href="<?php echo SITEURL ;?>/recreation.html"><img src="<?php echo THEMEURL;?>/images/recreation1.png" onMouseOver="javascript: this.src='<?php echo THEMEURL;?>/images/recreation2.png'" onMouseOut="javascript: this.src='<?php echo THEMEURL;?>/images/recreation1.png'" border=0 alt="Recreation"></a></td>

                            <td align=center valign=middle><img src="<?php echo THEMEURL;?>/images/nbreak.png"></td>

                            <td align=left valign=middle valign=middle style="padding: 0px 20px"><a href="<?php echo SITEURL ;?>/tourism.html"><img src="<?php echo THEMEURL;?>/images/tourism1.png" onMouseOver="javascript: this.src='<?php echo THEMEURL;?>/images/tourism2.png'" onMouseOut="javascript: this.src='<?php echo THEMEURL;?>/images/tourism1.png'" border=0 alt="Tourism"></a></td>

                            <td align=center valign=middle><img src="<?php echo THEMEURL;?>/images/nbreak.png"></td>

                            <td align=left valign=middle valign=middle style="padding: 0px 20px"><a href="<?php echo SITEURL ;?>/local-businesses.html"><img src="<?php echo THEMEURL;?>/images/businesses1.png" onMouseOver="javascript: this.src='<?php echo THEMEURL;?>/images/businesses2.png'" onMouseOut="javascript: this.src='<?php echo THEMEURL;?>/images/businesses1.png'" border=0 alt="Local Businesses"></a></td>
                        </tr>
                    </table>



                </td></tr>
        </table>



        <table width=980 class=table1 bgcolor=#FFFFFF>
            <tr>
                <td width=980 style="background-image: url(<?php echo THEMEURL;?>/images/ctop.png); background-repeat: no-repeat; background-position: center top;" height=100 valign=top>

