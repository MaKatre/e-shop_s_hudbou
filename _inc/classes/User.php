<?php

class User{
    private $db;
    
    public function __construct(Database $database){
        $this->db = $database->getConnection();
    }
    
    public function index(){
        $stmt = $this->db->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function create($name, $email, $password, $role = 0){
        // Check if email already exists
        $stmt = $this->db->prepare("SELECT iduser FROM user WHERE email = :email"); // Fixed $this->dn typo
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        if($stmt->fetch(PDO::FETCH_ASSOC)){
            return false; // Email already exists
        }
        
        $hashPasswd = password_hash($password, PASSWORD_BCRYPT);
        
        $stmt = $this->db->prepare("INSERT INTO user(name, email, role, password) VALUES(:name, :email, :role, :password)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
        $stmt->bindParam(':password', $hashPasswd, PDO::PARAM_STR); // Use hashed password
        
        return $stmt->execute();
    }
    
    public function edit($id, $name, $email, $role){
        // Check if email already exists for another user
        $stmt = $this->db->prepare("SELECT iduser FROM user WHERE email = :email AND iduser != :iduser");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':iduser', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        if($stmt->fetch(PDO::FETCH_ASSOC)){
            return false; // Email already exists for another user
        }
        
        $stmt = $this->db->prepare("UPDATE user SET name = :name, email = :email, role = :role WHERE iduser = :iduser");
        $stmt->bindParam(':iduser', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR); // Fixed parameter name
        $stmt->bindParam(':email', $email, PDO::PARAM_STR); // Fixed parameter name
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
    public function destroy($id){
        $stmt = $this->db->prepare("DELETE FROM user WHERE iduser = :iduser");
        $stmt->bindParam(':iduser', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function show($id){
        $stmt = $this->db->prepare("SELECT * FROM user WHERE iduser = :iduser"); // Fixed to get specific user
        $stmt->bindParam(':iduser', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
}

?>