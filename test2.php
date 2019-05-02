<?php
include("helpers/ActiveQuery.php");
use helpers\ActiveQuery;

$sql = "SELECT * FROM products p RIGHT JOIN product_type t ON p.type_id = t.type_id";
$result = ActiveQuery::queryAll($sql);
$product = [];
$productType = [];
foreach($result as $queryResult)
{
   if(!isset($index))
   {
      $index = 0;
   }
   $productType[$index]['type_id'] = $queryResult['type_id'];
   $productType[$index]['type_name'] = $queryResult['type_name'];
   if(!empty($queryResult['productCode']))
   {
      $product[$index]['productCode'] = $queryResult['productCode'];
      $product[$index]['productName'] = $queryResult['productName'];
      $product[$index]['price'] = $queryResult['price'];
      $product[$index]['qty'] = $queryResult['qty'];
   }
   $index++;
   if (!is_array($queryResult) || empty($queryResult)) {
      unset($index);
  }
}
echo "<pre/>";
print_r($productType);
echo "<pre/>";