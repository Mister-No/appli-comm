<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Pages</p>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes.html">Campagnes</a>
				</li>
				<li>
					<?php foreach ($campagne as $row_camp) {
						echo '<a href="' . base_url() . 'campagnes/listes/' . $row_camp['id'] . '">Campagne ' . $row_camp['campaign_name'] . '</a>';
					}
					?>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/listes.html" class="active">Destinataires</a>
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

		<?php foreach ($result as $row) {

						echo '<form method="post" class="validate" action="'. base_url() . 'campagnes/listes_recap">
									 <input type="hidden" name="id_campagne" value="' . $row_camp['id'] . '">
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

									} ?>

					 <div class="panel-footer text-right">
						 <button type="submit" class="btn btn-success">SELECTIONNER</button>
					 </div>
				 </form>
			 </div>
	 		</div>
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
           <div class="col-md-12">
             <div data-pages="portlet" class="panel panel-default" id="portlet-basic">
               <div class="panel-heading">
                 <div class="panel-title">Créer une liste</div>
 								<div class="panel-controls">
 									<ul>
										<li>
											<a data-toggle="collapse" class="portlet-collapse" href="#"><i
											class="portlet-icon portlet-icon-collapse"></i></a>
										</li>
 									</ul>
 								</div>
	              <div class="panel-body">
								 <form id="form" method="post" class="validate" action="<?=base_url();?>campagnes/list_add_recap">
									 <input type="hidden" name="id_campagne" value="<?=$row_camp['id']?>">
                   <div class="form-group">
                     <label class="control-label">Titre :</label>
                     <input type="text" class="form-control" name="titre" required placeholder="Titre" />
                   </div>
                 </div>
               </div>
             </div>
           </div>
				 </div>

 					<?php foreach ($result_cat as $row_full_cat) {

 						echo '<div class="panel-default">
 				            <div data-pages="portlet" class="panel panel-default panel-collapsed" id="portlet-basic">
 				              <div class="panel-heading">
 				                <div class="panel-title">' . $row_full_cat['titre'] . '</div>
 					                <div class="panel-controls">
 														<ul>
 						                  <li>
																<input type="checkbox" name="id_cat[]" class="check_all" value="' . $row_full_cat['id'] . '">
															</li>
															<li>
																<a data-toggle="collapse" class="portlet-collapse" href="#"><i
																class="pg-arrow_minimize"></i></a>
 															</li>
 														</ul>
 					                </div>
 					              </div>
 												<div class="panel-body" style="display:none;">
 					                <ul class="list-group list-group-minimal">';

 														foreach ($row_full_cat['child'] as $row_child) {

 																echo '<li class="list-group-item">' . $row_child['titre'] . '
 									                      <input type="checkbox" class="pull-right"  name="id_cat[]" value="' . $row_child['id'] . '">
 									                    </li>';
 														}

 					echo '</ul>
 							</div>
 			       </div>
 			      </div>';

 					} ?>

           <div class="panel-footer text-right">
             <button type="submit" class="btn btn-success">AJOUTER</button>
           </div>
         </div>
       </form>
     </div>

	<script type="text/javascript">

	$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = '<?=base_url();?>'+'campagnes/list_add_recap.html';
		urlRedirect = '<?=base_url();?>'+'campagnes/listes_recap.html ';

		check_exist(urlCheck, urlRedirect, data);

	});

	</script>
