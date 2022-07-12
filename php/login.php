<?php
    session_start();
    require_once("configure.php");
    include "functions.php";
    if(isset($_POST['submit']))
    {
        $login=$_POST['login'];
        $pwd=$_POST['pwd'];
        $decryptIt=decrypted($_POST['pwd']);
        $pwd=$decryptIt;
        $select="select username,Password,avatar,Nom,Prenom,TelephoneCompte,EmailCompte,privilege,etatCompte,idCompte,statutConnexion from Compte where username='$login' and Password='$pwd';";    
        $requete=mysqli_query($connexionServeur, $select);
        $line=mysqli_fetch_row($requete);
        if (!empty($line[0]))
        {
//            $_SESSION['login']=$line[0];
            $_SESSION['pwd']=$line[1];
            $_SESSION['avatar']=$line[2];
            $_SESSION['Nom']=$line[3];
            $_SESSION['Prenom']=$line[4];
            $_SESSION['TelephoneCompte']=$line[5];
            $_SESSION['EmailCompte']=$line[6];
            $_SESSION['privilege']=$line[7];
            $_SESSION['etatcompte']=$line[8];
            $_SESSION['idcompte']=$line[9];
            $_SESSION['statutConnexion']=$line[10];
            if($_SESSION['etatcompte'] != "desactive"){
                $_SESSION['login']=$line[0];
                $update="update Compte set statutConnexion=1 where username='$line[0]'";
                $exec=mysqli_query($connexionServeur, $update);
                if($exec)
                    header("location:../index.php?page=home");
                else
                    echo"$update";
            }
            else
            {
            echo'<p>Votre compte est inactif <br>Contactez l\'administrateur <br><a href="../index.php">Page de connexion</a>.</p>'."\n";
                exit();
            }
        }
        else
            header("location:../index.php");
    }
?>    