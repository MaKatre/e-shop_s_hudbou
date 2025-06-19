<?php
// This should show SOMETHING even if everything else fails
echo "PHP is working!<br>";

// Check if we can see the GET parameter
if(isset($_GET['idform'])) {
    echo "GET parameter idform = " . $_GET['idform'] . "<br>";
} else {
    echo "No GET parameter 'idform' found<br>";
}

// Check if files exist
if(file_exists('_inc/classes/Database.php')) {
    echo "Database.php file exists<br>";
} else {
    echo "Database.php file NOT found<br>";
}

if(file_exists('_inc/classes/Contact.php')) {
    echo "Contact.php file exists<br>";
} else {
    echo "Contact.php file NOT found<br>";
}

// Try to include files and show any errors
echo "Attempting to include Database.php...<br>";
try {
    include '_inc/classes/Database.php';
    echo "Database.php included successfully<br>";
} catch(Throwable $e) {
    echo "Error including Database.php: " . $e->getMessage() . "<br>";
}

echo "Attempting to include Contact.php...<br>";
try {
    include '_inc/classes/Contact.php';
    echo "Contact.php included successfully<br>";
} catch(Throwable $e) {
    echo "Error including Contact.php: " . $e->getMessage() . "<br>";
}

// Try to create objects
echo "Attempting to create Database object...<br>";
try {
    $db = new Database();
    echo "Database object created successfully<br>";
} catch(Throwable $e) {
    echo "Error creating Database object: " . $e->getMessage() . "<br>";
}

echo "Test complete.<br>";
?>