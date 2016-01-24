<?php   
    session_start();//On démarre les sessions
    $_SESSION['token'] = (isset($_SESSION['token'])) ? $_SESSION['token'] : uniqid(rand(), true) ;//Génération de jeton unique
    $_SESSION['token_time'] = time();//Enregistrement d'un timestamp
    ?>
    <?php include('traitement/connexion.php'); ?>
    <!DOCTYPE HTML>
    <html lang="fr">
    <head>
        <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->
        <meta charset="utf-8">
        <meta name="description" content="El Projector is an assistant to help you to manage your life projects.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="title" content="Liste des tâches - El Projector !"/>
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="">

        <title>Liste des tâches - El Projector </title>


        <?php include("w/cssExternal.php"); ?>

    </head>
    <body>
        <!-- Le bandeau principal avec le texte -->
        <div id="coeur" class="bandeau">
            <h1>H E L P - El Projector  à la rescousse </h1>
            <h2></h2>
        </div>
        <form action="index.php?edit=1" id="form" method="post" onsubmit="return validateForm()" accept-charset="utf-8" >

            <a href="index.php" id="add" class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>  Ajouter</a>
            <button id="delete" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-trash"></i> Supprimer</button>
            <button id="edit" class="btn btn-warning" disabled="disabled" type="submit"><i class="glyphicon glyphicon-pencil"></i> Modifier </button>
            <a href="projectCreator.php" id="add" class="btn btn-info" type="button"><i class="glyphicon glyphicon-plus"></i>  Ajouter un projet</a>
            <br/><br>
            <?php
            $project = (isset($_GET['project'])) ? " WHERE id_project = ".$_GET['project'] : "" ;
            $nbproject = (isset($_GET['project'])) ? $_GET['project'] : "" ;
            $reponse = $bdd->query('SELECT * FROM task'.$project);
            $k=0;
            while ($val = $reponse->fetch())
            {
                $dl = $val['dl'];
                $hl = $val['hl']; 
                $prior = $val['prior'];
                $exp = 2*$prior-1;
                $date = new DateTime($dl);
                $now = new DateTime();
                $interval = date_diff($date, $now);
        // si interval est négatif alors mettre un - devant et soustraire l'hl pour ordonner ; le +1 vient de l'erreur de diff
                $retVal = ($interval->invert) ? -$interval->days - $hl /24 : $interval->days +1 -$hl/ 24 ;
                $magique=20*log10(1+pow(10, $exp)*pow(2,$retVal));
                $tableau1[$k] = $magique;
                $tableau2[$k] = $dl;
                $tableau3[$k] = str_split($hl,5)[0];
                $tableau4[$k] = html_entity_decode($val['name_task']);
                $tableau5[$k] = $val['id_project'];
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
                            <th><input id="selectall" type="checkbox" autofocus></th>
                            <th>Criticité (%)</th>
                            <th>Date Limite</th>
                            <th>Heure Limite</th>
                            <th>Nom Tâche</th>
                            <th>
                                <select class="form-control" id='filtreProjet' name='filtreProjet' onchange="filtreChange()">
                                    <option value="0">Tous les Projets</option>
                                    <?php 
                                    // Bouton de choix du filtre par projet
                                    $reponse = $bdd->query('SELECT * FROM project');
                                    while ($val = $reponse->fetch()){
                                        // $sel=' selected="selected" ';
                                        $sel = ($val['id']==$nbproject) ? ' selected="selected" ' : "" ;
                                        echo '<option '.$sel.'value="'.$val['id'].'">'.$val['name_project']."</option>";
                                    }
                                    ?>
                                </select>
                            </th>
                            <th>Priorité</th>
                            <th>Avant</th>
                            <th>Après</th>
                        </tr>
                        <?php   
                        if(!empty( $tableau1)) {

    arsort($tableau1);//tri tableau
    foreach ($tableau1 as $k => $val) {
        $val=floor($val);
        ?>
        <tr class="
        <?php
        if($val>100){echo "danger";}
        elseif($val>50){echo "warning";}
        elseif($val>25){echo "success";}
        elseif($val>10){echo "info";}
        else{echo "active";}
        ?>      
        ">
        <td><input class="case" type="checkbox" value="<?php echo $tableau9[$k];?>" name="case"></input></td>
        <td><?php echo $val;?></td>
        <td><?php echo $tableau2[$k]; ?></td>
        <td><?php echo $tableau3[$k]; ?></td>
        <td><?php echo $tableau4[$k]; ?></td>
        <td><?php // tableau5 : remplace id project by project
        $reponse = $bdd->query('SELECT name_project FROM project where id = '.$tableau5[$k]);
        echo $reponse->fetch()[0];
        ?>
        </td>
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
<?php } //fin du foreach 
} //cas du tableau vide
?>
</tbody>
</table>
</div>
<br>
<form>

    <?php include("w/jsExternal.php"); ?>

    <script type="text/javascript">
    function filtreChange(){
        if($("#filtreProjet").val()==0){
            window.location.replace("tasklist.php");            
        }else{
            window.location.replace("tasklist.php?project="+$("#filtreProjet").val()); 
        }      
    }

    $(function(){           
            // edition de la case cochée
            $("#edit").on('click',function(){
                //le each à virer ?
                $(".case:checked").each(function(){
                    //on récupère l'id

                    $(' <input> ').attr({
                        type:"hidden",
                        name:"token",
                        value:"<?php echo $_SESSION['token']; ?>"
                    }).appendTo('form');
                    $('#form').attr('action','index.php?edit='+$(".case:checked").val());
                });
            });
            // suppression des cases cochées
            $("#delete").on('click',function(){
                $(".case:checked").each(function(){
                    $(this).parents("tr").get(0).remove();
                    $.ajax({
                        method: "POST",
                        url: "traitement/delete.php",
                        data: { 
                            id: $(this).val(), 
                            token: "<?php echo $_SESSION['token']; ?>"
                        }
                    })
                });
            });
            //add multiple select / deselect functionnality
            $("#selectall").click(function(){
                $('.case').prop('checked',this.checked);
            });
            // if all checkbox are selected, check the selectall checkbox and viceversa
            $(".case").click(function(){
                if ($(".case:checked").length < 3) {
                    $("#edit").prop("disabled","disable");
                    if ($(".case:checked").length ==1) {
                     $("#edit").prop("disabled","");
                 }
             }
             if ($(".case").length == $(".case:checked").length) {
                $("#selectall").prop("checked","checked");
            }else{
                $("#selectall").removeAttr("checked");
            }                    
        });
        });
</script>
</body>
</html>