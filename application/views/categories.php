<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Pages</p>
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
						<form role="form" id="form" method="post" class="validate" action="<?=base_url();?>categories/add.html">
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
												<a href="' . base_url() .'categories/modifier_categorie/' . $row['id']  . '">
											    <i class="fa fa-edit"></i>
											  </a>
											</li>
											<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
									class="portlet-icon portlet-icon-collapse"></i></a>
											</li>
										</ul>
									</div>
              		</div>
              	<div class="panel-body">
                  <div class="list-group list-group-minimal">';

                    foreach ($row['cat_child'] as $row_cat) {

							        echo '<li class="list-group-item">
                              ' . $row_cat['titre'] . '
                              <span class="panel-controls pull-right">
																<a href="' . base_url() .'categories/modifier_sous_categorie/' . $row_cat['id']  . '"><i class="fa fa-edit"></i>
																</a>
																<a href="javascript:delete_item (\''.$row_cat['id'].'\', \''.$row_cat['titre'].'\');" ><i class="fa fa-trash"></i>
																</a>
															</span>
														</li>';

                    }

                echo '</div>
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
						<div class="modal-body"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-white" data-dismiss="modal">Fermer</button>
							<button type="submit" class="btn btn-info">SUPPRIMER</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	var id = null;
	var urlSelect = 'select_all_cat';

	select ('#select_category', id, urlSelect);

	$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = 'categories/add.html';
		urlRedirect = 'categories.html';

		check_exist(urlCheck, urlRedirect, data);

	});

</script>
