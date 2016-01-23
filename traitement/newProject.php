<?php
session_start();

$monfichierName='../log/logProject.txt';
$location='index.php';
// Récupération des variables nécessaires à la création de la tâche    et virer les saloperies de code  
$name_project = $_POST['name_project'];        // un projet est rangé dans les catégories
$prior = 1 ;//$_POST["prior"];
$dlATraiter = $_POST["dl"];
$dlCoupee = explode("/", $dlATraiter);
$dl = $dlCoupee[2]."-".$dlCoupee[1]."-".$dlCoupee[0];
fputs($monfichier,$dl."\r\n"); 
$id_owner = '1';                                // Les comptes utilisateurs ne sont pas encore fonctionnels.
$model = $_POST["model"];                 //à définir
// Insertion de la nouvelle tâche à l'aide d'une requête préparée
$query='INSERT INTO project ( name_project, id_owner, dl, prior) VALUES (:name_project,  :id_owner, :dl, :prior)';
$exec=array(  'name_project' => $name_project,  'id_owner' => $id_owner, 'dl' => $dl, 'prior' => $prior );

include('newGeneral.php'); 
?>