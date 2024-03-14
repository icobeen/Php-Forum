<?php
	session_start();

	error_reporting(E_ALL & ~E_WARNING);
	include("form.php");
	$message="";
	if(isset($valider)){
		$existe=false;
		$fp=fopen("shadow.txt","r");
		while(!feof($fp)){
			$tab=explode(":",fgets($fp));
			if($tab[2]==$login && substr($tab[3],0,32)==md5($pass)){
				$existe=true;
				$_SESSION["autoriser"]="oui";
				$_SESSION["nomPrenom"]=strtoupper($tab[0]." ".$tab[1]);
				$_SESSION["login"]=$tab[2];
				header("location:session.php");
			}
		}
		if(!$existe){
			$message="<div class='erreur'>Mauvais login ou mot de passe!</div>";
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="css/style.css?nbr=<?=rand()?>" />
	</head>
	<body>
		<form name="fo" method="post" action="">
			<h1 class="h1title">Authentification requise</h1>
			<div class="label msg">Vous n'avez pas encore de compte? <a href="inscription.php" class="insc">Inscription</a></div>
			<?=$message?>
			<div class="label">Login <span>*</span></div>
			<div class="input">
				<input type="text" name="login" class="zdt" value="<?=$login?>" />
			</div>
			<div class="label">Mot de passe <span>*</span></div>
			<div class="input">
				<input type="password" name="pass" class="zdt" />
			</div>
			
			<div class="input">
				<input type="submit" name="valider" class="zdt submit" value="S'authentifier" />
			</div>
		</form>
	</body>
</html>