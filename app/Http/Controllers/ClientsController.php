<?php

namespace App\Http\Controllers;

use App\Classes\CalculationsClass;
use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\Clients;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Models\LigneClientSysteme;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(){
        $clients = LigneClientSysteme::where('system_client_id', MainClass::getSystemId())->with('client')->get();

        $cls = Clients::select('clients.*')
        ->leftJoin('ligne_client_systemes', function($join) {
          $join->on('clients.id', '=', 'ligne_client_systemes.client_id')
               ->where('ligne_client_systemes.system_client_id', '=', MainClass::getSystemId());
        })
        ->whereNull('ligne_client_systemes.client_id')
        ->get();

        return view('clients.clients', compact(['clients', 'cls']));
    }


    public function delete($id){
        try {
            $client = LigneClientSysteme::findOrFail($id);
            $client->delete();
            return redirect()->back()->with(toastr()->success('Client supprimée!', 'OK'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Client non trouvée!', 'Erreur'));
        }
    }


  

public function store(Request $request){
  $client = Clients::where('email', $request->email)
  ->where('type', $request->type)
  ->where('nom', $request->nom)
  ->where('adresse', $request->adresse)
  ->where('email', $request->email)
  ->where('phone', $request->phone)
  ->where('region', $request->region)
  ->where('departement', $request->departement)
  ->where('localite', $request->localite)
  ->where('pays', $request->pays)
  ->first();

  if($client){
      $m = ',email,'.$client->id;
      $p = ',phone,'.$client->id;
      $p2 = ',seconde_phone,'.$client->id;
  }else{
      $m = '';
      $p = '';
      $p2 = '';
  }


  $validator = Validator::make($request->all(), [
      'type' => 'required|string|max:60',
      'nom' => 'required|string|max:60',
      'region' => 'required|string|max:30',
      'departement' => 'required|string|max:30',
      'pays' => 'required|string',
      'localite' => 'required|string',
      'adresse' => 'required|string|max:60',
      'email' => 'required|string|email|max:60|unique:clients'.$m,
      'phone' => 'required|string|max:20|unique:clients'.$p,
      'seconde_phone' => 'nullable|string|max:20|unique:clients'.$p2,
  ], $this->renderMessages());
      

  if($client) {if (LigneClientSysteme::where('system_client_id', MainClass::getSystemId())->where('client_id', $client->id)->exists()) {return response()->json(['duplication' => 'Ce client est déjà enregistré.']);}}
    

if ($validator->fails()) {
  return response()->json(['errors' => $validator->errors()], 400);
}
  
  

  if($client){
    LigneClientSysteme::create(
      [
        'system_client_id' => MainClass::getSystemId(),
        'client_id' => $client->id,
      ]
    );
    
  }elseif(!$client){
    $client = Clients::create([
      'type' => $request->type,
      'nom' => $request->nom,
      'adresse' => $request->adresse,
      'email' => $request->email,
      'phone' => $request->phone,
      'seconde_phone' => $request->seconde_phone,
      'pays' => $request->pays,
      'region' => $request->region,
      'departement' => $request->departement,
      'localite' => $request->localite,
    ]);

    LigneClientSysteme::create(
      [
        'system_client_id' => MainClass::getSystemId(),
        'client_id' => $client->id,
      ]
    );
  }
    return response()->json(["message" => "Client defini avec succès!"]);
}


  public function edite(Request $request){

      $validator = Validator::make($request->all(), [
          'type' => 'required|string|max:60',
          'nom' => 'required|string|max:60',
          'region' => 'required|string|max:30',
          'departement' => 'required|string|max:30',
          'localite' => 'required|string',
          'adresse' => 'required|string|max:60',
          'email' => 'required|string|email|max:60|unique:clients,email,'.$request->client_client_id,
          'phone' => 'required|string|max:20|unique:clients,phone,'.$request->client_client_id,
          'seconde_phone' => 'required|string|max:20|unique:clients,seconde_phone,'.$request->client_client_id,
          'pays' => 'required|string',
      ], $this->renderMessages());
      
    
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 400);
    }
  
    $client = Clients::findOrFail($request->client_client_id);
    $client->type = $request->type;
    $client->nom = $request->nom;
    $client->adresse = $request->adresse;
    $client->email = $request->email;
    $client->phone = $request->phone;
    $client->seconde_phone = $request->seconde_phone;
    $client->region = $request->region;
    $client->departement = $request->departement;
    $client->localite = $request->localite;
    $client->pays = $request->pays;

    
    
    if($client->update()){
      return response()->json(["SUCCES!"=>true]);
    }

    return response()->json("ERREUR!");
  }


  private function renderMessages(){
    return [   
      'type.required' => 'Le champ "Type" est requis.',
      'type.string' => 'Le champ "Type" doit être une chaîne de caractères.',
      'type.max' => 'Le champ "Type" ne doit pas dépasser :max caractères.',
      
      'nom.required' => 'Le champ "Nom" est requis.',
      'nom.string' => 'Le champ "Nom" doit être une chaîne de caractères.',
      'nom.max' => 'Le champ "Nom" ne doit pas dépasser :max caractères.',
      
      'adresse.required' => 'Le champ "Adresse" est requis.',
      'adresse.string' => 'Le champ "Adresse" doit être une chaîne de caractères.',
      'adresse.max' => 'Le champ "Adresse" ne doit pas dépasser :max caractères.',
      
      'email.required' => 'Le champ "Email" est requis.',
      'email.string' => 'Le champ "Email" doit être une chaîne de caractères.',
      'email.email' => 'Veuillez entrer une adresse email valide.',
      'email.max' => 'Le champ "Email" ne doit pas dépasser :max caractères.',
      'email.unique' => 'Cet email est déjà utilisé.',
      
      'phone.required' => 'Le champ "Téléphone" est requis.',
      'phone.string' => 'Le champ "Téléphone" doit être une chaîne de caractères.',
      'phone.max' => 'Le champ "Téléphone" ne doit pas dépasser :max caractères.',
      'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',

      'seconde_phone.required' => 'Le champ "Téléphone" est requis.',
      'seconde_phone.string' => 'Le champ "Téléphone" doit être une chaîne de caractères.',
      'seconde_phone.max' => 'Le champ "Téléphone" ne doit pas dépasser :max caractères.',
      'seconde_phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',

      'region.required' => 'Le champ "Region" est requis.',
      'region.string' => 'Le champ "Region" doit être une chaîne de caractères.',
      'region.max' => 'Le champ "Region" ne doit pas dépasser :max caractères.',

      'departement.required' => 'Le champ "Departement" est requis.',
      'departement.string' => 'Le champ "Departement" doit être une chaîne de caractères.',
      'departement.max' => 'Le champ "Departement" ne doit pas dépasser :max caractères.',

      'localite.required' => 'La localité est requise.',
      'localite.string' => 'Le localité doit être une chaîne de caractères.',

      'pays.required' => 'Le champ "Pays" est requis.',
      'pays.string' => 'Le pays doit être une chaîne de caractères.',
    ];
  }  
  
  
  private function currentRouteNameIs(string $route): bool {
   return Route::currentRouteName() == $route;
  }



  public function renderClientsHavingDeleveryOrNot(Request $request){
    $typeVente = $request->typeVente;
    $clientsAvecLivraisons = null;
    if($this->currentRouteNameIs('render_clients_avec_type_vente_pb')){
      if($typeVente == "Dépôt vente"){
        $clientsAvecLivraisons = LigneClientSysteme::whereHas('livraisons', function($query){
          $query->whereHas('systemProduit');
        })->where('system_client_id', MainClass::getSystemId())->with('client')->get();
      }else{
        $clientsAvecLivraisons = LigneClientSysteme::where('system_client_id', MainClass::getSystemId())->with('client')->get();
      }
    }else if($this->currentRouteNameIs('render_clients_avec_type_vente_pt')){
      if($typeVente == "Dépôt vente"){
        $clientsAvecLivraisons = LigneClientSysteme::whereHas('livraisons', function($query){
          $query->whereHas('produitTransforme');
        })->where('system_client_id', MainClass::getSystemId())->with('client')->get();
      }else{
        $clientsAvecLivraisons = LigneClientSysteme::where('system_client_id', MainClass::getSystemId())->with('client')->get();
      }
    }
    return response()->json($clientsAvecLivraisons);
  }
}
