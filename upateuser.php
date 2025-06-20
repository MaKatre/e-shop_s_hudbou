<?php
require_once('_inc/class/Database.php'); // Adjust path as needed

$db = new Database();
$conn = $db->getConnection();

// Update admin password
$hashedAdmin = password_hash('123admin', PASSWORD_BCRYPT);
$stmt = $conn->prepare("UPDATE user SET password = :password WHERE email = :email");
$stmt->bindParam(':password', $hashedAdmin);
$stmt->bindParam(':email', $email);
$email = 'admin@gmail.com';
$stmt->execute();

// Update martina password
$hashedMartina = password_hash('martina123', PASSWORD_BCRYPT);
$stmt->bindParam(':password', $hashedMartina);
$email = 'martina@gmail.com';
$stmt->execute();

echo "Passwords updated successfully!";
?>