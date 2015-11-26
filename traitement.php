<?php
session_start();
function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

 // //header('Location: index.php?Cool=OK7');
$monfichier = fopen('log.txt', 'a+');
fseek($monfichier, 0);
fputs($monfichier,"\r\n".date("Y-m-d H:i:s")."\r\n");
//On va vérifier si le jeton est présent dans la session et dans le formulaire
if((isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])))
{    //Si le jeton de la session correspond à celui du formulaire
    if($_SESSION['token'] == $_POST['token'])
    {
        fputs($monfichier,"SESSION OK"."\r\n");                 echo('SESSION OK'); echo('<br>');
        $timestamp_ancien = time() - (15*60);                                       //Stockage du timestamp d'il y a 15 minutes
        if($_SESSION['token_time'] >= $timestamp_ancien)
        {                           //Si le jeton n'est pas expiré
            if(  startsWith($_SERVER['HTTP_REFERER'],'http://localhost/elp') || startsWith($_SERVER['HTTP_REFERER'],'http://elp.recontact.me'))
            {
                fputs($monfichier,'SERVER OK'."\r\n");          echo('SERVER OK <br>');
                include('connexion.php');
                fputs($monfichier,'CONNECTION BDD OK'."\r\n");  echo('CONNEXION BDD OK <br>');
                
                // Récupération des variables nécessaires à la création de la tâche    et virer les saloperies de code  
                $name_task = $_POST['name_task'];
                $id_category = $_POST["id_category"];
                $prior = $_POST["prior"];
                $av = $_POST["av"];
                $ap = $_POST["ap"];
                $dl = $_POST["dl"];
                $hl = $_POST["hl"];
                $id_owner = '1';                                // Les comptes utilisateurs ne sont pas encore fonctionnels.
            
                // Insertion de la nouvelle tâche à l'aide d'une requête préparée
                $req = $bdd -> prepare('INSERT INTO task ( name_task, id_category, id_owner, dl, hl, prior, av, ap) VALUES (:name_task, :id_category, :id_owner, :dl, :hl, :prior, :av, :ap)');
                $req-> execute(array(  'name_task' => $name_task, 'id_category' => $id_category, 'id_owner' => $id_owner, 'dl' => $dl, 'hl' => $hl, 'prior' => $prior, 'av' => $av, 'ap' => $ap  ));

                fputs($monfichier,'REQUETE EXECUTEE'."\r\n");   echo('REQUETE EXECUTEE');
                }else{
                    echo('Problème de HTTP_REFERER');
                    fputs($monfichier,'Problème de HTTP_REFERER'."\r\n");
                }
            }else{
            //header('Location: index.php?bug=OK4');   
                fputs($monfichier,'Jeton trop vieux - 15 minutes maximum'."\r\n"); echo('Jeton trop vieux - 15 minutes maximum');
            }
            //header('Location: index.php?PAS_DE_BUG');   
            // echo("D'où sortez-vous ce jeton et/ou comment avez-vous pu changer votre session !");
        }else{
        
            if(!(isset($_SESSION['token']))){
                header('Location: index.php?bug=SESSION_TOKEN');  
                fputs($monfichier,'Token de session non défini'."\r\n"); echo('Token de session non défini');
            } 
            
            if(!(isset($_SESSION['token_time']))) {
                header('Location: index.php?bug=SESSION_TOKEN_TIME');
                fputs($monfichier,'Temps du Token de session non défini'."\r\n"); echo('Temps du Token de session non défini');
            }
            
            if (!(isset($_POST['token']))){
                header('Location: index.php?bug=TOKEN');
                fputs($monfichier,'Pas de token envoyé en hidden dans le formulaire, c est pas malin'."\r\n"); echo('Pas de token envoyé en hidden dans le formulaire, c est pas malin');
            }
        }
    }
header('Location: index.php?message=TASKisADDED');
fputs($monfichier,"Fin programme"."\r\n");                  echo('<br> C EST GAGNE !<br>');
fclose($monfichier);
?>