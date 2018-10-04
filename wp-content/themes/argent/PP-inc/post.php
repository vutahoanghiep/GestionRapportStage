<?php 
require_once("function.php");
global $id_stage;
$resultat = $wpdb->get_row($wpdb-> prepare("SELECT * FROM stages where id_stage = %d", $id_stage)); 

?> 

<tr class="blocOffres">
	<td><a href="single-post?stage=<?php echo $id_stage?>">
		<div class="logo">
			<!-- TO DO : Lien vers images entreprises -->
			<p><i>img</i> not found</p>
		</div>
		<div >
			<span class="text-small">
				<?php echo $resultat->entreprise ?>
			</span>
		</div>
	</a></td>
	<td><a href="single-post?stage=<?php echo $id_stage?>">
		<div>
			<?php echo $resultat->sujet ?>
		</div>
		<div >
			<span class="text-small">
				<br>
				<?php echo $resultat->prenom." ".$resultat->nom ?>
			</span>
		</div>
			
	</a></td>
	<td><a href="single-post?stage=<?php echo $id_stage?>"><?php echo $resultat->secteur ?></a></td>
	<td><a href="single-post?stage=<?php echo $id_stage?>"><?php echo ListeTechno($id_stage) ?></a></td>
	<td><a href="single-post?stage=<?php echo $id_stage?>"><?php echo $resultat->promotion ?></a></td>
	<td><a href="single-post?stage=<?php echo $id_stage?>"><?php echo $resultat->ville ?></a></td>
</tr>