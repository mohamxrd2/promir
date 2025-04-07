<?php

namespace App\Http\Controllers;

use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\DettesClients;
use App\Models\LigneVente;
use App\Models\Ventes;
use Illuminate\Http\Request;
// use Carbon\Carbon;

class AvanceClientController extends Controller
{
    public function index() {
        // $today = Carbon::today();
        $system_id = MainClass::getSystemId();
        $ventes = Ventes::whereHas('lignClientSystem.systemClient', function ($query) {
            $query->where('id', MainClass::getSystemId());
        })
            ->whereHas('lignesVente.avanceClient', function($query){
                $query->where('estFinalisee', false);
            })
            ->where('type_vente', 'Produits non transformés')
            ->with(['lignClientSystem', 'lignesVente.systemeProduit.produit.categorie'])->latest()->get();
        // })->whereDate('created_at', Carbon::today())->where('type_vente', 'Produits non transformés')->with(['lignClientSystem', 'lignesVente.systemeProduit.produit.categorie'])->latest()->get();
        return view("avances.avances_clients", compact(["ventes"]));
    }


    public function finaliserAvance(Request $request){
        $ligneVente = LigneVente::findOrFail($request->avanceId);
        
        if($request->reste_a_regler != 0){
            DettesClients::create([
                'montant' => $request->reste_a_regler,
                'ligne_vente_id' => $ligneVente->id,
            ]);
        };

        $avanceClient = $ligneVente->avanceClient;
        $avanceClient->estFinalisee = 1;
        if($ligneVente->has('systemeProduit')){
            $ligneVente->systemeProduit->qte_stck -= $ligneVente->quantite_vendue;
            $ligneVente->systemeProduit->update();
            $avanceClient->update();
            return response()->json(["SUCCES"=>true]);
        }elseif($ligneVente->has('produitTransforme')){
            $ligneVente->produitTransforme->qte_en_portions -= $ligneVente->quantite_vendue;
            $ligneVente->produitTransforme->update();
            $avanceClient->update();
            return response()->json(["SUCCES"=>true]);
        }elseif($ligneVente->has('service')){}

        return response()->json(["SUCCES"=>false]);
    }
}