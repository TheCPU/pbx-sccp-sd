<?php

// $url = 'http://10.8.25.107/dir';
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_passwd = null;
$mysql_port = 3306;

$mysql_db = 'pbx_dir';

// $url = 'http://localhost/dir/';
$url = 'http://10.8.25.107/dir/';
// $url = 'https://directory.morgensternmarketing.com/';

$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd ?? null, $mysql_db);

$mysql_conn =& $conn;

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
