<?php

    function ordre($table) //Determine l'ordre adequate dans une table quelconque
    {
        require("configure.php");
        //$select="select id$table from $table order by id$table desc limit 0,1;";
        $select="select count(*) from $table"; 
        $resultat=mysqli_query($connexionServeur,$select);
        if($resultat)
        {
            $line=mysqli_num_rows($resultat);
            if($line!=0)
            {
                $data=mysqli_fetch_row($resultat);
                return $data[0]+1;
            }
            else
                return 0+1;
        }
    } 

    function defaultPass($id,$nom,$prenom,$mail) //Determiner mot de passe par defaut
    {
        $position=strpos($mail,"@"); //Position du @ dans l'adresse mail
        $patie_mail_sans_arobase=substr($mail,0,$position+1);
        $premier_caractere_du_nom=strtoupper(substr($nom,0,1));
        $premier_caractere_du_prenom=strtoupper(substr($prenom,0,1));
        return $id.$patie_mail_sans_arobase.$premier_caractere_du_nom.$premier_caractere_du_prenom;
    }

    function attri_username($id,$nom,$prenom) //Attribut un nom d'utilisateur 
    {
        return strtolower($nom.'.'.$prenom.$id);
    }

    function attri_reunion() //Attribut un identifiant à une reunion
    {
        $date=getdate();
        $jour=$date['mday'];
        $mois=$date['mon'];
        $annee=$date['year'];
        return ordre("reunion")."R$jour-$mois-$annee";
    }

    function attri_other_table($table)
    {
        switch($table)
        {
            case "etatparticipant":
            case "etatreunion":    
            case "modereunion": 
            case "ordre": 
            case "prioritereunion": 
            case "participant": 
            case "privilege": 
            case "typereunion": return ordre($table);
            default : return -1;
        }
    }
    
    function crypted($password)
    {
        $crypt=md5(sha1(sha1(md5($password))));
        return $crypt;
    }

    function decrypted($password)
    {
        $decrypt=md5(sha1(sha1(md5($password))));
        return $decrypt;
    }
    
    function getWebId($idLine,$table,$method) //crypte le id d'une ligne passée sur le browser (method get)
    {
        $tab_method=array('crypted','decrypted');
        $a=3;
        $b=2;
        $c=1;//ordre($table)+1;
        if(in_array($method,$tab_method))
        {
            if($method=="crypted")
                return ($a*$idLine+$b)/$c; //f(x)=(ax+b)/c
            else 
                return ($c*$idLine-$b)/$a;  //x=(cf-b)/a
        }
        return "Error:4501";
    }

    
?>
