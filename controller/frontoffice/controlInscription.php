<?php

$connect = new Connexion('127.0.0.1', 'root', '', 'eventProject');

$camps = $connect->requete("SELECT * FROM camp");

$datetime = date("Y-m-d H:i:s");

session_start();



if(isset($_POST['submit']))
{
	$civilite = $_POST['civilite'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$mail = $_POST['mail'];
	$birth = $_POST['birth'];
	$adresse = $_POST['adresse'];
	$cp = $_POST['CP'];
	$ville = $_POST['ville'];
	$telephone = $_POST['telephone'];
	$camp = $_POST['camp'];
	$artefact = $_POST['artefact'];
	$captcha = strtoupper($_POST["captcha"]);

	if(isset($_POST['civilite'], $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['birth'], $_POST['adresse'], $_POST['CP'], $_POST['ville'], $_POST['telephone'], $_POST['camp'], $_POST['artefact']))
	{
		if($civilite && $nom && $prenom && $adresse && $cp && $ville && $mail && $birth && $telephone && $camp && $artefact)
		{
			if(is_numeric($cp) && is_numeric($telephone)){
				if($captcha == $_SESSION["nomPerso"]){
					if(preg_match("/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/", $mail))
					{
						$result = $connect->requete("SELECT * FROM reservation WHERE mail='$mail'");
						$row = $result->rowCount($result);
						if($row==0)
						{
							$reqIns = $connect->inscription($civilite, $nom, $prenom, $mail, $birth, $adresse, $cp, $ville, $telephone, $camp, $artefact, $datetime);
							if($reqIns)
							{
								$to = 'xiongthierry@hotmail.fr'; // Le destinataire de votre e-mail
								$subject = 'test envoi mail';
								$message = 'Bonjour,\nCeci est un message de test.\nA bientot !';
								$headers = 'From: "Webmaster de Votresite.com" <postmaster@team-oppai.fr>';
								$headers .= 'Message-ID: <test1234567890>';
								mail($to, $subject, $message, $headers);
								
							}header('location:index.php');
							//die("Inscription terminée <a href='index.php'> connectez-vous </a>");					
						}else echo"Cette adresse mail existe déjà ! ";
					}else echo "recommencer à saisir l'adresse mail correctement exemple : Example@example.com ou 78ExAm.ple@eXAmPle.fr";
				}else echo "saisir le nom de personnage";
			}else echo "mauvaise type";
		}else echo "veuillez saisir tous les champs";
	}else echo "ERROR 404";
}

/*$searchUser = $connect->requete("SELECT * FROM RESERVATION WHERE ID = :ID");
$user = $searchUser->fetch();
$civilite = htmlentities(utf8_encode($user["civilite"]));
$nom = htmlentities(utf8_encode($user["nom"]));
$prenom = htmlentities(utf8_encode($user["prenom"]));
$mail = htmlentities(utf8_encode($user["mail"]));
$birth = date("d-m-Y", strtotime($user["birth"]));
$adresse = htmlentities(utf8_encode($user["adresse"]));
$cp = $user["cp"];
$ville = htmlentities(utf8_encode($user["ville"]));
$telephone = $user["telephone"];
$idCamp = $user["camp"];
$idArtefact = $user["artefact"];
$idEtat = $user["etat"];


//On cherche les artefacts
$searchArtefact = $connect->requete("SELECT * FROM ARTEFACT WHERE ID = :ID");
while($artefact = $searchArtefact->fetch()){
	$nomArtefact = htmlentities(utf8_encode($artefact["nom"]));
}

//On cherche l'etat
$searchEtat = $connect->requete("SELECT * FROM ETAT");
while($etat = $searchEtat->fetch()){
	$nomEtat = htmlentities(utf8_encode($etat["nom"]));
}*/

?>