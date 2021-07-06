<?php
class Cinscription{
    private $insertAll;
    private $listeNom;
   
    public function __construct($db){
        $this->insertAll=$db->prepare("insert into inscription(username,email,password,image) values(:username,:email,:password,:image)");
        $this->listeNom=$db->prepare("select username from inscription where username=:username");
       
    }

    public function insertAll($username,$email,$password,$image)
    {
        $this->insertAll->execute(array(':username'=>$username,':email'=>$email,':password'=>$password,':image'=>$image));
        return $this->insertAll->rowCount();
    }

    public function listeNom($username)
    {
        $tab=array();
        $this->listeNom->execute(array(':username'=>$username));
        $tab=$this->listeNom->fetchAll();
        return $tab;
    }
}