<?php
    
    $idLine=$_SESSION['idcompte'];    
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
    if($privilege != "user")
        $privilege="Administrateur";
    else
        $privilege="Utilisateur";
?>
<link rel="stylesheet" href="css/popup.css">

<body background="../background1.png">

<div id="modal-wrapper0" class="modal">
   <div class="imgcontainer">
      <span onclick="document.getElementById('modal-wrapper0').style.display='none'" class="close0" title="Fermer">&times;</span>
    </div>
  <form method="POST" class="wrapcompte " action="php/editCompte.php" enctype="multipart/form-data">

      <input type="hidden" name="MAX_FILE_SIZE" value="52428800000" required>
    
<hr>
    <div class="container">
        <div class="row">
        <div class="col-sm-5 col-md-5 col-lg-5">
        <img src="<?php echo $_SESSION['avatar']; ?>" class="img-thumbnail avatar0" alt="AVATAR"><br><br>
        <input type="file" name="avatar">
     </div>
      <div class="col-sm-7 col-md-7 col-lg-7">
                    <div class="form-group">
                         <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $username ?>" readonly>

                        <label>Privilège</label>
                        <input type="text" name="privilege" class="form-control" value="<?= $privilege ?>" readonly>

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
                        <label>Ancien Mot de Passe</label>
                        <input type="password" name="holdPwd" class="form-control" placeholder="Ancien mot de passe">
                    
                        <label>Nouveau Mot de Passe</label>
                        <input type="password" name="newPwd" class="form-control" placeholder="Nouveau mot de passe">
            </div>
            
                    <div class="container" style="margin-top: 30px;">  
                        <center>
                            <input type="submit" class="btn btn-success" name="modifier" value="APPLIQUER" style="width:80%">
<!--                            <input type="reset"  class="btn btn-warning " name="annuler" value="ABANDONNER">-->
                        </center>
                    </div>  
       
        
      </div>
      </div>
  </form>
</div>
    
   
        
    
    
<script>
// If user clicks anywhere outside of the modal, Modal will close

var modal = document.getElementById('modal-wrapper0');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
    
</body>