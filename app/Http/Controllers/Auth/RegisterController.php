<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\System_client;
use App\Models\jour_de_repo_system_client;
use App\Models\jour_de_repos;
use Carbon\Carbon;
use Hash;
use DB;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    /** regiter page */
    public function register(Request $request)
    {
        return view('auth.register');
    }

    /** insert new users */
    public function store(Request $request)
    {
        
        $ValidCurrencies = [
            "AFN", "ALL", "DZD", "USD", "EUR", "AOA", "XCD", "ARS", "AMD", "AWG", "AUD", "AZN", "BSD", 
            "BHD", "BDT", "BBD", "BYN", "BZD", "XOF", "BMD", "INR", "BTN", "BOB", "BOV", "BAM", "BWP", 
            "NOK", "BRL", "BND", "BGN", "BIF", "CVE", "KHR", "XAF", "CAD", "KYD", "CLP", "CLF", "CNY", 
            "COP", "COU", "KMF", "CDF", "NZD", "CRC", "HRK", "CUP", "CUC", "ANG", "CZK", "DKK", "DJF", 
            "DOP", "EGP", "SVC", "ERN", "SZL", "ETB", "FJD", "XOF", "XPF", "GMD", "GEL", "GHS", "GIP", 
            "GTQ", "GBP", "GNF", "GYD", "HTG", "HNL", "HKD", "HUF", "ISK", "INR", "IDR", "XDR", "IRR", 
            "IQD", "ILS", "JMD", "JPY", "JOD", "KZT", "KES", "KPW", "KRW", "KWD", "KGS", "LAK", "LBP", 
            "LSL", "LRD", "LYD", "CHF", "MOP", "MKD", "MGA", "MWK", "MYR", "MVR", "MRU", "MUR", "XUA", 
            "MXN", "MXV", "MDL", "MNT", "MAD", "MZN", "MMK", "NAD", "NPR", "NIO", "NGN", "OMR", "PKR", 
            "PAB", "PGK", "PYG", "PEN", "PHP", "PLN", "QAR", "RON", "RUB", "RWF", "SHP", "WST", "STN", 
            "SAR", "RSD", "SCR", "SLL", "SGD", "XSU", "SBD", "SOS", "ZAR", "SSP", "LKR", "SDG", "SRD", 
            "SEK", "SYP", "TWD", "TJS", "TZS", "THB", "TOP", "TTD", "TND", "TRY", "TMT", "UGX", "UAH", 
            "AED", "UYU", "UZS", "VUV", "VES", "VND", "YER", "ZMW", "ZWL"
        ];
        

        
        
        // 'type_de_vente.in' => 'Le type de vente que vous sélectionnez est invalide.',
        {
            


        try {
            // Générer un nom d'utilisateur automatique à partir du nom et du prénom de l'utilisateur
            $username = strtolower(substr($request->name, 0, 3) . substr($request->last_stname, 0, 3));
            $count = User::where('user_name', 'LIKE', $username . '%')->count();
            if ($count > 0) {
                $username .= $count + 1; 
            }
            $system_client = new System_client;
            $system_client->deno_sociale = $request->deno_sociale;
            $system_client->sigle = $request->sigle;
            $system_client->type = $request->type;
            $system_client->devise = $request->devise;
            $system_client->date_creation = $request->date_creation;
            $system_client->pays = $request->pays;
            $system_client->region = $request->region;
            $system_client->localite = $request->localite;
            $system_client->adresse_geographique = $request->adresse_geographique;
            $system_client->tel = $request->tel;
            $system_client->cel = $request->cel;
            $system_client->mail_entreprise = $request->mail_entreprise;
            $system_client->lien_page_fbook = $request->lien_page_fbook;
            $system_client->lien_site_web = $request->lien_site_web;
            $system_client->capital_social = $request->capital_social;
            $system_client->nbr_employes = $request->nbr_employes;
            $system_client->chiffre_affaire = $request->chiffre_affaire;
            $system_client->sect_activite = $request->sect_activite;
            $system_client->regime_fiscal = $request->regime_fiscal;
            $system_client->num_cnps = $request->num_cnps;
            $system_client->centre_impot = $request->centre_impot;
            $system_client->status_compte = "actif";
            // $system_client->adresse = $request->logo_image;
            $jours_repos = [];

            
            // dd($request->trvl_mercredi);
            
            $jour = jour_de_repos::where('libelle', 'Mercredi')->first();
            if (!$jour) {
                jour_de_repos::create(['libelle' => 'Mercredi']);
            }

            if($request->trvl_mercredi === "on"){
                $jours_repos[] = ["Mercredi"];
            }
            if($request->trvl_vendredi === "on"){
                $jours_repos[] = ["Vendredi"];
            }
            
            if($request->trvl_samedi === "on"){
                $jours_repos[] = ["Samedi"];
            }

            if($request->trvl_dimanche === "on"){
                $jours_repos[] = ["Dimanche"];
            } 
            
           

           if($system_client->save()){

            $jour = jour_de_repos::where('libelle', 'Mercredi')->first();
            if (!$jour) {
                jour_de_repos::create(['libelle' => 'Mercredi']);
            }

            $jour = jour_de_repos::where('libelle', 'Vendredi')->first();
            if (!$jour) {
                jour_de_repos::create(['libelle' => 'Vendredi']);
            }
            $jour = jour_de_repos::where('libelle', 'Samedi')->first();
            if (!$jour) {
                jour_de_repos::create(['libelle' => 'Samedi']);
            }
            $jour = jour_de_repos::where('libelle', 'Dimanche')->first();
            if (!$jour) {
                jour_de_repos::create(['libelle' => 'Dimanche']);
            }
            
            foreach ($jours_repos as $jour) {
                $jour = jour_de_repos::Where("libelle", $jour[0])->first();
                jour_de_repo_system_client::create([
                    'system_client_id' => $system_client->id,
                    'jour_de_repo_id' => $jour->id,
                ]);
            }

                $dt        = Carbon::now();
                $todayDate = $dt->toDayDateTimeString();

               $user = User::create([
                    'name' => $request->name,
                    'last_stname' => $request->last_stname,
                    'user_name' => $username,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'join_date' => $todayDate,
                    'phone_number' => $request->phone_number,
                    'second_phone_number' => $request->second_phone_number,
                    'status' => 'actif',
                    'fonction' => $request->fonction,
                    'system_client_id' => $system_client->id,
                    'password' => Hash::make($request->password),
                ]);
           };
           
            toastr()->success('Bienvenue, '.$user->name.'. Connectez-vous maintenant!', $system_client->deno_sociale);

            return redirect('login');
        } catch(\Exception $e) {
            Log::info($e);
            DB::rollback();
            toastr()->error('Nous avons rencontré un problème!','Erreur');
            return redirect()->back();
        }
    }
}
  
}