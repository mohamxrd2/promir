<?php

namespace App\Http\Controllers\produits;
use App\Classes\CalculationsClass;
use App\Models\LigneClientSysteme;
use App\Models\Personnel;
use App\Models\ProduitTransforme;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Models\CategorieProduit;
use App\Models\Produit;
use App\Http\Controllers\Controller;
use App\Models\System_produit;
use Illuminate\Http\Request;
use App\Classes\MainClass;
class SystemPorduitController extends Controller
{



  function generateMatricule($id, $prefix) {
    do {
        $now = Carbon::now();
        $milliseconds = $now->format('u');
        // $formattedDate = $now->format('YmdHis');
        $reference = str_pad($id, 2, '0', STR_PAD_LEFT) . $milliseconds;
        // $reference = $prefix. $formattedDate . str_pad($id, 2, '0', STR_PAD_LEFT) . $milliseconds;
    } while(Produit::where('reference', $reference)->exists());
    return $reference;
}


function callFunctionReference(){
  return response()->json(MainClass::generateReference('REFPDTB', Produit::class));
}
  public function index(){
    $personnel = Personnel::first();

    $produits = System_produit::where('system_client_id', MainClass::getSystemId())->orderBy('qte_stck')->with('produit')->get();
    $categories = CategorieProduit::all();
    return view('produits.produits', compact(['produits','categories']));
  }

  public function store(Request $request){

     

  $produit = Produit::where('reference', $request->reference)
    ->where('designation', $request->designation)
    ->where('format', $request->produit_format)
    ->where('calibrage', $request->calibrage)
    ->where('conditionnement', $request->conditionnement)
    ->where('type', $request->type_produit)
    ->first();

  
    $m = $produit ? ",reference,$produit->id" : "";


    $validator = Validator::make($request->all(), [
      'reference' => 'required|string|max:60|unique:produits'. $m,
      'nom_piece' => 'string|max:40',
      'nombre_pieces' => 'integer',
      'categorie' => 'required|string|max:60',
      'designation' => 'required|string|max:60',
      'calibrage' => 'required|string|max:60',
      'conditionnement' => 'required|string|max:60',
      'produit_format' => 'required|string|max:60',
      'type_produit' => 'required|string|max:20',
      'qte_stck' => 'required|integer',
      'pua' => 'required|numeric',
      'puv' => 'required|numeric',
      'nombre_portions' => 'integer',
      'portion' => 'string|max:20',
      'image' => 'nullable|image|max:2048',
  ],
  [
    'reference.required' => 'Le champ de référence est requis.',
    'reference.string' => 'Le champ de référence doit être une chaîne de caractères.',
    'reference.max' => 'Le champ de référence ne doit pas dépasser :max caractères.',
    'reference.unique' => 'Une nouvelle ref. est requise.',
    'nom_piece.string' => 'Le champ de pièce doit être une chaîne de caractères.',
    'nom_piece.max' => 'Le champ de pièce ne doit pas dépasser :max caractères.',
    'nombre_pieces.integer' => 'Le nombre de piéces doit être un entier.',
    'portion.string' => 'Le champ de portion doit être une chaîne de caractères.',
    'portion.max' => 'Le champ de portion ne doit pas dépasser :max caractères.',
    'nombre_portions.integer' => 'Le nombre de portions doit être un entier.',
    'conditionnement.required' => 'Le conditionnement est requis.',
    'conditionnement.string' => 'Le conditionnement doit être une chaîne de caractères.',
    'conditionnement.max' => 'Le conditionnement ne doit pas dépasser :max caractères.',
    'calibrage.required' => 'Le calibrage est requis.',
    'calibrage.string' => 'Le calibrage doit être une chaîne de caractères.',
    'calibrage.max' => 'Le calibrage ne doit pas dépasser :max caractères.',
    'designation.required' => 'Le champ de désignation est requis.',
    'designation.string' => 'Le champ de désignation doit être une chaîne de caractères.',
    'designation.max' => 'Le champ de désignation ne doit pas dépasser :max caractères.',
    'produit_format.required' => 'Le champ de format est requis.',
    'produit_format.string' => 'Le champ de format doit être une chaîne de caractères.',
    'produit_format.max' => 'Le champ de format ne doit pas dépasser :max caractères.',
    'type_produit.required' => 'Le champ de type de produit est requis.',
    'type_produit.string' => 'Le champ de type de produit doit être une chaîne de caractères.',
    'type_produit.max' => 'Le champ de type de produit ne doit pas dépasser :max caractères.',
    'categorie.required' => 'Le champ de catégorie est requis.',
    'qte_stck.required' => 'Le champ de quantité en stock est requis.',
    'qte_stck.integer' => 'Le champ de quantité en stock doit être un entier.',
    'pua.required' => 'Le champ de prix unitaire d\'achat est requis.',
    'pua.numeric' => 'Le champ de prix unitaire d\'achat doit être un nombre décimal.',
    'puv.required' => 'Le champ de prix unitaire de vente est requis.',
    'puv.numeric' => 'Le champ de prix unitaire de vente doit être un nombre décimal.',
    'image.image' => 'Le fichier doit être une image.',
    'image.max' => 'La taille de l\'image ne peut pas dépasser :max kilo-octets.',
]);


if ($validator->fails()) {
  return response()->json(['errors' => $validator->errors()], 400);
}


if($produit){
  $system_produit = System_produit::where('puv', $request->puv)
  ->where('pua', $request->pua)
  ->where('system_client_id', MainClass::getSystemId())
  ->where('produit_id', $produit->id)
  ->where('portion', $request->libelle_portion)
  ->where('nombre_portions', $request->nombre_portions)
  ->where('nombre_pieces', $request->nombre_pieces)
  ->where('nom_piece', $request->nom_piece)
  ->first();

  if($system_produit){
    return response()->json(['duplicationDeProduit' => true]);
  }
}

    // if($produit){
    //   $referenceProduit = $produit->reference;
    // }else{
    //   $referenceProduit = $this->
    // }
    $categorie = CategorieProduit::where('nom', $request->categorie)->first();
    
    if($categorie && $produit){
      System_produit::create(
        [
          'qte_stck' => $request->qte_stck,
          'qte_stck_satic_apres_appro' => $request->qte_stck,
          'pua' => $request->pua,
          'nombre_pieces' => $request->nombre_pieces,
          'nom_piece' => $request->nom_piece,
          'puv' => $request->puv,
          'portion' => $request->libelle_portion ?? null,          
          'nombre_portions' => $request->nombre_portions ?? 1,
          'system_client_id' => MainClass::getSystemId(),
          'produit_id' => $produit->id,
        ]
      );
    }elseif($categorie && !$produit){

      if ($request->image) {
        $photoPath = $request->image->store('produits', 'public');
      }


      $produit = Produit::create([
        //'reference' => MainClass::generateReference('REFPDT', Produit::class);
        'reference' => $request->reference,
        'designation' => $request->designation,
        'conditionnement' => $request->conditionnement,
        'calibrage' => $request->calibrage,
        'format' => $request->produit_format,
        'type' => $request->type_produit,
        'categorie_produit_id' => $categorie->id,
        'image' => $photoPath ?? null,
      ]); 

      
      System_produit::create(
        [
          'qte_stck' => $request->qte_stck,
          'qte_stck_satic_apres_appro' => $request->qte_stck,
          'pua' => $request->pua,
          'puv' => $request->puv,
          'nombre_pieces' => $request->nombre_pieces,
          'nom_piece' => $request->nom_piece,
          'portion' => $request->libelle_portion ?? null,          
          'nombre_portions' => $request->nombre_portions ?? 1,
          'system_client_id' => MainClass::getSystemId(),
          'produit_id' => $produit->id,
        ]
      );

    }elseif(!$categorie && !$produit){

      $categorie = CategorieProduit::create([
        'nom' => $request->categorie,
      ]);

      if ($request->image) {
        $photoPath = $request->image->store('produits', 'public');
      }


      $produit = Produit::create([
        'reference' => $request->reference,
        'designation' => $request->designation,
        'format' => $request->produit_format,
        'conditionnement' => $request->conditionnement,
        'calibrage' => $request->calibrage,
        'type' => $request->type_produit,
        'categorie_produit_id' => $categorie->id,
        'image' => $photoPath ?? null,
      ]);      



      System_produit::create(
        [
          'qte_stck' => $request->qte_stck,
          'qte_stck_satic_apres_appro' => $request->qte_stck,
          'pua' => $request->pua,
          'puv' => $request->puv,
          'nombre_pieces' => $request->nombre_pieces,
          'nom_piece' => $request->nom_piece,
          'portion' => $request->libelle_portion ?? null,          
          'nombre_portions' => $request->nombre_portions ?? 1,
          'system_client_id' => MainClass::getSystemId(),
          'produit_id' => $produit->id,
        ]
      );
    }
    return response()->json(["message" => "Produit Ajouté avec succès!"]);
  }

  public function delete($id){
    $produit = System_produit::findOrFail($id);
    $produit->delete();
  //  toastr()->success('Produit supprimé!', 'OK');
    return redirect()->back();
}



public function edite(Request $request){

  $validator = Validator::make($request->all(), [
    // 'reference' => 'required|string|max:60',
    // 'categorie' => 'required|string|max:60',
    // 'designation' => 'required|string|max:60',
    // 'format' => 'required|string|max:60',
    // 'type_produit' => 'required|string|max:20',

    
    
    'qte_stck' => 'numeric',
    'pua' => 'required|numeric',
    'puv' => 'required|numeric',
    'nom_piece' => 'string|max:40',
    'nombre_pieces' => 'numeric',
    'portion' => 'string|max:40',
    'nombre_portions' => 'numeric',
    'produit_id' => 'integer|required',

    // 'image' => 'nullable|image|max:2048',
],
[
  'portion.string' => 'Le champ de portion doit être une chaîne de caractères.',
  'portion.max' => 'Le champ de portion ne doit pas dépasser :max caractères.',
  'nom_piece.string' => 'Le champ de pièce doit être une chaîne de caractères.',
  'nom_piece.max' => 'Le champ de pièce ne doit pas dépasser :max caractères.',
  'nombre_pieces.numeric' => 'Le nombre de piéces doit être un nombre.',
  'nombre_portions.numeric' => 'Le nombre de portions doit être un nombre.',
  'qte_stck.required' => 'Le champ de quantité en stock est requis.',
  'produit_id.required' => 'Problème inattendu avec ce produit! Existe-il ?',
  'produit_id.integer' => 'Problème inattendu avec ce produit',
  'qte_stck.numeric' => 'Le champ de quantité en stock doit être un nombre.',
  'pua.required' => 'Le champ de prix unitaire d\'achat est requis.',
  'pua.numeric' => 'Le champ de prix unitaire d\'achat doit être un nombre décimal.',
  'puv.required' => 'Le champ de prix unitaire de vente est requis.',
  'puv.numeric' => 'Le champ de prix unitaire de vente doit être un nombre décimal.',


  // 'type_produit.required' => 'Le champ de type de produit est requis.',
  // 'type_produit.string' => 'Le champ de type de produit doit être une chaîne de caractères.',
  // 'type_produit.max' => 'Le champ de type de produit ne doit pas dépasser :max caractères.',
  // 'categorie.required' => 'Le champ de catégorie est requis.',
  // 'image.image' => 'Le fichier doit être une image.',
  // 'image.max' => 'La taille de l\'image ne peut pas dépasser :max kilo-octets.',
]);
  

  if ($validator->fails()) {
    return response()->json(['errors' => $validator->errors()], 400);
  }





  $produit = System_produit::findOrFail($request->produit_id);
  if($produit->qte_stck != $request->qte_stck){
    $produit->qte_stck_satic_apres_appro = $request->qte_stck;
  }
  $produit->qte_stck = $request->qte_stck;
  $produit->pua = $request->pua;
  $produit->puv = $request->puv;
  $produit->nom_piece = $request->nom_piece;
  $produit->nombre_pieces = $request->nombre_pieces;
  $produit->portion = $request->libelle_portion;
  $produit->nombre_portions = $request->nombre_portions;

  if($produit->update()){
      return response()->json(["SUCCES!"=>true]);
  }
  return response()->json("ERREUR!");
}


  public function renderProduits() {
    $query = request()->query('query');
    $categorie = CategorieProduit::find($query);
    $produits = $categorie->produits;
    return response()->json($produits);
  }


  public function renderProductsHavingDeleveryOrNot(Request $request){
    $system_id = Mainclass::getSystemId();
    $produits = null;
    if(Route::currentRouteName() == "render_produits_avec_type_vente_pb"){
      if($request->typeVente == "Dépôt vente"){
        $client = null;
        try{
          $client = LigneClientSysteme::findOrFail($request->client);
        }catch(ModelNotFoundException){
          //ne rien faire
        }

        if($client){
          $id = $client->id;
          $produits = System_produit::whereHas('livraisons', function($query) use ($system_id, $id){
            $query->whereHas('ligneClientSysteme', function($query) use ($system_id, $id){
              $query->where('system_client_id', $system_id)->where('id', $id);
            });
          })->with(['produit.categorie'])->where('system_client_id', $system_id)->orderBy('created_at')->get();
        }else{
          $produits = System_produit::whereHas('livraisons', function($query)use ($system_id){
            $query->whereHas('ligneClientSysteme', function($query) use ($system_id){
              $query->where('system_client_id', $system_id);
            });
          })->with(['produit.categorie'])->where('system_client_id', $system_id)->orderBy('created_at')->get();
        }
      }else{
        $produits = System_produit::with(['produit.categorie'])->where('system_client_id', $system_id)->orderBy('created_at')->get();
      }

      return response()->json(['produits' => $produits, 'estProduitBrute' => true]);
    }else if (Route::currentRouteName() == "render_produits_avec_type_vente_pt"){
      if($request->typeVente == "Dépôt vente"){
        $client = null;
        try{
          $client = LigneClientSysteme::findOrFail($request->client);
        }catch(ModelNotFoundException){
          //ne rien faire
        }
        if($client){
          $id = $client->id;
          $produits = ProduitTransforme::whereHas('livraisons', function ($query) use ($system_id, $id){
            $query->whereHas('ligneClientSysteme', function($query) use ($system_id, $id){
              $query->where('system_client_id', $system_id)->where('id', $id);
            });
          })->whereHas('productions.produitsBruts.systemeClient', function ($query) use ($system_id) {
            $query->where('id', $system_id);
          })->get();
        }else{
          $produits = ProduitTransforme::whereHas('livraisons', function ($query) use ($system_id){
            $query->whereHas('ligneClientSysteme', function($query) use ($system_id){
              $query->where('system_client_id', $system_id);
            });
          })->whereHas('productions.produitsBruts.systemeClient', function ($query) use ($system_id) {
            $query->where('id', $system_id);
          })->get();
        }
      }else{
        $produits = ProduitTransforme::whereHas('productions.produitsBruts.systemeClient', function ($query) use ($system_id) {
          $query->where('id', $system_id);
        })->get();
      }
      return response()->json(['produits' => $produits, 'estProduitTransforme' => true]);
    }
  }
}
