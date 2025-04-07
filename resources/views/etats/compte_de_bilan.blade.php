


@extends('layouts.master')
@section('content')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #e0e0e0;
        }

        table th {
            background-color: #C6DAD3;
            align-items: center;
            color: #000;
        }

        .total {
            font-weight: bold;
            background-color: #f1f1f1;
        }
      
    </style>
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="transition-opacity duration-500">
                <div class="col-span-12 card 2xl:col-span-12 ">
                    <div class="card-body">
                        <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                            <div class="2xl:col-span-3 2xl:col-start-10">
                                <div class="flex justify-between items-center space-between align-items-center">
                                    <h2 class="mr-12" style="text-align: center; color: #1a73e8;">BILAN</h2>
                                    <div class="relative mb-2">
                                        <input id="date" type="date" class="pl-10 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:text-zink-200 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Selectionnez une date">
                                    </div>
                                </div>
                                <table>
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan = "2" style="font-size:30px;">ACTIF</th>
                                            <th class="text-center" colspan = "3">31/12/N</th>
                                              
                                        </tr> 
                                        <tr class="text-center">
                                            <th class="text-center">Brut</th>
                                            <th class="text-center">Amort.</th>  
                                            <th class="text-center">Net</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td  colspan="4" style="font-size:20px;">Immobilisations incorporelles</td>
                                        </tr>
                                        <tr>
                                            <td style="border-top:none;">Frais d'établissement</td>
                                            <td id="frais_etablissement_brut">0</td>
                                            <td id="frais_etablissement_amort">0</td>
                                            <td id="frais_etablissement_net">0</td>
                                        </tr>
                                        <tr>
                                            <td style="border-top:none;">Frais de recherche de développement</td>
                                            <td id="frais_recherche_brut">0</td>
                                            <td id="frais_recherche_amort">0</td>
                                            <td id="frais_recherche_net">0</td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="border-top:none;">Consession brevet droit similaire</td>
                                            <td id="concession_brevet_droit_brut">0</td>
                                            <td id="concession_brevet_droit_amort">0</td>
                                            <td id="concession_brevet_droit_net">0</td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="border-top:none;">Fond commercial</td>
                                            <td id="fond_commercial_brut">0</td>
                                            <td id="fond_commercial_amort">0</td>
                                            <td id="fond_commercial_net">0</td>
                                        </tr> 
                                        

                                        <tr>
                                            <td style="border-top:none;">Avances et acompte</td>
                                            <td id="avance_acompte_in_brut">0</td>
                                            <td id="avance_acompte_in_amort">0</td>
                                            <td id="avance_acompte_in_net">0</td>
                                        </tr>

                                        
                                        <tr>
                                            <td style="border-top:none;">Autres immobilisations incorporelles</td>
                                            <td id="autres_immobilisations_incorporelles_brut">0</td>
                                            <td id="autres_immobilisations_incorporelles_amort">0</td>
                                            <td id="autres_immobilisations_incorporelles_net">0</td>
                                        </tr>
                                        

                                        <tr>
                                            <td  colspan="4" style="font-size:20px;">Immobilisations corporelles</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Terrain</td>
                                            <td id="tarrain_brut">0</td>
                                            <td id="tarrain_amort">0</td>
                                            <td id="tarrain_net">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Constructions</td>
                                            <td id="constructions_brut">0</td>
                                            <td id="constructions_amort">0</td>
                                            <td id="constructions_net">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Installations techniques</td>
                                            <td id="installations_technique_brut">0</td>
                                            <td id="installations_technique_amort">0</td>
                                            <td id="installations_technique_net">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Immobilisations en cours</td>
                                            <td id="immobilisations_en_cours_brut">0</td>
                                            <td id="immobilisations_en_cours_amort">0</td>
                                            <td id="immobilisations_en_cours_net">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Avances et acompte</td>
                                            <td id="avance_acompte_brut">0</td>
                                            <td id="avance_acompte_amort">0</td>
                                            <td id="avance_acompte_net">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Matériel de bureau</td>
                                            <td id="materiel_de_bureau_brut">0</td>
                                            <td id="materiel_de_bureau_amort">0</td>
                                            <td id="materiel_de_bureau_net">0</td>
                                        </tr> 
                                        
                                        <tr>
                                            <td style="border-top:none;">Autres immobilisations corporelle</td>
                                            <td id="autre_immobilisation_corporelle_brut">0</td>
                                            <td id="autre_immobilisation_corporelle_amort">0</td>
                                            <td id="autre_immobilisation_corporelle_net">0</td>
                                        </tr>

                                        <tr>
                                            <td  colspan="4" style="font-size:20px;">Immobilisations financières</td>
                                        </tr>

                                      
                                        <tr>
                                            <td style="border-top:none;">Participation évaluée selon mise en équivalence</td>
                                            <td id="participation_evaluee_selon_mise_en_equivalence_brut">0</td>
                                            <td id="participation_evaluee_selon_mise_en_equivalence_amort">0</td>
                                            <td id="participation_evaluee_selon_mise_en_equivalence_net">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Autre participations</td>
                                            <td id="autre_participation_brut">0</td>
                                            <td id="autre_participation_amort">0</td>
                                            <td id="autre_participation_net">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Céances rattachées à des participations</td>
                                            <td id="creance_rattachee_a_des_participations_brut">0</td>
                                            <td id="creance_rattachee_a_des_participations_amort">0</td>
                                            <td id="creance_rattachee_a_des_participations_net">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Prêts</td>
                                            <td id="prets_brut">0</td>
                                            <td id="prets_amort">0</td>
                                            <td id="prets_net">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Autres immobilisations financières</td>
                                            <td id="autre_immobilisations_financieres_brut">0</td>
                                            <td id="autre_immobilisations_financieres_amort">0</td>
                                            <td id="autre_immobilisations_financieres_net">0</td>
                                        </tr>


                                        <tr>
                                            <td  colspan="4" style="font-size:20px;">Stock et en cours</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Matière première</td>
                                            <td id="matiere_premiere_brut">0</td>
                                            <td id="matiere_premiere_amort">0</td>
                                            <td id="matiere_premiere_net">0</td>
                                        </tr>


                                        <tr>
                                            <td style="border-top:none;">Produits finis</td>
                                            <td id="produits_finis_brut">0</td>
                                            <td id="produits_finis_amort">0</td>
                                            <td id="produits_finis_net">0</td>
                                        </tr>


                                        <tr>
                                            <td  colspan="4" style="font-size:20px;">Créances</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Créance clients</td>
                                            <td id="creances_clients_brut">0</td>
                                            <td id="creances_clients_amort">0</td>
                                            <td id="creances_clients_net">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Autre créances</td>
                                            <td id="autre_creances_brut">0</td>
                                            <td id="autre_creances_amort">0</td>
                                            <td id="autre_creances_net">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Capital souscrit, appelé non versé</td>
                                            <td id="capital_souscrit_appele_non_verse_brut">0</td>
                                            <td id="capital_souscrit_appele_non_verse_amort">0</td>
                                            <td id="capital_souscrit_appele_non_verse_net">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Valeur mobilière de placement</td>
                                            <td id="valeur_mobiliere_de_placement_brut">0</td>
                                            <td id="valeur_mobiliere_de_placement_amort">0</td>
                                            <td id="valeur_mobiliere_de_placement_net">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:none;">Disponiblités</td>
                                            <td id="dispoibilites_brut">0</td>
                                            <td id="dispoibilites_amort">0</td>
                                            <td id="dispoibilites_net">0</td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="border-top:none;">Charges contatées d'avance</td>
                                            <td id="charges_constatees_d_avance_brut">0</td>
                                            <td id="charges_constatees_d_avance_amort">0</td>
                                            <td id="charges_constatees_d_avance_net">0</td>
                                        </tr>

                                       

                                        <tr class="total text-center">
                                            <td>TOTAL ACTIF</td>
                                            <td colspan="3" id="total_actif" class="text-center">0</td>
                                        </tr>



                                        <tr>
                                            <td colspan="4" style="border:none;"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="border:none;"></td>
                                        </tr>
                                        
                                        

                                        <tr class="text-center">
                                            <th rowspan = "2" style="font-size:30px;">PASSIF</th>
                                            <th class="text-center" colspan="3">31/12/N</th>
                                              
                                        </tr>

                                        <tr class="text-center">
                                            <th class="text-center" colspan="3"> Net</th>
                                        </tr>
                                        
                                      

                                        <tr>
                                            <td colspan="4" style="font-size:20px;">Capitaux propres</td>
                                        </tr>

                                        <tr class="text-center">
                                            <td style="border-top:none;">Capital</td>
                                            <td colspan="3" class="text-center" id="capital_net">0</td>
                                        </tr> 


                                        <tr class="text-center">
                                            <td style="border-top:none;">Reserves</td>
                                            <td colspan="3" class="text-center" id="reserves_net">0</td>
                                        </tr>
                                        
                                        <tr class="text-center">
                                            <td style="border-top:none;">Resultat de l'exercice</td>
                                            <td colspan="3" class="text-center" id="resultat_de_l_exercice_net">0</td>
                                        </tr>

                                        <tr>
                                            <td colspan="4" style="font-size:20px;">Provisions</td>
                                        </tr>

                                        <tr class="text-center">
                                            <td style="border-top:none;">Provisions pour risques</td>
                                            <td colspan="3" class="text-center" id="provisions_pour_risques_net">0</td>
                                        </tr>
                                        
                                        <tr class="text-center">
                                            <td style="border-top:none;">Provisions pour impôts</td>
                                            <td colspan="3" class="text-center" id="provisions_pour_impots_net">0</td>
                                        </tr>
                                        
                                        <tr class="text-center">
                                            <td style="border-top:none;">Provisions pour charges</td>
                                            <td colspan="3" class="text-center" id="provisions_pour_charges_net">0</td>
                                        </tr>

                                        <tr>
                                            <td colspan="4" style="font-size:20px;">Dettes</td>
                                        </tr>


                                        <tr>
                                            <td class="font-bold" colspan="4" style="border-top:none; font-size:16px">Dettes financières</td>
                                        </tr>
                                        
                                        <tr class="text-center">
                                            <td style="border-top:none;">Dettes bancaires</td>
                                            <td colspan="3" class="text-center" id="dettes_bancaires_net">0</td>
                                        </tr>

                                        <tr class="text-center">
                                            <td style="border-top:none;">Autre dettes</td>
                                            <td colspan="3" class="text-center" id="autres_dettes_net">0</td>
                                        </tr>


                                        <tr>
                                            <td class="font-bold" colspan="4" style="border-top:none; font-size:16px">Dettes d'exploitation</td>
                                        </tr>

                                        
                                        <tr class="text-center">
                                            <td style="border-top:none;">Dettes fournisseurs</td>
                                            <td colspan="3" class="text-center" id="dettes_fournisseurs_net">0</td>
                                        </tr>



                                        <tr class="text-center">
                                            <td style="border-top:none;">Dettes sociales et fiscales</td>
                                            <td colspan="3" class="text-center" id="dettes_sociales_et_fiscales_net">0</td>
                                        </tr>


                                        <tr>
                                            <td class="font-bold" colspan="4" style="border-top:none; font-size:16px">Dettes divers</td>
                                        </tr>


                                        <tr class="text-center">
                                            <td style="border-top:none;">Dettes sur immobilisations</td>
                                            <td colspan="3" class="text-center" id="dettes_sur_immobilisations_net">0</td>
                                        </tr>


                                        <tr class="text-center">
                                            <td style="border-top:none;">Autres dettes d'exploitation</td>
                                            <td colspan="3" class="text-center" id="autres_dettes_exploitation_net">0</td>
                                        </tr>

                                        <tr class="total text-center">
                                            <td>TOTAL PASSIF</td>
                                            <td colspan="3" id="total_passif" class="text-center">0</td>
                                        </tr>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div id="pageEstCompteDeResultat" class="hidden"></div>
    <script>
        generateCostomisedConpteDeBilan();
    </script>
@endsection
