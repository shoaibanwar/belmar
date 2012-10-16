<?php
if (!defined("_VALID_PHP"))

die('Direct access to this location is not allowed.');


if(!$user->checkOperationPermission('public_works_list')): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;

require_once("../lang/" . $core->language . ".lang.php");
?>


<?php
$contentpublicwork=new Content();
$publicworkrow=$contentpublicwork->getpublicworks();
?>
<?php switch($core->maction):
  case "view": ?>
  <?php $row = $core->getRowById("publicworks",$_GET['publicworksid']) ;?>
  <h1><img src="images/mod-sml.png" alt="" /><?php echo PublicWorks_EM_View ;?></h1>
  <p class="info"><?php echo _PR_INFO1. _REQ1.required(). _REQ2;?></p>
  <h2><?php echo PRoom_EM_SUBTITLE1 . $row['fname'];?></h2>

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
              <td width="150"><?php echo address;?>:</td>
              <td><?php echo $row['address'] ?></td>
           </tr>

          <tr>
              <td width="150"><?php echo city;?>:</td>
              <td><?php echo $row['city'] ?> </td>
          </tr>

          <tr>
              <td width="150"><?php echo state;?>:</td>
              <td><?php echo $row['state'] ?></td>
          </tr>

          <tr>
              <td width="150"><?php echo zip_code;?>:</td>
              <td><?php echo $row['zip_code'] ?></td>
          </tr>

          <tr>
              <td width="150"><?php echo telephone;?>:</td>
              <td><?php echo $row['telephone'] ?></td>
          </tr>



          <tr>
              <td width="150"><?php echo location;?>:</td>
              <td><?php echo $row['location'] ?></td>
          </tr>

          <tr>
              <td width="150"><?php echo message;?>:</td>
              <td><?php echo $row['message'] ?></td>
          </tr>

          <tr>
              <td width="150"><?php echo reason_for_submition;?>:</td>
              <td><?php echo $row['reason'] ?></td>
          </tr>
          <tr>
              <td width="150"><?php echo other;?>:</td>
              <td><?php echo $row['other'] ?></td>
          </tr>
      </table>

  </form>
  <?php break; ?>

<?php default: ?>

<h1><img src="images/mod-sml.png" alt="" /><?php echo publicwork_EM_TITILE;?></h1>
<p class="info"><?php echo PLG_EM_INFO3;?></p>
<div class="box">
    <table cellpadding="0" cellspacing="0" class="formtable">
        <tr style="background-color:transparent">
            <td>

                <form action="" method="post" id="dForm">
                    <table>
                        <td><input name="search" type="text" class="inputbox"  value="" size="40" />

                        </td>

                        <td>
                            <input name="find" type="submit" class="button-sml" value="<?php echo _UR_FIND;?>" />
                        </td>
                    </table>
                </form>

            </td>

            <td align="right" colspan="3">
                <strong><?php echo _UR_USR_FILTER;?>:</strong>&nbsp;&nbsp;
                <select name="sort" onchange="if(this.value!='NA') window.location='index.php?do=publicworks&amp;sort='+this[this.selectedIndex].value; else window.location='index.php?do=';" style="width:220px" class="custombox">
                    <option value="NA"><?php echo _UR_RESET_FILTER;?></option>
                    <?php echo $contentpublicwork->getPublicWorksFilter();  ?>
                </select>
            </td>
        </tr>
        <tr style="background-color:transparent">
            <td colspan="2"> </td>

            <td align="right">
                <?php echo $pager->items_per_page();?> &nbsp;&nbsp;
                <?php if($pager->num_pages >= 1) echo $pager->jump_menu();?></td>

        </tr>
    </table>
</div>

<table cellpadding="0" cellspacing="0" class="display">
    <thead>
    <tr>
        <td width="15">#</td>


        <?php if(isset($_GET['sort']) && $_GET['sort']=='fname-DESC')
    {?>
        <td><strong> <a href="index.php?sort=fname-ASC&do=publicworks"><img src="images/down.png"/><?php echo Public_EM_FullNAME;?></a></strong></td>
        <?}else{ ?>

        <td><strong><a href="index.php?sort=fname-DESC&do=publicworks"><img src="images/up.png"/><?php echo Public_EM_FullNAME;?></a></strong></td>
        <? } ?>



        <?php if(isset($_GET['sort']) && $_GET['sort']=='city-DESC')
    {?>
        <td><strong><a href="index.php?sort=city-ASC&do=publicworks"><img src="images/down.png"/><?php echo PLG_EM_City;?></a></strong></td>
        <?}else{ ?>
        <td><strong><a href="index.php?sort=city-DESC&do=publicworks"><img src="images/up.png"/><?php echo PLG_EM_City;?></a></strong></td>

        <? } ?>


        <?php if(isset($_GET['sort']) && $_GET['sort']=='state-DESC')
    {?>
        <td><strong><a href="index.php?sort=state-ASC&do=publicworks"><img src="images/down.png"/>State</a></strong></td>
        <?}else{ ?>
        <td><strong><a href="index.php?sort=state-DESC&do=publicworks"><img src="images/up.png"/>State</a></strong></td>

        <? } ?>


        <td><strong><?php echo _DELETE;?></strong></td>

    </tr>
    </thead>
    <tbody>

    <?php if($publicworkrow == 0):?>
    <tr>
        <td colspan="6"><div class="msgInfo"><?php echo PLG_EM_NOEVENT2;?></div></td>
    </tr>
        <?php else:?>
       <?php $counter=1; ?>
        <?php foreach ($publicworkrow as $emrow):?>

        <td> <?php echo $counter;?></td>


        <td class="center"> <a href="index.php?do=publicworks&amp;mod_action=view&amp;publicworksid=<?php echo $emrow['id'];?>" ><?php echo  $emrow['fname']." ".$emrow['lname'] ?> </a></td>
        <td class="center"><?php echo  $emrow['city'] ?></td>
        <td class="center"><?php echo $emrow['state']; ?></td>

        <td align="left">
            <a href="javascript:void(0);" class="delete" rel="<?php echo $emrow['fname'];?>" id="item_<?php echo $emrow['id'];?>"><img src="images/delete.png" alt="" class="tooltip" title="<?php echo _DELETE.': '.$emrow['fname'];?>" /></a>
        </td>
        <!--        <td align="center"></td>-->
        </tr>
            <?php $counter++ ?>
            <?php endforeach;?>
        <?php unset($slrow);?>
        <?php if($pager->items_total >= $pager->items_per_page):?>
        <tr style="background-color:transparent">
            <td colspan="8" style="padding:10px;"><div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
        </tr>


            <?php endif;?>
        <?php endif;?>
    </tbody>

</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '.PLG_EM_Publicworks;?>">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>


<script type="text/javascript">
    // <![CDATA[
    $(document).ready(function () {
        $("#search-input").watermark("<?php echo UR_FIND_PUBLIC_WORKS;?>");
        $("#search-input").keyup(function () {
            var srch_string = $(this).val();
            var data_string = 'publicworkssearch=' + srch_string;
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

                    ;$.ajax({
                        type: 'post',
                        url: "publicworkscontroller.php",
                        data: 'deletepublicworks=' + id + '&publicfname=' + title,
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
                    })

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