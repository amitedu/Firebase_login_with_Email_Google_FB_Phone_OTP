<?php
session_start();

$conn = mysqli_connect('fdb21.awardspace.net','3846272_sociallogin','VcgV7YFgDRNGURN','3846272_sociallogin');

$name = mysqli_real_escape_string($conn, $_POST['name']);
$email= mysqli_real_escape_string($conn, $_POST['email']);
$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
$image= mysqli_real_escape_string($conn, $_POST['image']);

$_SESSION['USER_ID'] = $user_id;

$res = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$user_id'");
$check = mysqli_num_rows($res);

$row = mysqli_fetch_assoc($res);
$_SESSION['NAME']=$row['name'];

if ($check <= 0) {
    mysqli_query($conn, "INSERT INTO users (name, email, image, user_id) VALUES ('$name', '$email', '$image', '$user_id')");
    $_SESSION['NAME'] = $row['NAME'];
}

