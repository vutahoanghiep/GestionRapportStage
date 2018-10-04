<?php
/* Template Name: ValidationRapportStage */
get_header();
?>

<html>
    <head>
        <title>Inscription</title>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <style>
            span.message {
                padding: 10px;
                border: 3px solid black;
                display: inline-block;
                margin-bottom: 70px;
                margin-top: 70px;
                width: 600px;
            }
        </style>
    </head>
    <body>
        <?php

// Méthode pour la connexion à la base de données
        function connexion_bdd() {
            $host = DB_HOST;
            $user = DB_USER;
            $passwd = DB_PASSWORD;
            $bd = DB_NAME;
            $connexion = "mysql:host=$host;dbname=$bd";
            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($connexion, $user, $passwd, $opt);
            $pdo->exec('SET NAMES utf8');
            return $pdo;
        }

// Récupération des variables nécessaires à l'activation
        $email = isset($_GET['email']) ? $_GET['email'] : '';
        $activation_key = isset($_GET['activation_key']) ? $_GET['activation_key'] : '';

// Afficher le message s'il n'y pas l'adresse mail dans le lien
        if ($email == null) {
            echo '<div align="center"><span class="message">Veuillez valider votre inscription avec le lien fourni</span></div>';

// Afficher le message s'il n'y a pas la clé d'activation dans le lien
        } elseif ($activation_key == null) {
            echo '<div align="center"><span class="message"> Veuillez valider votre inscription avec le lien fourni</span></div>';

// Vérifier si la clé d'activation dans le lien correspond à celle dans la base de données
        } else {
            $pdo = connexion_bdd();
            $requete_activation_key = $pdo->prepare('SELECT user_activation_key FROM wp_m2ccitours_users WHERE user_email=?');
            $requete_activation_key->execute([$email]);
            $resultat_activation_key = $requete_activation_key->fetch();
            $activation_key_bdd = $resultat_activation_key["user_activation_key"];

            // Si les 2 clés correspondent --> mettre à jour le statut d'utilisateur dans la base de données et afficher le message
            if ($activation_key == $activation_key_bdd) {
                // Récupere l'ID utilisateur
                $requete_getID = $pdo->prepare('SELECT ID from wp_m2ccitours_users WHERE user_email = ?');
                $requete_getID->execute([$email]);
                $userID = $requete_getID->fetch()['ID'];

                // Modifier le statut de validation
                $requete_update_verif = $pdo->prepare('UPDATE wp_m2ccitours_usermeta SET meta_value="true" WHERE user_id = ? AND meta_key="verif"');
                $requete_update_verif->execute([$userID]);

                // Définir le rôle du nouveau utilisateur comme auteur pour qu'il puisse mettre le fichier sur le server
                $nouvel_utilisateur = new \WP_User($userID);
                $nouvel_utilisateur->set_role('author');

                echo '<div align="center"><span class="message"> Félicitation! Vous pouvez maintenant accéder à l\'espace Rapport de stage M2 CCI Tours</span></div>';
                echo '
        		<script type="text/javascript">
    			window.setTimeout(function() {
        		window.location.href=\'/' . get_the_title(117) . '/\';
    			}, 5000);
        		</script>';
            } else {
                echo '<div align="center"><span class="message"> Veuillez valider votre inscription avec le lien fourni</span></div>';
            }
        }
        ?>
    </body>
</html>

<?php
get_footer();
