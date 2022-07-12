<center>
    <a href="index.php?page=home" class="btn btn-secondary" style="width: 15%">Retour</a><br><br>
<table border="3" cellpadding="10">
            <thead>
                <tr>
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
                            ?>      
                                <td><center class='form-control'>
                                <a class="supprime" title="Supprimer <?= $line[1] ?>" href="php/deleteItem.php?id=<?= getWebId($line[0],"Ordre","crypted")?>&&src=Ordre&&page=listeOptionReunion" onclick="return confirm('Confirmer la suppression de Ordre de <?= $line[1].' '.$line[2]?>');"><i class='fa fa-trash-o fa-1x'></i></a> 
                                </center></td>    
                            <?php 
                            }     
                        }
                        echo"</tr>";
                    }
                  ?>
            </tbody>
            <tfoot>     
                <tr>
                </tr>
            </tfoot>
</table>
</center> 

