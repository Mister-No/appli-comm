$(document).ready(function()
{

/** Fonction pour fermer les pop up d'erreur **/

	$('.close').click(function() {
		$('.erreur, .success').css('display', 'none');
	});

/** Fonction pour la selection de toutes les checkbox **/

	$('.check_all').click(function() {
			$(this).parent().parent().parent().parent().parent().find(':checkbox').prop('checked', this.checked);
	});

});

/** Fonction pour la selection de categories ou d'entreprise en select **/

function select (item, id, urlSelect) {

	var base_url = 'http://localhost/appli-comm/common/' + urlSelect;

  $.post(base_url, function(data) {

    $(item).prop( 'disabled' , false );

    $(item).select2({
      data: data
    });

    $(item).val(id).trigger('change');

  });
}

/** Fonction d'affichaqge d'un message permettant l'affichage d'un message de confirmation de suppression **/

function delete_item (id, titre)
{
	$(".modal").find ("#id").val(id);
	$(".modal-body").empty().append (titre);
	$('#modal-delete').modal('show', {backdrop: 'fade'});
}

/** Fonction de verification d'existance de login, l'utilisateur ou du contact **/

function check_exist(urlCheck, urlRedirect, data) {

		base_url = 'http://localhost/appli-comm/'+ urlCheck;

		$.post(base_url, data, function(data) {

			if (data == 1) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Entité deja existante');

			} else if (data == 2) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Login ou mot de passe incorrect');

			} else if (data == 3) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Probleme de droits ou de connexion, votre action n\'a pu etre prise en compte');

			} else if (data == 4) {

				$('.erreur').css('display', 'block');
				$('.message').empty().html('Les mots de passe ne sont pas identiques');

			} else if (data == 5) {

				$('.success').css('display', 'block');
				$('.message').empty().html('Le mot de passe est reinitialisé');

			} else if (data == 6) {

				$('.success').css('display', 'block');
				$('.message').empty().html('Utilisateur inexistant');

			} else {

				window.location.href = 'http://localhost/appli-comm/'+ urlRedirect;

			}


		});

	}
