<?php 
    include_once("helpers/ActiveQuery.php");
    ?>
<style type="text/css">
.productbox {
    background-color:#ffffff;
	padding:10px;
	margin-bottom:10px;
	-webkit-box-shadow: 0 8px 6px -6px  #999;
	   -moz-box-shadow: 0 8px 6px -6px  #999;
	        box-shadow: 0 8px 6px -6px #999;
}

.producttitle {
    font-weight:bold;
	padding:5px 0 5px 0;
}

.productprice {
	border-top:1px solid #dadada;
	padding-top:5px;
}

.pricetext {
	font-weight:bold;
	font-size:1.4em;
}

thead {
             position: absolute !important;
             top: -9999px !important;
             left: -9999px !important;
}

</style>
<div class="col-md-12">
<?php
    use helpers\ActiveQuery;
    if(isset($_GET['typeId']))
    {
        $sql = "SELECT * FROM products WHERE type_id = '".$_GET['typeId']."'";  
    }
    else
    {
        $sql = "SELECT * FROM products";
    }
    
    $content = [];
    $count = 0;
    $page = 1;
    $limit = 8;
    $result = ActiveQuery::queryAll($sql);
    $row = count($result);
    foreach($result as $product)
    {
        if($count <= $limit)
        {
            $content[$page][$count]  = $product;
            $count++;
        }
        else
        {
            $count = 0;
            $page++;
        }
    }
    
    /*echo "<pre/>";
    print_r($content);
    echo "<pre/>";*/
if($row != 0){
    foreach($result as $product)
    {  
?>
                    <div class="col-md-3 column productbox">
                        <img src="https://consumergoods.com/_flysystem/s3/styles/primary_articles/s3/2018-09/orcale_teaser.png?itok=lBZvpJVh" class="img-responsive">
                        <div class="producttitle"><?= $product['productName']; ?></div>
                        <div class="productprice"><div class="pull-right"><a href="#" class="btn btn-danger btn-sm" role="button">BUY</a></div><div class="pricetext">Price : <?= $product['price']; ?> THB</div></div>
                    </div>
<?php 
        
    }  
}
?>
</div>
<ul class="pagination pg-blue">
    <li class="page-item">
      <a class="page-link" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link">1</a></li>
    <li class="page-item"><a class="page-link">2</a></li>
    <li class="page-item"><a class="page-link">3</a></li>
    <li class="page-item">
      <a class="page-link" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>