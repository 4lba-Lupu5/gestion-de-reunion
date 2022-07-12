<?php
    require("session-control.php");
    require("configure.php");
    include "functions.php";
    if(isset($_POST['modifier']))
    {
//        MISE A JOUR COORDONNEES
        $username=$_SESSION['login'];
//        Donnees venant du formulaire 
        $Ftel=$_POST['telephone'];
        $Fmail=$_POST['email'];  
        
        $decryptIt=decrypted($_POST['holdPwd']);
        $holdPwd=$decryptIt; 
        $cryptIt=crypted($_POST['newPwd']);
        $newPwd=$cryptIt;
        
        $select="   select TelephoneCompte,EmailCompte,Password              
                    from Compte
                    where username='$username' ";
        
        $exec=mysqli_query($connexionServeur,$select);
        $line=mysqli_fetch_row($exec);
//        Donnees venant de requete pour verification 
        $Rtel=$line[0];
        $Rmail=$line[1];
        $Rpwd=$line[2];
 

        if($Ftel!=$Rtel)      
        {
            $update="Update Compte set TelephoneCompte='$Ftel' where username='$username' "; 
            $exec=mysqli_query($connexionServeur,$update);
        }
        
        if($Fmail!=$Rmail)      
        {
            $update="Update Compte set EmailCompte='$Fmail' where username='$username' "; 
            $exec=mysqli_query($connexionServeur,$update);
        }
    
        if($holdPwd==$Rpwd)
        {
            if($newPwd!=$Rpwd)
            {
                $update="Update Compte set Password='$newPwd' where username='$username' "; 
                $exec=mysqli_query($connexionServeur,$update); 
            }  
        }
        
//        MISE A JOUR DE LA PHOTO DE PROFIL
        if(isset($_FILES['avatar']))
        {    
            $file_type=$_FILES['avatar']['type'];
            $file_size=$_FILES['avatar']['size'];
            $size_max=$_POST['MAX_FILE_SIZE'];
            $type=array("image/jpeg","image/jpg","image/png");//Extensions acceptees 
            if(($file_size<=$size_max)and(in_array($file_type,$type)))
            {
                //Pour formater l'extension de l'image
                switch ($file_type)
                {
                    case "image/jpeg":$file_type=".jpeg";break;
                    case "image/jpg":$file_type=".jpeg";break;
                    default :$file_type=".png";
                }
                //donnees simples 
                $username=$_POST['username'];
          
                //fichiers
                $folder="../avatar/";
                $file_name=basename($_FILES['avatar']['name']);
                $file_tmp=$_FILES['avatar']['tmp_name'];
                
                $src=$file_tmp;
                $dest=$folder.$username.$file_type;
                $move=move_uploaded_file($src,$dest);
                if($move)
                {
                    $dest="avatar/".$username.$file_type;
                    $update="update Compte set avatar='$dest' where username='$username'";
                    $requete=mysqli_query($connexionServeur,$update);
                    if($requete)
                       header("location:../index.php?page=home");
                        
                    else
                        header("location:../index.php?page=home");
                        
                }
                else
                    header("location:../index.php?page=home"); 
                    
            } 
            else
                header("location:../index.php?page=home");  
                
        }
        else
           echo "<a href='../index.php?page=home'>Fichier non soumis</a>";
        
     }
?>
