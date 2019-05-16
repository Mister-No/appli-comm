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
		        <div class="panel-title">Envoyer votre newsletter</div>
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
									<div class="form-group form-group-default form-group-default-select2">
										<label class="">Type d'envoi :</label>
										<select id="type_envoi" class="full-width" data-placeholder="" data-init-plugin="select2" name="type_envoi">
											<option value="0">Envoi immédiat</option>
											<option value="1">Envoi différé</option>
										</select>
									</div>
									<div class="form-group form-group-default form-group-default-select2 date_heure">
										<label class="">Heure :</label>
										<select id="heure" class="full-width" data-placeholder="" data-init-plugin="select2" name="heure_envoi">
											<?php for ($i=0; $i < 24; $i++) { ?>
												<option value="<?php echo ($i<10)?$heure = '0'.$i:$heure = $i; ?>" <?php echo (date('H', strtotime('1 hour'))==$i)?'selected="selected"':''; ?>><?php echo ($i<10)?$heure = '0'.$i:$heure = $i; ?></option>';
											<?php	} ?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-group-default date_heure">
										<div class="form-input-group">
											<label>Date</label>
											<input type="text" class="form-control" placeholder="" id="datepicker-component2" name="date_envoi" value="" >
										</div>
										<!--<div class="input-group-append ">
											<span class="input-group-text"><i class="fa fa-calendar"></i></span>
										</div>-->
									</div>
									<div class="form-group form-group-default form-group-default-select2 date_heure">
										<label class="">Minutes :</label>
											<select id="minutes" class="full-width" data-placeholder="" data-init-plugin="select2" name="minute_envoi">
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
		          <button id="send_button" type="button" class="btn btn-success">ENVOYER</button>
		        </div>
		      </form>
		    </div>
			</div>
			<div class="modal fade" id="modal-delete">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"></h4>
						</div>
						<form action="<?=base_url();?>campagnes/send/<?=$id_newsletter?>.html" method="POST">
							<input type="hidden" name="type_envoi" id="type_envoi_val">
							<input type="hidden" name="date_envoi" id="date_val">
							<input type="hidden" name="heure_envoi" id="heure_val">
							<input type="hidden" name="minute_envoi" id="minutes_val">
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

	/**$('#datepicker-component2').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    startDate: moment(),
    minDate: moment(),
    locale: {
        format: 'DD-MM-YYYY'
    }
	});**/

  $('#datepicker-component2').change( function() {

    my_date = $(this).val();

    jour = my_date.substr(0,2);
  	mois = my_date.substr(3,2);
  	annee = my_date.substr(6,8);

  	my_date = mois+'/'+jour+'/'+annee;

    $(this).val(my_date);

  });

	$('#type_envoi').change( function() {
		if ($(this).val() == 1) {
    	$('.date_heure').show();
    } else {
	    $('.date_heure').hide();
	 	}
	});
	$('#type_envoi').change();

	$('#send_button').click( function () {
		id = '<?=$id_newsletter?>';
		titre = '<?=$nom_campagne?>';
		type_envoi = $('#type_envoi').val();
		if (type_envoi==1) {
			envoi = 'différé';
			date = $('#datepicker-component2').val();
			heure = $('#heure').val();
			minutes = $('#minutes').val();
		} else {
			envoi = 'immédiat';
			date = '';
			heure = '';
			minutes = '';
		}
		$(".modal").find ("#id").val(id);
		$(".modal").find('#type_envoi_val').val(type_envoi);
		$(".modal").find('#date_val').val(date);
		$(".modal").find('#heure_val').val(heure);
		$(".modal").find('#minutes_val').val(minutes);
		$(".modal-title").empty().append('Confirmer l\'envoi '+envoi+' ?');
		$(".modal-body").empty().append(titre);
		$('#modal-delete').modal('show', {backdrop: 'fade'});
	});

	</script>
