<?php
if (!defined("_VALID_PHP"))
    die('Direct access to this location is not allowed.');
if(!$user->checkOperationPermission('opt_out_list')): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;

?>

<?php switch($core->maction):
    case "view": ?>

<!--       --><?php //$table= $_GET['table']; ?>
    <?php $row = $core->getRowById("countalertsmaillist",$_GET['optoutid'],$_GET['email']) ;?>
    <h1><img src="images/mod-sml.png" alt="" /><?php echo alert_EM_Opt_out ;?></h1>
    <p class="info"><?php echo _Opt_Out_INFO1;?></p>
    <h2><?php echo Opt_Out_List_EM_SUBTITLE1 . $row['fname'];?></h2>

    <form action="" method="post" id="admin_form" name="admin_form">
        <table cellspacing="0" cellpadding="0" class="formtable">
            <tr>
                <td width="150"><?php echo _FNAME?>:</td>
                <td><?php echo $row['fname'];?> </td>

            </tr>

            <tr>
                <td width="150"><?php echo _UR_LNAME ;?>:</td>
                <td><?php echo $row['lname'] ?></td>
            </tr>

            <tr>
                <td width="150"><?php echo emailaddress;?>:</td>
                <td><?php echo $row['email'] ?></td>
            </tr>


            <tr>
                <td width="150"><?php echo mobile;?>:</td>
            <?php if($row['mobile']){$mobile= $row['mobile'];}else{$mobile="-";} ?>
                <td><?php echo $mobile ?></td>
            </tr>

            <tr>
                <td width="150"><?php echo address;?>:</td>
                <?php if($row['address']){$address= $row['address'];}else{$address="-";} ?>
                <td><?php echo $address; ?></td>
            </tr>

            <tr>
                <td width="150"><?php echo city;?>:</td>
                <?php if($row['city']){$city= $row['city'];}else{$city="-";} ?>
                <td><?php echo $city; ?> </td>
            </tr>

            <tr>
                <td width="150"><?php echo state;?>:</td>
                <?php if($row['state']){$state= $row['state'];}else{$state="-";} ?>
                <td><?php echo $state; ?></td>
            </tr>

            <tr>
                <td width="150"><?php echo zip_code;?>:</td>
                <?php if($row['zipcode']){$zipcode= $row['zipcode'];}else{$zipcode="-";} ?>
                <td><?php echo $zipcode; ?></td>
            </tr>

            <tr>
                <td width="150"><?php echo alertme;?>:</td>
                <?php if($row['alertme']){$alertme= $row['alertme'];}else{$alertme="-";} ?>
                <td><?php echo $alertme; ?></td>
            </tr>

            <tr>
                <td width="150"><?php echo alertvia;?>:</td>
                <?php if($row['alertvia']){$alertvia= $row['alertvia'];}else{$alertvia="-";} ?>
                <td><?php echo $alertvia; ?></td>
            </tr>
        </table>

    </form>
    <?php break; ?>

    <?php
    default : ?>
<?php
   $outlist=new Content();
    $allaoutlist=$outlist->getalloptlist();?>
    <h1><img src="images/mod-sml.png" alt="" />Get Opt Out List</h1>
    <p class="info">Forms -> Out list</p>
    <div class="box">
        <table cellpadding="0" cellspacing="0" class="formtable">
            <tr style="background-color:transparent">
                <td>
                    <form action="" method="post" id="dForm">
                        <table>
                            <td><input name="search" type="text" class="inputbox" value="" size="40" />

                            </td>

                            <td>
                                <input name="find" type="submit" class="button-sml" value="<?php echo _UR_FIND;?>" />
                            </td>
                        </table>
                    </form>
                </td>
                <td align="right" colspan="3">
                    <strong><?php echo _UR_USR_FILTER;?>:</strong>&nbsp;&nbsp;
                    <select name="sort" onchange="if(this.value!='NA') window.location='index.php?do=lists/opt_out&amp;sort='+this[this.selectedIndex].value; else window.location='index.php?do=lists/opt_out';" style="width:220px" class="custombox">
                        <option value="NA"><?php echo _UR_RESET_FILTER;?></option>
                        <?php echo $outlist->getoutlistFilter();  ?>
                    </select>
                </td>
            </tr>
            <tr style="background-color:transparent">
                <td colspan="2"></td>

                <td align="right">
                    <?php echo $pager->items_per_page()?> &nbsp;&nbsp;
                    <?php if($pager->num_pages >= 1) echo $pager->jump_menu();?>

                </td>
            </tr>
        </table>
    </div>
    <table cellpadding="0" cellspacing="0" class="display">
        <thead>
        <tr>
            <th align="left">#</th>


            <?php if(isset($_GET['sort']) && $_GET['sort']=='fname-DESC')
        {?>
            <th align="left"><a href="index.php?do=lists/opt_out&sort=fname-ASC"><img src="images/down.png"/><?php echo _Press_opt_out_fname;?></a></th>
            <?}else{ ?>

            <th align="left"><a href="index.php?do=lists/opt_out&sort=fname-DESC"><img src="images/up.png"/><?php echo _Press_opt_out_fname;?></a></th>
            <? } ?>


            <?php if(isset($_GET['sort']) && $_GET['sort']=='lname-DESC')
        {?>
            <th align="left"><a href="index.php?do=lists/opt_out&sort=lname-ASC"><img src="images/down.png"/>Last Name</a></th>
            <?}else{ ?>

            <th align="left"><a href="index.php?do=lists/opt_out&sort=lname-DESC"><img src="images/up.png"/>Last Name</a></th>
            <? } ?>


            <?php if(isset($_GET['sort']) && $_GET['sort']=='email-DESC')
        {?>
            <th align="left"><a href="index.php?do=lists/opt_out&sort=email-ASC"><img src="images/down.png"/>Email</a></th>
            <?}else{ ?>

            <th align="left"><a href="index.php?do=lists/opt_out&sort=email-DESC"><img src="images/up.png"/>Email</a></th>
            <? } ?>


        </tr>
        </thead>
        <tbody>
            <?php if($allaoutlist==0):?>
        <tr>
            <td colspan="10"><?php echo $core->msgAlert(_PG_NOPAGES,false);?></td>
        </tr>
            <?php else:?>
            <?php $counter=1; ?>
            <?php foreach($allaoutlist as $allaoutlistrow): ?>

            <tr>
                <td align="left"><?php echo $counter ?></td>
                <td align="left"><a href="index.php?do=lists/opt_out&mod_action=view&amp;&optoutid=<?php echo $allaoutlistrow['id'] ?>&email=<?php echo $allaoutlistrow['email']?>"><?php echo $allaoutlistrow['fname']  ?></a></td>
                <td align="left"><?php echo $allaoutlistrow['lname']  ?></td>


                <td align="left"><?php echo $allaoutlistrow['email']; ?></td>
                </tr>
                <?php $counter++; ?>
                <?php endforeach; ?>

            <?php unset($allaoutlistrow);?>
            <?php if($pager->items_total >= $pager->items_per_page):?>
            <tr style="background-color:transparent">
                <td colspan="8" style="padding:10px;">
                    <div class="pagination">
                        <span class="inner"><?php echo $pager->display_pages();?></span>
                    </div>
                </td>
            </tr>

             <?php endif;?>
            <?php endif;?>


    </table>

    <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function () {

            $("#search-input").watermark("<?php echo UR_FIND_fname;?>");
            $("#search-input").keyup(function () {
                var srch_string = $(this).val();
                var data_string = 'optoutsearch=' + srch_string;
                if (srch_string.length > 0) {
                    $.ajax({
                        type: "POST",
                        url: "ajax.php",
                        data: data_string,
                        beforeSend: function () {
                            $('#search-input').addClass('loading');
                        },
                        success: function (res) {
                            $('#suggestions').html(res).show();
                            $("input").blur(function () {
                                $('#suggestions').customFadeOut();
                            });
                            if ($('#search-input').hasClass("loading")) {
                                $("#search-input").removeClass("loading");
                            }
                        }
                    });
                }
                return false;
            });

            $('a.delete').live('click', function () {
                var id = $(this).attr('id').replace('item_', '')
                var parent = $(this).parent().parent();
                var title = $(this).attr('rel');
                $("#dialog-confirm").data({
                    'delid': id,
                    'parent': parent,
                    'title': title
                }).dialog('open');
                return false;
            });

            $("#dialog-confirm").dialog({
                resizable: false,
                bgiframe: true,
                autoOpen: false,
                width: 400,
                height: "auto",
                zindex: 9998,
                modal: false,
                buttons: {
                    '<?php echo _DELETE;?>': function () {
                        var parent = $(this).data('parent');
                        var id = $(this).data('delid');
                        var title = $(this).data('title');

                        $.ajax({
                            type: 'post',
                            url: "ajax.php",
                            data: 'deleteoptout=' + id + '&optouttitle=' + title,
                            beforeSend: function () {
                                parent.animate({
                                    'backgroundColor': '#FFBFBF'
                                }, 400);
                            },
                            success: function (msg) {
                                parent.fadeOut(400, function () {
                                    parent.remove();
                                });
                                $("html, body").animate({scrollTop:0}, 600);
                                $("#msgholder").html(msg);
                            }
                        });

                        $(this).dialog('close');
                    },
                    '<?php echo _CANCEL;?>': function () {
                        $(this).dialog('close');
                    }
                }
            });
        });
        // ]]>
    </script>
    <?php endswitch; ?>
