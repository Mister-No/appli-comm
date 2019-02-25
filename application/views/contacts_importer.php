<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Shuttle</p>
				</li>
				<li>
					<a href="<?=base_url();?>contacts.html">Contacts</a>
				</li>
				<li>
					<a href="<?=base_url();?>contacts/importer.html" class="active">Importer</a>
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
		        <div class="panel-title">importer un contact</div>
						<div class="panel-title">Modifier un contact</div>
							<div class="panel-controls">
								<ul>
								<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
								class="portlet-icon portlet-icon-collapse"></i></a>
								</li>
							</ul>
						</div>
		      </div>
		      <form id="form" method="post" class="validate" action="<?=base_url();?>contacts/importer_save.html" enctype="multipart/form-data">
		        <div class="panel-body">
		          <div class="row">
		            <div class="col-md-6">
		              <div class="form-group form-group-default">
		                <label class="control-label">Nom :</label>
		                <input type="file" class="form-control" name="fichier" data-validate="required" data-message-required="Veuillez choisir un fichier" />
		              </div>
		            </div>
		            <div class="col-md-6">
									<div class="form-group form-group-default form-group-default-select2 ">
										<label class="">Catégories / Sous-Catégories :</label>
											<select class="full-width" data-placeholder="Choisir une catégorie" data-init-plugin="select2" multiple id="select_category" name="id_cat[]" disabled>
		                </select>
		              </div>
		            </div>
		          </div>
		        </div>
		        <div class="panel-footer text-right">
		          <button type="submit" class="btn btn-success">IMPORTER</button>
		        </div>
		      </form>
		    </div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

	var id_ent = null;
	var urlSelect = '<?=base_url();?>'+'select_all_cat';

	select ('#select_category', id_ent, urlSelect);

	</script>
