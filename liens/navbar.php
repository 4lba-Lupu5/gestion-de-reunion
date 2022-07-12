<div>
      <nav class="navbar navbar-expand-lg navbar-light  rounded-thumbnail navbar-fixed-top">
          
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample09">
            <a  href="index.php?page=home"><i class="fa fa-home fa-2x"></i></a>
            
            
           <?php  
            if($_SESSION['privilege']!="user"){
            ?> 
            <div style="margin-left:2%;margin-right:0%;"></div>
<!--            Liste deroulante elle s'affichera uniquement que s'il s'agit d'un compte administrateur-->
            <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ADMINISTRER</a>
              <div class="dropdown-menu" aria-labelledby="dropdown09">
                <a class="dropdown-item" href="index.php?page=gestionUser">COMPTES</a>
<!--                <a class="dropdown-item" href="#">REUNIONS</a>-->
<!--                <a class="dropdown-item" href="#">ETAT</a>-->
              </div>
            </li>
          </ul>
          <div style="margin-left:25%;margin-right:0%;"></div>
         <?php 
            } 
            else{
            ?> 
            <div style="margin-left:45%;margin-right:0%;"></div>
          <?php 
            }
            $select="select count(idCompte) from Compte where statutConnexion=1";
            $resultat=mysqli_query($connexionServeur, $select);
            $line=mysqli_fetch_row($resultat);
            
            echo "<button class='btn btn-success connected'>En ligne</button> ";
          ?>
           
          <form class="form-inline my-2 my-md-0">
            <input class="form-control" type="text" placeholder="Rechercher" aria-label="Search">
          </form>
          <div style="border-left: 3px solid black;padding-left:3%;">
              
           <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $_SESSION['avatar']; ?>" class="rounded-circle avatar"></a>
              <div class="dropdown-menu" aria-labelledby="dropdown09">
                <a class="dropdown-item" onclick="document.getElementById('modal-wrapper0').style.display='block'"><i class="fa fa-user-md"></i>    Profil</a>
                <a class="dropdown-item" onclick="return confirm('Voulez vous vraiment quitter?');" href="php/logout.php"><i class="fa fa-sign-out"></i>   Se déconnecter</a>
              </div>
            </li>
          </ul>   
              
          </div>
        </div>
      </nav>
</div>  
<?php include "liens/editCompte.php"; ?>
