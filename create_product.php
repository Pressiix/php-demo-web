<?php 
require_once("helpers/ProductData.php");

$check_existing_productName = false;
    if(isset($_POST['product_name'])){
        foreach($_POST['product_name'] as $productName)
        {
            if($_POST['addProductName'] == $productName )
            {
                $check_existing_productName = true;
            }
        }
        
        if($check_existing_productName == false)
        {
            ProductData::Create($_POST['addProductName'] ,$_POST['addPrice'] ,$_POST['addQuantity'],$_POST['addType']); 
            header("location:product_list.php?message=Product has been added!");
        }
        else{
            header("location:product_list.php?message=Product does exist!");
        }
    }
    else
    {
        if(isset($_POST['addProductName']))
        {
            ProductData::Create($_POST['addProductName'] ,$_POST['addPrice'] ,$_POST['addQuantity'],$_POST['addType']); 
            header("location:product_list.php?message=Product has been added!");
        }
    }