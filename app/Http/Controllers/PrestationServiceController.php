<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dette;
use App\Models\Clients;
use App\Models\Payement;
use App\Models\Services;
use App\Models\Personnel;
use App\Classes\MainClass;
use Illuminate\Http\Request;
use App\Models\DettesClients;
use App\Models\System_produit;
use Illuminate\Validation\Rule;
use App\Models\PrestationService;
use App\Models\LigneClientSysteme;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PrestationServiceController extends Controller
{
    public function index(){
        $systemId = MainClass::getSystemId();
        $prestations = PrestationService::whereHas('service', function ($query) use ($systemId) {
            $query->where('system_client_id', $systemId);
        })->whereHas('payement')->whereDate('created_at', '<=', Carbon::today())->with(['client.client', 'service', 'payement', 'produits.produit.categorie', 'personnel.contrat'])->latest()->get();
        $produitsPresents = Services::where('system_client_id', $systemId)->get();
        $produitsUtilises = System_produit::where('system_client_id', $systemId)->with('produit.categorie')->orderBy('created_at')->get();
        $clientsNonPresents = Clients::select('clients.*')
            ->leftJoin('ligne_client_systemes as lcs', function($join) use ($systemId) {
                $join->on('clients.id', '=', 'lcs.client_id')
                     ->where('lcs.system_client_id', '=', $systemId);
            })
            ->whereNull('lcs.client_id')
            ->get();
        $clientsPresents = LigneClientSysteme::with('client')->where('system_client_id', operator: $systemId)->orderBy('created_at')->get();
        $agents = Personnel::whereHas('contrat')->with('contrat')->where('system_client_id', $systemId)->orderBy('created_at')->get();
        $nombreJoursTravailles = MainClass::getNumberOfWorkingDaysInThisMonth();
        return view("ventes.prestation-service", compact(["prestations","agents", "clientsPresents", "clientsNonPresents", "produitsPresents", "produitsUtilises", "nombreJoursTravailles"]));
    }

    public function renderServiceProperties(Request $request){
        return response()->json(Services::findOrFail($request->idService));
    }

    public function rechercherServices(Request $request) {
        $terme = "%$request->terme%";
        try {
            $services = Services::where('system_client_id', Mainclass::getSystemId())  // Filtre d'abord par system_client_id
                                ->where(function($query) use ($terme) {
                                    $query->where('reference', 'like', $terme)
                                          ->orWhere('designation', 'like', $terme);
                                })
                                ->orderBy('created_at')
                                ->get();
    
            return response()->json($services);
        } catch (\Exception $e) {
            return response()->json(['other_error' => $e->getMessage()], 500);
        }
    }
    


    public function rechercherProduits(Request $request) {
        $terme = "%$request->terme%";
        try {
            $produits = System_produit::whereHas('produit', function ($query) use ($terme) {
                $query->where('reference', 'like', $terme)
                      ->orWhere('designation', 'like', $terme);
            })->where('system_client_id',  MainClass::getSystemId())
              ->with('produit')
              ->orderBy('created_at')
              ->get();
            return response()->json($produits);
        } catch (\Exception $e) {
            return response()->json(['other_error' => $e->getMessage()], 500);
        }
    }
    

    public function rechercherEmployes(Request $request) {
        $terme = "%$request->terme%";
        try {
            $employes = Personnel::where('system_client_id', MainClass::getSystemId())
                                    ->where(function($query) use ($terme) {
                                        $query->where('matricule', 'like', $terme)
                                            ->orWhere('nom', 'like', $terme)
                                            ->orWhere('prenom', 'like', $terme);
                                    })
                                    ->whereHas("contrat")
                                    ->orderBy('created_at')
                                    ->get();
    
            return response()->json($employes);
        } catch (\Exception $e) {
            return response()->json(['other_error' => $e->getMessage()], 500);
        }
    }
    


    public function renderProduitAUtiliserProperties (Request $request) {
        try{
            $produit = System_produit::with('produit')->findOrFail($request->idProduit);
            return response()->json($produit);
        }catch(\Exception $e){
            return response()->json(['other_error' => true]);
        }
    }
    
    public function renderEmployeAUtiliserProperties (Request $request) {
        try{
            $employe = Personnel::with('contrat')->findOrFail($request->idEmploye);
            return response()->json($employe);
        }catch(\Exception $e){
            return response()->json(['other_error' => true]);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if(!($request->filled('reference')) && !($request->hasFile('fichier_joint'))){
            return response()->json(["problemeDeTraçabilite" => true]);
        }

        // if($request->type_de_vente == "Dépôt vente"){
        //     if(!$request->ligne_client_systeme){
        //         return response()->json(['clientRequis' =>true]);
        //     }
        // }


        $newPrestation = PrestationService::create([
            'service_id' => $request->service,
            'ligne_client_systeme_id' => $request->ligne_client_systeme,
            'montant_facture' => $request->montant_facture,
        ]);

        if($newPrestation){

            $payementPrestation = Payement::create([
                'montant' => $request->montant_regle,
                'moyen_payement' => $request->moyen_payement,
                'prestation_service_id' => $newPrestation->id,
            ]);

            $dette = $request->montant_facture - $request->montant_regle;

            if($dette>0){
                DettesClients::create([
                    'montant' => $dette,
                    'prestation_service_id' => $newPrestation->id,
                ]);
            }
            
            if($payementPrestation){
                MainClass::gererPreuvesPayement($request, $payementPrestation);
            }

            if($request->produits_utilise){
                foreach ($request->produits_utilise as $index => $produit) {
                    $newPrestation->produits()->attach($produit, [
                        'quantite' => $request->quantite_utilisee[$index],
                    ]);
                }
            }
            
            if($request->employes_utilise){
                foreach ($request->employes_utilise as $index => $employe) {
                    $nombreHeures = ($request->nombreHeures[$index] ?? 0) + ($request->nombreMinutes[$index] ?? 0) / 60;
                    $newPrestation->personnel()->attach($employe, [
                        'heures' => $nombreHeures,
                    ]);
                }
            }
        }
        return response()->json(['message' => "Prestation ajoutée."]);
    }


    public function delete($id){
        try {
            $prestation = PrestationService::findOrFail($id);
            foreach ($prestation->produits as $produit) {
                $produit->qte_stck += $produit->pivot->quantite;
                $produit->update();
            }
            $prestation->produits()->detach();
            $prestation->personnel()->detach();
            $prestation->payement()->delete();
            $prestation->dette()->delete();
            $prestation->delete();

            return redirect()->back()->with(toastr()->success('Prestation supprimée!'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Prestation non trouvée!'));
        }catch(\Exception $e){
            return redirect()->back()->with(toastr()->error('Un problème est survenu! Veuillez recommencer...'));
        }
    }



    private function rules(){
        return [
            'ligne_client_systeme' => 'required|exists:ligne_client_systemes,id',
            'service' => 'required|exists:services,id',
            'montant_facture' => 'required|numeric|max:9999999999|min:0.00001',
            'montant_regle' => 'required|numeric|max:9999999999|min:0.00001',
            'moyen_payement' => ['required', 'string', Rule::in(['Payement BIICF', 'Cash', 'Wave', 'Orange money','Moov money','MTN money','Trasor money'])],
            'reference' => 'nullable|string|max:255|unique:payements,reference,NULL,reference',
            'fichier_joint' => 'file|mimes:pdf,png,jpeg,jpg|max:2048',
            'produits_utilise.*' => 'required|exists:system_produits,id',
            'quantite_utilisee.*' => 'required|numeric|max:9999999999|min:0.00001',
            'employes_utilise.*' => 'required|exists:personnels,id',
            'nombreHeures.*' => 'required|integer|max:8760|min:0',
            'nombreMinutes.*' => 'required|integer|max:59|min:0',
        ];
    }
    
    private function messages(){
        return [
            'ligne_client_systeme.exists' => 'Problème inconnu',
            'ligne_client_systeme.required' => 'Champ requis!',
            
            'service.exists' => 'Problème inconnu',
            'service.required' => 'Champ requis!',
            
            'montant_facture.required' => 'Montant requis',
            'montant_facture.max' => 'Montant trop grand',
            'montant_facture.min' => 'Montant trop petit',
            'montant_facture.numeric' => 'Nombre requis',
            
            'montant_regle.required' => 'Montant requis',
            'montant_regle.max' => 'Montant trop grand',
            'montant_regle.min' => 'Montant trop petit',
            'montant_regle.numeric' => 'Nombre requis',
            
            'moyen_payement.required' => 'Champ requis',
            'moyen_payement.in' => 'Moyen invalide',
            
            'reference.max' => 'Max de :max caractères requis',
            'reference.unique' => 'Déjà utilisée',
            
            'fichier_joint.file' => 'Fichier invalide',
            'fichier_joint.mimes' => 'Types valides: :values',
            'fichier_joint.max' => '2MB Max',
            
            'produits_utilise.*.exists' => 'Problème inconnu',
            'produits_utilise.*.required' => 'Champ requis!',
            
            'quantite_utilisee.*.required' => 'Quantité requise',
            'quantite_utilisee.*.max' => 'Quantité trop grande',
            'quantite_utilisee.*.min' => 'Quantité trop petite',
            'quantite_utilisee.*.numeric' => 'Nombre requis',
            
            'employes_utilise.*.exists' => 'Problème inconnu',
            'employes_utilise.*.required' => 'Champ requis!',

            'nombreHeures.*.required' => 'Champ requis',
            'nombreHeures.*.max' => 'Valeur trop grande',
            'nombreHeures.*.min' => 'Valeur trop petite',
            'nombreHeures.*.integer' => 'Entier requis',

            'nombreMinutes.*.required' => 'Champ requis',
            'nombreMinutes.*.max' => 'Valeur trop grande',
            'nombreMinutes.*.min' => 'Valeur trop petite',
            'nombreMinutes.*.integer' => 'Entier requis',
        ];
    }
}
