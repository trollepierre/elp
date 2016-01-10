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
        
        <meta name="title" content="Nouveau Modèle de Projet - El Projector !"/>
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="">

        <title>Nouveau Modèle de Projet - El Projector </title>

        <?php include("w/cssExternal.php"); ?>

    </head>
    <body>
        <!-- Le bandeau principal avec le texte -->
        <div id="coeur" class="bandeau">
            <h1>Nouveau Modèle de Projet - El Projector</h1>
            <h2></h2>
        </div>
        
        <form id="form_name" accept-charset="utf-8">
            <label for="name_model" class="col-sm-3 col-md-4 control-label">Modèle de Projet</label>
            <div class="input-group col-sm-6 col-md-4 col-xs-10">
                <input type="text" class="form-control" name="name_model" id="name_model" maxlength="50" placeholder="Nom du Modèle de Projet" required autofocus/>
            </div>
            <button id="envoi" class="btn btn-info" type="submit"><i class="glyphicon glyphicon-folder-open"></i> Nom renseigné</button>
        </form>
        <br>
        <button id="next" class="btn btn-warning" type="button"><i class="glyphicon glyphicon-plus"></i> Etape suivante</button>
        <button id="delete" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-trash"></i> Supprimer</button>
        <br/><br>

        <form id="form" accept-charset="utf-8">
            <button id="terminer" class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok"></i> Terminer</button>
            <br> 
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-condensed table-striped">
                    <tbody>
                        <tr>
                            <th><input id="selectall" type="checkbox" autofocus></th>
                            <th>N° étape</th>
                            <th>Nom étape</th>
                            <th>Date Limite</th>
                            <th>Durée</th>
                            <th>Priorité</th>
                        </tr>

                        <tr>
                            <td><input class="case" type="checkbox" value="unchecked" name="case"/></td>
                            <td><input type="value" class="form-control"  name="id_etape" id="id_etape" placeholder="1"/></td>
                            <td><input type="text" class="form-control" placeholder="Nom Etape" name="name_etape" id="name_etape"/></td>
                            <td><input class="form-control" size="16" type="text" value="" placeholder="dd/mm/yyyy" name="dl_etape" id="dl_etape" maxlength="10" pattern="[0-3]{1}[0-9]{1}/[0-1]{1}[0-9]{1}/[0-9]{4}"/></td>
                            <td>
                                <div class="col-sm-6 col-xs-12">
                                    <input type="value" class="form-control" name="duree_etape" id="duree_etape" placeholder="Nombre"/>
                                </div>
                                <div class="input-group col-sm-6 col-xs-12">
                                    <select class="form-control" id='period_etape' name='period_etape'>
                                       <option value="1">Jours</option>
                                       <option value="2">Semaines</option>
                                       <option value="3">Mois</option>
                                       <option value="4">Années</option>
                                       <option value="5">Heures</option>
                                       <option value="6">Minutes</option>
                                   </select>
                               </div>
                           </td>
                           <td>
                            <select class="form-control" id='prior_etape' name='prior_etape'>
                                <option value="1">Basse</option>
                                <option value="2">Moyenne</option>
                                <option value="3">Haute</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <br>
    <?php include("w/jsExternal.php"); ?>

    <script type="text/javascript">
    $(function(){ 
            // creation du modele de projet d'après le nom
            $("#form_name").submit(function(event){
                alert("envoi");
                $.ajax({
                    method: "POST",
                    url: "traitement/newModeleDeProjet.php",
                    data: {
                        name_modeleproject: document.forms["form_name"]["name_model"].value ,
                        token: "<?php echo $_SESSION['token']; ?>"
                    }
                });
                alert("reception");
                event.preventDefault();
            });

            // ajout d'une étape supplémentaire
            /*$("#next").on('click',function(){
                //sauvegarde d'une étape
                alert("envoi");
                $.ajax({
                    method: "POST",
                    url: "traitement/newEtape.php",
                    data: {
                        name_modeleproject: document.forms["form"]["name_model"].value) ,
                        id_etape: document.forms["form"]["id_etape"].value) ,
                        name_etape: document.forms["form"]["name_etape"].value) ,
                        dl_etape: document.forms["form"]["dl_etape"].value) ,
                        duree_etape: document.forms["form"]["duree_etape"].value) ,
                        period_etape: document.forms["form"]["period_etape"].value) ,
                        prior_etape: document.forms["form"]["prior_etape"].value) ,
                        token: "<?php echo $_SESSION['token']; ?>"
                    },
                    alert("reception");
                    event.preventDefault();
                })
});*/

            // projet complétement renseigné
            $("#form").submit(function(event){
                alert("envoi");
                $.ajax({
                    method: "POST",
                    url: "traitement/newEtape.php", // en mode update ?
                    data: {
                        name_modeleproject: document.forms["form_name"]["name_model"].value ,
                        id_etape: document.forms["form"]["id_etape"].value ,
                        name_etape: document.forms["form"]["name_etape"].value ,
                        dl_etape: document.forms["form"]["dl_etape"].value ,
                        duree_etape: document.forms["form"]["duree_etape"].value ,
                        period_etape: document.forms["form"]["period_etape"].value ,
                        prior_etape: document.forms["form"]["prior_etape"].value ,
                        token: "<?php echo $_SESSION['token']; ?>"
                    },
                });
                alert("reception");
                event.preventDefault();
            });

            // suppression des cases cochées
            /*$("#delete").on('click',function(){
                $(".case:checked").each(function(){
                    $(this).parents("tr").get(0).remove();
                    $.ajax({
                        method: "POST",
                        url: "traitement/deleteStep.php",
                        data: { 
                            id: $(this).val(), 
                            token: "<?php echo $_SESSION['token']; ?>"
                        },
                    })
                });
});*/
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
</script>
</body>
</html>