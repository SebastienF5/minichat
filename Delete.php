<?php
class Delete{
    private $connection;


    public function __construct($db){
        $this->delete=$db->prepare("delete from inscription where username=:username");
        
    
    }


    public function delete($username){
         $this->delete->execute(array(':username'=>$username));
         return $this->delete->rowCount();

    }

   
}