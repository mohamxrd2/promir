<?php

namespace App\Classes;

use App\Http\Controllers\EtatsController;
use App\Models\Charges;
use App\Models\DetteFinanciere;
use App\Models\DetteFournisseur;
use App\Models\Investissements;
use App\Models\System_client;
use Carbon\Carbon;
use Exception;
use App\Services\ActirPassifService;
use Illuminate\Support\Facades\Log;




class CoteCalculationClass
{
    public static function ratioDeSolvabiliteGenerale($date){
        // Ratio de solvabilité générale = actif CourtTerme / passif CourtTerme
        $actifCourtTerme = CoteCalculationClass::actifCourtTerme($date);
        $passifCourtTerme = CoteCalculationClass::passifCourtTerme($date);
        return  $passifCourtTerme != 0 ? round($actifCourtTerme / $passifCourtTerme, 2) : 0.0;
    }




    public static function ratioDeAutonomieFinanciere($date){
        // Ratio d’autonomie financière = capitaux propres / total du bilan
        $totalPassif = (new ActirPassifService())->passifFunction($date, (new EtatsController())->resultatExercice($date))['totalPassif'];
        $capitalPropre = System_client::find(MainClass::getSystemId(), "capital_social")->capital_social;
        return  $totalPassif > 0 ? round($capitalPropre / $totalPassif, 6) : 0;
    }



    // Fonction du passif à court terme
    private static function passifCourtTerme($date){
        return
            Bilan::dettesFournisseurs($date)[2] ?? 0 +
            Bilan::dettesSocialesEtFiscales($date)[2] ?? 0 +
            Bilan::dettesBancaires($date)[2] ?? 0 +
            Bilan::autresDettesFinancieres($date)[2] ?? 0 +
            Bilan::dettesSurImmobilisations($date)[2] ?? 0;
    }



    // Fonction du passif à Long Terme
    public static function passifLongTerme($date){
        return round(
            Bilan::dettesBancaires($date)[2] ?? 0 +
                Bilan::autresDettesFinancieres($date)[2] ?? 0 +
                Bilan::dettesSurImmobilisations($date)[2] ?? 0,
            4
        );
    }

    // Fonction de l'actif à Long Terme
    public static function actifLongTerme($date) {
        return round(
            Bilan::fraisEtablissement($date)[2] ?? 0 +
                Bilan::fraisDeRechercheDeDeveloppement($date)[2] ?? 0 +
                Bilan::brevetsLicense($date)[2] ?? 0 +
                Bilan::avancesEtAcompte($date)[2] ?? 0 +
                Bilan::autresImmobilisationsIncorporelles($date)[2] ?? 0 +
                Bilan::terrain($date)[2] ?? 0 +
                Bilan::constructions($date)[2] ?? 0 +
                Bilan::installationsTechniques($date)[2] ?? 0 +
                Bilan::autresImmobilisationsCorporelle($date)[2] ?? 0 +
                Bilan::materielDeBureau($date)[2] ?? 0,
            4
        );
    }



    // Fonction de l'actif à court terme
    private static function actifCourtTerme($date){
        return
            Bilan::matierePremiere($date)[2] ?? 0 +
            Bilan::produitsFinis($date)[2] ?? 0 +
            Bilan::creanceClients($date)[2] ?? 0 +
            Bilan::disponiblites($date)[2] ?? 0 +
            Bilan::avancesEtAcompte($date)[2] ?? 0;
    }

    public static function ratioDeLiquiditeGenerale($date)
    {
        // Ratio de liquidité générale = actif à court terme / passif à court terme
        $passifCourtTerme = CoteCalculationClass::passifCourtTerme($date);
        return round($passifCourtTerme != 0
            ? CoteCalculationClass::actifCourtTerme($date) / $passifCourtTerme
            : 0.0, 4);
    }
    public static function capaciteDeRemboursement($date){
        // Capacité de remboursement = flux de trésorerie disponibles FCF / charges financières
        // Récupération des charges financières
        try {
            $chargesFinancieres = Charges::where('system_client_id', MainClass::getSystemId())
                ->whereIn('libelle', [
                    'Frais de services bancaires',
                    'Redevance de crédit-bail',
                    'Redevances'
                ])
                ->sum('montant');
        } catch (Exception $e) {
            Log::error('Erreur dans le calcul des charges financières: ' . $e->getMessage());
            $chargesFinancieres = 0.0;
        }

        // Calcul des amortissements
        try {
            $ammortissements = Investissements::where("system_client_id", MainClass::getSystemId())
                ->whereDate('date_acquisition', '<=', $date)
                ->whereDate('date_peremption', '>=', $date)
                ->get()
                ->sum(function ($inv) use ($date) {
                    $totalDays = Bilan::calculateTotalDays($inv->date_acquisition, $inv->duree_de_vie);
                    return ($totalDays > 0 ? ($inv->montant / $totalDays) : 0) * Carbon::parse($inv->date_acquisition)->diffInDays(Carbon::parse($date));
                });
        } catch (Exception $e) {
            Log::error('Erreur dans le calcul des amortissements: ' . $e->getMessage());
            $ammortissements = 0.0;
        }

        // Calcul du besoin en fonds de roulement (BFR)
        try {
            $bfr = Bilan::matierePremiere($date)[2] + Bilan::produitsFinis($date)[2] + Bilan::creanceClients($date)[2] - Bilan::dettesFournisseurs($date)[2];
        } catch (Exception $e) {
            Log::error('Erreur dans le calcul du BFR: ' . $e->getMessage());
            $bfr = 0.0;
        }

        // Récupérer le résultat d'exercice
        $resultat = (new EtatsController())->resultatExercice($date);
        // Calcul du CAPEX (a faire apres)
        $capex = 0;

        // Calcul du flux de trésorerie disponibles
        $fluxDeTresorerieDisponibles = $resultat + $ammortissements + $chargesFinancieres - $bfr - $capex;

        // Calcul de la capacité de remboursement
        $capaciteDeRemboursement = round($chargesFinancieres != 0
            ? $fluxDeTresorerieDisponibles / $chargesFinancieres
            : 0.0, 4);
        return $capaciteDeRemboursement;
    }

    public static function ratioDeLiquiditeALongTerme($date){
        $actifLongTerme = CoteCalculationClass::actifLongTerme($date);
        return round($actifLongTerme > 0 ? CoteCalculationClass::passifLongTerme($date) / $actifLongTerme : 0.0, 4);
    }


    //Calcul de l'intert du de l'entreprise

    public static function interetsDu($date){
        $interetsDu = 0.0;
        try {
            $interetsDu =
                DetteFinanciere::where('system_client_id', MainClass::getSystemId())
                ->whereDate('date_effet', '<=', $date)
                ->get()
                ->sum('interet_penalite')

                +

                DetteFournisseur::whereHas('approvisionnementSystemProduit.produitsBrut', function ($query) {
                    $query->where('system_client_id', MainClass::getSystemId());
                })
                ->where('date_effet', '<=', $date)
                ->get()
                ->sum('interet_penalite');
        } catch (Exception $e) {
            return 0.0;
        }
        return $interetsDu;
    }



    public static function tauxDeCouvertureDeLaDette($date)
    {
        $interetsDu = CoteCalculationClass::interetsDu($date);
        return round($interetsDu > 0 ? (new EtatsController())->resultatExercice($date) / $interetsDu : 0.0, 4);
    }


    public static function datesValeurs(int $months, $function_name){
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subMonths($months);
        $date_ = null;
        $date_valeurs = [];

        while ($startDate->lte($endDate)) {
            $date_ = $startDate->toDateString();
    
    
            $bilanElements = ["dettesSurImmobilisations","capitaux_propres","avancesEtAcompte", "disponiblites","autresDettesFinancieres", "matierePremiere", "dettesBancaires", "produitsFinis", "creanceClients", "dettesSocialesEtFiscales", "dettesFournisseurs"];

            // la valeur de certains elements (qui doivent venir de la funciton Bilan) doivent etre accedés de maniere differente,
            // on pose donc une condition pour mieux savoir a quelle fonction nous avons affaire et comment la gerer, d'ou la condition ternaire suivante
            in_array($function_name, $bilanElements) ? ($date_valeurs[$date_] = Bilan::$function_name($date_)[2] ?? 0) : ($date_valeurs[$date_] = CoteCalculationClass::$function_name($date_));
          
            $startDate->addDay();
        }

 
        // dd($date_valeurs);
        return $date_valeurs;
    }







    public static function penteTendance($months, $function_name){
        $datesValeurs = CoteCalculationClass::datesValeurs($months, $function_name);
        $n = count($datesValeurs);
        $sumX = $n * ($n + 1) / 2;
        $sumY = array_sum(array: $datesValeurs);
        $sumXY = 0;
        $sumXX = 0;
        $i = 0;
        foreach ($datesValeurs as $date => $valeur) {
            $i++;
            $sumXY += $i * $datesValeurs[$date];
            $sumXX += $i * $i;
        }

        /*
            La droite de la tendance par regression lineaire est y = ax + b
            a = pente = (n∑(xy)−∑x∑y) / (n∑(x_carré)−(∑x)_carré)
            b = (∑y−a∑x) / n
        */

        //calcule de la pente de la droite de regression (a)

        $pente = ($n * $sumXY - $sumX * $sumY) / ($n * $sumXX - $sumX * $sumX);


        // $b = ($sumY - $a * $sumX) / $n;
        // return ['a' => round($a, 2), 'b' => round($b, 2)];
        return $pente;
    }


    public static function mesureDeSolvabiliteEntreprise($months){
        ini_set('max_execution_time', 3600);

        $note = 0;
        $total = 0;

        $penteTendance = [
            "ratioDeSolvabiliteGenerale" => CoteCalculationClass::penteTendance($months, "ratioDeSolvabiliteGenerale"),
            "ratioDeAutonomieFinanciere" => CoteCalculationClass::penteTendance($months, "ratioDeAutonomieFinanciere"),
            "ratioDeLiquiditeGenerale" => CoteCalculationClass::penteTendance($months, "ratioDeLiquiditeGenerale"),
            "capaciteDeRemboursement" => CoteCalculationClass::penteTendance($months, "capaciteDeRemboursement"),
            "ratioDeLiquiditeALongTerme" => CoteCalculationClass::penteTendance($months, "ratioDeLiquiditeALongTerme"),
            "tauxDeCouvertureDeLaDette" => CoteCalculationClass::penteTendance($months, "tauxDeCouvertureDeLaDette"),
        ];

        // Calcul de la note en fonction des penteTendance
        foreach ($penteTendance as $key => $valeur) {
            $note += ($valeur > 0) ? 2 : -2;
            $total++;
        }


        
        // Calcul de la note finale sur 100 (arrondie)
        $noteFinale = round($note * 100 / $total);

        // Détermination de la lettre associée
        if ($noteFinale >= 95) {
            $grade = 'A+';
        } elseif ($noteFinale >= 90) {
            $grade = 'A';
        } elseif ($noteFinale >= 85) {
            $grade = 'A-';
        } elseif ($noteFinale >= 80) {
            $grade = 'B+';
        } elseif ($noteFinale >= 75) {
            $grade = 'B';
        } elseif ($noteFinale >= 70) {
            $grade = 'B-';
        } elseif ($noteFinale >= 50) {
            $grade = 'C';
        } elseif ($noteFinale >= 25) {
            $grade = 'D';
        } elseif ($noteFinale >= 1) {
            $grade = 'E';
        } else {
            $grade = 'F';
        }

        
        // Conversion des pentes en entiers

        // foreach ($penteTendance as $key => $valeur) {
        //     $penteTendance[$key] = intval($valeur);
        // }


        // Retourner la note, la lettre et les penteTendance



        return [
            "note" => intval($noteFinale),
            "grade" => $grade,
            "penteTendance" => $penteTendance
        ];
    }





    public static function analyseCausalite($months){
        $causes = [];
        $solutions = [];

        if (CoteCalculationClass::penteTendance($months, "matierePremiere") < 0) {
            $causes[] = "Regression globale du stock en matière première.";
            $solutions[] = "Mieux gerer les les approvisionnements en matière première.";
        } 
        

        if (CoteCalculationClass::penteTendance($months, "produitsFinis") < 0) {
            $causes[] = "Regression globale du stock en produits finis.";
            $solutions[] = "Augmenter les productions.";
        }
        

        if (CoteCalculationClass::penteTendance($months, "produitsFinis") == 0) {
            $causes[] = "Constance globale de la production.";
            $solutions[] = "Ne pas baisser la production";
        }
        
        if (CoteCalculationClass::penteTendance($months, "creanceClients") > 0) {
            $causes[] = "Augmentation globale des créances clients.";
            $solutions[] = "Renégocier largement les delais de paiement des créances clients.";
        }


        if (CoteCalculationClass::penteTendance($months, "creanceClients") == 0) {
            $causes[] = "Constance globale des créances clients.";
            $solutions[] = "Ammeliorer la gestion des delais de paiements des créances clients.";
        }
        
        
        if (CoteCalculationClass::penteTendance($months, "creanceClients") < 0) {
            $causes[] = "Diminution globale des créances clients.";
            $solutions[] = "Continuer à bien gerer les créances clients.";
        }


        if (CoteCalculationClass::penteTendance($months, "dettesFournisseurs") > 0) {
            $causes[] = "Augmentation des dettes fournisseurs.";
            $solutions[] = "Payer les dettes fournisseurs.";
        }


        if (CoteCalculationClass::penteTendance($months, "dettesSocialesEtFiscales") > 0) {
            $causes[] = "Augmentation des dettes sociales et fiscales.";
            $solutions[] = "Payer les dettes sociales et fiscales.";
        }

        return [
            'causes' => $causes,
            'solutions' => $solutions
        ];
    }





    // public static function analyseCausalite($months){
    //     $penteRatio = CoteCalculationClass::penteTendance($months, "ratioDeSolvabiliteGenerale");
    //     $penteActif = CoteCalculationClass::penteTendance($months, "matierePremiere");
    //     $pentePassif = CoteCalculationClass::penteTendance($months, "passifCourtTerme");


        
    //     $causes = [];

    //     $solutions = [];

    //     // -- CAS 1: DIMINUTION DU RATIO

    //     if ($penteRatio < 0) {
    //         if ($penteActif < 0) {
    //             CoteCalculationClass::analyserActifCourtTerme($months, $causes, $solutions);
    //         }

    //         if ($pentePassif > 0) {
    //             CoteCalculationClass::analyserPassifCourtTerme($months, $causes, $solutions);
    //         }

    //         if ($penteActif < 0 && $pentePassif > 0) {
    //             $causes[] = "Baisse de l’actif et augmentation du passif court terme.";
    //             $solutions[] = "Rééquilibrer les ressources de court terme.";
    //         }
    //     }

    //     // -- CAS 2: CONSTANCE DU RATIO
    //     elseif ($penteRatio == 0) {
    //         if ($penteActif == 0 && $pentePassif == 0) {
    //             $causes[] = "Stabilité des composantes du ratio.";
    //             $solutions[] = "Aucune action nécessaire.";
    //         } elseif ($penteActif < 0 && $pentePassif < 0) {
    //             $causes[] = "Baisse simultanée de l’actif et du passif court terme.";
    //             $solutions[] = "Stabiliser les ressources et les dettes à CT.";
    //         } elseif ($penteActif > 0 && $pentePassif > 0) {
    //             $causes[] = "Hausse parallèle des actifs et des passifs à CT.";
    //             $solutions[] = "Optimiser la croissance des actifs pour un meilleur excédent.";
    //         }
    //     }

    //     // -- CAS 3: AUGMENTATION DU RATIO

    //     else {
    //         if ($penteActif > 0) {
    //             $causes[] = "Hausse de l’actif court terme.";
    //             $solutions[] = "Poursuivre les efforts sur les flux entrants.";
    //             CoteCalculationClass::analyserActifCourtTerme($months, $causes, $solutions);
    //         }

    //         if ($pentePassif < 0) {
    //             $causes[] = "Diminution du passif court terme.";
    //             $solutions[] = "Bonne gestion des engagements à court terme.";
    //             CoteCalculationClass::analyserPassifCourtTerme($months, $causes, $solutions);
    //         }
    //     }

    //     return [
    //         'causes' => $causes,
    //         'solutions' => $solutions
    //     ];
    // }

    private static function analyserActifCourtTerme($months, &$causes, &$solutions) {
        $elements = [
            "matierePremiere" => ["cause" => "Diminution des matières premières.", "solution" => "Augmenter les approvisionnements."],
            "produitsFinis" => ["cause" => "Baisse des produits finis.", "solution" => "Renforcer la production."],
            "creanceClients" => ["cause" => "Baisse des créances clients.", "solution" => "Améliorer les ventes ou relancer les clients."],
        ];


        foreach ($elements as $key => $infos) {
            $pente = CoteCalculationClass::penteTendance($months, $key);
            if ($pente < 0) {
                $causes[] = $infos['cause'];
                $solutions[] = $infos['solution'];
            }
        }
    }

    private static function analyserPassifCourtTerme($months, &$causes, &$solutions) {
        $elements = [
            "dettesFournisseurs" => ["cause" => "Augmentation des dettes fournisseurs.", "solution" => "Payer ou négocier avec les fournisseurs."],
            "dettesSocialesEtFiscales" => ["cause" => "Hausse des dettes sociales/fiscales.", "solution" => "Mettre à jour les obligations fiscales."],
        ];
        foreach ($elements as $key => $infos) {
            $pente = CoteCalculationClass::penteTendance($months, $key);
            if ($pente > 0) {
                $causes[] = $infos['cause'];
                $solutions[] = $infos['solution'];
            }
        }
    }
}