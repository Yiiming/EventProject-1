<?php

$connect = new Connexion('127.0.0.1', 'root', '', 'eventProject');

session_start();

if(isset($_SESSION['login'])){

}else{
	header('location:index.php');
}

//Si on a bien un id et non null
if(isset($_GET["id"]) && $_GET["id"] != ""){
	$idUser = (int)$_GET["id"];
}else{
	header("location:manageUser.php");
}

$searchUser = $connect->requete("SELECT * FROM RESERVATION WHERE ID = ".$idUser);
$user = $searchUser->fetch();
$civilite = htmlentities(utf8_encode($user["civilite"]));
$nom = htmlentities(utf8_encode($user["nom"]));
$prenom = htmlentities(utf8_encode($user["prenom"]));
$mail = htmlentities(utf8_encode($user["mail"]));
$birth = $user["birth"];
$adresse = htmlentities(utf8_encode($user["adresse"]));
$cp = $user["cp"];
$ville = htmlentities(utf8_encode($user["ville"]));
$telephone = $user["telephone"];
$idCamp = $user["camp"];
$idArtefact = $user["artefact"];
$idEtat = $user["etat"];

$searchArtefact = $connect->requete("SELECT * FROM ARTEFACT WHERE ID = ".$idUser);
while($artefact = $searchArtefact->fetch()){
	$nomArtefact = htmlentities(utf8_encode($artefact["nom"]));
}

$searchEtat = $connect->requete("SELECT * FROM ETAT");
while($etat = $searchEtat->fetch()){
	$nomEtat = htmlentities(utf8_encode($etat["nom"]));
}

$searchCamp = $connect->requete("SELECT * FROM CAMP");

$searchEtat = $connect->requete("SELECT * FROM ETAT");

if(isset($_POST['submit'])){
	$civilite = $_POST['civilite'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$mail = $_POST['mail'];
	$birth = $_POST['birth'];
	$adresse = $_POST['adresse'];
	$cp = $_POST['cp'];
	$ville = $_POST['ville'];
	$telephone = $_POST['telephone'];
	$camp = $_POST['camp'];
	$artefact = $_POST['artefact'];
	$idEtat = $_POST['etat'];
	if(isset($_POST['civilite'], $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['birth'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['telephone'], $_POST['camp'], $_POST['artefact'], $_POST['etat']))
	{
		if($civilite && $nom && $prenom && $adresse && $cp && $ville && $mail && $birth && $telephone && $camp && $artefact && $idEtat)
		{
			if(preg_match("/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/", $mail))
			{
				$result = $connect->requete("SELECT * FROM reservation WHERE id=".$idUser);
				$row = $result->rowCount($result);
				if($row != 0){
					$reqUpd = $connect->modificationUser($civilite, $nom, $prenom, $mail, $birth, $adresse, $cp, $ville, $telephone, $camp, $artefact, $idEtat, $idUser);
					if($reqUpd){
						
					}else header("location:manageUser.php");
				}else echo "l'identifiant de l'utilisateur n'existe pas";
			}else echo "recommencer à saisir l'adresse mail correctement exemple : Example@example.com ou 78ExAm.ple@eXAmPle.fr";
		}else echo "veuillez saisir tous les champs";
	}else echo "ERROR 404";
}
					
?>