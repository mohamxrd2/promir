<?php

namespace App\Http\Controllers\approvisionnements;

use App\Http\Controllers\Controller;
use App\Models\Approvisionnement;
use App\Models\ApprovisionnementSystemProduit;
use App\Models\detteFournisseur;
use App\Models\LigneFournisseursSysteme;
use Illuminate\Http\Request;
use App\Models\approvisionnementProduitbrut;
use App\Models\Produit;
use App\Models\System_produit;
use App\Classes\MainClass;
use App\Models\Clients;
use App\Models\LigneClientSysteme;
use App\Models\ProduitTransforme;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Ventes;
use Carbon\Carbon;

class ApprovisionnementController extends Controller
{
    public function index() {
        $today = Carbon::today();
        $systemId = MainClass::getSystemId();
        $approvisionnements = Approvisionnement::whereHas('produitsBruts', function ($query) use ($systemId){
            $query->where('system_client_id', $systemId);
        })->whereDate('created_at', $today)
        ->with('produitsBruts')->with('ligneFournisseur.fournisseur')->latest()->get();

        $fournisseurs = LigneFournisseursSysteme::where('system_client_id', $systemId)->with('fournisseur')->get();

        $produitsPresents = System_produit::where('system_client_id', $systemId)->with('produit.categorie')->orderBy('created_at')->get();
        return view("approvisionements.approvisionements", compact(["approvisionnements", "fournisseurs", "produitsPresents"]));
    }


    public function delete($id){
        try {
            $approvisionnement = Approvisionnement::findOrFail($id);
            $approvisionnement->produitsBruts()->detach();
            $approvisionnement->delete();
            return redirect()->back()->with(toastr()->success('Approvisionnement supprimé!'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Approvisionnement non trouvé!'));
        }catch(\Exception $e){
            return redirect()->back()->with(toastr()->error('Une erreur s\'est produite!'));
        }
        
    }

    public function editeProdduitOfApprovisionnement(Request $request){

        $validator = Validator::make($request->all(), [
            'quantite_entree' => 'required|numeric|min:0.0001|max:9999999999',
            'prix_unitaire_achat' => 'required|numeric|min:0.0001|max:9999999999',
            'idProduit' => 'required|exists:approvisionnement_system_produit,id',
        ],


        [
            'quantite_entree.required' => 'La quantité est requise',
            'quantite_entree.numeric' => 'La quantité doit être un nombre',
            'quantite_entree.min' => 'Valeur non valide.',
            'quantite_entree.max' => 'Valeur trop grande (limite: :max)',
            'prix_unitaire_achat.required' => 'La quantité est requise',
            'prix_unitaire_achat.numeric' => 'La quantité doit être un nombre',
            'prix_unitaire_achat.min' => 'Valeur non valide.',
            'prix_unitaire_achat.max' => 'Valeur trop grande (limite: :max)',

            'idProduit.exists' => 'Problème inconnu',
            'idProduit.required' => 'Problème inconnu',
        ]);
    
    

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        $table = ApprovisionnementSystemProduit::findOrFail($request->idProduit);

        $table->quantite_entree = $request->quantite_entree;
        $table->prix_unitaire_achat = $request->prix_unitaire_achat;

        if($table->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }


    public function renderProduitsOfApprovisionnement(Request $request){
        
        $idApprovisionnement = request()->query('query');
        $Approvisionnement = Approvisionnement::with(['produitsBruts' => function($query) {
            $query->withPivot(['id', 'quantite_entree', 'prix_unitaire_achat'])->with('produit');
        }])->findOrFail($idApprovisionnement);
        
        $produitsApprovisionnes = $Approvisionnement->produitsBruts;
        return response()->json(['produitsApprovisionnes' => $produitsApprovisionnes]);

    }

    public function detach($idProduit,$idProduction){
        try{
            $approvisionnement = Approvisionnement::findOrFail($idProduction);
            $approvisionnement->produitsBruts()->detach($idProduit);
            if ($approvisionnement->produitsBruts()->count() === 0) {
                $approvisionnement->delete();
            }

        }catch(\Exception $e ){
            return redirect()->back()->with(toastr()->error("Nous avons rencontré une erreur."));
        }
        
        return redirect()->back()->with(toastr()->success("1 produit retiré avec succès."));

    }

    public function store(Request $request) {
        
        $validPayments = ['Payement BIICF', 'Cash', 'Wave', 'Orange money', 'Moov money', 'MTN money', 'Trasor money'];
        $rules = [
            'montant_paye' => ['required', 'numeric', 'min:1', 'max:99999999999'],
            'reference_payement' => ['required', 'string', 'min:1', 'max:60', 'unique:approvisionnements,reference_payement'],
            'description' => ['nullable', 'string', 'min:1', 'max:65534'],
            'produits.*' => 'required|integer',
            'quantite_entree.*' => 'required|numeric|min:0.00000001|max:99999999999',
            'prix_unitaire_achat.*' => 'required|numeric|min:0.00000001|max:99999999999',
            'moyen_payement' => ['required', 'string','max:40', Rule::in($validPayments)],
        ];
        
        $messages = [
            'produits.*.required' => 'Champ est requis',
            'produits.*.integer' => 'Doit être un entier.',
            'reference_payement.unique' => 'Déjà utilisée.',

            'quantite_entree.*.required' => 'Champ requis',
            'quantite_entree.*.numeric' => 'Doit être un nombre.',
            'quantite_entree.*.min' => 'Min de :min requis',
            'quantite_entree.*.max' => 'Max de :max requis',
            
            'prix_unitaire_achat.*.required' => 'Champ requis',
            'prix_unitaire_achat.*.numeric' => 'Doit être un nombre.',
            'prix_unitaire_achat.*.min' => 'Min de :min requis',
            'prix_unitaire_achat.*.max' => 'Max de :max requis',

            'moyen_payement.in' => 'Moyen de paiement est invalide',
            'moyen_payement.string' => 'Doit être une chaîne',
            'moyen_payement.required' => 'Champ requis',
            'moyen_payement.max' => 'Max de :max requis',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }


        try{
            $fournisseur = LigneFournisseursSysteme::findOrFail($request->fournisseur);
            $approvidionnement = Approvisionnement::create([
                'ligne_fournisseurs_systeme_id' => $fournisseur->id,
                'reference_payement' => $request->reference_payement,
                'moyen_payement' => $request->moyen_payement,
                'description' => $request->description,
                'montant_paye' => $request->montant_paye,
            ]);

            // Attachement des produits
            foreach ($request->produits as $index => $produit) {
                $dette_id = null;
                if($request->somme_reglee[$index] < ($request->quantite_entree[$index] * $request->prix_unitaire_achat[$index])){
                    $dette = detteFournisseur::create([
                        'montant' => $request->quantite_entree[$index] * $request->prix_unitaire_achat[$index] - $request->somme_reglee[$index]
                    ]);
                    $dette_id = $dette->id;
                }
                
                $produit = System_produit::findOrFail($produit);
                $prix = $request->prix_unitaire_achat[$index];
                $produit->pua = ($produit->pua + $prix) / 2;
                $produit->qte_stck += $request->quantite_entree[$index];
                $produit->update();
                $approvidionnement->produitsBruts()->attach($produit->id, ['prix_unitaire_achat' => $request->prix_unitaire_achat[$index], 'quantite_entree' => $request->quantite_entree[$index] , 'dette_fournisseur_id' => $dette_id, 'somme_reglee' => $request->somme_reglee[$index] ]);
            }
    
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Ce fournisseur n\'est pas trouvé'], 404);

        } catch (\Exception $e) {
            return response()->json(['error' => $e], 500);
        }

        if($approvidionnement->produitsBruts()->count() == 0){
            $approvidionnement->delete();
        }

        return response()->json(['message' => "Approvidionnement ajouté avec succès."]);


    }

}
