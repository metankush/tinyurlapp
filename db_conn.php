<?php

$host="localhost";
$username="root";
$password="";
$databasename="test";

$conn=mysqli_connect($host,$username,$password,$databasename);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>