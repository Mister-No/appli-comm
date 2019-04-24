
<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Shuttle</p>
				</li>
				<li>
					<a href="<?=base_url();?>dashboard.html" class="active">Accueil</a>
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
						<div class="panel-title">
									Vos Campagnes en cours
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

									<?php foreach ($result_campagnes as $row_campagnes) { ?>

										<tr>
											<td class="v-align-middle semi-bold">
												<?=$row_campagnes->id_newsletter?>
											</td>
											<td class="v-align-middle semi-bold">
												<?=$row_campagnes->nom_campagne?>
											</td>
											<td class="v-align-middle">
												<?=$row_campagnes->objet?>
											</td>
											<td class="v-align-middle">
												En cours
											</td>
											<td class="v-align-middle">
												<div class="btn-group">
													<a class="btn btn-success" href="<?=base_url() . 'campagnes/informations/modification/' . $row_campagnes->id_newsletter?>">
														<i class="fa fa-file"></i>
													</a>
													<a class="btn btn-success" href="<?=base_url() . 'campagnes/newsletter/' . $row_campagnes->id_newsletter?>">
														<i class="fa fa-edit"></i>
													</a>
													<a class="btn btn-success" href="<?=base_url() . 'campagnes/duplicate/' . $row_campagnes->id_newsletter?>">
														<i class="fa fa-copy">
														</i>
													</a>

													<?php if ($_SESSION['is_admin'] == 1 && $_SESSION['rang'] > 0): ?>

														<button class="btn btn-success " onclick="popin('<?=addslashes($row_campagnes->id_newsletter)?>','<?=addslashes($row_campagnes->nom_campagne)?>')" >
															<i class="fa fa-trash">
															</i>
														</button>

													<?php endif; ?>

												</div>
											</td>
										</tr>

								<?php } ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal fade" id="modal-delete">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Voulez-vous vraiment supprimer cette campagne?</h4>
							</div>
							<form action="<?=base_url();?>campagnes/delete.html" method="POST">
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
				 "iDisplayLength": 5
		 } );

		 // search box for table
		 $('#search-table').keyup(function() {
				 table.fnFilter($(this).val());
		 });

		 </script>
