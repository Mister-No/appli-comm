$(document).ready(function()
{

/** Fonction de login **/

	$(function() {
	  $('#form-login').submit(function() {
	  username = $(this).find('input[name=username]').val();
	  password = $(this).find('input[name=password]').val();

	  $.post('http://localhost/appli-comm/login/verifier.html', {username: username, password: password}, function(data) {

	    if (data==1) {

	      window.location.href = 'dashboard.html';

	    } else {

				$('.erreur').css('display', 'block');
				$('.retour').empty().html('Login ou mot de passe incorrecte');
	    }
	  });
	  return false;
	  });
	});


/** Fonction de verification d'existance de l'utilisateur ou du contact **/

$(function() {

		$('#form').submit(function() {

		nom = $(this).find('input[name=nom]').val();
		login = $(this).find('input[name=login]').val();
		email = $(this).find('input[name=email]').val();

		$.post('http://localhost/appli-comm/users/add.html', {nom: nom, email: email, login: login}, function(data) {

			if (data == 1) {

				$('.erreur').css('display', 'block');
				$('.retour').empty().html('Cette personne existe deja');

			} else if (data == 2) {

				$('.erreur').css('display', 'block');
				$('.retour').empty().html('Probleme de droits ou de connexion, votre action n\'a pu etre prise en compte');

			} else {

				window.location.href = 'http://localhost/appli-comm/users.html';

			}

		});
		return false;
		});

	});

/** Fonction pour fermer les pop up d'erreur **/

	$('.close').click(function() {
		$('.erreur').css('display', 'none');
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
