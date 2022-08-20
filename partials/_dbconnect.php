<?php
$servername="localhost";
$username="root";
$password="";
$databse="loginsystem";
$conn=mysqli_connect($servername,$username,$password,$databse);
if(!$conn)
{
    die("Not connected".mysqli_connect_error());
}
?>