<?php
/**
 *
 * User: HollyCode2
 * Date: 6/18/12
 * Time: 11:29 AM
 */
class Groups
{

    public static function getUsers($gid)
    {
        global $db;
        $sql = "SELECT * FROM users WHERE department_id = $gid";

         return $db->fetch_all($sql);

    }
    public static function countUsers($gid)
    {
        global $db;
        $sql = "SELECT count(*) AS count FROM users WHERE department_id = $gid ";
        $row = $db->first($sql);
        if(!empty($row))
            return $row['count'];
        return false;
    }
}
                                 ?>