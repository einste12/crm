
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

        $("[name='GelenTeklifTarihi']").focusout(function(){
            $("#evrakalmatarihi").html($(this).val());
        });
    });





  
