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
    <!-- <html lang="fr"> -->
    <head>
        <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->
        <meta charset="utf-8">
        <title>El Projector</title>
        <meta name="description" content="El Projector is an assistant to help you to manage your life projects.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/css.css">
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
    </head>

    <body>
    <!-- Le bandeau principal avec le texte -->
        <div id="coeur" class="bandeau">
            <h1>H E L P</h1>
            <h2>El Projector  à la rescousse</h2>
        </div>

<!-- Modif apportée ci-dessous uniquement -->
<button id="delete" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-trash"></i> Supprimer</button>
<br/><br>

<?php
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
    $tableau4[$k] = htmlentities($val['name_task']);
    $tableau5[$k] = $val['id_category'];
    $tableau6[$k] = $prior;
    $tableau7[$k] = $val['av'];
    $tableau8[$k] = $val['ap'];
    $tableau9[$k] = $val['id'];
    $k++;
}
?>
<div class="table-responsive">
  <table class="table table-hover table-bordered table-condensed table-striped">
    <tbody>
        <tr>
            <th><input id="selectall" type="checkbox"></th>
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
            <td><input class="case" type="checkbox" value="".<?php echo $tableau9[$k];?>."" name="case"></input></td>
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

            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> <!-- ligne118 -->
            <script type="text/javascript">
            $(function(){
                // // suppression des cases cochées
                // $("#delete").click(function(){
                //     //pour chaque case coché, je supprime en SQL la value avec l'id
                //     //=> forcer l'user à cocher !!!!
                // <?php include('connexion.php'); 
                //     // pour chaque case checked
                //     foreach() {?>
                //         $(".case:checked")
                //         //faire
                //         $idAVirer= $(".case:checked").value;
                //         <?php 
                //         $bdd->query('DELETE FROM task WHERE id ='.$idAVirer.'');
                //         ?>
                //     }
                //     //reload de lapage

                // })

                //add multiple select / deselect functionnality
                $("#selectall").click(function(){
                    $('.case').attr('checked',this.checked);
                });

                // if all checkbox are selected, check the selectall checkbox and viceversa
                $(".case").click(function(){
                    if ($(".case").length == $(".case:checked").length) {
                        $("#selectall").attr("checked","checked");
                    }else{
                        $("#selectall").removeAttr("checked");
                    }
                    
                });
            });
            </script>
    </body>

    </html>