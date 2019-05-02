<?php
namespace helpers;
include_once($_SERVER['DOCUMENT_ROOT']."/PHP-demo/config/connect.php");

class ActiveQuery
{
    public static function queryAll($sqlCommand)
    {
        global $mysql;
        $result = [];
        $query_result = mysqli_query($mysql, $sqlCommand); 
        $index = 0;

        if($query_result)       //If your query return a result
        {
            $row = mysqli_num_rows($query_result);
            if($row > 0)         //If your query return a result as one dimensional array
            {
                for ($index=0;$index < $row;$index++) {
                    $result[$index] = $query_result->fetch_assoc();  //set result object for each rows and columns
                }
            }
        }
        return $result;
    }

    protected static function excute($sqlCommand)
    {
        global $mysql;
        $query_result = mysqli_query($mysql, $sqlCommand);
    }
}