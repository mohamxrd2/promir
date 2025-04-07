<?php

namespace App\Http\Controllers\fournisseur;

use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\Fournisseurs;
use App\Models\LigneFournisseursSysteme;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FournisseurController extends Controller
{
    public function index(){
        $systm_client_id = auth()->user()->system_client->id;
        $fournisseurs = LigneFournisseursSysteme::where('system_client_id', $systm_client_id)->with('fournisseur')->get();
        $fourns = Fournisseurs::select('fournisseurs.*')
        ->leftJoin('ligne_fournisseurs_systemes', function($join) {
            $join->on('fournisseurs.id', '=', 'ligne_fournisseurs_systemes.fournisseur_id')
            ->where('ligne_fournisseurs_systemes.system_client_id', '=', auth()->user()->system_client->id);
        })
        ->whereNull('ligne_fournisseurs_systemes.fournisseur_id')
        ->get();
        
        return view('fournisseurs.fournisseurs', compact(['fournisseurs', 'fourns']));
    }


    public function store(Request $request){
        $fournisseur = Fournisseurs::where('email', $request->email)
        ->where('type', $request->type)
        ->where('nom', $request->nom)
        ->where('adresse', $request->adresse)
        ->where('email', $request->email)
        ->where('phone', $request->phone)
        ->where('region', $request->region)
        ->where('departement', $request->departement)
        ->where('pays', $request->pays)
        ->where('localite', $request->localite)
        ->first();
      
        if($fournisseur){
            $m = ',email,'.$fournisseur->id;
            $p = ',phone,'.$fournisseur->id;
        }else{
            $m = '';
            $p = '';
        }
      
        
        $validator = Validator::make($request->all(), $this->rulesAndMessages('store', $m, $p)['rules'], $this->rulesAndMessages('store', $m, $p)['messages']);
            
      
        if($fournisseur) {if (LigneFournisseursSysteme::where('system_client_id', auth()->user()->system_client->id)->where('fournisseur_id', $fournisseur->id)->exists()) {return response()->json(['duplication' => 'Ce fournisseur est déjà enregistré.']);}}
          
      
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
      }
        
        
      
        if($fournisseur){
           
      
          LigneFournisseursSysteme::create(
            [
              'system_client_id' => auth()->user()->system_client->id,
              'fournisseur_id' => $fournisseur->id,
            ]
          );
          
        }elseif(!$fournisseur){
          $fournisseur = Fournisseurs::create([
            'type' => $request->type,
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'email' => $request->email,
            'phone' => $request->phone,
            'pays' => $request->pays,
            'seconde_phone' => $request->seconde_phone,
            'region' => $request->region,
            'departement' => $request->departement,
            'localite' => $request->localite,
          ]);
      
          LigneFournisseursSysteme::create(
            [
              'system_client_id' => auth()->user()->system_client->id,
              'fournisseur_id' => $fournisseur->id,
            ]
          );
        }
          return response()->json(["message" => "Fournisseur defini avec succès!"]);
      }









      public function ligneFournisseurProperties(Request $request){
        $lignefournisseur = LigneFournisseursSysteme::with('fournisseur')->findOrFail($request->idFournisseur);
        return response()->json(['lignefournisseur' => $lignefournisseur]);
      }
      
      public function fournisseurProperties(){
        $query = request()->query('query');
        $fournisseur = Fournisseurs::findOrFail($query);
        return response()->json($fournisseur);
      }

      public function rechercherFournisseursPresents () {
        $terme = "%" . request()->query('query')."%";
        try{
            $lignesFounisseurs = LigneFournisseursSysteme::where('system_client_id', MainClass::getSystemId())
            ->whereHas('fournisseur', function($query) use ($terme) {
              $query->where('nom', 'like', $terme)->orWhere('phone', 'like', $terme)->orWhere('email', 'like', $terme);
            })->with('fournisseur')->get();

            return response()->json(['lignesFounisseurs' => $lignesFounisseurs]);
        }catch(\Exception $e){
            return response()->json(['other_error' => $e]);
        }
          
      }


















      private function rulesAndMessages($functionName, $ignore1 = null, $ignore2 = null){
        if($functionName == 'edite'){
          $rulesAndMessages['rules'] = [
            'type' => 'required|string|max:60',
            'nom' => 'required|string|max:60',
            'adresse' => 'required|string|max:60',
            'email' => 'required|string|email|max:60|unique:fournisseurs,email,'.$ignore1,
            'phone' => 'required|string|max:20|unique:fournisseurs,phone,'.$ignore1,
            'seconde_phone' => 'nullable|string|max:20|unique:fournisseurs'.$ignore1,
            'pays' => 'required|string',
            'region' => 'required|string',
            'departement' => 'required|string',
            'localite' => 'required|string',
          ];
        }elseif($functionName == 'store'){
          $rulesAndMessages['rules'] = [
            'type' => 'required|string|max:60',
            'nom' => 'required|string|max:60',
            'adresse' => 'required|string|max:60',
            'email' => 'required|string|email|max:60|unique:fournisseurs'.$ignore1,
            'phone' => 'required|string|max:20|unique:fournisseurs'.$ignore2,
            'seconde_phone' => 'nullable|string|max:20|unique:fournisseurs'.$ignore2,
            'pays' => 'required|string',
            'region' => 'required|string',
            'departement' => 'required|string',
            'localite' => 'required|string',
          ];
        }
        

        $rulesAndMessages['messages'] = [       
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
          
          'pays.required' => 'Le champ "Pays" est requis.',
          'pays.string' => 'Le pays doit être une chaîne de caractères.',
          
          'seconde_phone.required' => 'Champ requis',
          'seconde_phone.string' => 'Chaîne de caractères requise',
          'seconde_phone.max' => 'Max de :max caractères requis',
          'seconde_phone.unique' => 'Déjà utilisé',
         
          'region.required' => 'Champ requis.',
          'region.string' => 'Chaîne de caractères requise.',

          'departement.required' => 'Champ requis.',
          'departement.string' => 'Chaîne de caractères requise.',

          'localite.required' => 'Champ requis.',
          'localite.string' => 'Chaîne de caractères requise.',
        ];

        return $rulesAndMessages;
      }

      public function edite(Request $request){
        $id = $request->fournisseur_fournisseur_id;
        $validator = Validator::make($request->all(),$this->rulesAndMessages('edite', $id)['rules'], $this->rulesAndMessages('edite', $id)['messages']);
        
      
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
      }
    
      $fournisseur = Fournisseurs::findOrFail($request->fournisseur_fournisseur_id);
      $fournisseur->type = $request->type;
      $fournisseur->nom = $request->nom;
      $fournisseur->adresse = $request->adresse;
      $fournisseur->email = $request->email;
      $fournisseur->phone = $request->phone;
      $fournisseur->pays = $request->pays;
      $fournisseur->ville = $request->ville;
  
      
      $ligne_fournisseur = LigneFournisseursSysteme::findOrFail($request->fournisseur_id);
     
      
      if($fournisseur->update() && $ligne_fournisseur->update()){
        return response()->json(["SUCCES!"=>true]);
      }

      return response()->json("ERREUR!");
    }

    public function delete($id){
        try {
            $fournisseur = LigneFournisseursSysteme::findOrFail($id);
            $fournisseur->delete();
            return redirect()->back()->with(toastr()->success('Fournisseur supprimé!', 'OK'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Fournisseur non trouvé!', 'Erreur'));
        }
    }
}

