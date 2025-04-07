<?php

namespace App\Http\Controllers\impayes;

use App\Exports\Test;
use App\Http\Controllers\Controller;
use App\Classes\MainClass;
use App\Models\ImpayeVente;


class ImpayeController extends Controller
{
    public function index(){
        $impayesProduitBruts = ImpayeVente::whereHas('ligneVente', function($query){
            $query->whereHas('systemeProduit', function($query){
                $query->where('system_client_id', MainClass::getSystemId());
            });
        })->where('somme', '>', 0)->with('ligneVente.systemeProduit.produit')->get();
        
        return view('impayes.impayes', compact(['impayesProduitBruts']));
    }
    
    public function impayePT(){
        $impayesPT = ImpayeVente::whereHas('ligneVente', function($query){
            $query->whereHas('produitTransforme', function($query){
                $query->whereHas('productions', function($query){
                    $query->whereHas('produitsBruts', function ($query){
                        $query->where('system_client_id', MainClass::getSystemId());
                    });
                });
            });
        })->where('somme', '>', 0)->with('ligneVente.produitTransforme')->get();
        return view('impayes.impayesPT', compact(['impayesPT']));
    }
    

    public function impayeService(){
        $impayeService = ImpayeVente::whereHas('ligneVente', function($query){
            $query->whereHas('service', function($query){
                $query->where('system_client_id', MainClass::getSystemId());
            });
        })->where('somme', '>', 0)->with('ligneVente.service')->get();
        return view('impayes.impayeService', compact(['impayeService']));
    }
}