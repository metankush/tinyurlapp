<?php
include_once 'db_conn.php';

//For Insert Full URL Into Database
if($_REQUEST['action']=='insert_url'){
	$url=$_REQUEST["url_value"];
    $short_url="http://localhost/tiny_urlapp/index.php?url=".substr(md5($url.mt_rand()),0,8);
    $sql="insert into short_urls values(null,'$url','$short_url')";
    if (mysqli_query($conn, $sql)) {
      echo $short_url;
      exit();
     }
     else{
      echo "Probleme in generating url";
      exit();
    }
}

?>