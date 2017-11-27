<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Temsilciler;
use App\Subeler;
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

        $tercuman = TercumanVeritabani::all();
        view()->share('tercuman',$tercuman);


        $subeler =Subeler::all();
        view()->share('subeler',$subeler);

        $genel_subeler = [];
        $genel_subeler =Subeler::all();
        view()->share('genel_subeler',$subeler);





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
