<?php
class Auth{
    private $connection;


    public function __construct($db){
        $this->listeNom=$db->query("select username,password from inscription");
        
        $this->setEtat=$db->prepare("update inscription set etat=:etat where username=:username");
    }
    

    public function listeNom(){
        $this->listeNom->execute();
         $tab=array();
         $tab=$this->listeNom->fetchAll();
        return $tab ;
    }
   
    public function setEtat($etat,$username){
         $this->setEtat->execute(array(':etat'=>$etat,':username'=>$username));

    }

   
}