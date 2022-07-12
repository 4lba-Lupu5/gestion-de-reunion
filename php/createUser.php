<?php 
    require("admin-php-control.php");
    require("configure.php");
    include "functions.php";
    if (isset($_POST['enregistrer']))
    {
        $id=ordre("Compte");
		$statut="0";
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $sexe=$_POST['genre'];
        $username=$_POST['username'];
        $mail=$_POST['email'];
        ///$password=defaultPass($id,$nom,$prenom,$mail);
        $pass=$_POST['password'];
        ///$modalpassword=$password;
        $modalusername=$username;
        
        $cryptIt=crypted($pass);
        $password=$cryptIt;
        $telephone=$_POST['telephone'];
        $privilege=$_POST['privilege'];
        $etat="active";
        if($privilege != "admin")
        {
            if($sexe != "f")
                $avatar="avatar/default/defaultman.ico"; 
            else
                $avatar="avatar/default/defaultwoman.ico";
        }  
        else
            $avatar="avatar/default/defaultadmin.ico";
    
        $insert="insert into Compte(idCompte,Nom,Prenom,sexe,avatar,username,Password,TelephoneCompte,EmailCompte,privilege,etatCompte,statutConnexion)";
        $values="values($id,'$nom','$prenom','$sexe','$avatar','$username','$password',$telephone,'$mail','$privilege','$etat','$statut')";
        
        $requete=$insert.$values;
        $execute=mysqli_query($connexionServeur,$requete);
         
        ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>GESTION DES REUNIONS</title>
	
	<style>

	/*
		CENTRER ET SUPERPOSER
	*/

	.box {
		display: flex;
		justify-content: center;
		align-items: center;
		min-height: 100vh;
	}

	.modal {
		position: fixed;

		opacity: 0;
		visibility: hidden;

		transition: 0.4s;
	}

	/*
		PLACE A LA MAGIE
	*/

	button:focus + .modal {
		opacity: 1;
		visibility: visible;
	}
	


	/*
		Style pour rendre l'effet sympa.
		Pas nécessaire pour créer le modal.
	*/
		body {
			margin: 0;
			padding: 0;
			background-color: #EEEEEE;
			color: #1d1d1d;
		}
		.box {
			font-family: 'Roboto', sans-serif;
		}
		button {
			width: 33%;
			background-color: #2196F3;
			font-family: 'Roboto', sans-serif;
			font-size: 24px;
			border: none;
			border-radius: 4px;
			color: white;
			padding: 10px;
			cursor: pointer;
		}
		.modal {
			width: 50%;
			height: 70vh;

			display: flex;
			justify-content: center;
			align-items: center;

			background-color: white;
			border-radius: 4px;
			box-shadow: 0px 30px 70px rgba(0,0,0,0.3);
		}
		span {
	  	position: absolute;
	  	bottom: 30px;
	  	right: 50px;
	  	font-size: 20px;
	  	cursor: pointer;
	  	font-weight: bold;
	  	color: #2196F3;
	  }
	  span:hover {
	    color: #2b8fdb;
	  }
    p {
  font-family: 'Tangerine', serif;
  font-size: 30px;
  text-shadow: 4px 4px 4px #aaa;
}
	</style>

</head>

<body>
	<div class="box">
        
		<button>
            <?php 
                if($execute)
                    echo "Succes";
                else
                    echo "Echec";
            ?>
        </button>
		<div class="modal">
			<span><a href="../index.php?page=gestionUser">Retour</a></span>
        <p>
        <?php
            if($execute)
            {
                echo "Username  = $username<br>";
                echo "Password  = $password<br>";
                if($privilege !="admin")
                    echo "Privilege = Utilisateur<br>";
                else
                    echo "Privilege = Administrateur<br>";
                echo "Etat      = Actif<br>";
            }
            else
                echo "Les donnees renseignees sont corrompues";
        ?>
        </p>
		</div>
	</div>
</body>
</html>


<?php
    }
    else
        exit;
?>
 