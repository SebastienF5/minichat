<?php 
 session_start();

        if($_SESSION['username']==null)
        {
            header('Location:index.php');
        }

        require "Connexion.php";
        require "PostMessage.php";
        require "myFunctions.php";
        require "Box.php";

   $msg_error="";
   $msg_post="";

   $success=true;
   $list=array();
   $_SESSION['dest']=$_GET['n'];
   $send=new Box($pdo);
  // $list=$postmsg->showAll();
  $msg_post="";
  $succes=false;
   if(isset($_POST['envoyerPrive'])){
       $msg_post=htmlspecialchars($_POST['message']);

       if(empty($msg_post)){
           $msg_error="Le champs est vide !";
           $success=false;
       }
      
       if($success){
       
           $tab=$send->insertPrive($_SESSION['username'],$msg_post,htmlspecialchars($_GET['n']));
           header("Location:inbox.php?n=".$_GET['n']);
    

           if($tab != 1){
               $msg_error="Erreur!";

           }
       }

       
     
   }

   if(isset($_GET['n'])){
   $nickname=$send->getUsername($_GET['n']);
  
   if($nickname==null){
       $_GET['n']="null";
   }
}else{
    header("Location:accueil.php");
}
 
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
     <link rel="stylesheet" href="css/mystyle.css" type="text/css">
     <link rel="stylesheet" href="css/style.css" type="text/css">
     <title>Inbox | MyChat</title>
 </head>
 <body id="allPage">
     <div class="container-fluid" id="page__inbox">
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
                  <li class="nav-item active"><a href="accueil.php" class="nav-link">Accueil</a></li>
                  <li class="nav-item"><a href="inscription.php" class="nav-link">Creer Compte</a></li>
                  </ul>
             </div>
           </nav>


</div>
     
        <div class="gros">
           <div class="col-lg-2 pageaccueil__block1">
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
             
           </div>
       
          <?php
             require "modal.php";
          ?>
         
           <div class="col-lg-10 pageinbox--chat montrer" style="display:<?php if($_GET['n']=="null"){echo "block";}else{ echo "none";}?>;">
               <p style="text-align:center;"> Selectionner une conversation ! 
              
               </p>

               <p class="modalLink"> <a href="" data-toggle="modal" data-target="#showpanel" class="dotm"><i class="fa fa-ellipsis-v"></i></a></p>
              
           </div>
           <div class="col-lg-10 pageinbox--chat" style="display:<?php if($_GET['n']=="null"){echo "none";}else{ echo "block";}?>;">

           
                <div class="header shadow-lg">
                    <?php $e=$send->getEtat($_GET['n']);
                    $v="";
                        foreach($e as $r){
                            $v= $r['etat'];
                        }
                    ?>
                <a href="#" class="nav-link"><img src="images/user.jpg" width="40" height="30"><?= $_GET['n']?></a>
                
                <p><img src="images/<?php if($v=="online"){echo "vert.png";}else{echo "rouge.png";} ?>" width="10" heigh="5">
                <a href="" data-toggle="modal" data-target="#showpanel" class="dot"> <i class="fa fa-ellipsis-v"></i></a>
                </p>
               
                </div>
                <div class="body" id="forChat">
                        <?php 
                    
                       
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
                    
                </div>
                <div class="pieds shadow-lg">
                <form action="" method="post">
                   <div class="form__groupinput">
                        <label for="username"> </label>
                        <input type="text" name="message" class="form-control" placeholder="Tapez votre message">   
                 
                        <input type="submit" class="btn btn-success m-2" name="envoyerPrive" value="Envoyer">
                    </div>
                </form>
                </div>
            </div>
         

       </div>
       </div>
       <?php
             require "modalBlock1.php";
          ?>
</div>

<script type="text/javascript"> 

				element = document.getElementById('forChat');
				element.scrollTop = element.scrollHeight;
              
 /*function loadChat()
 {
     $.post('minichat/inbox.php?n='+$_GET['n'], function(response){
         loadChat();
     });
 }

 function loadChat(){
    $.post('minichat/inbox.php?n='+$_GET['n'],function(response){
        $('#forChat').html(response);
    }); 
 }*/

               $(document).ready( function(){
$('#forChat').load('load_messages.php');
refresh();
});
 
function refresh()
{
setTimeout( function() {
  $('#forChat').fadeOut('slow').load('load_messages.php').fadeIn('slow');
  refresh();
}, 2000);
}
              
            //     setInterval('load_messages()',2000);
            //   function load_messages(){
            //       $('#forChat').load("load_messages.php");
            //   }

 /*function notif(){
    $.ajax({
    url: "load_messages.php",                  
     ifModified:true,
    success: function(content)
    {
      $('#forChat').html(content); //id de la <div> à refresh
    }
   });
  setTimeout(notif, 1000); //refresh toutes secondes (1 minute = 60000)
  }
  notif();*/

</script> 

<script src="js/jquery-3.4.1.slim.min.js"></script>
<script src="js/popper.min.js" ></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
 </html>