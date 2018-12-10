<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Pages</p>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes.html">Campagnes</a>
				</li>
				<li>
					<a href="<?=base_url();?>builder/campagne_creer.html">Créer</a>
				</li>
				<li>
					<a href="<?=base_url();?>builder/campagne_listes.html" class="active">Listes de contacts</a>
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
				<div class="col-md-12">
				<div data-pages="portlet" class="panel panel-default" id="portlet-basic">
					<div class="panel-heading">
						<div class="panel-title">Sélectionner une liste de contacts</div>
						<div class="panel-controls">
							<ul>
							<li><input id="check_all_list" type="checkbox" name="id_list[]" value=""></li>
							</li>
						</ul>
					</div>
					</div>
				</div>
			</div>
		</div>
		<?php foreach ($result_list as $row_list) { ?>
		<div class="row">
			<div class="col-md-12">
				<div data-pages="portlet" class="panel panel-default" id="portlet-basic">
					<div class="panel-heading">
						<div class="panel-title"><?=$row_list->titre?></div>
							<div class="panel-controls">
								<ul>
								<li><input type="checkbox" name="id_list[]" class="check_all" value="<?=$row_list->id?>"></li>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>

		<div class="panel-footer text-right">
			<a href="" class="btn btn-success">VALIDER</a>
		</div>

			</div>
		</div>
	<script type="text/javascript">

	$('#check_all_list').click( function() {
		$(".check_all").prop ("checked", $(this).prop('checked'));
	});

	$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = '';
		urlRedirect = 'listes.html';

		check_exist(urlCheck, urlRedirect, data);

	});

	</script>
