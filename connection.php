<?php
$hostname="jbdc:mysql://sql6.freesqldatabase.com:3306/sql6641386";
$username="sql6641386";
$password="eyrTh6Z6Ql";
$dbname="sql6641386";
$con=mysqli_connect($hostname,$username,$password,$dbname);
if(!$con)
{
    die("connection failed:".mysqli_connect_error($con));

}


?>
