	<div class="jumbotron" data-pages="parallax">
		<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
			<div class="inner">
				<ul class="breadcrumb">
					<li>
						<p>Pages</p>
					</li>
					<li>
						<a href="<?=base_url();?>categories.html">Catégories</a>
					</li>
					<li>
						<a href="<?=base_url();?>categories/ajouter.html" class="active">Ajouter</a>
					</li>
				</ul>
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
										<select class="full-width" data-placeholder="Choisir une catégorie" data-init-plugin="select2" id="select_category" name="id_cat" disabled>
										</select>
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
<script type="text/javascript">

	var id = null;
	var urlSelect = '<?=base_url();?>'+'select_all_cat';

	select ('#select_category', id, urlSelect);

	$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = '<?=base_url();?>'+'categories/add.html';
		urlRedirect = '<?=base_url();?>'+'categories.html';

		check_exist(urlCheck, urlRedirect, data);

	});

</script>
