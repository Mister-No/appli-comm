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
					<div class="newsBuilderBlock headerBlock">
						<img class="item" src="<?=base_url();?>assets/img/logo.png" alt="">
						<input type="hidden" name="ordre" value="1">
					</div>
					<div class="newsBuilderBlock text">
						<p>Some text.</p>
						<input type="hidden" name="ordre" value="2">
					</div>
					<div class="newsBuilderBlock footerBlock">
						<img class="item" src="<?=base_url();?>assets/img/logo.png" alt="">
						<div class="item">
							<p>PAGES</p>
							<p>1 rue test</p>
							<p>11111 TEST</p>
							<p>Tel: 01 01 01 01 01</p>
						</div>
						<input type="hidden" name="ordre" value="3">
					</div>
					<div class="newsBuilderBlock footerBlock">
						<div class="item">
							<a href="#">Se desinscrire</a>
						</div>
						<input type="hidden" name="ordre" value="4">
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">

		var blockPlace;

		$('.newsBuilderBlock').hover(function(){

			thisBlockOrder = $(this).children('input').val();
			hoverAddBlock = $(this).next().attr('id');

			if (hoverAddBlock == 'after') {
				blockPlace = Number(thisBlockOrder)+1;
			} else if (hoverAddBlock == 'before') {
				blockPlace = Number(thisBlockOrder)-1;
			} else {

			}

			$('.newsBuilderAddBlock').remove();

			block_before = '<div id="before" class="newsBuilderAddBlock">'+
								'<div class="addBlock center-block">'+
									'<i class="addIcon pg-plus"></i>'+
								'</div>'+
							'</div>';

			block_after = '<div id="after" class="newsBuilderAddBlock">'+
								'<div class="addBlock center-block">'+
									'<i class="addIcon pg-plus"></i>'+
								'</div>'+
							'</div>';

			$(this).before(block_before);
			$(this).after(block_after);



			console.log(blockPlace);

			addblock(blockPlace);

		});

		/**$('.newsBuilder').mouseleave(function(){
			console.log('out');
			$('.newsBuilderAddBlock').remove();
		});**/

	function addblock(blockPlace) {

		$('.newsBuilderAddBlock').click( function() {
console.log(blockPlace);
			chooseBlock = '	<div class="page-container blockSelect fullHeight">'+
												'<div class="main-content">'+
													'<div class="row">'+
														'<div class="closeBlockSelect col-lg-12">'+
															'<i class="closeIcon pg-close"></i>'+
														'</div>'+
														'<div class="col-lg-12 newsBlocks center-block">'+
															'<div class="col-xs-2 newBlock imgBlock center-block">'+
																'<i class="fa fa-image"></i>'+
																'<p>Image</p>'+
															'</div>'+
															'<div class="col-xs-2 newBlock imgTextBlock center-block">'+
																'<i class="fa fa-image"></i>'+
																'<i class="pg-grid"></i>'+
																'<p>Image + Texte</p>'+
															'</div>'+
															'<div class="col-xs-2 newBlock titleBlock center-block">'+
																'<i class="fa fa-font"></i>'+
																'<p>Titre</p>'+
															'</div>'+
															'<div class="col-xs-2 newBlock textBlock center-block">'+
																'<i class="fa fa-font"></i>'+
																'<p>Texte</p>'+
															'</div>'+
															'<div class="col-xs-2 newBlock spacerBlock center-block">'+
																'<img class="spacerButton" src="/assets/img/spacer_icon.png" alt="">'+
																'<p>Marge</p>'+
															'</div>'+
															'<div class="col-xs-2 newBlock buttonBlock center-block">'+
																'<img class="linkButton" src="/assets/img/link_button_icon.png" alt="">'+
																'<p>Bouton lien</p>'+
															'</div>'+
															'<div class="col-xs-2 newBlock spacerBlock center-block">'+
																'<img class="spacerButton" src="/assets/img/spacer_icon.png" alt="">'+
																'<p>Marge</p>'+
															'</div>'+
															'<div class="col-xs-2 newBlock buttonBlock center-block">'+
																'<img class="linkButton" src="/assets/img/link_button_icon.png" alt="">'+
																'<p>Bouton lien</p>'+
															'</div>'+
															'<div class="col-xs-2 newBlock spacerBlock center-block">'+
																'<img class="spacerButton" src="/assets/img/spacer_icon.png" alt="">'+
																'<p>Marge</p>'+
															'</div>'+
															'<div class="col-xs-2 newBlock buttonBlock center-block">'+
																'<img class="linkButton" src="/assets/img/link_button_icon.png" alt="">'+
																'<p>Bouton lien</p>'+
															'</div>'+
															'<div class="col-xs-2 newBlock spacerBlock center-block">'+
																'<img class="spacerButton" src="/assets/img/spacer_icon.png" alt="">'+
																'<p>Marge</p>'+
															'</div>'+
															'<div class="col-xs-2 newBlock buttonBlock center-block">'+
																'<img class="linkButton" src="/assets/img/link_button_icon.png" alt="">'+
																'<p>Bouton lien</p>'+
															'</div>'+
														'</div>'+
														'<form class="col-lg-12 choosenBlockContainer" action="<?=base_url();?>builder/add.html" method="post" enctype="multipart/form-data">'+
															'<div class="col-xs-10 center-block choosenBlock clearFloat">'+
															'</div>'+
															'<input type="hidden" name="ordre" value="'+blockPlace+'">'+
															'<div class="col-xs-10 choosenBlockFooter panel-footer center-block text-right">'+
																'<button id="return" type="button" class="btn btn-complete">RETOUR</button>'+
																'<button type="submit" class="btn btn-success">AJOUTER</button>'+
															'</div>'+
														'</form>'+
													'</div>'+
												'</div>'+
											'</div>';

			$('.pace-done').append(chooseBlock);

			$('#return').click( function() {
				$('.choosenBlockContainer').css('display', 'none');
				$('.newsBlocks').show();
			});

			$('.closeIcon').click( function() {
				$('.blockSelect').remove();
			});

			$('.textBlock').click( function() {

				$('.newsBlocks').hide();
				$('.choosenBlockContainer').css('display', 'flex');
				$('.choosenBlockContent').remove();

				block = '<textarea class="builderTextarea choosenBlockContent" name="text" placeholder="Votre texte"></textarea>'+
				'<input type="hidden" name="type" value="1">';

				$('.choosenBlock').css('min-height', '100px');
				$('.choosenBlock').append(block);

			});

			$('.titleBlock').click( function() {

				$('.newsBlocks').hide();
				$('.choosenBlockContainer').css('display', 'flex');
				$('.choosenBlockContent').remove();

				block = '<input type="text" class="builderInput choosenBlockContent" name="text" placeholder="Votre titre">'+
				'<input type="hidden" name="type" value="2">';

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block);

			});

			$('.buttonBlock').click( function() {

				$('.newsBlocks').hide();
				$('.choosenBlockContainer').css('display', 'flex');
				$('.choosenBlockContent').remove();

				block = '<input type="text" class="builderInput choosenBlockContent" name="text" placeholder="Titre du bouton">'+
				'<input type="text" class="builderInput choosenBlockContent" name="text1" placeholder="Votre lien">'+
				'<input type="hidden" name="type" value="3">';

				$('.choosenBlock').css('min-height', '100px');
				$('.choosenBlock').append(block);

			});

			$('.spacerBlock').click( function() {

				$('.newsBlocks').hide();
				$('.choosenBlockContainer').css('display', 'flex');
				$('.choosenBlockContent').remove();

				block = '<label class="choosenBlockContent">Ajouter un espace entre 2 blocs</label>'+
				'<input type="hidden" name="type" value="4">';

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block);

			});

			$('.imgBlock').click( function() {

				$('.newsBlocks').hide();
				$('.choosenBlockContainer').css('display', 'flex');
				$('.choosenBlockContent').remove();

				block = '<label class="choosenBlockContent">Votre image : </label>'+
				'<input type="file" class="builderInputFile choosenBlockContent" name="img">'+
				'<input type="hidden" name="type" value="5">';

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block);

			});

			$('.imgTextBlock').click( function() {

				$('.newsBlocks').hide();
				$('.choosenBlockContainer').css('display', 'flex');
				$('.choosenBlockContent').remove();

				block = '<label class="choosenBlockContent">Votre image : </label>'+
				'<input type="file" class="builderInputFile choosenBlockContent" name="text">'+
				'<input class="builderInput choosenBlockContent" name="newsLinkButtonBlock" placeholder="Votre texte">'
				+'<input type="hidden" name="type" value="6">';

				$('.choosenBlock').css('min-height', '100px');
				$('.choosenBlock').append(block);

			});

		});

	}


	</script>
