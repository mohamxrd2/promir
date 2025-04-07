<?php

namespace App\Livewire\Ventes;

use App\Classes\MainClass;
use App\Models\Clients;
use App\Models\LigneClientSysteme;
use Livewire\Component;

class QuickAddNewClientComponent extends Component
{
    public $disableInputs;
    public $clientInput;
    public $clientSelect;
    public $quickAddNewClient;
    public $clientsNonPresents;
    public function render()
    {
        $this->clientsNonPresents = Clients::select('clients.*')
            ->leftJoin('ligne_client_systemes', function($join) {
                $join->on('clients.id', '=', 'ligne_client_systemes.client_id')
                    ->where('ligne_client_systemes.system_client_id', '=', MainClass::getSystemId());
            })->whereNull('ligne_client_systemes.client_id')->get();
        return view('livewire.ventes.quick-add-new-client-component');
    }


    public function cancelModal(){
        dd('rr');
        $this->clientInput = "";
        $this->clientSelect = "";
        $this->quickAddNewClient = [];
        $this->disableInputs = false;
        $this->emit('eventCancelNewClientModal');
    }
    public function messages(){
        return 
        [   
          'quickAddNewClient.type.required' => 'Le champ "Type" est requis.',
          'quickAddNewClient.type.string' => 'Le champ "Type" doit être une chaîne de caractères.',
          'quickAddNewClient.type.max' => 'Le champ "Type" ne doit pas dépasser :max caractères.',
          
          'quickAddNewClient.nom.required' => 'Le champ "Nom" est requis.',
          'quickAddNewClient.nom.string' => 'Le champ "Nom" doit être une chaîne de caractères.',
          'quickAddNewClient.nom.max' => 'Le champ "Nom" ne doit pas dépasser :max caractères.',
          
          'quickAddNewClient.adresse.required' => 'Le champ "Adresse" est requis.',
          'quickAddNewClient.adresse.string' => 'Le champ "Adresse" doit être une chaîne de caractères.',
          'quickAddNewClient.adresse.max' => 'Le champ "Adresse" ne doit pas dépasser :max caractères.',
          
          'quickAddNewClient.email.required' => 'Le champ "Email" est requis.',
          'quickAddNewClient.email.string' => 'Le champ "Email" doit être une chaîne de caractères.',
          'quickAddNewClient.email.email' => 'Veuillez entrer une adresse email valide.',
          'quickAddNewClient.email.max' => 'Le champ "Email" ne doit pas dépasser :max caractères.',
          'quickAddNewClient.email.unique' => 'Cet email est déjà utilisé.',
          
          'quickAddNewClient.phone.required' => 'Le champ "Téléphone" est requis.',
          'quickAddNewClient.phone.string' => 'Le champ "Téléphone" doit être une chaîne de caractères.',
          'quickAddNewClient.phone.max' => 'Le champ "Téléphone" ne doit pas dépasser :max caractères.',
          'quickAddNewClient.phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
    
          'quickAddNewClient.seconde_phone.required' => 'Le champ "Téléphone" est requis.',
          'quickAddNewClient.seconde_phone.string' => 'Le champ "Téléphone" doit être une chaîne de caractères.',
          'quickAddNewClient.seconde_phone.max' => 'Le champ "Téléphone" ne doit pas dépasser :max caractères.',
          'quickAddNewClient.seconde_phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
    
          'quickAddNewClient.region.required' => 'Le champ "Region" est requis.',
          'quickAddNewClient.region.string' => 'Le champ "Region" doit être une chaîne de caractères.',
          'quickAddNewClient.region.max' => 'Le champ "Region" ne doit pas dépasser :max caractères.',
    
          'quickAddNewClient.departement.required' => 'Le champ "Departement" est requis.',
          'quickAddNewClient.departement.string' => 'Le champ "Departement" doit être une chaîne de caractères.',
          'quickAddNewClient.departement.max' => 'Le champ "Departement" ne doit pas dépasser :max caractères.',
    
          'quickAddNewClient.localite.required' => 'La localité est requise.',
          'quickAddNewClient.localite.string' => 'Le localité doit être une chaîne de caractères.',
    
          'quickAddNewClient.pays.required' => 'Le champ "Pays" est requis.',
          'quickAddNewClient.pays.string' => 'Le pays doit être une chaîne de caractères.',
        ];
    }



    public function updatedClientInput(){
        $this->quickAddNewClient = [];
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

        // dd($value);
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

    public function saveNewClient(){
        
        $system_client_id = MainClass::getSystemId();
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
      
        $this->validate([
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
        
    );
            
      
        if($client) {
            
            if (LigneClientSysteme::where('system_client_id', $system_client_id)->where('client_id', $client->id)->exists()) {
                // $this->dispatch('duplicaionDeClient', ['message' => 'Ce client est déjà enregistré!']);
                dd('');
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
          $client = Clients::create(
        [
            'type' => $this->quickAddNewClient['type'],
            'nom' => $this->quickAddNewClient['nom'],
            'adresse' => $this->quickAddNewClient['nom'],
            'email' => $this->quickAddNewClient['nom'],
            'phone' => $this->quickAddNewClient['nom'],
            'seconde_phone' => $this->quickAddNewClient['nom'],
            'pays' => $this->quickAddNewClient['nom'],
            'region' => $this->quickAddNewClient['nom'],
            'departement' => $this->quickAddNewClient['nom'],
            'localite' => $this->quickAddNewClient['nom'],
          ]
        );
          
      
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
}
