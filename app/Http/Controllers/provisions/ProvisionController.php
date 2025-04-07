<?php

namespace App\Http\Controllers\provisions;

use App\Classes\CalculationsClass;
use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\Charges;
use App\Models\DetteFinanciere;
use App\Models\DetteFournisseur;
use App\Models\DettesClients;
use App\Models\PlansEpargne;
use App\Models\Provision;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProvisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        
        $today = Carbon::today()->format('Y-m-d');
        $revenus = CalculationsClass::chiffreAffaire($today, $today) - CalculationsClass::depensesRegleesSurPlace($today, $today);
        
        
        
        $detteFournisseurs = DetteFournisseur::whereHas('approvisionnementSystemProduit.produitsBrut', function($query){
            $query->where('system_client_id', MainClass::getSystemId());
        })
        ->whereRaw('montant > montant_paye')
        ->whereDate('date_effet', '<' , $today)
        ->with('approvisionnementSystemProduit.approvisionnement.ligneFournisseur.fournisseur')
        ->with('provision')
        ->get(); 
        
        
        $autresDetteFinancieres = DetteFinanciere::where('system_client_id', MainClass::getSystemId())
        ->whereRaw('(montant_emprunte + montant_interet) > montant_paye')
        ->whereDate('date_effet', '<' , $today)
        ->whereDoesntHave('banque')
        ->with('provision')
        ->get();
        
        

        $detteBancaires = DetteFinanciere::where('system_client_id', MainClass::getSystemId())
        ->whereRaw('(montant_emprunte + montant_interet) > montant_paye')
        ->whereDate('date_effet', '<' , $today)
        ->whereHas('banque')
        ->with('banque')
        ->with('provision')
        ->get();

        $charges = Charges::where('system_client_id', MainClass::getSystemId())
        ->where("type", "!=", "Variable")
        ->with('provision')
        ->get();
        


        $epargnes = PlansEpargne::where('system_client_id', MainClass::getSystemId())
        ->with('provision')
        ->get();

        
        return view('provisions.provisions', compact(['detteFournisseurs', 'charges', 'epargnes', 'revenus', 'today', 'detteBancaires', 'autresDetteFinancieres']));


    }

    /**
     * Store a newly created resource in storage.
     */

    
    
     
    public function store(Request $request)
    {
        $detteFournisseurs = $request->dette_fournisseurs;
        $dettesBancaires = $request->dettes_bancaires;
        $autresDettesFinancieres = $request->autresDettes_financieres;
        $charges = $request->charges_;
        $epargnes = $request->epargnes_;

        
        foreach($detteFournisseurs as $detteFournisseur => $prov){
            if($prov != null){
               $dette = DetteFournisseur::with('provision')->findOrFail($detteFournisseur);
               if($dette){
                    if($dette->provision){
                        $dette->provision->montant += $prov;
                        $dette->provision->update();
                    }else{
                        $dette->provision()->create([
                            'montant' => $prov,
                        ]);
                    }
               }
            }
        }
        
        
        foreach($dettesBancaires as $dettesBancaire => $prov){
            if($prov != null){
               $dette = DetteFinanciere::with('provision')->findOrFail($dettesBancaire);
               if($dette){
                    if($dette->provision){
                        $dette->provision->montant += $prov;
                        $dette->provision->update();
                    }else{
                        $dette->provision()->create([
                            'montant' => $prov,
                        ]);
                    }
               }
            }
        }
        
        
        foreach($autresDettesFinancieres as $autresDettesFinanciere => $prov){
            if($prov != null){
               $dette = DetteFinanciere::with('provision')->findOrFail($autresDettesFinanciere);
               if($dette){
                    if($dette->provision){
                        $dette->provision->montant += $prov;
                        $dette->provision->update();
                    }else{
                        $dette->provision()->create([
                            'montant' => $prov,
                        ]);
                    }
               }
            }
        }
        
        
        foreach($charges as $charge => $prov){
            if($prov != null){
               $ch = Charges::with('provision')->findOrFail($charge);
               if($ch){
                    if($ch->provision){
                        $ch->provision->montant += $prov;
                        $ch->provision->update();
                    }else{
                        $ch->provision()->create([
                            'montant' => $prov,
                        ]);
                    }
               }
            }
        }


        foreach($epargnes as $epargne => $prov){
            if($prov != null){
               $ep = PlansEpargne::with('provision')->findOrFail($epargne);
               if($ep){
                    if($ep->provision){
                        $ep->provision->montant += $prov;
                        $ep->provision->update();
                    }else{
                        $ep->provision()->create([
                            'montant' => $prov,
                        ]);
                    }
               }
            }
        }
        return response()->json(['OK' =>true]);
    }

    /**
     * Display the specified resource.
     */



    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
