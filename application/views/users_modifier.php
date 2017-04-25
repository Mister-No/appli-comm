<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Pages</p>
				</li>
				<li>
					<a href="<?=base_url();?>users.html" class="active">Utilisateurs</a>
				</li>
				<li>
					<a href="<?=base_url();?>users/modifier.html" class="active">Modifier</a>
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
		        <div class="panel-title">Modifier un utilisateur</div>
							<div class="panel-controls">
								<ul>
								<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
								class="portlet-icon portlet-icon-collapse"></i></a>
								</li>
							</ul>
						</div>
		       </div>
						<?php
						foreach ($result as $row) {

							echo '<form id="form" method="post" class="validate" action="'. base_url() . 'users/update.html">
			          <input type="hidden" name="id" value="' . $row->id . '">
			          <div class="panel-body">
			            <div class="row">
			              <div class="col-md-6">
			                <div class="form-group form-group-default">
			                  <label class="control-label">Nom :</label>
			                  <input type="text" class="form-control" name="nom" value="' . $row->nom . '" data-validate="required" data-message-required="Veuillez saisir un nom" placeholder="Nom" />
			                </div>
			                <div class="form-group form-group-default">
			                  <label class="control-label">Prénom :</label>
			                  <input type="text" class="form-control" name="prenom" value="' . $row->prenom . '" data-validate="required" data-message-required="Veuillez saisir un prénom" placeholder="Prénom" />
			                </div>
			                <div class="form-group form-group-default">
			                  <label class="control-label">Adresse électronique :</label>
			                  <input type="text" class="form-control" name="email" value="' . $row->email . '" placeholder="Email" />
			                </div>
			                <div class="form-group form-group-default">
			                  <label class="control-label">Login :</label>
			                  <input type="text" class="form-control" name="login" value="' . $row->login . '"  placeholder="Login" />
			                </div>
										</div>
										<div class="col-md-6">
			                <div class="form-group form-group-default">
			                  <label class="control-label">Mot de passe :</label>
			                  <input type="password" class="form-control" name="password" value="**********" placeholder="Mot de passe" />
			                </div>
											<div class="form-group form-group-default">
			                  <label class="control-label">Administrateur :</label>
                      	<input type="checkbox" data-init-plugin="switchery" data-size="small" name="admin" ' . $checked_admin . ' />
			                </div>
			                <div class="form-group form-group-default form-group-default-select2">
			                  <label class="control-label">Rang :</label>
												<select class="full-width" data-placeholder="Choisir le rang de l\'utilisateur" data-init-plugin="select2" name="rang">';

												for ($i=10; $i >= 1  ; $i--) {
													$selected = ($i == $row->rang ) ? 'selected="selected"':'';
													echo '<option '.$selected.'>'.$i.'</option>';
												}

									echo '</select>
			                </div>
				              <div class="form-group form-group-default">
				                <label class="control-label">Actif :</label>
                      	<input type="checkbox" data-init-plugin="switchery" data-size="small" name="actif" ' . $checked_actif . ' />
				              </div>
				          	</div>';
						}
		        ?>

		          </div>
		        </div>
		        <div class="panel-footer text-right">
		          <button type="submit" class="btn btn-success">MODIFIER</button>
		        </div>
		      </form>
		    </div>
			</div>
		</div>
	</div>
