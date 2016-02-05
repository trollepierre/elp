<?php
function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

$monfichier = fopen($monfichierName, 'a+');
fseek($monfichier, 0);
fputs($monfichier,"\r\n".date("Y-m-d H:i:s")."\r\n");
//On va vérifier si le jeton est présent dans la session et dans le formulaire
if((isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])))
{    //Si le jeton de la session correspond à celui du formulaire
    $token = $_SESSION['token'] ;
    $token2 = $_POST['token'] ;
    fputs($monfichier,"".$token." = ");
    fputs($monfichier,"".$token2." ? \r\n");
    if($_SESSION['token'] == $_POST['token'])
    {
        fputs($monfichier,"SESSION OK"."\r\n");                 echo('SESSION OK'); echo('<br>');
        $timestamp_ancien = time() - (60*60);                                       //Stockage du timestamp d'il y a 60 minutes
        if($_SESSION['token_time'] >= $timestamp_ancien)
        {                           //Si le jeton n'est pas expiré
            if(  startsWith($_SERVER['HTTP_REFERER'],'http://localhost/elp') || startsWith($_SERVER['HTTP_REFERER'],'http://elprojector.recontact.me'))
            {
                fputs($monfichier,'SERVER OK'."\r\n");          echo('SERVER OK <br>');
                include_once 'connexion.php';
                fputs($monfichier,'CONNECTION BDD OK'."\r\n");  echo('CONNEXION BDD OK <br>');
 
                // Insertion de la nouvelle tâche à l'aide d'une requête préparée
                $req = $bdd -> prepare($query);
                if (!$req) {
                    echo "\nPDO::errorInfo():\n";
                    print_r($bdd->errorInfo());
                    fputs($monfichier,"ERROR : ".$bdd->errorInfo()."\r\n");   //cas d'erreur
                    foreach ($exec as $key => $value) {
                        fputs($monfichier,$value.", ");   
                    }
                }
                $req-> execute($exec);
                fputs($monfichier,'REQUETE EXECUTEE'."\r\n");   

                if(isset($query2)){
                    $req = $bdd -> prepare($query2);
                    if (!$req) {
                        echo "\nPDO::errorInfo():\n";
                        print_r($bdd->errorInfo());
                        fputs($monfichier,"ERROR : ".$bdd->errorInfo()."\r\n");   //cas d'erreur
                        foreach ($exec2 as $key => $value) {
                            fputs($monfichier,$value.", ");   
                        }
                    }
                    $req-> execute($exec2);
                    fputs($monfichier,'REQUETE 2 EXECUTEE'."\r\n");   
                }
                // fputs($monfichier,$exec."\r\n");   
                

                header('Location: ../'.$location);
            }else{
                fputs($monfichier,'Problème de HTTP_REFERER'."\r\n");
                header('Location: ../taskCreator.php?bug=HTTP_REFERER');
            }
        }else{
            fputs($monfichier,'Jeton trop vieux - 60 minutes maximum'."\r\n"); 
            header('Location: ../taskCreator.php?bug=OLD_TOKEN');
        }
    }else{
        fputs($monfichier,'Jeton de session différent du jeton donné'."\r\n"); 
        header('Location: ../taskCreator.php?bug=DIFFERENTS_TOKENS');  
    }
}else{
        if(!(isset($_SESSION['token']))){
            header('Location: ../taskCreator.php?bug=SESSION_TOKEN');  
            fputs($monfichier,'Token de session non défini'."\r\n"); 
        }             
        if(!(isset($_SESSION['token_time']))) {
            header('Location: ../taskCreator.php?bug=SESSION_TOKEN_TIME');
            fputs($monfichier,'Temps du Token de session non défini'."\r\n"); 
        }            
        if (!(isset($_POST['token']))){
            header('Location: ../taskCreator.php?bug=TOKEN');
            fputs($monfichier,'Pas de token envoyé en hidden dans le formulaire, c est pas malin'."\r\n"); 
        }
}
fputs($monfichier,"Fin programme"."\r\n");                  
fclose($monfichier);
?>