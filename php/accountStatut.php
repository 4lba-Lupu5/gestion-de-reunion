<?php
    require("admin-php-control.php");
    require("configure.php");
    include "functions.php";

    $idLine=$_GET['id'];
    $statut=$_GET['etat'];
//    $page="gestionUser";
    $page=$_GET['page'];
    
    $idLine=getWebId($idLine,"Compte","decrypted");
    
    if($statut!="active")
        $statut="active";
    else
        $statut="desactive";

    $update="update Compte set etatCompte='$statut' where idCompte=$idLine;";
    $exec=mysqli_query($connexionServeur,$update);
    
    if($exec)
        if($page!="editProfile")
            header("Location:../index.php?page=$page");
        else{
            $idLine=getWebId($idLine,"Compte","crypted");
            header("Location:../index.php?page=$page&&id=$idLine");
        }
?>