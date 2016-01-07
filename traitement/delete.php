<?php
session_start();


$monfichierName='../log/logDelete.txt';
$location=''; //à tester
// Récupération des variables nécessaires à la création de la tâche    et virer les saloperies de code  
$id= $_POST['id'];
$query='DELETE FROM task WHERE id = :unID ';
$exec= array(  'unID' => $id );

include('newGeneral.php'); 
?>