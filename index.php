 <?php
    require "Connexion.php";
    require "Auth.php";

    $error_message=$error_pass="";
   $username=$pass=$password=$error_msg_name=$msg="";
    $st="";
    $tr=false;
   $tab=array();
   $succes=true;
   $tr=false;
   if(isset($_POST['connecter'])){
       $username=htmlspecialchars($_POST['username']);
       $pass=htmlspecialchars($_POST['password1']);
 
   
   if(empty($username)){
       $error_msg_name="* Entrez votre username";
       $succes=false;
   }

   if(empty($pass)){
    $error_message="* Entrez votre password";
    $succes=false;
   }

   $authentification=new Auth($pdo);
    
   $tab=$authentification->listeNom();
   
    foreach($tab as $s){
    
        if($s['username']===$username && password_verify($_POST['password1'],$s['password'])){
         $tr=true;
         break;
        }
    }
  
      if($succes and $tr){
        session_start();
         $_SESSION['username']=$username;
         header("Location:accueil.php");
      
         $authentification->setEtat('online',$username);
        
      }else{
        $msg="Identifiants Incorrects";
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
    <title>Connexion | MyChat</title>
</head>
<body>
     <div class="container-fluid" id="page__index">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="logo col-md-12">
                    <h1>MyChat</h1>
                    
                    <p><strong>Page de Connexion</strong> <br/>Utiliser le formulaire pour vous connecter!</p>
                    <p> <img src="images/logo.png"></p>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 text-center">
            <p class="alert-danger"><?= $msg ?></p>
            <form action="" method="post">
                    <div class="form-group">
                        <label for="username"> </label>
                        <input type="text" name="username" class="form-control" placeholder="Username">
                        <em class="text-danger"><?=$error_msg_name ?></em>
                    </div>
                    <div class="form-group">
                        <label for="password"></label>
                        <input type="password"  name="password1" class="form-control" placeholder="*************">
                        <em class="text-danger"><?=$error_message ?></em>
                    </div>
                    <div class="form-group">
                    <input type="submit" class="btn btn-success mt-2" name="connecter" value="Connecter"><br/>
                    <a href="inscription.php">creer un compte?</a>
                    </div>
                </form>
            </div>
        </div>
     </div>
</body>
</html>