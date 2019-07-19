<?php
require_once("helpers/ProductData.php");

if(isset($_GET['productCode']))
{
    ProductData::Delete($_GET['productCode']);
    header("location:product_list.php?message=Deleted successfully!");
}