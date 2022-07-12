<?php 
 $test=false;
  if(isset($_GET['id']) and !empty($_GET['id']))
  {
    $idReunion=$_GET['id'];
    if(isset($_POST['nbrOrdre']) and !empty($_POST['nbrOrdre']))
    {
        $test=true;
        $nbr=$_POST['nbrOrdre'];
    }
    if($test!=false)
    {
        if($nbr>0)
        {
            $idReunion=getWebId($idReunion,"Reunion","decrypted");
 ?>

<center>
<form method="post" action="php/addOrdre.php?nbr=<?=$nbr ?>&&id=<?=getWebId($idReunion,"Reunion","crypted");?>">
<table border="3" cellpadding="10">
    <thead>
        <tr>
<!--          <th>-</th>-->
          <th>N°</th>
          <th style="width:550px">Intitulé de l'ordre</th>
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
            <td><input class="form-control" type="text" name="libelleOrdre<?= $i+1 ?>" placeholder="Intitulé de l'ordre"></td>
         </tr> 
        <?php
        } 
        ?>
               
    </tbody>
    <tfoot> 
        <tr>
            <td colspan="2">
                <input type="submit" name="save" value="Sauvegarder" id="button">
            </td>
        </tr>
    </tfoot>
</table>
</form>
</center>

<?php
    }
    else
        echo "<a href='index.php?page=ordre&&id=$idReunion'>Le nombre chosit doit etre supperieur à 0</a>";
}
else
{
    echo "<a href='index.php?page=ordre&&id=$idReunion'>Aucun nombre choisit</a>";
}
}
?>