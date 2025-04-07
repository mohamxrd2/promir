<?php

namespace App\Http\Controllers;

use App\Classes\CalculationsClass;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $today = Carbon::today()->format('Y-m-d');
        session([
            'chiffre_affaire' => CalculationsClass::chiffreAffaire($today, $today),
            'productivite_par_employe' => CalculationsClass::productivitePersonnel($today, $today),
            'chages_directes' => CalculationsClass::chargesDirectes($today, $today),
            'chages_indirectes_du_jour' => CalculationsClass::portionJournaliereChagesIndirectes(),
            'portionJournaliereDetteFournisseur' => CalculationsClass::portionJournaliereDetteFournisseur(),
            'portionJournaliereDetteFinanciere' => CalculationsClass::portionJournaliereDetteFinanciere(),
            'nombre_empoyes' => CalculationsClass::nombreEmpoyes(),
            'rentabilite_economique' => CalculationsClass::rentabiliteEconomique($today, $today),
            'rentabilite_financiere' => CalculationsClass::rentabiliteFinanciere($today, $today),
            'poids_charges_directes_production' => CalculationsClass::poidsChargesDirectesProduction($today, $today),
            'poids_charges_indirectes_production' => CalculationsClass::poidsChargesIndirectesProduction($today, $today),
            'poidsCharges_directes_exploitation' => CalculationsClass::poidsChargesDirectesExploitation($today, $today),
        ]);
        return view('dashboard.home');
    }
}