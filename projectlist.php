<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();
    $_SESSION['token'] = (isset($_SESSION['token'])) ? $_SESSION['token'] : uniqid(rand(), true) ;//Génération de jeton unique
    $_SESSION['token_time'] = time();//Enregistrement d'un timestamp
    include_once 'traitement/connexion.php'; ?>
    <!DOCTYPE HTML>
    <html lang="fr">
    <head>
        <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="title" content="Liste des tâches - El Projector !"/>
        <meta name="description" content="El Projector is an assistant to help you to manage your life projects.">
        <meta name="author" content="Pierre Trollé">
        <link rel="icon" href="../../favicon.ico">

        <title>Liste des Projets - El Projector </title>

        <?php include("w/cssExternal.php"); ?>

    </head>

    <body>
        <?php if (login_check($mysqli) == false) : ?>
        <p>
            <span class="error">Vous n’avez pas les autorisations nécessaires pour accéder à cette page.</span> Please <a href="index.php">login</a>.
        </p>
    <?php else : ?>
    <p>Bienvenue <?php echo htmlentities($_SESSION['username']); ?> !</p>
    <!-- Le bandeau principal avec le texte -->
    <div id="coeur" class="bandeau">
        <h1>H E L P - El Projector  à la rescousse </h1>
        <h2></h2>
    </div>
    <form action="taskCreator.php?edit=1" id="form" method="post" accept-charset="utf-8" >

        <a href="projectCreator.php" id="add" class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>  Ajouter</a>
        <button id="delete" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-trash"></i> Supprimer</button>
        <button id="edit" class="btn btn-warning" disabled="disabled" type="submit"><i class="glyphicon glyphicon-pencil"></i> Modifier </button>
        <a href="taskCreator.php" id="add" class="btn btn-info" type="button"><i class="glyphicon glyphicon-plus"></i>  Ajouter une tâche</a>
        <a href="tasklist.php" id="add" class="btn btn-primary" type="button"><i class="glyphicon glyphicon-plus"></i>  Voir la liste des tâches</a>
        <br/><br>
        <?php
        $reponse = $bdd->query('SELECT * FROM project');
        $k=0;
        while ($val = $reponse->fetch())
        {
            $tableau1[$k] = $val['name_project'];
            $tableau2[$k] = $val['dl'];
            $tableau3[$k] = $val['prior'];
            $tableau4[$k] = $val['prior'];
            $tableau9[$k] = $val['id'];
            $k++;
        }
        ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-condensed table-striped">
                <tbody>
                    <tr>
                        <th><input id="selectall" type="checkbox" autofocus></th>
                        <th>Nom du Projet</th>
                        <th>Date Limite</th>
                        <th>Durée</th>
                        <th>Priorité</th>
                    </tr>
                    <?php   
                    if(!empty( $tableau1)) {

    arsort($tableau1);//tri tableau
    foreach ($tableau1 as $k => $val) {
        $val=floor($val);
        ?>
        <tr class="active">
            <td><input class="case" type="checkbox" value="<?php echo $tableau9[$k];?>" name="case"></input></td>
            <td><?php echo $tableau1[$k]; ?></td>
            <td><?php echo $tableau2[$k]; ?></td>
            <td><?php echo $tableau3[$k]; ?></td>
            <td><?php 
            $priorite=$tableau4[$k];
            if ($priorite=="3") {
                echo "Haute";
            }elseif ($priorite=="2") {
                echo "Moyenne";
            }else{
                echo "Basse";
            }?>
        </td>

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
                    $('#form').attr('action','projectCreator.php?edit='+$(".case:checked").val());
                });
            });
            // suppression des cases cochées
            $("#delete").on('click',function(){
                $(".case:checked").each(function(){
                    $(this).parents("tr").get(0).remove();
                    alert("Attention les tâches affectées à ce projet seront réaffectées au projet Général");
                    $.ajax({
                        method: "POST",
                        url: "traitement/deleteProject.php",
                        data: { 
                            id: $(this).val(), 
                            token: "<?php echo $_SESSION['token']; ?>"
                        }
                    });
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
<?php endif; ?>
</body>
</html>