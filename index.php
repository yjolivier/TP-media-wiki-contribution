<?php

	/*

	 * Auteurs: Jean Olivier Yao & Paul Bouaffou ;

	 * Description: Programme permettant de donner le nombre de contributions d'un utilisateur
	 				sur les Projets WIKI en langue française (Exemples: Wikipédia, Wikimedia Commons,
	 				Wikiquote, Wikidata, Wikitionnaire, ...). [NB]: Il s'exécute en ligne de commande ; 

	 * Licence: MIT ;

	*/

	// Saisie du username
	echo "Veuillez renseigner votre nom d'utilisateur \n";
	$username = readline();

	// Tableau numéroté de lien des projets WIKI
	$project_wiki_name = array('fr.wikipedia.org', 'commons.wikimedia.org', 'fr.wikiquote.org', 'wikidata.org', 'fr.wiktionary.org');

	// Tableau numéroté de nom des projets WIKI
	$project_wiki_link = array('Wikipedia', 'Wikimedia Commons', 'Wikiquote', 'Wikidata', 'Wikitionnaire');

	$link_1 = 'https://';

	$link_2 = '/w/api.php?action=query&format=json&list=users&ususers=';

	$link_3 = '&usprop=editcount';

	$link_all = NULL;
	
	// Boucle faisant l'alternance des éléments du tableau numéroté afin de traiter chaque lien wiki.
	for ($link_wiki=0; $link_wiki < 5; $link_wiki++) {	
		// Formation de l'URL
		$link_all = $link1.$project_wiki_link[$link_wiki].$link2.urlencode($username).$link3;

		// Recuperation du contenu du lien pour le mettre dans une variable $link_content 
		$link_content = file_get_contents($link_all); 

		// convert json string to array
		$contributions = json_decode($link_content, true);

	
		if (isset($contributions["query"]["users"])) {

			for ($name_wiki=0; $name_wiki < 5; $name_wiki++) { 
				
				foreach ($contributions["query"]["users"] as $content) {

					echo "\n Vous avez" . $content["editcount"] ." contribution(s) en  " . project_wiki_name[$name_wiki] . "\n";

					echo "\n";
				}

			}

		}

	}

	/*var_dump(json_decode($link_content, true)) ;*/

?>