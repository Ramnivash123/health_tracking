<?php
require_once("db.php");

$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$o2 = $_POST['o2'];
$systolic = $_POST['systolic'];
$diastolic = $_POST['diastolic'];

$status = 1;

// Insert into user table
$sql = "INSERT INTO `user`(`name`, `age`, `status`) VALUES ('$name','$age','$status')";
$qry = mysqli_query($conn, $sql);

// Get the last inserted ID
$user_id = mysqli_insert_id($conn);

// Insert into weight table
$sql = "INSERT INTO `weight`(`user_id`, `weight`, `height`, `status`) VALUES ('$user_id','$weight','$height','$status')";
$qry = mysqli_query($conn, $sql);

// Insert into o2 table
$sql = "INSERT INTO `o2`(`user_id`, `o2`, `status`) VALUES ('$user_id','$o2','$status')";
$qry = mysqli_query($conn, $sql);

// Insert into bp table
$sql = "INSERT INTO `bp`(`user_id`, `systolic`, `diastolic`, `status`) VALUES ('$user_id','$systolic','$diastolic','$status')";
$qry = mysqli_query($conn, $sql);
?>
