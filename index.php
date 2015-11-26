<?php   
// Token pour Formulaire
session_start();//On démarre les sessions
$token = uniqid(rand(), true);//On génére un jeton totalement unique (c'est capital :D)
$_SESSION['token'] = $token;//Et on le stocke
$_SESSION['token_time'] = time();//On enregistre aussi le timestamp correspondant au moment de la création du token
//Maintenant, on affiche notre page normalement, le champ caché token en plus
?>
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

<?php if(isset($_GET['message'])){echo '<script type="text/javascript"> alert("La tâche a été ajoutée avec succès !") </script>';}?>

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
                    <input type="hidden" name="token" value=<?php echo $token; ?> />
                </div> 
                <fieldset>
                    <!-- Ajout du nom de la tâche -->
                    <div class="form-group">
                        <label for="name_task" class="col-sm-3 control-label">Tâche</label>
                        <div class="input-group col-sm-6 col-xs-12 col-xs-12">
                            <input type="text" class="form-control" id="name_task" name="name_task" placeholder="Nom de la Tâche" required/>
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
                            <input class="form-control" size="16" type="text" value="" name="dl" required >
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>

                        </div>
                        <!--  <input type="hidden" id="dl" value="" /><br/> -->
                    </div>

                    <!-- Ajout de la HL -->
                    <div class="form-group">
                        <label for="hl" class="col-sm-3 control-label">Heure Limite</label>
                        <div class="input-group date form_time col-sm-6 col-xs-12" data-date="" data-date-format="hh:ii" data-link-field="hl" data-link-format="hh:ii">
                            <input class="form-control" size="16" type="time" value="8:00" name="hl">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                        </div>
                        <!--   <input type="hidden" id="hl" value="" /><br/> -->
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


            <br>

            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
            <script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>


            <script type="text/javascript">
           /* function validateForm(){
                var x = document.forms["myForm"]["fname"].value;
                if (x==null || x = ""){
                    alert("Name must be filled out");
                    return false;
                }
            }*/

            /*var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1;
            var yy = today.getYear();
            if(dd<10){dd='0'+dd}
            if(mm<10){mm='0'+mm}
            today= yy + '-' + mm + '-' + dd;
            document.getElementsByName('dl').value = today;
            */</script>
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