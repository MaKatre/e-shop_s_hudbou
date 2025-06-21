<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('_inc/classes/Database.php');
require_once('_inc/classes/Contact.php');
include('parts/header_contact.php');
include 'parts/navigation.php';

$db = new Database();
$contact = new Contact($db);

$allContacts = $contact->index();

if(!$allContacts || empty($allContacts)){
    echo "<p>No contacts found</p>";
    echo "<a href='admin.php'>Back to admin</a>";
    exit;
}
?>

<section class="container">
<?php if($userRole == 1): ?>
    <h1>All Contacts</h1>
    
    <?php foreach($allContacts as $contactData): ?>
        <div class="contact-item" style="border: 1px solid #ccc; margin-bottom: 20px; padding: 15px; border-radius: 5px;">
            <h3>Contact #<?php echo htmlspecialchars($contactData['idform']); ?></h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($contactData['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($contactData['email']); ?></p>
            <p><strong>Subject:</strong> <?php echo htmlspecialchars($contactData['subject']); ?></p>
            <p><strong>Message:</strong> <?php echo nl2br(htmlspecialchars($contactData['message'])); ?></p>
            
        </div>
    <?php endforeach; ?>
    <?php else: ?>
        <p>You don't have premission to view this page.</p>
    <?php endif;?>
    
    <a href="admin.php">Back to main page</a>
</section>

<?php
include('parts/footer_contact.php');
?>