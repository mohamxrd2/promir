<?php

namespace App\Http\Controllers\services;

use App\Classes\MainClass;
use App\Models\Produit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;


class ServicesController extends Controller
{



    
    
    function callFunctionReference(){
      return response()->json(MainClass::generateReference('REFSRCE', Produit::class));
    }

    public function index(){
        $services = Services::where('system_client_id', MainClass::getSystemId())->orderBy('designation')->get();
        return view('services.services', compact(['services']));
    }
    


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'reference' => 'required|string|max:40|unique:services',
            'designation' => 'required|max:50',
            'description' => 'nullable|max:110',
            'prix_unitaire' => 'required|numeric',
        ],
        [
            'reference.required' => 'La reference est requise.',
            'reference.max' => 'La reference ne doit pas dépasser :max caractères.',
            'reference.unique' => 'Cette reference est déjà utilisée.',
            'designation.required' => 'La designation est requise.',
            'designation.max' => 'La designation ne doit pas dépasser :max caractères.',
            'type_emploim.required' => 'Le type d\'emploi est requis.',
            'description.max' => 'La description ne doit pas dépasser :max caractères.',
            'prix_unitaire.required' => 'Le prix unitaire est requis.',
            'prix_unitaire.numeric' => 'Le prix unitaire doit être un nombre.',
        ]);
        
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        Services::create(
            [
              'reference' => $request->reference,
              'designation' => $request->designation,
              'description' => $request->description ?? null,
              'prix_unitaire' => $request->prix_unitaire,          
              'system_client_id' => MainClass::getSystemId(),
            ]
        );
        
        return response()->json(["message" => "Service defini avec succès!"]);
    }




    public function edite(Request $request){

        $validator = Validator::make($request->all(), [
            'reference' => 'required|string|max:40|unique:services,reference,'.$request->id_service,
            'designation' => 'required|max:50',
            'description' => 'nullable|max:110',
            'prix_unitaire' => 'required|numeric',
        ],
        [
            'reference.required' => 'La reference est requise.',
            'reference.max' => 'La reference ne doit pas dépasser :max caractères.',
            'reference.unique' => 'Cette reference est déjà utilisée.',
            'designation.required' => 'La designation est requise.',
            'designation.max' => 'La designation ne doit pas dépasser :max caractères.',
            'type_emploim.required' => 'Le type d\'emploi est requis.',
            'description.max' => 'La description ne doit pas dépasser :max caractères.',
            'prix_unitaire.required' => 'Le prix unitaire est requis.',
            'prix_unitaire.numeric' => 'Le prix unitaire doit être un nombre.',
        ]);
        

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $service = Services::findOrFail($request->id_service);
        $service->reference = $request->reference;
        $service->designation = $request->designation;
        $service->description = $request->description;
        $service->prix_unitaire = $request->prix_unitaire;
        $modifie = $service->update();

        if($modifie){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json($service);
    }



    
    public function delete($id){
        try {
            $produit = Services::findOrFail($id);
            
            $produit->delete();
            
            return redirect()->back()->with(toastr()->success('Service supprimé!', 'OK'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Service non trouvé!', 'Erreur'));
        }
    }
    
    
    
}
