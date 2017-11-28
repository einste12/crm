
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
        $("[name='KaynakDil[ ]']").change(function(){
            $("#kaynakdil").html("");

            $("[name='KaynakDil[ ]'] :selected").each(function(index,element){
                if(index == 0){
                    $("#kaynakdil").append($(this).text())
                }else{
                    $("#kaynakdil").append(","+$(this).text());
                }

            });

        });

         $("[name='HedefDil[ ]']").change(function(){
            $("#hedefdil").html("");

            $("[name='HedefDil[ ]'] :selected").each(function(index,element){
                if(index == 0){
                    $("#hedefdil").append($(this).text())
                }else{
                    $("#hedefdil").append(","+$(this).text());
                }

            });

        });

        $("[name='Fiyat']").focusout(function(){
            $("#fiyat").html($(this).val()+"â‚º");
        });


        $("[name='SurekliMusteri'").change(function(){
            if($(this).is(":checked")){
                $("#sureklimusteri").html("Evet");
            }else{
                $("#sureklimusteri").html("Hayır");
            }
        });

        $("[name='Kapora'").focusout(function(){
           $("#kaparo").html($(this).val()+"â‚º");
        });

        $("[name='TasdikSekli']").change(function(){
            $("#notertasdiki").html($("[name='TasdikSekli'] option:selected").text());
        });
        $("[name='temsilci']").change(function(){
            $("#temsilcionizleme").html($("[name='temsilci'] option:selected").text());
        });

        $("[name='temsilcinot'").focusout(function(){
           $("#not").html($(this).val());
        });

        $("[name='GelenTeklifTarihi']").focusout(function(){
            $("#evrakalmatarihi").html($(this).val());
        });
    });
