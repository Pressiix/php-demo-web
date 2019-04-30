<?php 
include_once("helpers/UserData.php");

if(isset($_POST['UserID']))
{
    //echo $_POST['UserID'];
    $sql = "UPDATE member 
            SET member.Username = '".$_POST['editUsername']."', member.Password = '".$_POST['editPassword']."', member.Name = '".$_POST['editName']."' ,member.Status = '".$_POST['editStatus']."' 
            WHERE member.UserID = '".$_POST['UserID']."'";
            
    UserData::Update($sql);
    header("location:user_list.php?message=updated successfully");
}