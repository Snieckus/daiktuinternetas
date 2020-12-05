<?php
error_reporting(0);

$servername = "ec2-54-159-107-189.compute-1.amazonaws.com";
$username = "nuzouoqbuoyezr";
$password = "56b7b1e1f386902bf25b70c6958a403096ac852b6891e219cd9f33cbefd06642";
$database = "d7euf6omjr5t52";
$port = "5432";

$GLOBALS['conn'] = pg_connect("host=$servername port=$port dbname=$database user=$username password=$password");
// if($GLOBALS['conn']) {
//     echo 'connected';
//  } else {
//      echo 'there has been an error connecting';
//  } 
?>