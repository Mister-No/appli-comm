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
				<div data-pages="portlet" class="panel panel-default" id="portlet-basic">
					<div class="panel-heading">
						<div class="panel-title">Votre newsletter <?=$nom_campagne?></div>
						<div class="panel-controls">
							<ul>
								<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
								class="portlet-icon portlet-icon-collapse"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="clearFloat noPadding border center-block col-lg-8 newsBuilder">
						<?=$newsletter?>
					</div>
					<div class="panel-footer text-right">
						<a href="/builder/campagne_listes/<?=$id_newsletter?>.html" class="btn btn-success">VALIDER</a>
					</div>
				</div>
			</div>
		</div>
	<script type="text/javascript">

		var id_block_html;
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

		/**$('.newsBuilder').mouseout(function(){
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
			$('.blockSelect').css('top', $(window).scrollTop());
			//$('body').css('overflow', 'hidden');

			$('.closeIcon').click( function() {
				//$('body').css('overflow', 'auto');
				$('.blockSelect').css('top', '0');
				$('.blockSelect').remove();
			});

			addblock();

		});

	}

	// Fonction d'affichage des éléments pour l'ajout d'un block

	function addblock() {

		$('.newBlock').click( function() {

			$('.blockSelect').remove();
			idBlockHtml = $(this).children('input[name="id_block_html"]').val();
			blockInput = $(this).children('.block_input').map(function(idx, elem) {
				var array1 = new Array();
				var array2 = new Array();
				array1 = [$(elem).val(), $(elem).data('col'), $(elem).data('label'), $(elem).data('crop')];
				array2[0] = array1;
				return array2;
		  }).get();
			i=0;
			t=0;

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

			for (var j = 0; j < blockInput.length; j++) {

				//Variables des différents blocks

				if (blockInput[j][0] == 1) {
					// BLOCK IMAGE
					block = '<div class="blockInputImage">'+
					'<label class="choosenBlockContent">'+blockInput[j][2]+' : </label>'+
					'<input id="image_mag'+i+'" type="hidden" name="img'+i+'" data-crop="'+blockInput[j][3]+'" />'+
					'</div>';
				}

				if (blockInput[j][0] == 2) {
					// BLOCK TEXTE WYZIWYG SUMMMERNOTE
					block = '<div class="blockInputSummernote">'+
					'<label class="choosenBlockContent">'+blockInput[j][2]+' : </label>'+
					'<div class="summernote-wrapper"><textarea class="builderTextarea choosenBlockContent summernote" name="text'+t+'"></textarea>'+
					'</div>';
				}

				if (blockInput[j][0] == 3) {
					// BLOCK TEXTE BASIQUE
					block = '<div class="blockInputTexte">'+
					'<label class="choosenBlockContent">'+blockInput[j][2]+' : </label>'+
					'<input class="builderInput choosenBlockContent" name="text'+t+'" placeholder="" value="">'+
					'</div>';
				}

				if (blockInput[j][0] == 4) {
					// BLOCK SELECT
				}

				//Affichage des blocks
				$('.choosenBlock').append(block);

				//Activation des plug in et incrementation des variables
				if (blockInput[j][0] == 1) {
					//Uploadcare
					$(function()
						{
							// Initialisation du widget
							var widget = uploadcare.Widget('#image_mag'+i+'');
							// Action après l'upload :
							widget.onUploadComplete(function(info) {
							console.log("File info!", info);
							$("#img_show").attr ("src", info.cdnUrl);
							$("#img_show").show();
						});

					});
					i++;
				}

				if (blockInput[j][0] == 2 || blockInput[j][0] == 3) {
					//Summernote
					$('.summernote').summernote({
						toolbar: [
							// [groupName, [list of button]]
							['style', ['bold', 'italic', 'underline', 'clear']],
							['font', ['strikethrough', 'superscript', 'subscript']],
							['fontsize', ['fontsize']],
							['color', ['color']],
							['para', ['paragraph']],
						],
						height: 60,
					});
					t++;
				}

			}

		});

	}

	// Fonction d'affichage des éléments pour l'update d'un block

	function editBlock() {

		$('.editBlock').unbind().click( function() {

			//block = $(this).parent().parent();
			idBlock = $(this).parent().parent().children('input[name="id_block"]').val();
			//idBlockHtml = $(this).parent().parent().children('input[name="id_block_html"]').val();
			idBlockContent = $(this).parent().parent().children('input[name="id_block_content"]').val();
			blockPlace = $(this).parent().parent().children('input[name="ordre"]').val();
			blockInput = $(this).children('.block_input').map(function(idx, elem) {
				var array1 = new Array();
				var array2 = new Array();
				array1 = [$(elem).val(), $(elem).data('col'), $(elem).data('label'), $(elem).data('crop')];
				array2[0] = array1;
				return array2;
		  }).get();
			i=0;
			t=0;

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
														'<input type="hidden" name="id_block_content" value="'+idBlockContent+'">'+
														'<input type="hidden" name="ordre" value="'+blockPlace+'">'+
														'<div class="col-xs-10 choosenBlockFooter panel-footer center-block text-right">'+
															'<button type="submit" class="btn btn-success">MODIFIER</button>'+
														'</div>'+
													'</form>'+
												'</div>'+
											'</div>'+
										'</div>';

				$('.pace-done').append(addBlock);
				$('.blockSelect').css('top', $(window).scrollTop());
				//$('body').css('overflow', 'hidden');

				$('.closeIcon').click( function() {
					//$('body').css('overflow', 'auto');
					$('.blockSelect').css('top', '0');
					$('.blockSelect').remove();
				});

				for (var j = 0; j < blockInput.length; j++) {

					//Variables des différents blocks

					if (blockInput[j][0] == 1) {
						// BLOCK IMAGE
						block = '<div class="blockInputImage">'+
						'<label class="choosenBlockContent">'+blockInput[j][2]+' : </label>'+
						'<input id="image_mag'+i+'" type="hidden" name="img'+i+'" data-crop="'+blockInput[j][3]+'" />'+
						'</div>';
					}

					if (blockInput[j][0] == 2) {
						// BLOCK TEXTE WYZIWYG SUMMMERNOTE
						block = '<div class="blockInputSummernote">'+
						'<label class="choosenBlockContent">'+blockInput[j][2]+' : </label>'+
						'<div class="summernote-wrapper"><textarea class="builderTextarea choosenBlockContent summernote" name="text'+t+'"></textarea>'+
						'</div>';
					}

					if (blockInput[j][0] == 3) {
						// BLOCK TEXTE BASIQUE
						block = '<div class="blockInputTexte">'+
						'<label class="choosenBlockContent">'+blockInput[j][2]+' : </label>'+
						'<input class="builderInput choosenBlockContent" name="text'+t+'" placeholder="" value="">'+
						'</div>';
					}

					if (blockInput[j][0] == 4) {
						// BLOCK SELECT
					}

					//Affichage des blocks
					$('.choosenBlock').append(block);

					//Activation des plug in et incrementation des variables
					if (blockInput[j][0] == 1) {
						//Uploadcare
						$(function()
							{
								// Initialisation du widget
								var widget = uploadcare.Widget('#image_mag'+i+'');
								// Action après l'upload :
								widget.onUploadComplete(function(info) {
								console.log("File info!", info);
								$("#img_show").attr ("src", info.cdnUrl);
								$("#img_show").show();
							});

						});
						i++;
					}

					if (blockInput[j][0] == 2 || blockInput[j][0] == 3) {
						//Summernote
						$('.summernote').summernote({
							toolbar: [
								// [groupName, [list of button]]
								['style', ['bold', 'italic', 'underline', 'clear']],
								['font', ['strikethrough', 'superscript', 'subscript']],
								['fontsize', ['fontsize']],
								['color', ['color']],
								['para', ['paragraph']],
							],
							height: 60,
						});
						t++;
					}

				}

		});

	}

	// Fonction de deplacement du block vers le haut

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

	// Fonction de deplacement du block vers le bas

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

	// Fonction de suppression du block

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
