
<div class="container-fluid container-fixed-lg">
	<div class="page-container">
		<div class="main-content">
			<div class="page-title">
				<div class="title-env">
					<h3>Catégories</h3>
				</div>
				<div class="breadcrumb-env">
					<ol class="breadcrumb bc-1" >
						<li>
							<i class="fa-home"></i><a href="<?=base_url();?>dashboard.html">Accueil</a>
						</li>
						<li class="active">
							Catégorie
						</li>
					</ol>
				</div>
			</div>
			<div class="row">

      <?php foreach ($result as $row) {

			echo '<div class="col-md-12">
          		<div data-pages="portlet" class="panel panel-default" id="portlet-basic">
              	<div class="panel-heading">
                  <div class="panel-title">' . $row['titre'] . '</div>
									<div class="panel-controls">
										<ul>
											<li>
												<a href="' . base_url() .'categories/modifier/' . $row['id']  . '">
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
																<a href="' . base_url() .'categories/modifier/' . $row_cat['id']  . '"><i class="fa fa-edit"></i>
																</a>
																<a href="javascript:delete_item (\''.$row_cat['id'].'\', \''.$row_cat['titre'].'\');" ><i class="fa fa-trash"></i>
																</a>
															</span>
														</li>';

                    }

                echo '</div>
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
					<form action="<?=base_url();?>contacts/delete.html" method="POST">
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
