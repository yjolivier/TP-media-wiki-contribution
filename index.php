<?php
	//Saisie du username
	echo "Veuillez renseigner le nom d'utilisateur \n";
	$username = readline();
	$link = 'https://fr.wikipedia.org/w/api.php?list=usercontribs&ucuser='.urlencode($username).'&format=json&action=query&uclimit=10';

	//Recuperation du contenu du lien pour le mettre dans une variable $link_content 
	$link_content = file_get_contents($link); 

	//convert json string to array
	$contributions = json_decode($link_content, true);

	
	if (isset($contributions["query"]["usercontribs"])) {
		foreach ($contributions["query"]["usercontribs"] as $content) {
			echo "\n" . $content["user"] ."\n";
			echo $content["title"] ."\n";
			echo $content["timestamp"] ."\n";
			echo $content["comment"] ."\n";
			echo "\n";
		}	
	}
	/*var_dump(json_decode($link_content, true)) ;*/
?>