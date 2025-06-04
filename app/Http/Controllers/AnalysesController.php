<?php

namespace App\Http\Controllers;

use App\Classes\CoteCalculationClass;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class AnalysesController extends Controller {
    public function index(){
        return view('analyses.index');
    }

    public function graphData(Request $request){
        $validator = Validator::make($request->all(), [
            'periode' => 'numeric|required|min:1|max:3',
            'ratio' => ['required', Rule::in(['ratioDeLiquiditeGenerale', 'ratioDeAutonomieFinanciere','ratioDeSolvabiliteGenerale'])],
        ],
        [
            'periode.numeric' => 'Nombre requis',
            'periode.required' => 'La période est requise',
            'periode.min' => 'La période doit être au moins de :min mois',
            'periode.max' => 'La période ne peut pas dépasser :max mois',
            'ratio.in' => 'Ce ratio est invalide.',
            'ratio.required' => 'Le ratio est requis',
        ]);

        $ratioVariablesDeDependance = [
            'ratioDeAutonomieFinanciere' => ['capitaux_propres', 'dettes_financieres'],
            'ratioDeLiquiditeGenerale' => ['capitaux_propres', 'dettes_financieres'],
            'ratioDeSolvabiliteGenerale' => ['creanceClients', 'matierePremiere', 'disponiblites', 'produitsFinis', 'avancesEtAcompte', 'dettesFournisseurs', 'dettesSocialesEtFiscales', 'autresDettesFinancieres', 'dettesSurImmobilisations'],
        ];

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        $data = [];
        $data[$request->ratio] = CoteCalculationClass::datesValeurs($request->periode,  $request->ratio);
        foreach ($ratioVariablesDeDependance[$request->ratio] as $variable) {
            $data[$variable] = CoteCalculationClass::datesValeurs($request->periode,  $variable);
        }

        \Log::info('Données envoyées au graphique :', $data);
        return response()->json($data);
    }
}
