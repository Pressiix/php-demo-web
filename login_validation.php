<?php
require_once("helpers/ActiveQuery.php");
use helpers\ActiveQuery;
class LoginValidation
{
	public static function Validate($mysql ,$Username ,$Password)
	{
		$strSQL = "SELECT * FROM member WHERE Username = '".$Username."' 
		and Password = '".$Password."'";
		$objQuery = mysqli_query($mysql,$strSQL);
		$objResult = mysqli_fetch_array($objQuery);
			if(!$objResult)
			{
				$_SESSION["error"] = "Username or Password Incorrect!";
				session_write_close();
				header("location:index.php?message=Username or Password Incorrect!");
			}
			else
			{
				$_SESSION["UserID"] = $objResult["UserID"];
				$_SESSION["Username"] = $objResult["Username"];
				$_SESSION["Status"] = $objResult["Status"];
	
				session_write_close();
				header("location:index.php");
			}
			mysqli_close($mysql);
	}
}
	
?>