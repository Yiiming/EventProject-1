<?php

include "../../model/Connexion.php";

$connect = new Connexion('127.0.0.1', 'root', '', 'eventProject');

if((isset($_POST["refused"]) && isset($_POST["id_value"]))){
	$refused = $_POST["refused"];
	$id = (int)$_POST["id_value"];

	$nameUser = $connect->requete("SELECT * FROM RESERVATION WHERE ID = ".$id);

	$user = $nameUser->fetch();
	$nom = $user["nom"];
	$prenom = $user["prenom"];

	$state = 2;

	$updateState = $connect->etatRefuse($id);
	echo $updateState." YOSH";

	if($updateState){
		$response = "L'utilisateur " . $nom . " " . $prenom . " a été refusé avec succès";
		$success = 1;
	}else{
		$response = "Problème technique : merci de réessayer ultérieurement";
		$success = 0;
	}	

} elseif((isset($_POST["accepted"]) && isset($_POST["id_value"]))){
	$id = (int)$_POST["id_value"];
	$accepted = $_POST["accepted"];
	$nameUser = $connect->requete("SELECT * FROM RESERVATION WHERE ID = ".$id);

	$user = $nameUser->fetch();
	$nom = $user["nom"];
	$prenom = $user["prenom"];
	$state = 3;
	
	$updateState = $connect->etatAccepte($id);
	if($updateState){
		$response = "L'utilisateur " . $nom . " " . $prenom . " a été validé avec succès";
		$success = 1;
	}else{
		$response = "Problème technique : merci de réessayer ultérieurement";
		$success = 0;
	}
		
}

header('Content-type: application/json');
json_encode(array('response' => $response, 'success' => $success));
?>