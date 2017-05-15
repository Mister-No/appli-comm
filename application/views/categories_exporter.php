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
					<li>
						<a href="<?=base_url();?>categories/exporter.html" class="active">Exporter</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container-fluid container-fixed-lg">
		<div class="page-container">
			<div class="main-content">
				<div class="row">

						<?php foreach ($result as $row) {

						echo '<form action="' . base_url() . '/categories/export_csv.html" method="post">
										<div class="col-md-12">
				          		<div data-pages="portlet" class="panel panel-default" id="portlet-basic">
				              	<div class="panel-heading">
				                  <div class="panel-title">' . $row['titre'] . '</div>
													<div class="panel-controls">
														<ul>
															<li><input type="checkbox" name="id_cat[]" class="check_all" value="' . $row['id'] . '">
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
																			<input type="checkbox" class="pull-right"  name="id_cat[]" value="' . $row_cat['id'] . '">
																		</span>
																	</li>';

			                    }

			                	echo '</div>
														<button type="submit" class="btn btn-success">EXPORTER</button>
			              			</div>
												</div>
			      					</div>
										</form>';
					} ?>

			</div>
		</div>
	</div>
