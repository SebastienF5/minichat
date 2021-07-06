<?php
require "Auth.php";
require "Connexion.php";

$_SESSION['username']=null;


$logout=new Auth($pdo);
$logout->setEtat('offline',$_GET['n']);
header("Location:index.php");