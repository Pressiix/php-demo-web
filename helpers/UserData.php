<?php
include_once("helpers/ActiveQuery.php");
use helpers\ActiveQuery;
class UserData extends ActiveQuery
{
    public static function Update($sql)
    {
        UserData::excute($sql);
    }

    public static function Delete($id)
    {
        $sql = "DELETE FROM member WHERE UserID = ".$id;
        UserData::excute($sql);
    }

    public static function Create($username ,$password ,$name ,$status)
    {
        $sql = "INSERT INTO member VALUES (NULL, '".$username."', '".$password."', '".$name."', '".$status."'
        , '', '', '', '', '')";
        UserData::excute($sql);
    }

    public static function findById($id)
    {
        $sql = "SELECT * FROM member WHERE UserID = ".$id;
        $result = UserData::queryAll($sql);

        return $result;
    }

    public static function findAll()
    {
        $sql = "SELECT * FROM member";
        $result = UserData::queryAll($sql);

        return $result;
    }

    public static function findOnlyUser()
    {
        $sql = "SELECT * FROM member WHERE Status = \"USER\"";

        $result = UserData::queryAll($sql);

        return $result;
    }

    public static function getUserId()
    {
        $user = UserData::findAll();
        return array_column($user, 'UserID');
    }
}