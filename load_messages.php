<?php 
  session_start();
          require "Connexion.php";
          require "PostMessage.php";
          require "myFunctions.php";
          require "Box.php";
         $_GET['n']=$_SESSION['dest'];
          $send=new Box($pdo);
                       $_GET['n']='ie';
                    $t=$send->getAll($_SESSION['username'],htmlspecialchars($_GET['n']),htmlspecialchars($_GET['n']),$_SESSION['username']);
                              
                       foreach($t as $tt){
                             
                                if($tt['pseudo_destinataire']==$_SESSION['username'])
                                {
                             ?>
                 
                <div class="d-flex justify-content-start mb-4">
                    <div class="auteur">

                    <?php echo $tt['message']; ?>
                    </div>
                 </div>
            
                 <?php } elseif($tt['pseudo_destinataire']==$_GET['n']){?>
                 <div class="d-flex justify-content-end mb-4">
                    <div class="destinataire">
                    <?php echo $tt['message'];?>
                    </div>
                </div>
                              <?php } } ?> 