<?php 
session_start();
    include_once("helpers/ActiveQuery.php");
?>
<style type="text/css">
.productbox {
    background-color:#ffffff;
	padding:10px;
	-webkit-box-shadow: 0 8px 6px -6px  #999;
	   -moz-box-shadow: 0 8px 6px -6px  #999;
	        box-shadow: 0 8px 6px -6px #999;
}

.producttitle {
    font-weight:bold;
    font-size:1.4em;
	padding:5px 0 5px 0;
}

.productprice {
	border-top:1px solid #dadada;
	
}

.pricetext {
	font-size:1em;
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
    if($row != 0)
    {
        foreach($result as $product)
        {  
?>
                    <div class="col-md-3 column productbox">
                        <img src="https://consumergoods.com/_flysystem/s3/styles/primary_articles/s3/2018-09/orcale_teaser.png?itok=lBZvpJVh" class="img-responsive">
                        <div class="producttitle"><?= $product['productName']; ?></div>
                        
                        <div class="productprice">
                        <div class="pricetext">Price : ฿<?= $product['price']; ?></div>
                            <div class="col-md-8" >
                                <div class="input-group " style="padding-top:1px;">
                                    <span class="input-group-btn" style="padding-top:6px;">
                                        <button type="button" class="btn btn-default" >
                                            <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>
                                    <span >
                                        <input type="text"  class="form-control input-md" value="0" min="0" max="100" style="height:34px;">
                                    </span>
                                    <span class="input-group-btn" style="padding-top:6px;">
                                        <button type="button" class="btn btn-default">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4" style="padding-top:8px;">
                                <button class="btn btn-warning"><span class="fa fa-cart-plus"></span></button>
                            </div>
                        </div>
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