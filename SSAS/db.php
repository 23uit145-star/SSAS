<?php
$conn = mysqli_connect("localhost","root","","SmartSkill");

if(!$conn){
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
