<center>
<table border="3" cellpadding="10">
<!--            <caption><h2><u>BOARD</u></h2></caption>-->
            <thead>
                <tr>
<!--                    <th>Profil</th>-->
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Username</th>
<!--                    <th>Telephone</th>-->
                    <th>Email</th>
<!--                    <th>Sexe</th>-->
<!--                    <th>Privilege</th>-->
<!--                    <th>Etat</th>-->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                 <?php
                    //$select="select avatar,idCompte,Nom,Prenom,username,TelephoneCompte,EmailCompte,sexe,privilege,etatCompte from Compte";
                    $select="select idCompte,Nom,Prenom,username,EmailCompte,etatcompte from Compte order by idCompte";
                    $resultat=mysqli_query($connexionServeur,$select);
                    while($line=mysqli_fetch_row($resultat))
                    {
                        echo"<tr>";
                        for($i=0;$i<6;$i++)
                        {
                            if($i<5)
                                echo"<td>$line[$i]</td>";
                            else
                            {?>
                                <td>
                                <a class="modifier" href="index.php?page=editProfile&&id=<?= getWebId($line[0],"Compte","crypted")?>"><i class='fa fa-edit fa-1x'></i></a>
                                <a class="supprime" href="php/deleteItem.php?id=<?= getWebId($line[0],"Compte","crypted")?>&&src=Compte&&page=gestionUser" onclick="return confirm('Confirmer la suppression du compte de <?= $line[1].' '.$line[2]?>');"><i class='fa fa-trash-o fa-1x'></i></a>
                                <a class="archive" href="php/accountStatut.php?id=<?= getWebId($line[0],"Compte","crypted")?>&&etat=<?= $line[5] ?>&&page=gestionUser">        
                                    <label class="switch">
                                        <input type="checkbox" <?php if($line[5]=='active'){ echo 'checked="checked"';}?> > 
                                        <span class="slider round"></span>
                                    </label>    
                                </a> 
                                </td> 
                           <?php }
                        }
                        echo"</tr>";
                    }
                ?>
            </tbody>
            <tfoot>     
                <tr>
                    <td colspan="<?php echo $i ?>"><a href="index.php?page=home"><center><u>Retour sur l'accueil</u></center></a></td>
                </tr>
            </tfoot>
</table>
    </center> 