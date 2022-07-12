<?php

 if(isset($_GET['id']) and !empty($_GET['id']))
 {
    $idReunion=$_GET['id'];
    $idReunion=getWebId($idReunion,"Reunion","decrypted");
?>
<center>
<table border="3" cellpadding="10">
            <thead>
                <tr>
                    <td colspan="<?php echo 4 ?>">
                            <center>
                                <a id="button" class="btn btn-primary" onclick="document.getElementById('modal-wrapper').style.display='block'" >
                                    <center><i class="fa fa-plus-circle fa-2x"></i></center>
                                </a>
                            </center>  
                    </td>
                    <td><a href="index.php?page=editReunion&&id=<?= getWebId($idReunion,"Reunion","crypted")?>&&src=Reunion" title="Retour en arriere" class="btn btn-warning" style="heigth:200px">Back</a></td>
                </tr>
                <tr>
<!--                    <th>N°</th>-->
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Telephone</th>
                    <th><center>Email</center></th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                 <?php
                    $idCompte=$_SESSION['idcompte'];
//                    Avoir les donnees relatives a un participant d'un compte
                    $select="select idParticipant,NomParticipant,PrenomParticipant,TelephoneParticipant,EmailParticipant
                             from participant p,compte c
                             where p.idCompte=c.idCompte and p.idCompte=$idCompte
                             order by NomParticipant 
                            ";
                    $resultat=mysqli_query($connexionServeur,$select);
//                    $nbrPart=1;
                    while($line=mysqli_fetch_row($resultat))
                    {
                        echo"<tr>";
                        for($i=1;$i<6;$i++)
                        {
                            if($i<5)
                            {
                                echo"<td><center class='form-control'>$line[$i]</center></td>";
                            }
                            else
                            {
                                $idParticipant=$line[0];
                                $selectAdd="select PR.idParticipant
                                            from Participant P,ParticipantReunion PR, Reunion R
                                            where PR.idParticipant=P.idParticipant and 
                                                  PR.idReunion=R.idReunion and 
                                                  P.idParticipant=$idParticipant and
                                                  R.idReunion=$idReunion
                                           ";
                                $execAdd=mysqli_query($connexionServeur,$selectAdd);
                                $add=mysqli_num_rows($execAdd);
                                if($add)
                                { 
                            ?>
                                <td><center class='form-control'>
                                    <a title="Retirer" href="php/DirectaddParticipantReunion.php?idP=<?= getWebId($line[0],"Participant","crypted")?>&&idR=<?= getWebId($idReunion,"Reunion","crypted")?>&&act=<?=$add ?> "><i class="fa fa-minus"></i></a> 
                                </center></td> 
                           <?php
                                }
                                else
                                { ?>
                                   <td><center class='form-control'>
                                    <a title="Ajouter" href="php/DirectaddParticipantReunion.php?idP=<?= getWebId($line[0],"Participant","crypted")?>&&idR=<?= getWebId($idReunion,"Reunion","crypted")?>&&act=<?=$add ?> "><i class="fa fa-plus"></i></a> 
                                </center></td> 
                               <?php }    
                            }
                        }
                        echo"</tr>";
                    }
                ?>
            </tbody>
            <tfoot>     
                <tr>
                    <td colspan="<?php echo 5 ?>">
                            <center>
                                <a id="button" class="btn btn-primary" onclick="document.getElementById('modal-wrapper').style.display='block'" >
                                    <center><i class="fa fa-plus-circle fa-2x"></i></center>
                                </a>
                            </center>  
                    </td>
                </tr>
            </tfoot>
</table>
</center> 
<?php 
    include "liens/participant_NBR.php";
 }
?>

