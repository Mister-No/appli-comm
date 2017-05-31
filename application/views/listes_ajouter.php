<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Pages</p>
				</li>
				<li>
					<a href="<?=base_url();?>listes.html">Listes</a>
				</li>
				<li>
					<a href="<?=base_url();?>listes/ajouter.html" class="active">Ajouter</a>
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
      <form id="form" method="post" class="validate" action="<?=base_url();?>listes/add.html">
        <div class="row">
          <div class="col-md-12">
            <div data-pages="portlet" class="panel panel-default" id="portlet-basic">
              <div class="panel-heading">
                <div class="panel-title">Ajouter une liste</div>
								<div class="panel-controls">
									<ul>
										<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
											class="portlet-icon portlet-icon-collapse"></i></a>
										</li>
									</ul>
								</div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Titre :</label>
                      <input type="text" class="form-control" name="titre" data-validate="required" data-message-required="Veuillez saisir un titre" placeholder="Titre" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
					<?php foreach ($result as $row) {

						echo '<div class="col-md-12">
				            <div data-pages="portlet" class="panel panel-default" id="portlet-basic">
				              <div class="panel-heading">
				                <div class="panel-title">' . $row['titre'] . '</div>
					                <div class="panel-controls">
														<ul>
						                  <li><input type="checkbox" name="id_cat[]" class="check_all" value="' . $row['id'] . '"></li>
															<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
																	class="portlet-icon portlet-icon-collapse"></i></a>
															</li>
														</ul>
					                </div>
					              </div>
												<div class="panel-body">
					                <ul class="list-group list-group-minimal">';

														foreach ($row['child'] as $row_child) {

																echo '<li class="list-group-item">' . $row_child['titre'] . '
									                      <input type="checkbox" class="pull-right"  name="id_cat[]" value="' . $row_child['id'] . '">
									                    </li>';
														}

					echo '</ul>
							</div>
			       </div>
			      </div>';

					} ?>

          <div class="col-md-12">
            <button type="submit" class="btn btn-success pull-right">AJOUTER</button>
          </div>
        </div>
      </form>
    </div>
  </div>
	<script type="text/javascript">

	$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = 'listes/add.html';
		urlRedirect = 'listes.html';

		console.log(data);

		check_exist(urlCheck, urlRedirect, data);

	});

	</script>
