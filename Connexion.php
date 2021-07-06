<?php
$pdo="";
$server="localhost";
$base="mychat";
$user="root";
$password="";
     try{
        $pdo=new PDO('mysql:host='.$server.';dbname='.$base.';charset=utf8',$user,$password,
        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      
     }catch(Exception $ex){
          die('Erreur:'.$ex->getMessage());
     }
 
