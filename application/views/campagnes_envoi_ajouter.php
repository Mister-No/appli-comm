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
										<label class="control-label">Envoi immédiat :</label>
										<input id="envoi_immediat" type="checkbox" data-init-plugin="switchery" data-size="small" name="envoi_immediat" />
									</div>
								</div>
							</div>
						</div>
						<hr>
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
													if (date('H') == $heure) {
														echo '<option value="'.$heure.'" selected="selected">'.$heure.'</option>';
													} else {
														echo '<option value="'.$heure.'">'.$heure.'</option>';
													}
												} ?>
										</select>
									</div>
		            </div>
								<div class="col-md-6">
									<div class="form-group form-group-default date_heure">
										<div class="form-input-group">
											<label>Date</label>
											<input type="text" class="form-control" placeholder="" id="datepicker-component2" name="date_envoi" value="<?=date('Y/m/d')?>" >
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
													if (date('i') == $minutes) {
														echo '<option value="'.$minutes.'" selected="selected">'.$minutes.'</option>';
													} else {
														echo '<option value="'.$minutes.'">'.$minutes.'</option>';
													}
												} ?>
										</select>
									</div>
								</div>
		          </div>
		        </div>
		        <div class="panel-footer text-right">
		          <button type="button" class="btn btn-success" onclick="popin( '<?=$id_newsletter?>', '<?=$nom_campagne?>')">ENVOYER</button>
		        </div>
		      </form>
		    </div>
			</div>
			<div class="modal fade" id="modal-delete">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Voulez-vous vraiment envoyer cette campagne?</h4>
						</div>
						<form action="<?=base_url();?>campagnes/delete.html" method="POST">
		          <input type="hidden" name="id" id="id">
							<input type="hidden" name="id" id="id">
							<input type="hidden" name="id" id="id">
							<input type="hidden" name="id" id="id">
		          <div class="modal-body"></div>
		          <div class="modal-footer">
		            <button type="button" class="btn btn-white" data-dismiss="modal">Fermer</button>
		            <button type="submit" class="btn btn-info">ENVOYER</button>
		          </div>
		        </form>
					</div>
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

	$('#envoi_immediat').change( function() {
		if ($(this).attr('checked')) {
    	$('#envoi_programme').attr('false');
    } else {
	    $('#envoi_programme').attr('true');
	 	}
	});

	$('#envoi_programme').change( function() {
		if ($(this).attr('checked')) {
    	$('#envoi_immediat').attr('false');
    } else {
	    $('#envoi_immediat').attr('true');
	 	}
	});

	function send_popin (id, titre, id_parent)
	{
		$(".modal").find ("#id").val(id);
		if (id_parent != '') {
			$(".modal").find ("#id_parent").val(id_parent);
		}
		$(".modal-body").empty().append (titre);
		$('#modal-delete').modal('show', {backdrop: 'fade'});


	}

	var initTableWithSearch = function() {};
	/**$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = 'builder/add.html';
		urlRedirect = 'contacts.html';

		check_exist(urlCheck, urlRedirect, data);

	});**/


	</script>
