<?php

namespace App\Http\Controllers;

use App\Classes\CalculationsClass;
use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\ComptesBancaires;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComptesBancairesController extends Controller
{
    public function index(){
        $comptes = ComptesBancaires::where('system_client_id', MainClass::getSystemId())->orderBy('date_creation')->get();
        return view('comptes.comptes', compact(['comptes']));
    }

    public function delete($id){
        try {
            $compte = ComptesBancaires::findOrFail($id);
            $compte->delete();
            return redirect()->back()->with(toastr()->success('Compte supprimé.', 'OK'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Compte non trouvé.', 'Erreur'));
        }
    }

    public function store(Request $request){

        
        $messages = [
            'numero_iban.required' => 'Un numéro IBAN est requis.',
            'numero_iban.string' => 'Le numéro IBAN doit être une chaîne de caractères.',
            'numero_iban.max' => 'Le numéro IBAN ne doit pas dépasser :max caractères.',
            'numero_iban.unique' => 'Ce numéro IBAN est déjà utilisé.',
            'numero_bic.string' => 'Le numéro BIC doit être une chaîne de caractères.',
            'numero_bic.required' => 'Un numéro BIC est requis.',
            'numero_bic.max' => 'Le numéro BIC ne doit pas dépasser :max caractères.',
            'numero_bic.unique' => 'Ce numéro BIC est déjà utilisé.',
            'solde.numeric' => 'Le solde doit être un nombre.',
            'solde.required' => 'Le solde est requis.',
            'devise.string' => 'La devise doit être une chaîne de caractères.',
            'devise.required' => 'Une devise est requise.',
            'devise.max' => 'La devise ne doit pas dépasser :max caractères.',
            'type.string' => 'Le type doit être une chaîne de caractères.',
            'type.required' => 'Un type est requis.',
            'code_banque.string' => 'Le code de la banque doit être une chaîne de caractères.',
            'code_banque.required' => 'Le code de la banque est requis.',
            'code_banque.max' => 'Le code de la banque ne doit pas dépasser :max caractères.',
            'code_banque.unique' => 'Ce code de banque est déjà utilisé.',
            'code_guichet.string' => 'Le code guichet doit être une chaîne de caractères.',
            'code_guichet.required' => 'Le code guichet est requis.',
            'code_guichet.max' => 'Le code guichet ne doit pas dépasser :max caractères.',
            'code_guichet.unique' => 'Ce code guichet est déjà utilisé.',
            'cle_iban.string' => 'La clé IBAN doit être une chaîne de caractères.',
            'cle_iban.unique' => 'Cette clé IBAN est déjà utilisée.',
            'cle_iban.required' => 'La clé IBAN est requise.',
            'cle_iban.max' => 'La clé IBAN ne doit pas dépasser :max caractères.',
            'cle_rib.string' => 'La clé RIB doit être une chaîne de caractères.',
            'cle_rib.required' => 'La clé RIB est requise.',
            'cle_rib.max' => 'La clé RIB ne doit pas dépasser :max caractères.',
            'cle_rib.unique' => 'Cette clé RIB est déjà utilisée.',
            'domiciliation.string' => 'La domiciliation doit être une chaîne de caractères.',
            'domiciliation.required' => 'La domiciliation est requise.',
            'domiciliation.max' => 'La domiciliation ne doit pas dépasser :max caractères.',
            'numero_compte.string' => 'Le numéro de compte doit être une chaîne de caractères.',
            'numero_compte.required' => 'Le numéro de compte est requis.',
            'numero_compte.max' => 'Le numéro de compte ne doit pas dépasser :max caractères.',
            'numero_compte.unique' => 'Ce numéro de compte est déjà utilisé.',
        ];
           


        $validator = Validator::make($request->all(), [
            'numero_iban' => 'required|string|max:40|unique:comptes_bancaires',
            'numero_bic' => 'string|required|max:40|unique:comptes_bancaires',
            'solde' => 'numeric|required',
            'devise' => 'string|required|max:10',
            'type' => 'string|required',
            'code_banque' => 'string|required|max:40|unique:comptes_bancaires',
            'code_guichet' => 'string|required|max:40|unique:comptes_bancaires',
            'cle_rib' => 'string|required|max:40|unique:comptes_bancaires',
            'cle_iban' => 'string|required|max:40|unique:comptes_bancaires',
            'domiciliation' => 'string|max:40|required',
            'numero_compte' => 'string|max:40|required|unique:comptes_bancaires',
            ],
            $messages
        );
        
        
        
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        ComptesBancaires::create(
            [
              'numero_iban' => $request->numero_iban,
              'numero_bic' => $request->numero_bic,
              'solde' => $request->solde,
              'devise' => $request->devise,
              'type' => $request->type,
              'code_banque' => $request->code_banque,
              'code_guichet' => $request->code_guichet,
              'cle_rib' => $request->cle_rib,
              'domiciliation' => $request->domiciliation,
              'numero_compte' => $request->numero_compte,
              'cle_iban' => $request->cle_iban,
              'date_creation' => Carbon::now()->format('d/m/Y H:i:s') ?? null,
              'system_client_id' => auth()->user()->system_client->id,
            ]
        );
        
        return response()->json(["message" => "Ajout éffectué avec succès."]);
    }

    public function edite(Request $request){

        $messages = [
            'numero_iban.required' => 'Un numéro IBAN est requis.',
            'numero_iban.string' => 'Le numéro IBAN doit être une chaîne de caractères.',
            'numero_iban.max' => 'Le numéro IBAN ne doit pas dépasser :max caractères.',
            'numero_iban.unique' => 'Ce numéro IBAN est déjà utilisé.',
            'numero_bic.string' => 'Le numéro BIC doit être une chaîne de caractères.',
            'numero_bic.required' => 'Un numéro BIC est requis.',
            'numero_bic.max' => 'Le numéro BIC ne doit pas dépasser :max caractères.',
            'numero_bic.unique' => 'Ce numéro BIC est déjà utilisé.',
            'solde.numeric' => 'Le solde doit être un nombre.',
            'solde.required' => 'Le solde est requis.',
            'devise.string' => 'La devise doit être une chaîne de caractères.',
            'devise.required' => 'Une devise est requise.',
            'devise.max' => 'La devise ne doit pas dépasser :max caractères.',
            'type.string' => 'Le type doit être une chaîne de caractères.',
            'type.required' => 'Un type est requis.',
            'code_banque.string' => 'Le code de la banque doit être une chaîne de caractères.',
            'code_banque.required' => 'Le code de la banque est requis.',
            'code_banque.max' => 'Le code de la banque ne doit pas dépasser :max caractères.',
            'code_banque.unique' => 'Ce code de banque est déjà utilisé.',
            'code_guichet.string' => 'Le code guichet doit être une chaîne de caractères.',
            'code_guichet.required' => 'Le code guichet est requis.',
            'code_guichet.max' => 'Le code guichet ne doit pas dépasser :max caractères.',
            'code_guichet.unique' => 'Ce code guichet est déjà utilisé.',
            'cle_iban.string' => 'La clé IBAN doit être une chaîne de caractères.',
            'cle_iban.unique' => 'Cette clé IBAN est déjà utilisée.',
            'cle_iban.required' => 'La clé IBAN est requise.',
            'cle_iban.max' => 'La clé IBAN ne doit pas dépasser :max caractères.',
            'cle_rib.string' => 'La clé RIB doit être une chaîne de caractères.',
            'cle_rib.required' => 'La clé RIB est requise.',
            'cle_rib.max' => 'La clé RIB ne doit pas dépasser :max caractères.',
            'cle_rib.unique' => 'Cette clé RIB est déjà utilisée.',
            'domiciliation.string' => 'La domiciliation doit être une chaîne de caractères.',
            'domiciliation.required' => 'La domiciliation est requise.',
            'domiciliation.max' => 'La domiciliation ne doit pas dépasser :max caractères.',
            'numero_compte.string' => 'Le numéro de compte doit être une chaîne de caractères.',
            'numero_compte.required' => 'Le numéro de compte est requis.',
            'numero_compte.max' => 'Le numéro de compte ne doit pas dépasser :max caractères.',
            'numero_compte.unique' => 'Ce numéro de compte est déjà utilisé.',
        ];

            $validator = Validator::make($request->all(), [
            'numero_iban' => 'required|string|max:40|unique:comptes_bancaires,numero_iban,' .$request->id_compte,
            'numero_bic' => 'string|required|max:40|unique:comptes_bancaires,numero_bic,' .$request->id_compte,
            'code_banque' => 'string|required|max:40|unique:comptes_bancaires,code_banque,'.$request->id_compte,
            'code_guichet' => 'string|required|max:40|unique:comptes_bancaires,code_guichet,'.$request->id_compte,
            'cle_rib' => 'string|required|max:40|unique:comptes_bancaires,cle_rib,'.$request->id_compte,
            'cle_iban' => 'string|required|max:40|unique:comptes_bancaires,cle_iban,'.$request->id_compte,
            'numero_compte' => 'string|max:40|required|unique:comptes_bancaires,numero_compte,'.$request->id_compte,
            'domiciliation' => 'string|max:40|required',
            'solde' => 'numeric|required',
            'devise' => 'string|required|max:4',
            'type' => 'string|required',
        ],
        $messages
    );
        
        

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $compte = ComptesBancaires::findOrFail($request->id_compte);
        
        $compte->numero_iban = $request->numero_iban;
        $compte->numero_bic = $request->numero_bic;
        $compte->solde = $request->solde;
        $compte->devise = $request->devise;
        $compte->type = $request->type;
        $compte->code_banque = $request->code_banque;
        $compte->code_guichet = $request->code_guichet;
        $compte->cle_rib = $request->cle_rib;
        $compte->domiciliation = $request->domiciliation;
        $compte->numero_compte = $request->numero_compte;
        $compte->cle_iban = $request->cle_iban;

        if($compte->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }

}
