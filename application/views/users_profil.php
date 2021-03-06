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
		        <div class="panel-title">Modifier mes informations</div>
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
			                  <input type="text" class="form-control" name="nom" value="' . $row->nom . '" placeholder="Nom" required />
			                </div>
			                <div class="form-group form-group-default">
			                  <label class="control-label">Prénom :</label>
			                  <input type="text" class="form-control" name="prenom" value="' . $row->prenom . '" placeholder="Prénom" required />
			                </div>
			                <div class="form-group form-group-default">
			                  <label class="control-label">Adresse électronique :</label>
			                  <input type="text" class="form-control" name="email" value="' . $row->email . '" placeholder="Email" required />
			                </div>
			                <div class="form-group form-group-default">
			                  <label class="control-label">Login :</label>
			                  <input type="text" class="form-control" name="login" value="' . $row->login . '"  placeholder="Login" required />
			                </div>
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
</div>
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

	<script type="text/javascript">

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
