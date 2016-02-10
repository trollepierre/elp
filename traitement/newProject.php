<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
 
sec_session_start();

$monfichierName='../log/logProject.txt';
// Récupération des variables nécessaires à la création de la tâche    et virer les saloperies de code  
$name_project = $_POST['name_project'];        // un projet est rangé dans les catégories
$prior = 3 ;//$_POST["prior"];
$dlATraiter = $_POST["dl"];
$dlATraiter = $_POST["dl"];
$dlCoupee = explode("/", $dlATraiter);
$dl = $dlCoupee[2]."-".$dlCoupee[1]."-".$dlCoupee[0];

//today
$dl=date('Y-m-d');


//fputs($monfichier,$dl."\r\n"); 
$id_owner = htmlentities($_SESSION['user_id']);
$model = $_POST["model"];                 //à définir

// Insertion de la nouvelle tâche à l'aide d'une requête préparée
$query='INSERT INTO project ( name_project, id_owner, dl, prior) VALUES (:name_project,  :id_owner, :dl, :prior)';
$exec=array(  'name_project' => $name_project,  'id_owner' => $id_owner, 'dl' => $dl, 'prior' => $prior );

if(isset($_GET['edit'])){
    $edit=$_GET['edit'];
    $query='UPDATE project  SET  name_project = :name_project, dl = :dl, prior = :prior WHERE id = :edit AND id_owner = :id_owner';
    $exec= array(  'name_project' => $name_project, 'id_owner' => $id_owner, 'dl' => $dl, 'prior' => $prior, 'edit' => $edit  );
    $location='';
}else{
    $query='INSERT INTO project ( name_project, id_owner, dl, prior) VALUES (:name_project,  :id_owner, :dl, :prior)';
   $exec=array(  'name_project' => $name_project,  'id_owner' => $id_owner, 'dl' => $dl, 'prior' => $prior );
	$location='';
}


include('newGeneral.php'); 
?>