<?php

class Authenticate{
    private $db;
    
    public function __construct(Database $database){
        $this->db = $database->getConnection();
    }
    
    public function sign_in($email, $password){
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        $user = $stmt->fetch();
        
        if($user){
            if(password_verify($password, $user['password'])){
                $_SESSION['iduser'] = $user['iduser'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function sign_out(){
        $_SESSION = array();
        
        if(ini_get("session.use_cookies")){ // Fixed parameter name
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
    }
    
    public function getUserRole(){
        if($this->isSignedIn()){
            return $_SESSION['role'];
        }
        return null;
    }
    
    public function isSignedIn(){
        return isset($_SESSION['role']);
    }
    
    public function requireSignIn(){
        if(!$this->isSignedIn()){
            header("Location: sign_in.php");
            exit;
        }
    }
}

?>