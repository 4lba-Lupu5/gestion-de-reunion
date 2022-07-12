<?php
    
    $idLine=$_GET['id'];
    $idLine=getWebId($idLine,"Compte","decrypted");
    
    $select="select idCompte,Nom,Prenom,sexe,avatar,username,Password,TelephoneCompte,EmailCompte,privilege,etatCompte from Compte where idCompte=$idLine;";
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
?>

<div class="row">
    <form class="col-md-auto wrap" action="php/createUser.php" method="POST">
                <h2> EDITER </h2>
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" name="nom" class="form-control" value="<?= $nom ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Prenom</label>
                    <input type="text" name="prenom" class="form-control" value="<?= $prenom ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Telephone</label>
                    <input type="tel" name="telephone" class="form-control" value="<?= $telephone ?>" >
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $email ?>" >
                </div>
        
                    <label>Sexe</label>
                        <?php 
                            if($sexe=="m")
                            { ?>
                                <label class="radio-inline">
                                <input type="radio" name="genre" value="m" checked> Homme
                                </label>
                            <?php
                            }
                            else{ ?>
                                <label class="radio-inline">
                                <input type="radio" name="genre" value="f" checked> Femme
                                </label>
                           <?php } ?> 
        
                <div class="form-group">
                <label>Privilege</label>
                <select name="privilege">
                    <option checked ><?= ($privilege!="admin"?"Utilisateur":"Administrateur") ?></option>            
                    <option ><?= ($privilege=="admin"?"Utilisateur":"Administrateur") ?></option>            
                </select>
                    
            </div>
                <div class="container" style="margin-top: 30px;">  
                    <input type="submit" class="btn btn-success" name="enregistrer" value="Enregistrer">
                    <input type="reset"  class="btn btn-warning" name="annuler" value="Effacer">
                    <a href="#" class="btn btn-link">
                    <i class="fa fa-arrow-circle-left fa-4x"></i></a>
                </div>         
    </form>
<!--    <div class="col col-lg-1"></div>-->
    <div class="col grid">
        <caption><h2><u>BOARD</u></h2></caption>
        <?php include "liens/userBoard.php" ?>
    </div>
</div>

