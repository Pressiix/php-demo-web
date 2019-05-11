<?php
$mysql = mysqli_connect("localhost", "root", "385568379", "php-demo") or die("Connection failed: " . mysqli_connect_error());
mysqli_query($mysql,"SET character_set_results=utf8");
mysqli_query($mysql,"SET character_set_client=utf8");
mysqli_query($mysql,"SET character_set_connection=utf8");
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} 
?> 