<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('_inc/classes/Database.php');

// Product class (you'll need to create this or add to existing Contact.php)
class Product {
    private $db;
    
    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }
    
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM product ORDER BY idproduct DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM product WHERE idproduct = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>