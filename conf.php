<?php

/* 
 * $server is the name or IP Adress or your server
 * $dbuser is the name of your server database user
 * $pwd is the password of that user
 * $dbname is the database name that you are going to connect to
 */


$server = "localhost";
$dbuser = "root";
$pwd = "toor";
$dbname = "simpleauction";

/*
 * Open connection to MySQL Server
 */
$connect = mysqli_connect($server, $dbuser, $pwd, $dbname) or die('Connect Error!!! Please re-check your configuration.');

?>
