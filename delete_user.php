<?php
include("helpers/UserData.php");
session_start();

if($_SESSION['Status'] == 'ADMIN')
{
    if(isset($_GET['UserID']))
    {
        UserData::Delete($_GET['UserID']);
        header("location:user_list.php?message=Deleted successfully!");
    }
}
