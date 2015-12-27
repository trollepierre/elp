<?php
session_start();
function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

$monfichier = fopen('../log/logModeleDeProject.txt', 'a+');
fseek($monfichier, 0);
fputs($monfichier,"\r\n".date("Y-m-d H:i:s")."\r\n");
//On va vérifier si le jeton est présent dans la session et dans le formulaire
if((isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])))
{    //Si le jeton de la session correspond à celui du formulaire
    $token = $_SESSION['token'] ;
    $token2 = $_POST['token'] ;
    fputs($monfichier,"".$token."\r\n");
    fputs($monfichier,"".$token2."\r\n");
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
                
                // Récupération des variables nécessaires à la création de la tâche    et virer les saloperies de code  
                $name= $_POST['name_modeleproject'];        // un projet est rangé dans les catégories
                

                // Insertion de la nouvelle tâche à l'aide d'une requête préparée
                $req = $bdd -> prepare('INSERT INTO modeledeprojet ( name) VALUES (:name)');
                $req-> execute(array(  'name' => $name ));
                fputs($monfichier,'REQUETE EXECUTEE'."\r\n");   

                header('Location: ../definir.php?model=new');
            }else{
                fputs($monfichier,'Problème de HTTP_REFERER'."\r\n");
                header('Location: ../index.php?bug=HTTP_REFERER');
            }
        }else{
            fputs($monfichier,'Jeton trop vieux - 15 minutes maximum'."\r\n"); 
            header('Location: ../index.php?bug=OLD_TOKEN');
        }
    }else{
        fputs($monfichier,'Jeton de session différent du jeton donné'."\r\n"); 
        header('Location: ../index.php?bug=DIFFERENTS_TOKENS');  
    }
}else{
        if(!(isset($_SESSION['token']))){
            header('Location: ../index.php?bug=SESSION_TOKEN');  
            fputs($monfichier,'Token de session non défini'."\r\n"); 
        }             
        if(!(isset($_SESSION['token_time']))) {
            header('Location: ../index.php?bug=SESSION_TOKEN_TIME');
            fputs($monfichier,'Temps du Token de session non défini'."\r\n"); 
        }            
        if (!(isset($_POST['token']))){
            header('Location: ../index.php?bug=TOKEN');
            fputs($monfichier,'Pas de token envoyé en hidden dans le formulaire, c est pas malin'."\r\n"); 
        }
}
fputs($monfichier,"Fin programme"."\r\n");                  
fclose($monfichier);
?>