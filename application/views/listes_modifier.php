
<div class="container-fluid container-fixed-lg">
	<div class="page-container">
		<div class="main-content">
			<div class="page-title">
				<div class="title-env">
					<h3>Listes</h3>
				</div>
				<div class="breadcrumb-env">
					<ol class="breadcrumb bc-1" >
						<li> <i class="fa-home"></i><a href="<?=base_url();?>dashboard.html">Accueil</a> </li>
						<li> <a href="<?=base_url();?>listes.html">Listes</a> </li>
						<li class="active">Modifier une liste</li>
					</ol>
				</div>
			</div>

		<?php foreach ($result as $row) {

			echo '<form id="form" method="post" class="validate" action="'. base_url() . 'listes/update.html">
					    <input type="hidden" name="id" value="' . $row['id'] . '"/>
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
					    </div>';

					foreach ($row['cat'] as $row_cat) {

						echo '<div class="col-md-12">
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

	      <div class="col-md-12">
	        <button type="submit" class="btn btn-success pull-right">MODIFIER</button>
	      </div>
	    </div>
	  </form>
	</div>
