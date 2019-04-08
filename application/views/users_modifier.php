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
					<a href="<?=base_url();?>users/modifier.html" class="active">Modifier</a>
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
		        <div class="panel-title">Modifier un utilisateur</div>
							<div class="panel-controls">
								<ul>
									<li>
										<a data-toggle="collapse" class="portlet-collapse" href="#">
											<i class="portlet-icon portlet-icon-collapse"></i>
										</a>
								</li>
							</ul>
						</div>
		       </div>
						<?php foreach ($result as $row) { ?>

							<form id="form" method="post" class="validate" action="<?=base_url()?>users/update.html">
								<input type="hidden" name="id" value="<?=$row->id?>">
			          <div class="panel-body">
			            <div class="row">
			              <div class="col-md-6">
			                <div class="form-group form-group-default">
												<label class="control-label">Login :</label>
												<input type="text" class="form-control" name="login" value="<?=$row->login?>"  placeholder="Login" required />
			                </div>
			                <div class="form-group form-group-default">
												<label class="control-label">Nom :</label>
												<input type="text" class="form-control" name="nom" value="<?=$row->nom?>" placeholder="Nom" required />
			                </div>
			                <div class="form-group form-group-default">
												<label class="control-label">Prénom :</label>
												<input type="text" class="form-control" name="prenom" value="<?=$row->prenom?>" placeholder="Prénom" required />
			                </div>
			                <div class="form-group form-group-default">
												<label class="control-label">Adresse électronique :</label>
												<input type="text" class="form-control" name="email" value="<?=$row->email?>" placeholder="Email" required />
			                </div>

											<?php  if($_SESSION['is_admin'] == 1 && $_SESSION['rang'] > 8 ) { ?>

													<div class="form-group form-group-default form-group-default-select2 ">
														<label class="control-label">Groupe :</label>
															<select class="form-control" data-placeholder="Choisir un groupe" data-init-plugin="select2" id="select_group" name="id_group" disabled>
																<option value=""></option>
														</select>
													</div>

											<?php	} else { ?>

												<div class="form-group form-group-default">
													<label class="controls-label">Groupe :</label>
													<p style="margin:0px 0px 2px 0px;"> <?=$user_group?>
													</p>
												</div>

											<?php	} ?>

										</div>

										<?php  if($_SESSION['is_admin'] == 1 && $_SESSION['rang'] > 6) { ?>

											<div class="form-group form-group-default">
												<label class="control-label">Administrateur :</label>
												<input type="checkbox" data-init-plugin="switchery" data-size="small" name="admin" <?=$checked_admin?> />
											</div>
											<div class="form-group form-group-default form-group-default-select2">
												<label class="control-label">Rang :</label>
												<select class="full-width" data-placeholder="Choisir le rang de l\'utilisateur" data-init-plugin="select2" name="rang">

												<?php
												if ($_SESSION['is_admin'] == 1 && $_SESSION['rang'] > 8) {
													for ($i=0; $i < 11  ; $i++) {
														$selected = ($i == $row->rang ) ? 'selected="selected"':'';
														echo '<option '.$selected.'>'.$i.'</option>';
													}
												} else {
													for ($i=0; $i < 9  ; $i++) {
														$selected = ($i == $row->rang ) ? 'selected="selected"':'';
														echo '<option '.$selected.'>'.$i.'</option>';
													}
												}

												?>
												</select>
											</div>
										<?php	} ?>

										<?php if ($_SESSION['is_admin'] == 1 && $_SESSION['rang'] > 5): ?>

											<div class="form-group form-group-default">
												<label class="control-label">Actif :</label>
												<input type="checkbox" data-init-plugin="switchery" data-size="small" name="actif" <?=$checked_actif?> />
											</div>

											<?php if ($_SESSION['is_admin'] == 1 && $_SESSION['rang'] == 6): ?>

												<div class="invisible"></div>
												<div class="invisible"></div>
												<div class="invisible"></div>

											<?php endif; ?>

											<?php if ($_SESSION['is_admin'] == 1 && $_SESSION['rang'] > 6): ?>

												<div class="invisible"></div>

											<?php endif; ?>

											<div class="form-group form-group-default form-group-default-select2 ">
												<label class="">Succursale :</label>
													<select class="full-width" data-placeholder="Choisir une succursale" data-init-plugin="select2" id="select_succursale" name="id_succursale" disabled>
												</select>
											</div>

										<?php endif; ?>

									</div>
				        </div>

							<?php } ?>

		        <div class="panel-footer text-right">
		          <button type="submit" class="btn btn-success">MODIFIER</button>
		        </div>
	      	</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if ($_SESSION['is_admin'] == 1 && $_SESSION['rang'] > 4): ?>

	<div class="container-fluid container-fixed-lg">
		<div class="success alert alert-success">
			<strong class="message"></strong>
			<button class="close"></button>
		</div>
		<div class="erreur alert alert-danger">
			<strong class="message"></strong>
			<button class="close"></button>
		</div>
		<div class="page-container">
			<div class="main-content">
				<div class="row">
			    <div data-pages="portlet" class="panel panel-default" id="portlet-basic">
			      <div class="panel-heading">
			        <div class="panel-title">Reinitialiser son mot de passe</div>
							<div class="panel-controls">
								<ul>
								<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
								class="portlet-icon portlet-icon-collapse"></i></a>
								</li>
							</ul>
						</div>
		       </div>
					 <form id="form_password" method="post" class="validate" action="<?=base_url()?>users/update_password.html">
	          <input type="hidden" name="id" value="<?=$row->id?>">
	          <div class="panel-body">
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
		               <label class="control-label">Mot de passe :</label>
	                 <input type="password" class="form-control" name="password" placeholder="Mot de passe" required />
	                </div>
								</div>
								<div class="col-md-6">
	                <div class="form-group form-group-default">
	                  <label class="control-label">Confirmation du mot de passe :</label>
	                  <input type="password" class="form-control" name="password_confirm" placeholder="Mot de passe" required />
	                </div>
								</div>
		          </div>
		        	<div class="panel-footer text-right">
		          	<button type="submit" class="btn btn-success">REINITIALISER</button>
		        	</div>
		      	</form>
					</div>
				</div>
			</div>
		</div>

<?php endif; ?>

<script type="text/javascript">

	var id = '<?=$row->id_group?>';
	var urlSelect = '<?=base_url();?>'+'common/select_all_group';

	select ('#select_group', id, urlSelect);

	var id = '<?=$row->id_succursale?>';
	var urlSelect = '<?=base_url();?>'+'common/select_all_succursale';

	select ('#select_succursale', id, urlSelect);

	$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = '<?=base_url();?>'+'users/update.html';
		urlRedirect = '<?=base_url();?>'+'users.html';

		check_exist(urlCheck, urlRedirect, data);

	});

	$('#form_password').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = '<?=base_url();?>'+'users/update_password.html';
		urlRedirect = '<?=base_url();?>'+'users.html';

		check_exist(urlCheck, urlRedirect, data);

	});

</script>
