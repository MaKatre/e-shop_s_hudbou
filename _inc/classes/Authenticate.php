<?php

class Authenticate{
    private $db;

    public function __construct(Database $database){
        $this->db=$database->getConnection();
    }

    public function sign_in($email,$password){
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();

        if($user){
            if(password_verify($password, $user['password'])){
                $_SESSION['iduser'] = $user['iduser'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function sign_out(){
        $_SESSION = array();

        if(ini_get("session.use.of_cookies")){
            $paramy = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $paramy["path"],
                $paramy["domain"],
                $paramy["secure"],
                $paramy["httponly"]
            );
        }
        session_destroy();
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