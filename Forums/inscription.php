<?php
	session_start();
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
		if(!preg_match("#^[a-zA-zéèêïÉÈÊÏ \-]+$#",$nom))
			$message="<div class='erreur'>Nom invalide!</div>";
		elseif(!preg_match("#^[a-zA-zéèêïÉÈÊÏ \-]+$#",$prenom))
			$message="<div class='erreur'>Prénom invalide!</div>";
		elseif(!preg_match("#^\w{6,12}$#",$login))
			$message="<div class='erreur'>Login invalide!</div>";
		elseif(preg_match("#[a-z]#",$pass1)+preg_match("#[A-Z]#",$pass1)+preg_match("#[0-9]#",$pass1)!=3 || strlen($pass1)<6)
			$message="<div class='erreur'>Mot de passe invalide!</div>";
		elseif($pass1!=$pass2)
			$message="<div class='erreur'>Mot de passes non identiques!</div>";
		elseif(strtoupper($captcha)!=$capgen)
			$message="<div class='erreur'>Code de vérification invalide!</div>";
		if(empty($message)){
			$fp=fopen("shadow.txt","r");
			$existe=false;
			while(!feof($fp)){
				$tab=explode(":",fgets($fp));
				if($tab[2]==$login){
					$message="<div class='erreur'>Login existe déjà!</div>";
					$existe=true;
					break;
				}
			}
			if(!$existe){
				$fp=fopen("shadow.txt","a+");
				fputs($fp,$nom.":".$prenom.":".$login.":".md5($pass1)."\n");
				header("location:login.php");
			}
		}
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
			<h1 class="h1title">Inscription <div class="date"><?php include("date.php") ?></div></h1>
			<div class="label msg">Vous avez dejà un compte? <a href="login.php" class="insc">Authentifiation</a></div>
			<?=$message?>
			<div class="label">Nom <span>*</span></div>
			<div class="input">
				<input type="text" name="nom" class="zdt" value="<?=$nom?>" />
			</div>
			<div class="label">Prénom <span>*</span></div>
			<div class="input">
				<input type="text" name="prenom" class="zdt" value="<?=$prenom?>" />
			</div>
			<div class="label">Login <span>*</span><i>Entre 6 et 12 caracètres alphabétiques, numériques et _</i></div>
			<div class="input">
				<input type="text" name="login" class="zdt" value="<?=$login?>" />
			</div>
			<div class="label">Mot de passe <span>*</span><i>Minimum 6 caracètres combinant minuscule, majuscule et chiffre</i></div>
			<div class="input">
				<input type="password" name="pass1" class="zdt" value="<?=$pass1?>" />
			</div>
			<div class="label">Confirmation du mot de passe <span>*</span></div>
			<div class="input">
				<input type="password" name="pass2" class="zdt" value="<?=$pass2?>" />
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
	</body>
</html>