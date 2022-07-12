<?php

 if(isset($_GET['id'],$_GET['src'],$_GET['page']) and !empty($_GET['id']) and !empty($_GET['src']) and !empty($_GET['page']))
 {
    $idLine=$_GET['id'];
    $table=$_GET['src'];
    $page=$_GET['page'];
    $idLine=getWebId($idLine,$table,"decrypted");
    $select="select JourReunion,HeureReunion,PvReunion,IndicatifReunion,T.LibelleTypeReunion,P.LibellePrioriteReunion,E.LibelleEtatReunion,M.LibelleModeReunion,NbrOrdre,NbrParticipant,R.idTypeReunion,R.idPrioriteReunion,R.idEtatReunion,R.idModeReunion,R.idReunion              
    from Reunion R,TypeReunion T,PrioriteReunion P,EtatReunion E,ModeReunion M
    where R.idTypeReunion=T.idTypeReunion and R.idPrioriteReunion=P.idPrioriteReunion and R.idEtatReunion=E.idEtatReunion and R.idModeReunion=M.idModeReunion and R.idReunion=$idLine";
        
    $exec=mysqli_query($connexionServeur,$select);
    $line=mysqli_fetch_row($exec); 
    $jour=$line[0];
    $heure=$line[1];
    $indicatif=$line[3];
    $type=$line[4];
    $priorite=$line[5];
    $etat=$line[6];
    $mode=$line[7];
     
    $idReunion=$line[14];
    $idType=$line[10];
    $idMode=$line[13];
    $idEtat=$line[12];
    $idPriorite=$line[11];
     
     
//        Requetes sql pour selectionner les correspondances des donnees du formulaire dans la BD
    $Retat="Select idEtatReunion,LibelleEtatReunion from etatReunion where LibelleEtatReunion != '$etat'";
    $Rpriorite="select idPrioriteReunion,LibellePrioriteReunion from prioriteReunion where LibellePrioriteReunion !='$priorite';";
    $Rmode="select idModeReunion,LibelleModeReunion from modeReunion where LibelleModeReunion !='$mode';";
    $Rtype="select idTypeReunion,LibelleTypeReunion from typeReunion where LibelleTypeReunion !='$type';";

//        Execution des differentes requetes
    $exec_etat=mysqli_query($connexionServeur,$Retat);
    $exec_priorite=mysqli_query($connexionServeur,$Rpriorite);
    $exec_mode=mysqli_query($connexionServeur,$Rmode);
    $exec_type=mysqli_query($connexionServeur,$Rtype);
              
?>


<div class="container-fluid">
        <div class="row"> 
                  
            <form class="col-sm-7 col-md-7 col-lg-7 wraphome" action="php/updateReunion.php" method="POST" enctype="multipart/form-data">
                    <h2><u>MISE A JOUR </u></h2>
                        <div class="container-fluid">
                                <div class="row">
                                    <form class="col-sm-12 col-md-12 col-lg-12" action="#" method="POST">
                                            <input type="hidden" name="idreunion" class="form-control" value="<?= $idReunion ?>" readonly>
                                        
                                            <label class="col-sm-2 col-md-2 col-lg-2">Jour</label>
                                            <div class="form-group col-sm-10 col-md-10 col-lg-10">
                                                    <input type="date" name="jourreunion" class="form-control" value="<?= $jour ?>" required>
                                            </div>
                                        
                                            <label class="col-sm-2 col-md-2 col-lg-2">Heure</label>
                                            <div class="form-group form-group col-sm-10 col-md-10 col-lg-10">
                                                    <input type="time" name="heurereunion" class="form-control" value="<?= $heure ?>"required>
                                            </div>
                                        
                                            <label class="col-sm-2 col-md-2 col-lg-2">Indicatif</label>
                                            <div class="form-group form-group col-sm-9 col-md-9 col-lg-9">
                                                    <input type="text" name="indicatif" class="form-control" placeholder="Indicatif de Reunion" style="height: 45px;" value="<?= $indicatif ?>">
                                            </div>
                                        
                                            <label class="col-sm-2 col-md-2 col-lg-2">Mode</label>
                                            <select name="modereunion" class="form-control col-sm-9 col-md-9 col-lg-9">
                                                    <option value="<?php echo $idMode;?>"><?php echo $mode;?></option>
                                                    <?php
                                                    while($line_mode=mysqli_fetch_row($exec_mode))
                                                    {
                                                    ?>
                                                        <option value="<?php echo $line_mode[0];?>"><?php echo $line_mode[1];?></option>
                                                    <?php
                                                    }
                                                    ?>
                                            </select>
                                            <br><br><br><br>
                                            <label class="col-sm-2 col-md-2 col-lg-2">Type</label>
                                            <select name="typereunion" class="form-control col-sm-9 col-md-9 col-lg-9">
                                                    <option value="<?php echo $idType;?>"><?php echo $type;?></option>
                                                    <?php
                                                    while($line_type=mysqli_fetch_row($exec_type))
                                                    {
                                                    ?>
                                                        <option value="<?php echo $line_type[0];?>"><?php echo $line_type[1];?></option>
                                                    <?php
                                                    }
                                                    ?>
                                            </select> 
                                        
                                            <label class="col-sm-2 col-md-2 col-lg-2">Priorite</label>
                                            <select name="prioritereunion" class="form-control col-sm-9 col-md-9 col-lg-9">
                                                    <option value="<?php echo $idPriorite;?>"><?php echo $priorite;?></option>
                                                    <?php
                                                    while($line_priorite=mysqli_fetch_row($exec_priorite))
                                                    {
                                                    ?>
                                                        <option value="<?php echo $line_priorite[0];?>"><?php echo $line_priorite[1];?></option>
                                                    <?php
                                                    }
                                                    ?>
                                            </select>
                                    
                                            <label class="col-sm-2 col-md-2 col-lg-2">Etat</label>
                                            <select name="etatreunion" class="form-control col-sm-9 col-md-9 col-lg-9">
                                                    <option value="<?php echo $idEtat;?>"><?php echo $etat;?></option>
                                                    <?php
                                                    while($line_etat=mysqli_fetch_row($exec_etat))
                                                    {
                                                    ?>
                                                        <option value="<?php echo $line_etat[0];?>"><?php echo $line_etat[1];?></option>
                                                    <?php
                                                    }
                                                    ?>
                                            </select>
                                    
                                        <div class="group-form">
                                            <center>
                                            <input type="hidden" name="MAX_FILE_SIZE" value="999999999999999999999999" required>
                                            <label>Charger un PV:</label>
                                            <input type="file" name="pv">
                                            </center>
                                        </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6" style="padding-top:10px;">
                                                <center>
                                                    <a class="btn btn-primary" style="padding-top:5px;width: 80%" href="index.php?page=participe&&id=<?= getWebId($idLine,"Reunion","crypted")?>">
                                                    <center><i class="fa fa-plus-circle fa-2x"></i> PARTICIPANTS</center>
                                                    </a>
                                                </center>
                                            </div>
                                        
                                            <div class="col-sm-6 col-md-6 col-lg-6" style="padding-top:10px;">
                                                <center>
                                                    <a class="btn btn-secondary" style="padding-top:5px;width: 80%" href="index.php?page=ordre&&id=<?= getWebId($idLine,"Reunion","crypted")?>">
                                                    <center><i class="fa fa-plus-circle fa-2x"></i> ORDRES</center>
                                                    </a>
                                                </center>
                                            </div>
                                        
                                            <div class="container" style="margin-bottom: 20px; margin-top:30px">
                                                <center> 
                                                    <input type="submit" class="btn btn-danger " name="modifier" value="MODIFIER" style="width: 30%;">
                                                    <input type="reset" class="btn btn-warning" name="effacer" value="EFFACER" style="width: 30%;">
                                                    <a class="btn btn-success" href="index.php?page=home" style="width: 30%;">RETOUR</a>
                                                </center>
                                            </div>
                                    </form>
                                </div>
                        </div> 
                 <?php include "liens/datalist.php" ?>
            </form>
        </div>
    <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 gridhome">
                <?php //include "liens/ReunionBoard.php" ?>
                <?php //include "liens/test.php" ?>
            </div>
        </div>
<?php 
 }
?>