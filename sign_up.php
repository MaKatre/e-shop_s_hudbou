<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "parts/header.php";
include 'parts/navigation.php';
require_once('_inc/classes/Database.php');
require_once('_inc/classes/User.php');
require_once('_inc/classes/Authenticate.php');

$db = new Database();
$user = new User($db);
$auth = new Authenticate($db);

$error = '';
$success = '';

// Check if user is already signed in
if ($auth->isSignedIn()) {
    header("Location: index.php"); // Redirect to dashboard or home page
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 0;
    
    // Basic validation
    if (empty($name) || empty($email) || empty($password)) {
        $error = "All fields are required";
    } else {
        // Try to create the user
        if ($user->create($name, $email, $password, $role)) {
            $success = "Account created successfully! You can now sign in.";
        } else {
            $error = "Registration failed. Email might already be in use.";
        }
    }
}
?>

<h1>Sign Up</h1>

<?php if(!empty($error)): ?>
<div style="color: red; margin-bottom: 10px;">
    <?php echo htmlspecialchars($error); ?>
</div>
<?php endif; ?>

<?php if(!empty($success)): ?>
<div style="color: green; margin-bottom: 10px;">
    <?php echo htmlspecialchars($success); ?>
    <br><a href="sign_in.php">Click here to sign in</a>
</div>
<?php endif; ?>

<p>Already have an account? <a href="sign_in.php">Click here to sign in</a></p>

<form method="POST">
    <label>User Name</label>
    <br>
    <input type="text" name="name" required value="<?php echo htmlspecialchars($name ?? ''); ?>">
    <br><br>
    
    <label>Email</label>
    <br>
    <input type="email" name="email" required value="<?php echo htmlspecialchars($email ?? ''); ?>">
    <br><br>
    
    <label>Password</label>
    <br>
    <input type="password" name="password" required>
    <br><br>
    
    <label>Role</label>
    <br>
    <select name="role">
        <option value="0" <?php echo (($role ?? 0) == 0) ? 'selected' : ''; ?>>User</option>
        <option value="1" <?php echo (($role ?? 0) == 1) ? 'selected' : ''; ?>>Admin</option>
    </select>
    <br><br>
    
    <input type="submit" value="Sign Up">
</form>

<?php
include "parts/footer.php";
?>