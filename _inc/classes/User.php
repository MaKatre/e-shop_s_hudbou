<?php
    
    class User{
        private $db;

        public function __construct(){
            $this->db=$database->getConnection();
        }

        public function index(){
            $stmt = $this->db->prepare("SELECT * FROM user");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function create($name,$email,$password){
            $stmt=$this->dn->prepare("SELECT iduser FROM user WHERE email=:email");
            $stmt=bindParam(':email',$email,PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->fetch(PDO::FETCH_ASSOC)){
                return false;
            }
            $hashPasswd = password_hash($password, PASSWORD_BCRYPT);

            $stmt=$this->db->prepare("INSERT INTO user(name, email, role, password)
            VALUES(:name, :email, :role, :password)");

            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->bindParam(':email',$email,PDO::PARAM_STR);
            $stmt->bindParam(':role',$role,PDO::PARAM_STR);
            $stmt->bindParam(':password',$password,PDO::PARAM_STR);

            return $stmt->execute();
        }

        public function edit($id,$name,$email,$role){
            $stmt=$this->db->prepare("SELECT iduser FROM user WHERE email=:email AND iduser!=:iduser");
            $stmt->bindParam(':email',$email,PDO::PARAM_STR);
            $stmt->bindParam(':iduser',$id,PDO::PARAM_INT);
            $stmt->execute();

            if($stmt->fetch(PDO::FETCH_ASSOC)){
                return false;
            }

            $stmt=$this->db->prepare("UPDATE user SET name=:name, email=:email, role=:role
            WHERE iduser=:iduser");
            $stmt->bindParam(':iduser',$id,PDO::PARAM_INT);
            $stmt->bindParam(':idname',$name,PDO::PARAM_STR);
            $stmt->bindParam(':idemail',$email,PDO::PARAM_STR);
            $stmt->bindParam(':role',$role,PDO::PARAM_INT);

            return false;
        }

        public function destroy($id){
            $stmt=$this->db->prepare("DELETE FROM user WHERE iduser=:iduser");
            $stmt->bindParam(':iduser',$id,PDO::PARAM_INT);
            return $stmt->execute();
        }

        public function show($id){
            $stmt=$this->db->prepare("SELECT * FROM user");
            $stmt->execute();
            return  $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>