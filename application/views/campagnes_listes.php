<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Shuttle</p>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/en_cours.html">Campagnes</a>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/informations/modification/<?=$id_newsletter?>.html">Informations</a>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/newsletter/<?=$id_newsletter?>.html">Newsletter</a>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/listes/<?=$id_newsletter?>.html" class="active">Listes</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="container-fluid container-fixed-lg">
	<div class="page-container">
		<div class="main-content">
			<div class="row">
				<div class="col-md-12">
					<div data-pages="portlet" class="panel panel-default" id="portlet-basic">
						<div class="panel-heading">
							<div class="panel-title">Selectionner des destinataires</div>
						</div>
					</div>
					<div class="erreur alert alert-danger">
				 		<strong class="message"></strong>
				 		<button class="close"></button>
				 	</div>
		<?php if (count($result) > 0) {

						foreach ($result as $row) {

							echo '<form id="form" method="post" class="validate" action="'. base_url() . 'campagnes/listes_add/'.$id_newsletter.'.html">
										 <input type="hidden" name="id_campagne" value="' . $id_newsletter . '">
										 <div data-pages="portlet" class="panel panel-default panel-collapsed" id="portlet-basic">
											<div class="panel-heading">
												<div class="panel-title">' . $row['titre'] . '</div>
													<div class="panel-controls">
														<ul>
														<li><input type="checkbox" name="id_liste[]" class="check_all" value="' . $row['id'] . '"></li>
														<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
														class="pg-arrow_minimize"></i></a>
														</li>
													</ul>
												</div>
											</div>
											<div class="panel-body" style="display:none;">';

												foreach ($row['cat'] as $row_cat) {

													echo '<div class="col-md-12">

																		<div class="panel-heading">
																			<div class="panel-title">' . $row_cat['titre_cat_parent'] . '</div>
																				<div class="panel-controls">
																					<ul>
																					<li><input type="checkbox" name="id_cat[]" class="check_all" value="' . $row_cat['id'] . '"></li>
																				</ul>
																			</div>
																		</div>
																		<div class="panel panel-default">
																			<ul class="list-group">';

																				foreach ($row_cat['child_cat'] as $row_cat_child) {

																					echo '<li class="list-group-item">' .  $row_cat_child['titre'] . '
																									<input type="checkbox" class="pull-right"  name="id_cat[]" value="' . $row_cat_child['id'] . '">
																									</li>';
																				}

																				echo '</ul>
																						</div>
																					</div>';

											}

											echo '</div>
													</div>';

										}

									} else {

										echo '<div class="alert alert-danger">
														<strong class="message">Aucun contact</strong>
													</div>';

									} ?>

					<?php if (count($result) > 0): ?>
						<div class="panel-footer text-right">
							<button type="submit" class="btn btn-success">SELECTIONNER</button>
						</div>
					<?php endif; ?>

					<?php if (count($result) == 0): ?>
						<div class="panel-footer text-right">
							<a href="<?=base_url();?>contacts/ajouter.html" class="btn btn-success">AJOUTER UN CONTACT</a>
						</div>
					<?php endif; ?>

				 </form>
			 </div>
	 		</div>
		</div>
	</div>
	
	<script type="text/javascript">

	/**$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = '<?=base_url();?>'+'campagnes/listes_add/<?=$id_newsletter?>.html';
		urlRedirect = '<?=base_url();?>'+'campagnes/envoyer/<?=$id_newsletter?>.html ';

		check_exist(urlCheck, urlRedirect, data);

	});

	</script>
