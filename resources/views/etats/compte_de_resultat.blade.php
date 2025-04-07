


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
                                    <h2 class="mr-12" style="text-align: center; color: #1a73e8;">Compte de Résultat</h2>
                                    <div class="relative grow mb-2">
                                        <i data-lucide="calendar-range" class="absolute size-4 left-3 top-3 text-slate-500 dark:text-zink-200"></i>
                                        <input type="number" class="pl-10 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:text-zink-200 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" readonly="readonly" placeholder="Selectionnez une période">
                                    </div>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th rowspan="2">LIBELLES</th>
                                            <th>EXERCICE</th>
                                        </tr> 
                                        <tr>
                                            <th>NET</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="border-bottom:none;">Recettes sur ventes ou prestations de services</td>
                                            <td id="ca">0</td>
                                        </tr>
                                        <tr>
                                            <td style="border-top:none;">Autres recettes sur activités</td>
                                            <td id="autres_recettes">0</td>
                                        </tr>

                                        <tr class="total">
                                            <td>TOTAL DES RECETTES SUR PRODUITS (A) (non compris recettes non encaissées)</td>
                                            <td id="total_recettes">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-bottom:none">Dépenses sur achats</td>
                                            <td id="depenses_sur_achats">0</td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="border-bottom:none; border-top:none">Dépenses sur loyers</td>
                                            <td id="depenses_sur_loyer">0</td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="border-bottom:none; border-top:none">Dépenses sur salaires</td>
                                            <td id="depenses_sur_salaires">0</td>
                                        </tr>
                                        <tr>
                                            <td style="border-bottom:none; border-top:none">Dépenses sur impôts et taxes</td>
                                            <td id="depenses_sur_impots_et_taxes">0</td>
                                        </tr>
                                        <tr>
                                            <td style="border-bottom:none; border-top:none">Charges d'intérêts</td>
                                            <td id="charges_d_interets">0</td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="border-top:none;">Autres dépenses sur activités</td>
                                            <td id="autres_depenses_sur_activites">0</td>
                                        </tr>
                                        
                                        <tr class="total">
                                            <td>TOTAL DEPENSES SUR CHARGES (B) (non compris charges non décaissées)</td>
                                            <td id="total_depenses">0</td>
                                        </tr>
                                        
                                        <tr class="total">
                                            <td>SOLDE (C): Excédent (+) ou insuffisance (-) de recettes (C = A - B)</td>
                                            <td id="solde">0</td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="border-bottom:none;">+ Variations des stocks sur les achats [N - (N-1)] (D)</td>
                                            <td id="variation_stock">0</td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="border-bottom:none; border-top:none">+Variation des créances [N - (N-1)] (E)</td>
                                            <td id="variationCreance">0</td>
                                        </tr>

                                        <tr>
                                            <td style="border-bottom:none; border-top:none">- Variation des dettes d'exploitation [N - (N-1)] (F)</td>
                                            <td id="variationDettes">0</td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="border-top:none;">DOTATIONS AUX AMORTISSEMENTS (1) (G)</td>
                                            <td id="dotataion_aux_amortissements">0</td>
                                        </tr>

                                        <tr class="total">
                                            <td>RESULTAT DE L'EXERCICE (H = C + D + E - F - G)</td>
                                            <td id="resultat_exercice">0</td>
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
@endsection
