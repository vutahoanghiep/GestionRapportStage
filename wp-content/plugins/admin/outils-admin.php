<?php
/**
 * Plugin Name: Outils supplementaires
 * Description: Ajout des fonctions supplementaires
 * Author: VTHH 2017-2018
 * Version: 1.0
 */

 // Méthode pour changer le répertoire pour les fichiers envoyés à wp-content/uploads/rapports_stage/année/mois
 function changer_upload_dir ($dir_data) {
	$time = current_time('mysql');
	$y = substr($time,0,4);
	$m = substr($time,5,2);
	$subdir = "$y/$m";
	$custom_dir = 'rapports_stage/'.$subdir;
	if (!file_exists($dir_data['basedir'].'/'.$custom_dir) && !is_dir($dir_data['basedir'].'/'.$custom_dir)) {
	mkdir($dir_data['basedir'].'/'.$custom_dir,0755,true);
	}
	return [
	'path' => $dir_data['basedir'].'/'.$custom_dir,
	'url' => $dir_data['url'].'/'.$custom_dir,
	'subdir' => '/'.$custom_dir,
	'basedir' => $dir_data['error'],
	'error' => $dir_data['error'],
	];
 }
 


// afficher le menu correspondant au statut de l'utilisateur: non-connecté, connecté et admin
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );
function my_wp_nav_menu_args( $args = '' ) {
if( is_user_logged_in() && (!current_user_can('administrator') | !is_admin())) { 
    $args['menu'] = 'connecte';
}
if (!is_user_logged_in()) {
    $args['menu'] = 'non-connecte';
}
if (current_user_can('administrator') | is_admin()) {
	$args['menu'] = 'admin';
 }
    return $args;
}



//restreindre l'accès au wp-admin
add_action('init','custom_login');
function custom_login(){
 global $pagenow;
 if( 'wp-login.php' == $pagenow && !is_admin()) {
  wp_redirect('/');
 }
}




// restreindre l'accès aux pages "Depot rapport", "Envoi email"
add_action( 'template_redirect', 'redirect_to_specific_page' );
function redirect_to_specific_page() {
if ( is_page(27) | is_page(213) && ! is_user_logged_in() ) {
auth_redirect(); 
  }
if (is_page(80) && !is_admin() && !current_user_can('administrator')) {
	auth_redirect();
}
}



// Méthode pour rédiger l'utilisateur vers une autre page
function redirect($url){
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';
    echo $string;
}



// restreindre la connexion des utilisateurs qui n'ont pas validé l'inscription
add_filter( 'wp_authenticate_user', 'verifier_utilisateur', 1 );
function verifier_utilisateur( $user ) {
    if (is_wp_error($user)) {
        return $user;
    }
	$user_id = get_current_user_id();
    $verif = get_user_meta($user->ID, 'verif', true );
	$level = get_user_meta($user->ID,'wp_m2ccitours_user_level',true);
	if ( $verif != "true" && $level != 10) {
		return new WP_ERROR();
    }
    return $user;
}



// Cacher la barre d'admin aux utilisateurs normaux
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}



// Afficher le nom d'utilisateur sur le menu. Attention: le nom de l'onglet dans le menu doit être [Compte]
add_filter('the_title', 'modif_titre_menu');
function modif_titre_menu($title) {
    $user = wp_get_current_user();
    $name = $user->display_name;
    if (!is_admin() && !current_user_can('administrator') && $title == '[Compte]') {
        if (is_user_logged_in()) {
            $title = "Bonjour, " . $name;
        }
    }
    return $title;
}



// Définir l'adresse mail et le nom affiché
add_filter('wp_mail_from','adresse_mail');
function adresse_mail($content_type) {
  return 'm2ccitours@gmail.com';
}
add_filter('wp_mail_from_name','nom_affiche');
function nom_affiche($name) {
  return 'Gestion Rapport de stage';
}