<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
 
sec_session_start();

$monfichierName='../log/logTraitement.txt';
// Récupération des variables nécessaires à la création de la tâche    et virer les saloperies de code  
$name_task = $_POST['name_task'];
$id_project = $_POST["id_project"];
$prior = $_POST["prior"];
$av = $_POST["av"];
$ap = $_POST["ap"];
$hl = $_POST["hl"];
$dlATraiter = $_POST["dl"];
$dlCoupee = explode("/", $dlATraiter);
$dl = $dlCoupee[2]."-".$dlCoupee[1]."-".$dlCoupee[0];
// fputs($monfichier,$dl."\r\n"); 
$id_owner = htmlentities($_SESSION['user_id']);

if(isset($_GET['edit'])){
    $edit=$_GET['edit'];
    $query='UPDATE task  SET  name_task = :name_task, id_project = :id_project, dl = :dl, hl = :hl, prior = :prior, av = :av, ap = :ap WHERE id = :edit AND id_owner = :id_owner';
    $exec= array(  'name_task' => $name_task, 'id_project' => $id_project, 'id_owner' => $id_owner, 'dl' => $dl, 'hl' => $hl, 'prior' => $prior, 'av' => $av, 'ap' => $ap, 'edit' => $edit  );
    $location='';
}else{
    $query='INSERT INTO task ( name_task, id_project, id_owner, dl, hl, prior, av, ap) VALUES (:name_task, :id_project, :id_owner, :dl, :hl, :prior, :av, :ap)';
    $exec=array(  'name_task' => $name_task, 'id_project' => $id_project, 'id_owner' => $id_owner, 'dl' => $dl, 'hl' => $hl, 'prior' => $prior, 'av' => $av, 'ap' => $ap  );
	$location='';
}

include('newGeneral.php'); 
?>