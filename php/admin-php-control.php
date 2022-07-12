<?php
    require("session-control.php");

    if(isset($verif))
    {
        if ($_SESSION['privilege']!="admin")
        {
            echo'<p><a href="../index.php?page=home">Vous n\'avez pas les privileges requis</a></p><br>Contactez votre administrateur.';
            exit(); 
        }
    }  
    else
        echo "not exist";
?> 