<?php
/*
Template Name: FicheDeStage
*/
?>

<!-- HEADER -->
<?php get_header();?>

<!-- BODY-->
<?php 
  require_once("function.php");
  $id_stage = intval($_GET['stage']);
  global $wpdb;
  $resultat = $wpdb->get_row($wpdb-> prepare("SELECT * FROM stages where id_stage = %d", $id_stage));
  $split = explode(" ", read('order'));
  $ordre = $split[0];
  $tri = $split[1];
?>  

<div class="container">
  
  <div class="col-sm-12">
    <ul class="navigationPages singlePost">
      <?php 
        
      //Détermination du bouton prédécent (Distinction du cas où le tri est DESC ou ASC)
        if ($tri == "DESC") {
          //echo "Test 1";
          $resultats = $wpdb->get_row("SELECT id_stage FROM (SELECT * FROM stages WHERE ".read('requete')." ORDER BY ".read('order').") TableTrie WHERE ".$ordre." > '".str_replace("'", "''", $resultat->$ordre)."' ORDER BY ".$ordre." ASC Limit 0,1");
        } else {
           //echo "Test 2";
          $resultats = $wpdb->get_row("SELECT id_stage FROM (SELECT * FROM stages WHERE ".read('requete')." ORDER BY ".read('order').") TableTrie WHERE ".$ordre." < '".str_replace("'", "''", $resultat->$ordre)."' ORDER BY ".$ordre." DESC Limit 0,1");
        }
        //Insertion du bouton si la requête renvoie un résultat
        if (isset($resultats)) {
          echo "<li class=\"gauche\"><a href=\"single-post?stage=".$resultats->id_stage."\"><span class=\"glyphicon glyphicon-arrow-left\"></span> Précédent</a></li>";
        }
        echo "<li><a href=\"rapports-de-stage?>\"><span class=\"glyphicon glyphicon-menu-hamburger\"></span> Retour aux résultats</a></li>";         
        
        //détermination du bouton suivant
        if ($tri == "DESC") {
          $resultats = $wpdb->get_row("SELECT id_stage FROM (SELECT * FROM stages WHERE ".read('requete')." ORDER BY ".read('order').") TableTrie WHERE ".$ordre." < '".str_replace("'", "''", $resultat->$ordre)."' ORDER BY ".$ordre." DESC Limit 0,1");
        } else {
          $resultats = $wpdb->get_row("SELECT id_stage FROM (SELECT * FROM stages WHERE ".read('requete')." ORDER BY ".read('order').") TableTrie WHERE ".$ordre." > '".str_replace("'", "''", $resultat->$ordre)."' ORDER BY ".$ordre." ASC Limit 0,1");
        }
        
        if (isset($resultats)) {
          echo "<li class=\"droite\"><a href=\"single-post?stage=".$resultats->id_stage."\">Suivant <span class=\"glyphicon glyphicon-arrow-right\"></span></a></li>";
        }
      ?>
      <span class=\"glyphicon glyphicon-triangle-right\"></span>
    </ul>  
  </div>
 
  <div class="col-sm-12 center">
    <h2><?php echo $resultat->sujet ?></h2>
  </div>

  <div class="col-sm-12 center">
    Promotion <?php echo $resultat->promotion ?>
  </div>

        
 <div class="col-sm-12 divEntete row">
    <div class="col-sm-8 carac"> 
      <span class="label label-default">Entreprise</span><span class="simpletext"><?php echo $resultat->entreprise ?></span><br/>
      <span class="label label-default">Secteur d'activité</span> <span class="simpletext"><?php echo $resultat->secteur ?></span><br/>
      <span class="label label-default">Technologies</span> <span class="simpletext"><?php echo ListeTechno($id_stage) ?></span><br/>
      <span class="label label-default">Localisation</span> <span class="simpletext"><?php echo $resultat->ville ?></span><br/>
    </div>
    <div class="col-sm-4 logo" >
      <!-- TO DO : insérez dans la bd un colonne pour les liens vers les images -->
      <img src="https://www.cloud-temple.com/wp-content/themes/dragonfly/img/logo-tmpl.png"/>             
    </div>
  </div>

  <div class="col-sm-12">
    <?php if($resultat->admission == 1): ?>
      <span class="label label-success spanCenter">Stage de pré-embauche</span>
    <?php elseif($resultat->admission == 0): ?>
      <span class="label label-default spanCenter">Pas d'embauche</span>
    <?php endif; ?>
  </div>

  <div class="col-sm-12">
    <?php if(!empty($resultat->resume_stage)) :?>
    <h3 class="center">Résumé du stage</h3>
    <p><?php echo $resultat->resume_stage ?></p>
  <?php endif; ?>
  </div>
  
  <!-- TO DO : condition -> uniquement pour les membres -->
  <!-- TO DO : Lien vers le pdf -->
  <?php 
if (is_user_logged_in()) {?>
 <div class="col-sm-12 row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4 center download">
      <a class="btn btn-info" title="telecharger" href="" ><span class="glyphicon glyphicon-download-alt"></span> Rapport de stage</a>
      <a class="btn btn-info" title="telecharger" href="" ><span class="glyphicon glyphicon-download-alt"></span> Note de synthèse</a>
    </div>
    <div class="col-sm-4"></div>
  </div>
<?php } ?>
  

</div>

<!-- FOOTER -->
<?php get_footer(); ?>