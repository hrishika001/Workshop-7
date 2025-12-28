<?php
$host = 'localhost';
$user = 'NP03CY4S250021';        
$pass = 'RTnWTjiGKY';            
$db   = 'NP03CY4S250021';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
