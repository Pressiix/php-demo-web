<?php
ob_start();
 include_once("main.php"); 
 include_once("config/connect.php");
 include("helpers/UserData.php");
 $tile = "Edit Profile"; 
 if(isset($_SESSION['edit_message']))
 {
   echo $_SESSION['edit_message'];
   $_SESSION['edit_message'] = null;
 }

	if(!isset($_SESSION['UserID']))
	{
		echo "Please Login!";
		exit();
	}
	
	$strSQL = "SELECT * FROM member WHERE UserID = '".$_SESSION['UserID']."' ";
	$objQuery = mysqli_query($mysql,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
?>
<title><?= $tile; ?></title>
<body>
  <div class="container-fluid">
    <div class="panel panel-red">
      <div class="panel-heading text-center"><h3>Edit Profile!</h3></div>
      <div class="panel-body">
      <form name="form1" method="post" action="edit_profile.php">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td> &nbsp;Username</td>
                  <td>
                    <?php echo $objResult["Username"];?>
                  </td>
                </tr>
                <tr>
                  <td> &nbsp;Password</td>
                  <td><input name="txtPassword" type="password" id="txtPassword" value="<?php echo $objResult["Password"];?>" 
                  pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Password must contain number and letter, and at least 8 or more characters" required>
                  </td>
                </tr>
                <tr>
                  <td> &nbsp;Confirm Password</td>
                  <td>
                    <input name="txtConPassword" type="password" id="txtConPassword" value="<?php echo $objResult["Password"];?>" pattern="(?=.*\d)(?=.*[a-z]).{8,}" 
                      title="Password must contain number and letter, and at least 8 or more characters" required>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;Name</td>
                  <td><input name="txtName" type="text" id="txtName" value="<?php echo $objResult["Name"];?>"></td>
                </tr>
              </tbody>
            </table>
            <br>
            <input type="submit" name="Submit" class="btn btn-success" value="Save">
        </div>
        <div class="col-md-2"></div>
      </form>
      </div>
    </div> 
  </div>
</body>

<?php 
if(isset($_POST['txtName'])){
    if($_SESSION['UserID'] == "")
    {
      echo "Please Login!";
      exit();
    }
    
    if($_POST['txtPassword'] != $_POST['txtConPassword'])
    {
      $_SESSION["edit_message"] =  "Password not Match!";
      header('Location: '.$_SERVER['REQUEST_URI']);
    }
    else
    {
      $strSQL = "UPDATE member SET Password = '".trim($_POST['txtPassword'])."' 
                ,Name = '".trim($_POST['txtName'])."' WHERE UserID = '".$_SESSION['UserID']."' ";
      UserData::Update( $strSQL);
      $_SESSION["edit_message"] = "Save Completed!";
    }
    header('Location: '.$_SERVER['REQUEST_URI']);
}
mysqli_close($mysql);
?>
