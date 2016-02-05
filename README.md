# elp
#El Projector
===
*Visible sur l'adresse elprojector.recontact.me*

Ce site est un prototype de manager de task intelligent lié à l'urgence et l'échéance.

---

**Contenu**

	css : contient le css.css (aka main.css) + le css de bootstrap date time picker 
	fonts : pour les glyphicons
	includes : fonctions utiles - dossier dissimulé
	js : pour sécuriser la connexion : sha512 et forms.js
	log : pour les logs d'erreur de traitement
	traitement : tout ce qui est caché à l'utilisateur, traitement des tâches, projets
	w : pour éviter la redondance de code, les import css et js

J'utilise :
	taskCreator.php pour l'insertion de tâches
	tasklist.php pour l'affichage de la liste des tâches triées automatiquement
	projectCreator.php pour l'insertion de projets
	projectlist.php pour l'affichage de la liste des projets triées automatiquement
	definir.php // KO  : en cours de développement

Partie sécurité :
	index.php = login.php
	register.php : enregistrement
	register success.php : enregistrement réussi
	error.php : erreur d'enregistrement



	delete.php pour la suppression des tâches en base de données

	connexion.php pour me connecter avec la bdd
	pull.php pour le git pull automatique sur mon serveur

	

Le 02/02/2016 à 12h