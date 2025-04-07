<?php

namespace App\Http\Controllers\Auth;

use App\Classes\CalculationsClass;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Carbon\Carbon;
use App\Models\User;




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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()

    {
        $this->middleware('guest')->except('logout');
    }

    /** index login page */
    public function login(Request $request)
    {
        return view('auth.login');
    }

    /** login page to check database table users */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);
        try {
            $username = $request->email;
            $password = $request->password;

            $dt         = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();
            
            if (Auth::attempt(['email'=> $username,'password'=> $password])) {
                /* get session */
                $user = Auth::User();
                Session::put('name', $user->name);
                // Session::put('last_stname', $user->last_stname);
                // Session::put('email', $user->email);
                Session::put('user_id', $user->user_id);
                // Session::put('join_date', $user->join_date);
                // Session::put('last_login', $user->last_login);
                // Session::put('phone_number', $user->phone_number);
                // Session::put('second_phone_number', $user->second_phone_number);
                // Session::put('status', $user->status);
                // Session::put('gender', $user->gender);
                // Session::put('fonction', $user->fonction);
                // Session::put('photo', $user->photo);
                // Session::put('password', $user->password);


                Session::put('system_clent_id', value: $user->system_client->id);
                
                session([
                    'devise' => $user->system_client->devise,
                ]);

                $updateLastLogin = ['last_login' => $todayDate,];
                User::where('email',$username)->update($updateLastLogin);
                $message = 'Profitez au maximum!';
                toastr()->success($message, session('name').' '.session('last_stname'));
                return redirect()->intended('home');

            } else {
                toastr()->error('Mot de passe ou nom d\'utilisateur invalide!',);
                return redirect('login');
            }
        }catch(\Exception $e) {
            \Log::info($e);
            DB::rollback();
            toastr()->error('Nous avons rencontré un problème! Veuillez recommencer...',);
            return redirect()->back();
        }
    }

    /** page logout */
    public function logoutPage()
    {
        return view('auth.logout');
    }

    /** logout and forget session */
    public function logout(Request $request)
    {
        // forget login session
        $request->session()->forget('name');
        $request->session()->forget('email');
        $request->session()->forget('user_id');
        $request->session()->forget('join_date');
        $request->session()->forget('last_login');
        $request->session()->forget('phone_number');
        $request->session()->forget('status');
        $request->session()->forget('second_phone_number');
        $request->session()->forget('fonction');
        $request->session()->forget('photo');
        $request->session()->forget('password');
        $request->session()->forget('phone_number');
        $request->session()->flush();
        Auth::logout();
        toastr()->success('Deconnxion faite avec succès! Nous vous conseillons de fermer toute page liée à promir.','Success');
        return redirect('logout/page');
    }

    public function exportUsers()
    {
        return dd("eede");
        // return Excel::download(new UsersExport, 'users.xlsx');
    }
    
}