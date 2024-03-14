<?php
	session_start();
	error_reporting(~E_WARNING);

	if($_SESSION["autoriser"]!="oui"){
		header("location:login.php");
		exit();
	}
	$src=file_exists("./uploads/".$_SESSION["login"].".png")?"./uploads/".$_SESSION["login"].".png":"";
	$message="";
	if($_FILES["photo"]["size"]>0){
		if(!preg_match("#jpeg$|png$#",$_FILES["photo"]["type"]))
			$message="<div class='erreur erreur_photo'>Format du fichier invalide (JPG/JPEG ou PNG seulement)!</div>";
		elseif($_FILES["photo"]["size"]>2000000)
			$message="<div class='erreur erreur_photo'>Fichier trop volumineux (Max: 2Mo)!</div>";
		else{
			move_uploaded_file($_FILES["photo"]["tmp_name"],"./uploads/".$_SESSION["login"].".png");
			header("location:./session.php");
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Espace personnel</title>
		<link rel="stylesheet" href="css/style.css?nbr=<?=rand()?>" />
	</head>
	<body>
		
		<h1 class="h1title">
			<div>Bienvenue <?=$_SESSION["nomPrenom"]?></div>
			<a href="deconnexion.php" class="dcnx">Quitter la session</a>
		</h1>
		<?=$message?>
		<form name="fo" method="post" action="" enctype="multipart/form-data">
			<input type="file" id="inp_upload" name="photo" />
			<label id="ph_profil" for="inp_upload" style="background-image:url('<?=$src."?t=".time()?>')">
				<img src="images/add_photo.png" />
			</label>
		</form>
		<script>
			document.getElementById("inp_upload").addEventListener("change",function(){
					document.fo.submit();
			})
		</script>
	</body>
</html>