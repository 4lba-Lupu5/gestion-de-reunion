<?php
    session_start();
    $verif=true;
    if((!isset($_SESSION['login'])) || empty($_SESSION['login']))
    {
        echo'<p>Vous devez vous <a href="index.php">connecter</a>.</p>'."\n";
        exit();
    }
 
?>
 