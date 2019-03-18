<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Shuttle</p>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/envoyees.html" class="active">Campagnes envoyées</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<!--<div class="container-fluid container-fixed-lg">
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
							Ajouter une campagne
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
						<form class="form" method="post" class="validate" action="<?=base_url();?>builder/add_newsletter.html">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group form-group-default">
										<label class="control-label">Nom de la campagne :</label>
										<input type="text" class="form-control" name="nom_campagne" data-validate="required" data-message-required="Veuillez saisir un nom de campagne" placeholder="Nom de la campagne" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-group-default">
										<label class="control-label">Objet de l'email :</label>
										<input type="text" class="form-control" name="objet" data-validate="required" data-message-required="Veuillez saisir un objet" placeholder="Objet de l'email" />
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
</div>-->
<div class="container-fluid container-fixed-lg">
	<div class="page-container">
    <div class="main-content">
        <div class="row">
          <div data-pages="portlet" class="panel panel-default" id="portlet-basic">
            <div class="panel-heading">
              <div class="panel-title">
                    Vos Campagnes envoyées
              </div>
							<div class="panel-controls">
								<ul>
									<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
									class="portlet-icon portlet-icon-collapse"></i></a>
									</li>
								</ul>
							</div>
	          </div>
	          <div class="panel panel-transparent panel-body">
	            <div class="pull-right">
								<div class="row">
									<div class="col-xs-12">
										<input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="row">
	              <div class="col-md-12">
	                <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
	                  <thead>
	                    <tr>
												<th>Id</th>
	                      <th>Nom</th>
	                      <th>Objet</th>
	                      <th>Statut</th>
	                      <th>Actions</th>
	                    </tr>
	                  </thead>
	                  <tbody>

										<?php

										foreach ($result_campagnes as $row_campagnes) {

											echo '<tr>
															<td class="v-align-middle semi-bold">
																' . $row_campagnes->id_newsletter . '
															</td>
															<td class="v-align-middle semi-bold">
																' . $row_campagnes->nom_campagne . '
															</td>
															<td class="v-align-middle">
																'.$row_campagnes->objet.'
															</td>
															<td class="v-align-middle">
																Envoyées
															</td>
															<td class="v-align-middle">
																<div class="btn-group">
																	<!--<a class="btn btn-success" href="' . base_url() . 'campagnes/statistics/' . $row_campagnes->id_newsletter . '">
																		<i class="fs-14 pg-charts"></i>
																	</a>-->
																	<a class="btn btn-success" href="' . base_url() . 'campagnes/duplicate/' . $row_campagnes->id_newsletter . '">
																		<i class="fa fa-copy">
																		</i>
																	</a>
																	<button class="btn btn-success " onclick="popin(\''.$row_campagnes->id_newsletter.'\', \''.$row_campagnes->nom_campagne.'\')" >
																		<i class="fa fa-archive">
																		</i>
																	</button>
																</div>
															</td>
														</tr>';

										}

										/**foreach ($result["data"]["campaign_records"] as $row) {

											echo '<tr>
															<td class="v-align-middle">' . $row['campaign_name'] . '</td>
															<td class="v-align-middle">' . $row['subject'] . '</td>
															<td class="v-align-middle">' . $row['status'] . '</td>
															<td class="v-align-middle">
																<div class="btn-group">

																	<a class="btn btn-success" href="' . base_url() . 'campagnes/builder/' . $row["id"] . '"><i class="fa fa-edit"></i></a>

																	<a class="btn btn-success" href="' . base_url() . 'campagnes/duplicate/' . $row["id"] . '"><i class="fa fa-copy"></i></a>

																	<button class="btn btn-success " onclick="popin(\''.$row['id'].'\', \''.$row['campaign_name'].'\')" ><i class="fa fa-trash"></i></button>

																</div>
																<div class="btn-group">

																	<a class="btn btn-success" href="' . base_url() . 'campagnes/listes/' . $row["id"] . '"><i class="fa fa-envelope"></i></a>

																	<a class="btn btn-success" href="' . base_url() . 'campagnes/bat/' . $row["id"] . '" ><i class="fa fa-send"></i></a>

																	<button class="btn btn-success" ><i class="fa fa-bar-chart"></i></button>

																	<button class="btn btn-success" ><i class="fa fa-archive"></i></button>

																</div>
															</td>
				                    </tr>';

										}**/
										 ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
			<div class="modal fade" id="modal-delete">
		    <div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		          <h4 class="modal-title">Voulez-vous vraiment archiver cette campagne?</h4>
		        </div>
		        <form action="<?=base_url();?>campagnes/archive.html" method="POST">
		          <input type="hidden" name="id" id="id">
		          <div class="modal-body"></div>
		          <div class="modal-footer">
		            <button type="button" class="btn btn-white" data-dismiss="modal">Fermer</button>
		            <button type="submit" class="btn btn-info">ARCHIVER</button>
		          </div>
		        </form>
		      </div>
		    </div>
		  </div>
    </div>
  </div>
	<script type="text/javascript">
		$('#tableWithSearch').dataTable( {
				"pageLength": 30,
				"order": [[0, 'desc']],
				"sDom": "<t><'row'<p i>>",
				"destroy": true,
				"scrollCollapse": true,
				"oLanguage": {
						"sLengthMenu": "_MENU_ ",
						"sInfo": "Affiche <b>_START_ à _END_</b> sur _TOTAL_ entrées"
				},
				"iDisplayLength": 30
		} );

		// search box for table
		$('#search-table').keyup(function() {
				table.fnFilter($(this).val());
		});
	</script>
