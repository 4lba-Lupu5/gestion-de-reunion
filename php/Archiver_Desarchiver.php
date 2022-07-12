<?php
    require("session-control.php");
    require("configure.php");
    include "functions.php";
 if(isset($_GET['id'],$_GET['src'],$_GET['page']) and !empty($_GET['id']) and !empty($_GET['src']) and !empty($_GET['page']))
 {
    $idLine=$_GET['id'];
    $table=$_GET['src'];
    $page=$_GET['page'];
    $idLine=getWebId($idLine,"Reunion","decrypted");
    $select="select JourReunion,HeureReunion,PvReunion,IndicatifReunion,T.LibelleTypeReunion,P.LibellePrioriteReunion,E.LibelleEtatReunion,M.LibelleModeReunion,NbrOrdre,NbrParticipant,R.idTypeReunion,R.idPrioriteReunion,R.idEtatReunion,R.idModeReunion,R.idReunion              
    from Reunion R,TypeReunion T,PrioriteReunion P,EtatReunion E,ModeReunion M
    where R.idTypeReunion=T.idTypeReunion and R.idPrioriteReunion=P.idPrioriteReunion and R.idEtatReunion=E.idEtatReunion and R.idModeReunion=M.idModeReunion and R.idReunion=$idLine";
        
    $exec=mysqli_query($connexionServeur,$select);
    $line=mysqli_fetch_row($exec); 
    $jour=$line[0];
    $heure=$line[1];
    $indicatif=$line[3];
    $type=$line[4];
    $priorite=$line[5];
    $etat=$line[6];
    $mode=$line[7];
     
    $idReunion=$line[14];
    $idType=$line[10];
    $idMode=$line[13];
    $idEtat=$line[12];
    $idPriorite=$line[11];
     
    if($idEtat != 3)
        $update="Update Reunion set idEtatReunion=3 where idReunion=$idLine";
     else
         $update="Update Reunion set idEtatReunion=2 where idReunion=$idLine";
     
    $exec=mysqli_query($connexionServeur,$update);
    if($table!="archive")
        header("Location:../index.php?page=$page");
     else
         header("Location:../index.php?page=$page&&src=$table");
 }
?>


