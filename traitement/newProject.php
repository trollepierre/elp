<?php
session_start();
function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

$monfichier = fopen('../log/logProject.txt', 'a+');
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
                $name_category = $_POST['name_project'];        // un projet est rangé dans les catégories
                $prior = $_POST["prior"];
                $dlATraiter = $_POST["dl"];
                $dlCoupee = explode("/", $dlATraiter);
                $dl = $dlCoupee[2]."-".$dlCoupee[1]."-".$dlCoupee[0];
                fputs($monfichier,$dl."\r\n"); 
                $id_owner = '1';                                // Les comptes utilisateurs ne sont pas encore fonctionnels.
                $model = $_POST["model"];                 //à définir

                // Insertion de la nouvelle tâche à l'aide d'une requête préparée
                $req = $bdd -> prepare('INSERT INTO category ( name_category, id_owner, dl, prior) VALUES (:name_category,  :id_owner, :dl, :prior)');
                $req-> execute(array(  'name_category' => $name_category,  'id_owner' => $id_owner, 'dl' => $dl, 'prior' => $prior ));
                fputs($monfichier,'REQUETE EXECUTEE'."\r\n");   

                //
                // if $model = vierge, alors definir new projet

                // if $model = non vierge alors definir projet suivant model

                header('Location: definir.php?model=new ');
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