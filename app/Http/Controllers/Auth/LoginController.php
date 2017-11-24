<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Subeler_User;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     public function authenticated(){
         $user = User::find(Auth::user()->id);
         $user->yer= Input::get('sube');
         $user->update();


         $Subeler_User = new Subeler_User;
         $Subeler_User->user_id = \Auth::user()->id;
         $Subeler_User->sube_id = Input::get('sube');
         $Subeler_User->Tarih   =Carbon::now();
         $Subeler_User->save();

       }
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
