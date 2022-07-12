<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
// $date_today=date("%A %d %B %Y");
setlocale(LC_TIME, 'fr','fr_FR','fr-FR.ISO8859-1');
// echo($date_today);
?>

<div class="image">
<?php
$date_day=strftime("%A");
$date_month=strftime("%B");
    switch ($date_day)
				{
					case 'Monday': $date_day="Lundi";
									break;
					
					case 'Tuesday': $date_day="Mardi";
									break;

					case 'Wednesday': $date_day="Mercredi";
									break;

					case 'Thursday': $date_day="Jeudi";
									break;

					case 'Friday': $date_day="Vendredi";
									break;


					case 'Saturday': $date_day="Samedi";
									break;
					
					default: $date_day="Dimanche";
				}

	switch ($date_month)
	            { 
					case 'January': $date_month="Janvier";
					break;
	
					case 'February': $date_month="Fevrier";
									break;

					case 'March': $date_month="Mars";
									break;

					case 'April': $date_month="Avril";
									break;

					case 'May': $date_month="Mai";
									break;

					case 'June': $date_month="Juin";
									break;

					case 'July': $date_month="Juillet";
									break;
					
					case 'August': $date_month="Aout";
									break;

					case 'September': $date_month="Septembre";
									break;

					case 'October': $date_month="Octobre";
									break;

					case 'November': $date_month="Novembre";
									break;
					
					default: $date_month="Decembre";
				}

$date_today=strftime("%Y");
//echo "<h2> $date_day </h2>", "<h3>$date_month</h3>";

echo("<h5>$date_day</h5>".''."<h5>$date_month".' | '."$date_today</h5>");
?>
</div>
<?php

$list_fer=array(7);//Liste pour les jours ferié; EX: $list_fer=array(7,1)==>tous les dimanches et les Lundi seront des jours fériers
$list_spe=array('1986-10-31','2009-4-12','2009-9-23');//Mettez vos dates des evenements ; NB format(annee-m-j)
$lien_redir="#";//Lien de redirection apres un clic sur une date, NB la date selectionner va etre ajouter à ce lien afin de la récuperer ultérieurement 
$clic=1;//1==>Activer les clic sur tous les dates; 2==>Activer les clic uniquement sur les dates speciaux; 3==>Désactiver les clics sur tous les dates
$col1="#009688";//couleur au passage du souris pour les dates normales
$col2="#009688";//couleur au passage du souris pour les dates speciaux
$col3="rgb(211,211,211)";//couleur au passage du souris pour les dates férié
$mois_fr = Array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août","Septembre", "Octobre", "Novembre", "Décembre");
if(isset($_GET['mois']) && isset($_GET['annee']))
{
	$mois=$_GET['mois'];
	$annee=$_GET['annee'];
}
else
{
	$mois=date("n");
	$annee=date("Y");
}
$ccl2=array($col1,$col2,$col3);
$l_day=date("t",mktime(0,0,0,$mois,1,$annee));
$x=date("N", mktime(0, 0, 0, $mois,1 , $annee));
$y=date("N", mktime(0, 0, 0, $mois,$l_day , $annee));
$titre=$mois_fr[$mois]." : ".$annee;
//echo $l_day;
?>
<body>
<center>
<form name="dt" method="get" action="">
<select name="mois" id="mois" onChange="change()" class="liste">
<?php
	for($i=1;$i<13;$i++)
	{
		echo '<option value="'.$i.'"';
		if($i==$mois)
			echo ' selected ';
		echo '>'.$mois_fr[$i].'</option>';
	}
?>
</select>
<select name="annee" id="annee" onChange="change()" class="liste">
<?php
	for($i=1950;$i<2035;$i++)
	{
		echo '<option value="'.$i.'"';
		if($i==$annee)
			echo ' selected ';
		echo '>'.$i.'</option>';
	}
?>
</select>
</form>
<table class="calendar"><caption><?php echo $titre ;?></caption>
<tr id="day" style="font-family:'Times New Roman', Times, serif;">
	<th><u>Lun</u></th>
	<th><u>Mar</u></th>
	<th><u>Mer</u></th>
	<th><u>Jeu</u></th>
	<th><u>Ven</u></th>
	<th><u>Sam</u></th>
	<th style="color:red;"><u>Dim</u></th>
</tr>
<tr id="num">
<?php
//echo $y;
$case=0;
if($x>1)
	for($i=1;$i<$x;$i++)
	{
		echo '<td class="desactive">&nbsp;</td>';
		$case++;
	}
for($i=1;$i<($l_day+1);$i++)
{
	$f=$y=date("N", mktime(0, 0, 0, $mois,$i , $annee));
	$da=$annee."-".$mois."-".$i;
	$lien=$lien_redir;
	$lien.="?dt=".$da;
	echo "<td";
	if(in_array($da, $list_spe))
	{
		echo " class='special' onmouseover='over(this,1,2)'";
		if($clic==1||$clic==2)
			echo " onclick='go_lien(\"$lien\")' ";
	}
	else if(in_array($f, $list_fer))
	{
		echo " class='ferier' onmouseover='over(this,2,2)'";
		if($clic==1)
			echo " onclick='go_lien(\"$lien\")' ";
	}
	else 
	{
		echo" onmouseover='over(this,0,2)' ";
		if($clic==1)
			echo " onclick='go_lien(\"$lien\")' ";
	}
	echo" onmouseout='over(this,0,1)'>$i</td>";
	$case++;
	if($case%7==0)
		echo "</tr><tr>";
	
}
if($y!=7)
	for($i=$y;$i<7;$i++)
	{
		echo '<td class="desactive">&nbsp;</td>';
	}
?></tr>
</table>
</center>
</body></html>
<script type="text/javascript">
function change()
{
	document.dt.submit();
}
	function over(this_,a,t)
{
	<?php 
	echo "var c2=['$ccl2[0]','$ccl2[1]','$ccl2[2]'];";
	?>
	var col;
	if(t==2)
		this_.style.backgroundColor=c2[a];
	else
		this_.style.backgroundColor="";
}
function go_lien(a)
{
	top.document.location=a;
}
</script>