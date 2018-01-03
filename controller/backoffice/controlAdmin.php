<?php
const login = "admin";
const pass = "admin";
const secret = "leclercq";

session_start();

if(isset($_POST['OK'])){
	if(login == $_POST['login'] && pass == $_POST['pass'] && secret == $_POST['secret']){
		$_SESSION['login'] = $_POST['login'];
		header('location:../backoffice/manageUser.php');
	}else echo "MAUVAISES SAISIES";
}
?>