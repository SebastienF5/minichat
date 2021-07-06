<?php
 
 class PostMessage{
     private $insertAll;
     private $showAll;

     public function __construct($pdo){
         $this->insertAll=$pdo->prepare("INSERT into postmsg (pseudo,message) VALUES(:pseudo,:message)");
         $this->showAll=$pdo->query("SELECT pseudo,message from postmsg ORDER BY id DESC LIMIT 0,10");
     }

     public function insertAll($pseudo,$message){
          $this->insertAll->execute(array(':pseudo'=>$pseudo,':message'=>$message));

          return $this->insertAll->rowCount();
     }

     public function showAll(){
        $this->showAll->execute();
        $tab=array();
        $tab=$this->showAll->fetchAll();
       return $tab;  
     }

 }