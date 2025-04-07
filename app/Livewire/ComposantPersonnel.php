<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Personnel;

class ComposantPersonnel extends Component
{
    use WithFileUploads;
    public $matricule;
    public $nom;
    public $prenom;
    public $date_de_naissance;
    public $date_recrutement;
    public $lieu_de_naissance;
    public $titre_poste;
    public $num_cnps;
    public $tel;
    public $photo;
    
    public function mount()
    {
        $this->personnel = Personnel::where("system_client_id", auth()->user()->id)->orderBy('nom', 'asc')->get();
        return view('livewire.composant-personnel', ['people' => $this->personnel]);
    }
    
    public function render()
    {
        $this->personnel = Personnel::orderBy('nom', 'asc')->get();
        return view('livewire.composant-personnel', ['people' => $this->personnel]);
    }
    
    
    public function enregistrer()
    {
        $this->validate([
            'matricule' => 'required|unique:personnels|max:200',
            'nom' => 'required|max:60',
            'prenom' => 'required|max:70',
            'date_de_naissance' => 'nullable|date',
            'date_recrutement' => 'nullable|date',
            'lieu_de_naissance' => 'nullable|string|max:50',
            'titre_poste' => 'required|string|max:50',
            'num_cnps' => 'required|string|max:200',
            'tel' => 'nullable|string|max:21',
            'photo' => 'nullable|image|max:2048', // max 2MB
        ]);
        
        // dd($this->matricule);
        $personnel = new Personnel();
        $personnel->matricule = $this->matricule;
        $personnel->nom = $this->nom;
        $personnel->prenom = $this->prenom;
        $personnel->date_de_naissance = $this->date_de_naissance;
        $personnel->date_recrutement = $this->date_recrutement;
        $personnel->lieu_de_naissance = $this->lieu_de_naissance;
        $personnel->titre_poste = $this->titre_poste;
        $personnel->num_cnps = $this->num_cnps;
        $personnel->tel = $this->tel;
        $personnel->system_client_id = auth()->user()->system_client->id;

        if ($this->photo) {
            $photoPath = $this->photo->store('photos', 'public');
            $personnel->photo = $photoPath;
        }
        
        $personnel->save();
        $this->reset();
    }
}
