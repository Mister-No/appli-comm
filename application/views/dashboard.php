
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
									Vos Campagnes
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
															' . $row_campagnes->nom_campagne . '
														</td>
														<td class="v-align-middle">
															'.$row_campagnes->objet.'
														</td>
														<td class="v-align-middle">

														</td>
														<td class="v-align-middle">
															<div class="btn-group">
																<a class="btn btn-success" href="' . base_url() . 'campagnes/newsletter/' . $row_campagnes->id . '"><i class="fa fa-edit"></i></a>
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

																<button class="btn btn-success " onclick="delete_item(\''.$row['id'].'\', \''.$row['campaign_name'].'\')" ><i class="fa fa-trash"></i></button>

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
