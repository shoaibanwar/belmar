<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HollyCode2
 * Date: 6/27/12
 * Time: 5:37 PM
 * To change this template use File | Settings | File Templates.
 */

define("_VALID_PHP", true);

require_once("../init.php");
if ( !$user->is_Admin() && !isset($_POST['hash']) && $_POST['hash'] != $this->getHash() )
    redirect_to("../../login.php");


?>
<?php
/* Update Configuration*/
if (isset($_POST['deletecontact'])):
//    if(Contact::deletePost($_POST['deletePost']))
    $id = sanitize($_POST['deletecontact']);
    $db->delete("contact", "id='" . (int)$id . "'");
    $title = sanitize($_POST['deletecontacttitle']);
    print ($db->affected()) ? $hollysec->writeLog(PLG_EM_Contact .' <strong>'.$title.'</strong> '._DELETED, "", "no", "module") . $core->msgOk(PLG_EM_Contact .' <strong>'.$title.'</strong> '._DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);

endif;

if (isset($_POST['removeSubscriber'])):
    $id = sanitize($_POST['removeSubscriber']);
    $db->delete("mailing_list", "id='" . (int)$id . "'");
    print ($db->affected()) ? $hollysec->writeLog('Subscriber ' ._DELETED, "", "no", "module") . $core->msgOk('Subscriber ' ._DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);

endif;
?>