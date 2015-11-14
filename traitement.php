<?php

session_start();
 // //header('Location: index.php?Cool=OK7');
echo('<br>');
//On va vérifier :
//Si le jeton est présent dans la session et dans le formulaire
if((isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])))
{
     //Si le jeton de la session correspond à celui du formulaire
    if($_SESSION['token'] == $_POST['token'])
    {
        echo('SESSION OK');            echo('<br>');
        
        $timestamp_ancien = time() - (15*60);                                       //Stockage du timestamp d'il y a 15 minutes
        if($_SESSION['token_time'] >= $timestamp_ancien){                           //Si le jeton n'est pas expiré

            if($_SERVER['HTTP_REFERER'] == 'http://localhost/elp/index.php'){       //Si le referer est bon
            // if($_SERVER['HTTP_REFERER'] == 'http://elp.recontact.me/index.php'){
            echo('SERVER OK <br>');

            // Connexion à la base de données
            $host = 'mysql1.alwaysdata.com';
            $database = 'recontact_elp';
            $user = 'recontact';
            $pass = 'f**k';
            try{
                $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $database , $user , $pass);
                }catch(Exception $e){
                die('Erreur : '.$e->getMessage());
                // //header('Location: index.php?bug=OK7');                echo('hi2');
                }

            echo('CONNEXION BDD OK <br>');
            // Récupération des variables nécessaires à la création de la tâche    et virer les saloperies de code  
            $name_task = htmlentities($_POST['name_task']);
            $id_category = htmlentities($_POST["id_category"]);
            $prior = htmlentities($_POST["prior"]);
            $av = htmlentities($_POST["av"]);
            $ap = htmlentities($_POST["ap"]);
            $dl = htmlentities($_POST["dl"]);
            $hl = htmlentities($_POST["hl"]);
                        
            // Les comptes utilisateurs ne sont pas encore fonctionnels.
            $id_owner = '1';
            
                        // Insertion de la nouvelle tâche à l'aide d'une requête préparée
            $req = $bdd -> prepare('INSERT INTO task ( name_task, id_category, id_owner, dl, hl, prior, av, ap) VALUES (:name_task, :id_category, :id_owner, :dl, :hl, :prior, :av, :ap)');
            $req-> execute(array(  'name_task' => $name_task, 'id_category' => $id_category, 'id_owner' => $id_owner, 'dl' => $dl, 'hl' => $hl, 'prior' => $prior, 'av' => $av, 'ap' => $ap  ));

            echo('REQUETE EXECUTEE');
            
            }else{
                //header('Location: index.php?bug=OK5');   
                echo('Problème de HTTP_REFERER');
            }
        }else{
        //header('Location: index.php?bug=OK4');   
            echo('Jeton trop vieux - 15 minutes maximum');
        }
        //header('Location: index.php?PAS_DE_BUG');   
        // echo("D'où sortez-vous ce jeton et/ou comment avez-vous pu changer votre session !");
    }else{
    
        if(!(isset($_SESSION['token']))){
            //header('Location: index.php?bug=SESSION_TOKEN');  
            echo('Token de session non défini');
        } 
        
        if(!(isset($_SESSION['token_time']))) {
            //header('Location: index.php?bug=SESSION_TOKEN_TIME');
            echo('Temps du Token de session non défini');
        }
        
        if (!(isset($_POST['token']))){
            //header('Location: index.php?bug=TOKEN');
            echo('Pas de token envoyé en hidden dans le formulaire, c est pas malin');
        }
    }
}
header('Location: index.php?message=TASKisADDED');
// echo('<br> C EST GAGNE !<br>');
?>