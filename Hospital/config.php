<?php
session_start();
$year=$_SESSION['khyear'];
if($year=='24-25'){
define('DB_SERVER','dbm.mksoftservice.com');
define('DB_USER','killolhospital');
define('DB_PASS' ,'e6epyru9a');
define('DB_NAME', 'dbserver_killolhospital');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
}
else{
define('DB_SERVER','dbm.mksoftservice.com');
define('DB_USER','killolhospital');
define('DB_PASS' ,'e6epyru9a');
define('DB_NAME', 'dbserver_killolhospital'.$year);
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
}
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>