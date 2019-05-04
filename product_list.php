<?php 
  include_once("nav.php"); 
  include_once("assets/DataTableAsset.php");
  include_once("helpers/ActiveQuery.php");
  use helpers\ActiveQuery;
  $tile = "Product List";
 ?>
 <title><?= $tile; ?></title>
<link rel="stylesheet" href="css/datatable-custom.css">
<link rel="stylesheet" href="css/loader.css">
<link rel="stylesheet" href="css/create-user-modal.css">
<link rel="stylesheet" href="css/edit-user-modal.css">
<style>
option {
  color: #7c7979;
}
</style>
<script type="text/javascript">
/** CUSTOMIZE DATATABLE ********/
    $(document).ready(function() {
      $('#demo-table thead tr ').clone(true).appendTo( '#demo-table thead' );
      $('#demo-table thead tr:eq(1) th').each( function (i) {
        
        if($(this).text() != "Action")
        {
          var title = $(this).text();
          $(this).html( '<input type="text" placeholder="Search '+title+'"/>' );
  
          $( 'input', this ).on( 'keyup change', function () {
              if ( table.column(i).search() !== this.value ) {
                  table
                      .column(i)
                      .search( this.value )
                      .draw();
              }
          } );
        }
        else
        {
          var title = "";
          $(this).html('<a href="product_list.php" data-toggle="modal" data-target="#create-product-modal" class="btn btn-success" role="button" style="border-radius: 18px;width:70px;"><span class="glyphicon glyphicon-plus"></span></a>');
        }
      } );

      var table = $('#demo-table').DataTable( {
          columnDefs: [
              { orderable: false, "targets": 5 }
          ],
          orderCellsTop: true,
          fixedHeader: true,ordering:true,
          bLengthChange : false,
        } );
    } );


/** Question before delete user ********/
function beforeDelete() {
      var href = $(this).attr('href');
      var r = confirm("Are you sure you want to delete a user?");
      if(r == true)
      {
        window.location.href = document.getElementById("delteProduct").href;
      }
      else{
        event.preventDefault();
      }
    }

/***** Loader animation *****/
function myFunction() {
  setTimeout(showPage, 1000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "inline-block";
}

//******* SHOW MESSAGE AFTER ACTION *******/
$(window).bind("load", function() {
  var qd = {};
  if (location.search) location.search.substr(1).split("&").forEach(function(item) {var s = item.split("="), k = s[0], v = s[1] && decodeURIComponent(s[1]); (qd[k] = qd[k] || []).push(v)})
  if(typeof qd.message !== 'undefined')
  {
    alert(qd.message);
    window.history.pushState({}, document.title, "/" + "PHP-demo/product_list.php");
  }
  
});
</script>
<?php 
 if(isset($_SESSION['Username']) && isset($_SESSION['Status']) && $_SESSION['Status'] == 'ADMIN')
 { 
  $sql = "SELECT * FROM products p RIGHT JOIN product_type t ON p.type_id = t.type_id ORDER BY t.type_id ASC";
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
        $product[$index]['type_id'] = $queryResult['type_id'];
        $product[$index]['type_name'] = $queryResult['type_name'];
     }
     $index++;
     if (!is_array($queryResult) || empty($queryResult)) {
        unset($index);
    }
  } 
  if(is_array($productType))
  {
    $productType = array_unique($productType, SORT_REGULAR);
  }
  
?>
      <body onload="myFunction()" style="margin:0;font-family: 'Comic Sans MS', cursive, sans-serif;">
      <!-- CREATE PRODUCT MODAL -->
      <div class="modal fade" id="create-product-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="font-family: 'Comic Sans MS', cursive, sans-serif;display: none;">
    	  <div class="modal-dialog">
				<div class="usermodal-container" style="background-color:#98464D;">
					<h1 style="color:white;">Add Product</h1><br>
				  <form  method="post" action="create_product.php">
              <input name="addProductName" type="text" placeholder="Name" id="addProductName" autocomplete="off" required>
              <input type="number" name="addPrice" placeholder="Price" id="addPrice" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" title="This should be a number with up to 2 decimal places." autocomplete="off" required>
              <input type="text" name="addQuantity" placeholder="Quantity" id="addQuantity" pattern="\d*" title="Quantity must be integer." autocomplete="off" required>
              <br/><br/>
              <select name="addType" id="addType" class="selectBox col-md-12" style="height:44px;font-family: 'Comic Sans MS', cursive, sans-serif;" required>
                  <option value="" hidden>Add Product Type</option>
                <?php 
                    if(isset($productType))
                    {
                      foreach($productType as $type)
                      { ?>
                        <option value="<?= $type['type_id'] ?>"><?= $type['type_name'] ?></option>
                <?php }
                    }
                ?>
              </select>
               <br/>
              <?php
               foreach($product as $val)
               {
                echo '<input type="hidden" name="product_name[]" value="'. $val["productName"]. '">';
               }
              ?>
              <br/><br/>
              <input type="submit" name="Submit" value="Create" class="btn btn-success" style="border-radius: 18px;">
          </form>
				</div>
			</div>
      </div>

          <div id="loader"></div>
          <div style="display:block;" id="myDiv" class="animate-bottom" style="display: none;text-align: center;">
          <div class="container-fluid col-md-12 table-responsive">
          <table class="table table-hover text-center" id="demo-table" >
              <thead class="thead-red">
                <tr >
                  <th>Code</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
<?php
            foreach($product as $val)
            { 
?>          
                    <tr >
                      <td><?= $val["productCode"]; ?></td>
                      <td><?= $val["productName"]; ?></td>
                      <td><?= $val["price"]; ?> THB</td>
                      <td><?= $val["qty"]; ?> pcs</td>
                      <td><?= $val["type_name"]; ?></td>
                      <td>
                      <a href="#edit-user-modal<?= $val["productCode"];?>" data-toggle="modal" class="btn btn-warning" role="button" style="border-radius: 18px;width:70px;"><span class="glyphicon glyphicon-pencil"></span></a>
                        <br/><br/>
                        <a href="delete_product.php?productCode=<?= $val["productCode"]; ?>" id="delteProduct" class="btn btn-danger" role="button" onclick="beforeDelete()" style="border-radius: 18px;width:70px;"><span class="glyphicon glyphicon-trash"></span></a>
                      </td>
                    </tr>

                    <div class="modal fade text-left" id="edit-user-modal<?= $val["productCode"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="font-family: 'Comic Sans MS', cursive, sans-serif;display: none;">
                      <div class="modal-dialog">
                      <div class="editusermodal-container" style="background-color:#98464D;">
                        <h1 style="color:white;">Edit product info</h1>
                        <form  method="post" action="edit_product.php">
                           <h5 style="color:white;">Name</h5>
                            <input name="editName" type="text" placeholder="Name" id="editName" value="<?= $val["productName"]; ?>" required autocomplete="off">
                            <h5 style="color:white;">Price</h5>
                            <input type="number" name="editPrice" value="<?= $val["price"]; ?>" id="editPrice" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" title="This should be a number with up to 2 decimal places." autocomplete="off" required>
                            <h5 style="color:white;">Quantity</h5>
                            <input type="text" name="editQuantity" value="<?= $val["qty"]; ?>" id="editQuantity" pattern="\d*" title="Quantity must be integer." autocomplete="off" required>
                            <h5 style="color:white;">Type</h5>   
                            <select name="editType" id="editType" class="selectBox col-md-12" style="height:44px;font-family: 'Comic Sans MS', cursive, sans-serif;" required>
                              <option value="<?= $val["type_id"]; ?>" hidden><?= $val["type_name"]; ?></option>
                              <?php 
                                  if(isset($productType))
                                  {
                                    foreach($productType as $type)
                                    { ?>
                                      <option value="<?= $type['type_id'] ?>"><?= $type['type_name'] ?></option>
                              <?php }
                                  }
                              ?>
                            </select>
                            <input type="hidden" name="productCode" value="<?= $val["productCode"]; ?>">
                            <br/><br/><br/><br/>
                            <input type="submit" name="Submit" value="Save" class="btn btn-success" style="border-radius: 18px;">
                        </form>
                      </div>
                    </div>
                    </div>
<?php 
            } 
?>
              </tbody>
            </table>
          </div>
          </div>
          </body>
<?php 
  }
  else
  {
    function myException($exception) {
      echo "<div class=\"container-fluid text-center\"><h2><b style=\"color:red;\">Exception:</b> " . $exception->getMessage()."</h2><div>";
    }
    
    set_exception_handler('myException');
    
    throw new Exception('Sorry!, You are not allow to access this page');
  }
?>

