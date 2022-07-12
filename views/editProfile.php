<?php
    
    $idLine=$_GET['id'];
    $idLine=getWebId($idLine,"Compte","decrypted");
    
    $select="select idCompte,Nom,Prenom,sexe,avatar,username,Password,TelephoneCompte,EmailCompte,privilege,etatCompte,statutConnexion from Compte where idCompte=$idLine;";
    $exec=mysqli_query($connexionServeur,$select);
    $line=mysqli_fetch_row($exec);
    $idCompte=$line[0];
    $nom=$line[1];
    $prenom=$line[2];
    $sexe=$line[3];
    $avatar=$line[4];
    $username=$line[5];
    $password=$line[6];
    $telephone=$line[7];
    $email=$line[8];
    $privilege=$line[9];
    $etat=$line[10];
    $statut=$line[11];

    if($statut != 0)
        $statut="Connecté";
    else
        $statut="Déconnecté";
    
?>

<link rel="stylesheet" href="css/popup.css">


<form method="POST" class="wrapprofile " action="php/editProfile.php" enctype="multipart/form-data">

<input type="hidden" name="MAX_FILE_SIZE" value="52428800000" required>
    
<hr>
    <div class="container">
        <div class="row">
        <div class="col-sm-5 col-md-5 col-lg-5">
        <img src="<?php echo $avatar; ?>" class="img-thumbnail avatar1" alt="AVATAR"><br><br>
        <input type="file" name="avatar">
     </div>
      <div class="col-sm-7 col-md-7 col-lg-7">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $username ?>" readonly>
                        
                        <label>Privilege</label>
                        <select name="privilege" class="form-control">
                        <?php
                        if ($privilege != "admin")
                        {?>
                        <option checked value="user">Utilisateur</option>            
                        <option value="admin">Administrateur</option>                     
                        <?php }
                        else
                        { ?>
                        <option checked value="admin">Administrateur</option>            
                        <option value="user">Utilisateur</option>            
                        <?php }
                        ?>
                        </select>
                    </div>
                    <label>Sexe</label>
                        <?php 
                            if($sexe=="m") 
                                { ?>
                                    <label class="radio-inline form-control">
                                    <input type="radio" name="genre" value="m" checked> Homme
                                    </label>
                                <?php
                                }
                                else{ ?>
                                    <label class="radio-inline form-control">
                                    <input type="radio" name="genre" value="f" checked> Femme
                                    </label>
                            <?php } ?>  
                    <label>Statut</label>
                    <input type="text" name="statut" class="form-control" value="<?= $statut ?>" readonly>
          
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
                    <hr>
                        <label>Nom</label>
                        <input type="text" name="nom" class="form-control" value="<?= $nom ?>" readonly>

                        <label>Prenom</label>
                        <input type="text" name="prenom" class="form-control" value="<?= $prenom ?>" readonly>
            </div>
            
            <div class="col-sm-4 col-md-4 col-lg-4">
                    <hr>
                        <label>Telephone</label>
                        <input type="tel" name="telephone" class="form-control" value="<?= $telephone ?>" >
                    
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $email ?>" >
                        
                        
            </div>
            
            <div class="col-sm-4 col-md-4 col-lg-4" >
                    <hr>            
                        <label>Changer Mot de Passe</label>
                        <input type="password" name="newPwd" class="form-control" placeholder="Nouveau mot de passe">
                
                        <label>Etat (cliquer pour changer)</label><br>    
                        <a class="btn btn-primary" href="php/accountStatut.php?id=<?= getWebId($line[0],"Compte","crypted")?>&&etat=<?= $etat ?>&&page=editProfile" style="width:100%">
                        <?php
                            if($etat!="active")
                                echo "INACTIF";
                            else
                                echo "ACTIF";
                        ?></a>
                
            </div>
            
            
            
            <div class="container" style="margin-top: 30px;">  
                        <center>
                            <input type="submit" class="btn btn-success" name="modifier" value="APPLIQUER" style="width:60%">
                        <a href="index.php?page=gestionUser" class="btn btn-danger" style="width:30%">RETOUR</a>
                        </center>
            </div>  
       
        
      </div>
      </div>
  </form>