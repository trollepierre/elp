<?php   
    session_start();//On démarre les sessions
    $_SESSION['token'] = (isset($_SESSION['token'])) ? $_SESSION['token'] : uniqid(rand(), true) ;//Génération de jeton unique
    $_SESSION['token_time'] = time();//Enregistrement d'un timestamp
    ?>
    <!DOCTYPE HTML>
    <html lang="fr"> 
    <head>
        <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="title" content="Project Creator - El Projector !"/>
        <meta name="description" content="El Projector is an assistant to help you to manage your life projects.">
        <meta name="author" content="Pierre Trollé">
        <link rel="icon" href="../../favicon.ico">

        <title>Project Creator - El Projector</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <!--   <link rel="stylesheet" href="../1external/bootstrap.min.css"> -->
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
        <link rel="stylesheet" href="css/css.css">
    </head>

    <body>

        <!-- Le bandeau principal avec le texte -->
        <div id="coeur" class="bandeau">
            <h1> H E L P - El Projector à la rescousse</h1>
            <h2>Project Creator</h2>
        </div>

        <!-- Le bandeau du formulaire de tâche -->
        <div id="task_form" class="bandeau">
            <!-- <h3>Créer un projet :</h3> -->
            <form action="traitement/newProject.php" id="form" method="post" onsubmit="return validateForm()" accept-charset="utf-8">
                <div style="display:none;">
                    <input type="hidden" name="token" value=<?php echo $_SESSION['token']; ?> />
                </div> 
                <fieldset>
                    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12">
                        <!-- Ajout du nom du projet -->
                        <div class="form-group">
                            <label for="name_project" class="col-sm-3 control-label">Projet</label>
                            <div class="input-group col-sm-6 col-xs-12">
                                <input type="text" class="form-control" name="name_project" id="name_project" maxlength="50" placeholder="Nom du Projet" required autofocus/>
                            </div>
                        </div>

                        <!-- Ajout de la DL -->
                        <div class="form-group">
                            <label for="dl" class="col-sm-3 control-label">Date Limite</label>
                            <div class="input-group date form_date col-sm-6 col-xs-12" data-date="" data-date-format="dd/mm/yyyy" data-link-field="dl" data-link-format="dd/mm/yyyy">
                                <input class="form-control" size="16" type="text" value="" placeholder="dd/mm/yyyy" name="dl" id="dl" maxlength="10" pattern="[0-3]{1}[0-9]{1}/[0-1]{1}[0-9]{1}/[0-9]{4}" required >
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                        </div>

                        <!-- Ajout du la durée ??? -->
                        <div class="form-group">
                            <label for="duration" class="col-sm-3 control-label">Durée ?</label>
                            <div class="input-group col-sm-6 col-xs-12">
                                <input type="text" class="form-control" name="duration" id="duration" maxlength="50" placeholder="Durée estimée"/>
                            </div>
                        </div>

                        <!-- Ajout de l'importance -->
                        <div class="form-group">
                            <label for="prior" class="col-sm-3 control-label">Priorité</label>
                            <div class="input-group col-sm-6 col-xs-12">
                                <select class="form-control" id='prior' name='prior'>
                                    <option value="1">Basse</option>
                                    <option value="2">Moyenne</option>
                                    <option value="3">Haute</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-2"></div>
                    <!-- Choix du modèle de projet  -->
                    <div class="form-group">
                        <label for="model" class="col-xs-12 control-label">Modèle de Projet</label>
                        <a href="#"  class="linkProjet" role="button" title="image bigar"> 
                            <img src="img/bigar.jpg" class="imageProjet"></img>
                        </a>    
                        <a href="#"  class="linkProjet" role="button" title="image blanc"> 
                            <img src="img/blanc.jpg" class="imageProjet"></img>
                        </a>    
                        <a href="#"  class="linkProjet" role="button" title="image rouge"> 
                            <img src="img/rouge.jpg" class="imageProjet"></img>
                        </a>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-default">Envoyer</button>
            </form>
        </div>
        <br>
        <!-- <script type="text/javascript" src="../1external/jquery-11.1.3.min.js"></script> -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
        <!-- <script type="text/javascript" src="../1external/bootstrap.min.js"></script> -->
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://externals.recontact.me/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="http://externals.recontact.me/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
        <!-- <script type="text/javascript" src="../1external/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="../1external/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script> -->
        <script type="text/javascript">
        
        //selection de l'image *** a faire ***   --> definir un post "model"
        $(function(){                
            // suppression des cases cochées
            $(".linkProjet").on('click',function(){
                $(".case:checked").each(function(){
                    $(this).parents("tr").get(0).remove();
                    $.ajax({
                        method: "POST",
                        url: "traitement/delete.php",
                        data: { 
                            id: $(this).val(), 
                            token: "<?php echo $_SESSION['token']; ?>"
                        },
                    })
                });
            });
            //add multiple select / deselect functionnality
            $("#selectall").click(function(){
                $('.case').prop('checked',this.checked);
            });
            // if all checkbox are selected, check the selectall checkbox and viceversa
            $(".case").click(function(){
                if ($(".case").length == $(".case:checked").length) {
                    $("#selectall").prop("checked","checked");
                }else{
                    $("#selectall").removeAttr("checked");
                }                    
            });
        });
        
        function validateForm(){
            var dl = document.forms["form"]["dl"].value ;
            // alert("voici : "+x+' !');
            var tableau = dl.split("/");
            if (dl==null || dl == "" || tableau[1]>12 || tableau[0]>31){
                alert("Le format de la date n'est pas correct. Utilisez le format dd/mm/yyyy");
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