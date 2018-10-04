<?php  

/*Permet de lister l'ensemble des technologies utilisées lors du stage*/
function ListeTechno($id){
	global $wpdb;
	$resultatTechno = $wpdb->get_results($wpdb-> prepare("SELECT * FROM technologies where id_stage = %d ORDER BY technologie", $id));
	$techno = "";
	foreach ($resultatTechno as $post) {
	 		$techno .= $post->technologie.", " ;
		}
	$rest = substr($techno, 0, -2);
	return $rest;
}

/*Compte le nombre de stage retourné par la recherche (tous par défaut)*/
function compteur($resultats){
	return count($resultats);
}

/*Lecture d'une variable utile au bon focntionnement du site */
function read($nom){
	global $wpdb;
	$result = $wpdb->get_var($wpdb-> prepare("SELECT valeur FROM wp_m2ccitours_variable_site_web where nom = %s", $nom));
	return $result;
}

/*Modification d'une variable utile au bon focntionnement du site */
function update($nom, $valeur){
	global $wpdb;
	$wpdb->update('wp_m2ccitours_variable_site_web', array('valeur' => $valeur), array('nom'=> $nom));
}


?>