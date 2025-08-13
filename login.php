<?php
session_start();
if (isset($_SESSION["email"])) {
	session_destroy();
}
include_once 'dbConnection.php';
$ref = @$_GET['q'];
$email = $_POST['email'];
$password = $_POST['password'];

$email = stripslashes($email);
$email = addslashes($email);
$password = stripslashes($password);
$password = addslashes($password);
$password = md5($password);


echo "" . $email . $password;
$result = mysqli_query($con, "SELECT firstname,lastname FROM users WHERE email = '$email' and password = '$password'") or die('Errorlogin');
$count = mysqli_num_rows($result);



if ($count == 1) {
	while ($row = mysqli_fetch_array($result)) {
		$firstname = $row['firstname'];
		$secondname = $row['lastname'];
	}
	$_SESSION["name"] = $firstname . $secondname;
	$_SESSION["email"] = $email;
	header("location:activity.php?q=1");
} else
	header("location:$ref?w=Wrong Username or Password");
