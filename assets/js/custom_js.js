$(document).ready(function()
{

    /*
    $("#select_civility").select2({
        placeholder: 'Choisir la civilité...',
        allowClear: true
    }).on('select2-open', function()
    {
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });

    $("#select_business").select2({
        placeholder: 'Choisir une entreprises...',
        allowClear: true
    }).on('select2-open', function()
    {
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });

    $("#select_category").select2({
        placeholder: 'Choisir une catégorie...',
        allowClear: true
    }).on('select2-open', function()
    {
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });
    */

    $('#bt_submit').submit(function() {

      console.log ("ouou");
      var str = $("#form").serialize();
      console.log (str);



    });

    /*
    $(function() {
      $('#bt_submit').submit(function() {

        console.log ("ouou");
        var str = $("#form").serialize();
        console.log (str);

      //entreprise = $(this).find('select[name=entreprise]').val();
      //console.log(entreprise);
      /*$.post('/All_entreprises', {entreprise: entreprise}, function(data) {
        if (data!='ok') {
          $('.erreur').empty().append(data);
        } else {
          $('.erreur').empty().html('ok');
        }
      });
      return false;
      });
    });
    */

});
