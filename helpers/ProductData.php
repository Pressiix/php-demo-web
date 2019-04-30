<?php
include_once("helpers/ActiveQuery.php");
use helpers\ActiveQuery;
class ProductData extends ActiveQuery
{
    public static function Delete($id)
    {
        $sql = "DELETE FROM products WHERE productCode = ".$id;
        ProductData::excute($sql);
    }

    public static function Create($name ,$price ,$qty ,$typeID)
    {
        $sql = "INSERT INTO products VALUES (NULL, '".$name."', '".$price."', '".$qty."', '".$typeID."')";
        ProductData::excute($sql);
    }

    public static function findAll()
    {
        $sql = "SELECT * FROM products";
        $result = ProductData::queryAll($sql);

        return $result;
    }

    public static function findAllType()
    {
        $sql = "SELECT * FROM product_type";
        $result = ProductData::queryAll($sql);

        return $result;
    }
}