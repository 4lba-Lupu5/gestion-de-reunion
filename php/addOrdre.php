 <?php
    
    require("session-control.php");
    require("configure.php");
    include "functions.php";
if(isset($_GET['id'],$_GET['nbr']) and !empty($_GET['id']) and !empty($_GET['nbr']))
{
    $idReunion=$_GET['id'];
    if (isset($_POST['save']))
    {
        $idReunion=getWebId($_GET['id'],"Reunion","decrypted");
        $echec=0;
        $nbr=$_GET['nbr'];
        for($i=1;$i<=$nbr;$i++)
        {
            $test=true;
            
            $libelle="libelleOrdre$i";
            if(!isset($_POST[$libelle]) or empty($_POST[$libelle]))
                $test=false;
            else
                $libelle=$_POST[$libelle];
            
            if($test)
            {
                $idCompte=$_SESSION['idcompte'];
                $insert="insert into ordre(LibelleOrdre,idCompte)";
                $value="values('$libelle',$idCompte)";
                $exec=mysqli_query($connexionServeur,$insert.$value);
                
                $select="select idOrdre 
                         from Ordre 
                         where LibelleOrdre='$libelle' and
                               idCompte=$idCompte
                        ";
                $exec=mysqli_query($connexionServeur,$select);
                $line=mysqli_fetch_row($exec);
                
                $idOrdre=$line[0];
                $etat=1;
                $insert="insert into OrdreReunion(idOrdre,idReunion)";
                $value="values($idOrdre,$idReunion)";
                $exec=mysqli_query($connexionServeur,$insert.$value);        
            }
            else
                $echec++;
        } 
        $idReunion=getWebId( $idReunion,"Reunion","crypted");
        if($echec!=0)
            echo "<a href='../index.php?page=ordre&&id=$idReunion'> $echec Echecs </a>";
        else
            header("Location:../index.php?page=ordre&&id=$idReunion");
    }
}
?>