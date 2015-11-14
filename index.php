<?php require("w/formLaunchToken.php");?>

    <!DOCTYPE HTML>
    <!--
    /*
     * El Projector 
     * https://github.com/trollepierre/tdm
     *
     * Copyright 2015, Pierre Trolle
     * http://pierre.recontact.me
     */
    
    <!-- <html lang="en"> -->
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

<!-- Pour le formulaire, tant qu'on n'envoie pas -->
<?php   if (!isset($_POST["submit"]))  {   ?>

    <!-- le bandeau principal avec le texte -->
        <div id="coeur" class="bandeau">
            <h1>H E L P</h1>
            <h2>El Projector  à la rescousse</h2>
        </div>

        <!-- le bandeau du formulaire de tâche -->
        <div id="task_form" class="bandeau">
            <h3>Ajoutez une tâche :</h3>
            <form action="traitement.php" role="form" id="form" method="post" accept-charset="utf-8" class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12">
                <!-- <div style="display:none;">
                <input type="hidden" name="_method" value="POST"/>
                <input type="hidden" name="data[_Token][key]" value="0e6e74bd6cf9ca9b3229ff15c180a11e1eb6822e" id="Token1108905194"/>
                </div> -->
                <!--  <input type="hidden" name="data[Event][id]" value="14" id="EventId"/> -->
                <fieldset>

                    <!-- ajout tâche -->
                    <div class="form-group">
                        <label for="taskName" class="col-sm-3 control-label">Tâche</label>
                        <div class="input-group col-sm-6 col-xs-12 col-xs-12">
                            <input type="text" class="form-control" id="taskName" placeholder="Nom de la Tâche" />
                        </div>
                    </div>

                    <!-- ajout category -->
                    <div class="form-group">
                        <label for="categoryName" class="col-sm-3 control-label">Catégorie</label>
                        <div class="input-group col-sm-6 col-xs-12">
                            <select class="form-control">
                                <option value="france">Test</option>
                                <option value="espagne">Startup</option>
                                <option value="italie">Taf</option>
                                <option value="royaume-uni">Autre</option>
                            </select>
                        </div>
                    </div>

                    <!-- ajout DL -->
                    <div class="form-group">
                        <label for="dtp_input2" class="col-sm-3 control-label">Date Limite</label>
                        <div class="input-group date form_date col-sm-6 col-xs-12" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" size="16" type="text" value="" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                        <!--  <input type="hidden" id="dtp_input2" value="" /><br/> -->
                    </div>

                    <!-- ajout HL -->
                    <div class="form-group">
                        <label for="dtp_input3" class="col-sm-3 control-label">Heure</label>
                        <div class="input-group date form_time col-sm-6 col-xs-12" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                            <input class="form-control" size="16" type="text" value="" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                        </div>
                        <!--   <input type="hidden" id="dtp_input3" value="" /><br/> -->
                    </div>

                    <!-- ajout tâche prioritaire -->
                    <div class="form-group">
                        <label for="avant" class="col-sm-3 control-label">Avant</label>
                        <div class="input-group col-sm-6 col-xs-12">
                            <select class="form-control">
                                <option value="royaume-uni">Aucun Tâche</option>
                                <option value="france">Task1</option>
                                <option value="espagne">Task2</option>
                                <option value="italie">Task3</option>
                            </select>
                        </div>
                    </div>

                    <!-- ajout tâche suivante -->
                    <div class="form-group">
                        <label for="apres" class="col-sm-3 control-label">Après</label>
                        <div class="input-group col-sm-6 col-xs-12">
                            <select class="form-control">
                                <option value="france">Aucune</option>
                                <option value="espagne">Task1</option>
                                <option value="italie">Task2</option>
                                <option value="royaume-uni">Task3</option>
                            </select>
                        </div>
                    </div>

                    <!-- ajout importance -->
                    <div class="form-group">
                        <label for="apres" class="col-sm-3 control-label">Priorité</label>
                        <div class="input-group col-sm-6 col-xs-12">
                            <select class="form-control">
                                <option value="1">Basse</option>
                                <option value="2">Moyenne</option>
                                <option value="3">Haute</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-default">Envoyer</button>
            </form>

<?php require("w/formSendData.php");?>

            <br>

            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
            <script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

            <!-- langue du calendrier -->
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