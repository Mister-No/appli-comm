<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Shuttle</p>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/en_cours.html">Campagnes</a>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/informations/modification/<?=$id_newsletter?>.html">Informations</a>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes/newsletter/<?=$id_newsletter?>.html" class="active">Newsletter</a>
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
						<a href="/campagnes/informations/modification/<?=$id_newsletter?>.html" class="btn btn-complete">INFORMATIONS</a>
						<a href="/campagnes/preview/<?=$id_newsletter?>.html" class="btn btn-complete" target="_blank">PRÉVISUALISATION</a>
						<button type="button" class="btn btn-complete" onclick="bat_popin('<?=addslashes($id_newsletter)?>','<?=addslashes($nom_campagne)?>')">BAT</button>

						<?php if ($_SESSION['rang'] > 1): ?>

							<a href="/campagnes/listes/<?=$id_newsletter?>.html" class="btn btn-success">VALIDER</a>

						<?php endif; ?>

					</div>
				</div>
				<div class="modal fade" id="modal-delete">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Envoyer un mail test</h4>
							</div>
							<form action="<?=base_url();?>campagnes/bat/<?=$id_newsletter?>.html" method="POST">
								<input type="hidden" name="id" id="id">
								<div class="modal-body">
									<div class="form-group form-group-default">
										<label class="control-label">EMAIL :</label>
										<input type="text" class="form-control" name="email" placeholder="" required />
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-white" data-dismiss="modal">Fermer</button>
									<button type="submit" class="btn btn-info">ENVOYER</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<script type="text/javascript">

		//var id_block_html;
		//var blockPlace;

		$('.text_to_replace').each( function (){
			text_to_replace = $(this).html();
			console.log(text_to_replace);
			text_replaced = text_to_replace.replace(/#&§#&§/g, '"').replace(/#&amp;§#&amp;§/g, '"');
			console.log(text_replaced);
			$(this).html(text_replaced);
		});

		$('.newsBuilderBlock').hover(function(){

			$('.newsBuilderAddBlock').remove();
			$('.optionsBlock').remove();

			id = $(this).children('input[name="id"]').val();
			idBlockHtml = $(this).children('input[name="id_block_html"]').val();
			blockType = $(this).children('input[name="type"]').val();
			blockPlace = $(this).children('input[name="ordre"]').val();
			blockPlaceAfter = Number(blockPlace)+Number(1);
			upBlock = '';
			downBlock = '';
			eraseBlock = '';
			modBlock = '';
			block_before = '';
			block_after = '';
			options_block	=	'';

			if (blockType != 1) {

				// BLOCKS D'AJOUT

				if (blockPlace > 2) {

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

				}

				// OPTION DE DEPLACEMENT

				if (blockType != 1 && blockType != 3 && blockType != 6 && blockType != 8) {

					if ($('.blockPlace').index(this) > 0) {
						upBlock = '<button type="button" class="upBlock">'+
												'<i class="upIcon fa fa-arrow-up"></i>'+
											'</button>';
					}

					if ($('.blockPlace').index(this) < $('.blockPlace').length-Number(1)) {
						downBlock = '<button type="button" class="downBlock">'+
													'<i class="downIcon fa fa-arrow-down"></i>'+
												'</button>';
					}

				}

				// OPTION D'ÉDITION

				if (blockType != 1 && blockType != 5 && blockType != 7 && blockType != 8) {
					modBlock = '<button type="button" class="editBlock">'+
												'<i class="editIcon fa fa-edit"></i>'+
											'</button>';
				}

				// OPTION DE SUPPRESSION

				if (blockType != 1 && blockType != 4 && blockType != 6 && blockType != 7) {
					eraseBlock = '<button type="submit" class="deleteBlock">'+
													'<i class="deleteIcon pg-close"></i>'+
												'</button>';
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
												'<form class="col-lg-8 choosenBlockContainer clearFloat center-block" action="<?=base_url();?>campagnes/add_block/<?=$id_newsletter?>.html" method="post" enctype="multipart/form-data">'+
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

				/**if (blockInput[j][0] == 2) {
					// BLOCK TEXTE WYZIWYG SUMMMERNOTE
					block = '<div class="blockInputSummernote form-group">'+
										'<label class="control-label">'+blockInput[j][2]+' : </label>'+
										'<div class="summernote-wrapper">'+
											'<textarea class="builderTextarea choosenBlockContent summernote" name="text'+t+'"></textarea>'+
										'</div>'+
									'</div>';
				}**/

				if (blockInput[j][0] == 2) {
					// BLOCK TEXTAREA
					block = '<div class="blockInputTextarea form-group form-group-default">'+
										'<label class="control-label">'+blockInput[j][2]+' : </label>'+
											'<textarea class="form-control textarea" name="text'+t+'"></textarea>'+
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
					options = '';
					array_select = blockInput[j][4].split(',');
					// BLOCK SELECT
					div_select_open = '<div class="blockInputTexte form-group form-group-default-select2">'+
										'<label class="control-label">'+blockInput[j][2]+'</label>'+
										'<select class="full-width" data-placeholder="Choisir un thème" init-plugin="select2" name="select'+s+'">';
					for (var o = 0; o < array_select.length; o++) {
						options += '<option value="'+o+'">'+array_select[o]+'</option>';
					}
					div_select_closed =	'</select></div>';
					block = div_select_open+options+div_select_closed;
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
					/**$('.summernote').summernote({
						toolbar: [
							// [groupName, [list of button]]
							['style', ['bold', 'italic', 'underline']],
							//['font', ['strikethrough', 'superscript', 'subscript']],
							//['fontsize', ['fontsize']],
							//['color', ['color']],
							//['para', ['paragraph']],
						],
						height: 60,
					});**/
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
				array1 = [$(elem).val(), $(elem).data('col'), $(elem).data('label'), $(elem).data('crop'), $(elem).data('select'), $(elem).data('content')];
				array2[0] = array1;
				return array2;
		  }).get();
			i=0;
			t=0;
			s=0;

				$('.blockSelect').remove();

				addBlock = '<div class="page-container blockSelect">'+
											'<div class="main-content">'+
												'<div class="row">'+
													'<div class="closeBlockSelect col-lg-12">'+
														'<i class="closeIcon pg-close"></i>'+
													'</div>'+
													'<form class="col-lg-8 choosenBlockContainer clearFloat center-block" action="<?=base_url();?>campagnes/update_block/<?=$id_newsletter?>.html" method="post" enctype="multipart/form-data">'+
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
						block = '<div class="blockInputImage form-group">'+
						'<label class="control-label">'+blockInput[j][2]+' : </label>'+
						'<input id="image_mag'+i+'" type="hidden" name="img'+i+'" data-crop="'+blockInput[j][3]+'" />'+
						'</div>';
					}

					/**if (blockInput[j][0] == 2) {
						// BLOCK TEXTE WYZIWYG SUMMMERNOTE
						block = '<div class="blockInputSummernote form-group">'+
						'<label class="control-label">'+blockInput[j][2]+' : </label>'+
						'<div class="summernote-wrapper"><textarea class="builderTextarea choosenBlockContent summernote" name="text'+t+'">'+blockInput[j][5]+'</textarea>'+
						'</div>';
					}**/

					if (blockInput[j][0] == 2) {
						// BLOCK TEXTAREA
						block = '<div class="blockInputTextarea form-group form-group-default">'+
											'<label class="control-label">'+blockInput[j][2]+' : </label>'+
												'<textarea class="form-control textarea" name="text'+t+'">'+blockInput[j][5]+'</textarea>'+
										'</div>';
					}

					if (blockInput[j][0] == 3) {
						// BLOCK TEXTE BASIQUE
						block = '<div class="blockInputTexte form-group form-group-default">'+
						'<label class="control-label">'+blockInput[j][2]+' : </label>'+
						'<input class="form-control" name="text'+t+'" placeholder="" value="'+blockInput[j][5]+'">'+
						'</div>';
					}

					if (blockInput[j][0] == 4) {
						options = '';
						array_select = blockInput[j][4].split(',');
						// BLOCK SELECT
						div_select_open = '<div class="blockInputTexte form-group form-group-default-select2">'+
											'<label class="control-label">'+blockInput[j][2]+'</label>'+
											'<select class="full-width" data-placeholder="Choisir un thème" init-plugin="select2" name="select'+s+'">';
						for (var o = 0; o < array_select.length; o++) {
							if (blockInput[j][5] == o) {
								options += '<option value="'+o+'" selected="selected">'+array_select[o]+'</option>';
							} else {
								options += '<option value="'+o+'">'+array_select[o]+'</option>';
							}
						}
						div_select_closed =	'</select></div>';
						block = div_select_open+options+div_select_closed;
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
						/**$('.summernote').summernote({
							toolbar: [
								// [groupName, [list of button]]
								['style', ['bold', 'italic', 'underline']],
								//['font', ['strikethrough', 'superscript', 'subscript']],
								//['fontsize', ['fontsize']],
								//['color', ['color']],
								//['para', ['paragraph']],
							],
							height: 60,
						});**/
							$('input[name="text'+t+'"]').each( function (){
								text_to_replace = $(this).val();
								text_replaced = text_to_replace.replace(/#&§#&§/g, '"').replace(/#&amp;§#&amp;§/g, '"');
								$(this).val(text_replaced);
							});
							$('textarea').each( function (){
								text_to_replace = $(this).html();
								text_replaced = text_to_replace.replace(/&lt;br \/&gt;/gi, "\r").replace(/#&amp;§#&amp;§/g, '"').replace(/&lt;b&gt;/g, '**').replace(/&lt;\/b&gt;/g, '**');
								$(this).val(text_replaced);
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

	// Fonction de deplacement du block vers le haut

	function upMoveBlock() {

		$('.upBlock').unbind().click( function() {

			id_block = $(this).parent().parent().children('input[name="id_block"]').val();
			blockPlace = $(this).parent().parent().children('input[name="ordre"]').val();
			blockType = $(this).parent().parent().children('input[name="type"]').val();

			if (blockType != 1 && blockType != 3 && blockType != 6 && blockType != 8) {

				//if ($('.blockPlace').index(this) > 0) {

					$.post('<?=base_url();?>campagnes/block_move_up/<?=$id_newsletter?>.html', {'id_block': id_block, 'ordre': blockPlace}, function(data) {
						if (data=='ok') {
							window.location.href='<?=base_url();?>campagnes/newsletter/<?=$id_newsletter?>.html';
						}
					});

				//} else {

				//}

			}

		});
	}

	// Fonction de deplacement du block vers le bas

	function downMoveBlock() {

		$('.downBlock').unbind().click( function() {

			id_block = $(this).parent().parent().children('input[name="id_block"]').val();
			blockPlace = $(this).parent().parent().children('input[name="ordre"]').val();
			blockType = $(this).parent().parent().children('input[name="type"]').val();

			if (blockType != 1 && blockType != 3 && blockType != 6 && blockType != 8) {

				//if ($('.blockPlace').index(this) < $('.blockPlace').length-Number(1)) {

					$.post('<?=base_url();?>campagnes/block_move_down/<?=$id_newsletter?>.html', {'id_block': id_block, 'ordre': blockPlace}, function(data) {
						if (data=='ok') {
							window.location.href='<?=base_url();?>campagnes/newsletter/<?=$id_newsletter?>.html';
						}
					});

				//} else {

				//}

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
			blockType = $(this).parent().parent().children('input[name="type"]').val();

			if (blockType != 1 && blockType != 4 && blockType != 6 && blockType != 7) {

				$.post('<?=base_url();?>campagnes/delete_block/<?=$id_newsletter?>.html', {'id_block': id_block, 'id_block_content': id_block_content, 'ordre': blockPlace}, function(data) {

					if (data=='ok') {
						block.remove();
						$('.newsBuilderAddBlock').remove();
						window.location.href='<?=base_url();?>campagnes/newsletter/<?=$id_newsletter?>.html';
					}

				});

			} else {

			}

		});

	}

	function bat_popin (id, titre, id_parent)
	{
		$(".modal").find ("#id").val(id);
		if (id_parent != '') {
			$(".modal").find ("#id_parent").val(id_parent);
		}
		//$(".modal-body").empty().append (titre);
		$('#modal-delete').modal('show', {backdrop: 'fade'});
	}

	</script>
