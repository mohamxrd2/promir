<?php
namespace App\Livewire\Ventes;
use App\Classes\MainClass;
use App\Models\Clients;
use App\Models\LigneClientSysteme;
use App\Models\System_produit;
use App\Models\Ventes;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class VenteExterieureProduitBrut extends Component {
    public $currentePage = 'PAGEISLISTE';


    public $system_id;
    public $productContainers;
    public $productContainersCount;
    public $today;
    public $venteToEdite;
    public $f = 0;
    public $produitsPresents = [];
    public $editeVente  = [];
    public $productsToAdd;
    public $addVente = [];
    public $clientAcheteurInput;
    public $clientAcheteurSelect;
    public $systemId;
    public $addMoreProductBtnHide = false;

    // gestion de l'ajout du nouveau client
    public $addNewClientInput;
    public $clientSelect;
    public $disableInputs;
    public $clientsNonPresents = [];
    public $clientsPresents = [];
    public $quickAddNewClient = [];
    public $modalQuickAddNewClient = false;
    public $inputSearch = false;
    protected $listeners = ['selectChanged'];

    public function selectChanged($counter, $value)
    {
        $this->productsToAdd[$counter]['produitsSelect'] = $value;
        $this->handleSelectChange($counter);
    }

    public function handleSelectChange($counter)
    {
        dd($counter);
    }
    private function initiliseQuickAddNewClient(){
        $this->quickAddNewClient['type'] = "";
        $this->quickAddNewClient['nom'] = "";
        $this->quickAddNewClient['adresse'] = "";
        $this->quickAddNewClient['email'] = "";
        $this->quickAddNewClient['phone'] = "";
        $this->quickAddNewClient['seconde_phone'] = "";
        $this->quickAddNewClient['region'] = "";
        $this->quickAddNewClient['pays'] = "";
        $this->quickAddNewClient['departement'] = "";
        $this->quickAddNewClient['localite'] = "";
    }

private function initializeProductsToAdd($order){
    $this->productsToAdd[$order]['produitsSelect'] = null;
    $this->productsToAdd[$order]['quantite_envoyee'] = null;
    $this->productsToAdd[$order]['quantite_vendue'] = null;
    $this->productsToAdd[$order]['montant_regle'] = null;
    $this->productsToAdd[$order]['prix_vente'] = null;
}
    public function mount(){
        $this->systemId = MainClass::getSystemId();
        $this->produitsPresents = System_produit::with('produit.categorie')->where('system_client_id',  $this->systemId)->orderBy('created_at')->get();
        $this->productContainers = [];
        $this->initializeProductsToAdd(0);
        $this->addVente['type_de_vente'] = 'LOCALE';
        $this->addVente['moyen_payement'] = 'Payement BIICF';
        $this->addVente['status_vente'] = 'Conifimée';
        $this->productContainersCount = 1;
        $this->initiliseQuickAddNewClient();
    }


    public function addMoreProduct($productContainersCount){
        $this->productContainersCount = $productContainersCount + 1;
        array_push($this->productContainers, $productContainersCount);
        $this->initializeProductsToAdd($productContainersCount);
    }

    public function removeProduct($index){
        unset($this->productContainers[$index]);
        unset($this->productsToAdd[$index+1]);
        $this->productContainersCount--;
    }
    


    public function render() {
        $systemId = $this->systemId;
        $ventes = Ventes::whereHas('lignClientSystem.systemClient', function ($query) use ($systemId) {
            $query->where('id', $systemId);
        })->whereDate('created_at', Carbon::today())->with(['lignClientSystem', 'lignesVente.systemeProduit.produit.categorie'])->latest()->get();
        
        if(!$this->inputSearch){
            $this->clientsPresents = LigneClientSysteme::with('client')->where('system_client_id',  $systemId)->orderBy('created_at')->get();
        }
        return view('livewire.ventes.vente-exterieure-produit-brut', ['ventes' =>$ventes])->extends('layouts.master')->section('content');
    }



    public function goToListVentes(){
        $this->currentePage = 'PAGEISLISTE';
        return redirect()->route('venteExternPrduitsBrute');
    }

    public function goToAddVentes(){
        $this->currentePage = 'PAGEISADD';
    }


    public function openModifier($id){
        $this->venteToEdite = Ventes::findOrFail($id);
        $this->editeVente["reference"] = $this->venteToEdite->reference;
        $this->editeVente["moyen_payement"] = $this->venteToEdite->moyen_payement;
        $this->editeVente["status_vente"] = $this->venteToEdite->status_vente;
        $this->currentePage = 'PAGEISEDITE';
    }


    public function rules(){
        if($this->currentePage == 'PAGEISEDITE'){
            return  [
                'editeVente.reference' => 'required|string|max:40|unique:ventes,reference,' .$this->venteToEdite->id,
                'editeVente.moyen_payement' => ['required', 'string','max:40', Rule::in(['Payement BIICF', 'Cash', 'Wave', 'Orange money', 'Moov money', 'MTN money', 'Trasor money'])],
                'editeVente.status_vente' => ['required', 'string','max:11', Rule::in(['En attente', 'Conifimée', 'Annulée'])],
            ];
        }elseif($this->currentePage == 'PAGEISADD' and $this->addVente['type_de_vente'] == 'LOCALE'){
            return  [
                'productsToAdd.*.produits' => 'required|string|max:60',
                'productsToAdd.*.quantite_envoyee' => 'nullable|numeric|min:0',
                'productsToAdd.*.quantite_vendue' => 'required|numeric|min:0',
                'productsToAdd.*.prix_vente' => 'required|numeric|min:0',
                'productsToAdd.*.montant_regle' => 'required|numeric|min:0',

                'addVente.ligne_client_systeme' => 'min:1',
                'addVente.type_de_vente' => ['required', 'string', Rule::in(['EXTERIEURE', 'LOCALE'])],
                'addVente.moyen_payement' => ['required', 'string', Rule::in(['Payement BIICF', 'Cash', 'Wave', 'Orange money','Moov money','MTN money','Trasor money'])],
                'addVente.status_vente' => ['required', 'string', Rule::in(['En attente', 'Conifimée', 'Annulée'])],
            ];
        }
        
    }
    
    public function messages(){
        if($this->currentePage = 'PAGEISEDITE'){
        return [
                'editeVente.reference.required' => 'Une reference est requise.',
                'editeVente.reference.string' => 'La reference doit être une chaîne de caractères.',
                'editeVente.reference.max' => 'La reference ne doit pas dépasser :max caractères.',
                'editeVente.reference.unique' => 'Cette est indisponible.',
                'editeVente.moyen_payement.string' => 'Le moyen de payement doit être une chaîne de caractères.',
                'editeVente.moyen_payement.required' => 'Un moyen de payement est requis.',
                'editeVente.moyen_payement.max' => 'Le moyen de payement ne doit pas dépasser :max caractères.',
                'editeVente.moyen_payement.in' => 'Le moyen de paiement que vous sélectionnez est invalide.',
                'editeVente.status_vente.required' => 'Le status est requis.',
                'editeVente.status_vente.string' => 'Le status doit être une chaîne de caractères.',
                'editeVente.status_vente.max' => 'Le status ne doit pas dépasser :max caractères.',
                'editeVente.status_vente.in' => 'Le status de vente que vous sélectionnez est invalide.',
            ];
        }elseif($this->currentePage == 'PAGEISADD' and $this->addVente['type_de_vente'] == 'LOCALE'){
            return  [
                'productsToAdd.*.produits.required' => 'Le produit est requis.',
                'productsToAdd.*.produits.max' => 'Max de :max requis',
                'productsToAdd.*.quantite_vendue.required' => 'Quantité vendue requise.',
                'productsToAdd.*.quantite_vendue.numeric' => 'La quantité doit être un nombre',
                'productsToAdd.*.quantite_vendue.min' => 'La quantité minimale est de :min',
                'productsToAdd.*.quantite_envoyee.numeric' => 'La quantité doit être un nombre',
                'productsToAdd.*.prix_vente.required' => 'Le prix est requis.',
                'productsToAdd.*.prix_vente.numeric' => 'Le prix doit être un nombre.',
                'productsToAdd.*.prix_vente.min' => 'Le prix minimal est de :min',
                'productsToAdd.*.montant_regle.min' => 'Le montant minimal est de :min',
                'productsToAdd.*.montant_regle.numeric' => 'Le montant doit être un nombre.',
                'productsToAdd.*.montant_regle*.required' => 'Montant requis.',
                'addVente.type_de_vente.required' => 'Type requis.',
                'addVente.type_de_vente.in' => 'Type invalide.',
                'addVente.ligne_client_systeme.min' => 'Client Invalide',
                'addVente.moyen_payement.in' => 'Moyen invalide.',
                'addVente.moyen_payement.required' => 'Un moyen de payement type est requis',
                'addVente.status_vente.in' => 'Status invalide',
                'addVente.status_vente.required' => 'Status requis',
            ];
        }
    }
    public function edite(){
       $venteData = $this->validate();
        if($this->venteToEdite->update($venteData['editeVente'])){
            $this->dispatch('editedVente', ['message' => 'ok!']);
        }
    }



    public function saveVente(){
        dd($this->productsToAdd);
        $this->addMoreProductBtnHide = true;
        $venteData = $this->validate(
            [
                'productsToAdd.*.produitsSelect' => 'required|min:1',
                'productsToAdd.*.quantite_envoyee' => 'nullable|numeric|min:0',
                'productsToAdd.*.quantite_vendue' => 'required|numeric|min:0',
                // 'productsToAdd.*.prix_vente' => 'required|numeric|min:0',
                'productsToAdd.*.montant_regle' => 'required|numeric|min:0',

                'addVente.ligne_client_systeme' => 'nullable|min:1',
                'addVente.type_de_vente' => ['required', 'string', Rule::in(['EXTERIEURE', 'LOCALE'])],
                'addVente.moyen_payement' => ['required', 'string', Rule::in(['Payement BIICF', 'Cash', 'Wave', 'Orange money','Moov money','MTN money','Trasor money'])],
                'addVente.status_vente' => ['required', 'string', Rule::in(['En attente', 'Conifimée', 'Annulée'])],
            ]
            ,
            [
                'productsToAdd.*.produitsSelect.required' => 'Le produit est requis.',
                'productsToAdd.*.produitsSelect.max' => 'Max de :max requis',
                'productsToAdd.*.quantite_vendue.required' => 'La quantité vendue est requise.',
                'productsToAdd.*.quantite_vendue.numeric' => 'La quantité vendue doit être un nombre',
                'productsToAdd.*.quantite_vendue.min' => 'La quantité minimale est de :min',
                'productsToAdd.*.quantite_envoyee.numeric' => 'La quantité envoyée doit être un nombre',
                'productsToAdd.*.prix_vente.required' => 'Le prix de vente est requis.',
                'productsToAdd.*.prix_vente.numeric' => 'Le prix de vente doit être un nombre.',
                'productsToAdd.*.prix_vente.min' => 'Le prix minimal est de :min',
                'productsToAdd.*.montant_regle.min' => 'Le montant minimal est de :min',
                'productsToAdd.*.montant_regle.numeric' => 'Le montant réglé doit être un nombre.',
                'productsToAdd.*.montant_regle*.required' => 'Un montant est requis.',
                'addVente.type_de_vente.required' => 'Un type est requis.',
                'addVente.type_de_vente.in' => 'Le type de vente que vous sélectionnez est invalide.',
                'addVente.ligne_client_systeme.min' => 'Le client choisi presente un problème.',
                'addVente.moyen_payement.in' => 'Le type de vente que vous sélectionnez est invalide.',
                'addVente.moyen_payement.required' => 'Un moyen de payement type est requis',
                'addVente.status_vente.in' => 'Le status de vente de vente que vous definissez est invalide',
                'addVente.status_vente.required' => 'Un status de vente est requis',
            ]
        );
        dd($venteData);
    }

    // public function updated($propertyName)
    // {
    //     if (preg_match('/productsToAdd.2.produitsSelect/', $propertyName)) {
    //         $this->handleSelectChange($propertyName);
    //     }
    // }

    // public function handleSelectChange($propertyName)
    // {
    //     preg_match('/productsToAdd\.(\d+)\.produitsSelect/', $propertyName, $matches);
    //     $index = $matches[1];
    //     dd($index);
    // }
    

// gestion de l'ajout du noueau client
    public function cencelNewClientModal(){
        $this->modalQuickAddNewClient = false;
        $this->clientInput = "";
        $this->clientSelect = "";
        $this->initiliseQuickAddNewClient();
        $this->disableInputs = false;
        $this->resetErrorBag();
    }
    
    public function updatedClientAcheteurInput(){
        $this->inputSearch = true;
        $this->clientAcheteurSelect = '';
        $query = $this->clientAcheteurInput;
        $parametre = "%$query%";
        $this->clientsPresents = [];
        $this->clientsPresents = LigneClientSysteme::with('client')
        ->whereHas('client', function ($query) use ($parametre) {
            $query->where('nom', 'like', $parametre)
                ->orWhere('phone', 'like', $parametre)
                ->orWhere('email', 'like', $parametre);
        })
        ->where('system_client_id', $this->systemId)
        ->orderBy('created_at')
        ->get();
    }


    public function updatedAddNewClientInput(){
        $this->initiliseQuickAddNewClient();
        $this->quickAddNewClient['type'] = 'Choisissez un type';
        $this->disableInputs = false;

        $query = $this->clientInput;
        $parametre = "%$query%";
        $this->clientsNonPresents = Clients::select('clients.*')
        ->leftJoin('ligne_client_systemes', function($join) {
          $join->on('clients.id', '=', 'ligne_client_systemes.client_id')
               ->where('ligne_client_systemes.system_client_id', '=', auth()->user()->system_client->id);
        })->whereNull('ligne_client_systemes.client_id')
        ->where(function($query) use ($parametre) {
            $query->where('nom', 'like', $parametre)
                ->orWhere('phone', 'like', $parametre)
                ->orWhere('email', 'like', $parametre);
        })->get();
    }

    public function updatedClientSelect($value){

        if (!empty($value)) {
            if(ctype_digit($value[0])){
                $client = Clients::findOrFail($value[0]);
                if($client){
                    $this->disableInputs = true;
                    $this->quickAddNewClient['type'] = $client->type;
                    $this->quickAddNewClient['nom'] = $client->nom;
                    $this->quickAddNewClient['adresse'] = $client->adresse;
                    $this->quickAddNewClient['email'] = $client->email;
                    $this->quickAddNewClient['phone'] = $client->phone;
                    $this->quickAddNewClient['seconde_phone'] = $client->seconde_phone;
                    $this->quickAddNewClient['region'] = $client->region;
                    $this->quickAddNewClient['pays'] = $client->pays;
                    $this->quickAddNewClient['departement'] = $client->departement;
                    $this->quickAddNewClient['localite'] = $client->localite;
                }
            }
        }
    }
    public function updatedClientAcheteurSelect(){
        $val = $this->clientAcheteurSelect;
        if (!empty($val)) {
            if(ctype_digit($val[0])){
                $l = LigneClientSysteme::with('client')->find($val[0]);
                $this->clientAcheteurInput =  $l->client->nom;
            }
        }
    }

    public function goToNewClientModal(){
        $this->clientsNonPresents = Clients::select('clients.*')
            ->leftJoin('ligne_client_systemes', function($join) {
                $join->on('clients.id', '=', 'ligne_client_systemes.client_id')
                    ->where('ligne_client_systemes.system_client_id', '=', $this->systemId);
            })->whereNull('ligne_client_systemes.client_id')->get();
        $this->modalQuickAddNewClient = true;
    }



    public function saveNewClient(){
        
        $system_client_id = $this->systemId;
        if(!$this->quickAddNewClient){return;}
        $client = Clients::where('type', $this->quickAddNewClient['type'])
        ->where('nom', $this->quickAddNewClient['nom'])
        ->where('adresse', $this->quickAddNewClient['adresse'])
        ->where('email', $this->quickAddNewClient['email'])
        ->where('phone', $this->quickAddNewClient['phone'])
        ->where('region', $this->quickAddNewClient['region'])
        ->where('departement', $this->quickAddNewClient['departement'])
        ->where('localite', $this->quickAddNewClient['localite'])
        ->where('pays', $this->quickAddNewClient['pays'])
        ->first();

        if($client){
            $m = ','.$client->id;
            $p = ','.$client->id;
            $p2 = ','.$client->id;
        }else{
            $m = '';
            $p = '';
            $p2 = '';
        }
      
       $newClientData = $this->validate([
            'quickAddNewClient.type' => 'required|string|max:60',
            'quickAddNewClient.nom' => 'required|string|max:60',
            'quickAddNewClient.region' => 'required|string|max:30',
            'quickAddNewClient.departement' => 'required|string|max:30',
            'quickAddNewClient.pays' => 'required|string',
            'quickAddNewClient.localite' => 'required|string',
            'quickAddNewClient.adresse' => 'required|string|max:60',
            'quickAddNewClient.email' => 'required|string|email|max:60|unique:clients,email'.$m,
            'quickAddNewClient.phone' => 'required|string|max:20|unique:clients,phone'.$p,
            'quickAddNewClient.seconde_phone' => 'nullable|string|max:20|unique:clients,seconde_phone'.$p2,
        ], 
        $this->renderMessages(),
    );
           
      
        if($client) {
           
            if (LigneClientSysteme::where('system_client_id', $system_client_id)->where('client_id', $client->id)->exists()) {
                $this->dispatch('duplicaionDeClient', ['message' => 'Ce client est déjà enregistré!']);
                return;
            }
        }
        
        
      
        if($client){

          LigneClientSysteme::create(
            [
              'system_client_id' => $system_client_id,
              'client_id' => $client->id,
            ]
          );
          
        }elseif(!$client){
          $client = Clients::create($newClientData['quickAddNewClient']);
          LigneClientSysteme::create(
            [
              'system_client_id' => $system_client_id,
              'client_id' => $client->id,
            ]
          );
        }
        $this->dispatch('newClientAddSuccess', ['message' => 'Client defini avec succès!']);
        return;
    }

    private function renderMessages(){
        return [
            'quickAddNewClient.type.required' => 'Le type est requis.',
            'quickAddNewClient.type.string' => 'Le type doit être une chaîne de caractères.',
            'quickAddNewClient.type.max' => 'Le type ne doit pas dépasser :max caractères.',
        
            'quickAddNewClient.nom.required' => 'Le nom est requis.',
            'quickAddNewClient.nom.string' => 'Le nom doit être une chaîne de caractères.',
            'quickAddNewClient.nom.max' => 'Le nom ne doit pas dépasser :max caractères.',
        
            'quickAddNewClient.adresse.required' => 'L\'adresse est requise.',
            'quickAddNewClient.adresse.string' => 'L\'adresse doit être une chaîne de caractères.',
            'quickAddNewClient.adresse.max' => 'L\'adresse ne doit pas dépasser :max caractères.',
        
            'quickAddNewClient.email.required' => 'L\'email est requis.',
            'quickAddNewClient.email.string' => 'L\'email doit être une chaîne de caractères.',
            'quickAddNewClient.email.email' => 'Veuillez entrer une adresse email valide.',
            'quickAddNewClient.email.max' => 'L\'email ne doit pas dépasser :max caractères.',
            'quickAddNewClient.email.unique' => 'Cet email est déjà utilisé.',
        
            'quickAddNewClient.phone.required' => 'Le téléphone est requis',
            'quickAddNewClient.phone.string' => 'Chaîne de caractères requise',
            'quickAddNewClient.phone.max' => 'Max de :max caractères requis',
            'quickAddNewClient.phone.unique' => 'Ce numéro est déjà utilisé.',
        
            'quickAddNewClient.seconde_phone.string' => 'Chaîne de caractères requise',
            'quickAddNewClient.seconde_phone.max' => 'Max de :max caractères requis',
            'quickAddNewClient.seconde_phone.unique' => 'Ce numéro est déjà utilisé.',
        
            'quickAddNewClient.region.required' => 'La région est requise.',
            'quickAddNewClient.region.string' => 'La région doit être une chaîne de caractères.',
            'quickAddNewClient.region.max' => 'La région ne doit pas dépasser :max caractères.',
        
            'quickAddNewClient.departement.required' => 'Le département est requis.',
            'quickAddNewClient.departement.string' => 'Chaîne de caractères requise',
            'quickAddNewClient.departement.max' => 'Max de :max caractères requis',
        
            'quickAddNewClient.localite.required' => 'La localité est requise',
            'quickAddNewClient.localite.string' => 'Chaîne de caractères requise',
        
            'quickAddNewClient.pays.required' => 'Le pays est requis',
            'quickAddNewClient.pays.string' => 'Chaîne de caractères requise',
        ];
        
    }  
}
