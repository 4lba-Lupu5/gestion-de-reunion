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
                    <td colspan="<?php echo 1 ?>">
                            <center>
                                <a id="buttonOrdre" class="btn btn-primary" onclick="document.getElementById('modal-wrapper').style.display='block'" >
                                    <center><i class="fa fa-plus-circle fa-2x"></i></center>
                                </a>
                            </center>  
                    </td>
                    <td><a href="index.php?page=editReunion&&id=<?= getWebId($idReunion,"Reunion","crypted")?>&&src=Reunion" title="Retour en arriere" class="btn btn-warning" style="heigth:200px">Back</a></td>
                </tr>
                <tr>
<!--                    <th>N°</th>-->
                    <th style="width:550px"><center>Intitulé de l'ordre </center></th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                 <?php
                    $idCompte=$_SESSION['idcompte'];
                    $select="select idOrdre,LibelleOrdre,O.idCompte 
                             from Ordre O,compte c
                             where O.idCompte=c.idCompte and O.idCompte=$idCompte
                             order by LibelleOrdre 
                            ";
                    $resultat=mysqli_query($connexionServeur,$select);
                    while($line=mysqli_fetch_row($resultat))
                    {
                        echo"<tr>";
                        for($i=1;$i<3;$i++)
                        {
                            if($i<2)
                                echo"<td><pre class='form-control'>$line[$i]</pre></td>";
                            else
                            {
                                $idOrdre=$line[0];
                                $selectAdd="select O.idOrdre
                                            from Ordre O,OrdreReunion RO, Reunion R
                                            where RO.idOrdre=O.idOrdre and 
                                                  RO.idReunion=R.idReunion and 
                                                  O.idOrdre=$idOrdre and
                                                  R.idReunion=$idReunion
                                           ";
                                $execAdd=mysqli_query($connexionServeur,$selectAdd);
                                $add=mysqli_num_rows($execAdd);
                                if($add)
                                { 
                            ?>
                                <td><center class='form-control'>
                                    <a title="Retirer" href="php/DirectaddOrdreReunion.php?idO=<?= getWebId($line[0],"Participant","crypted")?>&&idR=<?= getWebId($idReunion,"Reunion","crypted")?>&&act=<?=$add ?> "><i class="fa fa-minus"></i></a> 
                                </center></td> 
                           <?php
                                }
                                else
                                { ?>
                                   <td><center class='form-control'>
                                    <a title="Ajouter" href="php/DirectaddOrdreReunion.php?idO=<?= getWebId($line[0],"Participant","crypted")?>&&idR=<?= getWebId($idReunion,"Reunion","crypted")?>&&act=<?=$add ?> "><i class="fa fa-plus"></i></a> 
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
                    <td colspan="<?php echo 2 ?>">
                            <center>
                                <a id="buttonOrdre" class="btn btn-primary" onclick="document.getElementById('modal-wrapper').style.display='block'" >
                                    <center><i class="fa fa-plus-circle fa-2x"></i></center>
                                </a>
                            </center>  
                    </td>
                </tr>
            </tfoot>
</table>
</center> 
<?php 
    include "liens/ordre_NBR.php";
 }
?>

