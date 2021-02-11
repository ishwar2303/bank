<?php 

$server_name = '127.0.0.1';
$user_name = 'root';
$password = '';
$db_name = 'bank';

// $server_name = 'database-1.c3mppahrvey4.ap-south-1.rds.amazonaws.com';
// $user_name = 'ishwar';
// $password = 'qwerty1234';
// $db_name = 'bank';

$conn = new mysqli($server_name, $user_name, $password, $db_name);

if($conn->connect_error)
    die(header('Location: pages/samples/error-500.html'));
<<<<<<< HEAD
?>
=======
?>
>>>>>>> ef88602d97f118a7eb49ab1991454bdc474f5ea2
