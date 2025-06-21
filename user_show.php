<?php
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

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

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $userData = $user->show($id);
    } else {
        header("Location: admin.php");
        exit;
    }

    include('parts/header.php');
    include('parts/navigation.php');
?>

<section>
    <h1>Details of the User</h1>
    <?php if($userData):?>
        <p>User Name: <?=htmlspecialchars($userData['name'])?></p>
        <p>Email: <?=htmlspecialchars($userData['email'])?></p>
        <p>User's Role: <?= $userData['role']== 0 ? 'User':'Admin'?></p>
        <a href="admin.php">Back to admin</a>
    <?php else: ?>
        <p>USer Not Found</p>
        <a href="admin.php">Back to admin</a>
        <?php endif;?>
</section>

<?php
    include('parts/footer.php');
?>