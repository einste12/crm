<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teklifler;
use Session;
use Toastr;
use DB;
use App\Tercumandilbilgileri;
use App\Temsilciler;
use App\TercumanVeritabani;
use Auth;
use App\Subeler;

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
      $gelenteklif = DB::table('teklifler')
      ->where(function ($query) {

          $query->where([
             'silindi'     =>0,
             'onaydurumu' =>0,
          ]);

      })
      ->select(['id','GelenTeklifTarihi','isimSoyisim','Email','Telefon','KaynakDil','HedefDil','TastikSekli','MusteriTalebi'])
      ->orderBy('teklifverilentarih','DESC')
      ->paginate(100);




        return view('dashboard',['teklif'=>$gelenteklif]);
    }




    public function onaybekleyen()
    {
      $onaybekleyen = DB::table('teklifler')
      ->where(function ($query) {

          $query->where([
             'silindi'     =>0,
             'onaydurumu' =>1,
          ]);

      })
      ->select(['id','GelenTeklifTarihi','TeklifVerilenTarih','isimSoyisim','Fiyat','TeklifVerenTemsilci','Email','Telefon','KaynakDil','HedefDil','TastikSekli','MusteriTalebi','TemsilciGelenTeklifNot','TercumanID','Kapora'])
      ->orderBy('teklifverilentarih','DESC')
      ->paginate(100);




        return view('admin.pages.onaybekleyen',['onaybekleyen'=>$onaybekleyen]);
    }















//DEVAM EDEN TEKLİFLER//


    public function devameden()
    {
      $devamteklif = DB::table('teklifler')
      ->where(function ($query) {

          $query->where([
             'silindi'     =>0,
             'onaydurumu' =>2,
          ]);

      })
      ->select(['id','TercumanID','TeklifVerilenTarih','HedefDil','KaynakDil','GelenTeklifTarihi','isimSoyisim','Kapora','Fiyat','TeklifVerenTemsilci','Email','Telefon','KaynakDil','HedefDil','TastikSekli','MusteriTalebi','TemsilciGelenTeklifNot'])
      ->orderBy('teklifverilentarih','DESC')
      ->paginate(100);


      $tercuman = TercumanVeritabani::all();

        return view('admin.pages.devamedenteklif',['devamteklif'=>$devamteklif,'tercumansss'=>$tercuman]);
    }



//TAMAMLANAN

    public function tamamlanan()
    {
      $devamteklif = DB::table('teklifler')
      ->where(function ($query) {

          $query->where([
             'silindi'     =>0,
             'onaydurumu' =>3,
          ]);

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
             'onaydurumu' =>4,
          ]);

      })
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
        $teklifsil->delete();

          return redirect()->route('dashboard')->with('message','Kaydınız Başarıyla Silindi.');

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

      $teklifsil = Teklifler::find($id);
      $teklifsil->delete();

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
                $Teklifler->TeklifVerenTemsilci = $request->input('TeklifVerenTemsilci');
                $Teklifler->TemsilciGelenTeklifNot = $request->input('TemsilciGelenTeklifNot');
                $Teklifler->SurekliMusteri = $request->input('SurekliMusteri');

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


}
