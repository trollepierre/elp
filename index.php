<!DOCTYPE HTML>
    <!--
    /*
     * El Projector 
     * https://github.com/trollepierre/tdm
     *
     * Copyright 2015, Pierre Trolle
     * http://pierre.recontact.me
     *
     * Licensed under the MIT license:
     * http://www.opensource.org/licenses/MIT
     */
    -->
    <!-- <html lang="en"> -->
<head>
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <meta charset="utf-8">
    <title>El Projector</title>
    <meta name="description" content="El Projector is an assistant to help you to manage your life projects.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/qqch.css"> -->
</head>

<body>
    <h1>H E L P</h1>
    <h2>El Projector  <br> à la rescousse</h2>
    <div id="task_form">
        <form action="undefined.php" method="post" accept-charset="utf-8">
            <!-- <div style="display:none;">
                <input type="hidden" name="_method" value="POST"/>
                <input type="hidden" name="data[_Token][key]" value="0e6e74bd6cf9ca9b3229ff15c180a11e1eb6822e" id="Token1108905194"/>
            </div> -->
           <!--  <input type="hidden" name="data[Event][id]" value="14" id="EventId"/> -->
            <fieldset>
               <legend>Ajoutez la tâche</legend> <!-- Titre du fieldset --> 
    
               <label for="taskName">Quoi ?</label>
               <input type="text" name="taskName" id="taskName" />
    
               <label for="categoryName">Catégorie :?</label>
               <select name="categoryName" id="categoryName">
                   <optgroup label="Prédéfinies">
                       <option value="france">Test</option>
                       <option value="espagne">Startup</option>
                       <option value="italie">Taf</option>
                       <option value="royaume-uni">Autre</option>
                   </optgroup>
               </select>
                    
                <label for="dl">DL :</label>
                <input type="text" name="dl" id="dl" />
         
                <label for="av">Avant :</label>
                <input type="text" name="av" id="av" />
                
                <label for="ap">Après :</label>
                <input type="text" name="ap" id="ap" />

               <label for="prior">Priorité :</label>
               <input type="text" name="prior" id="prior" />
           </fieldset>
        </form>

    <br>
<!--     <script src="js/load-image.js"></script> -->
    <!-- jQuery and Jcrop are not required by JavaScript Load Image, but included for the demo -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!--      <script src="js/demo.js"></script> -->
</body> 
</html>
