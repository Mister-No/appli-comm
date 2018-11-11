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
					<!--<div class="newsBuilderBlock text">
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

			// CALCUL DE LA PLACE DU BLOCK QUI VA ETRE AJOUTÉ

			$('.newsBuilderAddBlock').hover( function() {

				addBlockPlace = $(this).attr('id');

				if (addBlockPlace == 'after') {
					newBlockPlace = Number(blockPlace)+1;
				} else if (addBlockPlace == 'before') {
					newBlockPlace = Number(blockPlace);
				} else {

				}

			});

			chooseblock();
			upMoveBlock();
			downMoveBlock();
			editBlock();
			deleteBlock();

		});

		/**$('.newsBuilder').mouseleave(function(){
			console.log('out');
			$('.newsBuilderAddBlock').remove();
		});**/

	function chooseblock() {

		$('.newsBuilderAddBlock').click( function() {

			$('.blockSelect').remove();

			chooseBlock = '<div class="page-container blockSelect fullHeight">'+
											'<div class="main-content">'+
												'<div class="row">'+
													'<div class="closeBlockSelect col-lg-12">'+
														'<i class="closeIcon pg-close"></i>'+
													'</div>'+
													'<div class="col-lg-8 newsBlocks clearFloat center-block">'+
														'<?=$builder_block_html?>'+
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

			// BLOCK IMAGE
			block_image = '<label class="choosenBlockContent">Votre image : </label>'+
			'<input type="file" class="builderInputFile choosenBlockContent" name="img" value="">'+
			'<input type="hidden" name="id_block" value="1">';

			// BLOCK TEXTE
			block_texte = '<div class="summernote-wrapper"><textarea id="summernote" class="builderTextarea choosenBlockContent" name="text">Votre texte</textarea><input type="hidden" name="id_block" value="2"></div>';

			// BLOCK FOOTER LOGO + ADRESSE
			block_footer = '<label class="choosenBlockContent">Votre image : </label>'+
			'<input type="file" class="builderInputFile choosenBlockContent" name="img" value="">'+
			'<input type="text" class="builderInput choosenBlockContent" name="text" placeholder="Votre adresse" value="">'+
			'<input type="hidden" name="id_block" value="3">';

			// BLOCK BOUTON LIEN
			block_bouton = '<input type="text" class="builderInput choosenBlockContent" name="text" placeholder="Titre du bouton" value="">'+
			'<input type="text" class="builderInput choosenBlockContent" name="text1" placeholder="Votre lien" value="">'+
			'<input type="hidden" name="id_block" value="4">';

			// BLOCK IMAGE + TEXTE
			block_image_texte = '<label class="choosenBlockContent">Votre image : </label>'+
			'<input type="file" class="builderInputFile choosenBlockContent" name="img" value="">'+
			'<input type="hidden" name="id_block" value="5"><div class="summernote-wrapper"><textarea id="summernote" class="builderTextarea choosenBlockContent" name="text">Votre texte</textarea><input type="hidden" name="id_block" value="5"></div>';

			// BLOCK TITRE
			block_titre = '<input type="text" class="builderInput choosenBlockContent" name="text" placeholder="Votre titre" value="">'+
			'<input type="hidden" name="id_block" value="6">';

			// BLOCK ESPACE
			block_espace = '<label class="choosenBlockContent">Ajouter un espace entre 2 blocs</label>'+
			'<input type="hidden" name="id_block" value="7">';

			$('.blockSelect').remove();

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
				$('.newsBuilderAddBlock').click();
			});

			$('.closeIcon').click( function() {
				$('.blockSelect').remove();
			});

			blocktype = $(this).data('blocktype');

			if (blocktype == 1) {

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block_image);

			} else if (blocktype == 2) {

				$('.choosenBlock').css('min-height', '200px');
				$('.choosenBlock').append(block_texte);
				$('#summernote').summernote({
					toolbar: [
						// [groupName, [list of button]]
						['style', ['bold', 'italic', 'underline', 'clear']],
						['font', ['strikethrough', 'superscript', 'subscript']],
						['fontsize', ['fontsize']],
						['color', ['color']],
						['para', ['paragraph']],
					],
					height: 140,
				});

			} else if (blocktype == 3) {

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block_footer);

			} else if (blocktype == 4) {

				$('.choosenBlock').css('min-height', '100px');
				$('.choosenBlock').append(block_bouton);

			} else if (blocktype == 5) {

				$('.choosenBlock').css('min-height', '200px');
				$('.choosenBlock').append(block_image_texte);
				$('#summernote').summernote({
					toolbar: [
						// [groupName, [list of button]]
						['style', ['bold', 'italic', 'underline', 'clear']],
						['font', ['strikethrough', 'superscript', 'subscript']],
						['fontsize', ['fontsize']],
						['color', ['color']],
						['para', ['paragraph']],
					],
					height: 140,
				});

			} else if (blocktype == 6) {

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block_titre);

			} else if (blocktype == 7) {

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block_espace);

			} else if (blocktype == 8) {



			}

		});

	}

	function editBlock() {

		$('.editBlock').unbind().click( function() {
console.log('ok');
			block = $(this).parent().parent();
			id_block = $(this).parent().parent().children('input[name="id_block"]').val();
			id_block_html = $(this).parent().parent().children('input[name="id_block"]').val();
			id_block_content = $(this).parent().parent().children('input[name="id_block_content"]').val();

			$.post('<?=base_url();?>builder/get_block_content/<?=$id_newsletter?>.html', {'id_block': id_block, 'id_block_html': id_block_html, 'id_block_content': id_block_content}, function(data) {
console.log(data);
				if (data=='ok') {


				}

			}, 'json');

			// BLOCK IMAGE
			block_image = '<label class="choosenBlockContent">Votre image : </label>'+
			'<input type="file" class="builderInputFile choosenBlockContent" name="img" value="'+contentImg+'">'+
			'<input type="hidden" name="id_block" value="1">';

			// BLOCK TEXTE
			block_texte = '<div class="summernote-wrapper"><textarea id="summernote" class="builderTextarea choosenBlockContent" name="text">Votre texte</textarea><input type="hidden" name="id_block" value="2"></div>';

			// BLOCK FOOTER LOGO + ADRESSE
			block_footer = '<label class="choosenBlockContent">Votre image : </label>'+
			'<input type="file" class="builderInputFile choosenBlockContent" name="img" value="'+contentImg+'">'+
			'<input type="text" class="builderInput choosenBlockContent" name="text" placeholder="Votre adresse" value="'+contentText+'">'+
			'<input type="hidden" name="id_block" value="3">';

			// BLOCK BOUTON LIEN
			block_bouton = '<input type="text" class="builderInput choosenBlockContent" name="text" placeholder="Titre du bouton" value="'+contentText+'">'+
			'<input type="text" class="builderInput choosenBlockContent" name="text1" placeholder="Votre lien" value="'+contentText1+'">'+
			'<input type="hidden" name="id_block" value="4">';

			// BLOCK IMAGE + TEXTE
			block_image_texte = '<label class="choosenBlockContent">Votre image : </label>'+
			'<input type="file" class="builderInputFile choosenBlockContent" name="img" value="'+contentImg+'">'+
			'<input type="hidden" name="id_block" value="5"><div class="summernote-wrapper"><textarea id="summernote" class="builderTextarea choosenBlockContent" name="text">Votre texte</textarea><input type="hidden" name="id_block" value="5"></div>';

			// BLOCK TITRE
			block_titre = '<input type="text" class="builderInput choosenBlockContent" name="text" placeholder="Votre titre" value="'+contentText+'">'+
			'<input type="hidden" name="id_block" value="6">';

			// BLOCK ESPACE
			block_espace = '<label class="choosenBlockContent">Ajouter un espace entre 2 blocs</label>'+
			'<input type="hidden" name="id_block" value="7">';

			$('.blockSelect').remove();

			addBlock = '<div class="page-container blockSelect fullHeight">'+
										'<div class="main-content">'+
											'<div class="row">'+
												'<div class="closeBlockSelect col-lg-12">'+
													'<i class="closeIcon pg-close"></i>'+
												'</div>'+
												'<form class="col-lg-8 choosenBlockContainer clearFloat center-block" action="<?=base_url();?>builder/update/<?=$id_newsletter?>.html" method="post" enctype="multipart/form-data">'+
													'<div class="col-xs-10 center-block choosenBlock clearFloat">'+
													'</div>'+
													'<div class="col-xs-10 choosenBlockFooter panel-footer center-block text-right">'+
														'<button type="submit" class="btn btn-success">AJOUTER</button>'+
													'</div>'+
												'</form>'+
											'</div>'+
										'</div>'+
									'</div>';

			$('.pace-done').append(addBlock);

			$('.closeIcon').click( function() {
				$('.blockSelect').remove();
			});

			blocktype = $(this).data('blocktype');

			if (blocktype == 1) {

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block_image);

			} else if (blocktype == 2) {

				$('.choosenBlock').css('min-height', '200px');
				$('.choosenBlock').append(block_texte);
				$('#summernote').summernote({
					toolbar: [
						// [groupName, [list of button]]
						['style', ['bold', 'italic', 'underline', 'clear']],
						['font', ['strikethrough', 'superscript', 'subscript']],
						['fontsize', ['fontsize']],
						['color', ['color']],
						['para', ['paragraph']],
					],
					height: 140,
				});

			} else if (blocktype == 3) {

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block_footer);

			} else if (blocktype == 4) {

				$('.choosenBlock').css('min-height', '100px');
				$('.choosenBlock').append(block_bouton);

			} else if (blocktype == 5) {

				$('.choosenBlock').css('min-height', '200px');
				$('.choosenBlock').append(block_image_texte);
				$('#summernote').summernote({
					toolbar: [
						// [groupName, [list of button]]
						['style', ['bold', 'italic', 'underline', 'clear']],
						['font', ['strikethrough', 'superscript', 'subscript']],
						['fontsize', ['fontsize']],
						['color', ['color']],
						['para', ['paragraph']],
					],
					height: 140,
				});

			} else if (blocktype == 6) {

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block_titre);

			} else if (blocktype == 7) {

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block_espace);

			} else if (blocktype == 8) {



			}

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
