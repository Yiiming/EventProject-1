<?php
include "../../model/Connexion.php";
include "../../controller/backoffice/updateUser.php";



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mise à jour des utilisateurs</title>
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="../js/jquery-3.2.1.min"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/custom.js"></script>
</head>
<body>
	<?php 
	/*
		//On cherche l'utilisateur qui porte l'id $idUser
		$searchUser = $bdd->prepare("SELECT * FROM RESERVATION WHERE ID = :ID");
		$searchUser->execute(array(
			"ID" => $idUser
		));
		//on saisi les données de l'utilisateur
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
		$searchArtefact = $bdd->prepare("SELECT * FROM ARTEFACT WHERE ID = :ID");
		while($artefact = $searchArtefact->fetch()){
			$nomArtefact = htmlentities(utf8_encode($artefact["nom"]));
		}

		//On cherche l'etat
		$searchEtat = $bdd->prepare("SELECT * FROM ETAT");
		while($etat = $searchEtat->fetch()){
			$nomEtat = htmlentities(utf8_encode($etat["nom"]));
		}
		*/

	?>

	<h2>Mise à jour de l'utilisateur </h2>
	<form method="post" action="">
		<div class="form-group">
			<label for="civilite">Civilite :</label> 
			<label class="radio-inline">
				<input type="radio" name="civilite" id="civilite" value="homme" <?php if($civilite == "homme"){ echo "checked"; } ?> > Homme
			</label>
			<label class="radio-inline">
				<input type="radio" name="civilite" id="civilite" value="femme" <?php if($civilite == "femme"){ echo "checked"; } ?> > Femme
			</label>
		</div>
		<div class="form-group">
			<label for="nom">Nom :</label>
			<input type="text" name="nom" id="nom" value="<?php echo $nom; ?>">
		</div>
		<div class="form-group">
			<label for="prenom">Prenom :</label>
			<input type="text" name="prenom" id="prenom" value="<?php echo $prenom; ?>">
		</div>
		<div class="form-group">
			<label for="mail">Mail :</label>
			<input type="text" name="mail" id="mail" value="<?php echo $mail; ?>">
		</div>
		<div class="form-group">
			<label for="birth">Date de naissance :</label>
			<input type="date" name="birth" id="birth" value="<?php echo $birth; ?>">
		</div>
		<div class="form-group">
			<label for="adresse">Adresse :</label>
			<input type="text" name="adresse" id="adresse" value="<?php echo $adresse; ?>">
		</div>
		<div class="form-group">
			<label for="cp">Code Postal :</label>
			<input type="text" name="cp" id="cp" value="<?php echo $cp; ?>">
		</div>
		<div class="form-group">
			<label for="ville">Ville :</label>
			<input type="text" name="ville" id="ville" value="<?php echo $ville; ?>">
		</div>
		<div class="form-group">
			<label for="telephone">Telephone :</label>
			<input type="text" name="telephone" id="telephone" value="<?php echo $telephone; ?>">
		</div>
		<div class="form-group">
			<label for="camp">Camp :</label>
			<select name="camp" class="camp" id="camp">
				<?php foreach($searchCamp as $camp) :
					//On cherche les camp
					/*$searchCamp = $bdd->query("SELECT * FROM CAMP");
					while($camp = $searchCamp->fetch()){*/
				?>
				<option value="<?php echo $camp["id"];?>" <?php if ($idCamp == $camp["id"]){ echo "selected"; } ?> ><?php echo $camp["nom"]; ?></option>
				<?php
					endforeach;//}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="artefact">Artefact :</label>
			<input type="text" name="artefact" id="artefact" value="<?php echo $idArtefact; ?>">
		</div>
		<div class="form-group">
			<label for="etat">Etat :</label>
			<select name="etat" class="etat" id="etat">
				<?php foreach($searchEtat as $etat) :
					//On cherche les etat
					/*$searchEtat = $bdd->query("SELECT * FROM ETAT");
					while($etat = $searchEtat->fetch()){*/
				?>
				<option value="<?php echo $etat["id"];?>" <?php if ($idEtat == $etat["id"]){ echo "selected"; } ?> ><?php echo htmlentities(utf8_encode($etat["nom"])); ?></option>
				<?php
					endforeach;//}
				?>
			</select>
		</div>
		<input type="submit" class="btn btn-default" name="submit" value="Modifier">
	</form>
</body>
</html>