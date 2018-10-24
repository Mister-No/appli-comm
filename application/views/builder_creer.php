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
					<a href="<?=base_url();?>builder/campagne_creer.html" class="active">Créer</a>
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
				<div class="clearFloat noPadding border center-block col-lg-8 newsBuilder">
					<div class="newsBuilderBlock">
						<div class="addBlock center-block">
							<i class="addIcon pg-plus">

							</i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">

	var id = null;
	var urlSelect = 'select_all_ent';

	select ('#select_business', id, urlSelect);

	var id = null;
	var urlSelect = 'select_all_cat';

	select ('#select_category', id, urlSelect);

	$('#form').submit(function(e) {

		e.preventDefault();

		data = $(this).serialize();
		urlCheck = 'contacts/add.html';
		urlRedirect = 'contacts.html';

		check_exist(urlCheck, urlRedirect, data);

	});

	</script>
