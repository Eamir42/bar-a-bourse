<?php
require('functions.php');

$type = getAllType($dbh);
$verre = getAllVerre($dbh);
$boisson = getAllBoisson($dbh);
?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Formulaire ajout boisson</title>
	</head>
	<body>
		<div class="wrap">
			<div class="forms">
				<fieldset>
					<form name="boisson" action="" method="POST">
						<label>Nom de la boisson</label><input type="text" name ="nom">
						<label>Quantité</label><input type="number" name="qte">
						<label>Prix</label><input type="number" name ="prix" step="0.01">
						<label>degré d'alcool</label><input type="number" name ="degre">
						<label>Type de boisson: </label>
						<select name="type_bs">
							<?php
								foreach ($type as $value) {
									echo "<option value=".$value['ID_Type'].">".$value['Nom_Type']."</option>";
								}
							?>
						</select>
						<label>Type de verre: </label>
						<select name="verre_bs">
							<?php
								foreach ($verre as $value) {
									echo "<option value=".$value['ID_Verre'].">".$value['Nom_Verre']."</option>";
								}
							?>
						</select>
						<input type="submit" name="boisson">
					</form>
				</fieldset>
			</div>

			<div class="forms">
				<fieldset>
					<form name="verre" method ="POST" action="">
						<label>Ajouter un Verre</label>
						<label>Nom du Verre</label><input type="text" name="nom">
						<label>Quantité en cl</label><input type="number" name="qte">
						<input type="submit" name="verre">
					</form>
				</fieldset>
			</div>
		</div>
		<div class="forms">
			<fieldset>
				<form name="type" method="POST" action="">
					<label>Ajouter un Type de boisson</label>
					<label>Nom du Type</label><input type="text" name="nom">
					<input type="submit" name="type">
				</form>
			</fieldset>
		</div>
		
		<div class="the_form forms">
			<fieldset>
				<form name="cocktail" method="POST" action="">
					<label>Verre utilisé: </label>
					<select name="verre_ck" id="verre_ck" onchange="getQteMax(this.value)">
						<?php
							foreach ($verre as $value) {
								echo "<option value=".$value['ID_Verre'].">".$value['Nom_Verre']."</option>";
							}
						?>
					</select>
					<label>Boisson(s)</label>
					<select name="boisson_ck" id="boisson_ck1">
						<?php
							foreach ($boisson as $value) {
								echo "<option value=".$value['ID_Boisson'].">".$value['Nom_Boisson']."</option>";
							}
						?>
					</select>
					<label>Quantité (cl)</label><input type="number" name="qte" id="qte1">
					<input type="button" name="addchoice" id="addchoice" value="Ajouter une boisson"/><br/>
				</form>
			</fieldset>
			<div id="test"></div>
		</div>

	</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="functions.js"></script>
	<script>
		var addInput = document.getElementById('addchoice');
		addInput.addEventListener('click', function() {
			n = increment(n);
		    var inputbs = document.getElementById('boisson_ck1');
		    var inputqt = document.getElementById('qte1');
		    var input1 = inputbs.cloneNode(true);
		    var input2 = inputqt.cloneNode(true);
		    input1.setAttribute("id", (inputbs.id.substr(0,10) + n));
		    input2.setAttribute("id", (inputqt.id.substr(0,3) + n));
		    inputbs.parentNode.appendChild(input1);
		    inputqt.parentNode.appendChild(input2);
		}, false);

		var n = 1;
		function increment(n){
			n++;
			return n;
		}

		function getQteMax(value){
			var test = teste_ajax(value);
			alert(test);
		}
		

	</script>
</html>




<?php
var_dump($_POST);
if (!empty($_POST)) {

	if (isset($_POST['boisson'])) {
		if (isset($_POST['nom'])) {
			if (isset($_POST['prix'])) {
				if (isset($_POST['degre'])) {
					$stmt = $dbh->prepare("INSERT INTO boisson (Nom_Boisson, Qte_Bouteille_Boisson, Prix_Boisson, Dgr_Alcool_Boisson, ID_Type, ID_Verre) VALUES (:name, :qte, :price, :ethanol, :type, :verre)");
					$stmt->bindParam(':name', $_POST['nom']);
					$stmt->bindParam(':qte', $_POST['qte']);
					$stmt->bindParam(':price', $_POST['prix']);
					$stmt->bindParam(':ethanol', $_POST['degre']);
					$stmt->bindParam(':type', $_POST['type_bs']);
					$stmt->bindParam(':verre', $_POST['verre_bs']);
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

	if (isset($_POST['verre'])) {
		if (isset($_POST['nom'])) {
			if (isset($_POST['qte'])) {
				$stmt = $dbh->prepare("INSERT INTO verre (Nom_Verre, Quantite_Verre) values(:name, :qte)");
				$stmt->bindParam(':name', $_POST['nom']);
				$stmt->bindParam(':qte', $_POST['qte']);
				$stmt->execute();
			}else{
				echo "champ QUANTITE non renseigné";
			}
		}else{
			echo "champ NOM non renseigné";
		}
	}

	if (isset($_POST['type'])) {
		if (isset($_POST['nom'])) {
			$stmt = $dbh->prepare('INSERT INTO type (Nom_Type) values (:name)');
			$stmt->bindParam(':name', $_POST['nom']);
			$stmt->execute();
		}else{
			echo "champ NOM non renseigné";
		}
	}
}

?>


