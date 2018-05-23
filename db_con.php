<?php
$server = "localhost";
$user = "admin";
$pass = "sqlkevin";
$db = "blogg";

$conn = new mysqli($server, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

else {
    echo "Connection success";
}

?>