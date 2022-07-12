<?php

 if(isset($_GET['id'],$_GET['src'],$_GET['page']) and !empty($_GET['id']) and !empty($_GET['src']) and !empty($_GET['page']))
 {
    $idLine=$_GET['id'];
    $table=$_GET['src'];
    $page=$_GET['page'];
     
    $archi=0;
    if($table=="Archive")
    {
        $table="Reunion";
        $archi=1;
    }
    $userTable=array("Reunion","Participant","Ordre");

    if(!in_array($table,$userTable))
        require("admin-php-control.php");
    else
        require("session-control.php");

    require("configure.php");
    include "functions.php";
    $idLine=getWebId($idLine,$table,"decrypted");

    $delete="delete from $table where id$table=$idLine;";
    $exec=mysqli_query($connexionServeur,$delete);
    
    echo $delete.'<br>';
    if($archi!=0)
        $table="Archive";
     
    if($exec)
        switch ($table)
        {
            case "Participant": $delete="delete from ParticipantReunion where idParticipant=$idLine;";
                                $exec=mysqli_query($connexionServeur,$delete);
                                header("Location:../index.php?page=$page&&src=participant");
                                break;
                
            case "Archive"    : $delete="delete from ParticipantReunion where idReunion=$idLine;";
                                $exec=mysqli_query($connexionServeur,$delete);
                                header("Location:../index.php?page=$page&&src=archive");
                                break;
                
            case "Reunion"    : $delete="delete from ParticipantReunion where idReunion=$idLine;";
                                $exec=mysqli_query($connexionServeur,$delete);
                                header("Location:../index.php?page=$page&&src=archive");
                                break;
                
            case "Ordre"    : $delete="delete from OrdreReunion where idOrdre=$idLine;";
                                $exec=mysqli_query($connexionServeur,$delete);
                                header("Location:../index.php?page=$page&&src=ordre");
                                break;
                
            default: header("Location:../index.php?page=$page");
        }
 }
 else
     echo "<a href='index.php?page=home'>Parametres Invalides</a>";

?> 