<?php

namespace App\Http\Controllers\contrat;

use App\Http\Controllers\Controller;
use App\Models\PaieSalarier;
use App\Models\Personnel;
use Illuminate\Http\Request;

class FichePaieController extends Controller
{
    public function index(){
        return view("personnel.fiches_paie");
    }
    
    public function rechercherFiche(Request $request){
       
        if(!$request->dateDebut || !$request->dateFin ){
            return response()->json(["dateIncorrecte" =>true]);
        }
        

        if(!$request->matricule){
            return response()->json(["matriculeIncorrecte" =>true]);
        }

        try{
            $personnel = Personnel::where("matricule", $request->matricule)->first();
            
            if(!$personnel){
                return response()->json(["matriculeIncorrecte" =>true]);
            }

            $periode = "Du $request->dateDebut Au $request->dateFin";
            try{
                $fiche = PaieSalarier::with("personnel.systeme_client")->with("personnel.contrat")->where("personnel_id", $personnel->id)->where("periode_paie", $periode)->firstOrFail();
            }catch(\Exception $e){
                return response()->json(["ficheNonTrouvee" =>true]);
            }
           
            return response()->json(["fiche" =>$fiche]);
        }catch(\Exception $e){
            return response()->json(["autreProbleme" =>$e->getMessage()]);
        }
    }
}