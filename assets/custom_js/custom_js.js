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

				console.log('connexion KO');
	      $('.erreur').html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button><strong>Probleme d\'identification</strong></div>');
	    }
	  });
	  return false;
	  });
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
