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
					<a href="<?=base_url();?>campagnes/informations/modification/<?=$id_newsletter?>.html" class="active">Informations</a>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/newsletter/<?=$id_newsletter?>.html">Newsletter</a>
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
		        <div class="panel-title">MODIFIER UNE CAMPAGNE</div>
						<div class="panel-controls">
							<ul>
								<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
								class="portlet-icon portlet-icon-collapse"></i></a>
								</li>
							</ul>
						</div>
		      </div>
		      <form id="form" method="post" class="validate" action="<?=base_url();?>campagnes/update_newsletter/<?=$id_newsletter?>.html">
		        <div class="panel-body">
		          <div class="row">
		            <div class="col-md-12">
									<div class="form-group form-group-default">
		                <label class="control-label">Nom de la campagne :</label>
		                <input type="text" class="form-control" name="nom_campagne" placeholder="Nom de la campagne" value="<?=$nom_campagne?>"/>
		              </div>
									<div class="form-group form-group-default">
										<label class="control-label">Objet de l'email :</label>
										<input type="text" class="form-control" name="objet" placeholder="Objet de l'email" value="<?=$objet_campagne?>" />
									</div>
		            	<div class="form-group form-group-default">
		                <label class="control-label">Expediteur :</label>
		                <input type="text" class="form-control" name="expediteur" placeholder="Expediteur" value="<?=$expediteur_campagne?>" required />
		              </div>
		            </div>
								<div class="form-group form-group-default">
									<label class="control-label">Envoi programmé :</label>
									<input id="envoi_programme" type="checkbox" data-init-plugin="switchery" data-size="small" name="envoi_programme" value="<?=$envoi_programme?>">
								</div>
								<div class="form-group form-group-default">
									<div class="form-input-group">
										<label>Date</label>
										<input type="text" class="form-control" placeholder="" id="datepicker-component2" name="date_envoi" value="<?=$date_envoi?>">
									</div>
									<!--<div class="input-group-append ">
										<span class="input-group-text"><i class="fa fa-calendar"></i></span>
									</div>-->
								</div>
								<div class="form-group form-group-default">
									<div class="form-input-group bootstrap-timepicker">
										<label>Heure</label>
										<input id="timepicker" type="text" class="form-control" name="heure_envoi" value="<?=$heure_envoi?>">
									</div>
									<!--<div class="input-group-append">
										<span class="input-group-text"><i class="pg-clock"></i></span>
									</div>-->
								</div>
								<div class="form-group form-group-default form-group-default-select2 ">
									<label class="">Thème :</label>
										<select class="full-width" data-placeholder="Choisir un thème" data-init-plugin="select2" name="theme" disabled>
											<option value=""></option>
											<?php foreach ($result_theme_newsletter as $row_theme_newsletter): ?>
												<option value="<?=$row_theme_newsletter->id?>" <?php echo ($theme_campagne == $row_theme_newsletter->id)? 'selected="selected"': ''; ?>><?=$row_theme_newsletter->nom?></option>
											<?php endforeach; ?>
	                </select>
	              </div>
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
	<script type="text/javascript">

	/**$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = 'builder/add.html';
		urlRedirect = 'contacts.html';

		check_exist(urlCheck, urlRedirect, data);

	});**/

	</script>