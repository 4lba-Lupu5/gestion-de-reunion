<?php
    $serveur="127.0.0.1";
    $bd="reunions";
    $user="root";
    $pwd="";
    $connexionServeur=mysqli_connect($serveur,$user,$pwd);
    $connexionBD=mysqli_select_db($connexionServeur,$bd);    
?>