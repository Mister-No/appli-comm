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
					<a href="<?=base_url();?>builder/campagne_informations/modification/<?=$id_newsletter?>.html">Informations</a>
				</li>
				<li>
					<a href="<?=base_url();?>builder/campagne/newsletter/<?=$id_newsletter?>.html" class="active">Newsletter</a>
				</li>
				<li>
					<a href="<?=base_url();?>builder/campagne/validation/<?=$id_newsletter?>.html">Validation newsletter</a>
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
					<div class="body clearFloat noPadding border center-block col-lg-8 newsBuilder">
						<?=$newsletter?>
					</div>
					<div class="panel-footer text-right">
						<a href="/builder/campagne/validation/<?=$id_newsletter?>.html" class="btn btn-success">VALIDER</a>
					</div>
				</div>
			</div>
		</div>
	<script type="text/javascript">

		//var id_block_html;
		//var blockPlace;

		$('.newsBuilderBlock').hover(function(){

			$('.newsBuilderAddBlock').remove();
			$('.optionsBlock').remove();

			id = $(this).children('input[name="id"]').val();
			idBlockHtml = $(this).children('input[name="id_block_html"]').val();
			blockType = $(this).children('input[name="type"]').val();
			blockPlace = $(this).children('input[name="ordre"]').val();
			blockPlaceAfter = Number(blockPlace)+Number(1);

			if (blockType != 1) {

				// BLOCKS D'AJOUT

				block_before = '<div id="before" class="newsBuilderAddBlock">'+
												'<div class="addBlock center-block">'+
													'<input type="hidden" name="blockplace" value="'+blockPlace+'">'+
													'<i class="addIcon pg-plus"></i>'+
												'</div>'+
											'</div>';

				block_after = '<div id="after" class="newsBuilderAddBlock">'+
												'<div class="addBlock center-block">'+
													'<input type="hidden" name="blockplace" value="'+blockPlaceAfter+'">'+
													'<i class="addIcon pg-plus"></i>'+
												'</div>'+
											'</div>';

				// OPTION DE DEPLACEMENT

				if (blockType != 1 && blockType != 3 && blockType != 6 && blockType != 8) {

					if ($('.blockPlace').index(this) > 0) {
						upBlock = '<button type="button" class="upBlock">'+
												'<i class="upIcon fa fa-arrow-up"></i>'+
											'</button>';
					} else {
						upBlock = '';
					}

					if ($('.blockPlace').index(this) < $('.blockPlace').length-Number(1)) {
						downBlock = '<button type="button" class="downBlock">'+
													'<i class="downIcon fa fa-arrow-down"></i>'+
												'</button>';
					} else {
						downBlock = '';
					}

				}

				// OPTION D'ÉDITION

				if (blockType != 1 && blockType != 5 && blockType != 7 && blockType != 8) {
					modBlock = '<button type="button" class="editBlock">'+
												'<i class="editIcon fa fa-edit"></i>'+
											'</button>';
				} else {
					modBlock = '';
				}

				// OPTION DE SUPPRESSION

				if (blockType != 1 && blockType != 4 && blockType != 6 && blockType != 7) {
					eraseBlock = '<button type="submit" class="deleteBlock">'+
													'<i class="deleteIcon pg-close"></i>'+
												'</button>';
				} else {
					eraseBlock = '';
				}

				// BLOCK D'OPTIONS

				options_block	=	'<div class="optionsBlock">'+
												upBlock+
												eraseBlock+
												modBlock+
												downBlock+
											'</div>';

				$(this).append(options_block);
				$(this).before(block_before);
				$(this).after(block_after);

				chooseblock();
				upMoveBlock();
				downMoveBlock();
				editBlock();
				deleteBlock();

			}

		});

		/**$('.newsBuilder').mouseout(function(){
			console.log('out');
			$('.newsBuilderAddBlock').remove();
		});**/

	function chooseblock() {

		$('.newsBuilderAddBlock').click( function() {

			$('.blockSelect').remove();

			blockPlace = $(this).children().children('input[name="blockplace"]').val();

			chooseBlock = '<div class="page-container blockSelect">'+
											'<div class="main-content">'+
												'<div class="row">'+
													'<div class="closeBlockSelect col-lg-12">'+
														'<i class="closeIcon pg-close"></i>'+
													'</div>'+
													'<div class="col-lg-8 newsBlocks clearFloat center-block">'+
														'<input type="hidden" name="blockplace" value="'+blockPlace+'">'+
														'<?=$builder_block_html?>'+
													'</div>'+
												'</div>'+
											'</div>'+
										'</div>';

			$('.pace-done').append(chooseBlock);
			$('.blockSelect').css('top', $(window).scrollTop());
			$('body').css('overflow', 'hidden');

			$('.closeIcon').click( function() {
				$('body').css('overflow', 'auto');
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
			blockName = $(this).children('input[name="nom"]').val();
			blockPlace = $(this).parent().children('input[name="blockplace"]').val();
			blockInput = $(this).children('.block_input').map(function(idx, elem) {
				var array1 = new Array();
				var array2 = new Array();
				array1 = [$(elem).val(), $(elem).data('col'), $(elem).data('label'), $(elem).data('crop'), $(elem).data('select')];
				array2[0] = array1;
				return array2;
		  }).get();
			i=0;
			t=0;
			s=0;

			addBlock = '<div class="page-container blockSelect">'+
										'<div class="main-content">'+
											'<div class="row">'+
												'<div class="closeBlockSelect col-lg-12">'+
													'<i class="closeIcon pg-close"></i>'+
												'</div>'+
												'<form class="col-lg-8 choosenBlockContainer clearFloat center-block" action="<?=base_url();?>builder/add_block/<?=$id_newsletter?>.html" method="post" enctype="multipart/form-data">'+
													'<div class="col-xs-10 center-block choosenBlock clearFloat">'+
													'<h4 class="col-xs-10"><strong>Ajouter un bloc</strong> '+blockName+'</h4>'+
													'</div>'+
													'<input type="hidden" name="id_block_html" value="'+idBlockHtml+'">'+
													'<input type="hidden" name="ordre" value="'+blockPlace+'">'+
													'<div class="col-xs-10 choosenBlockFooter panel-footer center-block text-right">'+
														'<button id="return" type="button" class="btn btn-complete">RETOUR</button>'+
														'<button type="submit" class="btn btn-success">AJOUTER</button>'+
													'</div>'+
												'</form>'+
											'</div>'+
										'</div>'+
									'</div>';

			$('.pace-done').append(addBlock);
			$('.blockSelect').css('top', $(window).scrollTop());
			$('body').css('overflow', 'hidden');

			$('#return').click( function() {
				$('.newsBuilderAddBlock').click();
			});

			$('.closeIcon').click( function() {
				$('.blockSelect').remove();
				$('.blockSelect').css('top', '0');
				$('body').css('overflow', 'auto');
			});

			for (var j = 0; j < blockInput.length; j++) {

				//Variables des différents blocks

				if (blockInput[j][0] == 1) {
					// BLOCK IMAGE
					block = '<div class="blockInputImage form-group">'+
					'<label class="control-label">'+blockInput[j][2]+' : </label>'+
					'<input id="image_mag'+i+'" type="hidden" name="img'+i+'" data-crop="'+blockInput[j][3]+'" />'+
					'</div>';
				}

				if (blockInput[j][0] == 2) {
					// BLOCK TEXTE WYZIWYG SUMMMERNOTE
					block = '<div class="blockInputSummernote form-group">'+
					'<label class="control-label">'+blockInput[j][2]+' : </label>'+
					'<div class="summernote-wrapper"><textarea class="builderTextarea choosenBlockContent summernote" name="text'+t+'"></textarea>'+
					'</div>';
				}

				if (blockInput[j][0] == 3) {
					// BLOCK TEXTE BASIQUE
					block = '<div class="blockInputTexte form-group form-group-default">'+
					'<label class="control-label">'+blockInput[j][2]+' : </label>'+
					'<input class="form-control" name="text'+t+'" placeholder="" value="">'+
					'</div>';
				}

				if (blockInput[j][0] == 4) {
					array_select = blockInput[j][4].split(',');
					for (var z = 0; z < array_select.length; z++) {
						console.log(array_select[z]);
					}

					// BLOCK SELECT
					block = '<div class="blockInputTexte form-group form-group-default-select2">'+
										'<label class="control-label">'+blockInput[j][2]+'</label>'+
										'<select class="full-width" data-placeholder="Choisir un thème" init-plugin="select2" name="select'+j+'">'+
											'<option value="1">test 1</option>'+
											'<option value="2">test 2</option>'+
										'</select>'+
									'</div>';
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
							['style', ['bold', 'italic', 'underline']],
							/**['font', ['strikethrough', 'superscript', 'subscript']],
							['fontsize', ['fontsize']],
							['color', ['color']],
							['para', ['paragraph']],**/
						],
						height: 60,
					});
					t++;
				}

				if (blockInput[j][0] == 4) {
					//Select 2

					s++;
				}

			}

		});

	}

	// Fonction d'affichage des éléments pour l'update d'un block

	function editBlock() {

		$('.editBlock').unbind().click( function() {

			idBlock = $(this).parent().parent().children('input[name="id_block"]').val();
			blockName = $(this).parent().parent().children('input[name="nom"]').val();
			idBlockContent = $(this).parent().parent().children('input[name="id_block_content"]').val();
			blockPlace = $(this).parent().parent().children('input[name="ordre"]').val();
			blockInput = $(this).parent().parent().children('.block_input').map(function(idx, elem) {
				var array1 = new Array();
				var array2 = new Array();
				array1 = [$(elem).val(), $(elem).data('col'), $(elem).data('label'), $(elem).data('crop'), $(elem).data('content')];
				array2[0] = array1;
				return array2;
		  }).get();
			i=0;
			t=0;

				$('.blockSelect').remove();

				addBlock = '<div class="page-container blockSelect">'+
											'<div class="main-content">'+
												'<div class="row">'+
													'<div class="closeBlockSelect col-lg-12">'+
														'<i class="closeIcon pg-close"></i>'+
													'</div>'+
													'<form class="col-lg-8 choosenBlockContainer clearFloat center-block" action="<?=base_url();?>builder/update_block/<?=$id_newsletter?>.html" method="post" enctype="multipart/form-data">'+
														'<div class="col-xs-10 center-block choosenBlock clearFloat">'+
														'<h4 class="col-xs-10"><strong>Modifier le bloc</strong> '+blockName+'</h4>'+
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
				$('body').css('overflow', 'hidden');

				$('.closeIcon').click( function() {
					$('.blockSelect').remove();
					$('body').css('overflow', 'auto');
					$('.blockSelect').css('top', '0');
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
						'<div class="summernote-wrapper"><textarea class="builderTextarea choosenBlockContent summernote" name="text'+t+'">'+blockInput[j][4]+'</textarea>'+
						'</div>';
					}

					if (blockInput[j][0] == 3) {
						// BLOCK TEXTE BASIQUE
						block = '<div class="blockInputTexte">'+
						'<label class="choosenBlockContent">'+blockInput[j][2]+' : </label>'+
						'<input class="builderInput choosenBlockContent" name="text'+t+'" placeholder="" value="'+blockInput[j][4]+'">'+
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
								['style', ['bold', 'italic', 'underline']],
								/**['font', ['strikethrough', 'superscript', 'subscript']],
								['fontsize', ['fontsize']],
								['color', ['color']],
								['para', ['paragraph']],**/
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

			if (blockPlace > 3 && blockPlace < $('.block').length-Number(2)) {
				$.post('<?=base_url();?>builder/block_move_up/<?=$id_newsletter?>.html', {'id_block': id_block, 'ordre': blockPlace}, function(data) {
					if (data=='ok') {
						window.location.href='<?=base_url();?>builder/campagne/newsletter/<?=$id_newsletter?>.html';
					}
				});
			}
		});
	}

	// Fonction de deplacement du block vers le bas

	function downMoveBlock() {

		$('.downBlock').unbind().click( function() {

			id_block = $(this).parent().parent().children('input[name="id_block"]').val();
			blockPlace = $(this).parent().parent().children('input[name="ordre"]').val();

			if (blockPlace > 2 && blockPlace < $('.block').length-Number(3)) {
				$.post('<?=base_url();?>builder/block_move_down/<?=$id_newsletter?>.html', {'id_block': id_block, 'ordre': blockPlace}, function(data) {
					if (data=='ok') {
						window.location.href='<?=base_url();?>builder/campagne/newsletter/<?=$id_newsletter?>.html';
					}
				});
			}
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
					window.location.href='<?=base_url();?>builder/campagne/newsletter/<?=$id_newsletter?>.html';
				}

			});

		});

	}

	</script>
