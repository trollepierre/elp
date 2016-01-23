<?php   
    session_start();//On démarre les sessions
    $_SESSION['token'] = (isset($_SESSION['token'])) ? $_SESSION['token'] : uniqid(rand(), true) ;//Génération de jeton unique
    $_SESSION['token_time'] = time();//Enregistrement d'un timestamp
    ?>
    <?php include('traitement/connexion.php'); ?>
    <!DOCTYPE HTML>
<!--
    /*
    * El Projector 
    * https://github.com/trollepierre/elp
    * Copyright 2015, Pierre Trolle
    * http://pierre.recontact.me
    */
-->
<html lang="fr"> 
<head>
    <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="title" content="El Projector !"/>
    <meta name="description" content="El Projector is an assistant to help you to manage your life projects.">
    <meta name="author" content="Pierre Trollé">
    <link rel="icon" href="../../favicon.ico">

    <title>El Projector</title>
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
    <?php include("w/cssExternal.php"); ?>

</head>

<body>

    <?php if(isset($_GET['edit'])){
        $edit=$_GET['edit'];
        $reponse = $bdd->query('SELECT * FROM task where id = '.$edit.'');        
        while ($val = $reponse->fetch())
        {
            $name_task=html_entity_decode($val['name_task']);
            $id_project = $val['id_project'];
            $dlATraiter = $val['dl'];
            $hl =  str_split($val['hl'],5)[0]; 
            $prior = $val['prior'];
            $av = $val['av'];
            $ap = $val['ap'];
            $dlCoupee = explode("-", $dlATraiter);
            $dl = $dlCoupee[2]."/".$dlCoupee[1]."/".$dlCoupee[0];
        }
        $accueil="Editez votre tâche :";
        // echo '<script type="text/javascript"> alert("Mode édition !") </script>';
    }
    elseif (isset($_GET['bug'])){
        $accueil="Bug : tâche non ajoutée";
        echo '<script type="text/javascript"> alert("Bug ! Désolé : la tâche non ajoutée !") </script>';
    }else{
    $accueil="Ajoutez une tâche :";
    }
    ?>

    <!-- Le bandeau principal avec le texte -->
    <div id="coeur" class="bandeau">
        <h1> H E L P - El Projector à la rescousse</h1>
        <h2><a href="tasklist.php" class="underline" title="Voir la liste des tâches">Voir la liste des tâches</a></h2>
    </div>

    <!-- Le bandeau du formulaire de tâche -->
    <div id="task_form" class="bandeau">
        <h3><?php echo $accueil; ?></h3>
        <form id="form" accept-charset="utf-8" class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12">
            <div style="display:none;">
                <input type="hidden" name="token" value=<?php echo $_SESSION['token']; ?> />
            </div> 
            <fieldset>
                <!-- Ajout du nom de la tâche -->
                <div class="form-group">
                    <label for="name_task" class="col-sm-3 control-label">Tâche</label>
                    <div class="input-group col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="name_task" id="name_task" maxlength="50" 
                        <?php echo (isset($_GET['edit'])) ? "value='$name_task'" : "placeholder='Nom de la Tâche'" ; ?> required autofocus/>
                    </div>
                </div>

                <!-- Ajout de la catégorie -->
                <div class="form-group">
                    <label for="id_project" class="col-sm-3 control-label"><a href="projectCreator.php"> Projet</a></label>
                    <div class="input-group col-sm-6 col-xs-12">
                        <select class="form-control" id="id_project" name="id_project">
                            <?php 
                            $reponse = $bdd->query('SELECT * FROM project');
                            $k=0;
                            while ($val = $reponse->fetch())
                            {
                                echo "<option value=".$val['id'].">".$val['name_project']."</option>";
                                $k++;
                            }
                            ?>
                            <option value="0">Nouveau Projet</option>
                            <?php echo $name[2];?>
                                <!-- <option value="1">Startup</option>
                                <option value="2">Taf</option>
                                <option value="3">Autre</option> -->
                        </select>
                    </div>
                </div>

                    <!-- Ajout de la DL -->
                    <div class="form-group">
                        <label for="dl" class="col-sm-3 control-label">Date Limite</label>
                        <div class="input-group date form_date col-sm-6 col-xs-12" data-date="" data-date-format="dd/mm/yyyy" data-link-field="dl" data-link-format="dd/mm/yyyy">
                            <input class="form-control" size="16" type="text"  <?php echo (isset($_GET['edit'])) ? "value=".$dl : "placeholder='dd/mm/yyyy' value=''" ; ?> name="dl" id="dl" maxlength="10" pattern="[0-3]{1}[0-9]{1}/[0-1]{1}[0-9]{1}/[0-9]{4}" required >
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>

                        </div>
                    </div>

                    <!-- Ajout de la HL -->
                    <div class="form-group">
                        <label for="hl" class="col-sm-3 control-label">Heure Limite</label>
                        <div class="input-group date form_time col-sm-6 col-xs-12" data-date="" data-date-format="hh:ii" data-link-field="hl" data-link-format="hh:ii">
                            <input class="form-control" size="16" type="text" <?php echo (isset($_GET['edit'])) ? "value=".$hl : "value='12:00'" ; ?> name="hl"  id="hl" pattern="[0-2]{0,1}[0-9]{1}:[0-5]{1}[0-9]{1}" maxlength="8" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                        </div>
                    </div>

                    <!-- Ajout de tâche précédente -->
                    <div class="form-group">
                        <label for="av" class="col-sm-3 control-label">Avant</label>
                        <div class="input-group col-sm-6 col-xs-12">
                            <select class="form-control" id='av' name='av'>
                                <option value="0">Aucun Tâche</option>
                                <!-- <option value="1">Task1</option>
                                <option value="2">Task2</option>
                                <option value="3">Task3</option> -->
                            </select>
                        </div>
                    </div>

                    <!-- Ajout de tâche suivante -->
                    <div class="form-group">
                        <label for="ap" class="col-sm-3 control-label">Après</label>
                        <div class="input-group col-sm-6 col-xs-12">
                            <select class="form-control" id='ap' name='ap'>
                                <option value="0">Aucune Tâche</option>
                                <!-- <option value="1">Task1</option>
                                <option value="2">Task2</option>
                                <option value="3-uni">Task3</option> -->
                            </select>
                        </div>
                    </div>

                    <!-- Ajout de l'importance -->
                    <div class="form-group">
                        <label for="prior" class="col-sm-3 control-label">Priorité</label>
                        <div class="input-group col-sm-6 col-xs-12">
                            <select class="form-control" id='prior' name='prior'>
                                <option value="1">Basse</option>
                                
                                <?php if ($prior>1)  {
                                    if($prior>2){
                                        echo   '<option value="2">Moyenne</option>
                                        <option value="3" selected="selected">Haute</option>';
                                    }else{
                                        echo   '<option value="2" selected="selected">Moyenne</option>
                                        <option value="3">Haute</option>';
                                    }
                                }else{
                                     echo   '<option value="2">Moyenne</option>
                                             <option value="3">Haute</option>';
                                }

                            ?>
                        </select>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-default">Envoyer</button>
        </form>
    </div>
    <br>

    <?php include("w/jsExternal.php"); ?>
    <?php include("w/jsDTPExternal.php"); ?>  

    <script type="text/javascript">
    $(function(){
        // si l'utiilisateur choisit un "Nouveau Projet"
        $( "select" ).change(function() {
            if ($( "select option:selected" ).val() == "0"){
                window.location.replace("projectCreator.php?new=on");
            }
        })
            // envoi du formulaire
            $("#form").submit(function(event){
                if (validateForm()) {
                    $.ajax({
                        method: "POST",
                        url: "traitement/newTask.php<?php echo (isset($_GET['edit'])) ? '?edit='.$edit : '';?>",
                        data: { 
                            name_task: document.forms["form"]["name_task"].value ,
                            id_project: document.forms["form"]["id_project"].value ,
                            prior: document.forms["form"]["prior"].value ,
                            av: document.forms["form"]["av"].value ,
                            ap: document.forms["form"]["ap"].value ,
                            hl: document.forms["form"]["hl"].value ,
                            dl: document.forms["form"]["dl"].value ,
                            token: "<?php echo $_SESSION['token']; ?>"
                        }
                    })
                    <?php $retVal = (isset($_GET['edit'])) ? "éditée" : "ajoutée" ;?>
                    alert("La tâche a été <?php echo $retVal; ?> avec succès !");
                    event.preventDefault();
                };
            });
});
function validateForm(){
    var dl = document.forms["form"]["dl"].value ;
    var hl = document.forms["form"]["hl"].value ;
            // alert("voici : "+x+' !');
            var tableau = dl.split("/");
            var tableauH = hl.split(":");
            if (dl==null || dl == "" || tableau[1]>12 || tableau[0]>31){
                alert("Le format de la date n'est pas correct. Utilisez le format dd/mm/yyyy");
                return false;
            }
            if(tableauH[0]>23){
                alert("Depuis quand les montres affichent des heures de plus de 24h ?");
                return false;  
            }
            if(tableau[0]> [31, ((((tableau[2] % 4 === 0) && (tableau[2] % 100 !== 0)) || (tableau[2] % 400 === 0)) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][tableau[1]-1]){
                alert("Et la Saint Glinglin, c'est tous les 35 du mois, aussi ?");
                return false;     
            }
            if (tableau[2]<2015 || tableau[2]>2017){
                if(confirm('Une tâche prévue pour '+tableau[2]+' ? Vous confirmez ?')){
                    return true;
                }
                return false;
            }
            return true;
        }
        </script>

    </body>
    </html>