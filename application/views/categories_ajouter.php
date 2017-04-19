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
							<li>
								<a href="<?=base_url();?>categories.html">Catégories</a>
							</li>
							<li class="active">
								Ajouter une catégorie
							</li>
						</ol>
					</div>
				</div>
				<div class="row">
	        <div data-pages="portlet" class="panel panel-default" id="portlet-basic">
	          <div class="panel-heading">
	            <div class="panel-title">
	              Ajouter une catégorie
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
            <form role="form" id="form" method="post" class="validate" action="<?=base_url();?>categories/add.html">
              <div class="row">
                <div class="col-md-6">
									<div class="form-group form-group-default">
										<label class="control-label">Titre :</label>
										<input type="text" class="form-control" name="titre" data-validate="required" data-message-required="Veuillez saisir un titre" placeholder="Titre" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-group-default form-group-default-select2 ">
									<label class="">Catégorie (facultatif):</label>
										<select class="full-width" data-placeholder="Choisir une catégorie" data-init-plugin="select2" id="select_category" name="id_cat[]" disabled>
										</select>
		              </div>
								</div>
                <div class="col-md-12">
                  <div class="form-group pull-right">
                    <button type="submit" class="btn btn-success">AJOUTER</button>
                  </div>
                </div>
							</div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	var id = null;
	var urlSelect = 'select_all_cat';

	select ('#select_category', id, urlSelect);
</script>
