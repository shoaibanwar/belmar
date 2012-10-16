<?php

if (!defined("_VALID_PHP"))
    die('Direct access to this location is not allowed.');

require_once("../lang/" . $core->language . ".lang.php");
require_once("contact_class.php");

if(isset($_GET['action'])):
switch($_GET['action']):

    case "view":
        if(!isset($_GET['cid']))
            return;
        $contact = Contact::getContact(intval($_GET['cid']));

        ?>
        <h1><img src="images/mod-sml.png" alt="" />Contact form entry</h1>
        <p class="info">Forms -> Contact Form -> view entry</p>
            <table cellspacing="0" cellpadding="0" style="margin-bottom: 25px" class="formtable">
                <tbody>
                <tr>


                    <td width="200">Sender:</td>
                    <td><?php echo $contact['fname'] .' '. $contact['lname']; ?></td>
                </tr>
                <tr>
                    <td width="200">Department:</td>
                    <td><?php echo Users::getDepartmentName($contact['dep_id']); ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $contact['email']; ?></td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><?php echo $contact['date_of_birth']; ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo $contact['address']; ?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td><?php echo $contact['city']; ?></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td><?php echo $contact['state']; ?></td>
                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td><?php echo $contact['zipcode']; ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><?php echo $contact['phone']; ?></td>
                </tr>
                <tr>
                    <td>Fax</td>
                    <td><?php echo $contact['fax']; ?></td>
                </tr>
                <tr>
                    <td>Message</td>
                    <td><?php echo $contact['message']; ?></td>
                </tr>
                <tr>
                    <td>Date created</td>
                    <td><?php echo $contact['date_created']; ?></td>
                </tr>
                </tbody>
            </table>



          <?php
        break;


endswitch;

else:
  $contacts = Contact::getallcontacts();

  // $contacts=contact::getallcontacts();

    ?>
<!--<h1><img src="images/mod-sml.png" alt="" />Contact form entries</h1>-->
<!--<p class="info">Forms -> Contact Form</p>-->
<!---->


<h1><img src="images/mod-sml.png" alt="" /><?php echo PContactlist_EM_TITLE1;?></h1>
<p class="info"><?php echo Pcontactlist_EM_INFO3;?></p>
<h2><?php echo PcontactList_EM_SUBTITLE3;?></h2>




<div class="box">
<table style="width:100%" class="formtable">
    <tr style="background-color:transparent">
    <tbody>
    <td>

<!--    -->
<!--        <input id="contactSearch" type="text" class="inputbox" />-->
<!--        <button onclick="handleSearch()" class=button-sml>search</button>-->
<!--   -->
<!--   -->

        <form action="" method="post" id="dForm">
            <table>
                <td><span>Search by keyword</span>
                    <input name="search" type="text" class="inputbox"  value="" size="40" />
                    
                </td>

                <td>
                    <input name="find" type="submit" class="button-sml" value="<?php echo _UR_FIND;?>" />
                </td>
            </table>
        </form>




    </td>
        <?php if($user->checkOperationPermission('contact_form_all')): ?>
    <td><span>Show by type: </span>
        <?php $departments = Users::getDepartments(); ?>
        <select name="depId" class="custombox" style="width:200px;" onchange="javascript:handleTypeSelect(this)">
            <option value="all" selected="selected">---none---</option>
         <?php foreach($departments as $department): ?>

            <option <?php if(isset($_GET['dep_id']) && $department['id'] == $_GET['dep_id']) echo "selected='selected'"; ?> value="<?php echo $department['id']; ?>"><?php echo $department['dep_name']; ?></option>
          <?php endforeach; ?>
        </select>
    </td>
        <?php endif; ?>


    <td align="right" colspan="3">
        <!--<strong><?php echo _UR_USR_FILTER;?>:</strong>&nbsp;&nbsp;
        <select name="sort" onchange="if(this.value!='NA') window.location='index.php?do=lists/contact&amp;sort='+this[this.selectedIndex].value; else window.location='index.php?do=lists/contact';" style="width:220px" class="custombox">
            <option value="NA"><?php echo _UR_RESET_FILTER;?></option>
            <?php echo  Contact::getcontactFilter(); ?>
        </select>-->
            <?php echo $pager->items_per_page()?> &nbsp;&nbsp;
            <?php //if($pager->num_pages >= 1) echo $pager->jump_menu();?>
                            <strong><?php echo _C_ACTION;?></strong>&nbsp;&nbsp;
                            <select name="sort" style="width:120px" class="custombox group_actions">
                                <option value="NA">--none--</option>
                                <option value="delete"><?php echo _PG_DELETE;?></option>
                                <option value="publish"><?php echo _PUB;?></option>
                                <option value="unpublish"><?php echo _UNPUB;?></option>

                            </select>
    </td>
    </tr>


    </tbody>
</table>
</div>
<table class="display">
    <thead>
    <tr>
        <th width="20">#</th>


<!--        <th>Sender</th>-->

        <?php if(isset($_GET['sort']) && $_GET['sort']=='fname-DESC')
    {?>
        <th align="left"><a href="index.php?do=lists/contact&sort=fname-ASC"><img src="images/down.png"/><?php echo _Press_contact_fname;?></a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=lists/contact&sort=fname-DESC"><img src="images/up.png"/><?php echo _Press_contact_fname;?></a></th>
        <? } ?>

        <?php if(isset($_GET['sort']) && $_GET['sort']=='lname-DESC')
    {?>
        <th align="left"><a href="index.php?do=lists/contact&sort=lname-ASC"><img src="images/down.png"/><?php echo "Last Name";?></a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=lists/contact&sort=lname-DESC"><img src="images/up.png"/><?php echo "Last Name";?></a></th>
        <? } ?>



        <?php if(isset($_GET['sort']) && $_GET['sort']=='email-DESC')
    {?>
        <th align="left"><a href="index.php?do=lists/contact&sort=email-ASC"><img src="images/down.png"/><?php echo "Email";?></a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=lists/contact&sort=email-DESC"><img src="images/up.png"/><?php echo "Email";?></a></th>
        <? } ?>


        <?php if(isset($_GET['sort']) && $_GET['sort']=='dep_id-DESC')
    {?>
        <th align="left"><a href="index.php?do=lists/contact&sort=dep_id-ASC"><img src="images/down.png"/><?php echo "Type";?></a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=lists/contact&sort=dep_id-DESC"><img src="images/up.png"/><?php echo "Type";?></a></th>
        <? } ?>


        <?php if(isset($_GET['sort']) && $_GET['sort']=='date_created-DESC')
    {?>
        <th align="left"><a href="index.php?do=lists/contact&sort=date_created-ASC"><img src="images/down.png"/><?php echo "Date Added";?></a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=lists/contact&sort=date_created-DESC"><img src="images/up.png"/><?php echo "Date Added";?></a></th>
        <? } ?>



        <th align="left">View</th>

        <th align="left">Delete</th>
      <th align=left> <input type='checkbox' class='check_all'/></th>
    </tr>
    </thead>
    <?php if($contacts==0):?>
    <tr>
        <td colspan="10"><?php echo $core->msgAlert(_PG_NOPAGES,false);?></td>
    </tr>
    <?php else:?>

<?php $counter=1; ?>
<?php foreach($contacts as $contact): ?>
     <tr>
         <td><?php echo $counter;?></td>
         <td align="left"><a href="<?php echo ADMINURL . "/index.php?do=lists/contact&action=view&cid=" . $contact['id']; ?>" ><?php echo $contact['fname']; ?></a></td>
        <td align="left"><?php echo $contact['lname'] ?></td>
         <td align="left"><?php echo $contact['email'] ?></td>
         <td align="left"><span><?php echo Users::getDepartmentName($contact['dep_id']); ?></td>
         <td align="left"><?php echo $contact['date_created']; ?></td>
         <td align="left"><a href="<?php echo ADMINURL . "/index.php?do=lists/contact&action=view&cid=" . $contact['id']; ?>"><img src="images/viewPage.png" class="tooltip"  alt="" title="<?php echo "View".': '.$contact['fname'];?>"/></a></td>

         <td align="left"> <a href="javascript:void(0);" class="delete"  rel="<?php echo $contact['fname'];?>" id="item_<?php echo $contact['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo _DELETE.': '.$contact['fname'];?>"/></a></td>
      <td>
        <input type='checkbox' id='check_<?php echo $row['id'];?>' class='to_be_checked'/>
      </td>
     </tr>
<?php $counter++; ?>
<?php endforeach; ?>
    <?php unset($contact) ?>
    <?php if($pager->items_total >= $pager->items_per_page):?>
        <tr style="background-color:transparent">
            <td colspan="8" style="padding:10px;"><div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
        </tr>

        <?php endif;?>

<?php endif; ?>


</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' Contact? ';?>">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>

    <script type="text/javascript">
  $(document).ready(function () {
            $("#search-input").watermark("<?php echo UR_FIND_contactfname;?>");



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
                            data: 'deletecontact=' + id + '&deletecontacttitle=' + title,
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

        function handleTypeSelect(elm)
        {
            if(elm.value == 'all')
                window.location = "<?php echo ADMINURL; ?>?do=lists/contact";
            window.location = "<?php echo ADMINURL; ?>?do=lists/contact&dep_id=" + elm.value;
        }
        function handleSearch()
        {
            var keyword = document.getElementById("contactSearch").value;
            window.location = "<?php echo ADMINURL; ?>?do=lists/contact&search=" + keyword;
        }
        function handleItemPerPage(elm)
        {
            window.location = "<?php echo ADMINURL; ?>?do=lists/contact&ipp=" + elm.value;
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
            window.location = "<?php echo ADMINURL; ?>?do=lists/contact&pageNumber=" + elm.value + "<?php echo $getVars; ?>";
        }
    </script>
    <?php endif; ?>