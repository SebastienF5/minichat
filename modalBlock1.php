<?php 


?>


<div class="modal fade" id="showpanel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">My Chat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- start -->
          <nav>
                   <ul class="navbar-nav">
                   <?php
                          $profil=new myFunctions($pdo);
                          $tab=$profil->getPhoto($_SESSION['username']);
                          
                    ?>
                   <li class="nav-item"><a href="#" class="nav-link"><img src="uploads/<?=$tab['image']?>" class="img-rounded" width="60" height="50"><?= $_SESSION['username']?></a></li>
                   <li class="nav-item"><a href="logout.php?n=<?=$_SESSION['username']?>" class="nav-link">Deconnexion</a></li>
                   <li class="nav-item"><a href="" class="nav-link" data-toggle="modal" data-target="#delete">Supprimer Compte</a></li>
                  
                </ul>
               </nav>
               <!-- Button trigger modal -->

<!-- Modal -->

<hr class="my-4">
               <nav>
                   <strong> Liste des Chats </strong>
                   <ul class="navbar-nav">
                           <?php 
                               $t=$send->getMine($_SESSION['username']);
                            foreach($t as $tt) {
                                 ?>
                   <li class="nav-item "><a href="inbox.php?n=<?=$tt['pseudo_destinataire']?>" class="nav-link"><img src="images/user1.jpg" width="40" height="30" class="rounded"><?= $tt['pseudo_destinataire']?></a></li>
                       <?php } ?>
                   </ul>
               </nav>
        <!-- end -->
      </div>
      <div class="modal-footer">
       
        
        <button type="button" class="btn btn-primary close" data-dismiss="modal" aria-label="Close">Fermer</button>
      </div>
    </div>
  </div>
</div>