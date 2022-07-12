<?php  
    require("session-control.php");
    require("configure.php");
    include "functions.php";
    if (isset($_POST['enregistrer']))
    {
//        Donnees recuperees sur le formulaire
        $jour=$_POST['jourreunion'];
        $heure=$_POST['heurereunion'];
        $etat=$_POST['etatreunion'];
        $mode=$_POST['modereunion'];
        $type=$_POST['typereunion'];
        $priorite=$_POST['prioritereunion'];
        if(!empty($_POST['indicatif']))
            $indicatif=' \' '.$_POST['indicatif'].'\'';
        else
            $indicatif="NULL";
        
        
//        Requetes sql pour selectionner les correspondances des donnees du formulaire dans la BD
        $etat="Select idEtatReunion,LibelleEtatReunion from etatReunion where LibelleEtatReunion='$etat' and LibelleEtatReunion='Attente';";
        $priorite="select idPrioriteReunion,LibellePrioriteReunion from prioriteReunion where LibellePrioriteReunion='$priorite';";
        $mode="select idModeReunion,LibelleModeReunion from modeReunion where LibelleModeReunion='$mode';";
        $type="select idTypeReunion,LibelleTypeReunion from typeReunion where LibelleTypeReunion='$type';";

//        Execution des differentes requetes
        $exec_etat=mysqli_query($connexionServeur,$etat);
        $exec_priorite=mysqli_query($connexionServeur,$priorite);
        $exec_mode=mysqli_query($connexionServeur,$mode);
        $exec_type=mysqli_query($connexionServeur,$type);
        
      
//        Test pour s'assurer que les requetes ont ete executess
        if($exec_etat and $exec_priorite and $exec_mode and $exec_type)
        {
//            Test pour s'assurer que les donnees prises sur le formulaire existent reelement dans la BD
            $line_etat=mysqli_num_rows($exec_etat);
            $line_priorite=mysqli_num_rows($exec_priorite);
            $line_mode=mysqli_num_rows($exec_mode);
            $line_type=mysqli_num_rows($exec_type);
            if($line_etat!=1 or $line_priorite !=1 or $line_mode!=1 or $line_type!=1)
            {
                $erreur="<a href='../index.php?page=home'>Les donnees renseignees sont erronees</a>";
                echo $erreur;
            }
            else
            {
            
//                execution des select pour recuperer les id des defferentes lignes des tables consernee
                $line_etat=mysqli_fetch_row($exec_etat);
                $line_priorite=mysqli_fetch_row($exec_priorite);
                $line_mode=mysqli_fetch_row($exec_mode);
                $line_type=mysqli_fetch_row($exec_type);

                $idCompte=$_SESSION['idcompte'];
                $idTypeReunion=$line_type[0];
                $idPrioriteReunion=$line_priorite[0];
                $idEtatReunion=$line_etat[0];
                $idModeReunion=$line_mode[0];
                
//               Valeur par defaut
                $PvReunion="NULL";
                $NbrOrdre=0;;
                $NbrPart=0;
                
//                Requete d'insertion d'une reunion plannifiee
                $insert="insert into Reunion(JourReunion,HeureReunion,PvReunion,indicatifReunion,idCompte,idTypeReunion,idPrioriteReunion,idEtatReunion,idModeReunion,NbrOrdre,NbrParticipant)";
                $values="values('$jour','$heure',$PvReunion,$indicatif,$idCompte,$idTypeReunion,$idPrioriteReunion,$idEtatReunion,$idModeReunion,$NbrOrdre,$NbrPart)";
                $exec_insert=mysqli_query($connexionServeur,$insert.$values);
                echo $insert.$values;
               if($exec_insert)
                  header("Location:../index.php?page=home");
                else
                {
                     $erreur="<a href='../index.php?page=home'>Erreur inattendue au moment de la creation</a>";
                     echo $erreur;
                }
            }
        }
           
    }

?>
