<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teklifler;
use Session;
use Toastr;
use DB;
use Carbon\Carbon;
use App\TercumanIsTakip;
use App\Tercumandilbilgileri;
use App\Temsilciler;
use App\TercumanVeritabani;
use Auth;
use App\Subeler;
use App\User; 
use Alert;

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

      })->orderBy('TeklifVerilenTarih','DESC')->paginate(100);

        return view('dashboard',['teklif'=>$gelenteklif]);
    }




    public function onaybekleyen()
    {
      $onaybekleyen =Teklifler::where(function ($query) {

          $query->where([
             'silindi'     =>0,
             'OnayDurumu' =>1,
          ])->whereYear('TeklifVerilenTarih','>','2017-12-31');

      })->orderBy('TeklifVerilenTarih','DESC')->paginate(100);
       

        return view('admin.pages.onaybekleyen',['onaybekleyen'=>$onaybekleyen]);
    }



//DEVAM EDEN TEKLİFLER//


    public function devameden()
    {
     

      $devamteklif = Teklifler::where(function ($query) {
          $query->where([
             'silindi'     =>0,
             'OnayDurumu' =>2,
          ])->whereYear('TeklifVerilenTarih','>','2017-12-31');
      })->with('tercuman')->orderBy('TeklifVerilenTarih','DESC')->paginate(100);



        return view('admin.pages.devamedenteklif',['devamteklif'=>$devamteklif]);
    }



//TAMAMLANAN

    public function tamamlanan()
    {
      $devamteklif = DB::table('teklifler')
      ->where(function ($query) {

          $query->where([
             'silindi'     =>0,
             'OnayDurumu' =>3,
          ])->whereYear('OnayVerilenTarih','>','2017-12-31');

      })
      ->select(['id','GelenTeklifTarihi','isimSoyisim','Fiyat','TeklifVerenTemsilci','Email','Telefon','KaynakDil','HedefDil','TastikSekli','MusteriTalebi','OnaylayanTemsilciID','TemsilciGelenTeklifNot','Kapora','EvrakTeslimTarihi'])
      ->orderBy('OnayVerilenTarih','DESC')
      ->paginate(100);



        $temsilci =Temsilciler::all();
        return view('admin.pages.tamamlananteklif',['tamamlananteklif'=>$devamteklif,'temsilcisss'=>$temsilci]);
    }




    public function iptalteklif()
    {
      $iptalteklif = DB::table('teklifler')
      ->where(function ($query) {

          $query->where([
             'silindi'     =>0,
             'OnayDurumu' =>4,
          ]);

      })->whereYear('GelenTeklifTarihi','>','2017-12-31')
      ->select(['id','GelenTeklifTarihi','TeklifVerilenTarih','iptalEtmeTarihi','isimSoyisim','Fiyat','Email','Telefon','KaynakDil','HedefDil','TastikSekli','iptalEdenTemsilciID','iptalNedeni','Kapora'])
      ->orderBy('GelenTeklifTarihi','DESC')
      ->paginate(100);


        $temsilci =Temsilciler::all();
        return view('admin.pages.iptalteklif',['iptalteklif'=>$iptalteklif,'temsilcissss'=>$temsilci]);
    }


    public function gelenteklifonayla(Request $request){

            $id = request()->input('bookId');
            $temsilci = request()->input('onaylayantemsilci');

            $teklif = Teklifler::find($id);

            $teklif->OnaylayanTemsilciID=$temsilci;
            $teklif->OnayDurumu =2;
            $teklif->update();
            return redirect()->route('devameden');


    }

  public function onaybekleyensil($id){

    $teklifsil = Teklifler::find($id);
    $teklifsil->delete();

      return redirect()->route('onaybekleyen')->with('message','Kaydınız Başarıyla Silindi.');

    }


      public function gelenteklifsil($id){

        $teklifsil = Teklifler::find($id);
        $teklifsil->silindi=1;
        $teklifsil->push();


          alert()->flash('Başarıyla Silindi', 'error');
          return redirect()->route('dashboard');

        }



    public function onaybekleyenedit($id)

    {

      $teklif = Teklifler::find($id);
      return view('admin.pages.onaybekleyenedit',['teklif'=>$teklif]);



    }

    public function onaybekleyenupdate(Request $request,$id)

      {

        $update = Teklifler::find($id);
        $input = $request->all();
        $update->update($input);

        return redirect()->back()->with('message','Başarıyla Güncellenmiştir.');

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
            return redirect()->route('tamamlanan')->with('message','Devam Eden Teklifiniz Tamamlanan Tekliflere Alınmıştır.');


    }

    public function devamedensil($id){

      $teklifsil = Teklifler::find($id);
      $teklifsil->delete();

        return redirect()->route('devameden')->with('message','Kaydınız Başarıyla Silindi.');

      }



      public function devamedenedit($id)

      {

        $teklif = Teklifler::find($id);
        return view('admin.pages.devamedenedit',['teklif'=>$teklif]);



      }


      public function devamedenupdate(Request $request,$id)

        {

          $update = Teklifler::find($id);
          $input = $request->all();
          $update->update($input);
          return redirect()->route('devameden')->with('message','Başarıyla Güncellenmiştir.');
        }


        public function devamedenyazdir($id)

        {

          $teklif = Teklifler::find($id);
          return view('admin.pages.devamedenyazdir',['onay'=>$teklif]);

        }

//TAMAMLANAN BÖLÜMÜ

    public function tamamlanansil($id){

      $teklifsil=Teklifler::find($id);
      $teklifsil->silindi=1;
      $teklifsil->push();

        return redirect()->route('tamamlanan')->with('message','Kaydınız Başarıyla Silindi.');

      }



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
          return redirect()->route('tamamlanan')->with('message','Başarıyla Güncellenmiştir.');
        }


        public function tamamlananyazdir($id)

        {

          $teklif = Teklifler::find($id);
          return view('admin.pages.tamamlananyazdir',['onay'=>$teklif]);

        }


        public function yeniisekle()

          {
            return view('admin.pages.yeniisekle');
          }


        public function isekle(Request $request)

            {

                $Teklifler = new Teklifler;
                $Teklifler->GelenTeklifTarihi = $request->input('GelenTeklifTarihi');
                $Teklifler->isimSoyisim = $request->input('isimSoyisim');
                $Teklifler->Telefon = $request->input('Telefon');
                $Teklifler->Email = $request->input('Email');
                $Teklifler->KaynakDil = $request->input('KaynakDil');
                $Teklifler->HedefDil = $request->input('HedefDil');
                $Teklifler->Fiyat = $request->input('Fiyat');
                $Teklifler->Kapora = $request->input('Kapora');
                $Teklifler->TercumanID = $request->input('TercumanID');
                $Teklifler->TastikSekli = $request->input('TastikSekli');
                $Teklifler->OnayDurumu = $request->input('OnayDurumu');
                $Teklifler->SubeID = $request->input('SubeID');
                $Teklifler->TeklifVerenTemsilci = $request->input('TeklifVerenTemsilci');
                $Teklifler->TemsilciGelenTeklifNot = $request->input('TemsilciGelenTeklifNot');
                

                $Teklifler->save();

                return redirect()->back()->with('message','Başarıyla Kayıt Yapılmıştır');




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


                  return redirect()->back();
              }



public function tumtercumanlar(){
  return view('admin.pages.tumtercumanlar');
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

    return redirect()->back()->with('message','Başarıyla Silinmiştir');

  }


  public function tercumanbasvuruonayla(Request $request)

    {
      
            $id = request()->input('basvuruonay');

            $tercumanveritabani = TercumanVeritabani::find($id); 
            $tercumanveritabani->onaydurumu=2;
            $tercumanveritabani->push(); 
            return redirect()->route('tercumanbasvurulari')->with('message','Başarıyla Onaylandı');

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


         $results = DB::select(DB::raw("SELECT TercumanVeritabani.isimSoyisim,TercumanVeritabani.Mail,TercumanVeritabani.Telefon, Tercumandilbilgileri.KaynakDil, Tercumandilbilgileri.HedefDil,Tercumandilbilgileri.tercume_turu,TercumanVeritabani.temsilciNot
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
                              $TercumanIsTakip->TemsilciID = $request->input('Temsilci');
                              $TercumanIsTakip->SubeID = $request->input('GonderenYer');
                              $TercumanIsTakip->TercumanTakipNot = $request->input('TercumanTakipNot');
                              $TercumanIsTakip->OnayDurumu = 0;
                              $TercumanIsTakip->Silindi = 0;
                              $TercumanIsTakip->save();






return redirect()->back()->with('message','Başarıyla İş Takibi Eklenmiştir');
}




public function tercumanistakipcetveli()
{

   return  view('admin.pages.tercumantakipcetveli');

}



public function tercumanistakipcetvelisil($id)
{

  TercumanIsTakip::find($id)->update(['Silindi' => 1]);

  return redirect()->back()->with('message','Başarıyla Silinmiştir');

}



public function lksekle(Request $request)
{


  $id = request()->input('lksonay');
  $onaytarihi = date('Y-m-d H:i:s');


  TercumanIsTakip::find($id)->update(['OnayDurumu' => 1,'OnayTarihi'=>$onaytarihi]);

   return redirect()->route('tercumanistakipcetveli')->with('message','LKS  ye Başarıyla Eklendi');


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
  $data = Teklifler::find($id);



  $html = ' Sayın <div id="madi">'.$data->isimSoyisim.'</div><br />
<span id="tasdikHtml">Göndermiş olduğunuz belgenin yeminli tercüme ücreti​ <span id="fiyat1">XXX</span> TL + %18 KDV’ dir.</span>
Ödemenin yapılması halinde belge/belgelerinizin tercümesi <span id="sure">XX</span><span id="suretur"> iş günü/saat </span>içerisinde teslim edilecektir.  

Değerlendirmenize sunar, <br />
İyi çalışmalar dileriz.

<span id="temsilci-adi">'.Auth::user()->name.'</span> / Proje Koordinatörü<br /><br />
<b>Temsilci Gsm:</b> <span id="temsilci-telefon"> </span>
<b>Çağrı Merkezi:</b>  444 82 86
www.portakaltercume.com.tr

FİRMAMIZIN TÜM ÖDEME KANALLARI AŞAĞIDA Kİ GİBİDİR. 

1- EFT YA DA HAVALE
HESAP ADI: PORTAKAL TERCÜME VE MEDYA A.Ş. KUVEYTTÜRK KATILIM BANKASI
IBAN NO: TR170020500009380768500001 

HESAP ADI: PORTAKAL TERCÜME VE MEDYA A.Ş. ZİRAAT BANKASI
IBAN NO: TR860001000485758944095001 

2- İNTERNET SİTEMİZ ÜZERİNDEN VISA-MASTERCARD YA DA AMERICAN EXPRESS KREDİ KARTLARIYLA ÖDEME YAPABİLİRSİNİZ. https://www.portakaltercume.com/online-odeme/ 

3- MAİL ORDER SİSTEMİ İLE ÖDEME YAPABİLİRSİNİZ.(FİRMAMIZDAN FORMU TALEP EDİNİZ)
</div>
                                            
                            
<div class="hidden" id="evraksiznot"><p>Sayın <span class="madi"></span><br />
Çevirisini yaptırmak istediğiniz dosyalarınızı bize maille gönderebilirseniz inceleyip size fiyat ve süre hakkında bilgi verebiliriz. 

​1- ​Hızlı teklif almak için <a href="https://www.portakaltercume.com/fiyat-teklifi-al/?ref=crm">https://www.portakaltercume.com/fiyat-teklifi-al/</a> adresinden belgelerinizi bize gönderebilirsiniz.

​2- Evraklarınızı ​<b> <span id="temsilci-telefon"></span></b> nolu telefona WhatsApp programı üzerinden belgenizin resmini çekerek gönderebilirsiniz​.

3- ​<a href="mailto:info@portakaltercume.com.tr">info@portakaltercume.com.tr</a> adresine mail atabilirsiniz.

Değerlendirmenize sunar, <br />
İyi çalışmalar dileriz.

<span id="temsilci-adi"></span> / Proje Koordinatörü<br /><br />
<b>Temsilci Gsm:</b> <span id="temsilci-telefon"></span>
<b>Çağrı Merkezi:</b>  444 82 86
www.portakaltercume.com.tr
</div>';

  return response()->json( ['html' => $html]);
}


public function gelentekliffiyatver(Request $request)

{


            $id=request()->input('tekliffiyat');

            $teklif = Teklifler::find($id);

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
            return redirect()->route('devameden');




}




public function test()
{  
 
  $teklifler = Teklifler::with('tercuman')->get();
  return $teklifler;



}


}
