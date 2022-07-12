    <?php require("php/configure.php"); include "php/functions.php";?>
    <?php
        // Scan le repertoire views
        $views=scandir("views/"); 
        //Page de views reservées aux admintrateurs
        $admin=array('editProfile','gestionUser');
        /* verifie si la page demandée existe dans le repertoire 
            views puis la stock dans la variable $page 
            Si la page demandée n'existe pas dans views, alors 
            $page recoit par defaut la valeur login
        */
        if(isset($_GET['page']) AND !empty($_GET['page']) AND in_array($_GET['page'].'.php',$views))
            $page=$_GET['page'];
        else
            $page="login";
    ?>
    
    <!DOCTYPE html>
    <html lang="fr">
        <head> 
            <?php include "liens/link.php"?>
            <title>GESTION DES REUNIONS</title>
        </head>
        <body>
            <div class="container cadre"> 
                <?php
            
                    /*  On lance la session ici pour eviter de dupliquer 
                        l'instruction  dans toutes les pages du repertoire views
                    */
                    //session_start();
                    /* Fait une verification des variables de
                        session pour s'assurer que l'utilisateur 
                        qui tente d'acceder à une page quelconque 
                        autre que la page de connexion soit au 
                        prealable connecté
                    */ 
                    $testFoot=false;
                    if($page!="login")
                    {
                        $testFoot=true;
                        if(in_array($page,$admin))
                        {
                            require("php/admin-views-control.php");   
                        }
                        else
                            require("php/session-control.php");
                        
                        include "liens/navbar.php";
                    }
                    include "views/".$page.".php";
                    if($testFoot)
                    { ?>
                        
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 gridhome">
                            <?php include "liens/footer.php"; ?>
                        </div>
                    </div> 
                          
                   <?php }      
                ?>
            </div>
            <?php 
                include "liens/script.php";
            ?> 
            
        </body>
    </html>  