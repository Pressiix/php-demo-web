<?php
ob_start();
 include_once("nav.php"); 
 include_once("config/connect.php");
 include("helpers/UserData.php");
 include("assets/VueTH-AddressAsset.php");
 $tile = "Edit Profile"; 
	
	$strSQL = "SELECT * FROM member WHERE UserID = '".$_SESSION['UserID']."' ";
	$objQuery = mysqli_query($mysql,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
?>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<title><?= $tile; ?></title>
<link href="https://fonts.googleapis.com/css?family=Itim" rel="stylesheet">
<style>
input[type="text"],input[type="password"]{
  text-align:center;
  font-family: 'Itim', cursive;
  font-weight:bold;
  width:500px;
}
</style>
<body>
  <div class="container-fluid">
    <div class="panel panel-red">
      <div class="panel-heading text-center"><h3>Edit Profile</h3></div>
      <div class="panel-body">
      <form name="form1" method="post" action="edit_profile.php">
        <div class="col-md-5"></div>
        <div class="col-md-7">
            <table class="text-center col-md-12">
              <tbody>
                <tr>
                  <tr style="background-color:#98464D;color:#fff;height:40px;"><td class="text-center" colspan="2">&nbsp;Personal Info</td></tr>
                  <td> &nbsp;Username</td>
                  <td style="height:40px;">
                    <?php echo $objResult["Username"];?>
                  </td>
                </tr>
                <tr>
                  <td> &nbsp;Password</td>
                  <td><input name="password" type="password" id="password" value="<?php echo $objResult["Password"];?>" 
                  pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Password must contain number and letter, and at least 8 or more characters" required>
                  </td>
                </tr>
                <tr>
                  <td> &nbsp;Confirm Password</td>
                  <td>
                    <input name="confirm_password" type="password" id="confirm_password" value="<?php echo $objResult["Password"];?>" pattern="(?=.*\d)(?=.*[a-z]).{8,}" 
                      title="Password must contain number and letter, and at least 8 or more characters" required>
                      <p id="error" style="color:red;"></p>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;Name</td>
                  <td><input name="txtName" type="text" id="txtName" value="<?php echo $objResult["Name"];?>" style="height:40px;"></td>
                </tr>
                <tr style="background-color:#98464D;color:#fff;height:40px;"><td class="text-center" colspan="2">&nbsp;Shipping Address</td></tr>
                <tr>
                     <td rowspan="8" width="290px">
                     <table>
                        <tr height="40px;"><td class="text-center" style="width:500px;">&nbsp;Subdistrict<br/></td></tr>
                        <tr height="80px;"><td class="text-center">&nbsp;District<br/></td></tr>
                        <tr height="40px;"><td class="text-center">&nbsp;Province<br/></td></tr>
                        <tr height="80px;"><td class="text-center">&nbsp;Zipcode<br/></td></tr>
                      </table>
                     </td>
                     <td rowspan="8" width="260px">
                      <table>
                        <tr>
                          <td>
                            <div id="app">
                                <addressinput-subdistrict name="subdistrict" placeholder="<?php echo $objResult["Addr_subdistrict"];?>" style="width:300px;" v-model="subdistrict"></addressinput-subdistrict>
                                <input type="hidden" name="hidden_subdistrict" value="<?php echo $objResult["Addr_subdistrict"];?>">
                                <addressinput-district name="district" placeholder="<?php echo $objResult["Addr_district"];?>" v-model="district"></addressinput-district>
                                <input type="hidden" name="hidden_district" value="<?php echo $objResult["Addr_district"];?>">
                                <addressinput-province name="province" placeholder="<?php echo $objResult["Addr_province"];?>" v-model="province"></addressinput-province>
                                <input type="hidden" name="hidden_province" value="<?php echo $objResult["Addr_province"];?>">
                                <addressinput-zipcode name="zipcode" placeholder="<?php echo $objResult["Addr_zipcode"];?>" v-model="zipcode"></addressinput-zipcode>
                                <input type="hidden" name="hidden_zipcode" value="<?php echo $objResult["Addr_zipcode"];?>">
                            </div>  
                          </td>
                        </tr>
                      </table>
                     </td>
                     </tr>
                </tr>
              </tbody>
            </table>
            <br>
            <input type="submit" name="submit" id="submit" class="btn btn-success" value="Save">
        </div>
      </form>
      </div>
    </div> 
  </div>
  <script>
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) 
        {
            $('#error').html('');
            document.getElementById("submit").disabled = false;
        } 
        else
        {
          $('#error').html('Not Matching').css('color', 'red');
          document.getElementById("submit").disabled = true;
        }
    });

    new Vue({
      el: '#app',
			data: {
				subdistrict: '',
				district: '',
				province: '',
				zipcode: ''
			}
		});
  </script>
</body>

<?php 


if(isset($_POST['txtName']))
{
  $_POST['subdistrict'] == "" ? $_POST['subdistrict'] = $_POST['hidden_subdistrict']  : $_POST['subdistrict'] = $_POST['subdistrict'];
  $_POST['district'] == "" ? $_POST['district'] = $_POST['hidden_district']  : $_POST['district'] = $_POST['district'];
  $_POST['province'] == "" ? $_POST['province'] = $_POST['hidden_province']  : $_POST['province'] = $_POST['province'];
  $_POST['zipcode'] == "" ? $_POST['zipcode'] = $_POST['hidden_zipcode']  : $_POST['zipcode'] = $_POST['zipcode'];
  
      $strSQL = "UPDATE member 
                SET Password = '".trim($_POST['confirm_password'])."' 
                ,Name = '".trim($_POST['txtName'])."' 
                ,Addr_province = '".$_POST['province']."'
                ,Addr_district = '".$_POST['district']."'
                ,Addr_subdistrict = '".$_POST['subdistrict']."'
                ,Addr_zipcode = '".$_POST['zipcode']."'
                WHERE UserID = '".$_SESSION['UserID']."' ";
      UserData::Update( $strSQL);
    header('Location: '.$_SERVER['REQUEST_URI']);
}
mysqli_close($mysql);
?>
