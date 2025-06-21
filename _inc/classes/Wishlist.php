<?php

class Wishlist{

    private $db;
    
    public function __construct(Database $database){
        $this->db=$database->getConnection();
    }

    public function addtoWishlist(){

    }

    public function removefromwishlist(){}
}
    

?>