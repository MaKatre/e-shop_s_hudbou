<?php
    include "parts/header.php";
    include 'parts/navigation.php';

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require_once('_inc/classes/Database.php');
    require_once('_inc/classes/User.php');

    $db = new Database();
    $user = new User($db);

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $role=$_POST['role'];
        $password=$_POST['password'];
    }


?>
    <h1>Sign Up</h1>
    <p>Already have an account? Click <a href = "sign_in.php">HERE</a></p>

    <form id="user" action="" method="POST">
        <label>User Name</label>
        <br>
        <input type="text">
        <br>
        <label>Email</label>
        <br>
        <input type= "email">
        <br>
        <label>Password</label>
        <br>
        <input type="text">
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</body>

<?php
    include "parts/footer.php";
?>