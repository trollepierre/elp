<?php   
    session_start();//On démarre les sessions
    $_SESSION['token'] = (isset($_SESSION['token'])) ? $_SESSION['token'] : uniqid(rand(), true) ;//Génération de jeton unique
    $_SESSION['token_time'] = time();//Enregistrement d'un timestamp
?>
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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="title" content="El Projector !"/>
        <meta name="description" content="El Projector is an assistant to help you to manage your life projects.">
        <meta name="author" content="Pierre Trollé">
        <link rel="icon" href="../../favicon.ico">

        <title>El Projector</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <!--   <link rel="stylesheet" href="../1external/bootstrap.min.css"> -->
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
        <link rel="stylesheet" href="css/css.css">
    </head>

    <body>

<?php if(isset($_GET['message'])){echo '<script type="text/javascript"> alert("La tâche a été ajoutée avec succès !") </script>';}
    elseif (isset($_GET['bug'])){echo '<script type="text/javascript"> alert("Bug ! Désolé : la tâche non ajoutée !") </script>';}
?>

        <!-- Le bandeau principal avec le texte -->
        <div id="coeur" class="bandeau">
            <h1>H E L P</h1>
            <h2>El Projector  à la rescousse</h2>
        </div>

        <!-- Le bandeau du formulaire de tâche -->
        <div id="task_form" class="bandeau">
            <h3>Ajoutez une tâche :</h3>
            <form action="traitement.php" role="form" id="form" method="post" onsubmit="return validateForm()" accept-charset="utf-8" class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12">
                <div style="display:none;">
                    <input type="hidden" name="token" value=<?php echo $_SESSION['token']; ?> />
                </div> 
                <fieldset>
                    <!-- Ajout du nom de la tâche -->
                    <div class="form-group">
                        <label for="name_task" class="col-sm-3 control-label">Tâche</label>
                        <div class="input-group col-sm-6 col-xs-12">
                            <input type="text" class="form-control" id="name_task" name="name_task" maxlength="50" placeholder="Nom de la Tâche" required autofocus/>
                        </div>
                    </div>

                    <!-- Ajout de la catégorie -->
                    <div class="form-group">
                        <label for="id_category" class="col-sm-3 control-label">Catégorie</label>
                        <div class="input-group col-sm-6 col-xs-12">
                            <select class="form-control" name="id_category">
                                <option value="0">Aucune Catégorie</option>
                                <!-- <option value="1">Startup</option>
                                <option value="2">Taf</option>
                                <option value="3">Autre</option> -->
                            </select>
                        </div>
                    </div>

                    <!-- Ajout de la DL -->
                    <div class="form-group">
                        <label for="dl" class="col-sm-3 control-label">Date Limite</label>
                        <div class="input-group date form_date col-sm-6 col-xs-12" data-date="" data-date-format="yy-mm-dd" data-link-field="dl" data-link-format="yy-mm-dd">
                            <input class="form-control" size="16" type="text" value="" placeholder="yy-mm-dd" name="dl" maxlength="8" pattern="[0-9]{2}-[0-9]{1,2}-[0-9]{1,2}" required >
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>

                        </div>
                    </div>

                    <!-- Ajout de la HL -->
                    <div class="form-group">
                        <label for="hl" class="col-sm-3 control-label">Heure Limite</label>
                        <div class="input-group date form_time col-sm-6 col-xs-12" data-date="" data-date-format="hh:ii" data-link-field="hl" data-link-format="hh:ii">
                            <input class="form-control" size="16" type="time" placeholder="hh:mm" value="8:00" name="hl" pattern="[0-2]{0,1}[0-9]{1}:[0-5]{1}[0-9]{1}" maxlength="8" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                        </div>
                    </div>

                    <!-- Ajout de tâche précédente -->
                    <div class="form-group">
                        <label for="av" class="col-sm-3 control-label">Avant</label>
                        <div class="input-group col-sm-6 col-xs-12">
                            <select class="form-control" name='av'>
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
                            <select class="form-control" name='ap'>
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
                            <select class="form-control" name='prior'>
                                <option value="1">Basse</option>
                                <option value="2">Moyenne</option>
                                <option value="3">Haute</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-default">Envoyer</button>
            </form>
        </div>
        <br>
        <!-- <script type="text/javascript" src="../1external/bootstrap.min.js"></script> -->
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <!-- <script type="text/javascript" src="../1external/jquery-11.1.3.min.js"></script> -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
        <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
        <script type="text/javascript">
        function validateForm(){
            var dl = document.forms["form"]["dl"].value ;
            var hl = document.forms["form"]["hl"].value ;
            // alert("voici : "+x+' !');
            var tableau = dl.split("-");
            var tableauH = hl.split(":");
            if (dl==null || dl == "" || tableau[1]>12 || tableau[2]>31){
                alert("Le format de la date n'est pas correct. Utilisez le format yy-mm-dd");
                return false;
            }
            if (tableau[0]<15 || tableau[0]>17){
                if(confirm('Une tâche prévue pour '+tableau[0]+' ? Vous confirmez ?')){
                    return true;
                }
                return false;
            }
            if(tableauH[0]>23){
                alert("Depuis quand les montres affichent des heures de plus de 24h ?");
                return false;  
            }
            return true;
        }
        </script>
        <!-- Langue du calendrier -->
        <script type="text/javascript">
            $('.form_date').datetimepicker({
                language: 'fr',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
            $('.form_time').datetimepicker({
                language: 'fr',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 1,
                minView: 0,
                maxView: 1,
                forceParse: 0
            });
        </script>
    </body>
</html>