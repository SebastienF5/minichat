<?php 
   include "Connexion.php";
   include "Cinscription.php";
  
   $error_message=$error_email=$msg=$error_pass=$msg_error="";
   $error_mg_pass=$error_msg_name=$error_msg_email="";
   $username=$email=$pass=$cpass="";
   $p=$cp="";
   $tabNom=array();
   $emailfalse=false;
   $succes=true;
   $samePseudo=false;
   $img="";
    
   $inscription=new Cinscription($pdo);

   if(isset($_POST['envoyer'])){
       $username=htmlspecialchars($_POST['username']);
       $email=htmlspecialchars($_POST['email']);
       $p=htmlspecialchars($_POST['password']);
       $cp=htmlspecialchars($_POST['confirmPassword']);

  if(isset($_FILES['photo']) and $_FILES['photo']['error']==0)
  {
     
    if($_FILES['photo']['size']<=1000000){
      $infofichier=pathinfo($_FILES['photo']['name']);
      $extension_upload=$infofichier['extension'];
      $extension_autorise=array('jpg','jpeg','png','gif');
      if(in_array($extension_upload,$extension_autorise)){
       
          $file=''.time().''.$username.'.'.$extension_upload;
             move_uploaded_file($_FILES['photo']['tmp_name'],'uploads/'.$file);
             $img=$file;
      }
    }
  }
  else{
    $img="defaut.jpg";
  }
    
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $error_email="* email incorrect!";
        $succes=false;
    }
   
    if($p!=$cp){
        $error_pass="Les mots de passe sont differents!";
        $succes=false;
    }else{
        $pass=password_hash($p,PASSWORD_DEFAULT,['cost'=>14]);
    }
   
   if(empty($username)){
       $error_msg_name="* Entrez votre username";
       $succes=false;
   }
   
   if(empty($email)){
    $error_msg_email="* Entrez votre email";
    $succes=false;
    $emailfalse=true;
   }
   if(empty($p)){
    $error_message="* Entrez votre password";
    $succes=false;
   }

   $tabNom=$inscription->listeNom($username);
   foreach($tabNom as $tab){
    if($tab['username'] == $username){
        $samePseudo=true;
    } 
}
if($samePseudo==true){
 
    $msg_error="Ce Pseudo est deja dans la table";
    $succes=false;
 
}else{
  $msg_error=null;

}

   if($succes==true){
   


    $ligne=$inscription->insertAll($username,$email,$pass,$img);
     
   
    $username=$email=$p=$cp="";
    
     if($ligne===1){
         $msg="cree avec Succes, connectez vous a l'aide du lien";

     }else{
         $msg="*Erreur d'ajout!";
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
    <title>  MyChat| Inscription</title>
</head>
<body>
    <div class="container-fluid" id="inscription">
        <div class="row">
         
           <div class='col-lg-6 inscription__form'>
               <h2>Sign Up</h2>
               <p class="alert-success <?php if($msg!=null) echo "p-2";?>"><?=$msg?></p>
               <p class="alert-danger <?php if($msg_error!=null) echo "p-2";?>"><?php if ($msg_error != null) echo $msg_error;?></p>
           <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                    <label for="username"></label>
                        <input type="text" name="username" class="form-control " placeholder="UserName" value="<?=$username?>">
                       <em class="text-danger"><?=$error_msg_name?></em>
                    </div>
                    <div class="form-group">
                    <label for="email"></label>
                        <input type="text" name="email" class="form-control" placeholder="Email" value="<?=$email?>">
                        <em class="text-danger">
                        <?php 
                        echo "$error_msg_email";
                           if($emailfalse and !empty($email))
                           echo "$error_email";
                        ?>
                        
                        </em>
                    </div>
                    <div class="form-group">
                        <label for="password"></label>
                        <input type="password" name="password" class="form-control" placeholder="*************" value="<?=$p?>">
                        <em class="text-danger"><?=$error_message?></em>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword"></label>
                        <input type="password" name="confirmPassword" class="form-control" placeholder="*************" value="<?=$cp?>">
                        <em class="text-danger"><?=$error_pass?></em>
                    </div>
                  
                    <div class="form-group">
                       <label for="confirmPassword"></label>
                        <input type="FILE" class="form-control" name="photo">
                    </div>
             
                    <input type="submit" class="btn btn-success m-2" name="envoyer"><br/>
                    <a href="index.php">Sign in ?</a>
                </form>
             
                
           </div>
        </div>
    </div>
</body>
</html>