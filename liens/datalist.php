<?php
    include "php/configure.php";
    $etat="Select idEtatReunion,LibelleEtatReunion from etatReunion where LibelleEtatReunion='Attente';";
    $priorite="select idPrioriteReunion,LibellePrioriteReunion from prioriteReunion;";
    $mode="select idModeReunion,LibelleModeReunion from modeReunion;";
    $type="select idTypeReunion,LibelleTypeReunion from typeReunion;";

    $exec_etat=mysqli_query($connexionServeur,$etat);
    $exec_priorite=mysqli_query($connexionServeur,$priorite);
    $exec_mode=mysqli_query($connexionServeur,$mode);
    $exec_type=mysqli_query($connexionServeur,$type);

?>

<datalist id="EtatReunion">
    <?php
        while($data_etat=mysqli_fetch_row($exec_etat))
        {
        ?>
            <option value="<?php echo $data_etat[1];?>"><?php echo "$data_etat[1]";?></option>
        <?php
        }
    ?>
</datalist>

<datalist id="PrioriteReunion">
    <?php
        while($data_priorite=mysqli_fetch_row($exec_priorite))
        {
        ?>
            <option value="<?php echo $data_priorite[1];?>"><?php echo "$data_priorite[1]";?></option>
        <?php
        }
    ?>
</datalist>

<datalist id="ModeReunion">
    <?php
        while($data_mode=mysqli_fetch_row($exec_mode))
        {
        ?>
            <option value="<?php echo $data_mode[1];?>"><?php echo "$data_mode[1]";?></option>
        <?php
        }
    ?>
</datalist>

<datalist id="TypeReunion">
    <?php
        while($data_type=mysqli_fetch_row($exec_type))
        {
        ?>
            <option value="<?php echo $data_type[1];?>"><?php echo "$data_type[1]";?></option>
        <?php
        }
    ?>
</datalist> 
   