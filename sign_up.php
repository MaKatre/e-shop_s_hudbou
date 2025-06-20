<?php
    include "parts/header.php";
    include 'parts/navigation.php';

    require_once '_inc/classes/Database.php';
    require_once '_inc/classes/User.php';

    $db = new Database();
    $auth = new Authenticate($db);

    $error = '';
    $seccess = '';

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? '';

        if(empty($name) || empty($email) || empty($password)){
            $error = "All fields required";
        }else{
            if($user->create($name, $email, $password, $role)){
                $success = "Account created successfully";
            }else{
                $error = "Registration failed"
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

<form method="POST">
    <label>User Name</label>
    <br>
    <input type="text" name="name" required>
    <br>
    <label>Email</label>
    <br>
    <input type="email" name="email" required>
    <br>
    <label>Password</label>
    <br>
    <input type="password" name="password" required>
    <br>
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