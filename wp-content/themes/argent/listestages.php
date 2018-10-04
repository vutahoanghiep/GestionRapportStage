<?php
/*
Template Name: ListeStages
*/
?>

<!-- HEADER -->
<?php get_header();?>

<!-- BODY -->
<!-- Zone de recherche -->
<?php include 'PP-inc/form-search.php'; ?>
<?php require_once("PP-inc/function.php"); ?>


<!-- Critères de recherche -->
<?php
if (empty(read('order'))) {update('order',"id_stage");}
if (empty(read('requete'))) {update('requete',"1=1");} 

  if (!empty($_POST)) {
    $result = "";

    if (!empty($_POST['entreprise'])) {
      foreach ($_POST['entreprise'] as $value) {
        $result.="entreprise = \"".$value."\" OR ";
      }
      $result = substr($result, 0, -3);
      $result.= " AND ";
    }

    if (!empty($_POST['localisation'])) {
      foreach ($_POST['localisation'] as $value) {
        $result.="ville = \"".$value."\" OR ";
      }
      $result = substr($result, 0, -3);
      $result.= " AND ";
    }

    if (!empty($_POST['technologie'])) {
      foreach ($_POST['technologie'] as $value) {
        $result.="technologie = \"".$value."\" OR ";
      }
      $result = substr($result, 0, -3);
      $result.= " AND ";
    }

    if (!empty($_POST['promotion'])) {
      foreach ($_POST['promotion'] as $value) {
        $result.="promotion = \"".$value."\" OR ";
      }
      $result = substr($result, 0, -3);
      $result.= " AND ";
    }

    if (isset($_POST['admission'])) {
      $result.=" admission = \"Oui\"";
      $result.= " AND ";
    }  
    $result = substr($result, 0, -4); 
    //OrderVerif si égale à 1 : tableau trié, si égale à 2 : tableau non trié 
    update('requete',$result);
    update('orderVerif',0);
    update('order','id_stage ASC');

    if (!empty($_POST['reset']) AND $_POST['reset']=="true"){
      update('requete','');
      update('orderVerif',0);
      update('order','id_stage ASC');
    }
  }
?>

<!-- Ordonnancement de la table -->
<?php 
if (!empty($_GET['order'])) {
  if (preg_match("#[a-z]#", $_GET['order'])){ $varOrder=$_GET['order'];}
}

if (!empty($varOrder)){
  if (read('order') == $varOrder." ASC") {
    update('order',$varOrder." DESC");
  } 
  elseif (read('order') == $varOrder." DESC") {
    update('order',"id_stage ASC");
  }
  else {
    update('order',$varOrder." ASC");
  }
  update('orderVerif',1);
}
elseif (empty(read('orderVerif')) OR read('orderVerif')!=1) {
   update('order',"id_stage ASC");
}

?>

<!-- Pagination -->
<?php 
$stagesParPage = 5;

if (!empty(read('requete')) ) {
  $resultatTotal = $wpdb->get_row("SELECT count(*) AS total FROM stages WHERE ".read('requete'));
  $total = $resultatTotal->total;
} else {
  $resultatTotal = $wpdb->get_row("SELECT count(*) AS total FROM stages");
  $total = $resultatTotal->total;
}

$nombreDePages = ceil($total/$stagesParPage);


if($wp_query->query_vars['page']>0){ // Si la variable $_GET['page'] existe...
  global $wp_query;
  $pageActuelle = intval($wp_query->query_vars['page']);

    if($pageActuelle > $nombreDePages){ 
      $pageActuelle = $nombreDePages;
    }
}
else{
  $pageActuelle = 1;
}

$premiereEntree = ($pageActuelle-1) * $stagesParPage;
if (!empty(read('requete')) ) {
  $resultats = $wpdb->get_results($wpdb-> prepare("SELECT * FROM stages WHERE ".read('requete')." ORDER BY ".read('order')." LIMIT %d, %d", $premiereEntree, $stagesParPage));
}
else {
  $resultats = $wpdb->get_results($wpdb-> prepare("SELECT * FROM stages ORDER BY ".read('order')." LIMIT %d, %d", $premiereEntree, $stagesParPage));
}
?>



<?php if ($total==0) {?>
  <div class="alert alert-warning warning-recherche">Votre recherche n'a retourné aucun résultat. Veuillez en recommencer une autre.</div>
<?php } else { ?>
<!-- En-tête du tableau -->
<?php include 'PP-inc/thead.php'; ?>
   <tbody class="tbody">
        <!-- Contenu des cellules -->
        <?php  
          foreach($resultats as $post){
            //Récupération de l'id du stage, réutilisé pour extraire les information de la bd et les afficher dans le post.php
            $id_stage = $post->id_stage;
            include 'PP-inc/post.php';
            //Incrémentation de l'id de tri, réutilisé pour les boutons suivant/précédent
            $premiereEntree++;
          } 
        ?>
    </tbody>
  </table>
</div>
</div>

<script type="text/javascript">
    var input = "<?php echo read('order'); ?>";
    var split = input.split(" ");
    var colonne = split[0];
    var ordre = split[1];

    if (input == 'id_stage ASC') {
        $("th").removeClass('headerSortUp');
        $("th").removeClass('headerSortDown');
    } else {
      if (ordre == "ASC") {
        $("#filter"+colonne).addClass('headerSortUp');
        var x = document.querySelector('#filter'+colonne+' a');
        x.style.color = "white";
        
      } else {
        $("#filter"+colonne).removeClass('headerSortUp').addClass('headerSortDown');
        var x = document.querySelector('#filter'+colonne+' a');
        x.style.color = "white";
      }
    }
    
</script>
<?php } ?>

<!-- Footer -->
<?php get_footer(); ?>