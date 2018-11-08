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
					<?=$newsletter?>
					<!-- <div class="newsBuilderBlock headerBlock">
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
							<p>PAGES<br>
							1 rue test<br>
							11111 TEST<br>
							Tel: 01 01 01 01 01</p>
						</div>
						<input type="hidden" name="ordre" value="3">
					</div>
					<div class="newsBuilderBlock footerBlock">
						<div class="item">
							<a href="#">Se desinscrire de cette newsletter</a>
						</div>
						<input type="hidden" name="ordre" value="4">
					</div>-->

			</div>
		</div>
	</div>

	<script type="text/javascript">

		var id_block;
		var blockPlace;
		var newBlockPlace;

		$('.newsBuilderBlock').hover(function(){

			//blockPlace = $(this).children('input').val();
			id = $(this).children('input[name="id"]').val();
			blockPlace = $(this).children('input[name="ordre"]').val();

			$('.newsBuilderAddBlock').remove();
			$('.optionsBlock').remove();

			// BLOCK D'AJOUT

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

			// PLACE DU BLOCK

			addBlockPlace = $(this).attr('id');

			if (addBlockPlace == 'after') {
				newBlockPlace = Number(blockPlace)+1;
			} else if (addBlockPlace == 'before') {
				newBlockPlace = Number(blockPlace);
			} else {

			}

			// BLOCK OPTIONS

			if (blockPlace > 1) {
				upblock = '<button type="button" class="upBlock">'+
										'<i class="upIcon fa fa-arrow-up"></i>'+
									'</button>';
			} else {
				upblock = '';
			}

			if (blockPlace < $('.newsBuilderBlock').length) {
				downblock = '<button type="button" class="downBlock">'+
											'<i class="downIcon fa fa-arrow-down"></i>'+
										'</button>';
			} else {
				downblock = '';
			}

			edit_block	=	'<div class="optionsBlock">'+
											upblock+
											'<button type="submit" class="deleteBlock">'+
												'<i class="deleteIcon pg-close"></i>'+
											'</button>'+
											'<button type="button" class="editBlock">'+
												'<i class="editIcon fa fa-edit"></i>'+
											downblock+
										'</div>';

			$(this).append(edit_block);

			chooseblock();
			upMoveBlock();
			downMoveBlock();
			deleteBlock();

		});

		/**$('.newsBuilder').mouseleave(function(){
			console.log('out');
			$('.newsBuilderAddBlock').remove();
		});**/

	function chooseblock() {

		$('.newsBuilderAddBlock').click( function() {

			$('.blockSelect').hide();

			chooseBlock = '<div class="page-container blockSelect fullHeight">'+
											'<div class="main-content">'+
												'<div class="row">'+
													'<div class="closeBlockSelect col-lg-12">'+
														'<i class="closeIcon pg-close"></i>'+
													'</div>'+
													'<div class="col-lg-8 newsBlocks clearFloat center-block">'+
														'<div class="col-xs-2 newBlock imgBlock center-block" data-blocktype="5">'+
															'<i class="fa fa-image"></i>'+
															'<p>Image</p>'+
														'</div>'+
														'<div class="col-xs-2 newBlock imgTextBlock">'+
															'<i class="fa fa-image"></i>'+
															'<i class="pg-grid"></i>'+
															'<p>Image + Texte</p>'+
														'</div>'+
														'<div class="col-xs-2 newBlock titleBlock">'+
															'<i class="fa fa-font"></i>'+
															'<p>Titre</p>'+
														'</div>'+
														'<div class="col-xs-2 newBlock textBlock" data-blocktype="2">'+
															'<i class="fa fa-font"></i>'+
															'<p>Texte</p>'+
														'</div>'+
														'<div class="col-xs-2 newBlock spacerBlock">'+
															'<img class="spacerButton" src="/assets/img/spacer_icon.png" alt="">'+
															'<p>Marge</p>'+
														'</div>'+
														'<div class="col-xs-2 newBlock buttonBlock">'+
															'<img class="linkButton" src="/assets/img/link_button_icon.png" alt="">'+
															'<p>Bouton lien</p>'+
														'</div>'+
														'<div class="col-xs-2 newBlock spacerBlock">'+
															'<img class="spacerButton" src="/assets/img/spacer_icon.png" alt="">'+
															'<p>Marge</p>'+
														'</div>'+
														'<div class="col-xs-2 newBlock buttonBlock">'+
															'<img class="linkButton" src="/assets/img/link_button_icon.png" alt="">'+
															'<p>Bouton lien</p>'+
														'</div>'+
														'<div class="col-xs-2 newBlock spacerBlock">'+
															'<img class="spacerButton" src="/assets/img/spacer_icon.png" alt="">'+
															'<p>Marge</p>'+
														'</div>'+
														'<div class="col-xs-2 newBlock buttonBlock">'+
															'<img class="linkButton" src="/assets/img/link_button_icon.png" alt="">'+
															'<p>Bouton lien</p>'+
														'</div>'+
														'<div class="col-xs-2 newBlock spacerBlock">'+
															'<img class="spacerButton" src="/assets/img/spacer_icon.png" alt="">'+
															'<p>Marge</p>'+
														'</div>'+
														'<div class="col-xs-2 newBlock buttonBlock">'+
															'<img class="linkButton" src="/assets/img/link_button_icon.png" alt="">'+
															'<p>Bouton lien</p>'+
														'</div>'+
													'</div>'+
												'</div>'+
											'</div>'+
										'</div>';

			$('.pace-done').append(chooseBlock);

			$('.closeIcon').click( function() {
				$('.blockSelect').remove();
			});

			addblock();

		});

	}

	function addblock() {

		$('.newBlock').click( function() {
console.log(newBlockPlace);
			$('.blockSelect').hide();
			/**addBlockPlace = $(this).attr('id');

			if (addBlockPlace == 'after') {
				newBlockPlace = Number(blockPlace)+1;
			} else if (addBlockPlace == 'before') {
				newBlockPlace = Number(blockPlace);
			} else {

			}**/

			addBlock = '<div class="page-container blockSelect fullHeight">'+
										'<div class="main-content">'+
											'<div class="row">'+
												'<div class="closeBlockSelect col-lg-12">'+
													'<i class="closeIcon pg-close"></i>'+
												'</div>'+
												'<form class="col-lg-8 choosenBlockContainer clearFloat center-block" action="<?=base_url();?>builder/update/<?=$id_newsletter?>.html" method="post" enctype="multipart/form-data">'+
													'<div class="col-xs-10 center-block choosenBlock clearFloat">'+
													'</div>'+
													'<input type="hidden" name="ordre" value="'+newBlockPlace+'">'+
													'<div class="col-xs-10 choosenBlockFooter panel-footer center-block text-right">'+
														'<button id="return" type="button" class="btn btn-complete">RETOUR</button>'+
														'<button type="submit" class="btn btn-success">AJOUTER</button>'+
													'</div>'+
												'</form>'+
											'</div>'+
										'</div>'+
									'</div>';

			$('.pace-done').append(addBlock);

			$('#return').click( function() {
				//$('.choosenBlockContainer').css('display', 'none');
				chooseblock();
			});

			$('.closeIcon').click( function() {
				$('.blockSelect').remove();
			});

			blocktype = $(this).data('blocktype');

			if (blocktype == 1) {
				// BLOCK HEADER
			} else if (blocktype == 2) {

				// BLOCK TEXTE
				block = '<div class="summernote-wrapper"><textarea id="summernote" class="builderTextarea choosenBlockContent" name="text">Votre texte</textarea><input type="hidden" name="id_block" value="2"></div>';

				$('.choosenBlock').css('min-height', '200px');
				$('.choosenBlock').append(block);
				$('#summernote').summernote({
					toolbar: [
						// [groupName, [list of button]]
						['style', ['bold', 'italic', 'underline', 'clear']],
						['font', ['strikethrough', 'superscript', 'subscript']],
						['fontsize', ['fontsize']],
						['color', ['color']],
					],
					height: 140,
				});

			} else if (blocktype == 3) {
				// BLOCK FOOTER
			} else if (blocktype == 4) {
				// BLOCK DESABONNEMENT
			} else if (blocktype == 5) {

				// BLOCK IMAGE
				block = '<label class="choosenBlockContent">Votre image : </label>'+
				'<input type="file" class="builderInputFile choosenBlockContent" name="img">'+
				'<input type="hidden" name="id_block" value="5">';

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block);

			} else if (blocktype == 6) {

				// BLOCK TITRE
				block = '<input type="text" class="builderInput choosenBlockContent" name="text" placeholder="Votre titre">'+
				'<input type="hidden" name="id_block" value="2">';

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block);

			} else if (blocktype == 7) {

				// BLOCK BOUTTON
				block = '<input type="text" class="builderInput choosenBlockContent" name="text" placeholder="Titre du bouton">'+
				'<input type="text" class="builderInput choosenBlockContent" name="text1" placeholder="Votre lien">'+
				'<input type="hidden" name="id_block" value="3">';

				$('.choosenBlock').css('min-height', '100px');
				$('.choosenBlock').append(block);

			} else if (blocktype == 8) {

				// BLOCK ESPACE
				block = '<label class="choosenBlockContent">Ajouter un espace entre 2 blocs</label>'+
				'<input type="hidden" name="id_block" value="4">';

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block);

			}

		});

	}

	function editBlock() {

		$('.editBlock').unbind().click( function() {

			block = $(this).parent().parent();
			id_block = $(this).parent().parent().children('input[name="id_block"]').val();
			id_block_html = $(this).parent().parent().children('input[name="id_block"]').val();
			id_block_content = $(this).parent().parent().children('input[name="id_block_content"]').val();
			blockPlace = $(this).parent().parent().children('input[name="ordre"]').val();



			$.post('<?=base_url();?>builder/update/<?=$id_newsletter?>.html', {'id_block': id_block, 'id_block_content': id_block_content, 'ordre': blockPlace}, function(data) {

				if (data=='ok') {

					window.location.href='<?=base_url();?>builder/campagne_creer/<?=$id_newsletter?>.html';
				}

			});

		});

	}

	function upMoveBlock() {

		$('.upBlock').unbind().click( function() {

			id_block = $(this).parent().parent().children('input[name="id_block"]').val();
			blockPlace = $(this).parent().parent().children('input[name="ordre"]').val();

			$.post('<?=base_url();?>builder/block_move_up/<?=$id_newsletter?>.html', {'id_block': id_block, 'ordre': blockPlace}, function(data) {

				if (data=='ok') {
					window.location.href='<?=base_url();?>builder/campagne_creer/<?=$id_newsletter?>.html';
				}

			});

		});

	}

	function downMoveBlock() {

		$('.downBlock').unbind().click( function() {

			id_block = $(this).parent().parent().children('input[name="id_block"]').val();
			blockPlace = $(this).parent().parent().children('input[name="ordre"]').val();

			$.post('<?=base_url();?>builder/block_move_down/<?=$id_newsletter?>.html', {'id_block': id_block, 'ordre': blockPlace}, function(data) {

				if (data=='ok') {
					window.location.href='<?=base_url();?>builder/campagne_creer/<?=$id_newsletter?>.html';
				}

			});

		});

	}

	function deleteBlock() {

		$('.deleteBlock').unbind().click( function() {

			block = $(this).parent().parent();
			id_block = $(this).parent().parent().children('input[name="id_block"]').val();
			id_block_content = $(this).parent().parent().children('input[name="id_block_content"]').val();
			blockPlace = $(this).parent().parent().children('input[name="ordre"]').val();

			$.post('<?=base_url();?>builder/delete/<?=$id_newsletter?>.html', {'id_block': id_block, 'id_block_content': id_block_content, 'ordre': blockPlace}, function(data) {

				if (data=='ok') {
					block.remove();
					$('.newsBuilderAddBlock').remove();
					window.location.href='<?=base_url();?>builder/campagne_creer/<?=$id_newsletter?>.html';
				}

			});

		});

	}

	</script>
