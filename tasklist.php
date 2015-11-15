<?php   
// Token pour Formulaire
session_start();//On démarre les sessions
$token = uniqid(rand(), true);//On génére un jeton totalement unique (c'est capital :D)
$_SESSION['token'] = $token;//Et on le stocke
$_SESSION['token_time'] = time();//On enregistre aussi le timestamp correspondant au moment de la création du token
//Maintenant, on affiche notre page normalement, le champ caché token en plus
?>
<?php include('connexion.php'); ?>

    <!DOCTYPE HTML>
    <!--
    /*
     * El Projector 
     * https://github.com/trollepierre/tdm
     * Copyright 2015, Pierre Trolle
     * http://pierre.recontact.me
     */
    -->
    <!-- <html lang="fr"> -->
    <head>
        <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->
        <meta charset="utf-8">
        <title>El Projector</title>
        <meta name="description" content="El Projector is an assistant to help you to manage your life projects.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="css/css.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
    </head>

    <body>


    <!-- Le bandeau principal avec le texte -->
        <div id="coeur" class="bandeau">
            <h1>H E L P</h1>
            <h2>El Projector  à la rescousse</h2>
        </div>

<!-- Modif apportée ci-dessous uniquement -->

<?php
$NbrColonne = 8;
// La requete (exemple) : toutes les "CHOSE" commençant par un "b", classées par ordre alphabétique.
// $query = "SELECT * FROM MATABLE WHERE CHOSE LIKE 'b%' ORDER BY CHOSE ASC;";

$reponse = $bdd->query('SELECT * FROM task');
$k=0;

// On affiche chaque entrée une à une
while ($val = $reponse->fetch())
{
    $dl = $val['dl'];
    $prior = $val['prior'];
    $exp = 2*$prior-1;
    $date = new DateTime($dl);
    $now = new DateTime();
    $interval = date_diff($date, $now);
    $retVal = ($interval->invert) ? -$interval->days : $interval->days ;
    $magique=20*log10(1+pow(10, $exp)*pow(2,$retVal));
    $tableau1[$k] = $magique;
    $tableau2[$k] = $dl;
    $tableau3[$k] = $val['hl'];
    $tableau4[$k] = $val['name_task'];
    $tableau5[$k] = $val['id_category'];
    $tableau6[$k] = $prior;
    $tableau7[$k] = $val['av'];
    $tableau8[$k] = $val['ap'];
    $k++;
}
// --------------------------------
// affichage
?>
<div class="table-responsive">
  <table class="table table-hover table-bordered table-condensed table-striped">
    <tbody>
        <tr>
            <th>Criticité (%)</th>
            <th>Date Limite</th>
            <th>Heure Limite</th>
            <th>Nom Tâche</th>
            <th>Catégorie</th>
            <th>Priorité</th>
            <th>Avant</th>
            <th>Après</th>
        </tr>
<?php
//tri tableau
arsort($tableau1);

foreach ($tableau1 as $k => $val) {
    $val=floor($val);
?>      <tr> 
            <td><?php echo $val;?></td>
            <td><?php echo $tableau2[$k]; ?></td>
            <td><?php echo $tableau3[$k]; ?></td>
            <td><?php echo $tableau4[$k]; ?></td>
            <td><?php echo $tableau5[$k]; ?></td>
            <td><?php 
                $priorite=$tableau6[$k];
                if ($priorite=="3") {
                    echo "Haute";
                }elseif ($priorite=="2") {
                    echo "Moyenne";
                }else{
                    echo "Basse";
                }?>
            </td>
            <td><?php echo $tableau7[$k]; ?></td>
            <td><?php echo $tableau8[$k]; ?></td>
        </tr>
<?php } ?>
   </tbody>
    </table>
    </div>


    <!-- on le strip de lignes bleu/blanc déjà -->
<!-- <tr class="danger">...</tr>
<tr class="info">...</tr>
<tr class="success">...</tr>
<tr class="warning">...</tr>
<tr class="active">...</tr> -->
  

    
<!-- Modif apportée ci-dessus uniquement -->

            <br>

            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>

    </html>