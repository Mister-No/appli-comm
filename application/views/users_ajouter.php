<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Shuttle</p>
				</li>
				<li>
					<a href="<?=base_url();?>users.html">Utilisateurs</a>
				</li>
				<li>
					<a href="<?=base_url();?>users/ajouter.html" class="active">Ajouter</a>
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
		        <div class="panel-title">Ajouter un utilisateur</div>
							<div class="panel-controls">
								<ul>
								<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
								class="portlet-icon portlet-icon-collapse"></i></a>
								</li>
							</ul>
						</div>
		       </div>
				 		<form id="form" method="post" class="validate" action="<?=base_url()?>users/add.html">
		          <div class="panel-body">
		            <div class="row">
		              <div class="col-md-6">
		                <div class="form-group form-group-default">
		                  <label class="controls-label">Nom :</label>
		                  <input type="text" class="form-control" name="nom" placeholder="Nom" required />
		                </div>
		                <div class="form-group form-group-default">
		                  <label class="control-label">Prénom :</label>
		                  <input type="text" class="form-control" name="prenom" placeholder="Prénom" required />
		                </div>
		                <div class="form-group form-group-default">
		                  <label class="control-label">Adresse électronique :</label>
		                  <input type="text" class="form-control" name="email" placeholder="Email" required />
		                </div>
		                <div class="form-group form-group-default">
		                  <label class="control-label">Login :</label>
		                  <input type="text" class="form-control" name="login" placeholder="Login" />
		                </div>

										<?php  if($_SESSION['is_admin'] == 1 && $_SESSION['is_super_admin'] == 1 ) { ?>

												<div class="form-group form-group-default form-group-default-select2 ">
													<label class="control-label">Groupe :</label>
														<select class="form-control" data-placeholder="Choisir une entreprise" data-init-plugin="select2" id="select_group" name="id_group" disabled>
															<option value=""></option>
													</select>
												</div>

										<?php	} else { ?>

											<div class="form-group form-group-default">
												<label class="controls-label">Groupe :</label>
												<p style="margin:0px 0px 2px 0px;"> <?=$_SESSION['group']?>
												</p>
											</div>

										<?php	} ?>

										<div class="form-group form-group-default form-group-default-select2 ">
											<label class="">Succursale :</label>
												<select class="full-width" data-placeholder="Choisir une succursale" data-init-plugin="select2" id="select_succursale" name="id_succursale" disabled>
											</select>
										</div>
									</div>
									<div class="col-md-6">
		                <div class="form-group form-group-default">
		                  <label class="control-label">Mot de passe :</label>
		                  <input type="password" class="form-control" name="password" placeholder="Mot de passe" />
		                </div>

									<?php if($_SESSION['is_admin'] == 1) { ?>

										<div class="form-group form-group-default">
		                  <label class="control-label">Administrateur :</label>
                    	<input type="checkbox" data-init-plugin="switchery" data-size="small" name="admin" />
		                </div>

									<?php  if($_SESSION['is_admin'] == 1 && $_SESSION['is_super_admin'] == 1 ) { ?>

										<div class="form-group form-group-default">
											<label class="control-label">Super Administrateur :</label>
											<input type="checkbox" data-init-plugin="switchery" data-size="small" name="super_admin" />
										</div>

									<?php } ?>

		                <div class="form-group form-group-default form-group-default-select2">
		                  <label class="control-label">Rang :</label>
											<select class="full-width" data-placeholder="Choisir le rang de l\'utilisateur" data-init-plugin="select2" name="rang">';
											<?php
											for ($i=10; $i >= 1  ; $i--) {
												echo '<option value="'. $i . '">'. $i . '</option>';
											}
											?>
											</select>
		                </div>
			              <div class="form-group form-group-default">
			                <label class="control-label">Actif :</label>
                    	<input type="checkbox" data-init-plugin="switchery" data-size="small" name="actif" />
			              </div>

								<?php } ?>

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

	var id = '<?=$_SESSION['id_group']?>';
	var urlSelect = '<?=base_url();?>'+'common/select_all_group';

	select ('#select_group', id, urlSelect);

	var id = '<?=$_SESSION['id_succursale']?>';
	var urlSelect = '<?=base_url();?>'+'common/select_all_succursale';

	select ('#select_succursale', id, urlSelect);

	$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = '<?=base_url();?>'+'users/add.html';
		urlRedirect = '<?=base_url();?>'+'users.html';

		check_exist(urlCheck, urlRedirect, data);

	});

	</script>
