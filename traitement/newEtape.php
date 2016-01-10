<?php
session_start();

$monfichierName='../log/logEtapeDeProjet.txt';
// Récupération des variables nécessaires à la création de la tâche    et virer les saloperies de code  
$name= $_POST['name_modeleproject'];        // un projet est rangé dans les catégories
$id_etape= $_POST['id_etape'] ;
$nom= $_POST['name_etape'] ;
$dlATraiter= $_POST['dl_etape'] ;
$duree_etape= $_POST['duree_etape'] ;
$period_etape= $_POST['period_etape'] ;
$prior= $_POST['prior_etape'] ;

$parent="1";//faudrait-il cacher un id de name-modeleprojet
$rang="1"; // obtenir le rang
// $duree= $duree_etape * $period_etape; //à mathématiser
$duree= "1";

$dlCoupee = explode("/", $dlATraiter);
$dl = $dlCoupee[2]."-".$dlCoupee[1]."-".$dlCoupee[0];

$query='INSERT INTO etape (parent, rang, nom, dl, duree, prior) VALUES (:parent,:rang,:nom,:dl,:duree,:prior)';
$exec= array(  'parent' => $parent,'rang' => $rang,'nom' => $nom,'dl' => $dl,'duree' => $duree,'prior' => $prior );

include('newGeneral.php'); 
?>