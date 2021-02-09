<?php 

$server_name = '127.0.0.1';
$user_name = 'root';
$password = '';
$db_name = 'bank';


$conn = new mysqli($server_name, $user_name, $password, $db_name);

if($conn->connect_error)
<<<<<<< HEAD
    die(header('Location: pages/samples/error-500.html'));
?>
=======
    die(header('Location: 505-error.php'));
?>
>>>>>>> 298f8df5082f1993ca81dca155b25bfd8f46c72e
