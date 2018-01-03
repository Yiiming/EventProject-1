<?php

require "../../model/Connexion.php";

$connect = new Connexion('127.0.0.1', 'root', '', 'eventProject');

$art_response[] = "";
$id_response[] = "";
$img_response[] = "";


if(isset($_POST['camp'])){

	$camp = (int)$_POST["camp"];
	
	$i = 0;

	$artefact = $connect->requete("SELECT * FROM artefact WHERE idcamp = ".$camp);
	while($nomArtefact = $artefact->fetch()){
		$id_response[$i] = $nomArtefact["id"];
		$art_response[$i] = $nomArtefact["nom"];
		$encoded_image = base64_encode($nomArtefact["img"]);
		$img_response[$i] = $encoded_image;
		$i++;
	}
}

	header('Content-type: application/json');
	echo json_encode(array('id_response' => $id_response,'art_response' => $art_response, 'img_response' => $img_response));
?>