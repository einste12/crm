<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Temsilciler;
use App\Subeler;
use App\Diller;
use App\IptalNedenleri;
use App\TercumanIsTakip;
use App\TercumanVeritabani;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $temsilci = Temsilciler::orderBy('id', 'ASC')->get();
        view()->share('temsilci',$temsilci);

        $iptalsebepleri =IptalNedenleri::all();
        view()->share('iptalnedeni',$iptalsebepleri);


        $tercuman = TercumanVeritabani::where(['silindi'=>0,'onaydurumu'=>0])
        ->paginate(10);
        view()->share('tercuman',$tercuman);


         $tercumanmali = TercumanVeritabani::where(['silindi'=>0,'onaydurumu'=>3])
        ->paginate(10);
        view()->share('tercumanmali',$tercumanmali);


        $tercumantakipcetveli = TercumanIsTakip::where(['silindi'=>0,'onaydurumu'=>0])
        ->paginate(10);
        view()->share('tercumantakipcetveli',$tercumantakipcetveli); 


 
        $diller =Diller::orderBy('sirala', 'ASC')->get();
        view()->share('diller',$diller);


        $subeler =Subeler::all();
        view()->share('subeler',$subeler);

   





    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
