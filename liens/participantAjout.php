<?php 
 $test=false;
  if(isset($_GET['id']) and !empty($_GET['id']))
  {
    $idReunion=$_GET['id'];
    if(isset($_POST['nbrParticipant']) and !empty($_POST['nbrParticipant']))
    {
        $test=true;
        $nbr=$_POST['nbrParticipant'];
    }
    if($test!=false)
    {
        if($nbr>0)
        {
            $idReunion=getWebId($idReunion,"Reunion","decrypted");
 ?>

<center>
<form method="post" action="php/addParticipant.php?nbr=<?=$nbr ?>&&id=<?=getWebId($idReunion,"Reunion","crypted");?>">
<table border="3" cellpadding="10">
    <thead>
        <tr>
<!--          <th>-</th>-->
          <th>Odr</th>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Telephone</th>
          <th>Email</th>
        </tr>
    </thead>
    <tbody>
        
    <?php
        $compte=$_SESSION['idcompte'];
        for($i=0;$i<$nbr;$i++)
        {
        ?>
         <tr>
            <td><center class="form-control"><?= $i+1 ?></center></td>
            <td><input class="form-control" type="text" name="nom<?= $i+1 ?>" placeholder="Nom"></td>
            <td><input class="form-control" type="text" name="prenom<?= $i+1 ?>" placeholder="Prenom"></td>
            <td><input class="form-control" type="tel" name="telephone<?= $i+1 ?>" placeholder="Telephone"></td>
            <td><input class="form-control" type="mail" name="mail<?= $i+1 ?>" placeholder="E-mail"></td>
         </tr> 
        <?php
        } 
        ?>
               
    </tbody>
    <tfoot> 
        <tr>
            <td colspan="5">
                <input type="submit" name="save" value="SAUVEGARDER" class="btn btn-success" id="button">
            </td>
        </tr>
    </tfoot>
</table>
</form>
</center>

<?php
    }
    else
        echo "<a href='index.php?page=participe&&id=$idReunion'>Le nombre choisit doit etre supperieur à 0</a>";
}
else
{
    echo "<a href='index.php?page=participe&&id=$idReunion'>Aucun nombre choisit</a>";
}
}
?>