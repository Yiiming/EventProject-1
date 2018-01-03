<?php

include "../../model/Connexion.php";

$connect = new Connexion('127.0.0.1', 'root', '', 'eventProject');

session_start();

if(isset($_SESSION['login'])){

}else{
	header('location:index.php');
}

$page = 0;
if(isset($_GET["page"])){
	$page = (int)$_GET["page"];
}

$response = "";
$success = 0;

//On compte toutes les lignes de réservations
$nbrUser = $connect->requete("SELECT COUNT(*) FROM RESERVATION WHERE ETAT = 1");
//On va les compter et les stocker dans une variable
$count = $nbrUser->fetchColumn();
//On va définir le nombre de ligne qu'on souhaite avoir
$nbrLigne = (int)10;
//On va définir la ligne
$ligne = (int)$nbrLigne * $page;
//On arrondi la valeur à l'entier supérieur pour avoir un système de pagination 
$nbrPage = ceil($count/$nbrLigne);

$subscriber = $connect->requete("SELECT RESERVATION.ID AS ID, CIVILITE, RESERVATION.NOM AS NOM, PRENOM, MAIL, BIRTH, ADRESSE, CP, VILLE, TELEPHONE, CAMP.NOM AS CAMP, ARTEFACT.NOM AS ARTEFACT, DATE_CREATION, ETAT.NOM AS ETAT FROM RESERVATION, ETAT, ARTEFACT, CAMP WHERE RESERVATION.ETAT = ETAT.ID AND RESERVATION.ARTEFACT = ARTEFACT.ID AND RESERVATION.CAMP = CAMP.ID AND ETAT.ID = 1 ORDER BY DATE_CREATION DESC LIMIT $ligne, $nbrLigne");


?>