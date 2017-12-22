<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teklifler;
use Session;
use Toastr;
use DB;
use App\AdliyeTakipCetveli;
use Carbon\Carbon;
use App\TercumanIsTakip;
use App\Tercumandilbilgileri;
use App\Temsilciler;
use App\TercumanVeritabani;
use Auth;
use App\Subeler;
use App\User; 
use Alert;
use DateTime;
use Mail;

class DashBoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {



      $gelenteklif = Teklifler::where(function ($query) {
          $query->where([
             'silindi'     =>0,
             'OnayDurumu' =>0,
          ])->whereYear('TeklifVerilenTarih','>','2017-12-31');

      })->orderBy('TeklifVerilenTarih','DESC')->get();





        return view('dashboard',['teklif'=>$gelenteklif]);
    }





    public function onaybekleyen()
    {
      $onaybekleyen =Teklifler::where(function ($query) {

          $query->where([
             'silindi'     =>0,
             'OnayDurumu' =>1,
          ])->whereYear('TeklifVerilenTarih','>','2017-12-31');

      })->orderBy('TeklifVerilenTarih','DESC')->get();
        
      
        return view('admin.pages.onaybekleyen',['onaybekleyen'=>$onaybekleyen]);
    }










    public function onaygidenmail($id){
      
      $mail=Teklifler::find($id);
      return view('admin.pages.onaygidenmail',['maildetay'=>$mail]);

    }



//DEVAM EDEN TEKLİFLER//


    public function devameden()
    {
     

      $devamteklif = Teklifler::where(function ($query) {
          $query->where([
             'silindi'     =>0,
             'OnayDurumu' =>2,
          ])->whereYear('TeklifVerilenTarih','>','2017-12-31');
      })->with('tercuman')->orderBy('TeklifVerilenTarih','DESC')->get();



        return view('admin.pages.devamedenteklif',['devamteklif'=>$devamteklif]);
    }



//TAMAMLANAN

    public function tamamlanan()
    {
      $tamamlananteklif = Teklifler::where(function ($query) {

          $query->where([
             'silindi'     =>0,
             'OnayDurumu' =>3,
          ])->whereYear('OnayVerilenTarih','>','2017-12-31');

      })->orderBy('OnayVerilenTarih','DESC')->get();
      


        return view('admin.pages.tamamlananteklif',['tamamlananteklif'=>$tamamlananteklif]);
    }




    public function iptalteklif()
    {


      $iptalteklif = Teklifler::where(function ($query) {

          $query->where([
             'silindi'=>1,
          ]);

      })->whereYear('iptalEtmeTarihi','>','2017-12-31')
      ->orderBy('GelenTeklifTarihi','DESC')->get();
     


        return view('admin.pages.iptalteklif',['iptalteklif'=>$iptalteklif]);
    }


    public function gelenteklifonayla(Request $request){

            $id = request()->input('bookId');
            
            $teklif = Teklifler::find($id);

            $teklif->OnaylayanTemsilciID=Auth::user()->id;
            $teklif->OnayDurumu =2;
            $teklif->update();
            return redirect()->route('devameden');


    }



    public function gelenteklifsil(Request $request){


        $id=$request->input('teklifsil');
        $teklifsil = Teklifler::find($id);
        $teklifsil->silindi=1;
        $teklifsil->iptalEdenTemsilciID=Auth::user()->id;
        $teklifsil->iptalEtmeTarihi=date('Y-m-d H:i:s');
        $teklifsil->iptalNedeni=request()->input('iptalnedeni');
        $teklifsil->push();

        alert()->flash('Başarıyla Silindi', 'success');
        return redirect()->route('dashboard');

        }






  public function onaysil(Request $request){

    $id = $request->input('onaybekleyensil');
    $onaysil = Teklifler::find($id);
    $onaysil->iptalEdenTemsilciID=$request->input('OnayİptalEdenTemsilci');
    $onaysil->iptalNedeni=$request->input('Onayiptalnedeni');
    $onaysil->silindi=1;
    $onaysil->update();

      alert()->flash('Başarıyla Silindi', 'success');
      return redirect()->route('onaybekleyen');

    }




    public function onaybekleyenedit($id)

    {

        $tercumanli = TercumanVeritabani::where('silindi', 0)
                ->where(function($q) {
          $q->where('onaydurumu', 2)
            ->orWhere('onaydurumu', 3);
      })
      ->get();




      $teklif = Teklifler::find($id);
      return view('admin.pages.onaybekleyenedit',['teklif'=>$teklif,'tercumanli'=>$tercumanli]);



    }

    public function onaybekleyenupdate(Request $request,$id)

      {

        $update = Teklifler::find($id);
        $input = $request->all();
        $update->update($input);

         alert()->flash('Başarıyla Güncellenmiştir', 'success');
        return redirect()->back();

      }



      public function onaybekleyenyazdir($id)

      {

        $teklif = Teklifler::find($id);
        return view('admin.pages.onaybekleyenyazdir',['onay'=>$teklif]);

      }



//DEVAM EDENLER BAŞLANGIÇ



    public function tekliftamamla(Request $request){


            $id = request()->input('devamedenid');

            $temsilci = request()->input('devamionaylayantemsilci');
            $EvrakTeslimTarihi=request()->input('EvrakTeslimTarihi');

            $teklif = Teklifler::find($id);

            $teklif->EvrakTeslimTarihi  =$EvrakTeslimTarihi;
            $teklif->OnaylayanTemsilciID=$temsilci;
            $teklif->OnayDurumu =3;
            $teklif->update();
            alert()->flash('Başarıyla Güncellenmiştir', 'success');
            return redirect()->route('tamamlanan');


    }

    public function devamsil(Request $request){


      $id = $request->input('devamedensil');
      $devamsil = Teklifler::find($id);
      $devamsil->iptalEdenTemsilciID=$request->input('DevamİptalEdenTemsilci');
      $devamsil->iptalNedeni=$request->input('Devamiptalnedeni');
      $devamsil->silindi=1;
      $devamsil->update();


        alert()->flash('Başarıyla Silindi', 'success');
        return redirect()->route('devameden');

      }



      public function devamedenedit($id)

      {

           $tercumanli = TercumanVeritabani::where('silindi', 0)
                ->where(function($q) {
          $q->where('onaydurumu', 2)
            ->orWhere('onaydurumu', 3);
      })
      ->get();


        $teklif = Teklifler::find($id);
        return view('admin.pages.devamedenedit',['teklif'=>$teklif,'tercumanmali'=>$tercumanli]);



      }


      public function devamedenupdate(Request $request,$id)

        {

          $update = Teklifler::find($id);
          $input = $request->all();
          $update->update($input);
          alert()->flash('Başarıyla Güncellenmiştir', 'success');
          return redirect()->route('devameden');
        }


        public function devamedenyazdir($id)

        {

          $teklif = Teklifler::find($id);
          return view('admin.pages.devamedenyazdir',['onay'=>$teklif]);

        }

    public function devamgidenmail($id){
      
      $devammail=Teklifler::find($id);
      return view('admin.pages.devamgidenmail',['maildetay'=>$devammail]);

    }




//TAMAMLANAN BÖLÜMÜ

      public function tamamlananedit($id)

      {

        $teklif = Teklifler::find($id);
        return view('admin.pages.tamamlananedit',['teklif'=>$teklif]);



      }


      public function tamamlananupdate(Request $request,$id)

        {

          $update = Teklifler::find($id);
          $input = $request->all();
          $update->update($input);
          alert()->flash('Başarıyla Güncellenmiştir', 'success');
          return redirect()->route('tamamlanan');
        }


        public function tamamlananyazdir($id)

        {

          $teklif = Teklifler::find($id);
          return view('admin.pages.tamamlananyazdir',['onay'=>$teklif]);

        }


        public function yeniisekle()
          {

            $tercumanlar = TercumanVeritabani::where(function ($query) {
            $query->where('onaydurumu',2)
            ->orWhere('onaydurumu',3);
          })->get();
              
            
            return view('admin.pages.yeniisekle',['tercumanlar'=>$tercumanlar]);
          }


        public function isekle(Request $request)

            {

                $Teklifler = new Teklifler;
                $Teklifler->GelenTeklifTarihi = $request->input('GelenTeklifTarihi');
                $Teklifler->isimSoyisim = $request->input('isimSoyisim');
                $Teklifler->Telefon = $request->input('Telefon');
                $Teklifler->Email = $request->input('Email');
                $Teklifler->KaynakDil = $request->input('KaynakDil');

                $Teklifler->HedefDil = implode(",",$request->input('HedefDil'));

                $Teklifler->Fiyat = $request->input('Fiyat');
                $Teklifler->Kapora = $request->input('Kapora');
                $Teklifler->TercumanID = $request->input('TercumanID');
                $Teklifler->TastikSekli = $request->input('TastikSekli');
                $Teklifler->OnayDurumu = $request->input('OnayDurumu');
                $Teklifler->SubeID =Auth::user()->Yer;
                $Teklifler->TeklifVerenTemsilci = Auth::user()->id;
                $Teklifler->TemsilciGelenTeklifNot = $request->input('TemsilciGelenTeklifNot');
                

                $Teklifler->save();

                alert()->flash('Başarıyla Kayıt Edilmiştir', 'success');
                return redirect()->back();




            }




      public function tamamgidenmail($id){
      
         $tamammail=Teklifler::find($id);
         return view('admin.pages.tamamgidenmail',['tamammaildetay'=>$tamammail]);

       }


            // TERCUMANLAR FUNCTİON


            public function tercumanekle(){

                return view('admin.pages.tercumanekle');
            }

            public function vttercumanekle(Request $request)
              {

                $TercumanVeritabani = new TercumanVeritabani;
                $TercumanVeritabani->isimSoyisim = $request->input('isimSoyisim');
                $TercumanVeritabani->Telefon = $request->input('Telefon');
                $TercumanVeritabani->Mail = $request->input('Email');
                $TercumanVeritabani->Locasyon = $request->input('Lokasyon');
                $TercumanVeritabani->Hesapsahibi = $request->input('HesapSahibi');
                $TercumanVeritabani->onaydurumu = 0;



                $TercumanVeritabani->ibanno = $request->input('ibanno');
                $TercumanVeritabani->temsilciNot = $request->input('TemsilciNot');
                $TercumanVeritabani->BasvuruTarihi = date('Y-m-d H:i:s');

                $TercumanVeritabani->save();

                if($TercumanVeritabani->save()){

                $last_id = $TercumanVeritabani->id;


                          $index = 0;
                          while(true){
                            if($request->input('kaynakdil'.$index)){

                              $Tercumandilbilgileri = new Tercumandilbilgileri;
                              $Tercumandilbilgileri->TercumanID = $last_id;
                              $Tercumandilbilgileri->tercume_turu = $request->input('tercumeturu'.$index);
                              $Tercumandilbilgileri->KaynakDil = $request->input('kaynakdil'.$index);
                              $Tercumandilbilgileri->HedefDil = $request->input('hedefdil'.$index);
                              $Tercumandilbilgileri->BirimFiyat = $request->input('birimfiyat'.$index);
                              $Tercumandilbilgileri->save();

                          }else{
                             break;
                         }
                         $index +=1;

                          }

                }else{

                    echo "BİR HATA OLUŞTU";

                }

                   alert()->flash('Başarıyla Kayıt Edilmiştir', 'success');
                  return redirect()->route('tercumanbasvurulari');
              }




public function tercumanguncelle(Request $request,$id)
{


                

                $TercumanVeritabani =TercumanVeritabani::find($id);
                $TercumanVeritabani->isimSoyisim = $request->input('isimSoyisim');
                $TercumanVeritabani->Telefon = $request->input('Telefon');
                $TercumanVeritabani->Mail = $request->input('Email');
                $TercumanVeritabani->Locasyon = $request->input('Lokasyon');
                $TercumanVeritabani->Hesapsahibi = $request->input('HesapSahibi');
                $TercumanVeritabani->ibanno = $request->input('ibanno');
                $TercumanVeritabani->temsilciNot = $request->input('TemsilciNot');

                

                $TercumanVeritabani->update();

                if($TercumanVeritabani->update()){


                         
                            foreach ($_POST['kaynakdil'] AS $key => $val) {
                              
                              $Tercumandilbilgileri =new Tercumandilbilgileri;
                              $Tercumandilbilgileri->TercumanID=$id;
                              $Tercumandilbilgileri->tercume_turu=$_POST['tercumeturu'][$key];
                              $Tercumandilbilgileri->KaynakDil=$_POST['kaynakdil'][$key];
                              $Tercumandilbilgileri->HedefDil=$_POST['hedefdil'][$key];
                              $Tercumandilbilgileri->BirimFiyat=$_POST['birimfiyat'][$key];
                              $Tercumandilbilgileri->save();

                          }
                            
                        

                }else{

                    echo "BİR HATA OLUŞTU";

                }

                  alert()->flash('Başarıyla Güncellenmiştir', 'success');
                  return redirect()->back();





}




public function tumtercumanlar(){
  return view('admin.pages.tumtercumanlar');
}



public function tercumanduzenle($id)
{

     $tercumanduzenle = TercumanVeritabani::find($id);
     return view('admin.pages.tercumanduzenle',['tercumand'=>$tercumanduzenle]);



}






public function tercumanbasvurulari()
  {

    return view('admin.pages.tercumanbasvurulari');

  }




  public function tercumanbasvurusil($id)
  {

    $tercumanveritabani = TercumanVeritabani::findOrFail($id);
    $tercumanveritabani->silindi = 1;
    $tercumanveritabani->push(); 

    alert()->flash('Başarıyla Güncellenmiştir', 'success');
    return redirect()->back();

  }


  public function tercumanbasvuruonayla(Request $request)

    {
      
            $id = request()->input('basvuruonay');

            $tercumanveritabani = TercumanVeritabani::find($id); 
            $tercumanveritabani->onaydurumu=2;
            $tercumanveritabani->push(); 
            alert()->flash('Başarıyla Güncellenmiştir', 'success');
            return redirect()->route('tercumanbasvurulari');

    }



    public function tercumanmaliyet()
      {


        return view('admin.pages.tercumanmaliyet');


      }



    public function maliyetara(Request $request){

        $ara = $request->input('ara');
        $dil = $request->input('dil');
        $calisilan = $request->input('calisilan');


         $results = DB::select(DB::raw("SELECT TercumanVeritabani.isimSoyisim, Tercumandilbilgileri.KaynakDil, Tercumandilbilgileri.HedefDil,Tercumandilbilgileri.BirimFiyat
                               FROM TercumanVeritabani
                               INNER JOIN Tercumandilbilgileri ON TercumanVeritabani.id=Tercumandilbilgileri.TercumanID WHERE TercumanVeritabani.onaydurumu=$calisilan AND Tercumandilbilgileri.HedefDil='$dil' OR Tercumandilbilgileri.KaynakDil='$dil'"));

         
         return view('admin.pages.maliyetsonuc',['result'=>$results]);

    }  




       public function tercumanara(Request $request){

        $dil = $request->input('dil2');
        $calisilan = $request->input('calisilan2');


         $results = DB::select(DB::raw("SELECT TercumanVeritabani.isimSoyisim,TercumanVeritabani.id,TercumanVeritabani.Mail,TercumanVeritabani.Telefon, Tercumandilbilgileri.KaynakDil, Tercumandilbilgileri.HedefDil,Tercumandilbilgileri.tercume_turu,TercumanVeritabani.temsilciNot
                               FROM TercumanVeritabani
                               INNER JOIN Tercumandilbilgileri ON 
                               TercumanVeritabani.id=Tercumandilbilgileri.TercumanID 
                               WHERE TercumanVeritabani.onaydurumu=$calisilan 
                               AND Tercumandilbilgileri.HedefDil='$dil' 
                               OR Tercumandilbilgileri.KaynakDil='$dil'"));

         
         return view('admin.pages.tercumansonuc',['result'=>$results]);

    }  




    //TERCUMAN TAKİP 

public function tercumanistakipekle()

{

  $tercumanlist = TercumanVeritabani::where('silindi', 0)
                ->where(function($q) {
          $q->where('onaydurumu', 2)
            ->orWhere('onaydurumu', 3);
      })
      ->get();





return view('admin.pages.tercumanistakipekle',['tercumanlist'=>$tercumanlist]);


}


public function tercumanformistakipekle(Request $request)

{

                              $TercumanIsTakip = new TercumanIsTakip;
                              $TercumanIsTakip->EklenmeTarih = date('Y-m-d H:i:s');
                              $TercumanIsTakip->TercumanAdi = $request->input('tercumanismi');
                              $TercumanIsTakip->ProjeAdi = $request->input('ProjeAdi');
                              $TercumanIsTakip->KaynakDil = $request->input('KaynakDil');
                              $TercumanIsTakip->HedefDil = $request->input('HedefDil');
                              $TercumanIsTakip->Karakter = $request->input('Karakter');
                              $TercumanIsTakip->BirimFiyat = $request->input('BirimFiyat');
                              $TercumanIsTakip->TemsilciID = Auth::user()->id;
                              $TercumanIsTakip->SubeID =Auth::user()->subeler->last()->name;
                              $TercumanIsTakip->TercumanTakipNot = $request->input('TercumanTakipNot');
                              $TercumanIsTakip->OnayDurumu = 0;
                              $TercumanIsTakip->Silindi = 0;
                              $TercumanIsTakip->save();





 alert()->flash('Başarıyla Kayıt Edilmiştir', 'success');                             
return redirect()->back();
}




public function tercumanistakipcetveli()
{

   return  view('admin.pages.tercumantakipcetveli');

}



public function tercumanistakipcetvelisil($id)
{

  TercumanIsTakip::find($id)->update(['Silindi' => 1]);

  alert()->flash('Başarıyla Silindi', 'success');
  return redirect()->back();

}

public function tercumansil(Request $request)

{


  $id=$request->input('tercumansil');
 
   $tercumansil = TercumanVeritabani::find($id);
   $tercumansil->silindi=1;
   $tercumansil->update();  

   alert()->flash('Başarıyla Silindi', 'success');
   return redirect()->back();

}



public function lksekle(Request $request)
{


  $id = request()->input('lksonay');
  $onaytarihi = date('Y-m-d H:i:s');


  TercumanIsTakip::find($id)->update(['OnayDurumu' => 1,'OnayTarihi'=>$onaytarihi]);

    alert()->flash('LKS ye Başarıyla Eklendi', 'success'); 
   return redirect()->route('tercumanistakipcetveli');


}


public function tercumantakipduzenle($id)

{


  $teklif = TercumanIsTakip::find($id);
  return view('admin.pages.istakipedit',['istakip'=>$teklif]);

}

public function istakipupdate(Request $request,$id)

{


          $teklif = TercumanIsTakip::find($id);
          $input = $request->all();
          $teklif->update($input);
          return redirect()->route('tercumanistakipcetveli', [$id]);

}



public function lksyeeklenenler()
{


  $lksyeeklenenler = TercumanIsTakip::paginate(10);  

  return view('admin.pages.lksyeeklenenler',['lksekle'=>$lksyeeklenenler]);
}

public function dilsil($id)
{




  $dilbilgisisil=Tercumandilbilgileri::find($id);
  $dilbilgisisil->delete();

  return redirect()->back();


}


public function lksara(Request $request)
{

  $dil2=$request->input('dil3');
  $temsilci2=$request->input('temsilci3');


      $results=DB::select(DB::raw("SELECT
       tercumanistakip.id,
       tercumanistakip.TercumanAdi,
       tercumanistakip.EklenmeTarih,
       tercumanistakip.ProjeAdi, 
       tercumanistakip.Karakter, 
       tercumanistakip.BirimFiyat, 
       tercumanistakip.KaynakDil,
       tercumanistakip.HedefDil, 
       tercumanistakip.TercumanTakipNot, 
       temsilciler.isimSoyisim 
   
                               FROM tercumanistakip
                               INNER JOIN temsilciler ON 
                               tercumanistakip.TemsilciID=temsilciler.id 
                               WHERE tercumanistakip.OnayDurumu=1 
                               AND   tercumanistakip.TemsilciID=$temsilci2
                               AND tercumanistakip.HedefDil='$dil2'
                               OR tercumanistakip.KaynakDil='$dil2'"));

         
         return view('admin.pages.lkssonuc',['result'=>$results]);




}



public function idgonder(Request $request)
{

  
  $id= $request->id;
  $user = Teklifler::find($id);


  




  return response()->json( ['user'=>$user]);




}

 

public function gelentekliffiyatver(Request $request)
{
            $id=request()->input('tekliffiyat');
            $yazi=$request->evrakli;

            dd($yazi);
            die();



            $teklif = Teklifler::find($id);

            Mail::raw($yazi, function($message) use($teklif)
              {
                $message->from('info@portakalmedya.com', 'Portakal Tercume Mesajı');

                $message->to($teklif->Email)->cc('Portakal Tercume Mesajı');
              });


            $teklif->GonderilenMailEvrakTuru=request()->input('evraktipi');
            $teklif->TeklifVerenTemsilci =Auth::user()->id;
            $teklif->SubeID = Auth::user()->sonsube->id;
            $teklif->TastikSekli=request()->input('tastiksekli');
            $teklif->GonderilenGun=request()->input('isgunu');
            $teklif->GonderilenGun=request()->input('issaati');
            $teklif->Fiyat=request()->input('fiyat');
            $teklif->TemsilciGelenTeklifNot=request()->input('temsilcinot');
            $teklif->OnayDurumu=1;

            $teklif->update();

            alert()->flash('Başarıyla Güncellenmiş Ve E-Posta Atılmıştır', 'success');  
            return redirect()->route('devameden');


}


//ADLİYE FONKSİYONLARI


public function adliyeisekle()

{
  return view('admin.pages.adliyeisekle');
}


  public function adliyeiseklepost(Request $request)

            {

             $date = $request->input('EvrakAlmaTarihi');  
             $dt = new DateTime($date);
             $newdate=$dt->format('Y-m-d H:i:s');

         


                $AdliyeTakipCetveli = new AdliyeTakipCetveli;
                $AdliyeTakipCetveli->EvrakAlmaTarihi =$newdate;
                $AdliyeTakipCetveli->MahkemeNo = $request->input('MahkemeNo');
                $AdliyeTakipCetveli->MahkemeID = $request->input('MahkemeID');
                $AdliyeTakipCetveli->EsasNo = $request->input('EsasNo');
                $AdliyeTakipCetveli->KaynakDil = $request->input('KaynakDil');
                $AdliyeTakipCetveli->HedefDil =$request->input('HedefDil'); 

                $AdliyeTakipCetveli->TalepEdilenFiyat = $request->input('TalepEdilenFiyat');
                $AdliyeTakipCetveli->AlinanOdeme= $request->input('AlinanOdeme');
                $AdliyeTakipCetveli->TemsilciNot= $request->input('TemsilciNot');
                $AdliyeTakipCetveli->TemsilciID = $request->input('TemsilciID');
                $AdliyeTakipCetveli->OnayDurumu =1;
                $AdliyeTakipCetveli->Silindi = 0;

                

                $AdliyeTakipCetveli->save();

                alert()->flash('Başarıyla Kayıt Edilmiştir', 'success');
                return redirect()->back();




            }



public function adliyedevameden()
{


     $adliyedevam = AdliyeTakipCetveli::where(['Silindi'=>0,'OnayDurumu'=>1])->get();

     return view('admin.pages.adliyedevam',['adliyedevam'=>$adliyedevam]);


}


public function adliyedevamonayla(Request $request)
{


  $id = $request->input('adliyedevamid');

             $date = $request->input('EvrakAlmaTarihi');  
             $dt = new DateTime($date);
             $newdate=$dt->format('Y-m-d H:i:s');


            $adliyedevamonayla = AdliyeTakipCetveli::find($id);
            $adliyedevamonayla->OnaylayanTemsilci=$request->input('onaylayantemsilci');
            $adliyedevamonayla->EvrakAlmaTarihi=$newdate;
            $adliyedevamonayla->AlinanOdeme=$request->input('AlinanOdeme');
            $adliyedevamonayla->OnayDurumu =2;
            $adliyedevamonayla->update();

            alert()->flash('Başarıyla Onaylanmıştır', 'success');
            return redirect()->back();



}


public function adliyekayitsil(Request $request)
{



 $id = $request->input('adliyekayitsil');

 $adliyekayitsil = AdliyeTakipCetveli::find($id);

 $adliyekayitsil->Silindi = 1;
 $adliyekayitsil->update();

  alert()->flash('Başarıyla Silinmiştir', 'success');
  return redirect()->back();





}

public function adliyeedit($id)
{



  $data = AdliyeTakipCetveli::find($id);

  return view('admin.pages.adliyeedit',['adliyedata'=>$data]);


}


public function adliyeupdate(Request $request,$id)

{

      $date = $request->input('EvrakAlmaTarihi');  
      $dt = new DateTime($date);
      $newdate=$dt->format('Y-m-d H:i:s');



      $date = $request->input('EvrakTeslimTarihi');  
      $dt = new DateTime($date);
      $newdate1=$dt->format('Y-m-d H:i:s');







          $update = AdliyeTakipCetveli::find($id);
          $update->EvrakAlmaTarihi =$newdate;
          $update->EvrakTeslimTarihi =$newdate;
          $update->MahkemeNo = $request->input('MahkemeNo');
          $update->MahkemeID = $request->input('MahkemeID');
          $update->EsasNo = $request->input('EsasNo');
          $update->KaynakDil = $request->input('KaynakDil');
          $update->HedefDil =$request->input('HedefDil'); 
          $update->TalepEdilenFiyat = $request->input('TalepEdilenFiyat');
          $update->AlinanOdeme= $request->input('AlinanOdeme');
          $update->TemsilciNot= $request->input('TemsilciNot');
          $update->TemsilciID = $request->input('TemsilciID');
  

          $update->update();
          










          alert()->flash('Başarıyla Güncellenmiştir', 'success');
          return redirect()->route('adliyedevameden');



}



public function adliyetamamlanan()


{


     $adliyetamam = AdliyeTakipCetveli::where(['Silindi'=>0,'OnayDurumu'=>2])->get();

     return view('admin.pages.adliyetamam',['adliyetamam'=>$adliyetamam]);






}



















public function test()
{  
 
$data =TercumanVeritabani::with('tercumandilbilgileri')->get();

return $data;



}











}
