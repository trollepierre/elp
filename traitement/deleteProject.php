<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
 
sec_session_start();


$monfichierName='../log/logDeleteProject.txt';
$location=''; //à tester
// Récupération des variables nécessaires à la création de la tâche    et virer les saloperies de code  
$id= $_POST['id'];
$id_owner = htmlentities($_SESSION['user_id']);

$query='UPDATE task  SET  id_project = 3 WHERE id = :id_project AND id_owner = :id_owner';
$exec= array(  'id_owner' => $id_owner, 'id_project' => $id_project );

$query2='DELETE FROM project WHERE id = :unID AND id_owner = :id_owner ';
$exec2= array(  'id_owner' => $id_owner,'unID' => $id );

include('newGeneral.php'); 
?>