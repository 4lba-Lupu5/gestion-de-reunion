<div class="container-fluid">
        <div class="row"> 
                
                    <div class="col-sm-1 col-md-1 col-lg-1"></div>
            <form class="col-sm-7 col-md-7 col-lg-7 wraphome" action="php/createReunion.php" method="POST">
                    <h2><u>PLANIFIER UNE REUNION</u></h2>
                        <div class="container-fluid">
                                <div class="row">
                                    <form class="col-sm-12 col-md-12 col-lg-12" action="#" method="POST"> 
<!--
                                            <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                                    <label>Ordre</label>
                                                    <input type="text" name="ordre" class="form-control" placeholder="Ordre" required>
                                            </div>
-->
                                            <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                                    <label>Jour</label>
                                                    <input type="date" name="jourreunion" class="form-control" placeholder="Jour de la Reunion" required>
                                            </div>
                                            <div class="form-group form-group col-sm-2 col-md-2 col-lg-2">
                                                    <label>Heure</label>
                                                    <input type="time" name="heurereunion" class="form-control" placeholder="Heure de la Reunion" required>
                                            </div>
                                            
                                            <div class="form-group form-group col-sm-6 col-md-6 col-lg-6">
                                                    <label>Mode</label>
                                                    <input list="ModeReunion" name="modereunion" class="form-control" placeholder="Mode de la Reunion" required>
                                            </div>
                                        
                                        
                                            <div class="form-group form-group col-sm-6 col-md-6 col-lg-6">
                                                    <label>Type</label>
                                                    <input list="TypeReunion" name="typereunion" class="form-control" placeholder="Type de la Reunion" required>
                                            </div>
                                            <div class="form-group form-group col-sm-6 col-md-6 col-lg-6">
                                                    <label>Priorite</label>
                                                    <input list="PrioriteReunion" name="prioritereunion" class="form-control" placeholder="Priorite de la Reunion" required>
                                            </div>
                                            
                                            <div class="form-group form-group col-sm-8 col-md-8 col-lg-8">
                                                    <label>Motif</label>
                                                    <input type="text" name="indicatif" class="form-control" placeholder="Motif de reunion" style="height: 45px;">
                                            </div>
                                            
                                            <div class="form-group form-group col-sm-4 col-md-4 col-lg-4">
                                                    <label>Etat Actuel</label>
                                                    <input type="text" name="etatreunion" class="form-control" value="Attente" readonly style="height: 45px; width: 100%">
<!--                                                    <input list="EtatReunion" name="etatreunion" class="form-control" placeholder="EtatReunion" required>-->
                                            </div>
                                    

<!--
                                            <div class="col-sm-6 col-md-6 col-lg-6" style="padding-top:5px;">
                                                <center>
                                                    <a class="btn btn-primary" style="padding-top:5px;width: 70%" href="index.php?page=participe">
                                                    <center><i class="fa fa-plus-circle fa-2x"></i> PARTICIPANTS</center>
                                                    </a>
                                                </center>
                                            </div>
-->
                                        
                                            <div class="container" style="margin-bottom: 20px; margin-top:30px">
                                                <center> 
                                                    <input type="submit" class="btn btn-success" name="enregistrer" value="ENREGISTRER" style="width: 30%;">
                                                    <input type="reset" class="btn btn-warning" name="effacer" value="EFFACER" style="width: 30%;;">
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
                <?php include "liens/ReunionBoard.php" ?>
                <?php //include "liens/test.php" ?>
            </div>
        </div>
</div>