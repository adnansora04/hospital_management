<?php
define('DB_SERVER','dbm.mksoftservice.com');
define('DB_USER','killoltesting');
define('DB_PASS' ,'ydure7apy');
define('DB_NAME', 'dbserver_killoltesting');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>