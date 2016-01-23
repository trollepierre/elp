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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="title" content="Project Creator - El Projector !"/>
        <meta name="description" content="El Projector is an assistant to help you to manage your life projects.">
        <meta name="author" content="Pierre Trollé">
        <link rel="icon" href="../../favicon.ico">

        <title>Project Creator - El Projector</title>
        
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
        <?php include("w/cssExternal.php"); ?>

        
    </head>

    <body>
        <div class="container">
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
                        <div class "row">
                            <div class="col-lg-7 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12">
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
                                    <label for="duration" class="col-sm-3 control-label">Nb jours</label>
                                    <div class="input-group col-sm-6 col-xs-12">
                                        <input type="value" class="form-control" name="duration" id="duration" placeholder="Durée"/>
                                        <!-- <div class="input-group col-md-6 col-xs-12">
                                            <select class="form-control" id='prior' name='prior'>
                                                <option value="1">Jours</option>
                                                <option value="2">Semaines</option>
                                                <option value="3">Mois</option>
                                                <option value="4">Années</option>
                                                <option value="5">Heures</option>
                                                <option value="6">Minutes</option>
                                            </select>
                                        </div> -->
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
                        </div>
                        <!-- Choix du modèle de projet  -->
                        <div class="row" style="display: none;">
                            <div class="form-group col-xs-12 col-sm-12">
                                <label for="model" class="col-xs-12 control-label">Modèle de Projet</label>
                                
                                <!-- les modèles de projet à insérer -->
                                <?php 
                                $reponse = $bdd->query('SELECT * FROM modeledeprojet');
                                $k=0;
                                while ($val = $reponse->fetch())
                                {
                                    $name[$k] = $val['name'];
                                    $k++;
                                }
                                ?>
                                <ul class="col-xs-12">
                                    <li href="#"  class="linkProjet" role="button" title="image rouge" display="block"> 
                                        <img src="img/rouge.jpg" class="imageProjet"></img>
                                        <br/>
                                        <?php echo $name[2];?>
                                        <br/>
                                        <input type="radio" name="gender" value="2" checked>
                                    </li>
                                    <li href="#"  class="linkProjet" role="button" title="image bigar" display="block"> 
                                        <img src="img/rouge.jpg" class="imageProjet"> </img>
                                        <br/>
                                        <?php echo $name[3];?>
                                        <br/>
                                        <input type="radio" name="gender" value="3">
                                    </li>    
                                    <li href="#"  class="linkProjet" role="button" title="image blanc" display="block"> 
                                        <img src="img/bigar.jpg" class="imageProjet"></img>
                                        <br/>
                                        <?php echo $name[4];?>
                                        </br>
                                        <input type="radio" name="gender" value="4">
                                    </li>    
                                    <li href="#"  class="linkProjet" role="button" title="image rouge"  display="block"> 
                                        <img src="img/blanc.jpg" class="imageProjet"></img>
                                        <br/>
                                        <?php echo $name[0];?>
                                        </br>
                                        <input type="radio" name="gender" value="0">
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-default">Envoyer</button>
                </form>
            </div>
        </div>
        <br>
        <?php include("w/jsExternal.php"); ?>
        <?php include("w/jsDTPExternal.php"); ?>  
        
        <script type="text/javascript">
        
        //selection de l'image *** a faire ***   --> definir un post "model"
        $(function(){                
            
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

    </body>
    </html>