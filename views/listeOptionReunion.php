<?php 
    $src=$_GET['src'];
    $srcArray=array("archive","participant","ordre","reunion");
    switch ($src)
    {
        case 'archive':$board="Liste des Archives";
                       $lien="MesArchives";
                       break;
        case 'participant':$board="Liste des Participants";
                           $lien="MesParticipants";
                           break;
        case 'reunion':$board="Liste de toutes les Reunions";
                       $lien="allReunions";
                       break;
        case 'ordre':$board="Liste des Ordres";
                     $lien="MesOrdres";
                     break;
        default :$board=" Error 404 file not found";
    }
?>
<div class="container-fluid">
    <div class="col grid">
        <caption><h2><u><?= $board ?></u></h2></caption>
        <?php 
            if(in_array($src,$srcArray))
                include "liens/$lien.php" 
        ?>
    </div>
</div>


