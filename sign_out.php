<?php
session_start();
require_once('_inc/classes/Database.php');
require_once('_inc/classes/Authenticate.php');

$db = new Database();
$auth = new Authenticate($db);

// Sign out the user
$auth->sign_out();

// Redirect to sign in page
header("Location: sign_in.php?msg=signed_out");
exit;
?>