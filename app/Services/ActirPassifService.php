<?php

namespace App\Services;

use App\Classes\Bilan;


class ActirPassifService
{
    public function actifFunction($date){
        $actif = [];
        $actif['fraisEtablissement'] = Bilan::fraisEtablissement($date);
        $actif['fraisDeRechercheDeDeveloppement'] = Bilan::fraisDeRechercheDeDeveloppement($date);
        $actif['brevetsLicense'] = Bilan::brevetsLicense($date);
        $actif['avancesEtAcompte'] = Bilan::avancesEtAcompte($date);
        $actif['autresImmobilisationsIncorporelles'] = Bilan::autresImmobilisationsIncorporelles($date);
        $actif['terrain'] = Bilan::terrain($date);
        $actif['constructions'] = Bilan::constructions($date);
        $actif['installationsTechniques'] = Bilan::installationsTechniques($date);
        $actif['autresImmobilisationsCorporelle'] = Bilan::autresImmobilisationsCorporelle($date);
        $actif['materielDeBureau'] = Bilan::materielDeBureau($date);
        $actif['matierePremiere'] = Bilan::matierePremiere($date);
        $actif['produitsFinis'] = Bilan::produitsFinis($date);
        $actif['creanceClients'] = Bilan::creanceClients($date);
        $actif['disponiblites'] = Bilan::disponiblites($date);

        $actif['totalActif'] =  $actif['fraisEtablissement'][2] + $actif['fraisDeRechercheDeDeveloppement'][2] +
        $actif['brevetsLicense'][2] + $actif['avancesEtAcompte'][2] +
        $actif['autresImmobilisationsIncorporelles'][2] + $actif['terrain'][2] +
        $actif['constructions'][2] + $actif['installationsTechniques'][2] +
        $actif['autresImmobilisationsCorporelle'][2] + $actif['matierePremiere'][2] +
        $actif['produitsFinis'][2] + $actif['creanceClients'][2] + $actif['disponiblites'][2] + $actif['materielDeBureau'][2];

        return $actif;
    }

    public function passifFunction($date, $resultatExercice)
    {
        $passif = [];
        $passif['capital'] = Bilan::capitalSouscrit($date);
        $passif['resultatExercice'] = $resultatExercice;
        $passif['dettesBancaires'] = Bilan::dettesBancaires($date);
        $passif['autresDettesFinancieres'] = Bilan::autresDettesFinancieres($date);
        $passif['dettesFournisseurs'] = Bilan::dettesFournisseurs($date);
        $passif['dettesSocialesEtFiscales'] = Bilan::dettesSocialesEtFiscales($date);
        $passif['dettesSurImmobilisations'] = Bilan::dettesSurImmobilisations($date);

        $passif['totalPassif'] =  $passif['capital'][2] + $resultatExercice + $passif['dettesBancaires'][2] +
        $passif['autresDettesFinancieres'][2] + $passif['dettesFournisseurs'][2] +
        $passif['dettesSocialesEtFiscales'][2] + $passif['dettesSurImmobilisations'][2];  

        return $passif;
    }
}
