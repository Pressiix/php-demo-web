<?php

$mysql = mysqli_connect("localhost", "root", "", "php-demo") or die("Connection failed: " . mysqli_connect_error());
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} 

$sqlsvr_connectionInfo = array("Database"=>"dev", "UID"=>"dev", "PWD"=>"385568379", "MultipleActiveResultSets"=>true);
$mssql = sqlsrv_connect( "DESKTOP-G4G1E7Q\SQLEXPRESS01", $sqlsvr_connectionInfo);
?> 