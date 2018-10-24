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
					<div class="addBlock center-block">
						<i class="addIcon pg-plus"></i>
					</div>
					<!--<div class="newsBuilderBlock">

					</div>-->
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">

	$('.addBlock').click( function() {

		chooseBlock = '	<div class="page-container blockSelect fullHeight">'+
											'<div class="main-content">'+
												'<div class="row">'+
													'<div class="closeBlockSelect col-lg-12">'+
														'<i class="closeIcon pg-close"></i>'+
													'</div>'+
													'<div class="col-lg-4 newsBlocks">'+
														'<div class="col-xs-6 newBlock imgBlock center-block clearFloat">'+
															'<i class="fa fa-image"></i>'+
															'<p>Image</p>'+
														'</div>'+
														'<div class="col-xs-6 newBlock imgTextBlock center-block clearFloat">'+
															'<i class="fa fa-image"></i>'+
															'<i class="pg-grid"></i>'+
															'<p>Image + Texte</p>'+
														'</div>'+
														'<div class="col-xs-6 newBlock titleBlock center-block clearFloat">'+
															'<i class="fa fa-font"></i>'+
															'<p>Titre</p>'+
														'</div>'+
														'<div class="col-xs-6 newBlock textBlock center-block clearFloat">'+
															'<i class="fa fa-font"></i>'+
															'<p>Texte</p>'+
														'</div>'+
														'<div class="col-xs-6 newBlock spacerBlock center-block clearFloat">'+
															'<img class="spacerButton" src="/assets/img/spacer_icon.png" alt="">'+
															'<p>Marge</p>'+
														'</div>'+
														'<div class="col-xs-6 newBlock buttonBlock center-block clearFloat">'+
															'<img class="linkButton" src="/assets/img/link_button_icon.png" alt="">'+
															'<p>Bouton lien</p>'+
														'</div>'+
													'</div>'+
													'<form class="col-lg-8 choosenBlockContainer">'+
														'<div class="col-xs-10 center-block choosenBlock clearFloat">'+
														'</div>'+
														'<div class="col-xs-10 choosenBlockFooter panel-footer text-right">'+
															'<button type="submit" class="btn btn-success">AJOUTER</button>'+
														'</div>'+
													'</form>'+
												'</div>'+
											'</div>'+
										'</div>';

		$('.pace-done').append(chooseBlock);

		$('.closeIcon').click( function() {
			$('.blockSelect').remove();
		});

		$('.textBlock').click( function() {

			$('.choosenBlockContainer').css('visibility', 'visible');
			$('.choosenBlockContent').remove();

			block = '<textarea class="builderTextarea choosenBlockContent" name="newsTextBlock" placeholder="Votre texte"></textarea>';

			$('.choosenBlock').css('min-height', '100px');
			$('.choosenBlock').append(block);

		});

		$('.titleBlock').click( function() {

			$('.choosenBlockContainer').css('visibility', 'visible');
			$('.choosenBlockContent').remove();

			block = '<input type="text" class="builderInput choosenBlockContent" name="newsTitleBlock" placeholder="Votre titre">';

			$('.choosenBlock').css('min-height', '40px');
			$('.choosenBlock').append(block);

		});

		$('.buttonBlock').click( function() {

			$('.choosenBlockContainer').css('visibility', 'visible');
			$('.choosenBlockContent').remove();

			block = '<input type="text" class="builderInput choosenBlockContent" name="newsButtonTitleBlock" placeholder="Titre du bouton">'+
			'<input type="text" class="builderInput choosenBlockContent" name="newsLinkButtonBlock" placeholder="Votre lien">';

			$('.choosenBlock').css('min-height', '100px');
			$('.choosenBlock').append(block);

		});

		$('.spacerBlock').click( function() {

			$('.choosenBlockContainer').css('visibility', 'visible');
			$('.choosenBlockContent').remove();

			block = '<label class="choosenBlockContent">Ajouter un espace entre 2 blocs</label>';

			$('.choosenBlock').css('min-height', '40px');
			$('.choosenBlock').append(block);

		});

		$('.imgBlock').click( function() {

			$('.choosenBlockContainer').css('visibility', 'visible');
			$('.choosenBlockContent').remove();

			block = '<label class="choosenBlockContent">Votre image : </label>'+
			'<input type="file" class="builderInputFile choosenBlockContent" name="newsImgBlock">';

			$('.choosenBlock').css('min-height', '40px');
			$('.choosenBlock').append(block);

		});

		$('.imgTextBlock').click( function() {

			$('.choosenBlockContainer').css('visibility', 'visible');
			$('.choosenBlockContent').remove();

			block = '<label class="choosenBlockContent">Votre image : </label>'+
			'<input type="file" class="builderInputFile choosenBlockContent" name="newsButtonTitleBlock">'+
			'<input class="builderInput choosenBlockContent" name="newsLinkButtonBlock" placeholder="Votre texte">';

			$('.choosenBlock').css('min-height', '100px');
			$('.choosenBlock').append(block);

		});

	});

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
