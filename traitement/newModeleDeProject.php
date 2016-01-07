<?php
session_start();

$monfichierName='../log/logModeleDeProject.txt';
$location='definir.php?model=new';
// Récupération des variables nécessaires à la création de la tâche    et virer les saloperies de code  
$name= $_POST['name_modeleproject'];        // un projet est rangé dans les catégories
$query='INSERT INTO modeledeprojet ( name) VALUES (:name)';
$exec= array(  'name' => $name );

include('newGeneral.php'); 
?>