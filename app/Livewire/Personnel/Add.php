<?php

namespace App\Livewire\Personnel;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Personnel;
use Illuminate\Validation\Rule;

class Add extends Component
{
    use WithFileUploads;

    public $matricule;
    public $nom;
    public $prenom;
    public $date_de_naissance;
    public $date_recrutement;
    public $situation_matrimoniale;
    public $nombre_enfants;
    public $secteurIntervention;
    public $Nationalite;
    public $lieu_de_naissance;
    public $titre_poste;
    public $num_cnps;
    public $tel;
    public $photo;
    public $system_client;
    public $auto_matricule = false;

    function toggle()
    {
        $this->auto_matricule = ! $this->auto_matricule;
        if ($this->auto_matricule) {
            $this->matricule = $this->generateMatricule($this->system_client, "MATCL");
        } else {
            $this->reset(['matricule']);
        }
    }
    function generateMatricule($id, $prefix)
    {
        do {
            $now = Carbon::now();
            $milliseconds = $now->format('u');
            // $formattedDate = $now->format('YmdHis');
            $matricule = $prefix . str_pad($id, 2, '0', STR_PAD_LEFT) . $milliseconds;
            // $matricule = $prefix. $formattedDate . str_pad($id, 2, '0', STR_PAD_LEFT) . $milliseconds;
        } while (Personnel::where('matricule', $matricule)->exists());
        return $matricule;
    }


    protected $rules = [
        'matricule' => 'required|unique:personnels',
        'nom' => 'required',
        'secteurIntervention' => 'required',
        'Nationalite' => 'required',
        'prenom' => 'required',
        'situation_matrimoniale' => 'required|in:Célibataire,Marié,Divorcé,Veuf',
        'nombre_enfants' => 'required|integer',
        'date_de_naissance' => 'nullable|date',
        'date_recrutement' => 'nullable|date',
        'lieu_de_naissance' => 'nullable|max:40',
        'titre_poste' => 'nullable|max:200',
        'num_cnps' => 'nullable|unique:personnels',
        'tel' => 'required|unique:personnels|max:20',
        'photo' => 'nullable|image|max:2048',
    ];


    public function messages()
    {
        return [
            'matricule.required' => 'Le matricule est requis.',
            'secteurIntervention.required' => 'Ce champ est requis.',
            'Nationalite.required' => 'Ce champ est requis.',
            'nombre_enfants.required' => 'Le nombre d\'enfants est requis.',
            'situation_matrimoniale.required' => 'La situation matrimoniale est requise.',
            'situation_matrimoniale.in' => 'La situation matrimoniale est invalide.',
            'nombre_enfants.integer' => 'Le nombre d\'enfants est un entier.',
            'matricule.unique' => 'Ce matricule est déjà utilisé.',
            'nom.required' => 'Le nom est requis.',
            'prenom.required' => 'Le prénom est requis.',
            'date_de_naissance.date' => 'La date de naissance doit être une date valide.',
            'date_recrutement.date' => 'La date de recrutement doit être une date valide.',
            'lieu_de_naissance.max' => 'Le lieu de naissance ne peut pas dépasser :max caractères.',
            'titre_poste.max' => 'Le titre du poste ne peut pas dépasser :max caractères.',
            'num_cnps.unique' => 'Ce numéro CNPS est déjà utilisé.',
            'tel.required' => 'Le numéro de téléphone est requis.',
            'tel.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'tel.max' => 'Le numéro de téléphone ne peut pas dépasser :max caractères.',
            'photo.image' => 'Le fichier doit être une image.',
            'photo.max' => 'La taille de l\'image ne peut pas dépasser :max kilo-octets.',
        ];
    }

    public function mount() {}

    public function render()
    {
        return view('livewire.personnel.add')->extends('layouts.master')->section('content');
    }

    public function register()
    {

        $this->validate();

        $system_client = auth()->user()->system_client->id;
        $personnel = new Personnel();
        $personnel->matricule = $this->matricule;
        $personnel->nom = $this->nom;
        $personnel->prenom = $this->prenom;
        $personnel->date_de_naissance = $this->date_de_naissance;
        $personnel->situation_matrimoniale = $this->situation_matrimoniale;
        $personnel->nombre_enfants = $this->nombre_enfants;
        $personnel->secteurIntervention = $this->secteurIntervention;
        $personnel->Nationalite = $this->Nationalite;
        $personnel->date_recrutement = $this->date_recrutement;
        $personnel->lieu_de_naissance = $this->lieu_de_naissance;
        $personnel->titre_poste = $this->titre_poste;
        $personnel->num_cnps = $this->num_cnps;
        $personnel->tel = $this->tel;
        $personnel->system_client_id = $system_client;

        if ($this->photo) {
            $photoPath = $this->photo->store('photos', 'public');
            $personnel->photo = $photoPath;
        }

        if ($personnel->save()) {

            // $this->reset(['nom', 'prenom', 'date_de_naissance','date_recrutement','lieu_de_naissance','titre_poste','num_cnps','tel']);
            // toastr()->success("Ajout réussi");

            $this->dispatch('showMessage', [
                'nature' => 'success',
                'body' => 'Opération réussie',
                'title' => 'Succès'
            ]);
        }
    }
}
