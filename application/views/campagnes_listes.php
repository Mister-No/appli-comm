<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Pages</p>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes.html" class="active">Campagnes</a>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/listes.html" class="active">Envoyer</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="container-fluid container-fixed-lg">
	<div class="page-container">
			<div class="main-content">

											<div class="row">

												<div data-pages="portlet" class="panel panel-default" id="portlet-basic">
													<div class="panel-heading">
														<div class="panel-title">Selectionner des destinataires</div>

														<div class="panel-body">


																	<div class="form-group">

																		<div class="panel-title">Campagne [Name]</div>
																	</div>


													</div>
												</div>
											</div>



		<?php foreach ($result as $row) {

						echo '
										<div data-pages="portlet" class="panel panel-default panel-collapsed" id="portlet-basic">
											<div class="panel-heading">
												<div class="panel-title">' . $row['titre'] . '</div>
													<div class="panel-controls">
														<ul>
														<li><input type="checkbox" name="id_cat[]" class="check_all" value="' . $row['id'] . '"></li>
														<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
														class="pg-arrow_minimize"></i></a>
														</li>
													</ul>
												</div>
											</div>
											<div class="panel-body" style="display:none;">
												<ul class="list-group list-group-minimal">';

													foreach ($row['cat'] as $row_cat) {

														echo '<li class="list-group-item">' .  $row_cat['titre'] . '
																		<input type="checkbox" class="pull-right"  name="id_cat[]" value="' . $row_cat['id'] . '">
																		</li>';
													}

													echo '</ul>
															</div>
														</div>
													';

				}
			 ?>

			 <div class="panel-footer text-right">
				 <button type="submit" class="btn btn-success">SELECTIONNER</button>
			 </div>
		 </form>
	 </div>
 </div>

	<script type="text/javascript">

	$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = 'listes/update.html';
		urlRedirect = 'listes.html';

		check_exist(urlCheck, urlRedirect, data);

	});

	</script>
