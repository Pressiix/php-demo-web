<?php ob_start();
  session_start();
  include_once("config/connect.php");
  include_once("login_validation.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login-modal.css">
    <link rel="stylesheet" href="css/social-bar.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <style>
      .navbar-toggle{
        background-color:#98464D;
        height:40px;
        width:45px;
      }
      .icon-bar {
        background-color:#ffff !important;
      }
      input
        {
          color:black;
          border-radius: 18px;
          font-family: 'Comic Sans MS', cursive, sans-serif;
        }

      .selectBox
      {
        border-radius:18px;
      }
    </style>
</head>
<body style="background: #efe0e0 !important;" >
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="font-family: 'Comic Sans MS', cursive, sans-serif;display: none;">
    	  <div class="modal-dialog">
				<div class="loginmodal-container" style="background-color:#98464D;">
					<h1 style="color:white;">Login to Your Account</h1><br>
				  <form name="form1" method="post" action="nav.php">
              <input name="txtUsername" type="text" placeholder="Username" id="txtUsername" style="color:black;border-radius: 18px;" autocomplete="off" required>  
              <input name="txtPassword" type="password" placeholder="Password" id="txtPassword" style="color:black;border-radius: 18px;" 
                      pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Password must contain number and letter, and at least 8 or more characters" required>
              <input type="submit" name="Submit" value="Login" class="btn btn-success" style="border-radius: 18px;">
          </form>
          <?php 
            if(isset($_POST["txtUsername"]) && isset($_POST["txtPassword"]))
            {
              LoginValidation::Validate($mysql ,$_POST["txtUsername"],$_POST["txtPassword"]);
            }
          ?>
				</div>
			</div>
      </div>
      <div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="font-family: 'Comic Sans MS', cursive, sans-serif;display: none;">
    	  <div class="modal-dialog">
				<div class="loginmodal-container" style="background-color:#98464D;">
					<h1 style="color:white;">Sign Up</h1><br>
				  <form  method="post" action="create_user.php">
              <input name="signupFirstname" type="text" placeholder="First name" id="signupFirstname" autocomplete="off" required>
              <input name="signupLastname" type="text" placeholder="Last name" id="signupLastname" autocomplete="off" required>
              <input name="signupUsername" type="text" placeholder="Username" id="signupUsername" autocomplete="off" required>  
              <input name="signupPassword" type="password" placeholder="Password" id="signupPassword" autocomplete="off" 
                    pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Password must contain number and letter, and at least 8 or more characters" required>
                    
              <input name="signupStatus" type="hidden" id="signupStatus" value="USER" required>
              <input type="hidden" id="signup_user" name="signup_user" value="request">
              <br/><br/>
              <input type="submit" name="Submit" value="Sign Up" class="btn btn-success" style="border-radius: 18px;">
          </form>
				</div>
			</div>
      </div>

    <nav class="navbar navbar-red navbar-static-top">
        <div class="container-fluid">
          <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" >
              <span class="fa fa-align-justify" style="color:white;font-size: 22px;"></span>                      
            </button>
            <a class="navbar-brand" href="index.php">Demo</a>  
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
            <li><a href="about.php"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
                <?php 
                  if(isset($_SESSION['Username']))
                  {
                    if($_SESSION['Status'] == 'ADMIN')
                    { ?>
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" style="cursor: pointer;">Master Data<span class="caret"></span></a>
                        <ul class="dropdown-menu" >
                          <li><a href="user_list.php"><span class="glyphicon glyphicon-user"></span> User Data</a></li>
                          <li><a href="product_list.php"><span class="glyphicon glyphicon-blackboard"></span> Product Data</a></li>
                        </ul>
                      </li>
                <?php
                    }
                ?>
                    <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" style="cursor: pointer;padding-top: 10px;padding-bottom: 10px;">
                        <img src="image/user.png" class="rounded-circle" id="img-profile" width="30px" height="30px"> 
                        <b> &nbsp<?= $_SESSION['Username']; ?>&nbsp</b>
                        <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="edit_profile.php">Edit Profle</a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                      </ul>
                    </li>
                <?php
                  }
                  else{
                ?>
                      <li><a href="#signup-modal" data-toggle="modal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                      <li><a href="#login-modal" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <?php
                  }
                ?>
            </ul>
          </div>
        </div>
      </nav>
  </body>
</html>
