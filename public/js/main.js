
        $('#edit-modal').on('show.bs.modal', function(e) {

            var $modal = $(this),
                esseyId = e.relatedTarget.id;

                 $(".modal-body #bookId").val( esseyId );


});

$('#edit-modal2').on('show.bs.modal', function(e) {

    var $modal = $(this),
        esseyId = e.relatedTarget.id;

         $(".modal-body #devamedenid").val( esseyId );


});



$('#edit-modal4').on('show.bs.modal', function(e) {

    var $modal = $(this),
        esseyId = e.relatedTarget.id;

         $(".modal-body #basvuruonay").val( esseyId );


});


$('#edit-modal5').on('show.bs.modal', function(e) {

    var $modal = $(this),
        esseyId = e.relatedTarget.id;

         $(".modal-body #lksonay").val( esseyId );


});


$('#edit-modal6').on('show.bs.modal', function(e) {

    var $modal = $(this),
        esseyId = e.relatedTarget.id;

         $(".modal-body #teliffiyat").val( esseyId );


});






    $(document).ready(function(){
        $("[name='isimSoyisim']").focusout(function(){
            $("#madi").html($(this).val());
        });

        $("[name='Telefon']").focusout(function(){
            $("#tel").html($(this).val());
        });

        $("[name='Email']").focusout(function(){
            $("#mail").html($(this).val());
        });

        $("[name='KaynakDil']").focusout(function(){
            $("#kaynakdil").html($(this).val());
        });

        $("[name='HedefDil']").focusout(function(){
            $("#hedefdil").html($(this).val());
        });

        $("[name='TeklifVerenTemsilci']").focusout(function(){
            $("#temsilcionizleme").html($(this).val());
        });

        $("[name='TastikSekli']").focusout(function(){
            $("#tastiksekli").html($(this).val());
        });


        $("[name='Fiyat']").focusout(function(){
            $("#fiyat").html($(this).val()+"TL");
        });



        $("[name='Kapora'").focusout(function(){
           $("#kaparo").html($(this).val()+"TL");
        });



        $("[name='temsilcinot'").focusout(function(){
           $("#not").html($(this).val());
        });

        $("[name='SubeID'").focusout(function(){
           $("#subeid").html($(this).val());
        });

        $("[name='GelenTeklifTarihi']").focusout(function(){
            $("#evrakalmatarihi").html($(this).val());
        });
    });





  // TEKLİFE FİYAT VERME KODLARI
$(document).ready(function(){

    $("#evraktipi").change(function(){

        var secilen = $(this).val();

        if(secilen==2)
        {

             $("#not1").removeClass("hidden");
              $("#tastiksekli").addClass("hidden");
             $("#teslimzamani").addClass("hidden");
             $("#fiyat").addClass("hidden");

        }


          if(secilen==1)
        {

             $("#not1").removeClass("hidden");
             $("#tastiksekli").removeClass("hidden");
             $("#teslimzamani").removeClass("hidden");
             $("#fiyat").removeClass("hidden");


        }


              if(secilen=="")
        {

             $("#not1").addClass("hidden");
             $("#tastiksekli").addClass("hidden");
             $("#teslimzamani").addClass("hidden");
             $("#fiyat").addClass("hidden");
             $("#sube").addClass("hidden");

        }
  




});



$("select#teslimzamani").change(function(){

    var teslimzamani = $(this).val();
  
    $("#isgunu").removeClass("hidden");
    if (teslimzamani=='') {
        $("#isgunu").addClass("hidden");
    

    } else {

    $("#isgunu").removeClass("hidden");

}

});




});