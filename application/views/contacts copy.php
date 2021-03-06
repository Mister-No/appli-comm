<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Shuttle</p>
				</li>
				<li>
					<a href="<?=base_url();?>contacts.html" class="active">Contacts</a>
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
                Vos Contacts
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
												<th>E-Mail</th>
	                      <th>Nom</th>
	                      <th>Catégorie</th>
	                      <th>Entreprise</th>
	                      <th>Actions</th>
	                    </tr>
	                  </thead>
	                  <tbody>

										<?php foreach ($result as $row) { ?>

											<tr>
												<td class="v-align-middle">
													<a href="<?=base_url() . 'contacts/modifier/' . $row['id']?>"><?=$row['email']?></a>
												</td>
												<td class="v-align-middle semi-bold"><?=$row['nom'] . ' ' . $row['prenom']?></td>
												<td class="v-align-middle"><?=$row['categorie']?></td>
												<td class="v-align-middle"><?=$row['raison_sociale']?></td>
												<td class="v-align-middle">
													<div class="btn-group">
														<a class="btn btn-success" href="<?=base_url() . 'contacts/modifier/' . $row['id']?>"><i class="fa fa-edit"></i></a>
													</div>
													<div class="btn-group">
														<button class="btn btn-success " onclick="popin ('<?=addslashes($row['id'])?>', '<?=addslashes($row['nom'])?>')" ><i class="fa fa-trash"></i></button>
													</div>
												</td>
	                    </tr>

									<?php } ?>

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
		          <h4 class="modal-title">Voulez-vous vraiment supprimer ce contact ?</h4>
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
	<script src="<?=base_url();?>assets/js/datatables.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/plugins/datatables-responsive/js/datatables.responsive.js" type="text/javascript"></script>
<script type="text/javascript">
$('#tableWithSearch').dataTable( {
		"pageLength": 30,
		"order": [[0, 'desc']],
		"sDom": "<t><'row'<p i>>",
		"destroy": true,
		"scrollCollapse": true,
		"oLanguage": {
				"sLengthMenu": "_MENU_ ",
				"sInfo": "Affiche <b>_START_ à _END_</b> of _TOTAL_ entrées"
		},
		"iDisplayLength": 30
} );

// search box for table
$('#search-table').keyup(function() {
		table.fnFilter($(this).val());
});
</script>
