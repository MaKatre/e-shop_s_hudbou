<?php
// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h2>Debug Information</h2>";

// Check current directory
echo "<p><strong>Current directory:</strong> " . getcwd() . "</p>";

// List files in current directory
echo "<p><strong>Files in current directory:</strong></p>";
$files = scandir('.');
foreach($files as $file) {
    if($file != '.' && $file != '..') {
        echo "- " . $file . "<br>";
    }
}

// Check if common class file locations exist
$possible_locations = [
    '_inc/classes/Database.php',
    '_inc/classes/Contact.php',
];

echo "<p><strong>Checking for class files:</strong></p>";
foreach($possible_locations as $location) {
    if(file_exists($location)) {
        echo "✅ FOUND: " . $location . "<br>";
    } else {
        echo "❌ NOT FOUND: " . $location . "<br>";
    }
}

// Test database connection manually
echo "<p><strong>Testing database connection:</strong></p>";
try {
    $pdo = new PDO("mysql:host=localhost;dbname=Database", "root", "");
    echo "✅ Database connection successful!<br>";
    
    // Test if tables exist
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables found: " . implode(', ', $tables) . "<br>";
    
} catch(PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
}
?>