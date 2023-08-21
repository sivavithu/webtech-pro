<?php
$hostname="localhost";
$username="root";
$password="";
$dbname="webtech";
$con=mysqli_connect($hostname,$username,$password,$dbname);
if(!$con)
{
    die("connection failed:".mysqli_connect_error($con));

}


?>