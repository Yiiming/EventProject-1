<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gestion admin</title>
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<script src="../js/jquery-3.2.1.min"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/custom.js"></script>
</head>
<body>
	<?php
		//include "../../model/Connexion.php";
		include "../../controller/backoffice/userManage.php";
		
		// Faker pour insérer des données

		// require_once("../../Faker/src/autoload.php");

		// $faker = Faker\Factory::create('fr_FR');
		// $subscribe = $bdd->prepare("INSERT INTO RESERVATION(ID, CIVILITE, NOM, PRENOM, MAIL, BIRTH, ADRESSE, CP, VILLE, TELEPHONE, CAMP, ARTEFACT, ETAT, DATE_CREATION) VALUES (NULL, :CIVILITE, :NOM, :PRENOM, :MAIL, :BIRTH, :ADRESSE, :CP, :VILLE, :TELEPHONE, :CAMP, :ARTEFACT, :ETAT, :DATE_CREATION)");
		// for ($i = 0; $i < 50; $i++){
		// 	$title = htmlspecialchars(utf8_decode($faker->title($gender = null|'male'|'female')));
		// 	$mail = htmlspecialchars(utf8_decode($faker->email));
		// 	$firstname = htmlspecialchars(utf8_decode($faker->firstname));
		// 	$lastname = htmlspecialchars(utf8_decode($faker->lastname));
		// 	$date = htmlspecialchars(utf8_decode($faker->dateTimeThisCentury->format('Y-m-d')));
		// 	$streetAddress = htmlspecialchars(utf8_decode($faker->streetAddress));
		// 	$postcode = htmlspecialchars(utf8_decode($faker->postcode));
		// 	$city = htmlspecialchars(utf8_decode($faker->city));
		// 	$phoneNumber = htmlspecialchars(utf8_decode($faker->phoneNumber));
		// 	$camp = (int)htmlspecialchars(utf8_decode(mt_rand(1,5)));
		// 	$artefact = (int)htmlspecialchars(utf8_decode(mt_rand(1,6)));
		// 	$etat = (int)htmlspecialchars(utf8_decode(mt_rand(1,3)));
		// 	$date_creation = htmlspecialchars(utf8_decode("2017-12-28 15:46:25"));

		// 	$subscribe->execute(array(
		// 		"CIVILITE" => $title,
		// 		"NOM" => $lastname,
		// 		"PRENOM" => $firstname,
		// 		"MAIL" => $mail,
		// 		"BIRTH" => "2017-12-28", 
		// 		"ADRESSE" => $streetAddress,
		// 		"CP" => $postcode,
		// 		"VILLE" => $city, 
		// 		"TELEPHONE" => $phoneNumber,
		// 		"CAMP" => $camp,
		// 		"ARTEFACT" => $artefact, 
		// 		"ETAT" => $etat,
		// 		"DATE_CREATION" => $date_creation 
		// 	));
		// }
		
	?>
	<h1>Gestion administrateur</h1>
	<div id="tabs">
		<ul class="nav nav-tabs">
			<li class="inscriptionTabs active"><a href="#state1">Inscription en attente</a></li>
			<li class="inscriptionTabs"><a href="#state2">Inscription validée</a></li>
			<li class="inscriptionTabs"><a href="#state3">Inscription refusée</a></li>
		</ul>
	
		<!-- Inscription en cours de validation -->
		<div id="state1" class="page active">
		<?php

		?>
	
		<table class="table">
			<tr>
				<th>Civilite</th>
				<th>Nom</th>
				<th>Prenom</th>
				<th>Mail</th>
				<th>date naissance</th>
				<th>adresse</th>
				<th>code postal</th>
				<th>Ville</th>
				<th>telephone</th>
				<th>camp</th>
				<th>artefact</th>
				<th>etat</th>
				<th>date_creation</th>
				<th>Modifier etat</th>
			</tr>
			<?php
			foreach($subscriber as $user) :  
				//while($user = $subscriber->fetch()){ 
				
			?>
			<form method="post" action="" class="user" role="form" enctype="multipart/form-data">
				
				<tr>
					<td class="civilite"><?php echo htmlentities(utf8_encode($user['CIVILITE'])); ?></td>
					<td class="nom"><?php echo htmlentities(utf8_encode($user['NOM'])); ?></td>
					<td class="prenom"><?php echo htmlentities(utf8_encode($user['PRENOM'])); ?></td>
					<td class="mail"><?php echo htmlentities(utf8_encode($user['MAIL'])); ?></td>
					<td class="birth"><?php echo htmlentities(utf8_encode($user['BIRTH'])); ?></td>
					<td class="adresse"><?php echo htmlentities(utf8_encode($user['ADRESSE'])); ?></td>
					<td class="cp"><?php echo htmlentities(utf8_encode($user['CP'])); ?></td>
					<td class="ville"><?php echo htmlentities(utf8_encode($user['VILLE'])); ?></td>
					<td class="phone"><?php echo htmlentities(utf8_encode($user['TELEPHONE'])); ?></td>
					<td class="camp"><?php echo htmlentities(utf8_encode($user['CAMP'])); ?></td>
					<td class="artefact"><?php echo htmlentities(utf8_encode($user['ARTEFACT'])); ?></td>
					<td class="etat"><?php echo htmlentities(utf8_encode($user['ETAT'])); ?></td>
					<td class="date_creation"><?php echo date("d-m-Y H:i:s", strtotime($user['DATE_CREATION'])); ?></td>
					<td>
						<button type="submit" style="color:red" title="refuser le profil" class="refuse"  name="id_value" value="<?php echo $user['ID']; ?>"><i class="fa fa-times" aria-hidden="true"></i></button> 
						<button type="submit" style="color:green" title="accepter le profil" class="accepted" name="id_value" value="<?php echo $user['ID']; ?>"><i class="fa fa-check" aria-hidden="true"></i></button>
						<button type="button" onClick="location.href='updateuser.php?id=<?php echo $user['ID']; ?>'" title="modifier le profil" class="updated" name="id_value" value="<?php echo htmlentities(utf8_encode($user['ID'])); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
						
					</td>
				</tr>
			</form>
			<?php
				endforeach;	
				//}
			?>
		</table>
		<div class="text-center">
			<ul class="pager">
				<?php 
				if($page > 0){
				?>
					<li><a href='manageUser.php?page=<?php echo $page-1;?>'><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Précédent</a></li>
				<?php
				}
				?>

				<?php
				if($page < $nbrPage-1){ 
				?>
					<li><a href='manageUser.php?page=<?php echo $page+1;?>'>Suivant <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></li>
				<?php
				}
				?>
			</ul>
		</div>
		</div>
		<div id="state2" class="page">
			hello 2
		</div>
		<div id="state3" class="page">
			hello 3
		</div>
	</div>
</body>
</html>