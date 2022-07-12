<?php  
    require("session-control.php");
    require("configure.php");
    include "functions.php";
    if (isset($_POST['modifier']))
    {
//        Donnees venant du formulaire
        $Fid=$_POST['idreunion'];
        
        $Fjour=$_POST['jourreunion'];
        $Fheure=$_POST['heurereunion'];
        $Fmode=$_POST['modereunion'];
        $Ftype=$_POST['typereunion'];
        $Fpriorite=$_POST['prioritereunion'];
        $Findicatif=$_POST['indicatif'];
        $Fetat=$_POST['etatreunion'];
        
        
        $select="   select JourReunion,HeureReunion,IndicatifReunion,idTypeReunion,idPrioriteReunion,idEtatReunion,idModeReunion              
                    from Reunion
                    where idReunion=$Fid ";
        
        $exec=mysqli_query($connexionServeur,$select);
        $line=mysqli_fetch_row($exec);
//        Donnees venant de requete pour verification 
        $Rjour=$line[0];
        $Rheure=$line[1];
        $Rindicatif=$line[2];
        $Rtype=$line[3];
        $Rpriorite=$line[4];
        $Retat=$line[5];
        $Rmode=$line[6];

        if($Fjour!=$Rjour)      
        {
            $update="Update Reunion set JourReunion='$Fjour' where idReunion=$Fid"; 
            $exec=mysqli_query($connexionServeur,$update);
        }
        
        if($Fheure!=$Rheure)
        {
            $update="Update Reunion set HeureReunion='$Fheure' where idReunion=$Fid";
            $exec=mysqli_query($connexionServeur,$update);
        }
        
        if($Findicatif!=$Rindicatif)
        {
            $update="Update Reunion set IndicatifReunion='$Findicatif' where idReunion=$Fid";
            $exec=mysqli_query($connexionServeur,$update);
        } 
                
        if($Ftype!=$Rtype)
        {
            $update="Update Reunion set idTypeReunion=$Ftype where idReunion=$Fid";
            $exec=mysqli_query($connexionServeur,$update);
        }
        
        if($Fpriorite!=$Rpriorite)
        {
            $update="Update Reunion set idPrioriteReunion=$Fpriorite where idReunion=$Fid";
            $exec=mysqli_query($connexionServeur,$update);
        }
        
        if($Fetat!=$Retat)
        {
            $update="Update Reunion set idEtatReunion=$Fetat where idReunion=$Fid";
            $exec=mysqli_query($connexionServeur,$update);
        }
        
        if($Fmode!=$Rmode)
        {
            $update="Update Reunion set idModeReunion=$Fmode where idReunion=$Fid";
            $exec=mysqli_query($connexionServeur,$update);
        }
        
        
        //        MISE A JOUR DE LA PHOTO DE PROFIL
        if(isset($_FILES['pv']))
        {    
            $file_type=$_FILES['pv']['type'];
            $file_size=$_FILES['pv']['size'];
            $size_max=$_POST['MAX_FILE_SIZE'];
            $type=array("application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/pdf","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","text/plain","application/vnd.openxmlformats-officedocument.presentationml.presentation"); //Extensions acceptees 
            
            if(($file_size<=$size_max)and(in_array($file_type,$type)))
            {
//                Pour formater l'extension de l'image
                switch ($file_type)
                {
                    case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":$file_type=".docx";break;
                    case "application/pdf":$file_type=".pdf";break;
                    case "text/plain":$file_type=".txt";break;
                    case "application/vnd.openxmlformats-officedocument.presentationml.presentation":$file_type=".pptx";break;
                    case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":$file_type=".xlsx";break;
                    default :$file_type=".png";
                }
//                donnees simples
                $username=$_SESSION['login'];
          
//                fichiers
                $folder="../Proces_Verbal/";
                $file_name=basename($_FILES['pv']['name']);
                $file_tmp=$_FILES['pv']['tmp_name'];
                
                $src=$file_tmp;
                $dest=$folder.$username.$Fid.$file_type;
                $move=move_uploaded_file($src,$dest);
                echo '<br>'.$file_type;
                if($move)
                {
                    $dest="Proces_Verbal/".$username.$Fid.$file_type;
                    $update="Update Reunion set PvReunion='$dest' where idReunion=$Fid";
                    $requete=mysqli_query($connexionServeur,$update);
                }
            }
            header("Location:../index.php?page=home");  
        }
        else
           echo "<a href='../index.php?page=home'>Fichier non soumis</a>";

//      Fin
        
        header("Location:../index.php?page=home");
    }

?>
