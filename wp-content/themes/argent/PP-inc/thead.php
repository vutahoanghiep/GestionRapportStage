<div class="container-fluid">
	<div class="col-sm-2">
		<!-- Affiche le total de stage trouvé -->
		<?php if ($total==1) { ?>
			<div><?php echo $total ?> stage</div>
		<?php } elseif($total>1) { ?>	
			<div><?php echo $total ?> stages </div>
		<?php } ?>
	</div>
	
	
	<div class="col-sm-offset-7 col-sm-3 droite">
		<ul class="navigationPages">
			<li><a href="consulter-les-rapports/"><span class="glyphicon glyphicon-step-backward"></span></a></li>
			<?php 
			if ($nombreDePages<5) {
				for ($i=1; $i<=$nombreDePages ; $i++) { 
					if ($i==$pageActuelle) {
						echo "<li ><a class=\"pageActuelle\" href=\"#\">".$i."</a></li>";
					} else {
						echo "<li><a href=\"consulter-les-rapports/".$i."/\">".$i."</a></li>";
					}
				} 
			} else {
				if ($pageActuelle==1) {
					echo "<li ><a class=\"pageActuelle\" href=\"#\">".$pageActuelle."</a></li>";
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle+1)."\">".($pageActuelle+1)."</a></li>";
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle+2)."\">".($pageActuelle+2)."</a></li>";
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle+3)."\">".($pageActuelle+3)."</a></li>";
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle+4)."\">".($pageActuelle+4)."</a></li>";
				} 
				elseif ($pageActuelle==2) {
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle-1)."\">".($pageActuelle-1)."</a></li>";
					echo "<li ><a class=\"pageActuelle\" href=\"#\">".$pageActuelle."</a></li>";
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle+1)."\">".($pageActuelle+1)."</a></li>";
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle+2)."\">".($pageActuelle+2)."</a></li>";
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle+3)."\">".($pageActuelle+3)."</a></li>";
				}
				elseif ($pageActuelle==$nombreDePages-1) {
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle-3)."/\">".($pageActuelle-3)."</a></li>";
				 	echo "<li><a href=\"consulter-les-rapports/".($pageActuelle-2)."/\">".($pageActuelle-2)."</a></li>";
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle-1)."\">".($pageActuelle-1)."</a></li>";
					echo "<li ><a class=\"pageActuelle\" href=\"#\">".$pageActuelle."</a></li>";
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle-1)."/\">".($pageActuelle-1)."</a></li>";
				}
				elseif ($pageActuelle==$nombreDePages) {
				 	echo "<li><a href=\"consulter-les-rapports/".($pageActuelle-4)."/\">".($pageActuelle-4)."</a></li>";
				 	echo "<li><a href=\"consulter-les-rapports/".($pageActuelle-3)."/\">".($pageActuelle-3)."</a></li>";
				 	echo "<li><a href=\"consulter-les-rapports/".($pageActuelle-2)."/\">".($pageActuelle-2)."</a></li>";
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle-1)."\">".($pageActuelle-1)."</a></li>";
					echo "<li ><a class=\"pageActuelle\" href=\"#\">".$pageActuelle."</a></li>";
				}
				else {				
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle-2)."/\">".($pageActuelle-2)."</a></li>";
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle-1)."\">".($pageActuelle-1)."</a></li>";
					echo "<li ><a class=\"pageActuelle\" href=\"#\">".$pageActuelle."</a></li>";
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle+1)."\">".($pageActuelle+1)."</a></li>";
					echo "<li><a href=\"consulter-les-rapports/".($pageActuelle+2)."\">".($pageActuelle+2)."</a></li>";
				}
			}
			?>
			<li><a href="consulter-les-rapports/<?php echo $nombreDePages; ?>"><span class="glyphicon glyphicon-step-forward"></span></a></li>
		</ul>
	</div>
</div>
<table class="table">
	<thead>
	<tr>
			<th id="filterentreprise"><a href="/consulter-les-rapports/?order=entreprise">Entreprise</a></th>
			<th id="filtersujet"><a href="/consulter-les-rapports/?order=sujet">Intitulé du stage</a></th>
			<th id="filtersecteur"><a href="/consulter-les-rapports/?order=secteur">Secteur d'activité</a></th>
			<th>Technologies</th>
			<th id="filterpromotion"><a href="/consulter-les-rapports/?order=promotion">Promotion</a></th>
			<th id="filterville"><a href="/consulter-les-rapports/?order=ville">Localisation</a></th>
	</tr>
	</thead>