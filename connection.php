<?php
	// nom de l'hôte 
	$host="localhost";
	//nom de l'utilisateur de la bd
	$user="root";
	//nom de passe de la bd
	$mdp="";
	// nom de la bd
	$db="db_blog";
	//lien de connection
	$link=mysqli_connect($host,$user,$mdp);
	mysqli_select_db($link,$db);


 ?>