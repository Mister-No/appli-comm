<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Shuttle</p>
				</li>
				<li>
					<a href="<?=base_url();?>categories.html" class="active">Catégories</a>
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
			<div class="row">
				<div data-pages="portlet" class="panel panel-default" id="portlet-basic">
					<div class="panel-heading">
						<div class="panel-title">
							Ajouter une catégorie
						</div>
						<div class="panel-controls">
							<ul>
								<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
								class="portlet-icon portlet-icon-collapse"></i></a>
								</li>
							</ul>
						</div>
				 	 </div>
					 <div class="panel-body">
						<form class="form" method="post" class="validate" action="<?=base_url();?>categories/add.html">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group form-group-default">
										<label class="control-label">Titre :</label>
										<input type="text" class="form-control" name="titre" data-validate="required" data-message-required="Veuillez saisir un titre" placeholder="Titre" />
									</div>
								</div>
							</div>
						</div>
						<div class="panel-footer text-right">
		          <button type="submit" class="btn btn-success">AJOUTER</button>
		        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid container-fixed-lg">
	<div class="page-container">
		<div class="main-content">
			<div class="row">

      <?php foreach ($result as $row) {

					echo '<div data-pages="portlet" class="panel panel-default" id="portlet-basic">
	              	<div class="panel-heading">
	                  <div class="panel-title">' . $row['titre'] . '</div>
										<div class="panel-controls">
											<ul>
												<li>
													<i onclick="edit_cat(' . $row['id'] . ');">
												    <i class="fa fa-edit"></i>
												  </i>
												</li>
												<li>
													<i onclick="popin (\''.addslashes($row['id']).'\', \''.addslashes($row['titre']).'\');"><i class="fa fa-trash"></i></i>
												</li>
												<li>
													<a data-toggle="collapse" class="portlet-collapse" href="#">
														<i class="portlet-icon portlet-icon-collapse"></i>
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="form-group form-group-default edit_cat" id="cat_id' . $row['id'] . '">
				 						<form class="form_cat" method="post" class="validate" action="' . base_url() . 'categories/update.html">
				 							<div class="row">
				 								<div class="col-md-12">
				 									<div class="form-group form-group-default">
				 										<label class="control-label">Modifier le titre :</label>
				 										<input type="text" class="form-control" name="titre" data-validate="required" data-message-required="Veuillez saisir un nouveau titre" placeholder="Titre" />
														<input type="hidden" name="id" value="' . $row['id'] . '">
				 									</div>
				 								</div>
												<button type="submit" class="btn btn-success btn-cons m-b-10 pull-right">MODIFIER</button>
												<button type="button" class="btn btn-success btn-cons m-b-10 pull-right cancel">ANNULER</button>
				 							</form>
										</div>
									</div>
		            	<div class="panel-body">
		                <div class="list-group list-group-minimal">';

		                  foreach ($row['cat_child'] as $row_cat) {

								        echo '<li class="list-group-item">
		                            ' . $row_cat['titre'] . '
		                            <span class="panel-controls pull-right">
																	<i onclick="edit_cat(' . $row_cat['id'] . ', ' . $row['id'] . ');"><i class="fa fa-edit"></i>
																	</i>
																		<i onclick="popin(\''.addslashes($row_cat['id']).'\', \''.addslashes($row_cat['titre']).'\',\'' . addslashes($row['id']) . '\');"><i class="fa fa-trash"></i>
																	</i>
																</span>
															</li>
															<div class="form-group form-group-default edit_cat" id="cat_id' . $row_cat['id'] . '">
																<form class="form_sous_cat" method="post" class="validate" action="' . base_url() . 'categories/update.html">
																<input type="hidden" name="id" value="' . $row_cat['id'] . '">
																	<div class="row">
																		<div class="col-md-6">
																			<div class="form-group form-group-default">
																				<label class="control-label">Modifier le titre :</label>
																				<input type="text" class="form-control" value="' . $row_cat['titre'] . '" name="titre" data-validate="required" data-message-required="Veuillez saisir un titre" placeholder="Titre" />
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="form-group form-group-default form-group-default-select2 ">
																				<label class="">Déplacer vers une autre catégorie:</label>
																				<select class="select_category full-width" data-placeholder="Choisir une catégorie" data-init-plugin="select2" name="id_parent" disabled>
																				</select>
																			</div>
																		</div>
																		<button type="submit" class="btn btn-success btn-cons m-b-10 pull-right">MODIFIER</button>
																		<button type="button" class="btn btn-success btn-cons m-b-10 pull-right cancel">ANNULER</button>
																	</div>
																</form>
															</div>';

		                  }

              echo '</div>
										<div class="row">
											<div class="col-md-12">
												<div class="panel-default add_cat" id="cat_id_parent' . $row['id'] . '">
							 						<form class="form" method="post" class="validate" action="' . base_url() . 'categories/add.html">
						 								<div class="col-md-12">
							 								<div class="form-group form-group-default">
						 										<label class="control-label">Ajouter une sous-catégorie :</label>
						 										<input type="text" class="form-control" name="titre" data-validate="required" data-message-required="Veuillez saisir un titre" placeholder="Titre" />
																<input type="hidden" name="id_parent" value="' . $row['id'] . '">
						 									</div>
															<button type="submit" class="btn btn-success btn-cons m-b-10 pull-right">AJOUTER</button>
															<button type="button" class="btn btn-success btn-cons m-b-10 pull-right cancel">ANNULER</button>
														</div>
							 						</form>
												</div>
											</div>
										</div>
										<div class="text-center pointer">
											<strong onclick="add_cat(' . $row['id'] . ');"><i class="fa fa-plus" aria-hidden="true"></i> Ajouter une sous-catégorie</strong>
										</div>
	            		</div>
	    					</div>';
		} ?>

		</div>
		<div class="modal fade" id="modal-delete">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Voulez-vous vraiment supprimer cette catégorie ?</h4>
					</div>
					<form action="<?=base_url();?>categories/delete.html" method="POST">
						<input type="hidden" name="id" id="id">
						<input type="hidden" name="id_parent" id="id_parent">
						<div class="modal-body"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-white" data-dismiss="modal">FERMER</button>
							<button type="submit" class="btn btn-info">SUPPRIMER</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$('.form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = '<?=base_url();?>'+'categories/add.html';
		urlRedirect = '<?=base_url();?>'+'categories.html';

		check_exist(urlCheck, urlRedirect, data);

	});

	$('.form_cat').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = '<?=base_url();?>'+'categories/update.html';
		urlRedirect = '<?=base_url();?>'+'categories.html';

		check_exist(urlCheck, urlRedirect, data);

	});

	$('.form_sous_cat').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = '<?=base_url();?>'+'categories/move.html';
		urlRedirect = '<?=base_url();?>'+'categories.html';

		check_exist(urlCheck, urlRedirect, data);

	});

</script>
