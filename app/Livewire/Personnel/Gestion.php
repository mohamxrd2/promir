<?php

namespace App\Livewire\Personnel;

use App\Models\PaieSalarier;
use App\Models\Personnel;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Gestion extends Component

{
    use WithFileUploads;
    public $matricule;
    public $nom;
    public $salaireCategoriel;
    public $nombrePart;
    public $primeTransport;
    public $tauxAccidentTravail;
    public $anciennete;
    public $primeAnciennete;
    public $cotisationCmuPartSalariale;
    public $autresAvantages;
    public $periodePaie;
    public $salaireBrut;
    public $salaireBrutImposable;
    public $sursalaire;
    public $retenu_ITS;
    public $ricf;
    public $impotBrut;
    public $salaire_Net;
    public $prenom;
    public $du;
    public $au;
    public $date_de_naissance;
    public $date_recrutement;
    public $lieu_de_naissance;
    public $titre_poste;
    public $simule = false;
    public $nombre_enfants;
    public $Nationalite;
    public $secteurIntervention;
    public $situation_matrimoniale;
    public $num_cnps;
    public $tel;
    public $photo;
    public $people = [];
    public $concernedPerson;
    public $paie;
    public $page = 'afficher';
    public $isOpenModifPage = false;
    public $isOpenPayement = false;
    public $isOpenAccueil = true;
    public $ancienne_photo;
    public $searshTerm;

    public function updateSearch()
    {
        $query = Personnel::where("system_client_id", auth()->user()->system_client->id);
        if (!empty($this->searshTerm)) {
            $query->where(function ($q) {
                $q->where('nom', 'like', '%' . $this->searshTerm . '%')
                    ->orWhere('prenom', 'like', '%' . $this->searshTerm . '%')
                    ->orWhere('matricule', 'like', '%' . $this->searshTerm . '%');
            });
        }
        $this->people = $query->orderBy('nom', 'asc')->get();
    }

    public function render()
    {
        $query = Personnel::where("system_client_id", auth()->user()->system_client->id);
        if (!empty($this->searshTerm)) {
            $query->where(function ($q) {
                $q->where('nom', 'like', '%' . $this->searshTerm . '%')
                    ->orWhere('prenom', 'like', '%' . $this->searshTerm . '%')
                    ->orWhere('matricule', 'like', '%' . $this->searshTerm . '%');
            });
        }
        $this->people = $query->orderBy('nom', 'asc')->get();

        return view('livewire.personnel.gestion')
            ->extends('layouts.master')->section('content');
    }


    public function openModifier($person)
    {
        $this->concernedPerson = Personnel::find($person);
        $this->nom = $this->concernedPerson->nom;
        $this->prenom = $this->concernedPerson->prenom;
        $this->date_de_naissance = $this->concernedPerson->date_de_naissance;
        $this->date_recrutement = $this->concernedPerson->date_recrutement;
        $this->lieu_de_naissance = $this->concernedPerson->lieu_de_naissance;
        $this->titre_poste = $this->concernedPerson->titre_poste;
        $this->num_cnps = $this->concernedPerson->num_cnps;
        $this->tel = $this->concernedPerson->tel;
        $this->matricule = $this->concernedPerson->matricule;
        $this->situation_matrimoniale = $this->concernedPerson->situation_matrimoniale;
        $this->nombre_enfants = $this->concernedPerson->nombre_enfants;
        $this->Nationalite = $this->concernedPerson->Nationalite;
        $this->secteurIntervention = $this->concernedPerson->secteurIntervention;
        $this->isOpenAccueil = false;
        $this->isOpenPayement = false;
        $this->isOpenModifPage = true;
    }

    public function openPayment($person)
    {

        $this->concernedPerson = Personnel::with('contrat')->find($person);
        try {
            $paiementRecent = PaieSalarier::where("personnel_id", $this->concernedPerson->id)->orderBy("created_at")->firstOrFail();
            $this->du = Carbon::parse($paiementRecent->created_at)->addMonth()->format('Y-m-d');
            $this->au = Carbon::parse($paiementRecent->created_at)->addMonths(2)->format('Y-m-d');
        } catch (\Exception $e) {
        }

        if (!$this->concernedPerson->contrat) {
            toastr()->info("Aucun contrat definit pour ce salarié!");
            return redirect()->route('gestion_personnel');
        }
        $this->salaireCategoriel = $this->concernedPerson->contrat->salaire_mensuel;
        $this->nombre_enfants = $this->concernedPerson->nombre_enfants;
        $this->situation_matrimoniale = $this->concernedPerson->situation_matrimoniale;

        $nEnfants = min($this->concernedPerson->nombre_enfants, 6);
        $nEnfantsInfirmes = $this->concernedPerson->nombre_enfants_infirmes ?? 0;
        if (in_array($this->situation_matrimoniale, ["Célibataire", "Divorcé", "Veuf"])) {
            $partsBase = 1;
        } elseif ($this->situation_matrimoniale == "Marié") {
            $partsBase = 2;
        } else {
            toastr()->error("Erreur lors de la determination de la situation matrimoniale.");
            return redirect()->route('gestion_personnel');
        }
        $this->nombrePart = min($partsBase + $nEnfants * 0.5 + $nEnfantsInfirmes * 1, 5);

        $this->primeTransport = 30000;
        $this->secteurIntervention = $this->concernedPerson->secteurIntervention;
        $this->tauxAccidentTravail = $this->getTauxBySecteur($this->secteurIntervention);

        $this->anciennete = $this->calculerAnciennete($this->concernedPerson->contrat->date_debut);

        $this->primeAnciennete = $this->calculerPrime($this->anciennete, $this->salaireCategoriel);
        $this->cotisationCmuPartSalariale = 1500;

        $this->autresAvantages = 0;
        $this->sursalaire = 0;
        $this->salaireBrut = 0;
        $this->salaireBrutImposable = 0;

        $this->titre_poste = $this->concernedPerson->titre_poste;
        $this->num_cnps = $this->concernedPerson->num_cnps;
        $this->tel = $this->concernedPerson->tel;
        $this->matricule = $this->concernedPerson->matricule;
        $this->situation_matrimoniale = $this->concernedPerson->situation_matrimoniale;
        $this->nombre_enfants = $this->concernedPerson->nombre_enfants;
        $this->Nationalite = $this->concernedPerson->Nationalite;
        $this->secteurIntervention = $this->concernedPerson->secteurIntervention;
        $this->isOpenAccueil = false;
        $this->isOpenModifPage = false;
        $this->isOpenPayement = true;
    }


    public function annuler()
    {

        $this->isOpenAccueil = true;
        $this->isOpenModifPage = false;

        $this->salaireBrut = 0;
        $this->salaireBrutImposable = 0;
        $this->ricf = 0;
        $this->impotBrut = 0;
        $this->retenu_ITS = 0;
        $this->salaire_Net = 0;
    }

    public function updateSursalaire() {}

    public function deletePerson($person)
    {

        if ($this->concernedPerson = Personnel::find($person)) {
            $this->concernedPerson->contrat->delete();
            if ($this->concernedPerson->delete()) {
                toastr()->success("Ok", "Suppression reussie...");
                return redirect()->route('gestion_personnel');
            } else {
                toastr()->error("Erreur", "Suppression non aboutie!");
                return redirect()->route('gestion_personnel');
            }
        } else {
            toastr()->error("Erreur", "Un probléme est survenu lors de la suppression! Veuillez reéssaiyer...");
            return redirect()->route('gestion_personnel');
        }
    }


    public function confimModification()
    {
        $this->initializeRules();
        $this->validate();
        $this->concernedPerson->nom = $this->nom;
        $this->concernedPerson->prenom = $this->prenom;
        $this->concernedPerson->date_de_naissance = $this->date_de_naissance;
        $this->concernedPerson->date_recrutement = $this->date_recrutement;
        $this->concernedPerson->lieu_de_naissance = $this->lieu_de_naissance;
        $this->concernedPerson->titre_poste = $this->titre_poste;
        $this->concernedPerson->num_cnps = $this->num_cnps;
        $this->concernedPerson->situation_matrimoniale = $this->situation_matrimoniale;
        $this->concernedPerson->nombre_enfants = $this->nombre_enfants;
        $this->concernedPerson->Nationalite = $this->Nationalite;
        $this->concernedPerson->secteurIntervention = $this->secteurIntervention;
        $this->concernedPerson->tel = $this->tel;

        $this->ancienne_photo = $this->concernedPerson->photo;
        if ($this->photo instanceof \Illuminate\Http\UploadedFile) {
            if ($photoPath = $this->photo->store('photos', 'public')) {
                $this->concernedPerson->photo = $photoPath;
                if ($this->ancienne_photo) {
                    Storage::disk('public')->delete($this->ancienne_photo);
                }
            } else {
                toastr()->error("Erreur", "La photo n'a pas pu ètre modifiée!");
            }
        }


        if ($this->concernedPerson->update()) {
            // $this->reset(['nom', 'prenom', 'date_de_naissance','date_recrutement','lieu_de_naissance','titre_poste','num_cnps','tel']);
            toastr()->success("Modification reussie...");
        }
    }



    public function confimPaie()
    {
        if (!$this->simule) {
            toastr()->info("Pour plus de clarté, il vous est nécessaire de simuler avant toute confirmation.");
            return redirect()->route('gestion_personnel');
        }

        if (!$this->du || !$this->au) {
            toastr()->info("Vous devez définir une période");
            return redirect()->route('gestion_personnel');
        }

        $this->paie = new PaieSalarier();
        $this->paie->salaire_base = $this->salaireCategoriel;
        $this->paie->autres_avantages = $this->autresAvantages;
        $this->paie->periode_paie = "Du $this->du Au $this->au";
        $this->paie->nombre_de_parts = $this->nombrePart;
        $this->paie->prime_transport = $this->primeTransport;
        $this->paie->anciennete = $this->anciennete;
        $this->paie->cmu = $this->cotisationCmuPartSalariale;
        $this->paie->sursalaire = $this->sursalaire;
        $this->paie->retenu_ITS = $this->retenu_ITS;
        $this->paie->situation_matrimoniale = $this->situation_matrimoniale;
        $this->paie->nombre_enfants = $this->nombre_enfants;
        $this->paie->salaireBrutImposable = $this->salaireBrutImposable;
        $this->paie->personnel_id = $this->concernedPerson->id;
        $this->simule = false;
        $this->paie->save();
        toastr()->success(message: "Paie enregistrée avec succès");
        return redirect()->route('gestion_personnel');
    }




    private function initializeRules()
    {
        $this->rules = [
            'nom' => 'required|max:20',
            'prenom' => 'required|max:50',
            'date_de_naissance' => 'nullable|date',
            'date_recrutement' => 'nullable|date',
            'lieu_de_naissance' => 'nullable|max:30',
            'titre_poste' => 'nullable|max:30',
            'num_cnps' => 'nullable|max:30|unique:personnels,num_cnps,' . optional($this->concernedPerson)->id,
            'tel' => 'required|max:20|unique:personnels,tel,' . optional($this->concernedPerson)->id,
            'matricule' => 'required|unique:personnels,matricule,' . optional($this->concernedPerson)->id,
            'photo' => 'nullable|max:2048',
        ];
    }


    private function calculerAnciennete($dateEmbauche)
    {

        $dateEmbauche = Carbon::parse($dateEmbauche);
        $dateActuelle = Carbon::now();

        return floor($dateEmbauche->diffInYears($dateActuelle));
    }

    public function simuler()
    {
        try {

            $transportImposable = $this->primeTransport >= 30000 ? $this->primeTransport - 30000 : 0;
            $this->salaireBrut = $this->salaireCategoriel + $this->sursalaire + $this->autresAvantages + $this->primeTransport;
            $this->salaireBrutImposable = $this->arrondir($transportImposable - $this->primeTransport + $this->salaireBrut);
            $this->ricf = $this->arrondir($this->calculerRICF($this->nombrePart));
            $this->impotBrut = $this->arrondir($this->calculerImpotBrut($this->salaireBrutImposable));
            $this->retenu_ITS = $this->arrondir($this->impotBrut - $this->ricf);
            $this->salaire_Net = $this->salaireBrut - $this->retenu_ITS;
            $this->simule = true;
        } catch (\Exception $e) {
            return;
        }
    }


    private function arrondir($nombre)
    {
        return floor($nombre * 100) / 100;
    }
    private function calculerPrime($anciennete, $salaireCategoriel)
    {
        if ($anciennete >= 2 && Carbon::now()->endOfYear()) {
            $primeAnciennete = ($anciennete / 100) * $salaireCategoriel;
        } else {
            $primeAnciennete = 0;
        }
        return round($primeAnciennete, 2);
    }


    private function calculerImpotBrut($salaireBrutImposable)
    {
        $tranches = [
            75000 => 0.00,
            240000 => 0.16,
            800000 => 0.21,
            2400000 => 0.24,
            8000000 => 0.28,
            PHP_INT_MAX => 0.32
        ];

        $impotBrut = 0.0;
        $revenuRestant = $salaireBrutImposable;
        $limiteInferieure = 0;


        foreach ($tranches as $limiteSuperieure => $taux) {
            if ($revenuRestant <= 0) {
                break;
            }

            $montantTranche = min($revenuRestant, $limiteSuperieure - $limiteInferieure);
            $impotBrut += $montantTranche * $taux;
            $revenuRestant -= $montantTranche;
            $limiteInferieure = $limiteSuperieure;
        }
        return $impotBrut;
    }


    function calculerRICF($nombreParts)
    {
        $baremeRICF = [
            "1" => 0,
            "1.5" => 5500,
            "2" => 11000,
            "2.5" => 16500,
            "3" => 22000,
            "3.5" => 27500,
            "4" => 33000,
            "4.5" => 38500,
            "5" => 44000
        ];


        if ($nombreParts > 5) {
            return $baremeRICF[5];
        }

        $nombreParts = (string)$nombreParts;
        if (array_key_exists($nombreParts, $baremeRICF)) {
            return $baremeRICF[$nombreParts];
        } else {
            return 0;
        }
    }




    public function getTauxBySecteur($secteur)
    {
        $tauxSecteur = [
            "MECANIQUE GENERALE" => 3,
            "INDUSTRIE EXTRACTIVES ET PROSPECTION" => 4,
            "MINIERE" => 5,
            "INDUSTRIE ALIMENTAIRES" => 4,
            "INDUSTRIES DES CORPS GRAS" => 4,
            "INDUSTRIES CHIMIQUES" => 4,
            "AUTRES INDUSTRIES" => 3,
            "TRANSPORT" => 3,
            "BOIS" => 3,
            "TEXTILE" => 3,
            "TRANFORMATION DU THON" => 2,
            "POLYGRAPHIQUE" => 3,
            "HOTELLERIE ET TOURISME" => 3,
            "PRODUCTION AGRICOLE" => 3,
            "SUCRE" => 3,
            "AUXILIAIRES DE TRANSPORT" => 5,
            "BATIMENT-TRAVAUX PUBLICS ET ACTIVITES CONNEXES" => 4,
            "COMMERCE–NEGOCE–PROFESSIONS LIBERALE" => 2,
            "AGRICOLE – ELEVAGE - FORESTIER" => 2,
            "BANQUES" => 2,
            "ASSURANCES" => 5,
            "ENTREPRISES PETROLIERES" => 2,
            "INSTITUTS DE RECHERCHE" => 2,
            "TRANSPORT DE FONDS ET VALEURS" => 2,
            "SECURITE PRIVEE" => 2,
            "DOCKERS" => 2,
            "GENS DE MAISON" => 2,
            "ENTREPRISES PETROLIERES (distribution)" => 3
        ];

        if (array_key_exists($secteur, $tauxSecteur)) {
            return $tauxSecteur[$secteur];
        } else {
            toastr()->error("Erreur lors de la determination du secteur d'activité.");
            return redirect()->route('gestion_personnel');
        }
    }
}
