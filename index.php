<?php 
    require_once("nav.php") ;
    $tile = "Home";
?>
<title><?= $tile; ?></title>
<script>
$(document).ready(function(){
    $('#product-content').load('product.php');
});

function callCat(cat) {    
    $('#product-content').load("product.php?typeId="+cat);          
}

$(window).bind("load", function() {
  var qd = {};
  if (location.search) location.search.substr(1).split("&").forEach(function(item) {var s = item.split("="), k = s[0], v = s[1] && decodeURIComponent(s[1]); (qd[k] = qd[k] || []).push(v)})
  if(typeof qd.message !== 'undefined')
  {
    alert(qd.message);
    //window.history.pushState({}, document.title, "/" + "index.php");
  }
  
});
</script>
    <div class="icon-bar" id="social-bar">
        <a href="#" class="facebook"><i class="fas fa-shopping-cart"></i></i></a> 
        <a href="#" class="twitter"><i class="fa fa-star"></i></a> 
        <a href="#" class="google"><i class="fa fa-share-alt"></i></a>
    </div>
<div class="content">
    
    <div class="container-fluid " >
            <div id="myCarousel" class="carousel slide" data-ride="carousel" style="border-radius: 15px 15px 15px 15px; overflow: hidden;">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" style="max-height: 380px !important;">

                <div class="item active">
                    <img src="image/1.jpg" alt="Los Angeles" style="width:100%;height: 380px;">
                    <div class="carousel-caption">
                    <h3>Los Angeles</h3>
                    <p>LA is always so much fun!</p>
                    </div>
                </div>

                <div class="item">
                    <img src="image/2.jpg" alt="Chicago" style="width:100%; height: 380px;">
                </div>
                
                <div class="item">
                    <img src="image/b1.jpg" alt="New York" style="width:100%;height: 380px;">
                </div>

                <div class="item">
                    <img src="image/b2.jpg" alt="New York" style="width:100%;height: 380px;">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    

    <div class="container-fluid">
    <br/>
                <div class="row">   <!----------------------------------ROW1----------------------------------------->
                    <div class="col-md-2"> <!--COLUMN1-->
                        <div class="panel panel-body loginmodal-container text-center" style="background-color:#98464D;font-family: 'Comic Sans MS', cursive, sans-serif;border-radius: 7px;">
                            <?php
                                if(isset($_SESSION['Username']))
                                {
                                    echo "<h4 style=\"color:white;\"><b>Welcome ".$_SESSION['Username']."</b></h4>";
                                }
                                else{ ?>
                                <h5 style="color:white;">Login to Your Account</h5>
                                <form name="form1" method="post" action="index.php">
                                    <input name="txtUsername" type="text" placeholder="Username" id="txtUsername" style="color:black;border-radius: 18px;" required>  
                                    <input name="txtPassword" type="password" placeholder="Password" id="txtPassword" style="color:black;border-radius: 18px;" 
                                            pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                    <input type="submit" name="Submit" value="Login" class="btn btn-success" style="border-radius: 18px;">
                                </form>
                            <?php 
                                    if(isset($_POST["txtUsername"]) && isset($_POST["txtPassword"]))
                                    {
                                      $LoginValidation = new LoginValidation();
                                      $LoginValidation->Validate($_POST["txtUsername"],$_POST["txtPassword"]);
                                    }

                                    if(isset($_SESSION['error']))
                                    {
                                        echo "<p style=\"color:red;\">".$_SESSION['error']."</p>";
                                        $_SESSION['error'] = null;
                                    }
                                }
                             ?>
                        </div>
                        <br/>
                        <div class="panel panel-red">
                        <div class="panel-heading text-center"><b>Categories</b></div>
                                <div class="panel-body">
                                <table class="table text-center table-hover" style="cursor: pointer;">
                                        <tbody>
                                            <tr><td><a id="Cat1" name="Cat1" onclick="callCat('1')">Category 1</a></td></tr>
                                            <tr><td><a id="Cat2" name="Cat2" onclick="callCat('2')">Category 2</a></td></tr>
                                            <tr><td><a id="Cat3" name="Cat3" onclick="callCat('3')">Category 3</a></td></tr>
                                            <tr><td><a id="Cat4" name="Cat4" onclick="callCat('4')">Category 4</a></td></tr>
                                            <tr><td><a id="Cat5" name="Cat5" onclick="callCat('5')">Category 5</a></td></tr>
                                            <tr><td><a id="Cat6" name="Cat6" onclick="callCat('6')">Category 6</a></td></tr>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-10" >  <!--COLUMN2-->
                        <div class="panel panel-red" >
                            <div class="panel-heading text-center"><b>Products</b></div>
                            <!----------------Show Product-----------------> 
                            <div class="panel-body " >
                                <div id="product-content" class="clearfix"></div>
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
                            </div>
                            <!---------------------------------------------> 
                        </div>
                    </div> 
                </div>   <!-------------------------------------------------------------------------------> 
        </div>
</div>


