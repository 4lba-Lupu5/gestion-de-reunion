<center>
<a href="index.php?page=home" class="btn btn-secondary" style="width: 15%">Retour</a><br><br>
<table border="3" cellpadding="10">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                 <?php
                    $select="select p.idParticipant,NomParticipant,PrenomParticipant,TelephoneParticipant,EmailParticipant 
							 from Participant p,compte c
							 where p.idCompte=c.idCompte and p.idCompte=$idCompte
							 order by NomParticipant";				
				
                    $resultat=mysqli_query($connexionServeur,$select);
                    while($line=mysqli_fetch_row($resultat))
                    {
                        echo"<tr>";
                        for($i=1;$i<6;$i++)
                        {
                            if($i<5)
//                                echo"<td>$line[$i]</td>";
                                echo"<td><center class='form-control'>$line[$i]</center></td>";
                            else
                            {?>
                                <td><center class='form-control'>
<!--                                <a class="modifie" title="Modifier <?php //$line[1].' '.$line[2] ?>" href="index.php?page=editProfile&&id=<?php //getWebId($line[0],"Compte","crypted")?>"><i class='fa fa-edit fa-1x'></i></a>-->
                                <a class="supprime" title="Supprimer <?= $line[1].' '.$line[2] ?>" href="php/deleteItem.php?id=<?= getWebId($line[0],"Participant","crypted")?>&&src=Participant&&page=listeOptionReunion" onclick="return confirm('Confirmer la suppression du Participant de <?= $line[1].' '.$line[2]?>');"><i class='fa fa-trash-o fa-1x'></i></a> 
                                </center></td> 
                           <?php }
                        }
                        echo"</tr>";
                    }
                ?>
            </tbody>
            <tfoot>     
                <tr>
                    <td colspan="7"></td> 
                </tr>
            </tfoot>
</table>
    </center> 

