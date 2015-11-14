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


    <!-- Le bandeau principal avec le texte -->
        <div id="coeur" class="bandeau">
            <h1>H E L P</h1>
            <h2>El Projector  à la rescousse</h2>
        </div>

        <!-- Le bandeau du formulaire de tâche -->
        <div id="task_form" class="bandeau">
            <h3>Ajoutez une tâche :</h3>
            <form action="traitement.php" role="form" id="form" method="post" accept-charset="utf-8" class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12">
                <div style="display:none;">
                    <input type="hidden" name="token" value=<?php echo htmlspecialchars($token); ?> />
                    <!-- <input type="hidden" name="token" value=time()/> -->
                    <!-- <input type="hidden" name="_method" value="POST"/>
                    <input type="hidden" name="data[_Token][key]" value="0e6e74bd6cf9ca9b3229ff15c180a11e1eb6822e" id="Token1108905194"/> -->
                </div> 
                <!--  <input type="hidden" name="data[Event][id]" value="14" id="EventId"/> -->
                <fieldset>

                    <!-- Ajout du nom de la tâche -->
                    <div class="form-group">
                        <label for="name_task" class="col-sm-3 control-label">Tâche</label>
                        <div class="input-group col-sm-6 col-xs-12 col-xs-12">
                            <input type="text" class="form-control" id="name_task" name="name_task" placeholder="Nom de la Tâche" />
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
                            <input class="form-control" size="16" type="text" value="" name="dl"  >
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>

                        </div>
                        <!--  <input type="hidden" id="dl" value="" /><br/> -->
                    </div>

                    <!-- Ajout de la HL -->
                    <div class="form-group">
                        <label for="hl" class="col-sm-3 control-label">Heure Limite</label>
                        <div class="input-group date form_time col-sm-6 col-xs-12" data-date="" data-date-format="hh:ii" data-link-field="hl" data-link-format="hh:ii">
                            <input class="form-control" size="16" type="time" value="" name="hl" >
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