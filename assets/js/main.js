$(document).ready(function(){

  $('.card_delete').click(function(event){
    var card_delete_url = $(this).attr('href');
    $.get(card_delete_url, function(response){
      console.log(response);
      var card_id = card_delete_url.split('/').pop();
      if( $('#card-index-' + card_id) ) {
        $('#card-index-' + card_id).hide();
      }
    });
    event.preventDefault();
  });

  $( "#addPersonelAktivityForm" ).submit(function( event ) {
    // Stop form from submitting normally
    event.preventDefault();//buna bak
    // Get some values from elements on the page:
    var $form = $(this),
      personel = $form.find( "select[name='personel']" ).val(),
      activities_id = $form.find( "select[name='activities_id']" ).val(),
      tarih = $form.find( "input[name='tarih']" ).val(),
      saat = $form.find( "input[name='saat']" ).val(),
      url = $form.attr( "action");
    // Send the data using post
    $.post( url, { personel: personel ,activities_id:activities_id,tarih:tarih,saat:saat} );
    // Put the results in a div
    //alert("Lütfen sayfayı yenileyiniz");
      location.reload();
      //  $("#personel_activities > tbody").append("<tr> <td>tft</td><td>tft</td><td>tft</td></tr>")
  });

  $("#actvity_all").click(function(e) {
    $(".secim").prop('checked', $(this).prop("checked"));
  });

  $("#all_approve").click(function(e){
    var card_activity_approve = $(this).attr('href');
    $('input.secim:checked').each(function()
    {
      var id=($(this).val());//seçilenlerin degerlerini alma
      var url=card_activity_approve+id;
      $.get(url, function(response){
        console.log(response);
      });

    });
    location.reload();

  });
  




});//$(document).ready(function(){
