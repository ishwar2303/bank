<?php 

$server_name = '127.0.0.1';
$user_name = 'root';
$password = '';
$db_name = 'bank';

$conn = new mysqli($server_name, $user_name, $password, $db_name);

if($conn->connect_error)
    die(header('Location: pages/samples/error-500.html'));
?>
