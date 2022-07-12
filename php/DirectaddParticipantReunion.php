<?php
    require("session-control.php");
    require("configure.php");
    include "functions.php";
//    if(isset($_GET['idP'],$_GET['idR'],$_GET['act']) and !empty($_GET['idP']) and !empty($_GET['idR']) and !empty($_GET['act']))
//    {
    
        $idReunion=getWebId($_GET['idR'],"Reunion","decrypted");
        $idParticipant=getWebId( $_GET['idP'],"Participant","decrypted");
        $act=$_GET['act'];
        if($act!=0)
        {
            $req="delete from ParticipantReunion where idParticipant=$idParticipant and idReunion=$idReunion";
        }
        else
        {
            $etat=1;
            $req="insert into ParticipantReunion(idParticipant,idReunion,idEtatParticipant)"; 
            $req.="values($idParticipant,$idReunion,$etat)";
        }
        if(mysqli_query($connexionServeur,$req))
        {
            $idReunion=getWebId($idReunion,"Reunion","crypted");
            header("Location:../index.php?page=participe&&id=$idReunion");
        }
//    }
?>  