	<?php 
	require_once("function.php");
	?>	

	<div class="container">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"/>

		<!-- CDN JS -->
		<script type="text/javascript" src="//code.jquery.com/jquery-2.2.4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

		<div class="parameters" onclick="hideShow()">
			<h3 class="title_container">Crit&egraveres de recherche <i class="glyphicon glyphicon-chevron-up"></i></h3>
		</div>

		<form action="/consulter-les-rapports" method="post">

			<div class="row justify-content-md-center" id="hide">

				<div class="col-sm-6 critere-form">

					<div class="form-group">
						<label class="col-sm-4 control-label">Entreprise :</label>
						<select class="col-sm-8 test" id="company" multiple="multiple" name="entreprise[]">
							<?php 
							global $wpdb;

							$options = $wpdb->get_results( "SELECT distinct entreprise FROM stages ORDER by entreprise" ); 

							foreach ( $options as $option ) {
								echo "<option value='".$option->entreprise."'>".$option->entreprise."</option>";
							};
							?>
						</select>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Localisation :</label>
						<select class="col-sm-8" id="localisation" multiple="multiple" name="localisation[]">
							<?php 
							global $wpdb;

							$options = $wpdb->get_results( "SELECT distinct ville FROM stages ORDER BY ville" ); 

							foreach ( $options as $option ) {
								echo "<option value='".$option->ville."'>".$option->ville."</option>";
							};
							?>
						</select>			
					</div>
				</div>

				<div class="col-sm-6 critere-form">
					<div class="form-group">
						<label class="col-sm-4 control-label">Technologie :</label>
						<select class="col-sm-8" id="technology" multiple="multiple" name="technologie[]">
							<?php 
							global $wpdb;

							$options = $wpdb->get_results( "SELECT distinct technologie FROM technologies ORDER BY technologie" ); 

							foreach ( $options as $option ) {
								echo "<option value='".$option->technologie."'>".$option->technologie."</option>";
							};
							?>
						</select>			
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Promotion :</label>
						<select class="col-sm-8" id="promotion" multiple="multiple" name="promotion[]">
							<?php 
							global $wpdb;

							$options = $wpdb->get_results( "SELECT distinct promotion FROM stages ORDER BY promotion" ); 

							foreach ( $options as $option ) {
								echo "<option value='".$option->promotion."'>".$option->promotion."</option>";
							};
							?>
						</select>			
					</div>
				</div>

				<div>
					<div class="form-group">
						<label class="col-sm-7 centered">Stage débouchant sur une embauche ?</label>
						<div class="material-switch col-sm-5 centered">
							<input id="admission" name="admission" type="checkbox"/>
							<label for="admission" class="success"></label>
						</div>							
					</div>
					 <div class="col-sm-12 btn_space">
                        <div class="search_btn col-sm-6 right">
                            <input type="submit" value="Rechercher">
                        </div>
                        </form>
                        <form action="/consulter-les-rapports/" method="post">
                        	<div class="search_btn col-sm-6 left">
                           		<input type="hidden" name="reset" value="true">
                           		<input type="submit" value="Reset">
                        	</div>
                        </form>
                        
                    </div>
				</div>

				<script type="text/javascript" src="/Wordpress/wp-content/themes/argent/PP-inc/form-search.js"></script>

			</div>

		

	</div>
