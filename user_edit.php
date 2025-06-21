<?php
session_start();
require_once('_inc/classes/User.php');
require_once('_inc/classes/Database.php');
require_once('_inc/classes/Authenticate.php');

$db = new Database();
$auth = new Authenticate($db);
$auth->requireSignIn();

// Check if user is admin
if($auth->getUserRole() != 1) {
    header("Location: admin.php");
    exit;
}

$user = new User($db);
$userData = null;

if(isset($_GET['id'])){ // Changed from 'iduser' to 'id' to match your admin.php links
    $id = $_GET['id'];
    $userData = $user->show($id);
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        
        if($user->edit($id, $name, $email, $role)){
            header("Location: admin.php");
            exit;
        } else {
            echo "<p>Error editing the User</p>";
        }
    }
} else {
    header("Location: admin.php");
    exit;
}

include('parts/header.php');
include('parts/navigation.php');
?>

<section class="container">
    <h1>Update User</h1>
    <?php if($userData): ?>
    <form id="user" action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($userData['name']) ?>" required>
        <br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($userData['email']) ?>" required>
        <br><br>
        
        <select id="role" name="role" required>
            <option value="0" <?= $userData['role'] == 0 ? 'selected' : '' ?>>User</option>
            <option value="1" <?= $userData['role'] == 1 ? 'selected' : '' ?>>Admin</option>
        </select>
        <br><br>
        
        <input type="submit" value="Save changes">
        <br>
        <a href="admin.php">Cancel</a>
    </form>
    <?php else: ?>
        <p>User not found</p>
        <a href="admin.php">Back to admin</a>
    <?php endif; ?>
</section>

<?php
include('parts/footer.php');
?>