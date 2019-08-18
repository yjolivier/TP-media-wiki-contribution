<?php

	/*

	 * Auteurs: Jean Olivier Yao & Paul Bouaffou ;

	 * Description: Programme donnant le nombre de contributions d'un utilisateur
	 				sur les Projets WIKI en langue française (Exemples: Wikipédia, Wikimedia Commons,
	 				Wikiquote, Wikidata, Wikitionnaire, ...). [NB]: Il s'exécute en ligne de commande ; 

	 * Licence: MIT ;

	*/

	// Saisie du username
	echo "Veuillez renseigner votre nom d'utilisateur \n";
	$username = readline();

	// Tableau numéroté 1 de lien des projets WIKI
	$project_wiki_name = array('fr.wikipedia.org', 'commons.wikimedia.org', 'fr.wikiquote.org', 'wikidata.org', 'fr.wiktionary.org');

	// Tableau numéroté 2 de nom des projets WIKI
	$project_wiki_link = array('Wikipedia', 'Wikimedia Commons', 'Wikiquote', 'Wikidata', 'Wikitionnaire');

	// Découpage de l'URL

	$link_1 = 'https://';

	$link_2 = '/w/api.php?action=query&format=json&list=users&ususers=';

	$link_3 = '&usprop=editcount';

	// Variable qui regroupera tous les éléments de l'URL ci-dessus
	$link_all = NULL;
	
	// Boucle faisant l'alternance des éléments du tableau numéroté 1 afin de traiter chaque lien wiki.
	for ($link_wiki=0; $link_wiki < 5; $link_wiki++) {

		// Formation de l'URL
		$link_all = $link1.$project_wiki_link[$link_wiki].$link2.urlencode($username).$link3;

		// Recuperation du contenu du lien pour le mettre dans une variable $link_content 
		$link_content = file_get_contents($link_all); 

		// convert json string to array
		$contributions = json_decode($link_content, true);

		// Vérification de l'existence des paramètres "query" & "users"
		if (isset($contributions["query"]["users"])) {

			// Boucle faisant l'alternance des éléments du tableau numéroté 2 afin d'afficher chaque nom de projet wiki.
			for ($name_wiki=0; $name_wiki < 5; $name_wiki++) { 
				
				foreach ($contributions["query"]["users"] as $content) {

					// Affichage du nombre de contributions de l'utilisateur
					echo "\n Vous avez" . $content["editcount"] ." contribution(s) en  " . project_wiki_name[$name_wiki] . "\n";

					echo "\n";
				}

			}

		}

	}

	/*var_dump(json_decode($link_content, true)) ;*/

?>