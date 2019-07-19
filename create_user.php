<?php 
require_once("helpers/UserData.php");

$check_existing_username = false;

    if(isset($_POST['user_name'])){
        
        foreach($_POST['user_name'] as $username)
        {
            if($_POST['createUsername'] == $username )
            {
                $check_existing_username = true;
            }
        }
        
        if($check_existing_username == false)
        {   
            UserData::Create($_POST['createUsername'] ,$_POST['createPassword'] ,$_POST['createFirstname'].' '.$_POST['createLastname'] ,$_POST['createStatus']); 
            header("location:user_list.php?message=User has been created!");
        }
        else{
            header("location:user_list.php?message=Cannot create user! Username already exist.");
        }
    }
    else if(isset($_POST['signup_user'])){
        session_start();
        $user = UserData::findAll();
        foreach($user as $result)
        {
            if($_POST['signupUsername'] == $result['Username'])
            {
                $check_existing_username = true;
            }
        }
        if($check_existing_username == false)
        {
            UserData::Create($_POST['signupUsername'] ,$_POST['signupPassword'] ,$_POST['signupFirstname'].' '.$_POST['signupLastname'] ,$_POST['signupStatus']); 
            $id = "";
            $getUserID = UserData::findAll();
            foreach($getUserID as $user)
            {
                if($_POST['signupUsername'] == $user['Username'])
                {
                    $id = $user['UserID'];
                }
            }
                $_SESSION["UserID"] = $id;
				$_SESSION["Username"] = $_POST['signupUsername'];
				$_SESSION["Status"] = $_POST['signupStatus'];
	
                session_write_close();
                header("location:index.php?message=User has been created!");
        }
        else{
            header("location:index.php?message=Cannot create user! Username already exist.");
        }
    }
    else{
        if(isset($_POST['createUsername']))
        {   
            UserData::Create($_POST['createUsername'] ,$_POST['createPassword'] ,$_POST['createFirstname'].' '.$_POST['createLastname'] ,$_POST['createStatus']); 
            header("location:user_list.php?message=User has been created!");
        }
        if(isset($_POST['signupUsername']))
        {
            UserData::Create($_POST['signupUsername'] ,$_POST['signupPassword'] ,$_POST['signupFirstname'].' '.$_POST['signupLastname'] ,$_POST['signupStatus']);
			$_SESSION["Username"] = $_POST['signupUsername'];
			$_SESSION["Status"] = $_POST['signupStatus'];
	
            session_write_close();
            header("location:index.php?message=User has been created!");
        }
    }
    ?>