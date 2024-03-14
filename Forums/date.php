<?php
	$jour=["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"];
	$mois=["","janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"];
	echo $jour[date("w")]." ".date("j")." ".$mois[date("n")]." ".date("Y");
?>