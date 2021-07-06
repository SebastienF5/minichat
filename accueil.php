 <?php 
 session_start();


        if($_SESSION['username']==null)
        {
            header('Location:index.php');
        }

        require "Connexion.php";
        require "PostMessage.php";
        require "myFunctions.php";
        

   $msg_error="";
   $msg_post="";

   $success=true;
   $list=array();

   $postmsg=new PostMessage($pdo);
  // $list=$postmsg->showAll();
  $msg_post="sans facon";
  $succes=false;
   if(isset($_POST['envoyerPublic'])){
       $msg_post=htmlspecialchars($_POST['message']);

       if(empty($msg_post)){
           $msg_error="Le champs est vide !";
           $success=false;
       }
      
       if($success){
       
           $tab=$postmsg->insertAll($_SESSION['username'],$msg_post);
           header("Location:accueil.php");
    

           if($tab != 1){
               $msg_error="Erreur!";

           }
       }
     
   }
 
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/mystyle.css" type="text/css">
     <link rel="stylesheet" href="css/style.css" type="text/css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <title>Accueil | MyChat</title>
 </head>
 <body>
     <div class="container-fluid" id="page__accueil">
     <div class="row">
       <div class="bgColor position-fixed">
           
           <nav class="col navbar navbar-expand-lg navbar-dark">
            
               
             <a href="accueil.php" class="navbar-brand">
             <img src="images/logo.png" width="60" height="50" class="rounded">
             MyChat
             </a>
           
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div id="navbarNav" class="collapse navbar-collapse">
                  <ul class="navbar-nav">
                  <li class="nav-item active"><a href="#" class="nav-link">Accueil</a></li>
                  <li class="nav-item"><a href="inscription.php" class="nav-link">Creer Compte</a></li>
                  <li class="nav-item"><a href="inbox.php?n=<?='null'?>" class="nav-link"><i class="far fa-comment"></i><span class="badge bg-danger">4</span></a></li>
                  </ul>
             </div>
           </nav>


</div>
     
     
           <div class="col-2 pageaccueil__block1">
           <nav>
                   <ul class="navbar-nav">
                    <?php
                          $profil=new myFunctions($pdo);
                          $tab=$profil->getPhoto($_SESSION['username']);
                          
                    ?>
                   <li class="nav-item"><a href="#" class="nav-link"><img src="uploads/<?=$tab['image']?>" class="img-rounded" width="60" height="50"><?= $_SESSION['username']?></a></li>
                   <li class="nav-item"><a href="logout.php?n=<?=$_SESSION['username']?>" class="nav-link">Deconnexion</a></li>
                   </ul>
               </nav>
           </div>
           <div class="main">
               <div class="ligne">
            <p>Bienvenue sur </br><strong>MyChat</strong></br>
           envoye des messages publics ou privé !
        </p>
            
          </div>
</div>
           <div class="col-md-12 col-lg-8 pageaccueil__msg">
        
                
                 <form action="" method="post">
                   <div class="form__groupinput">
                        <label for="username"> </label>
                        <input type="text" name="message" class="form-control col-md-10" placeholder="Tapez votre message">
                        <input type="submit" class="btn btn-success m-2" name="envoyerPublic" value="Poster">
                    </div>
                </form>
               
                <div id="list">
            
                <?php
                   $postmsg=new PostMessage($pdo);
                   $list=$postmsg->showAll();
                foreach($list as $l){ ?>
                
                 <p class="col-lg-12 mb-2 comments"> <strong><?=$l['pseudo']?>  :</strong><?=$l['message']?> </p>
              
            
                 <?php }  ?>
              
             </div>
            
           <div class="col-2 pageaccueil__block2">

               <h4>List user Online</h4>
               <table>
                <?php 
            
                $enLigne=new myFunctions($pdo);
                $tab=$enLigne->online($_SESSION['username']);
            
                if(count($tab)==0){
                    echo "Aucun autre user n'est en ligne";
                }
            
                foreach($tab as $t){
                ?>
                   <tr>
                       <td ><img src="uploads/<?=$t['image']?>" width="40" heigh="30"></td>
                       <td><a href="inbox.php?n=<?=$t['username']?>"><?=$t['username']?></a></td>
                       <td ><img src="images/vert.png" width="10" heigh="5"></td>
                       
                   </tr>
                <?php }?>
               </table>
           </div>
       </div>
       </div>
      
</div>
<script src="js/jquery-3.4.1.slim.min.js"></script>

<script src="js/popper.min.js" ></script>

<script src="js/bootstrap.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="js/bootstrap.bundle.min.js"></script>
 </body>
 </html>