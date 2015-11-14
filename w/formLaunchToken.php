<?php   
// Token pour Formulaire
session_start();//On démarre les sessions
$token = uniqid(rand(), true);//On génére un jeton totalement unique (c'est capital :D)
$_SESSION['token'] = $token;//Et on le stocke
$_SESSION['token_time'] = time();//On enregistre aussi le timestamp correspondant au moment de la création du token
//Maintenant, on affiche notre page normalement, le champ caché token en plus
?>