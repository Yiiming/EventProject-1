<?php

class Connexion
{
	public $host = null;
	public $login = null;
	public $pass = null;
	public $bd_name = null;
	public $dbh = null;

	public function __construct($host, $login, $pass, $bd_name) {
		$this->bd_name = $bd_name;
		try {
			$this->dbh = new PDO('mysql:host='.$host.';dbname='.$bd_name, $login, $pass);
			// echo "Connexion de la base de donnée OK! <br />";
			// echo "Connexion de la base de donnée OK! <br />";
		} catch(PDOException $e) {
			print "ERREUR !: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function requete($requete) {
		$resultat = $this->dbh->query($requete, PDO::FETCH_ASSOC);
		return $resultat;
	}

	public function inscription($civilite, $nom, $prenom, $mail, $birth, $adresse, $cp, $ville, $telephone, $camp, $artefact, $datetime) {
		$resultat = $this->dbh->prepare("INSERT INTO reservation (civilite, nom, prenom, mail, birth, adresse, cp, ville, telephone, camp, artefact, etat, date_creation) VALUES ( :civilite, :nom, :prenom, :mail, :birth, :adresse, :cp, :ville, :telephone, :camp, :artefact, :etat, :date_creation)");
		$resultat->execute(array(
			"civilite" => $civilite,
			"nom" => $nom,
			"prenom" => $prenom,
			"mail" => $mail,
			"birth" => $birth,
			"adresse" => $adresse,
			"cp" => $cp,
			"ville" => $ville,
			"telephone" => $telephone,
			"camp" => $camp,
			"artefact" => $artefact,
			"etat" => 1,
			"date_creation" => $datetime
			));
	}

	public function modificationUser($civilite, $nom, $prenom, $mail, $birth, $adresse, $cp, $ville, $telephone, $camp, $artefact, $idEtat, $id){
		$resultat = $this->dbh->prepare("UPDATE reservation SET civilite = :civilite, nom = :nom, prenom = :prenom, mail = :mail, birth = :birth, adresse = :adresse, cp = :cp, ville = :ville, telephone = :telephone, camp = :camp, artefact = :artefact, etat = :etat WHERE id = ".$id);
		$resultat->execute(array(
			"civilite" => $civilite,
			"nom" => $nom,
			"prenom" => $prenom,
			"mail" => $mail,
			"birth" => $birth,
			"adresse" => $adresse,
			"cp" => $cp,
			"ville" => $ville,
			"telephone" => $telephone,
			"camp" => $camp,
			"artefact" => $artefact,
			"etat" => $idEtat
			));
	}

	public function etatRefuse($id){
		$resultat = $this->dbh->prepare("UPDATE reservation SET etat = :etat WHERE id = :id");
		$resultat->execute(array(
			"etat" => 2,
			"id" => $id
		));
		if($resultat->rowCount() == 1){
			return true;
		}else{
			return false;
		}
	}

	public function etatAccepte($id){
		$resultat = $this->dbh->prepare("UPDATE reservation SET etat = :etat WHERE id = :id");
		$resultat->execute(array(
			"etat" => 3,
			"id" => $id
		));
		if($resultat->rowCount() == 1){
			return true;
		}else{
			return false;
		}
	}
}

?>