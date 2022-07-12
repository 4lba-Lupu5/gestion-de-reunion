<?php
    
    require("session-control.php");
    require("configure.php");
    include "functions.php";
if(isset($_GET['id'],$_GET['nbr']) and !empty($_GET['id']) and !empty($_GET['nbr']))
{
    $idReunion=$_GET['id'];
    if (isset($_POST['save']))
    {
        $idReunion=getWebId($_GET['id'],"Reunion","decrypted");
        $echec=0;
        $nbr=$_GET['nbr'];
        for($i=1;$i<=$nbr;$i++)
        {
            $test=true;
            
            $nom="nom$i";
            if(!isset($_POST[$nom]) or empty($_POST[$nom]))
                $test=false;
            else
                $nom=$_POST[$nom];
            
            $prenom="prenom$i";
            if(!isset($_POST[$prenom]) or empty($_POST[$prenom]))
                $test=false;
            else        
                $prenom=$_POST[$prenom];
            
            $tel="telephone$i";
            if(!isset($_POST[$tel]) or empty($_POST[$tel]))
                $test=false;
            else
                $tel=$_POST[$tel];
            
            $mail="mail$i";
            if(!isset($_POST[$mail]) or empty($_POST[$mail]))
                $test=false;
            else
                $mail=$_POST[$mail];
            
            if($test)
            {
                $idCompte=$_SESSION['idcompte'];
                $insert="insert into Participant(NomParticipant,PrenomParticipant,TelephoneParticipant,EmailParticipant,idCompte)";
                $value="values('$nom','$prenom',$tel,'$mail',$idCompte)";
                $exec=mysqli_query($connexionServeur,$insert.$value);
                
                $select="select idParticipant 
                         from Participant 
                         where NomParticipant='$nom' and
                         PrenomParticipant='$prenom' and
                         TelephoneParticipant=$tel and
                         EmailParticipant='$mail' and
                         idCompte=$idCompte
                        ";
                $exec=mysqli_query($connexionServeur,$select);
                $line=mysqli_fetch_row($exec);
                
                $idParticipant=$line[0];
                $etat=1;
                $insert="insert into ParticipantReunion(idParticipant,idReunion,idEtatParticipant)";
                $value="values($idParticipant,$idReunion,$etat)";
                $exec=mysqli_query($connexionServeur,$insert.$value);        
            }
            else
                $echec++;
        } 
        $idReunion=getWebId( $idReunion,"Reunion","crypted");
        if($echec!=0)
            echo "<a href='../index.php?page=participe&&id=$idReunion'> $echec Echecs </a>";
        else
            header("Location:../index.php?page=participe&&id=$idReunion");
    }
}
?>