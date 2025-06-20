<?php
session_start(); // Add session_start at the beginning

include "parts/header.php";
include 'parts/navigation.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Fixed file paths - both files are in the classes folder
require_once('_inc/classes/Database.php');
require_once('_inc/classes/User.php');
require_once('_inc/class/Authenticate.php');

$error = '';
$success = '';

try {
    $db = new Database();
    $user = new User($db);
} catch (Exception $e) {
    die("Error initializing classes: " . $e->getMessage());
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 0; // Default role
    
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

<p>Already have an account? Click <a href="sign_in.php">HERE</a></p>

<form id="user" action="" method="POST">
    <label>User Name</label>
    <br>
    <input type="text" name="name" required> <!-- Added name attribute -->
    <br>
    <label>Email</label>
    <br>
    <input type="email" name="email" required> <!-- Added name attribute -->
    <br>
    <label>Password</label>
    <br>
    <input type="password" name="password" required> <!-- Changed to password type and added name attribute -->
    <br>
    
    <!-- Optional: Add role selection -->
    <label>Role</label>
    <br>
    <select name="role">
        <option value="0">User</option>
        <option value="1">Admin</option>
    </select>
    <br><br>
    
    <input type="submit" value="Submit">
</form>

<?php
include "parts/footer.php";
?>