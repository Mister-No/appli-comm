<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Shuttle</p>
				</li>
				<li>
					<a href="<?=base_url();?>listes.html">Listes</a>
				</li>
				<li>
					<a href="<?=base_url();?>listes/modifier.html" class="active">Modifier</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="container-fluid container-fixed-lg">
	<div class="erreur alert alert-danger">
		<strong class="message"></strong>
		<button class="close"></button>
	</div>
	<div class="page-container">
		<div class="main-content">

		<?php foreach ($result as $row) {

			echo '<form id="form" method="post" class="validate" action="'. base_url() . 'listes/update.html">
					    <input type="hidden" name="id" value="' . $row['id'] . '"/>
							<input type="hidden" name="id_sib" value="' . $row['id_sib'] . '"/>
					    <div class="row">
					      <div class="col-md-12">
								<div data-pages="portlet" class="panel panel-default" id="portlet-basic">
									<div class="panel-heading">
										<div class="panel-title">Modifier une liste</div>
										<div class="panel-controls">
											<ul>
												<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
													class="portlet-icon portlet-icon-collapse"></i></a>
												</li>
											</ul>
										</div>
					          <div class="panel-body">
					            <div class="row">
					              <div class="col-md-12">
					                <div class="form-group">
					                  <label class="control-label">Titre :</label>
					                  <input type="text" class="form-control" name="titre" value="' . $row['titre'] . '" data-validate="required" data-message-required="Veuillez saisir un titre" placeholder="Titre" />
					                </div>
					              </div>
					          </div>
					        </div>
					      </div>
					    </div>
						</div>';

					foreach ($row['cat'] as $row_cat) {

						echo '<div class="row">
									<div class="col-md-12">
										<div data-pages="portlet" class="panel panel-default" id="portlet-basic">
											<div class="panel-heading">
												<div class="panel-title">' . $row_cat['titre'] . '</div>
													<div class="panel-controls">
														<ul>
														<li><input type="checkbox" name="id_cat[]" class="check_all" value="' . $row_cat['id'] . '"' . $row_cat['check_cat_parent'] . '></li>
														<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
														class="portlet-icon portlet-icon-collapse"></i></a>
														</li>
													</ul>
												</div>
											</div>
											<div class="panel-body">
												<ul class="list-group list-group-minimal">';

													foreach ($row_cat['tab_cat_child'] as $row_cat_child) {

														echo '<li class="list-group-item">' .  $row_cat_child['titre'] . '
																		<input type="checkbox" class="pull-right"  name="id_cat[]" value="' . $row_cat_child['id'] . '"' . $row_cat_child['check_cat_child'] .'>
																		</li>';
													}

													echo '</ul>
															</div>
														</div>
													</div>';

				}

				echo '</div>';

			} ?>

			<div class="panel-footer text-right">
				<button type="submit" class="btn btn-success">MODIFIER</button>
			</div>
		</form>
	</div>
</div>
<script src="<?=base_url();?>assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?=base_url();?>assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript"></script>
<script src="<?=base_url();?>assets/plugins/datatables-responsive/js/datatables.responsive.js" type="text/javascript"></script>
	<script type="text/javascript">

	$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = '<?=base_url();?>'+'listes/update.html';
		urlRedirect = '<?=base_url();?>'+'listes.html';

		check_exist(urlCheck, urlRedirect, data);

	});

	</script>
