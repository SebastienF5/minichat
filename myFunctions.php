<?php
class myFunctions{
    private $online;
    private $getPhoto;

    public function __construct($db){
        $this->online=$db->prepare("select username,image from inscription where etat='online' and username!=:username");
        $this->getPhoto=$db->prepare("select image from inscription where  username=:username");
       
    }


    public function online($username){
        $this->online->execute(array(':username'=>$username));
         $tab=array();
         $tab=$this->online->fetchAll();
        return $tab ;
    }

    public function getPhoto($username)
    {
        $this->getPhoto->execute(array(':username'=>$username));
        return $this->getPhoto->fetch();
    }
   
}