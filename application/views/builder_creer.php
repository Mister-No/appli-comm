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

			$('.blockSelect').remove();

			idBlockHtml = $(this).children('input[name="id_block"]').val();
			blockInput = $(this).children('.block_input').map(function(idx, elem) {
		    return $(elem).val();
		  }).get();
			blockLabel = $(this).children('.block_label').map(function(idx, elem) {
		    return $(elem).val();
		  }).get();

			addBlock = '<div class="page-container blockSelect fullHeight">'+
										'<div class="main-content">'+
											'<div class="row">'+
												'<div class="closeBlockSelect col-lg-12">'+
													'<i class="closeIcon pg-close"></i>'+
												'</div>'+
												'<form class="col-lg-8 choosenBlockContainer clearFloat center-block" action="<?=base_url();?>builder/add_block/<?=$id_newsletter?>.html" method="post" enctype="multipart/form-data">'+
													'<div class="col-xs-10 center-block choosenBlock clearFloat">'+
													'</div>'+
													'<input type="hidden" name="id_block_html" value="'+idBlockHtml+'">'+
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

			for (var i = 0; i < blockInput.length; i++) {

				if (blockInput[i] == 1) {
					// BLOCK IMAGE
					block = '<label class="choosenBlockContent">'+blockLabel[i]+' : </label>'+
					'<input type="file" class="builderInputFile choosenBlockContent" name="img" value="">'+
					'<input type="hidden" name="img'+i+'" data-crop="" id="image_mag" />';
				}

				if (blockInput[i] == 2) {
					// BLOCK TEXTE WYZIWYG
					block = '<div class="summernote-wrapper"><textarea id="summernote" class="builderTextarea choosenBlockContent" name="text'+i+'">'+blockLabel[i]+'</textarea>';
				}

				if (blockInput[i] == 3) {
					// BLOCK TEXTE BASIQUE
					block = '<input type="text" class="builderInput choosenBlockContent" name="text'+i+'" placeholder="'+blockLabel[i]+'" value="">';
				}

				$('.choosenBlock').append(block);
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

			}

			/**if (blocktype == 1) {

				// BLOCK IMAGE
				block_image = '<label class="choosenBlockContent">Votre image : </label>'+
				'<input type="file" class="builderInputFile choosenBlockContent" name="img" value="">'+
				'<input type="hidden" name="id_block" value="1">'+
				'<input type="hidden" name="image" data-crop="" id="image_mag" />';

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block_image);

			} else if (blocktype == 2) {

				// BLOCK TEXTE
				block_texte = '<div class="summernote-wrapper"><textarea id="summernote" class="builderTextarea choosenBlockContent" name="text">Votre texte</textarea><input type="hidden" name="id_block" value="2"></div>';

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

				// BLOCK FOOTER LOGO + ADRESSE
				block_footer = '<label class="choosenBlockContent">Votre image : </label>'+
				'<input type="file" class="builderInputFile choosenBlockContent" name="img" value="">'+
				'<div class="summernote-wrapper"><textarea id="summernote" class="builderTextarea choosenBlockContent" name="text">Votre adresse</textarea>'+
				'<input type="hidden" name="id_block" value="3">';

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block_footer);
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

			} else if (blocktype == 4) {

				// BLOCK BOUTON LIEN
				block_bouton = '<input type="text" class="builderInput choosenBlockContent" name="text" placeholder="Titre du bouton" value="">'+
				'<input type="text" class="builderInput choosenBlockContent" name="text1" placeholder="Votre lien" value="">'+
				'<input type="hidden" name="id_block" value="4">';


				$('.choosenBlock').css('min-height', '100px');
				$('.choosenBlock').append(block_bouton);

			} else if (blocktype == 5) {

				// BLOCK IMAGE + TEXTE
				block_image_texte = '<label class="choosenBlockContent">Votre image : </label>'+
				'<input type="file" class="builderInputFile choosenBlockContent" name="img" value="">'+
				'<input type="hidden" name="id_block" value="5"><div class="summernote-wrapper"><textarea id="summernote" class="builderTextarea choosenBlockContent" name="text">Votre texte</textarea><input type="hidden" name="id_block" value="5"></div>'+
				'<input type="hidden" name="image" data-crop="" id="image_mag" />';

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

				// BLOCK TITRE
				block_titre = '<input type="text" class="builderInput choosenBlockContent" name="text" placeholder="Votre titre" value="">'+
				'<input type="hidden" name="id_block" value="6">';

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block_titre);

			} else if (blocktype == 7) {

				// BLOCK ESPACE
				block_espace = '<label class="choosenBlockContent">Ajouter un espace entre 2 blocs</label>'+
				'<input type="hidden" name="id_block" value="7">';

				$('.choosenBlock').css('min-height', '40px');
				$('.choosenBlock').append(block_espace);

			} else if (blocktype == 8) {



			}**/

		});

	}


	function editBlock() {

		$('.editBlock').unbind().click( function() {

			//block = $(this).parent().parent();
			idBlock = $(this).parent().parent().children('input[name="id_block"]').val();
			//idBlockHtml = $(this).parent().parent().children('input[name="id_block_html"]').val();
			idBlockContent = $(this).parent().parent().children('input[name="id_block_content"]').val();
			blockPlace = $(this).parent().parent().children('input[name="ordre"]').val();
			blockInput = $(this).parent().parent().children('.block_input').map(function(idx, elem) {
				return $(elem).val();
			}).get();
			blockLabel = $(this).parent().parent().children('.block_label').map(function(idx, elem) {
				return $(elem).val();
			}).get();
			blockContent = $(this).parent().parent().children('.block_content').map(function(idx, elem) {
				return $(elem).val();
			}).get();

			/**$.post('<?=base_url();?>builder/get_block_content/<?=$id_newsletter?>.html', {'id_block_content': idBlockContent}, function(data) {

				if (data.img_link1 != null) {
					contentImg1 = data.img_link1;
				} else {
					contentImg1 = '';
				}
				if (data.text1 != null) {
					contentText1 = data.text1;
				} else {
					contentText1 = '';
				}
				if (data.text2 != null) {
					contentText2 = data.text2;
				} else {
					contentText2 = '';
				}**/

				$('.blockSelect').remove();

				addBlock = '<div class="page-container blockSelect fullHeight">'+
											'<div class="main-content">'+
												'<div class="row">'+
													'<div class="closeBlockSelect col-lg-12">'+
														'<i class="closeIcon pg-close"></i>'+
													'</div>'+
													'<form class="col-lg-8 choosenBlockContainer clearFloat center-block" action="<?=base_url();?>builder/update_block/<?=$id_newsletter?>.html" method="post" enctype="multipart/form-data">'+
														'<div class="col-xs-10 center-block choosenBlock clearFloat">'+
														'</div>'+
														'<input type="hidden" name="ordre" value="'+blockPlace+'">'+
														'<div class="col-xs-10 choosenBlockFooter panel-footer center-block text-right">'+
															'<button type="submit" class="btn btn-success">MODIFIER</button>'+
														'</div>'+
													'</form>'+
												'</div>'+
											'</div>'+
										'</div>';

				$('.pace-done').append(addBlock);

				$('.closeIcon').click( function() {
					$('.blockSelect').remove();
				});

				for (var i = 0; i < blockInput.length; i++) {

					if (blockInput[i] == 1) {
						// BLOCK IMAGE
						block = '<label class="choosenBlockContent">'+blockLabel[i]+' : </label>'+
						'<input type="file" class="builderInputFile choosenBlockContent" name="img" value="'+blockContent[i]+'">'+
						'<input type="hidden" name="img'+i+'" data-crop="" id="image_mag" />';
					}

					if (blockInput[i] == 2) {
						// BLOCK TEXTE WYZIWYG
						block = '<div class="summernote-wrapper"><textarea id="summernote" class="builderTextarea choosenBlockContent" name="text'+i+'">'+blockContent[i]+'</textarea>';
					}

					if (blockInput[i] == 3) {
						// BLOCK TEXTE BASIQUE
						block = '<input type="text" class="builderInput choosenBlockContent" name="text'+i+'" placeholder="'+blockLabel[i]+'" value="'+blockContent[i]+'">';
					}

					$('.choosenBlock').append(block);
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

				}

				/**if (id_block_html == 1) {

					// BLOCK IMAGE
					block_image = '<label class="choosenBlockContent">Votre image : </label>'+
					'<input type="file" class="builderInputFile choosenBlockContent" name="img" value="'+contentImg+'">'+
					'<input type="hidden" name="id_block" value="1">';

					$('.choosenBlock').css('min-height', '40px');
					$('.choosenBlock').append(block_image);

				} else if (id_block_html == 2) {

					// BLOCK TEXTE
					block_texte = '<div class="summernote-wrapper"><textarea id="summernote" class="builderTextarea choosenBlockContent" name="text">'+contentText+'</textarea><input type="hidden" name="id_block" value="2"></div>';

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

				} else if (id_block_html == 3) {

					// BLOCK FOOTER LOGO + ADRESSE
					block_footer = '<label class="choosenBlockContent">Votre image : </label>'+
					'<input type="file" class="builderInputFile choosenBlockContent" name="img" value="'+contentImg+'">'+
					'<div class="summernote-wrapper"><textarea id="summernote" class="builderTextarea choosenBlockContent" name="text">'+contentText+'</textarea>'+
					'<input type="hidden" name="id_block" value="3">';

					$('.choosenBlock').css('min-height', '40px');
					$('.choosenBlock').append(block_footer);
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

				} else if (id_block_html == 4) {

					// BLOCK BOUTON LIEN
					block_bouton = '<input type="text" class="builderInput choosenBlockContent" name="text" placeholder="Titre du bouton" value="'+contentText+'">'+
					'<input type="text" class="builderInput choosenBlockContent" name="text1" placeholder="Votre lien" value="'+contentText1+'">'+
					'<input type="hidden" name="id_block" value="4">';

					$('.choosenBlock').css('min-height', '100px');
					$('.choosenBlock').append(block_bouton);

				} else if (id_block_html == 5) {

					// BLOCK IMAGE + TEXTE
					block_image_texte = '<label class="choosenBlockContent">Votre image : </label>'+
					'<input type="file" class="builderInputFile choosenBlockContent" name="img" value="'+contentImg+'">'+
					'<input type="hidden" name="id_block" value="5"><div class="summernote-wrapper"><textarea id="summernote" class="builderTextarea choosenBlockContent" name="text">'+contentText+'</textarea><input type="hidden" name="id_block" value="5"></div>';

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

				} else if (id_block_html == 6) {

					// BLOCK TITRE
					block_titre = '<input type="text" class="builderInput choosenBlockContent" name="text" placeholder="Votre titre" value="'+contentText+'">'+
					'<input type="hidden" name="id_block" value="6">';

					$('.choosenBlock').css('min-height', '40px');
					$('.choosenBlock').append(block_titre);

				} else if (id_block_html == 7) {

					// BLOCK ESPACE
					block_espace = '<label class="choosenBlockContent">Ajouter un espace entre 2 blocs</label>'+
					'<input type="hidden" name="id_block" value="7">';

					$('.choosenBlock').css('min-height', '40px');
					$('.choosenBlock').append(block_espace);

				}**/

			//}, 'json');

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
