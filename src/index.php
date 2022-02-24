<?php
    
    session_start();
    
require "include.php";

$url = trim($_SERVER['PATH_INFO'],'/');
$url = explode('/',$url);
//print_r($url);

$route = array('contact','accueil','produit','category','contact','details','panier',
'supprimer','actionInscription','deconnexion','profil','actionConnexion');
$action = $url[0];

//Controller:

if(!in_array($action,$route)){
         
    $title = "Page ".$action;
    $content= "ERROR 404";   

}else{

    $function = "display".ucwords($action);
    $title = "Page ".$action;
    $content= $function();    
}
require VIEWS.SP."Layout".SP."default.php";

?>