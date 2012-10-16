<?php
if (!defined("_VALID_PHP"))

die('Direct access to this location is not allowed.');


if(!$user->checkOperationPermission('survey_list')): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;

require_once("../lang/" . $core->language . ".lang.php");
?>


<?php
$contentBelmarSurvay=new Content();
$BelmarSurvayrow=$contentBelmarSurvay->getBelmarsurvay();
?>
<?php switch($core->maction):
  case "view": ?>
  <?php $row = $core->getRowById("belmarsurvey",$_GET['belmarsurveyid']) ;?>
  <h1><img src="images/mod-sml.png" alt="" /><?php echo BelmarSurvey_EM_View ;?></h1>
  <p class="info"><?php echo _PR_INFO1. _REQ1.required(). _REQ2;?></p>
  <h2><?php echo BelmarSurvey_EM_SUBTITLE1 . $row['fname'];?></h2>

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
              <td width="150"><?php echo Bulmersurvey_Dept;?>:</td>
            <?php $seldept='select * from departments where id='.$row['dept_id']; 
   
    $resdeptname=mysql_query($seldept);
    if($resdeptname){
   $deptrows=mysql_fetch_array($resdeptname);
    }
    ?>
     <td><?php echo $deptrows['dep_name'] ?></td>
        </tr>
          <tr>
              <td width="150"><?php echo BelmarSurvey_experience;?>:</td>
              <td><?php echo $row['experience'] ?> </td>
          </tr>

          <tr>
              <td width="150"><?php echo BelmarSurvey_staff;?>:</td>
              <td><?php echo $row['staff'] ?></td>
          </tr>

          <tr>
              <td width="150"><?php echo BelmarSurvey_questions;?>:</td>
              <td><?php echo $row['questions'] ?></td>
          </tr>

          <tr>
              <td width="150"><?php echo BelmarSurvey_comments;?>:</td>
              <td><?php echo $row['comments'] ?></td>
          </tr>
  </table>

  </form>
  <?php break; ?>

<?php default: ?>

<h1><img src="images/mod-sml.png" alt="" /><?php echo BelmarSurvey_EM_TITILE;?></h1>
<p class="info"><?php echo PLG_EM_INFO3;?></p>
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
                <select name="sort" onchange="if(this.value!='NA') window.location='index.php?do=belmarsurvey&amp;sort='+this[this.selectedIndex].value; else window.location='index.php?do=';" style="width:220px" class="custombox">
                    <option value="NA"><?php echo _UR_RESET_FILTER;?></option>
                    <?php echo $contentBelmarSurvay->getBelmarsurveyFilter();  ?>
                </select>
            </td>
        </tr>
        <tr style="background-color:transparent">
            <td colspan="2"></td>

            <td align="right">
                <?php echo $pager->items_per_page()?> &nbsp;&nbsp;
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
        <td><strong> <a href="index.php?sort=fname-ASC&do=belmarsurvey"><img src="images/down.png"/><?php echo Public_EM_FullNAME;?></a></strong></td>
        <?}else{ ?>

        <td><strong><a href="index.php?sort=fname-DESC&do=belmarsurvey"><img src="images/up.png"/><?php echo Public_EM_FullNAME;?></a></strong></td>
        <? } ?>

        <?php if(isset($_GET['sort']) && $_GET['sort']=='lname-DESC')
    {?>
        <th align="left"><a href="index.php?do=belmarsurvey&sort=lname-ASC"><img src="images/down.png"/><?php echo "Last Name";?></a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=belmarsurvey&sort=lname-DESC"><img src="images/up.png"/><?php echo "Last Name";?></a></th>
        <? } ?>

        <?php if(isset($_GET['sort']) && $_GET['sort']=='email-DESC')
    {?>
        <td><strong> <a href="index.php?sort=email-ASC&do=belmarsurvey"><img src="images/down.png"/>Email</a></strong></td>
        <?}else{ ?>

        <td><strong><a href="index.php?sort=email-DESC&do=belmarsurvey"><img src="images/up.png"/>Email</a></strong></td>
        <? } ?>

        <?php if(isset($_GET['sort']) && $_GET['sort']=='dept_id-DESC')
    {?>
        <td><strong> <a href="index.php?sort=dept_id-ASC&do=belmarsurvey"><img src="images/down.png"/>Department</a></strong></td>
        <?}else{ ?>

        <td><strong><a href="index.php?sort=dept_id-DESC&do=belmarsurvey"><img src="images/up.png"/>Department</a></strong></td>
        <? } ?>

        <?php if(isset($_GET['sort']) && $_GET['sort']=='date_created-DESC')
    {?>
        <th align="left"><a href="index.php?do=belmarsurvey&sort=date_created-ASC"><img src="images/down.png"/><?php echo "Date Added";?></a></th>
        <?}else{ ?>

        <th align="left"><a href="index.php?do=belmarsurvey&sort=date_created-DESC"><img src="images/up.png"/><?php echo "Date Added";?></a></th>
        <? } ?>

        <td><strong><?php echo _DELETE;?></strong></td>

    </tr>
    </thead>
    <tbody>

    <?php if($BelmarSurvayrow==0):?>
    <tr>
        <td colspan="6"><div class="msgInfo"><?php echo PLG_EM_NOEVENT_BelmarSurvey;?></div></td>
    </tr>
        <?php else:?>
       <?php $counter=1; ?>
        <?php foreach ($BelmarSurvayrow as $emrow):?>

        <td> <?php echo $counter;?></td>


        <td class="center"> <a href="index.php?do=belmarsurvey&amp;mod_action=view&amp;belmarsurveyid=<?php echo $emrow['id'];?>" ><?php echo  $emrow['fname']; ?> </a></td>
        <td align="left"><?php echo $emrow['lname'] ?></td>
      
        <td class="center"><?php echo $emrow['email']; ?></td>
      
        
    <?php $seldept='select * from departments where id='.$emrow['dept_id']; 
   
    $resdeptname=mysql_query($seldept);
    if($resdeptname){
   $deptrows=mysql_fetch_array($resdeptname);
    }
    ?>
        
        <td class="center"><?php echo  $deptrows['dep_name'] ?></td>
        <td align="left"><?php echo $emrow['date_created']; ?></td>

        <td align="left">
            <a href="javascript:void(0);" class="delete" rel="<?php echo $emrow['fname'];?>" id="item_<?php echo $emrow['id'];?>"><img src="images/delete.png" alt="" class="tooltip" title="<?php echo Delete.':'.$emrow['fname'];?>" /></a>
        </td>
       </tr>
            <?php $counter++ ?>
            <?php endforeach;?>
        <?php unset($emrow);?>
        <?php if($pager->items_total >= $pager->items_per_page):?>
        <tr style="background-color:transparent">
            <td colspan="8" style="padding:10px;"><div class="pagination"><span class="inner"><?php echo $pager->display_pages();?></span></div></td>
        </tr>
        <?php endif;?>
        <?php endif;?>
    </tbody>

</table>
<div id="dialog-confirm" style="display:none;" title="<?php echo _DELETE.' '.PLG_EM_belmarsurvey;?>">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></p>
</div>


<script type="text/javascript">
    // <![CDATA[
    $(document).ready(function () {
        $("#search-input").watermark("<?php echo UR_FIND_BelmarSurvey;?>");
        $("#search-input").keyup(function () {
            var srch_string = $(this).val();
            var data_string = 'belmarsurveysearch=' + srch_string;
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
                        url: "belmarsurveycontroller.php",
                        data: 'deletebelmarsurvey=' + id + '&belmarsurveyfname=' + title,
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