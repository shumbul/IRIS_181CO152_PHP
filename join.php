<?php
sleep(1);
require('./conf.php');

$username = $_POST['user'];

$password = $_POST['password'];

$email = $_POST['email'];

$tel = $_POST['tel'];

$time = time();

$sql = "INSERT INTO users (user_Name, user_Password, user_Email, user_Phone, user_Date) VALUES ('$username', '$password', '$email', '$tel', '$time')";

mysqli_query($connect, $sql);

$return['error'] = false;
$return['msg'] = "Registration Succeeded";

echo json_encode($return);

mysqli_close($connect);

?>
