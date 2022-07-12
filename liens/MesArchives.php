<?php
    $rootVue=false;
    $compte=$_SESSION['idcompte'];
    $username=$_SESSION['login'];
    $root=array("Prosper","kevin");
    $ReunionAll="Select count(idReunion) from Reunion";
    $Reunion="Select count(idReunion) from Reunion R,Compte C where R.idCompte=C.idCompte and C.idCompte=$compte";
    $exec_reunion=mysqli_query($connexionServeur,$Reunion);
    $Reunion=mysqli_fetch_row($exec_reunion);

    $exec_reunionAll=mysqli_query($connexionServeur,$ReunionAll);
    $ReunionAll=mysqli_fetch_row($exec_reunionAll);
    $reste=$ReunionAll[0]-$Reunion[0];
    if($_SESSION['privilege']!="user" and in_array($username,$root))
        $rootVue=true;
?>
<center>
<a href="index.php?page=home" class="btn btn-secondary" style="width: 15%">Retour</a><br><br>
<table border="3" cellpadding="10">
            <thead>
                <tr>
                    <th>Proprietaire</th>
                    <th>Indicatif</th> 
                    <th>Jour</th>
                    <th>Heure</th>
                    <th>P.V</th>
                    <th>Type</th>
                    <th>Priorite</th>
                    <th>Etat</th>
                    <th>Mode</th>
                    <th>Nb Ordre</th>
                    <th>Nb Part</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                 <?php
                    if($rootVue)
                    {
                        $select="select R.idReunion,C.username,NbrOrdre,NbrParticipant,JourReunion,HeureReunion,PvReunion,T.LibelleTypeReunion,P.LibellePrioriteReunion,E.LibelleEtatReunion,M.LibelleModeReunion 
                        from Reunion R,TypeReunion T,PrioriteReunion P,EtatReunion E,ModeReunion M,Compte C
                        where R.idTypeReunion=T.idTypeReunion and R.idPrioriteReunion=P.idPrioriteReunion and R.idEtatReunion=E.idEtatReunion and R.idModeReunion=M.idModeReunion and R.idCompte=C.idCompte and E.idEtatReunion=3
                        order by jourReunion desc";
                    }
                    else
                    {
                        $select="select R.idReunion,C.username,IndicatifReunion,JourReunion,HeureReunion,PvReunion,T.LibelleTypeReunion,P.LibellePrioriteReunion,E.LibelleEtatReunion,M.LibelleModeReunion 
                        from Reunion R,TypeReunion T,PrioriteReunion P,EtatReunion E,ModeReunion M,Compte C
                        where R.idTypeReunion=T.idTypeReunion and R.idPrioriteReunion=P.idPrioriteReunion and R.idEtatReunion=E.idEtatReunion and R.idModeReunion=M.idModeReunion and R.idCompte=C.idCompte and C.idCompte=$compte and E.idEtatReunion=3
                        order by jourReunion desc";
                    }
                
                    $resultat=mysqli_query($connexionServeur,$select);
//                    var_dump($resultat);
                    while($line=mysqli_fetch_row($resultat))
                    {
                        if($line[1]==$_SESSION['login'])
                            $line[1]="Vous";
                        
//                        Gestion du nombre de participant
                        $idReunion=$line[0];
                        $selectParticipant="select PR.idReunion
                                      from Reunion R, Participant P, ParticipantReunion PR
                                      where PR.idReunion=R.idReunion and PR.idParticipant=P.idParticipant and R.idReunion=$idReunion;
                                     ";
                        $execParticipant=mysqli_query($connexionServeur,$selectParticipant);
                        $nbrParticipant=mysqli_num_rows($execParticipant);
//                        Gestion du nombre d'ordre
                        $selectOrdre="select RO.idReunion
                                      from Reunion R, Ordre O, OrdreReunion RO
                                      where RO.idReunion=R.idReunion and RO.idOrdre=O.idOrdre and 
                                      R.idReunion=$idReunion;
                                     ";
                        $execOrdre=mysqli_query($connexionServeur,$selectOrdre);
                        $nbrOrdre=mysqli_num_rows($execOrdre);
                       
                        
                        echo"<tr>";
                        for($i=1;$i<13;$i++)
                        {
                            if($i<10)
                            {
                                if($i!=5)
                                {
                                    if(!in_array($i,array(3)))
                                        echo"<td>$line[$i]</td>";
                                    else
                                        echo"<td><center>$line[$i]</center></td>";
                                }
                                else
                                {
                                 ?>
                                    <td><a class="charge" title="Voir le Proces Verbal etablit" href="<?= $line[5] ?>" ><i class="fa fa-cloud-download"></i></a></td>
                                  <?php
                                }
                            }
                            else
                            {
                              if($i==10)
                                echo"<td><center>$nbrOrdre</center></td>";
                              else if($i==11)
                                   echo"<td><center>$nbrParticipant</center></td>";
                                else
                                {
                            ?>
                                <td><center>
                                <a class="archive" title="Desarchiver la Reunion" href="php/Archiver_Desarchiver.php?id=<?= getWebId($line[0],"Reunion","crypted")?>&&page=listeOptionReunion&&src=archive"><i class="fa fa-archive"></i></a>
                                <a class="supprime" title="Supprimer la Reunion" href="php/deleteItem.php?id=<?= getWebId($line[0],"Reunion","crypted")?>&&src=Reunion&&page=listeOptionReunion" onclick="return confirm('Confirmer la suppression la reunion <?php //$line[1].' '.$line[2]?>');"><i class='fa fa-trash-o fa-1x'></i></a>
                                </center></td> 
                           <?php 
                                }
                            }
                        }
                        echo"</tr>";
                    }
                ?>
            </tbody>
            <tfoot>     
                <tr>
                    <td colspan="<?php echo 13 ?>"><a href="index.php?page=#"><center><u>   </u></center></a></td>
                </tr>
            </tfoot>
</table>
</center> 