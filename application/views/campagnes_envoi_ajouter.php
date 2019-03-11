<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Shuttle</p>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes.html">Campagnes</a>
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
					<a href="<?=base_url();?>campagnes/envoi/<?=$id_newsletter?>.html" class="active">Envoyer</a>
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
		      <form id="form" method="post" class="validate" action="<?=base_url();?>campagnes/send/<?=$id_newsletter?>.html">
		        <div class="panel-body">
		          <div class="row">
		            <div class="col-md-6">
									<div class="form-group form-group-default">
										<label class="control-label">Envoi programmé :</label>
										<input id="envoi_programme" type="checkbox" data-init-plugin="switchery" data-size="small" name="envoi_programme" />
									</div>
									<div class="form-group form-group-default form-group-default-select2 date_heure">
										<label class="">Heure :</label>
											<select class="full-width" data-placeholder="" data-init-plugin="select2" name="heure_envoi">
												<?php for ($i=0; $i < 24; $i++) {
													($i<10)?$heure = '0'.$i:$heure = $i;
													echo '<option value="'.$heure.'">'.$heure.'</option>';
												} ?>
										</select>
									</div>
		            </div>
								<div class="col-md-6">
									<div class="form-group form-group-default date_heure">
										<div class="form-input-group">
											<label>Date</label>
											<input type="text" class="form-control" placeholder="" id="datepicker-component2" name="date_envoi" value="">
										</div>
										<!--<div class="input-group-append ">
											<span class="input-group-text"><i class="fa fa-calendar"></i></span>
										</div>-->
									</div>
									<div class="form-group form-group-default form-group-default-select2 date_heure">
										<label class="">Minutes :</label>
											<select class="full-width" data-placeholder="" data-init-plugin="select2" name="minute_envoi">
												<?php for ($i=0; $i < 12; $i++) {
													($i<2)?$minutes = '0'.$i*5:$minutes = $i*5;
													echo '<option value="'.$minutes.'">'.$minutes.'</option>';
												} ?>
										</select>
									</div>
								</div>
		          </div>
		        </div>
		        <div class="panel-footer text-right">
		          <button type="submit" class="btn btn-success">ENVOYER</button>
		        </div>
		      </form>
		    </div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

	// date_us_to_fr

  $('#datepicker-component2').change( function() {

    my_date = $(this).val();

    jour = my_date.substr(0,2);
  	mois = my_date.substr(3,2);
  	annee = my_date.substr(6,8);

  	my_date = mois+'/'+jour+'/'+annee;

    $(this).val(my_date);

  });

	$('#envoi_programme').change( function() {
		$('.date_heure').toggle();
	});
	$('#envoi_programme').change();

	/**$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = 'builder/add.html';
		urlRedirect = 'contacts.html';

		check_exist(urlCheck, urlRedirect, data);

	});**/


	</script>
