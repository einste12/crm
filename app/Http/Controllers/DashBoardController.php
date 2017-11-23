<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teklifler;
use Session;
use Toastr;
use DB;

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
      ->select(['id','GelenTeklifTarihi','isimSoyisim','Fiyat','TeklifVerenTemsilci','Email','Telefon','KaynakDil','HedefDil','TastikSekli','MusteriTalebi','TemsilciGelenTeklifNot'])
      ->orderBy('teklifverilentarih','DESC')
      ->paginate(100);




        return view('admin.pages.devamedenteklif',['devamteklif'=>$devamteklif]);
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




        return view('admin.pages.tamamlananteklif',['tamamlananteklif'=>$devamteklif]);
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




        return view('admin.pages.iptalteklif',['iptalteklif'=>$iptalteklif]);
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

  public function gelenteklifsil($id){

    $teklifsil = Teklifler::find($id);
    $teklifsil->delete();

      return redirect()->route('onaybekleyen')->with('message','Kaydınız Başarıyla Silindi.');

    }



}
