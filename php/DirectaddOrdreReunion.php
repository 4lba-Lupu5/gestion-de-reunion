<?php
    require("session-control.php");
    require("configure.php");
    include "functions.php";
//    if(isset($_GET['idP'],$_GET['idR'],$_GET['act']) and !empty($_GET['idP']) and !empty($_GET['idR']) and !empty($_GET['act']))
//    {
    
        $idReunion=getWebId($_GET['idR'],"Reunion","decrypted");
        $idOrdre=getWebId( $_GET['idO'],"Ordre","decrypted");
        $act=$_GET['act'];
        if($act!=0)
        {
            $req="delete from OrdreReunion where idOrdre=$idOrdre and idReunion=$idReunion";
        }
        else
        {
            $req="insert into OrdreReunion(idOrdre,idReunion)"; 
            $req.="values($idOrdre,$idReunion)";
        }
        if(mysqli_query($connexionServeur,$req))
        {
            $idReunion=getWebId($idReunion,"Reunion","crypted");
            header("Location:../index.php?page=ordre&&id=$idReunion");
        }
//    }
?>  