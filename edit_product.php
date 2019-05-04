<?php 
include_once("helpers/ProductData.php");

if(isset($_POST['productCode']))
{
    $sql = "UPDATE products 
            SET productName = '".$_POST['editName']."', price = '".$_POST['editPrice']."', qty = '".$_POST['editQuantity']."' , products.type_id = '".$_POST['editType']."' 
            WHERE productCode = '".$_POST['productCode']."'";
            
    ProductData::Update($sql);
    header("location:product_list.php?message=updated successfully");
}