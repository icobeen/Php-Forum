<?php
	session_start();
	$fp=fopen("cpt.txt","r+");
	$str=fgets($fp);

	if(@$_SESSION["deja_visitee"]!="oui"){
		$str++;
		fseek($fp,0);
		fputs($fp,$str);
		$_SESSION["deja_visitee"]="oui";
	}


	echo "Cette page a été visitée ".$str." fois.";

?>