<?php
require('functions.php');

$type = getAllType($dbh);
$verre = getAllVerre($dbh);
?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Formulaire ajout boisson</title>
	</head>
	<body>
		<fieldset>
			<form name="boisson" action="" method="POST">
				<label>Nom de la boisson</label><input type="text" name ="nom">
				<label>Quantité</label><input type="number" name="qte">
				<label>Prix</label><input type="number" name ="prix" step="0.01">
				<label>degré d'alcool</label><input type="number" name ="degre">
				<label>Type de boisson: </label>
				<select name="type">
					<?php
						foreach ($type as $value) {
							echo "<option value=".$value['ID_Type'].">".$value['Nom_Type']."</option>";
						}
					?>
				</select>
				<label>Type de verre: </label>
				<select name="verre">
					<?php
						foreach ($verre as $value) {
							echo "<option value=".$value['ID_Verre'].">".$value['Nom_Verre']."</option>";
						}
					?>
				</select>
				<input type="submit">
			</form>
		</fieldset>
	</body>
</html>




<?php
if (!empty($_POST)) {
	if (isset($_POST['nom'])) {
		echo "nom";
		if (isset($_POST['prix'])) {
			echo "prix";
			if (isset($_POST['degre'])) {
				echo "all";
				$stmt = $dbh->prepare("INSERT INTO boisson (Nom_Boisson, Qte_Bouteille_Boisson, Prix_Boisson, Dgr_Alcool_Boisson, ID_Type, ID_Verre) VALUES (:name, :qte, :price, :ethanol, :type, :verre)");
				$stmt->bindParam(':name', $_POST['nom']);
				$stmt->bindParam(':qte', $_POST['qte']);
				$stmt->bindParam(':price', $_POST['prix']);
				$stmt->bindParam(':ethanol', $_POST['degre']);
				$stmt->bindParam(':type', $_POST['type']);
				$stmt->bindParam(':verre', $_POST['verre']);
				$stmt->execute();

			}else{
				echo "champ DEGRE non renseigné";
			}
		}else{
			echo "champ PRIX non renseigné";
		}
	}else{
		echo "champ NOM non renseigné";
	}
}

?>