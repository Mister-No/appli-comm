<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Pages</p>
				</li>
				<li>
					<a href="<?=base_url();?>contacts.html">Contacts</a>
				</li>
				<li>
					<a href="<?=base_url();?>contacts/ajouter.html" class="active">Ajouter</a>
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
		        <div class="panel-title">Ajouter un contact</div>
						<div class="panel-controls">
							<ul>
								<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
								class="portlet-icon portlet-icon-collapse"></i></a>
								</li>
							</ul>
						</div>
		      </div>
		      <form id="form" method="post" class="validate" action="<?=base_url();?>contacts/add.html">
		        <div class="panel-body">
		          <div class="row">
		            <div class="col-md-6">
									<div class="form-group form-group-default form-group-default-select2">
										<label class="">Civilité :</label>
											<select class="full-width" data-placeholder="Choisir votre civilité" data-init-plugin="select2" id="select_civility" name="civ">
											<option value=""></option>
		                  <option value="2">Monsieur</option>
		                  <option value="1">Madame</option>
		                </select>
		              </div>
		            	<div class="form-group form-group-default">
		                <label class="control-label">Nom :</label>
		                <input type="text" class="form-control" name="nom" placeholder="Nom" required />
		              </div>
		              <div class="form-group form-group-default">
		                <label class="control-label">Prénom :</label>
		                <input type="text" class="form-control" name="prenom" placeholder="Prénom" />
		              </div>
		              <div class="form-group form-group-default">
		                <label class="control-label">Fonction :</label>
		                <input type="text" class="form-control" name="fonction" placeholder="Fonction" />
		              </div>
		              <div class="form-group form-group-default">
		                <label class="control-label">Téléphone :</label>
		                <input type="text" class="form-control" name="tel"  placeholder="Téléphone" />
		              </div>
		              <div class="form-group form-group-default">
		                <label class="control-label">Mobile :</label>
		                <input type="text" class="form-control" name="mobile" placeholder="Mobile" />
		              </div>
		              <div class="form-group form-group-default">
		                <label class="control-label">Télécopie :</label>
		                <input type="text" class="form-control" name="fax" placeholder="Télécopie" />
		              </div>
		              <div class="form-group form-group-default">
		                <label class="control-label">Adresse électronique :</label>
		                <input type="text" class="form-control" name="email" placeholder="Adresse électronique" required />
		              </div>
		            </div>
		            <div class="col-md-6">
		              <div class="form-group form-group-default">
		                <label class="control-label">N° de voie :</label>
		                <input type="text" class="form-control" name="num_voie" placeholder="N° de voie" />
		              </div>
		              <div class="form-group form-group-default">
		                <label class="control-label">Nom de voie :</label>
		                <input type="text" class="form-control" name="nom_voie" placeholder="Nom de voie" />
		              </div>
		              <div class="form-group form-group-default">
		                <label class="control-label">Lieu-dit :</label>
		                <input type="text" class="form-control" name="lieu_dit" placeholder="Lieu-dit" />
		              </div>
		              <div class="form-group form-group-default">
		                <label class="control-label">Boîte postale :</label>
		                <input type="text" class="form-control" name="bp" placeholder="Boîte postale" />
		              </div>
		              <div class="form-group form-group-default">
		                <label class="control-label">Code postal :</label>
		                <input type="text" class="form-control" name="cp" placeholder="Code postal" />
		              </div>
		              <div class="form-group form-group-default">
		                <label class="control-label">Localité :</label>
		                <input type="text" class="form-control" name="ville" placeholder="Localité" />
		              </div>
		              <div class="form-group form-group-default">
		                <label class="control-label">Cedex :</label>
		                <input type="text" class="form-control" name="cedex" placeholder="Cedex" />
		              </div>
		            </div>
		            <div class="col-md-12">&nbsp;</div>
		            <div class="col-md-6">
									<div class="form-group form-group-default form-group-default-select2 ">
										<label class="">Entreprise de rattachement :</label>
											<select class="full-width" data-placeholder="Choisir une entreprise" data-init-plugin="select2" id="select_business" name="id_ent" disabled>
		                </select>
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
		          <button type="submit" class="btn btn-success">AJOUTER</button>
		        </div>
		      </form>
		    </div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

	var id = null;
	var urlSelect = '<?=base_url();?>'+'select_all_ent';

	select ('#select_business', id, urlSelect);

	var id = null;
	var urlSelect = '<?=base_url();?>'+'select_all_cat';

	select ('#select_category', id, urlSelect);

	$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = '<?=base_url();?>'+'contacts/add.html';
		urlRedirect = '<?=base_url();?>'+'contacts.html';

		check_exist(urlCheck, urlRedirect, data);

	});

	</script>
