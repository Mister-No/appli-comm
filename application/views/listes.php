
<div class="container-fluid container-fixed-lg">
	<div class="page-container">
		<div class="main-content">
			<div class="page-title">
				<div class="title-env">
					<h3 >Listes</h3>
				</div>
				<div class="breadcrumb-env">
					<ol class="breadcrumb bc-1" >
						<li> <i class="fa-home"></i><a href="<?=base_url();?>dashboard.html">Accueil</a> </li>
						<li class="active">Listes</li>
					</ol>
				</div>
			</div>
			<div class="row">
		    <div data-pages="portlet" class="panel panel-default" id="portlet-basic">
		      <div class="panel-heading">
		        <div class="panel-title">Vos Listes</div>
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
		        <div class="row">
		          <div class="col-md-12">
		            <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
		              <thead>
		                <tr class="replace-inputs">
		                  <th>Titre</th>
		                  <th>Catégories</th>
		                  <th>Nombre Email</th>
		                  <th>Actions</th>
		                </tr>
		              </thead>
		              <tbody>
										<?php foreach ($result as $row) {

											echo '<tr>
															<td class="v-align-middle semi-bold"><a href="' . base_url() . 'listes/modifier/' . $row['id'] . '">' . $row['titre'] . '</a></td>
															<td class="v-align-middle">' . $row['categories'] . '</td>
															<td class="v-align-middle">' . $row['nbre_contact'] . '</td>
															<td class="v-align-middle">
																<div class="btn-group">
																	<a class="btn btn-success" href="' . base_url() . 'listes/modifier/' . $row['id'] . '"><i class="fa fa-edit"></i></a>
																</div>
																<div class="btn-group">
																	 <button class="btn btn-success " onclick="delete_item (\''.$row['id'].'\', \''.$row['titre'].'\')" ><i class="fa fa-trash"></i></button>
																</div>
															</td>
														</tr>';

													} ?>

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
		          <h4 class="modal-title">Voulez-vous vraiment supprimer cette liste ?</h4>
		        </div>
		        <form action="<?=base_url();?>listes/delete.html" method="POST">
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
