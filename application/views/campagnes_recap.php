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
					<?php foreach ($campagne as $row_camp) {
						echo '<a href="' . base_url() . 'campagnes/listes/' . $row_camp['id'] . '">Campagne ' . $row_camp['campaign_name'] . '</a>';
					}
					?>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/listes.html" class="active">Envoyer</a>
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
							<div class="panel-title">Confirmation des destinataires</div>
						</div>
					</div>

					<form id="form" method="post" class="validate" action="<?=base_url();?>campagnes/envoyer">
						<div class="panel panel-default" id="portlet-basic">
							<div class="panel-heading">
								<input type="hidden" name="id_campagne" value="<?=$row_camp['id']?>">
								<div class="row">


		<?php foreach ($email_array as $row) {

						echo '<div class="col-md-3">
										<div data-pages="portlet" class="panel panel-default" id="portlet-basic">
											<div class="panel-heading">
												<div class="panel-title">' . $row['nom'] . ' ' . $row['prenom'] . '</div>
												<input type="hidden" name="nom[]" value="' . $row['nom'] . '" >
												<input type="hidden" name="prenom[]" value="' . $row['prenom'] . '" >
													<div class="panel panel-controls">
														<ul>
														<li><input type="checkbox" name="email[]"  value="' . $row['email'] . '" checked></li>
													</ul>
												</div>
												<div class="panel"><i>' . $row['email'] . '</i></div>
											</div>
										</div>
									</div>';

									} ?>

				</div>
			 </div>
			 <div class="panel-footer text-right">
				 <button type="submit" class="btn btn-success">ENVOYER LA NEWSLETTER</button>
			 </div>
		 </form>
	 </div>
 </div>

	<script type="text/javascript">

	/***$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = 'campagnes/listes_recap.html';
		urlRedirect = 'campagnes.html';

		check_exist(urlCheck, urlRedirect, data);

	});***/

	</script>
