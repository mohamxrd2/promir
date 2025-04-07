@extends('layouts.master')
@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        
        .resultat-container {
            width: 80%;
            max-width: 800px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

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
        
        .result-net {
            text-align: center;
            padding: 15px;
            margin-top: 20px;
            border-top: 2px solid #1a73e8;
            font-size: 1.2em;
            font-weight: bold;
            color: #fff;
            background-color: #1a73e8;
        }
    </style>



    <div  class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class=" transition-opacity duration-500">
                <div class="col-span-12 card 2xl:col-span-12 ">
                    <div class="card-body">
                        <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                            <div class="2xl:col-span-3 2xl:col-start-10">
                                <div class="flex justify-between items-center space-between align-items-center">
                                    <h2 style="text-align: center; color: #1a73e8;">Compte de Résultat</h2>
                                    <div class="relative  mb-2">
                                        <i data-lucide="calendar-range" class="absolute size-4 left-3 top-3 text-slate-500 dark:text-zink-200"></i>
                                        <input type="number" class="pl-10 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:text-zink-200 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" readonly="readonly" placeholder="Selectionnez une date">
                                    </div>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th rowspan="2">LIBELLES</th>
                                            <th >EXERCICE AU 31/12/N</th>
                                            <th >EXERCICE AU 31/12/N-1</th>
                                        </tr> 
                                        <tr>
                                            <th >NET</th>
                                            <th >NET</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="border-bottom:none;">Recettes sur ventes ou prestations de services</td>
                                            <td>7</td>
                                            <td>30,000</td>
                                            <td>12,000</td>
                                        </tr>
                                        <tr>
                                            <td>KB</td>
                                            <td style="border-top:none;">Autres recettes sur activités</td>
                                            <td>97</td>
                                            <td>12,000</td>
                                            <td>500</td>
                                        </tr>

                                        <tr class="total">
                                            <td>KX</td>
                                            <td>TOTAL DES RECETTES SUR PRODUITS (A) (non compris recettes non encaissées)</td>
                                            <td></td>
                                            <td>4000</td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td>JA</td>
                                            <td style="border-bottom:none">Dépenses sur achats</td>
                                            <td>7</td>
                                            <td>100 000</td>
                                            <td></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>JB</td>
                                            <td style="border-bottom:none; border-top:none">Dépenses sur loyers</td>
                                            <td>7</td>
                                            <td>5 142</td>
                                            <td></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>JC</td>
                                            <td style="border-bottom:none; border-top:none">Dépenses sur salaires</td>
                                            <td>7</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>JD</td>
                                            <td style="border-bottom:none; border-top:none">Dépenses sur impôts et taxes</td>
                                            <td>7</td>
                                            <td>3 500</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>JE</td>
                                            <td style="border-bottom:none; border-top:none">Charges d'intérêts</td>
                                            <td>7</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        
                                        <tr >
                                            <td>JF</td>
                                            <td style="border-top:none;">Autres dépenses sur activités</td>
                                            <td>7</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        
                                        
                                        <tr class="total">
                                            <td>JX</td>
                                            <td>TOTAL DEPENSES SUR CHARGES(B) ( non compris charges non décaissées)</td>
                                            <td></td>
                                            <td>1 008 792</td>
                                            <td></td>
                                        </tr>
                                        
                                        <tr class="total">
                                            <td>KZ</td>
                                            <td>SOLDE (C): Excédent (+) ou insuffisance (-) de recettes (C= A - B)</td>
                                            <td></td>
                                            <td>-391 792</td>
                                            <td></td>
                                        </tr>
                                        
                                        
                                        <tr >
                                            <td>VA</td>
                                            <td style="border-bottom:none;">+ Variations des stocks sur les achats [N - (N-1)]  (D)</td>
                                            <td></td>
                                            <td>58 720</td>
                                            <td></td>
                                        </tr>
                                        
                                        <tr >
                                            <td>VB</td>
                                            <td style="border-bottom:none; border-top:none">+Variation des créances [N - (N-1)]  €</td>
                                            <td></td>
                                            <td>254 100</td>
                                            <td></td>
                                        </tr>

                                        <tr >
                                            <td>VC</td>
                                            <td style="border-bottom:none; border-top:none">- Variation des dettes d'exploitation [N - (N-1)]  (F)</td>
                                            <td></td>
                                            <td>238 000</td>
                                            <td></td>
                                        </tr>
                                        
                                        <tr >
                                            <td>JG</td>
                                            <td style="border-top:none;">DOTATIONS AUX AMORTISSEMENTS  (1)  (G)</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <tr class="total">
                                            <td>KZC</td>
                                            <td>RESULTAT DE L'EXERCICE  ( H =  C +  D + E - F - G)</td>
                                            <td></td>
                                            <td>-316 972</td>
                                            <td></td>
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
