<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('_inc/classes/User.php');
require_once('_inc/classes/Database.php');
require_once('_inc/classes/Authenticate.php');

$db = new Database();
$auth = new Authenticate($db); // Fixed: was "$user = new Authenticate($db);"
$auth->requireSignIn();

// Check if user is admin
if($auth->getUserRole() != 1) {
    header("Location: admin.php");
    exit;
}

$user = new User($db);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    
    if($user->create($name, $email, $password, $role)){ // Fixed parameter order
        header("Location: admin.php");
        exit;
    } else {
        echo "<p>Error creating a user</p>"; // Added missing semicolon
    }
}

include('parts/header.php');
include('parts/navigation.php');
?>

<section class="container">
    <h1>Create a user</h1>
    <form id="user" action="" method="POST">
        <input type="text" placeholder="User name" id="name" name="name" required>
        <br><br>
        <input type="email" placeholder="Email of the user" id="email" name="email" required>
        <br><br>
        <input type="password" placeholder="Password of the user" id="password" name="password" required>
        <br><br>
        <select id="role" name="role" required> <!-- Fixed: was "section" instead of "select" -->
            <option value="">Select Role</option>
            <option value="0">User</option>
            <option value="1">Admin</option>
        </select>
        <br><br>
        <input type="submit" value="Create">
    </form>
</section>

<?php
include('parts/footer.php');
?>