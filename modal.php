<?php

 require "connexion.php";
 require "delete.php";


   if(isset($_POST['supp'])){
   
    $d=new Delete($pdo);
 $del=$d->delete($_SESSION['username']);

       if($del==1){
         
           $_SESSION['username']=null;
           session_destroy();
           header('Location:index.php');
           
       }
   }
?>
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Supprimer Mon Compte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Souhaitez-vous vraiment supprimer ce compte?
       <form method="post" action="">
             <input type="submit" name="supp" value="Supprimer" class="btn btn-danger">
             <button type="button" class="btn btn-primary close" data-dismiss="modal" aria-label="Close"> Annuler </button>
          </form>
        
      </div>

    </div>
  </div>
</div>