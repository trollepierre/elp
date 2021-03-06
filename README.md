# elp
#El Projector
===
//to write again

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

Partie traitement :
	connexion.php pour me connecter avec la bdd
	delete.php pour la suppression des tâches en base de données
	deleteProject.php pour la suppression des projets en base de données
	newEtape.php : KO
	newGeneral : redondance des traitements
	newModeleDeProjet : KO
	newProject : insertion/edition de projets
	newTask : insertion/edition de tâches

Partie w :
	cssExternal : où je prends mes fichiers css
	jsDTPExternal : où je prends mes fichiers Javascript DateTimePicker
	jsExternal : où je prends mes fichiers JS

	pull.php pour le git pull automatique sur mon serveur

## Synopsis

This project is a project and task manager program. Developed from scratch with PHP/jQuery

## Code Example

It's coming!


## Motivation

To know which task I should prioritize at any moment. This project emphatizes the tasks with the highest criticities according to the deadline and own priority.

## Installation

Fork it

## API Reference

None

## Tests

Use your localhost

## Maintainer

[Pierre Trolle](https://github.com/trollepierre) - [@trollepierre](https://twitter.com/PierreTrolle)

## License (MIT)

Copyright (c) Pierre Trolle ("Author")

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
