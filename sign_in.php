<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('_inc/classes/Database.php');
require_once('_inc/classes/Authenticate.php');

$db = new Database();
$auth = new Authenticate($db);

$error = '';
$success = '';

// Check if user is already signed in
if ($auth->isSignedIn()) {
    header("Location: index.php"); // Redirect to dashboard or home page
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Basic validation
    if (empty($email) || empty($password)) {
        $error = "All fields are required";
    } else {
        // Try to sign in the user
        if ($auth->sign_in($email, $password)) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    }
}

include "parts/header.php";
include 'parts/navigation.php';
?>

<h1>Sign In</h1>

<?php if(!empty($error)): ?>
<div style="color: red; margin-bottom: 10px;">
    <?php echo htmlspecialchars($error); ?>
</div>
<?php endif; ?>

<?php if(!empty($success)): ?>
<div style="color: green; margin-bottom: 10px;">
    <?php echo htmlspecialchars($success); ?>
</div>
<?php endif; ?>

<p>Don't have an account? <a href="sign_up.php">Click here to sign up</a></p>

<form method="POST">
    <label>Email</label>
    <br>
    <input type="email" name="email" required>
    <br><br>
    
    <label>Password</label>
    <br>
    <input type="password" name="password" required>
    <br><br>
    
    <input type="submit" value="Sign In">
</form>

<?php
include "parts/footer.php";
?>