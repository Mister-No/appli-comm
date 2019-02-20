<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Pages</p>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes.html">CAMPAGNES</a>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/informations/creation.html" class="active">Informations</a>
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
		        <div class="panel-title">CRÉER UNE CAMPAGNE</div>
						<div class="panel-controls">
							<ul>
								<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
								class="portlet-icon portlet-icon-collapse"></i></a>
								</li>
							</ul>
						</div>
		      </div>
		      <form id="form" method="post" class="validate" action="<?=base_url();?>campagnes/add_newsletter.html">
		        <div class="panel-body">
		          <div class="row">
		            <div class="col-md-12">
									<div class="form-group form-group-default">
		                <label class="control-label">Nom de la campagne :</label>
		                <input type="text" class="form-control" name="nom_campagne" placeholder="Nom de la campagne" />
		              </div>
									<div class="form-group form-group-default">
										<label class="control-label">Objet de l'email :</label>
										<input type="text" class="form-control" name="objet" placeholder="Objet de l'email" />
									</div>
		            	<div class="form-group form-group-default">
		                <label class="control-label">Expediteur :</label>
		                <input type="text" class="form-control" name="expediteur" placeholder="Expediteur" required />
		              </div>
		            </div>
								<div class="form-group form-group-default form-group-default-select2 ">
									<label class="">Thème :</label>
										<select class="full-width" data-placeholder="Choisir un thème" data-init-plugin="select2" name="theme">
											<option value=""></option>
											<?php foreach ($result_theme_newsletter as $row_theme_newsletter): ?>
												<option value="<?=$row_theme_newsletter->id?>"><?=$row_theme_newsletter->nom?></option>
											<?php endforeach; ?>
	                </select>
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

	/**$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = 'builder/add.html';
		urlRedirect = 'contacts.html';

		check_exist(urlCheck, urlRedirect, data);

	});**/

	</script>
