
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


$('#edit-modal7').on('show.bs.modal', function(e) {

    var $modal=$(this),
        Id5=e.relatedTarget.id;


         $(".modal-body #gelenteklifsil1").val( Id5 );

});

//FİYAT TEKLİFİ VER MODALA ID YOLLAMA
$('#edit-modal6').on('show.bs.modal', function(e) {

    var $modal = $(this),
        data = e.relatedTarget.id;

         $.ajax({
            url: 'idgonder/'+data,
            type: 'GET',
            dataType: "json",
            success:function(data) {
               
               
               $("#isimSoyisim").text(data.user.isimSoyisim);
               $("#isimSoyisim1").text(data.user.isimSoyisim);
               
            }
        });

});



//Onay bekleyen sil id yollama
$('#edit-modal8').on('show.bs.modal', function(e) {

    var $modal = $(this),
        Id2 = e.relatedTarget.id;

         $(".modal-body #onaybekleyensil").val( Id2 );

});

//Devam Sil
$('#edit-modal9').on('show.bs.modal', function(e) {

    var $modal = $(this),
        Id3 = e.relatedTarget.id;

         $(".modal-body #devamedensil").val( Id3 );

});


//TERCUMAN SİLME MODALI
$('#edit-modal10').on('show.bs.modal', function(e) {

    var $modal = $(this),
        Id4 = e.relatedTarget.id;

         $(".modal-body #tercumansil").val( Id4 );

});



    // İŞ EKLERKEN YANA YAZDIRMA KODU

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

             $("#evraksiz").removeClass("hidden");
             $("#evrakli").addClass("hidden");
             $("#tastiksekli").addClass("hidden");
             $("#teslimzamani1").addClass("hidden");
             $("#fiyat").addClass("hidden");

        }


          if(secilen==1)
        {

             $("#evrakli").removeClass("hidden");
             $("#evraksiz").addClass("hidden");
             $("#tastiksekli").removeClass("hidden");
             $("#teslimzamani1").removeClass("hidden");
             $("#fiyat").removeClass("hidden");


        }


              if(secilen=="")
        {

             $("#evraksiz").addClass("hidden");
             $("#evrakli").addClass("hidden");
             $("#tastiksekli").addClass("hidden");
             $("#teslimzamani1").addClass("hidden");
             $("#fiyat").addClass("hidden");
             $("#sube").addClass("hidden");

        }
  




});

//FİYAT TEFLİFİ VER TESLİM ZAMANINI GÖSTERME GİZLEME

$("select#teslimzamani").change(function(){

    var teslimzamani = $(this).val();
  
    $("#isgunu").removeClass("hidden");

    if (teslimzamani==''){
        $("#isgunu").addClass("hidden");
        $("#issaati").addClass("hidden");
    

    }else if(teslimzamani==1){


    $("#isgunu").removeClass("hidden");
    $("#issaati").addClass("hidden");
    
    



}else{

    $("#issaati").removeClass("hidden");
    $("#isgunu").addClass("hidden");

}

});




});


$(document).ready(function(){

    $('.selectpicker').selectpicker();



    });




// FİYAT TEKLİFİ VER TEXTBOX İÇERİĞİNİ ALMAK 
// EVRAKLI  DOSYA ALMAK
$(document).ready(function(){


var inputBox = document.getElementById('gun');

inputBox.onkeyup = function(){
    var test = document.getElementById('isgosterme').innerHTML = inputBox.value;

}

});



$(document).ready(function(){

var inputBox= document.getElementById('saat');


inputBox.onkeyup = function(){
    var test = document.getElementById('saatgosterme').innerHTML = inputBox.value;

}


});


//EVRAKSIZ DOSYA ALMAK

$(document).ready(function(){


var inputBox = document.getElementById('gun');

inputBox.onkeyup = function(){
    var test = document.getElementById('isgosterme1').innerHTML = inputBox.value;

}

});



$(document).ready(function(){

var inputBox= document.getElementById('saat');


inputBox.onkeyup = function(){
    var test = document.getElementById('saatgosterme1').innerHTML = inputBox.value;

}


});


$(document).ready(function(){

var inputBox= document.getElementById('evrakfiyati');


inputBox.onkeyup = function(){
    var test = document.getElementById('evraklifiyat').innerHTML = inputBox.value;

}


});



$(document).ready(function(){

var inputBox= document.getElementById('evraksiz').innerHTML;





console.log(inputBox);

}
);