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
					<a href="<?=base_url();?>categories/modifier.html" class="active">Modifier</a>
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
              Modifier une catégorie
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
					<form role="form" id="form" method="post" class="validate" action="<?=base_url();?>categories/update.html">
        	<?php
						foreach ($result as $row) {
              echo '<input type="hidden" name="id" value="' . $row->id . '">
                <div class="row">
									<div class="col-md-6">
										<div class="form-group form-group-default">
											<label class="control-label">Titre :</label>
											<input type="text" class="form-control" value="' . $row->titre . '" name="titre" data-validate="required" data-message-required="Veuillez saisir un titre" placeholder="Titre" />
										</div>
									</div>';
						}
            ?>
								<div class="col-md-6">
									<div class="form-group form-group-default form-group-default-select2 ">
									<label class="">Sous-catégories:</label>
										<select class="full-width" data-placeholder="Choisir une catégorie" data-init-plugin="select2" id="select_category" name="id_enfant" multiple disabled>
	                	</select>
		              </div>
								</div>
                <div class="col-md-12">
                  <div class="form-group pull-right">
                    <button type="submit" class="btn btn-success">MODIFIER</button>
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

		var id = <?=$row->id_parent?>;
		var urlSelect = 'select_all_cat';

		select ('#select_category', id, urlSelect);

		$('#form').submit(function(e) {

			e.preventDefault();

			data = $(this).serialize();
			urlCheck = 'categories/update.html';
			urlRedirect = 'categories.html';

			check_exist(urlCheck, urlRedirect, data);

		});

	</script>
