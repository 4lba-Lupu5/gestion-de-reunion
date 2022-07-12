<?php
    session_start();
    require_once("configure.php");
    include "functions.php";

    $login=$_SESSION['login'];
    $update="update Compte set statutConnexion=0 where username='$login'";
    $exec=mysqli_query($connexionServeur,$update);
    if($exec)
        header("location:../index.php");

    $_SESSION= array();
    session_destroy();

?>