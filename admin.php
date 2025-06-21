<?php
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once '_inc/classes/User.php';
    require_once '_inc/classes/Database.php';
    require_once '_inc/classes/Authenticate.php';

    $db = new Database();
    $auth = new Authenticate($db);
    $auth->requireSignIn();

    $userRole = $auth->getUserRole();

    $users = [];


    if($userRole == 1){
        $user = new User($db);
        $users = $user->index();
    }

    if(isset($_GET['delete_user'])){
        $user = new User($db);
        $user->destroy($_GET['delete_user']);
        header("Location: admin.php");
        exit;
    }

    include 'parts/header.php';
    include 'parts/navigation.php';
?>

<body>
    <h1>Welcome back, Admin</h1>
    <?php if($userRole == 1): ?>
    <h3>Users</h3>
    <a href="user_create.php" class="button">Create User</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Delete</th>
            <th>Edit</th>
            <th>Show</th>
        </tr>
        <?php foreach($users as $u):?>
            <tr>
                <td><?=htmlspecialchars($u['iduser']) ?></td>
                <td><?= htmlspecialchars($u['name']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= htmlspecialchars($u['role']) ?></td>
                <td><a href="?delete_user=<?= $u['iduser'] ?>" onclick="return confirm('Are you sure you want to delete this user')">Delete</a></td>
                <td><a href="user_edit.php?id=<?= $u['iduser'] ?>">Edit</a></td>
                <td><a href="user_show.php?id=<?= $u['iduser'] ?>">Show</a></td>
            </tr>
            <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>You don't have premission to view this page.</p>
    <?php endif;?>

    
    <a href="http://localhost/Projekt/contact_show.php?idform=1">Contact list</a>
    <br>
    <a href="sign_out.php">Sign Out</a>
</body>

<?php
    include 'parts/footer.php';
?>