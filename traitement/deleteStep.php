<?php
session_start();
function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

$monfichier = fopen('../log/logDeleteStep.txt', 'a+');
fseek($monfichier, 0);
fputs($monfichier,"\r\n".date("Y-m-d H:i:s")."\r\n");
//On va vérifier si le jeton est présent dans la session et dans le formulaire
if((isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])))
{    //Si le jeton de la session correspond à celui du formulaire
    $token = $_SESSION['token'] ;
    $token2 = $_POST['token'] ;
    fputs($monfichier,$token."\r\n");
    fputs($monfichier,$token2."\r\n");
    if($_SESSION['token'] == $_POST['token'])
    {
        fputs($monfichier,"SESSION OK"."\r\n");                 echo('SESSION OK'); echo('<br>');
        $timestamp_ancien = time() - (15*60);                                       //Stockage du timestamp d'il y a 15 minutes
        if($_SESSION['token_time'] >= $timestamp_ancien)
        {                           //Si le jeton n'est pas expiré
            if(  startsWith($_SERVER['HTTP_REFERER'],'http://localhost/elp') || startsWith($_SERVER['HTTP_REFERER'],'http://elprojector.recontact.me'))
            {
                fputs($monfichier,'SERVER OK'."\r\n");          echo('SERVER OK <br>');
                include('connexion.php');
                fputs($monfichier,'CONNECTION BDD OK'."\r\n");  echo('CONNEXION BDD OK <br>');
                
            
                // Suppression de la nouvelle tâche à l'aide d'une requête préparée
                // $req = $bdd -> prepare('DELETE FROM task WHERE id = :unID ');
                // $req-> execute(array( 'unID' => $_POST['id']));
                // fputs($monfichier,"DELETE FROM task WHERE id = ".$_POST['id']."\r\n");

                fputs($monfichier,'REQUETE EXECUTEE'."\r\n");   echo('REQUETE EXECUTEE');
            }else{
                echo('Problème de HTTP_REFERER');
                fputs($monfichier,'Problème de HTTP_REFERER'."\r\n");
            }
        }else{
            fputs($monfichier,'Jeton trop vieux - 15 minutes maximum'."\r\n"); echo('Jeton trop vieux - 15 minutes maximum');
        }
    }else{
        fputs($monfichier,'Jeton de session différent du jeton donné'."\r\n"); echo('Jeton de session différent du jeton donné');
    }
}else{
        if(!(isset($_SESSION['token']))){
            header('Location: ../index.php?bug=SESSION_TOKEN');  
            fputs($monfichier,'Token de session non défini'."\r\n"); echo('Token de session non défini');
        }             
        if(!(isset($_SESSION['token_time']))) {
            header('Location: ../index.php?bug=SESSION_TOKEN_TIME');
            fputs($monfichier,'Temps du Token de session non défini'."\r\n"); echo('Temps du Token de session non défini');
        }            
        if (!(isset($_POST['token']))){
            header('Location: ../index.php?bug=TOKEN');
            fputs($monfichier,'Pas de token envoyé en hidden dans le formulaire, c est pas malin'."\r\n"); echo('Pas de token envoyé en hidden dans le formulaire, c est pas malin');
        }
}
header('Location: ../index.php?message=TASKisDELETED');
fputs($monfichier,"Fin programme"."\r\n");                  echo('<br> C EST GAGNE !<br>');
fclose($monfichier);
?>