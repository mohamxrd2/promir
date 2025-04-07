@extends('layouts.master')
@section('content')
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex fixed relative flex-col gap-3 justify-between pt-2 pb-2 pl-12 w-full bg-white card lg:flex-row dark:bg-black">
                <div class="flex flex-col justify-start">
                <div class="flex flex-row gap-4 justify-between">
                        <h3>Revenus du jour</h3>
                        <h3 class="text-xs font-bold">{{session('devise')}}</h3>
                    </div>
                    <div class="flex flex-col justify-start content-center p-1 border border-black border-3">
                        <h1 class="text-xl font-bold lg:text-4xl">
                            {{number_format($revenus,2,".", " ")}}
                        </h1>
                    </div>
                </div> 
                <div class="flex flex-col justify-start">
                    <div class="flex flex-row gap-4 justify-between">
                        <h3>Revenus alloués</h3>
                        <h3 class="text-xs font-bold">{{session('devise')}}</h3>
                    </div>
                    <div class="flex flex-col justify-start content-center p-1 border border-black border-3">
                        <h1 id="ressourcesAllouees" class="text-xl font-bold lg:text-4xl">
                            <!-- Mettre le montant total alloué ici -->
                        </h1>
                    </div>
                </div> 
                <div class="flex flex-col justify-start">
                    <div class="flex flex-row gap-4 justify-between">
                        <h3>Reste non alloué</h3>
                        <h3 class="text-xs font-bold">{{session('devise')}}</h3>
                    </div>
                    <div class="flex flex-col justify-start content-center p-1 border border-black border-3">
                        <h1 id="resteRevenus" class="text-xl font-bold lg:text-4xl">
                            <!-- Mettre le montant restant ici -->
                        </h1>
                    </div>
                </div> 
                
                <div class="flex flex-col justify-start">
                   
                </div> 
                
                <div class="flex flex-col justify-start">
                   
                </div> 
            </div>
           
            <div class="duration-500">
                <div class="col-span-12 card 2xl:col-span-12">
                    
                    <div class="overflow-x-auto w-full card-body">
                        <div class="grid grid-cols-1 gap-3 items-center mb-5 sm:grid-cols-2 md:grid-cols-4 xl:grid-cols-12">

                            <div class="2xl:col-span-3 2xl:col-start-10">
                                <div class="mb-2">
                                    <h3 class="text-blod">DETTES FOURNISSEURS</h3>
                                </div>
                                <table id="detteFournisseursTable" class="editableTable hover:shadow-lg">
                                    <thead class="bg-none">
                                        <tr> 
                                            <th colspan="6" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">DETTE</th>
                                            <th colspan="3" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">DUE</th>
                                            <th colspan="1" rowspan="3" class="px-6 py-0 w-12 truncate border border-b-0 border-black bg-slate-400"></th>
                                            <th colspan="3" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">PROVISION</th>
                                        </tr>
                                            
                                        <tr>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">#REF</th>
                                            <th colspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Fournisseur</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Effet</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Echéance</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Montant</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border-black text-bmack bg-slate-400">CUMUL J-1</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 w-12 text-center truncate border border-black text-bmack bg-slate-400">J-0</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TOTAL</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">CUMUL J-1</th>
                                            <th colspan="1" rowspan="2" class="w-12 text-center border border-black text-bmack bg-slate-400">J-0</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TOTAL</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">SOLDE</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TAUX</th>
                                        </tr>
                                        <tr>
                                            <th class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Nom</th>
                                            <th class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Mail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalDesAllocationsDeduitDuRevenu = 0.0;
                                            $tMontant = 0.0;
                                            $tCumulDu = 0.0;
                                            $tPortions = 0.0;
                                            $tPortionsDuForSpecificTable = 0.0;
                                            $tPortionsProv = 0.0;
                                            $tCumulProv = 0.0;
                                            foreach($detteFournisseurs as $dette){
                                                $tMontant += $dette->montant;
                                                $tCumulDu += $dette->cumul;
                                                $tCumulProv += $dette->provision ? $dette->provision->montant : 0;
                                                // On augmente le total des portions journalieres en fonction des dettes fournisseurs
                                                $tPortions += $dette->portion_journaliere;
                                            }

                                            foreach($detteBancaires as $dette){
                                                // On augmente le total des portions journalieres en fonction des dettes banques
                                                $tPortions += $dette->portion_journaliere;
                                            } 
                                            
                                            foreach($autresDetteFinancieres as $dette){
                                                // On augmente le total des portions journalieres en fonction des autres dettes financieres
                                                $tPortions += $dette->portion_journaliere;
                                            }
                                            
                                            foreach($charges as $charge){
                                                // On augmente le total des portions journalieres en fonction des charges
                                                $tPortions += $charge->portion_journaliere;
                                            }
                                            
                                            foreach($epargnes as $epargne){
                                                // On augmente le total des portions journalieres en fonction des epargnes
                                                $tPortions += $epargne->montant;
                                            }

                                            // dd($revenus)
                                        @endphp
                                        @forelse ($detteFournisseurs as $dette)
                                            @php
                                                $allocationDuJour = min($dette->portion_journaliere, $tPortions > 0 ? ($dette->portion_journaliere * $revenus) / $tPortions : 0) ;
                                                $totalDesAllocationsDeduitDuRevenu += $allocationDuJour;
                                                $tPortionsProv += $allocationDuJour;
                                                $tPortionsDuForSpecificTable += $dette->portion_journaliere;
                                                $totalProvisionneRow = $dette->portion_journaliere + $dette->cumul;
                                                $solde = $allocationDuJour + $dette->provision?->montant - $dette->portion_journaliere - $dette->cumul;
                                            @endphp
                                            <tr data-id-dette="{{ $dette->id }}" class="notLastOfTable">
                                                <td class="text-left truncate border border-black text-xm">{{$today}}{{$loop->iteration}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{$dette->approvisionnementSystemProduit->approvisionnement->ligneFournisseur->fournisseur->nom}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{$dette->approvisionnementSystemProduit->approvisionnement->ligneFournisseur->fournisseur->email}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{$dette->date_effet?->format('Y-m-d')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{$dette->date_echeance?->format('Y-m-d')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($dette->montant, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($dette->cumul, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($dette->portion_journaliere, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($totalProvisionneRow, 2, '.', ' ')}}</td>
                                                <td class="w-12 border-none bg-slate-400"></td>
                                                <td class="text-left truncate border border-black text-xm numeric-cell" contenteditable="true">{{number_format($dette->provision?->montant, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm numeric-cell" contenteditable="true">{{number_format($allocationDuJour, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($allocationDuJour + $dette->provision?->montant, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($solde, 2, '.', ' ')}}</td>
                                                
                                               
                                                
                                                @if ($tPortions != 0 && $totalProvisionneRow != 0)
                                                    <td class="text-left truncate border border-black text-xm">{{number_format($solde / $totalProvisionneRow, 2, '.', ' ')}}%</td>
                                                @else
                                                    <td class="text-left truncate border border-black text-xm"> 0.00%</td>                                     
                                                @endif
                                            </tr>
                                        @empty                                                                                     
                                            <tr>
                                                <td colspan="15" class="text-left text-green-500 truncate border border-black text-xm">Pas de dette fournisseurs...</td>
                                            </tr>
                                        @endforelse
                                        <tr id="isLastRowOfDetteFournisseurs">
                                            <td colspan="5" class="text-left truncate border border-black text-bold text-xm">Total</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tMontant, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulDu, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tPortionsDuForSpecificTable, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulDu + $tPortionsDuForSpecificTable, 2, '.', ' ')}}</td>
                                            <td class="w-12 border-none bg-slate-400"></td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm table-total-allocations">{{number_format($tPortionsProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv + $tPortionsProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv - $tCumulDu, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format(($tCumulDu + $tPortionsProv) != 0 ? ($tCumulProv - $tCumulDu) / ($tCumulDu + $tPortionsProv) : 0, 2, '.', ' ')}} %</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="mt-6 mb-2 w-auto">
                                    <h3 class="text-blod">DETTES BANCAIRES</h3>
                                </div>

                                <table id="dettesBancairesTable" class="min-w-full editableTable hover:shadow-lg">
                                    <thead class="bg-none">
                                        <tr> 
                                            <th colspan="6" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">DETTE</th>
                                            <th colspan="3" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">DUE</th>
                                            <th colspan="1" rowspan="3" class="px-6 py-0 w-12 truncate border border-b-0 border-black bg-slate-400"></th>
                                            <th colspan="3" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">PROVISION</th>
                                        </tr>
                                            
                                        <tr>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">#REF</th>
                                            <th colspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Banque</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Effet</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Echéance</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Montant</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border-black text-bmack bg-slate-400">CUMUL J-1</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 w-12 text-center truncate border border-black text-bmack bg-slate-400">J-0</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TOTAL</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">CUMUL J-1</th>
                                            <th colspan="1" rowspan="2" class="w-12 text-center border border-black text-bmack bg-slate-400">J-0</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TOTAL</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">SOLDE</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TAUX</th>
                                        </tr>
                                        <tr>
                                            <th class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Nom</th>
                                            <th class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Sigle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $tMontant = 0.0;
                                            $tCumulDu = 0.0;
                                            $tPortionsProv = 0.0;
                                            $tPortionsDuForSpecificTable = 0.0;
                                            $tCumulProv = 0.0;
                                            foreach($detteBancaires as $dette){
                                                $tMontant += $dette->montant_emprunte + $dette->montant_interet;
                                                $tCumulDu += $dette->cumul;
                                                
                                                $tCumulProv += $dette->provision ? $dette->provision->montant : 0;

                                            }

                                        @endphp
                                        @forelse ($detteBancaires as $dette)
                                            @php
                                                $allocationDuJour = min($dette->portion_journaliere, $tPortions > 0 ? ($dette->portion_journaliere * $revenus) / $tPortions : 0) ;
                                                $totalDesAllocationsDeduitDuRevenu += $allocationDuJour;                                               
                                                $tPortionsProv += $allocationDuJour;
                                                $tPortionsDuForSpecificTable += $dette->portion_journaliere;
                                                $totalProvisionneRow = $dette->portion_journaliere + $dette->cumul;
                                                $solde = $allocationDuJour + $dette->provision?->montant - $dette->portion_journaliere - $dette->cumul;
                                                $montantDette = $dette->montant_emprunte + $dette->montant_interet;

                                            @endphp
                                            <tr 
                                                data-id-dette="{{ $dette->id }}" class="notLastOfTable"
                                            >
                                                <td class="text-left truncate border border-black text-xm">{{$today}}{{$loop->iteration}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{$dette->banque->nom}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{$dette->banque->sigle}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{$dette->date_effet?->format('Y-m-d')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{$dette->date_echeance?->format('Y-m-d')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($montantDette, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($dette->cumul, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($dette->portion_journaliere, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($totalProvisionneRow, 2, '.', ' ')}}</td>
                                                <td class="w-12 border-none bg-slate-400"></td>
                                                <td class="text-left truncate border border-black text-xm numeric-cell" contenteditable="true">{{number_format($dette->provision?->montant, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm numeric-cell" contenteditable="true">{{number_format($allocationDuJour, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($allocationDuJour + $dette->provision?->montant, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($solde, 2, '.', ' ')}}</td>

                                                
                                                @if ($tPortions != 0 && $totalProvisionneRow != 0)
                                                    <td class="text-left truncate border border-black text-xm">{{number_format($solde / $totalProvisionneRow, 2, '.', ' ')}}%</td>
                                                @else
                                                    <td class="text-left truncate border border-black text-xm"> 0.00%</td>                                     
                                                @endif
                                            </tr>
                                        @empty                                                                                         
                                            <tr>
                                                <td colspan="15" class="text-left text-green-500 truncate border border-black text-xm">Pas de dette fournisseurs...</td>
                                            </tr>
                                        @endforelse
                                        <tr id="isLastRowOfDetteBanques">
                                            <td colspan="5" class="text-left truncate border border-black text-bold text-xm">Total</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tMontant, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulDu, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tPortionsDuForSpecificTable, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulDu + $tPortionsDuForSpecificTable, 2, '.', ' ')}}</td>
                                            <td class="w-12 border-none bg-slate-400"></td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm table-total-allocations">{{number_format($tPortionsProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv + $tPortionsProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv - $tCumulDu, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format(($tCumulDu + $tPortionsProv) != 0 ? ($tCumulProv - $tCumulDu) / ($tCumulDu + $tPortionsProv) : 0, 2, '.', ' ')}} %</td>
                                        </tr>
                                    </tbody>
                                </table>


                                <div class="mt-6 mb-2 w-auto">
                                    <h3 class="text-blod">AUTRES DETTES FINANCIERES</h3>
                                </div>


                                <table id="autresDettesFinancieresTable" class="min-w-full editableTable hover:shadow-lg">
                                    <thead class="bg-none">
                                        <tr> 
                                            <th colspan="6" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">DETTE</th>
                                            <th colspan="3" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">DUE</th>
                                            <th colspan="1" rowspan="3" class="px-6 py-0 w-12 truncate border border-b-0 border-black bg-slate-400"></th>
                                            <th colspan="3" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">PROVISION</th>
                                        </tr>
                                            
                                        <tr>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">#REF</th>
                                            <th colspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Créancier</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Effet</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Echéance</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Montant</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border-black text-bmack bg-slate-400">CUMUL J-1</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 w-12 text-center truncate border border-black text-bmack bg-slate-400">J-0</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TOTAL</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">CUMUL J-1</th>
                                            <th colspan="1" rowspan="2" class="w-12 text-center border border-black text-bmack bg-slate-400">J-0</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TOTAL</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">SOLDE</th>
                                            <th colspan="1" rowspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TAUX</th>
                                        </tr>
                                        <tr>
                                            <th class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Nom</th>
                                            <th class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Mail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $tMontant = 0.0;
                                            $tCumulDu = 0.0;
                                            $tPortionsProv = 0.0;
                                            $tCumulProv = 0.0;
                                            $tPortionsDuForSpecificTable = 0.0;
                                            foreach($autresDetteFinancieres as $dette){
                                                $tMontant += $dette->montant_emprunte + $dette->montant_interet;
                                                $tCumulDu += $dette->cumul;
                                                $tCumulProv += $dette->provision ? $dette->provision->montant : 0;

                                            }

                                        @endphp
                                        @forelse ($autresDetteFinancieres as $dette)
                                            @php
                                                $allocationDuJour = min($dette->portion_journaliere, $tPortions > 0 ? ($dette->portion_journaliere * $revenus) / $tPortions : 0) ;
                                                $totalDesAllocationsDeduitDuRevenu += $allocationDuJour;
                                                $tPortionsProv += $allocationDuJour;
                                                $montantDette = $dette->montant_emprunte + $dette->montant_interet;
                                                $totalProvisionneRow = $dette->portion_journaliere + $dette->cumul;
                                                $tPortionsDuForSpecificTable += $dette->portion_journaliere;
                                                $solde = $allocationDuJour + $dette->provision?->montant - $dette->portion_journaliere - $dette->cumul;
                                            @endphp
                                            <tr 
                                                data-id-dette="{{ $dette->id }}" class="notLastOfTable"
                                            >
                                                <td class="text-left truncate border border-black text-xm">{{$today}}{{$loop->iteration}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{$dette->nom_creancier}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{$dette->mail_creancier}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{$dette->date_effet?->format('Y-m-d')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{$dette->date_echeance?->format('Y-m-d')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($montantDette, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($dette->cumul, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($dette->portion_journaliere, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($totalProvisionneRow, 2, '.', ' ')}}</td>
                                                <td class="w-12 border-none bg-slate-400"></td>
                                                <td class="text-left truncate border border-black text-xm numeric-cell" contenteditable="true">{{number_format($dette->provision?->montant, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm numeric-cell" contenteditable="true">{{number_format($allocationDuJour, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($allocationDuJour + $dette->provision?->montant, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($solde, 2, '.', ' ')}}</td>


                                                @if ($tPortions != 0 && $totalProvisionneRow != 0)
                                                    <td class="text-left truncate border border-black text-xm">{{number_format($solde / $totalProvisionneRow, 2, '.', ' ')}}%</td>
                                                @else
                                                    <td class="text-left truncate border border-black text-xm"> 0.00%</td>                                     
                                                @endif
                                            </tr>
                                        @empty                                                                                         
                                            <tr>
                                                <td colspan="15" class="text-left text-green-500 truncate border border-black text-xm">Pas d'autres dettes financières...</td>
                                            </tr>
                                        @endforelse
                                        <tr id="isLastRowOfAutreDetteFinancieres">
                                            <td colspan="5" class="text-left truncate border border-black text-bold text-xm">Total</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tMontant, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulDu, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tPortionsDuForSpecificTable, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulDu + $tPortionsDuForSpecificTable, 2, '.', ' ')}}</td>
                                            <td class="w-12 border-none bg-slate-400"></td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm table-total-allocations">{{number_format($tPortionsProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv + $tPortionsProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv - $tCumulDu, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format(($tCumulDu + $tPortionsProv) != 0 ? ($tCumulProv - $tCumulDu) / ($tCumulDu + $tPortionsProv) : 0, 2, '.', ' ')}} %</td>
                                        </tr>
                                    </tbody>
                                </table> 


                                <div class="mt-6 mb-2 w-auto">
                                    <h3 class="text-blod">CHARGES</h3>
                                </div>

                                <table id="chargesTable" class="min-w-full editableTable hover:shadow-lg">
                                    <thead class="bg-none">
                                        <tr> 
                                            <th colspan="4" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">CHARGE</th>
                                            <th colspan="3" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">DUE</th>
                                            <th colspan="1" rowspan="3" class="px-6 py-0 w-12 truncate border border-b-0 border-black bg-slate-400"></th>
                                            <th colspan="3" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">PROVISION</th>
                                        </tr>
                                            
                                        <tr>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">#REF</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Effet</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Echéance</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Montant</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border-black text-bmack bg-slate-400">CUMUL J-1</th>
                                            <th colspan="1" class="px-6 py-0 w-12 text-center truncate border border-black text-bmack bg-slate-400">J-0</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TOTAL</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">CUMUL J-1</th>
                                            <th colspan="1" class="w-12 text-center border border-black text-bmack bg-slate-400">J-0</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TOTAL</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">SOLDE</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TAUX</th>
                                        </tr>
                                       
                                    </thead>
                                    <tbody>
                                        @php
                                            $tMontant = 0.0;
                                            $tCumulDu = 0.0;
                                            $tPortionsProv = 0.0;
                                            $tCumulProv = 0.0;
                                            $tPortionsDuForSpecificTable = 0.0;
                                            foreach($charges as $charge){
                                                $tMontant += $charge->montant;
                                                $tCumulDu +=  $charge->cumul;
                                                $tCumulProv +=$charge->provision ?$charge->provision->montant : 0;
                                            }
                                        @endphp
                                        @forelse ($charges as $charge)
                                            @php
                                                $allocationDuJour = min($charge->portion_journaliere, $tPortions > 0 ? ($charge->portion_journaliere * $revenus) / $tPortions : 0) ;
                                                $totalDesAllocationsDeduitDuRevenu += $allocationDuJour;
                                                $tPortionsProv += $allocationDuJour;
                                                $montantDette =$charge->montant;
                                                $totalProvisionneRow =$charge->portion_journaliere + $charge->cumul;
                                                $tPortionsDuForSpecificTable +=$charge->portion_journaliere;
                                                $solde = $allocationDuJour +$charge->provision?->montant -$charge->portion_journaliere -$charge->cumul;
                                            @endphp
                                            <tr 
                                                data-id-dette="{{$charge->id }}" class="notLastOfTable"
                                            >
                                                <td class="text-left truncate border border-black text-xm">{{$today}}{{$loop->iteration}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{$charge->date_effet?->format('Y-m-d')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{$charge->date_echeance?->format('Y-m-d')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($montantDette, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($charge->cumul, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($charge->portion_journaliere, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($totalProvisionneRow, 2, '.', ' ')}}</td>
                                                <td class="w-12 border-none bg-slate-400"></td>
                                                <td class="text-left truncate border border-black text-xm numeric-cell" contenteditable="true">{{number_format($charge->provision?->montant, 2, '.', ' ')}}</td>
                                                
                                                <td class="text-left truncate border border-black text-xm numeric-cell" contenteditable="true">{{number_format($allocationDuJour, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($allocationDuJour +$charge->provision?->montant, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($solde, 2, '.', ' ')}}</td>
                                                
                                                <td class="text-left truncate border border-black text-xm">{{number_format($totalProvisionneRow != 0 ? $solde / $totalProvisionneRow : 0, 2, '.', ' ')}}%</td>
                                                
                                            </tr>
                                        @empty                                                                                         
                                            <tr>
                                                <td colspan="15" class="text-left text-green-500 truncate border border-black text-xm">Pas d'autres dettes financières...</td>
                                            </tr>
                                        @endforelse
                                        <tr id="isLastRowOfCharges">
                                            <td colspan="3" class="text-left truncate border border-black text-bold text-xm">Total</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tMontant, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulDu, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tPortionsDuForSpecificTable, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulDu + $tPortionsDuForSpecificTable, 2, '.', ' ')}}</td>
                                            <td class="w-12 border-none bg-slate-400"></td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm table-total-allocations">{{number_format($tPortionsProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv + $tPortionsProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv - $tCumulDu, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format(($tCumulDu + $tPortionsProv) != 0 ? ($tCumulProv - $tCumulDu) / ($tCumulDu + $tPortionsProv) : 0, 2, '.', ' ')}} %</td>
                                        </tr>
                                    </tbody>
                                </table>


                                <div class="mt-6 mb-2 w-auto">
                                    <h3 class="text-blod">EPARGNES</h3>
                                </div>

                                <table id="epargnesTable" class="min-w-full editableTable hover:shadow-lg">
                                    <thead class="bg-none">
                                        <tr> 
                                            <th colspan="2" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">EPARGNE</th>
                                            <th colspan="3" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">DUE</th>
                                            <th colspan="1" rowspan="3" class="px-6 py-0 w-12 truncate border border-b-0 border-black bg-slate-400"></th>
                                            <th colspan="3" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">PROVISION</th>
                                        </tr>
                                            
                                        <tr>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Libelle</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">Mantant</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border-black text-bmack bg-slate-400">CUMUL J-1</th>
                                            <th colspan="1" class="px-6 py-0 w-12 text-center truncate border border-black text-bmack bg-slate-400">J-0</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TOTAL</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">CUMUL J-1</th>
                                            <th colspan="1" class="w-12 text-center border border-black text-bmack bg-slate-400">J-0</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TOTAL</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">SOLDE</th>
                                            <th colspan="1" class="px-6 py-0 text-center truncate border border-black text-bmack bg-slate-400">TAUX</th>
                                        </tr>
                                       
                                    </thead>
                                    <tbody>
                                        @php
                                            $tMontant = 0.0;
                                            $tCumulDu = 0.0;
                                            $tPortionsProv = 0.0;
                                            $tCumulProv = 0.0;
                                            $tPortionsDuForSpecificTable = 0.0;
                                            foreach($epargnes as $epargne){
                                                $tMontant += $epargne->montant;
                                                $tCumulDu +=  $epargne->cumul;
                                                $tCumulProv += $epargne->provision ? $epargne->provision->montant : 0;
                                            }
                                        @endphp
                                        @forelse ($epargnes as $epargne)
                                            @php
                                                $allocationDuJour = min($epargne->montant, $tPortions > 0 ? ($epargne->montant * $revenus) / $tPortions : 0) ;
                                                $totalDesAllocationsDeduitDuRevenu += $allocationDuJour;
                                                $tPortionsProv += $allocationDuJour;
                                                $totalProvisionneRow =$epargne->montant + $epargne->cumul;
                                                $tPortionsDuForSpecificTable += $epargne->montant;
                                                $solde = $allocationDuJour + $epargne->provision?->montant - $epargne->montant - $epargne->cumul;

                                           
                                            @endphp
                                            <tr 
                                                data-id-dette="{{$epargne->id }}" class="notLastOfTable"
                                            >
                                                <td class="text-left truncate border border-black text-xm">{{$epargne->libelle}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($epargne->montant, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($epargne->cumul, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($epargne->montant, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($totalProvisionneRow, 2, '.', ' ')}}</td>
                                                <td class="w-12 border-none bg-slate-400"></td>
                                                <td class="text-left truncate border border-black text-xm numeric-cell" contenteditable="true">{{number_format($epargne->provision?->montant, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm numeric-cell" contenteditable="true">{{number_format($allocationDuJour, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($allocationDuJour + $epargne->provision?->montant, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($solde, 2, '.', ' ')}}</td>
                                                <td class="text-left truncate border border-black text-xm">{{number_format($totalProvisionneRow != 0 ? $solde / $totalProvisionneRow : 0, 2, '.', ' ')}}%</td>
                                            </tr>
                                        @empty                                                                                         
                                            <tr>
                                                <td colspan="15" class="text-left text-green-500 truncate border border-black text-xm">Pas d'autres dettes financières...</td>
                                            </tr>
                                        @endforelse
                                        <tr id="isLastRowOfEpargne">
                                            <td colspan="1" class="text-left truncate border border-black text-bold text-xm">Total</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tMontant, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulDu, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tPortionsDuForSpecificTable, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulDu + $tPortionsDuForSpecificTable, 2, '.', ' ')}}</td>
                                            <td class="w-12 border-none bg-slate-400"></td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm table-total-allocations">{{number_format($tPortionsProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv + $tPortionsProv, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format($tCumulProv - $tCumulDu, 2, '.', ' ')}}</td>
                                            <td class="text-left truncate border border-black text-xm">{{number_format(($tCumulDu + $tPortionsProv) != 0 ? ($tCumulProv - $tCumulDu) / ($tCumulDu + $tPortionsProv) : 0, 2, '.', ' ')}} %</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end pr-3 pb-3 mt-5">
                        <button id="addBtn" class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-bleu-600">Enregistrer</button>
                    </div>
                </div> 
            </div>
        </div>
    </div>






    <script>
        function sendData(){
            document.getElementById('addBtn').addEventListener('click', function () {
                const detteFournisseursTable = document.getElementById('detteFournisseursTable');
                const dettesBancairesTable = document.getElementById('dettesBancairesTable');
                const autresDettesFinancieresTable = document.getElementById('autresDettesFinancieresTable');
                const chargesTable = document.getElementById('chargesTable');
                const epargnesTable = document.getElementById('epargnesTable');

                const detteFournisseurs = [];
                const dettesBancaires = [];
                const autresDettesFinancieres = [];
                const charges = [];
                const epargnes = [];


                detteFournisseursTable.querySelectorAll('tbody tr.notLastOfTable').forEach(function (tr) {
                    detteFournisseurs[tr.getAttribute('data-id-dette')] = (convertirEnNombre(tr.children[11].textContent.trim()) || 0.00);
                });
                
                dettesBancairesTable.querySelectorAll('tbody tr.notLastOfTable').forEach(function (tr) {
                    dettesBancaires[tr.getAttribute('data-id-dette')] = (convertirEnNombre(tr.children[11].textContent.trim()) || 0.00);
                });
                
                
                autresDettesFinancieresTable.querySelectorAll('tbody tr.notLastOfTable').forEach(function (tr) {
                    autresDettesFinancieres[tr.getAttribute('data-id-dette')] = (convertirEnNombre(tr.children[11].textContent.trim()) || 0.00);
                });
                
                chargesTable.querySelectorAll('tbody tr.notLastOfTable').forEach(function (tr) {
                    charges[tr.getAttribute('data-id-dette')] = (convertirEnNombre(tr.children[9].textContent.trim()) || 0.00);
                });
                
                epargnesTable.querySelectorAll('tbody tr.notLastOfTable').forEach(function (tr) {
                    epargnes[tr.getAttribute('data-id-dette')] = (convertirEnNombre(tr.children[7].textContent.trim()) || 0.00);
                });


                epargnes.forEach(function(provision, dette){
                    c("Dette: " + dette + "| Provision: " + provision)
                })
                

                $.ajax({
                    url: '/store-store-provision-jour',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        dette_fournisseurs : detteFournisseurs,
                        dettes_bancaires : dettesBancaires,
                        autresDettes_financieres : autresDettesFinancieres,
                        charges_ : charges,
                        epargnes_ : epargnes,
                     },
                    success: function(response) {
                        if(response.OK) toastr.success('Données inserées avec succès.');
                    },
                    error: function(error) {
                        console.error(error);
                        toastr.error('Erreur de connexion. Veuillez réessayer.');
                    }
                });
            });

        }

        let tMontant = 0.0;
        let tCumulDu = 0.0;
        let tPortions = 0.0;
        let tCumulProv = 0.0;
        let totalDesAllocations = 0.0;

        function rows(table){
            return document.querySelectorAll(table + " tbody tr.notLastOfTable");
        }

        function addEventsToCells(rows, correspondantCell, correspondantCellColumnTotal, totalDuOfTable, totalCumulProvOfTable, totalAllocationsProvOfTable, totalDuOfRow, totalProvOfTable, totalSoldeOfTable, cumulOfRow, totalTauxOfTable, allocationOfRow, totalOfRow, soldeOfRow, tauxOfRow, isLastRowOfTable_){
                const isLastRowOfTable = document.getElementById(isLastRowOfTable_);
                rows.forEach(function(row){
                    controlCellInput(row.children[correspondantCell])
                    row.children[correspondantCell].addEventListener('input', function(){
                        tPortions = 0.00;
                        rows.forEach(function(row){
                            tPortions += convertirEnNombre(row.children[correspondantCell].textContent.trim()) || 0;
                        })


                        row.children[totalOfRow].textContent = formatNumber((convertirEnNombre(row.children[allocationOfRow].textContent.trim())  || 0) + (convertirEnNombre(row.children[cumulOfRow].textContent.trim()) || 0))
                        row.children[soldeOfRow].textContent = formatNumber((convertirEnNombre(row.children[totalOfRow].textContent.trim())  || 0) - (convertirEnNombre(row.children[totalDuOfRow].textContent.trim()) || 0))
                        row.children[tauxOfRow].textContent = 
                        (convertirEnNombre(row.children[totalDuOfRow].textContent.trim()) || 0) !== 0 
                        ? formatNumber((convertirEnNombre(row.children[soldeOfRow].textContent.trim()) || 0) / 
                        (convertirEnNombre(row.children[totalDuOfRow].textContent.trim()) || 0)) + " %" 
                        : "0 %";


                        isLastRowOfTable.children[correspondantCellColumnTotal].textContent = formatNumber(tPortions);

                        isLastRowOfTable.children[totalProvOfTable].textContent = formatNumber((convertirEnNombre(isLastRowOfTable.children[totalAllocationsProvOfTable].textContent.trim())  || 0) + (convertirEnNombre(isLastRowOfTable.children[totalCumulProvOfTable].textContent.trim()) || 0));
                        isLastRowOfTable.children[totalSoldeOfTable].textContent = formatNumber((convertirEnNombre(isLastRowOfTable.children[totalProvOfTable].textContent.trim())  || 0) - (convertirEnNombre(isLastRowOfTable.children[totalDuOfTable].textContent.trim()) || 0));


                        isLastRowOfTable.children[totalTauxOfTable].textContent = 
                        (convertirEnNombre(isLastRowOfTable.children[totalDuOfTable].textContent.trim()) || 0) !== 0 
                        ? formatNumber((convertirEnNombre(isLastRowOfTable.children[totalSoldeOfTable].textContent.trim()) || 0) / 
                        (convertirEnNombre(isLastRowOfTable.children[totalDuOfTable].textContent.trim()) || 0)) + " %" 
                        : "0 %";

                        totalDesAllocations = 0;
                        
                        document.querySelectorAll('.table-total-allocations').forEach(function(td){
                            totalDesAllocations += convertirEnNombre(td.textContent.trim());
                        })

                        document.getElementById("ressourcesAllouees").textContent = formatNumber(totalDesAllocations);
                        document.getElementById("resteRevenus").textContent = formatNumber(@json($revenus) - totalDesAllocations);
                    });
                })
            }



                                            //#Dette fournisseur table
       
        //  Calling the function for the CUMUL J-1 cells
         addEventsToCells(rows("#detteFournisseursTable"), 10, 6 , 4, 6, 7, 8, 8, 9, 10, 10, 11, 12, 13, 14, "isLastRowOfDetteFournisseurs")
        // Function called for the CUMUL J-1 cells
        

        // Calling the function for the J-0 cells
            addEventsToCells(rows("#detteFournisseursTable"), 11, 7, 4, 6, 7, 8, 8, 9, 10, 10, 11, 12, 13, 14,"isLastRowOfDetteFournisseurs")
        // Function called for the J-0 cells
        


                                        // #Dette banque table
        
        // // Calling the function for the CUMUL J-1 cells
         addEventsToCells(rows("#dettesBancairesTable"), 10, 6 , 4, 6, 7, 8, 8, 9, 10, 10, 11, 12, 13, 14, "isLastRowOfDetteBanques")
        // Function called for the CUMUL J-1 cells
        

        // Calling the function for the J-0 cells
            addEventsToCells(rows("#dettesBancairesTable"), 11, 7 , 4, 6, 7, 8, 8, 9, 10, 10, 11, 12, 13, 14, "isLastRowOfDetteBanques")
        // Function called for the J-0 cells


                                        // #autresDettesFinancieresTable

        // // // Calling the function for the CUMUL J-1 cells
         addEventsToCells(rows("#autresDettesFinancieresTable"), 10, 6 , 4, 6, 7, 8, 8, 9, 10, 10, 11, 12, 13, 14, "isLastRowOfAutreDetteFinancieres")
        // Function called for the CUMUL J-1 cells
        

        // Calling the function for the J-0 cells
            addEventsToCells(rows("#autresDettesFinancieresTable"), 11, 7 , 4, 6, 7, 8, 8, 9, 10, 10, 11, 12, 13, 14, "isLastRowOfAutreDetteFinancieres")
        // Function called for the J-0 cells


                                            // #Charges table

        // // // Calling the function for the CUMUL J-1 cells
        addEventsToCells(rows("#chargesTable"), 8, 6, 4, 6, 7, 6, 8, 9, 8, 10, 9, 10, 11, 12, "isLastRowOfCharges")
        // Function called for the CUMUL J-1 cells

        // Calling the function for the J-0 cells
            addEventsToCells(rows("#chargesTable"), 9, 7, 4, 6, 7, 6, 8, 9, 8, 10, 9, 10, 11, 12, "isLastRowOfCharges")
        // Function called for the J-0 cells
       
                                
                    
                                    // #Charges table

        // // // Calling the function for the CUMUL J-1 cells
        addEventsToCells(rows("#epargnesTable"), 6, 6, 4, 6, 7, 4, 8, 9, 6, 10, 7, 8, 9, 10, "isLastRowOfEpargne")
        // Function called for the CUMUL J-1 cells

        // Calling the function for the J-0 cells
            addEventsToCells(rows("#epargnesTable"), 7, 7, 4, 6, 7, 4, 8, 9, 6, 10, 7, 8, 9, 10, "isLastRowOfEpargne")
        // Function called for the J-0 cells



        sendData();


        document.getElementById("ressourcesAllouees").textContent = formatNumber(@json($totalDesAllocationsDeduitDuRevenu))


        document.getElementById("resteRevenus").textContent = formatNumber(@json($revenus) - @json($totalDesAllocationsDeduitDuRevenu))
   
    </script>
    
@endsection
