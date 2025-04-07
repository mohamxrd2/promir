<?php

namespace App\Livewire\Pointage;

use App\Classes\MainClass;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;
use App\Models\Personnel;
use App\Models\Pointage;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class PointageCompnt extends Component
{
    use WithPagination;
    public $searchInput = '';
    public $h_arrivee;
    public $h_fin;
    public $personnel = [];
    public $pageCourante = 'accueil';
    public $modalePointer = false;
    public $pointage =[];
    public $pointages;
    public $mettreAJour = false;

    public function render()
    {
        $people = Personnel::where('system_client_id', MainClass::getSystemId())
                           ->where(function ($query) {
                               $query->where('nom', 'like', '%' . $this->searchInput . '%')
                                     ->orWhere('prenom', 'like', '%' . $this->searchInput . '%')
                                     ->orWhere('matricule', 'like', '%' . $this->searchInput . '%');
                           })
                           ->orderBy('nom', 'asc')
                           ->paginate(4);

        return view('livewire.pointage.pointage-compnt', [
            'people' => $people,
        ])->extends('layouts.master')->section('content');
    }

    public function goToPointage(Personnel $personnel){
        // dd($personnel);
        $this->personnel = $personnel->toArray();
        try{
            $this->pointage = Pointage::where('personnel_id', $personnel['id'])->first();
            if($this->pointage){
                if(!$this->pointage->h_fin){
                    $this->mettreAJour = true;
                    $this->h_arrivee = substr($this->pointage->h_arrivee, 0, 5);
                }else{
                    $this->h_arrivee = "";
                    $this->mettreAJour = false;
                }
            }
            $this->modalePointer = true;  
        }catch(ModelNotFoundException $e){
            $this->dispatch('nouvelAgent', ['message' => 'ok!']);
            $this->modalePointer = true;
            $this->mettreAJour = false;
        }
        
    }

    public function annuler(){
        $this->modalePointer = false;
        $this->resetIputFields();
        $this->personnel = [];
    }


    public function savePointage(){
        // dd($this->h_arrivee);
        

        if($this->mettreAJour){
           $newPointageData = $this->validate([
                'h_arrivee' => 'required|max:8',
                'h_fin' => 'required|max:8'
            ],
            [
                'h_arrivee.required' =>'Heure requise',
                'h_fin.required' =>'Heure requise'
            ]);

            

            $this->pointage->h_arrivee = $newPointageData['h_arrivee'];
            $this->pointage->h_fin = $newPointageData['h_fin'];
            if($this->pointage->update()){
                $this->modalePointer = false;
                $this->resetIputFields();
            }
        }else if(!$this->mettreAJour){
            $newPointageData = $this->validate([
                'h_arrivee' => 'required|max:8',
                'h_fin' => 'nullable|max:8',
            ],
            [
                'h_arrivee.required' =>'Heure requise',
                'h_arrivee.max' =>'Depassement',
                'h_fin.max' =>'Depassement',
            ]);
            $h_arrivee = intval(explode(':', $newPointageData['h_arrivee'])[0]);
            $pointage = new Pointage;
            $pointage->h_arrivee = $newPointageData['h_arrivee'];
            $pointage->periode = ($h_arrivee < 12) ? 'Avant midi' : 'Après midi';
            $pointage->h_fin = $newPointageData['h_fin'] ? $newPointageData['h_fin'] : null;
            $pointage->personnel_id = $this->personnel['id'];
            if($pointage->save()){
                $this->modalePointer = false;
                $this->resetIputFields();
            }
        }
        
        
    }
    private function resetIputFields(){
        $this->h_fin = "";
        $this->h_arrivee = "";
        $this->mettreAJour = false;
        $this->resetErrorBag();
    }
    public function displayPointagesOfAPerson($id){
        $this->pointages = Pointage::select(
            DB::raw('DATE(created_at) as date'), 
            'periode', 
            'h_arrivee', 
            'h_fin'
        )
        ->where('personnel_id', $id)
        ->orderBy('created_at', 'asc')
        ->get()
        ->groupBy('date')
        ->map(function($dateGroup) {
            return $dateGroup->groupBy('periode')->map(function($periodeGroup) {
                return new Collection($periodeGroup);
            });
        })->map(function($dateGroup) {
            return new Collection($dateGroup);
        });
    $this->pointages = new Collection($this->pointages);
    $this->pageCourante = 'afficherPointages';
    }
}
