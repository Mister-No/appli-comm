<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Shuttle</p>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/en_cours.html">Campagnes</a>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/informations/modification/<?=$id_newsletter?>.html">Informations</a>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/newsletter/<?=$id_newsletter?>.html">Newsletter</a>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/listes/<?=$id_newsletter?>.html">Listes</a>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/envoi/<?=$id_newsletter?>.html" class="active">Envoi</a>
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
		        <div class="panel-title">Programmer l'envoi</div>
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
		            <div class="col-md-6">
									<div class="form-group form-group-default">
										<label class="control-label">Envoi programmé :</label>
										<input id="envoi_programme" type="checkbox" data-init-plugin="switchery" data-size="small" name="envoi_programme" />
									</div>
									<div class="form-group form-group-default form-group-default-select2 ">
										<label class="">Heure :</label>
											<select class="full-width" data-placeholder="" data-init-plugin="select2" name="theme">
												<?php for ($i=0; $i < 24; $i++) {
													echo '<option value="'.$i.'">'.$i.'</option>';
												} ?>
										</select>
									</div>
		            </div>
								<div class="col-md-6">
									<div class="form-group form-group-default">
										<div class="form-input-group">
											<label>Date</label>
											<input type="text" class="form-control" placeholder="" id="datepicker-component2" name="date_envoi">
										</div>
										<!--<div class="input-group-append ">
											<span class="input-group-text"><i class="fa fa-calendar"></i></span>
										</div>-->
									</div>
									<div class="form-group form-group-default form-group-default-select2 ">
										<label class="">Minutes :</label>
											<select class="full-width" data-placeholder="" data-init-plugin="select2" name="theme">
												<?php for ($i=0; $i < 12; $i++) {
													$minutes = $i*5;
													echo '<option value="'.$minutes.'">'.$minutes.'</option>';
												} ?>
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

	/**$('#envoi_programme').change( function() {
		if ($(this).val() == '') {
			$('.date_heure').addClass('showblock');
		} else {
			$('.date_heure').removeClass('hideblock');
		}
	});
	$('#envoi_programme').change();
	/**$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = 'builder/add.html';
		urlRedirect = 'contacts.html';

		check_exist(urlCheck, urlRedirect, data);

	});**/

	$('#datepicker-component2').change( function() {
		console.log($(this).val());
	});

	</script>
