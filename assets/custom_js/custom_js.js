$(document).ready(function()
{

/** Fonction pour fermer les pop up **/

	$('.close, .cancel').click(function() {
		$('.erreur, .success, .edit_cat, .add_cat').css('display', 'none');
	});

/** Fonction pour la selection de toutes les checkbox **/

	$('.check_all').click(function() {
			$(this).parent().parent().parent().parent().parent().find(':checkbox').prop('checked', this.checked);
	});

	$('.check_list').click( function() {
		$(this).parent().find('input[name="id_sib[]"]').attr('disabled', function(_, attr){ return !attr});
	});

});

/** Fonction pour la selection de categories ou d'entreprise en select **/

function select (item, id, urlSelect) {

	//var base_url = 'http://localhost/appli-comm/common/' + urlSelect;

  $.post(urlSelect, function(data) {

    $(item).prop( 'disabled' , false );

    $(item).select2({
      data: data
    });

    $(item).val(id).trigger('change');

  });
}

/** Fonction d'affichaqge d'un message permettant l'affichage d'un message de confirmation de suppression **/

function popin (id, titre, id_parent)
{
	$(".modal").find ("#id").val(id);
	if (id_parent != '') {
		$(".modal").find ("#id_parent").val(id_parent);
	}
	$(".modal-body").empty().append (titre);
	$('#modal-delete').modal('show', {backdrop: 'fade'});
}

/** Fonction pour la modification des titres de catégories **/

function edit_cat(id, id_parent) {

		$('.edit_cat').hide();

		$('#cat_id'+id).css('display', 'block');

		var urlSelect = 'select_all_parent_cat';

		select ('.select_category', id_parent, urlSelect);

}

/** Fonction pour l'ajout d'une sous-catégories **/

function add_cat(id) {

		$('.add_cat').hide();

		$('#cat_id_parent'+id).css('display', 'block');

}

/** Fonction de verification d'existance de login, l'utilisateur ou du contact **/

function check_exist(urlCheck, urlRedirect, data) {

		$.post(urlCheck, data, function(data) {

			if (data == 1) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Element deja existant ou non valide.');

			} else if (data == 2) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Login ou mot de passe incorrect.');

			} else if (data == 3) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Probleme de droits ou de connexion, votre action n\'a pu etre prise en compte.');

			} else if (data == 4) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Les mots de passe ne sont pas identiques.');

			} else if (data == 5) {

				$('.success').css('display', 'block');
				$('.message').empty().html('Le mot de passe est reinitialisé.');

			} else if (data == 6) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Utilisateur inexistant.');

			} else if (data == 7) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Un nouveau mot de passe vous à été envoyé par mail.');

			} else if (data == 8) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Merci de remplir les champs obligatoire.');

			} else if (data == 9) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Merci de selectionner une ou des catégories avec contacts.');

			} else if (data == 10) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Envoi impossible.');

			} else if (data == 11) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Probleme de transimission des données, merci de réessayer ultérieurement.');

			} else if (data == 12) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Aucun contact dans la ou les catégories sélectionnée(s).');

			} else if (data == 13) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Vous avez atteint votre quota de listes.');

			} else if (data == 14) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Impossible d\'identifier votre campagne.');

			}  else if (data == 15) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Impossible d\'identifier votre liste.');

			}  else if (data == 16) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Aucun contact dans votre liste.');

			}  else if (data == 17) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Impossible de dupiquer cette campagne.');

			} else {

				window.location.href = urlRedirect;

			}


		});

	}
