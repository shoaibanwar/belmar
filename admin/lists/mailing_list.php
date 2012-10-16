<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HollyCode2
 * Date: 7/2/12
 * Time: 11:46 AM
 * To change this template use File | Settings | File Templates.
 */

if (!defined("_VALID_PHP"))
    die('Direct access to this location is not allowed.');


require_once("mailing_list_class.php");
    $subscribers = mailing_list::getSubscribers();

?>
<!--<h1><img src="images/mod-sml.png" alt="" />Contact form entries</h1>-->
<!--<p class="info">Mailing List</p>-->


<h1><img src="images/mod-sml.png" alt="" /><?php echo PMalingList_EM_TITLE1;?></h1>
<p class="info"><?php echo Pmailingtlist_EM_INFO3;?></p>
<h2></span><?php echo PMialinglist_EM_SUBTITLE3;?></h2>





<table style="width:100%" class="formtable">
    <tbody>
    <tr>
        <td>
            <input id="contactSearch" type="text" class="inputbox" />
            <button onclick="handleSearch()" class=button-sml>search</button>
        </td>
        <td>
            <?php echo $pager->items_per_page()?> &nbsp;&nbsp;
        </td>
        <td align="right">
            <?php if($pager->num_pages >= 1) echo $pager->jump_menu();?>
        </td>

    </tr>
    </tbody>
</table>
<table class="display">
    <thead>
    <tr>
        <th width="20">#</th>
        <?php if(isset($_GET['sort']) && $_GET['sort']=='fname-DESC')
    {?>
        <th align="left"><a href="index.php?do=lists/mailing_list&sort=fname-ASC"><img src="images/down.png"/>First Name</a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=lists/mailing_list&sort=fname-DESC"><img src="images/up.png"/>First Name</a></th>
        <? } ?>

        <?php if(isset($_GET['sort']) && $_GET['sort']=='lname-DESC')
    {?>
        <th align="left"><a href="index.php?do=lists/mailing_list&sort=lname-ASC"><img src="images/down.png"/><?php echo "Last Name";?></a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=lists/mailing_list&sort=lname-DESC"><img src="images/up.png"/><?php echo "Last Name";?></a></th>
        <? } ?>


        <?php if(isset($_GET['sort']) && $_GET['sort']=='email-DESC')
    {?>
        <th align="left"><a href="index.php?do=lists/mailing_list&sort=email-ASC"><img src="images/down.png"/><?php echo "Email";?></a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=lists/mailing_list&sort=email-DESC"><img src="images/up.png"/><?php echo "Email";?></a></th>
        <? } ?>
        <th>Remove</th>
    </tr>
    </thead>
    <?php foreach($subscribers as $subscriber): ?>
    <tr>
        <td><?php echo $subscriber['id']; ?></td>
        <td><?php echo $subscriber['fname']; ?></td>
        <td><?php echo $subscriber['lname']; ?></td>
        <td><?php echo $subscriber['email']; ?></td>
        <td align="center"> <a href="javascript:void(0);" class="delete" id="item_<?php echo $subscriber['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo _DELETE;?>"/></a></td>
    </tr>

    <?php endforeach; ?>
    <?php if($pager->items_total >= $pager->items_per_page):?>
    <tr style="background-color:transparent">
        <td colspan="8" style="padding:10px;"><div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
    </tr>

    <?php endif;?>

</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' Post? ';?>">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>

    <script type="text/javascript">

        $(document).ready(function () {
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
                            url: "lists/controller.php",
                            data: 'removeSubscriber=' + id ,
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

        function handleSearch()
        {
            var keyword = document.getElementById("contactSearch").value;
            window.location = "<?php echo ADMINURL; ?>?do=lists/mailing_list&search=" + keyword;
        }
        function handleItemPerPage(elm)
        {
            window.location = "<?php echo ADMINURL; ?>?do=lists/mailing_list&ipp=" + elm.value;
        }
        function handlePagination(elm)
        {
        <?php $getVars = '';
        if(isset($_GET['search']))
            $getVars .= "&search={$_GET['search']}";
        if(isset($_GET['dep_id']))
            $getVars .= "&dep_id={$_GET['dep_id']}";
        if(isset($_GET['ipp']))
            $getVars .= "&ipp={$_GET['ipp']}";
        if(isset($_GET['sort']))
            $getVars .= "&sort={$_GET['sort']}";
        ?>
            window.location = "<?php echo ADMINURL; ?>?do=lists/mailing_list&pageNumber=" + elm.value + "<?php echo $getVars; ?>";
        }
    </script>