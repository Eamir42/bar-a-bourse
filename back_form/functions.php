<?php
require_once('bdd_connect.php');

function getAllType($dbh){
	$stmt = $dbh->prepare("SELECT * FROM type");
				$stmt->execute();
				$result = $stmt->fetchAll();
				return $result;
}

function getAllVerre($dbh){
	$stmt = $dbh->prepare("SELECT * FROM verre");
				$stmt->execute();
				$result = $stmt->fetchAll();
				return $result;
}

function getAllBoisson($dbh){
	$stmt = $dbh->prepare("SELECT * FROM boisson");
				$stmt->execute();
				$result = $stmt->fetchAll();
				return $result;
}

function getAllCocktails($dbh){
	$stmt = $dbh->prepare("SELECT * FROM cocktails");
				$stmt->execute();
				$result = $stmt->fetchAll();
				return $result;
}

function getVerreContenance($dbh,$id){
	$stmt = $dbh->prepare("SELECT Quantite_Verre FROM verre WHERE ID_Verre = :id");
				$stmt->bindParam(':id', $id);
				$stmt->execute();
				$result = $stmt->fetch();
				return $result;
}

function checkLogin($dbh,$POST){
	$pwd = md5($POST['pwd']);
	$stmt = $dbh->prepare("SELECT ID_Membre, Pseudo_membre, statut_membre FROM membres WHERE Pseudo_membre = :name AND Pwd_Membres = :pwd");
			$stmt->bindParam(':name', $POST['login']);
			$stmt->bindParam(':pwd', $pwd);
			$stmt->execute();
			$result = $stmt->fetch();
			return $result;
}

function signIn($dbh,$POST){
	$pwd = md5($POST['pwd']);
	$stmt = $dbh->prepare('INSERT INTO membres (Pseudo_membre,Pwd_Membres, statut_membre) values(:name,:pwd,3)');
			$stmt->bindParam(':name', $POST['login']);
			$stmt->bindParam(':pwd', $pwd);
			if ($stmt->execute()) {
				return true;
			}else{
				return false;
			}
}

// function