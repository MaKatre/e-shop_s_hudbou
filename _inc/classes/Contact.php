<?php
class Contact{
    private $db;

    public function __construct(Database $database){
        $this->db=$database->getConnection();
    }

    public function index(){
        $stmt = $this->db->prepare("SELECT * FROM form");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $email, $subject, $message){
        $stmt=$this->db->prepare("INSERT INTO form (name, email, subject, message) VALUES (:name, :email, :subject, :message)");
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->bindParam(':subject',$subject,PDO::PARAM_STR);
        $stmt->bindParam(':message',$message,PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function show($id){
        $stmt=$this->db->prepare("SELECT * FROM form WHERE idform = :idform");
        $stmt->bindParam(':idform',$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
?>