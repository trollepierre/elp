<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
 
sec_session_start();

$monfichierName='../log/logModeleDeProjet.txt';
$location='definir.php?model=new';
$id_owner = htmlentities($_SESSION['user_id']);
// Récupération des variables nécessaires à la création de la tâche    et virer les saloperies de code  
$name= $_POST['name_modeleproject'];        // un projet est rangé dans les catégories
$query='INSERT INTO modeledeprojet ( name, dl , duree, priorite) VALUES (:name,:dl,:duree,:priorite)';
// INSERT INTO `elprojector`.`modeledeprojet` (`name`, `dl`, `duree`, `priorite`, `id`) VALUES ('test', '', '', '', NULL);
$exec= array(  'name' => $name , 'dl' => "15-10-11" , 'duree' => '1', 'priorite' => '1');

include('newGeneral.php'); 
?>