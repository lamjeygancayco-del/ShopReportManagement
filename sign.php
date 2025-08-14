<?php
include_once 'dbConnection.php';
ob_start();
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$firstname = ucwords(strtolower($firstname));
$lastname = ucwords(strtolower($lastname));
// $gender = $_POST['gender'];
$email = $_POST['email'];
$shop_id = $_POST['shop_id'];
// $college = $_POST['college'];
// $mob = $_POST['mob'];
$password = $_POST['password'];
$firstname = stripslashes($firstname);
$firstname = addslashes($firstname);
$firstname = ucwords(strtolower($firstname));
$lastname = stripslashes($lastname);
$lastname = addslashes($lastname);
$lastname = ucwords(strtolower($lastname));

$email = stripslashes($email);
$email = addslashes($email);
$password = stripslashes($password);
$password = addslashes($password);
$password = md5($password);

$q3 = mysqli_query($con, "INSERT INTO users(firstname,lastname,email,password,is_admin,shop_id) VALUES  ('$firstname','$lastname' ,'$email' , '$password',0,'$shop_id')");
if ($q3) {
  session_start();
  $_SESSION["email"] = $email;
  $_SESSION["name"] = $firstname . $lastname;

  header("location:activity.php?q=1");
} else {
  header("location:index.php?q7=Email Already Registered!!!");
}
ob_end_flush();
