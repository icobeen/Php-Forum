<?php
	session_start();

	$_SESSION["a"]="Bonjour";

	error_reporting(E_ALL & ~E_WARNING);

	include("form.php");

	$message="";

	$str="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
	$max=5;
	$cap="";
	for($i=0;$i<$max;$i++){
		$cap.=substr($str,rand(0,strlen($str)-1),1);
	}

	if(isset($valider)){
		if(empty($nom))
			$message="<div class='erreur'>Nom invalide!</div>";
		if(empty($prenom))
			$message.="<div class='erreur'>Prénom invalide!</div>";
		if(!is_numeric($age))
			$message.="<div class='erreur'>Âge invalide!</div>";
		if(strtoupper($captcha)!=$capgen)
			$message.="<div class='erreur'>Code de vérification invalide!</div>";
		if(empty($message))
			$message="<div class='ok'>Parfait!</div>";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Contrôle de saisie</title>
		<link rel="stylesheet" href="css/style.css?nbr=<?=rand()?>" />
	</head>
	<body>
		<form name="fo" method="post" action="">
			<h1 class="h1title">Inscription</h1>
			<div class="label">Nom <span>*</span></div>
			<div class="input">
				<input type="text" name="nom" class="zdt" value="<?=$nom?>" />
			</div>
			<div class="label">Prénom <span>*</span></div>
			<div class="input">
				<input type="text" name="prenom" class="zdt" value="<?=$prenom?>" />
			</div>
			<div class="label">Âge <span>*</span></div>
			<div class="input">
				<input type="number" name="age" class="zdt" min="10" value="<?=$age?>" />
			</div>
			<div class="label captcha"><?=$cap?></div>
			<div class="label">Veuillez saisir le code de vérification ci-dessus <span>*</span></div>
			<div class="input">
				<input type="hidden" name="capgen" class="zdt" value="<?=$cap?>" />
				<input type="text" name="captcha" class="zdt" />
			</div>
			<div class="input">
				<input type="submit" name="valider" class="zdt submit" value="S'inscrire" />
			</div>
		</form>
		<?=$message?>
	</body>
</html>