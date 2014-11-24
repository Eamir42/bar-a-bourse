<?php
session_start();
$test_log="admin";
$test_admin="admin";

if (!empty($_POST)) {

	if (empty($_POST['login']) || empty($_POST['pwd']) ) //Oublie d'un champ
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
    Vous devez remplir tous les champs</p>
    <p>Cliquez <a href="./connexion.php">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
    	if ($_POST['login'] == $test_admin && $_POST['pwd'] == $test_log) {
    		echo "WIN";
    	}elseif ($_POST['login'] != $test_admin) {
    		echo "login invalide!";
    	}elseif ($_POST['pwd'] != $test_log) {
    		echo "mdp invalide!";
    	}
        // $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_pseudo = :pseudo');
        // $query->bindValue(':pseudo',$_POST['login'], PDO::PARAM_STR);
        // $query->execute();
        // $data=$query->fetch();
    	// if ($data['membre_mdp'] == md5($_POST['pwd'])) // Acces OK !
    	// {
     //    	$_SESSION['pseudo'] = $data['membre_pseudo'];
     //    	$_SESSION['id'] = $data['membre_id'];
     //    	$message = '<p>Bienvenue '.$data['membre_pseudo'].', 
     //        vous êtes maintenant connecté!</p>
     //        <p>Cliquez <a href="./index.php">ici</a> 
     //        pour revenir à la page d accueil</p>';  
    	// }
    	// else // Acces pas OK !
    	// {
     //    	$message = '<p>Une erreur s\'est produite 
     //    	pendant votre identification.<br /> Le mot de passe ou le pseudo 
     //    	    entré n\'est pas correcte.</p><p>Cliquez <a href="./connexion.php">ici</a> 
     //    	pour revenir à la page précédente
     //    	<br /><br />Cliquez <a href="./index.php">ici</a> 
     //    	pour revenir à la page d accueil</p>';
    	// }
    // $query->CloseCursor();
    }
    // echo $message.'</div></body></html>';

}



?>

<html>
	<head>
		
	</head>
	<body>
		<form name="log_in" action="" method="POST">
			<fieldset>
				<input type="text" name="login">
				<input type="password" name="pwd">
				<input type="submit">
			</fieldset>
		</form>
	</body>
</html>
