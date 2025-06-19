<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('_inc/classes/Database.php');
require_once('_inc/classes/Contact.php');
include('parts/header_contact.php');

$db = new Database();
$contact = new Contact($db);

if(isset($_GET['idform']) && !empty($_GET['idform'])){
    $id = $_GET['idform'];
    $contactData = $contact->show($id);
    
    if(!$contactData){
        echo "<p>Contact not found</p>";
        echo "<a href='admin.php'>Back to contacts</a>";
        exit;
    }
} else {
    echo "<p>No contact ID provided</p>";
    echo "<a href='admin.php'>Back to contacts</a>";
    exit;
}

?>

<section class="container">
<h1>Contact show</h1>
<p>Name: <?php echo($contactData['name']);?></p>
<p>Email: <?php echo($contactData['email']);?></p>
<p>Subject: <?php echo($contactData['subject']);?></p>
<p>Message: <?php echo($contactData['message']);?></p>
<a href="admin.php">Back to Contacts</a>
</section>

<?php
    include('parts/footer_contact.php');
?>