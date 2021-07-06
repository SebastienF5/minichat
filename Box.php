 <?php 
 class Box{
     private $insertPrive;
     private $getAll;

     public function __construct($db)
    {
        $this->insertPrive=$db->prepare("INSERT INTO privatemsg (pseudo_auteur,message,pseudo_destinataire) VALUES (:pseudo_auteur,:message,:pseudo_destinataire)");
        $this->getAll=$db->prepare("select * from privatemsg where pseudo_auteur=:pseudo_auteur and pseudo_destinataire=:pseudo_destinataire or pseudo_auteur=:pseudo_a and pseudo_destinataire =:pseudo_d");
        $this->getMine=$db->prepare("select distinct pseudo_destinataire from privatemsg where pseudo_auteur=:pseudo_auteur");
        $this->getUsername=$db->prepare("select username from inscription where username=:username");
        $this->getEtat=$db->prepare("select etat from inscription where username=:pseudo");

    }

    public function insertPrive($pseudo_auteur,$message,$pseudo_destinataire)
    {
       
         $this->insertPrive->execute(array(':pseudo_auteur'=>$pseudo_auteur,':message'=>$message,':pseudo_destinataire'=>$pseudo_destinataire));
          $this->insertPrive->fetchAll();

          return $this->insertPrive->rowCount();
    }

    public function getEtat($pseudo){
        $val="";
        $this->getEtat->execute(array(':pseudo'=>$pseudo));
         $val=$this->getEtat->fetchAll();
        //  if($val==="online"){return 1;}
        //  return -1;
        return $val;
    }

    public function getUsername($username){
        $val=array();
        $this->getUsername->execute(array(':username'=>$username));
         $val=$this->getUsername->fetchAll();
     
        return $val;
    }
 
    public function getAll($pseudo_auteur,$pseudo_destinataire,$pseudo_a,$pseudo_d){
        $tab=array();
        $this->getAll->execute(array(':pseudo_auteur'=>$pseudo_auteur,':pseudo_destinataire'=>$pseudo_destinataire,':pseudo_a'=>$pseudo_a,':pseudo_d'=>$pseudo_d));
        $tab= $this->getAll->fetchAll();

         return $tab;

    }

    public function getMine($pseudo_auteur){
        $tab=array();
        $this->getMine->execute(array(':pseudo_auteur'=>$pseudo_auteur));
         $tab=$this->getMine->fetchAll();

         return $tab;

    }
 }