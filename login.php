<?php
require 'conf.php';

session_start();

$validUser = $_SESSION["login"] === true;

// Obtain username & password from form
$username = $_POST['username'];
$password = $_POST['password'];
  if(!$validUser) $errorMsg = "Invalid username or password.";
  else $_SESSION["login"] = true;
// Compare with database
$sql = "SELECT * FROM users WHERE (user_Name='$username' 
                     AND user_Password='$password')";
$result = mysqli_query($connect, $sql);

$count = mysqli_num_rows($result);

$row = mysqli_fetch_array($result);

if($validUser) {
   header("Location: / index.php"); die();
}

else if ($count==1) {
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
	$_SESSION['userid'] = $row['user_ID'];
	header("Location: index.php");
}
else {
	$_SESSION['error']=1;
	header("Location: login_panel.php");
}
mysqli_close($connect);
?>
