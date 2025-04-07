@extends('layouts.master')
@section('content')
    <div id="displaying_erea" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Dettes Financières</h1>
            </div> 
            <div id="modalDiv" class="hidden fixed inset-0 z-10 flex items-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
                <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
                <div class="card relative mx-auto mt-12 bg-white rounded-lg shadow-lg max-w-3xl p-6">
                    <div class="flex justify-center items-center">
                        <div class="text-center" id="titreDuFormDePayement">

                        </div>
                    </div>
                    <form id="payement">
                        <input hidden type="number" name="idDette">
                        <input hidden type="number" name="iModalite">
                        <input hidden type="text" name="typeModalite">
                        <div class="flex mb-2 mt-2" id="modaliteModalForPayementDiv">
                        </div>
                            <div class="flex mb-2 mt-2">
                                <div class="col mr-2 w-full">
                                    <label for="reference">Reference de payement</label>
                                    <input placeholder="Saisir la reference de payement ici..." name="reference" id="reference" type="text" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                </div>
                                <div class="col mr-2 w-full">
                                    <label for="fichier_joint">Ou/Et fichier de payement</label>
                                    <input name="fichier_joint" id="fichier_joint" type="file" accept=".pdf,.png,.jpeg,.jpg" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                </div>
                            </div>
                            <div class="flex mb-2 mt-2">
                            </div>
                        <div class="mt-6 flex justify-between space-x-4">
                            <button type="button" onclick="cencelProcess()" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Retour</button>
                            <!-- <button type="button" onclick="actualiser()" class="text-white btn ml-8 bg-gray-500 border-gray-500 hover:text-white hover:bg-gray-600 hover:border-gray-600 active:text-white active:bg-gray-600 active:border-gray-600 active:ring active:ring-gray-100 dark:ring-gray-400/20 mr-2">Actualiser</button> -->
                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Confirmer</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="modaliteModalDiv" class="hidden fixed inset-0 z-50 flex items-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
            </div>

                <div class="col-span-12 card 2xl:col-span-12">
                    <div class="card-body">
                        <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                            <div class="flex items-center">
                                <div class="2xl:col-span-3">
                                    <h5 class="mr-2">Dettes financières</h5>
                                </div>
                                <button onclick="ajouter()" class="inline-block rounded-full bg-white transition-all duration-300 ease-in-out hover:bg-gray-400 active:bg-gray-500">
                                    <i id="btn_ajouter" class="align-baseline ltr:pr-1 rtl:pl-1 ri-add-line text-lg text-black"></i>
                                </button>
                            </div>                    
                            <div class="2xl:col-span-3 2xl:col-start-10">
                                <div class="flex gap-3">
                                    <div class="relative grow">
                                        <input  id="searchInput" class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Cherchez ici ..." autocomplete="off">
                                        <i data-lucide="search" class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                                    </div>
                                    <button  type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i class="align-baseline ltr:pr-1 rtl:pl-1 ri-download-2-line"></i>Importer</button>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table id="personnelTable" class="w-full whitespace-nowrap">
                                <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
                                    <tr>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                            N°
                                        </th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Type créancier</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Nom créancier</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Adresse créancier</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Mail créancier</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Phone créancier</th>

                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Date effet</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Date échéance</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Taux de pénalité</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Montant emprunté</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Taux d'interet</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Montant de l'interet</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Montant total dû</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Portion journalière</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Montant reglé</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reste à reglé</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Status</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ( $dettes as $dette )
                                        @php
                                            $reste = ($dette->montant_emprunte + $dette->montant_interet) - $dette->montant_paye;
                                        @endphp
                                        <tr
                                            data-id= "{{ $dette->id}}"
                                            data-banque="{{$dette->banque}}"
                                            data-type_creancier="{{ $dette->type_creancier }}"
                                            data-nom_creancier="{{ $dette->nom_creancier }}"
                                            data-mail_creancier="{{ $dette->mail_creancier }}"
                                            data-phone_creancier="{{ $dette->phone_creancier }}"
                                            data-adresse_creancier="{{ $dette->adresse_creancier }}"
                                            data-date_effet="{{ $dette->date_effet }}"
                                            data-date_echeance="{{ $dette->date_echeance }}"
                                            data-montant_emprunte="{{ $dette->montant_emprunte }}"
                                            data-montant_paye="{{ $dette->montant_paye }}"
                                            data-taux_interet="{{ $dette->taux_interet }}"
                                            data-montant_interet="{{ $dette->montant_interet }}"
                                            data-taux_de_penalite="{{ $dette->taux_de_penalite }}"
                                            data-periodicite_de_penalite="{{ $dette->periodicite_de_penalite }}"
                                            data-objet="{{ $dette->objet }}"
                                            
                                            data-manierePayement="{{ $dette->manierePayement }}"
                                            data-modalitePeriodiqueMontant="{{ $dette->modalitePeriodique}}"
                                            data-modalitesEchellonnees="{{ $dette->modalitesEchellonnees}}">
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{++$i}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">{{$dette->type_creancier}}</a></td>
                                            @if ($dette->banque)
                                                <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->banque->nom}}</td>
                                                <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->banque->adresse}}</td>
                                                <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->banque->mail}}</td>
                                                <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->banque->phone}}</td>
                                            @else
                                                <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->nom_creancier}}</td>
                                                <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->adresse_creancier}}</td>
                                                <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->mail_creancier}}</td>
                                                <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->phone_creancier}}</td>
                                            @endif
                                            <!-- <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">Dette approvionnement</td> -->
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $dette->date_effet ? $dette->date_effet->format('d-m-Y') : '...' }}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $dette->date_echeance ? $dette->date_echeance->format('d-m-Y') : '...' }}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500" title="Cette dette subira une augmentation de {{$dette->taux_de_penalite ? $dette->taux_de_penalite : '...'}}% pour chaque {{ $dette->periodicite_de_penalite ? $dette->periodicite_de_penalite : '...'}} de depassement">{{$dette->taux_de_penalite ? $dette->taux_de_penalite . '% par ' . $dette->periodicite_de_penalite  : '...'}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->montant_emprunte}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->taux_interet}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->montant_interet}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->montant_emprunte + $dette->montant_interet}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->portion_journaliere}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->montant_paye}}</td>
                                            @if ($reste == 0)
                                                <td class="text-green-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ">{{$reste}}</td>
                                                <td class="text-green-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->status}}</td>
                                            @elseif ($reste > 0)
                                                <td class="text-red-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ">{{$reste}}</td>
                                                <td class="text-red-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$dette->status}}</td>
                                            @endif

                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                <div class="relative dropdown">
                                                    <button id="orderAction1" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20 w-20"><i data-lucide="more-horizontal" class="size-4"></i></button>
                                                    <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction1">
                                                        @if ($dette->modalitePeriodique !== null || ($dette->modalitesEchellonnees && !$dette->modalitesEchellonnees->isEmpty()))
                                                            <li>
                                                                <a onclick="payement(event, 'detteFinanciere')" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!"><i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Payement</span></a>
                                                            </li> 
                                                        @endif
                                                        
                                                        @if ($dette->modalitePeriodique !== null || ($dette->modalitesEchellonnees && !$dette->modalitesEchellonnees->isEmpty()))
                                                            <li>
                                                               <a onclick="voirModalitePayement()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!"><i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Voir les modalités</span></a>
                                                            </li>
                                                        @endif
                                                        <li>
                                                            <button type="button" onclick="modifier()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Modifier</span></button>
                                                        </li>
                                                        <!-- <li>
                                                            <button type="button" onclick="gestionDeLaDette()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Planifier cette dette</span></button>
                                                        </li> -->
                                                        <!-- <li>
                                                            <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="{{ route('dette.delete', ['id' => $dette->id]) }}" onclick="return confirm('Cette action est irreversible! Êtes-vous sûr de vouloir éffectuer la suppression ?')"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Supprimer</span></a> 
                                                        </li> -->
                                                    </ul>
                                                </div>
                                            </td>
                                            </tr>
                                    @endforeach 
                                    @if($i == 0)
                                        <div id="aucunelement" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                            <strong class="font-bold">Vide!</strong>
                                            <span class="block sm:inline">Vos dettes financières s'affichent ici...</span>
                                        </div>
                                    @endif                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div id="adding_erea" class="hidden group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Ajouter une dette financière</h1>
            </div> 
                <div class=" transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form id="formulaire_ajout">
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="type_creancier">Type créancier</label>
                                                <select required name="type_creancier" class="type_creancier ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="" disabled selected >Choisissez un type</option>
                                                    <option value="Banque">Banque</option>
                                                    <option value="Autre">Autre créancier</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2 hidden" id="banqueDiv">
                                            <div class="col mr-2 w-full">
                                                <label for="banque_input_add">Banque</label>
                                                <input id="banque_input_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Cherchez une banque">
                                                <select multiple  name="banque" id="banque_selecte_add" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="-1" selected disabled>Choisir une banque...</option>
                                                    @foreach ($banques as $banque)
                                                        <option value="{{$banque->id}}">{{$banque->nom}} ({{$banque->sigle}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="flex mb-2 hidden" id="autreCreancierDiv">
                                            <div class="col mr-2 w-full">
                                                <label for="nom_creancier">Nom créancier</label>
                                                <input required type="text" name="nom_creancier" id="nom_creancier_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="mail_creancier">Mail créancier</label>
                                                <input required type="text" name="mail_creancier" id="mail_creancier_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="phone_creancier">Phone créancier</label>
                                                <input required type="text" name="phone_creancier" id="phone_creancier_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="adresse_creancier">Adresse créancier</label>
                                                <input required type="text" name="adresse_creancier" id="adresse_creancier_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>

                                        <div class="flex mb-2" >
                                            <div class="col mr-2 w-full">
                                                <label for="objet">Objet</label>
                                                <input required type="text" name="objet" id="objet" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="date_effet">Date effet</label>
                                                <input required type="date" name="date_effet" id="date_effet_add" class="date_effet row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="date_echeance">Date échéance</label>
                                                <input required type="date" name="date_echeance" id="date_echeance_add" class="date_echeance row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="montant_emprunte">Montant emprunté</label>
                                                <input required type="number" step="any" name="montant_emprunte" id="montant_emprunte_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            
                                            <div class="col mr-2 w-full">
                                                <label for="taux_interet">Taux interet (%)</label>
                                                <input required type="number" step="any" name="taux_interet" id="taux_interet_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="montant_interet">Montant interet</label>
                                                <input required type="number" step="any" name="montant_interet" id="montant_interet_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                        </div> 
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="taux_de_penalite">Taux de pénalité (%)</label>
                                                <input required type="number" step="any" name="taux_de_penalite" id="taux_de_penalite_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="periodicite_de_penalite">Périodicité de pénalité</label>
                                                <select required name="periodicite_de_penalite" id="periodicite_de_penalite_add" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="-1" selected disabled>Choisir ici...</option>
                                                    <option value="jour">Jour</option>
                                                    <option value="semaine">Semaine</option>
                                                    <option value="mois">Mois</option>
                                                    <option value="trimestre">Trimestre</option>
                                                    <option value="semestre">Semestre</option>
                                                    <option value="an">Année</option>
                                                </select>
                                            </div>    
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full text-center">
                                                <span class="block w-full mx-auto mt-8"><hr></span>
                                                <h3 class="text-center">Modalité de règlement</h3>
                                                <span class="block w-full mx-auto mb-8"><hr></span>
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="periodicite_de_penalite">Type de modalité</label>
                                                <select required name="typeModalite" id="typeModalite_add" class="typeModaliteclass ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="-1" selected disabled>Choisir ici...</option>
                                                    <option value="Périodique">Périodique</option>
                                                    <option value="Échelonnée">Échelonnée</option>
                                                </select>
                                            </div> 
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full hidden" id="date_reglement_div">
                                                <label for="date_reglement">Date de règlement</label>
                                                <input required type="date" name="date_reglement[]" id="date_reglement" class="date_reglement row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="montantARegler">Montant</label>
                                                <input required type="number" step="any" name="montantARegler[]" id="montantARegler_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full hidden" id="periodicite_payement_div">
                                                <label for="periodicite_payement">Périodicité de règlement</label>
                                                <select required name="periodicite_payement" id="periodicite_payement_add" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="-1" selected disabled>Choisir ici...</option>
                                                    <option value="jour">Jour</option>
                                                    <option value="semaine">Semaine</option>
                                                    <option value="mois">Mois</option>
                                                    <option value="trimestre">Trimestre</option>
                                                    <option value="semestre">Semestre</option>
                                                    <option value="an">Année</option>
                                                </select>
                                            </div>  
                                        </div>
                                        
                                        <div id="sections_container" class="hidden">
                                        </div>

                                        <div class="flex mb-2 hidden" id="ajouter_date_payement_div">
                                            <button title="Ajouter une date de reglement" style="background-color:blue; color:white;" type="button" class="ajouter_date_payement btn"><strong>+</strong></button>
                                        </div>
                                       
                                        <div class="flex justify-end w-full">
                                            <button type="button" onclick="afficher()" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Annuler</button>
                                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Valider</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
    </div>
    
    <div id="modifying_erea" class="hidden group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            {{-- {!! Toastr::message() !!} --}}
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl"> Modifier une dette financière</h1>
            </div> 
                {{-- {!! Toastr::message() !!} --}}
                <div class="transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body"> 
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form id="formulaire_modif">
                                        <input class="hidden" type="number" name="id_dette">
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="type_creancier">Type créancier</label>
                                                <select required  name="type_creancier" class="type_creancier ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="" disabled selected >Choisissez un type</option>
                                                    <option value="Banque">Banque</option>
                                                    <option value="Autre">Autre créancier</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="flex mb-2 hidden" id="banqueDivModif">
                                            <div class="col mr-2 w-full">
                                            <label for="banque_input_modif">Banque</label>
                                                <input id="banque_input_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Cherchez une banque">
                                                <select multiple  name="banque" id="banque_selecte_modif" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="-1" selected disabled>Choisir une banque...</option>
                                                    @foreach ($banques as $banque)
                                                        <option value="{{$banque->id}}">{{$banque->nom}} ({{$banque->sigle}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="flex mb-2  hidden" id="autreCreancierDivModif">
                                            <div class="col mr-2 w-full">
                                                <label for="nom_creancier">Nom créancier</label>
                                                <input required type="text" name="nom_creancier" id="nom_creancier_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="mail_creancier">Mail créancier</label>
                                                <input required type="text" name="mail_creancier" id="mail_creancier_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="phone_creancier">Phone créancier</label>
                                                <input required type="text" name="phone_creancier" id="phone_creancier_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="adresse_creancier">Adresse créancier</label>
                                                <input required type="text" name="adresse_creancier" id="adresse_creancier_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="objet">Objet</label>
                                                <input required type="text" name="objet" id="objet" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="date_effet">Date effet</label>
                                                <input required type="date" name="date_effet" id="date_effet_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="date_echeance">Date échéance</label>
                                                <input required type="date" name="date_echeance" id="date_echeance_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="montant_emprunte">Montant emprunté</label>
                                                <input required type="number" step="any" name="montant_emprunte" id="montant_emprunte_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="taux_interet">Taux interet (%)</label>
                                                <input required type="number" step="any" name="taux_interet" id="taux_interet_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="montant_interet">Montant interet</label>
                                                <input required type="number" step="any" name="montant_interet" id="montant_interet_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                        </div> 
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="taux_de_penalite">Taux de pénalité (%)</label>
                                                <input required type="number" step="any" name="taux_de_penalite" id="taux_de_penalite_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="periodicite_de_penalite">Périodicité de pénalité</label>
                                                <select required name="periodicite_de_penalite" id="periodicite_de_penalite_modif" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="-1" selected disabled>Choisir ici...</option>
                                                    <option value="jour">Jour</option>
                                                    <option value="semaine">Semaine</option>
                                                    <option value="mois">Mois</option>
                                                    <option value="trimestre">Trimestre</option>
                                                    <option value="semestre">Semestre</option>
                                                    <option value="an">Année</option>
                                                </select>
                                            </div>    
                                        </div>
                                        <div class="flex justify-end w-full">
                                            <button type="button" onclick="afficher()" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Annuler</button>
                                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Valider</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    <script>

        function calculateMontantInteretInRealTime(){
            document.getElementById('taux_interet_add').addEventListener('input', function(){
                document.getElementById('montant_interet_add').value = (Number(document.getElementById('montant_emprunte_add').value) * Number(this.value)) / 100
            })
            
            document.getElementById('montant_emprunte_add').addEventListener('input', function(){
                document.getElementById('montant_interet_add').value = (Number(document.getElementById('taux_interet_add').value) * Number(this.value)) / 100
            })
        }

        function typeCreancier(){
            document.querySelectorAll('.type_creancier').forEach(function(type){
                type.addEventListener('change', function(){
                    const banqueDiv = document.getElementById("banqueDiv");
                    const banqueDivModif = document.getElementById("banqueDivModif");
                    if(this.value === 'Banque'){
                        if(banqueDiv){
                            banqueDiv.classList.remove('hidden');
                            document.getElementById("autreCreancierDiv").classList.add('hidden');
                            document.getElementById("nom_creancier_add").removeAttribute('required');
                            document.getElementById("mail_creancier_add").removeAttribute('required');
                            document.getElementById("phone_creancier_add").removeAttribute('required');
                            document.getElementById("adresse_creancier_add").removeAttribute('required')
                        }else if(banqueDivModif){
                            banqueDivModif.classList.remove('hidden');
                            document.getElementById("autreCreancierDivModif").classList.add('hidden');
                            document.getElementById("nom_creancier_modif").removeAttribute('required');
                            document.getElementById("mail_creancier_modif").removeAttribute('required');
                            document.getElementById("phone_creancier_modif").removeAttribute('required');
                            document.getElementById("adresse_creancier_modif").removeAttribute('required')
                        }
                    } else if(this.value === 'Autre'){
                        if(banqueDiv){
                            banqueDiv.classList.add('hidden');
                            document.getElementById("autreCreancierDiv").classList.remove('hidden');
                            document.getElementById("nom_creancier_add").setAttribute('required', true);
                            document.getElementById("mail_creancier_add").setAttribute('required', true);
                            document.getElementById("phone_creancier_add").setAttribute('required', true);
                            document.getElementById("adresse_creancier_add").setAttribute('required', true);
                        }else if(banqueDivModif){
                            banqueDivModif.classList.add('hidden');
                            document.getElementById("autreCreancierDivModif").classList.remove('hidden');
                            document.getElementById("nom_creancier_modif").setAttribute('required', true);
                            document.getElementById("mail_creancier_modif").setAttribute('required', true);
                            document.getElementById("phone_creancier_modif").setAttribute('required', true);
                            document.getElementById("adresse_creancier_modif").setAttribute('required', true);
                        }
                    }
                });
            })
        }

       
       
        function ajouter(){
            let adding = document.getElementById('adding_erea')
            adding.classList.remove("hidden")    
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")
            const input_element = document.getElementById("banque_input_add")
            const select_element = document.getElementById("banque_selecte_add")
            inputBanques(input_element, select_element);
            onChangeBanques(input_element, select_element);
            effacer_erreurs();
            typeCreancier();
            gestionTypeModalite();
            calculateMontantInteretInRealTime();
        }

        function removeModal() {
            document.getElementById('modaliteModalDiv').classList.add('hidden');
        }

        function voirModalitePayement() {
            let trElement = event.target.closest('tr');
            const manierePayement = trElement.getAttribute('data-manierePayement');
            const principleDiv = document.getElementById("modaliteModalDiv");
            principleDiv.innerHTML = "";
            const opacityDiv = document.createElement('div');
            opacityDiv.classList.add('fixed', 'inset-0', 'bg-gray-500', 'opacity-75');
            principleDiv.appendChild(opacityDiv);
            if(manierePayement === "Périodique"){
                let modalitePeriodique = trElement.getAttribute('data-modalitePeriodiqueMontant');
                modalitePeriodique = JSON.parse(modalitePeriodique);
                // Créer la div principale avec les classes nécessaires
                const cardDiv = document.createElement('div');
                cardDiv.classList.add('card', 'relative', 'mx-auto', 'mt-12', 'bg-white', 'rounded-lg', 'shadow-lg', 'max-w-lg', 'p-6');
                const titleDiv = document.createElement('div');
                titleDiv.classList.add('flex', 'justify-center', 'items-center');
                
                const titleText = document.createElement('div');
                titleText.classList.add('text-center');
                titleText.textContent = 'Payement périodique';
                titleDiv.appendChild(titleText);
                cardDiv.appendChild(titleDiv);
                const form = document.createElement('form');
                form.id = 'modaliteViewForm';
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'number';
                hiddenInput.name = 'idDette';
                hiddenInput.hidden = true;
                form.appendChild(hiddenInput);
                const firstDiv = document.createElement('div');
                firstDiv.classList.add('flex', 'mb-2', 'mt-2');
                const periodiciteDiv = document.createElement('div');
                periodiciteDiv.classList.add('col', 'mr-2', 'w-full');
                const periodiciteLabel = document.createElement('label');
                periodiciteLabel.setAttribute('for', 'periodicite_payement');
                periodiciteLabel.textContent = 'Périodicité de règlement';
                const periodiciteInput = document.createElement('input');
                periodiciteInput.readOnly = true;
                periodiciteInput.name = 'periodicite_payement';
                periodiciteInput.id = 'periodicite_payement_modalite';
                periodiciteInput.type = 'text';
                periodiciteInput.value = modalitePeriodique.periodicite_payement;
                periodiciteInput.classList.add('ltr:pl-8', 'rtl:pr-8', 'form-input', 'border-slate-200', 'dark:border-zink-500', 'focus:outline-none', 'focus:border-custom-500', 'disabled:bg-slate-100', 'dark:disabled:bg-zink-600', 'disabled:border-slate-300', 'dark:disabled:border-zink-500', 'dark:disabled:text-zink-200', 'disabled:text-slate-500', 'dark:text-zink-100', 'dark:bg-zink-700', 'dark:focus:border-custom-800', 'placeholder:text-slate-400', 'dark:placeholder:text-zink-200', 'mr-2', 'w-full');
                periodiciteDiv.appendChild(periodiciteLabel);
                periodiciteDiv.appendChild(periodiciteInput);
                firstDiv.appendChild(periodiciteDiv);
                const montantDiv = document.createElement('div');
                montantDiv.classList.add('col', 'mr-2', 'w-full');
                const montantLabel = document.createElement('label');
                montantLabel.setAttribute('for', 'montantARegler');
                montantLabel.textContent = 'Montant pour chaque période';
                const montantInput = document.createElement('input');
                montantInput.readOnly = true;
                montantInput.name = 'montantARegler';
                montantInput.id = 'montantARegler_modalite';
                montantInput.type = 'number';
                montantInput.step = 'any';
                montantInput.value = modalitePeriodique.montant;
                montantInput.classList.add('ltr:pl-8', 'rtl:pr-8', 'form-input', 'border-slate-200', 'dark:border-zink-500', 'focus:outline-none', 'focus:border-custom-500', 'disabled:bg-slate-100', 'dark:disabled:bg-zink-600', 'disabled:border-slate-300', 'dark:disabled:border-zink-500', 'dark:disabled:text-zink-200', 'disabled:text-slate-500', 'dark:text-zink-100', 'dark:bg-zink-700', 'dark:focus:border-custom-800', 'placeholder:text-slate-400', 'dark:placeholder:text-zink-200', 'mr-2', 'w-full');
                montantDiv.appendChild(montantLabel);
                montantDiv.appendChild(montantInput);
                firstDiv.appendChild(montantDiv);
                form.appendChild(firstDiv);
                const buttonDiv = document.createElement('div');
                buttonDiv.classList.add('mt-6', 'flex', 'justify-between', 'space-x-4');
                const backButton = document.createElement('button');
                backButton.type = 'button';

                
                backButton.setAttribute('onclick', 'removeModal()');

                backButton.classList.add('text-white', 'btn', 'ml-8', 'bg-red-500', 'border-red-500', 'hover:text-white', 'hover:bg-red-600', 'hover:border-red-600', 'active:text-white', 'active:bg-red-600', 'active:border-red-600', 'active:ring', 'active:ring-red-100', 'dark:ring-red-400/20', 'mr-2');
                backButton.textContent = 'Retour';
                buttonDiv.appendChild(backButton);
                form.appendChild(buttonDiv);
                cardDiv.appendChild(form);
                principleDiv.appendChild(cardDiv);
                principleDiv.classList.remove('hidden');

            }else if(manierePayement === "Échelonnée"){
                let modalitesEchellonnees = trElement.getAttribute('data-modalitesEchellonnees');
                modalitesEchellonnees = JSON.parse(modalitesEchellonnees);
                // Créer la div principale avec les classes nécessaires
                const cardDiv = document.createElement('div');
                cardDiv.classList.add('card', 'relative', 'mx-auto', 'mt-12', 'bg-white', 'rounded-lg', 'shadow-lg', 'max-w-lg', 'p-6');
                const titleDiv = document.createElement('div');
                titleDiv.classList.add('flex', 'justify-center', 'items-center');
                const titleText = document.createElement('div');
                titleText.classList.add('text-center');
                titleText.textContent = 'Payement échelonné';
                titleDiv.appendChild(titleText);
                cardDiv.appendChild(titleDiv);
                const form = document.createElement('form');
                form.id = 'modaliteViewForm';
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'number';
                hiddenInput.name = 'idDette';
                hiddenInput.hidden = true;
                form.appendChild(hiddenInput);
                let i = 0;

                modalitesEchellonnees.sort(function(a, b) {
                    return new Date(a.date_reglement) - new Date(b.date_reglement);
                });

                modalitesEchellonnees.forEach(function(modalite) {
                    i++
                    const firstDiv = document.createElement('div');
                    firstDiv.classList.add('flex', 'mb-2', 'mt-2');
                    const datePayementDiv = document.createElement('div');
                    datePayementDiv.classList.add('col', 'mr-2', 'w-full');
                    const datePayementLabel = document.createElement('label');
                    datePayementLabel.setAttribute('for', 'date_reglement');
                    datePayementLabel.textContent = 'Date de règlement ' +i;
                    const datePayementInput = document.createElement('input');
                    datePayementInput.readOnly = true;
                    datePayementInput.name = 'date_reglement[]';
                    datePayementInput.id = 'date_reglement'+i;
                    datePayementInput.type = 'text';

                    datePayementInput.value = modalite.date_reglement;
                    datePayementInput.classList.add('ltr:pl-8', 'rtl:pr-8', 'form-input', 'border-slate-200', 'dark:border-zink-500', 'focus:outline-none', 'focus:border-custom-500', 'disabled:bg-slate-100', 'dark:disabled:bg-zink-600', 'disabled:border-slate-300', 'dark:disabled:border-zink-500', 'dark:disabled:text-zink-200', 'disabled:text-slate-500', 'dark:text-zink-100', 'dark:bg-zink-700', 'dark:focus:border-custom-800', 'placeholder:text-slate-400', 'dark:placeholder:text-zink-200', 'mr-2', 'w-full');
                    datePayementDiv.appendChild(datePayementLabel);
                    datePayementDiv.appendChild(datePayementInput);

                    firstDiv.appendChild(datePayementDiv);
                    const montantDiv = document.createElement('div');
                    montantDiv.classList.add('col', 'mr-2', 'w-full');
                    const montantLabel = document.createElement('label');
                    montantLabel.setAttribute('for', 'montantARegler');
                    montantLabel.textContent = 'Montant';
                    const montantInput = document.createElement('input');
                    montantInput.readOnly = true;
                    montantInput.name = 'montantARegler';
                    montantInput.id = 'montantARegler_modalite'+i;
                    montantInput.type = 'number';
                    montantInput.step = 'any';
                    montantInput.value = modalite.montant;
                    montantInput.classList.add('ltr:pl-8', 'rtl:pr-8', 'form-input', 'border-slate-200', 'dark:border-zink-500', 'focus:outline-none', 'focus:border-custom-500', 'disabled:bg-slate-100', 'dark:disabled:bg-zink-600', 'disabled:border-slate-300', 'dark:disabled:border-zink-500', 'dark:disabled:text-zink-200', 'disabled:text-slate-500', 'dark:text-zink-100', 'dark:bg-zink-700', 'dark:focus:border-custom-800', 'placeholder:text-slate-400', 'dark:placeholder:text-zink-200', 'mr-2', 'w-full');
                    montantDiv.appendChild(montantLabel);
                    montantDiv.appendChild(montantInput);
                    firstDiv.appendChild(montantDiv);
                    form.appendChild(firstDiv);
                });

                const buttonDiv = document.createElement('div');
                buttonDiv.classList.add('mt-6', 'flex', 'justify-between', 'space-x-4');
                const backButton = document.createElement('button');
                backButton.type = 'button';

                backButton.setAttribute('onclick', 'removeModal()');

                backButton.classList.add('text-white', 'btn', 'ml-8', 'bg-red-500', 'border-red-500', 'hover:text-white', 'hover:bg-red-600', 'hover:border-red-600', 'active:text-white', 'active:bg-red-600', 'active:border-red-600', 'active:ring', 'active:ring-red-100', 'dark:ring-red-400/20', 'mr-2');
                backButton.textContent = 'Retour';
                buttonDiv.appendChild(backButton);
                form.appendChild(buttonDiv);
                cardDiv.appendChild(form);
                principleDiv.appendChild(cardDiv);
                principleDiv.classList.remove('hidden');
                
                
            }
        };

        
        
        function onChangeFournisseurs(input, select) {
            select.addEventListener('change', function() {
                const txt = this.options[this.selectedIndex].text;
                const parenthesisIndex = txt.indexOf('(');
                if (parenthesisIndex !== -1) {
                    input.value = txt.substring(0, parenthesisIndex - 1);
                } else {
                    input.value = txt;
                }
            });
        }


        fonction_de_recherche();
        addPaymentDateSection();
        checkDateRange('');
        disparition_table()

        function gestionTypeModalite() {
            document.querySelectorAll('.typeModaliteclass').forEach(function (typeModaliteclass) {
                typeModaliteclass.addEventListener('change', function () {
                    let date_reglement_div = document.getElementById('date_reglement_div');
                    let date_reglement_div_modif = document.getElementById('date_reglement_div_modif');
                    if (date_reglement_div) {
                        if (this.value === "Périodique") {
                            date_reglement_div.classList.add('hidden');
                            document.getElementById('ajouter_date_payement_div').classList.add('hidden');
                            document.getElementById('date_reglement').setAttribute('disabled', 'disabled');
                            document.getElementById('periodicite_payement_div').classList.remove('hidden');
                            document.getElementById('periodicite_payement_add').removeAttribute('disabled');
                            document.getElementById('date_reglement').removeAttribute('required');
                        } else if (this.value === "Échelonnée") {
                            document.getElementById('date_reglement').removeAttribute('disabled');
                            document.getElementById('ajouter_date_payement_div').classList.remove('hidden');
                            document.getElementById('periodicite_payement_div').classList.add('hidden');
                            document.getElementById('periodicite_payement_add').setAttribute('disabled', 'disabled');
                            date_reglement_div.classList.remove('hidden');
                        }
                    }
                    
                    if (date_reglement_div_modif) {
                        c(date_reglement_div_modif)

                        if (this.value === "Périodique") {
                            date_reglement_div_modif.classList.add('hidden');
                            document.getElementById('ajouter_date_payement_div_modif').classList.add('hidden');
                            document.getElementById('date_reglement_modif').setAttribute('disabled', 'disabled');
                            document.getElementById('periodicite_payement_div_modif').classList.remove('hidden');
                            document.getElementById('periodicite_payement_modif').removeAttribute('disabled');
                            document.getElementById('date_reglement_modif').removeAttribute('required');
                        } else if (this.value === "Échelonnée") {
                            document.getElementById('date_reglement_modif').removeAttribute('disabled');
                            document.getElementById('ajouter_date_payement_div_modif').classList.remove('hidden');
                            document.getElementById('periodicite_payement_div_modif').classList.add('hidden');
                            document.getElementById('periodicite_payement_modif').setAttribute('disabled', 'disabled');
                            date_reglement_div_modif.classList.remove('hidden');
                        }
                    }
                });
            });
        }

        function modifier(){
            let modifying = document.getElementById('modifying_erea')
            modifying.classList.remove("hidden")    
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden");
            const formulaire = document.getElementById('formulaire_modif');
            let trElement = event.target.closest('tr');
            let banque = trElement.getAttribute('data-banque');
            if(banque && banque != null && banque != undefined){
                banque = JSON.parse(banque);

                document.querySelectorAll('.type_creancier').forEach(function(type){
                   type.value = 'Banque';
                });

                document.getElementById("autreCreancierDivModif").classList.add('hidden');
                document.getElementById("banqueDivModif").classList.remove('hidden');
                document.getElementById("banque_input_modif").value = banque.nom;

                formulaire.querySelector('select[name="banque"]').value = banque.id;
                formulaire.querySelector('select[name="type_creancier"]').value = banque.type;
                formulaire.querySelector('input[name="nom_creancier"]').value = banque.nom;
                formulaire.querySelector('input[name="mail_creancier"]').value = banque.mail;
                formulaire.querySelector('input[name="phone_creancier"]').value = banque.phone;
                formulaire.querySelector('input[name="adresse_creancier"]').value = banque.adresse;
            }else{
                document.getElementById("autreCreancierDivModif").classList.remove('hidden');
                document.getElementById("banqueDivModif").classList.add('hidden');
                document.querySelectorAll('.type_creancier').forEach(function(type){
                   type.value = 'Autre';
                });
                const type_creancier = trElement.getAttribute('data-type_creancier');
                const nom_creancier = trElement.getAttribute('data-nom_creancier');
                const mail_creancier = trElement.getAttribute('data-mail_creancier');
                const phone_creancier = trElement.getAttribute('data-phone_creancier');
                const adresse_creancier = trElement.getAttribute('data-adresse_creancier');
                formulaire.querySelector('select[name="type_creancier"]').value = type_creancier;
                formulaire.querySelector('input[name="nom_creancier"]').value = nom_creancier;
                formulaire.querySelector('input[name="mail_creancier"]').value = mail_creancier;
                formulaire.querySelector('input[name="phone_creancier"]').value = phone_creancier;
                formulaire.querySelector('input[name="adresse_creancier"]').value = adresse_creancier;
            }

            const id_dette = trElement.getAttribute('data-id');
            const objet = trElement.getAttribute('data-objet');
            const date_effet = trElement.getAttribute('data-date_effet').split(' ')[0];
            const date_echeance = trElement.getAttribute('data-date_echeance').split(' ')[0];
            const montant_emprunte = trElement.getAttribute('data-montant_emprunte');
            const taux_interet = trElement.getAttribute('data-taux_interet');
            const montant_interet = trElement.getAttribute('data-montant_interet');
            const taux_de_penalite = trElement.getAttribute('data-taux_de_penalite');
            const periodicite_de_penalite = trElement.getAttribute('data-periodicite_de_penalite');
            formulaire.querySelector('input[name="id_dette"]').value = id_dette;
            formulaire.querySelector('input[name="objet"]').value = objet;
            formulaire.querySelector('input[name="date_effet"]').value = date_effet;
            formulaire.querySelector('input[name="date_echeance"]').value = date_echeance;
            formulaire.querySelector('input[name="montant_emprunte"]').value = montant_emprunte;
            formulaire.querySelector('input[name="taux_interet"]').value = taux_interet;
            formulaire.querySelector('input[name="montant_interet"]').value = montant_interet;
            formulaire.querySelector('input[name="taux_de_penalite"]').value = taux_de_penalite;
            formulaire.querySelector('select[name="periodicite_de_penalite"]').value = periodicite_de_penalite;
            const input_element = document.getElementById("banque_input_modif")
            const select_element = document.getElementById("banque_selecte_modif")
            inputBanques(input_element, select_element);
            onChangeBanques(input_element, select_element);
            typeCreancier();
            gestionTypeModalite();
        }
    
        function afficher(){
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.remove("hidden")
            let adding = document.getElementById('adding_erea')
            if(adding){
                adding.classList.add("hidden")
            }
            let modifying = document.getElementById('modifying_erea')
            if(modifying){
                modifying.classList.add("hidden")
            }

            window.location.reload();
        }
    
        var formulaire_ajou = document.getElementById('formulaire_ajout');
        formulaire_ajou.addEventListener('submit', function(event) {
            event.preventDefault();
            document.querySelectorAll('.date_reglement').forEach(function(element) {
                element.classList.remove('hidden');
            });
            
            document.querySelectorAll('.montantARegler').forEach(function(element) {
                element.classList.remove('hidden');
            });
            
            document.querySelectorAll('.montantARegler').forEach(function(element) {
                element.removeAttribute('disabled');
            });

            if(document.getElementById('typeModalite_add').value === "-1" ){
                return toastr.alert('Veuillez choisir un type de modalité.');
            }
            var formData = new FormData(formulaire_ajou);
            var request = new XMLHttpRequest();
            request.open('POST', '/store_dette_financiere');
            request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            request.onreadystatechange = function() {
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        effacer_erreurs();
                       
                        if(JSON.parse(request.responseText).modaliteTypeError){
                            return toastr.warning('Erreur de type de modalité...');
                        }
                        
                        if(JSON.parse(request.responseText).creancierTypeError){
                            return toastr.warning('Erreur de type de créancier...');
                        }
                        return toastr.success('Dette ajoutée...');
                    } else {
                        var response = JSON.parse(request.responseText);
                        if (response.errors) {
                           effacer_erreurs();
                            var errors = response.errors;
                            Object.keys(errors).forEach(function(key) {
                                var inputField = formulaire_ajou.querySelector('[name="' + key + '"]');
                                if (inputField) {
                                    var errorElement = document.createElement('span');
                                    errorElement.className = 'error-message text-red-500';
                                    errorElement.textContent = errors[key][0];
                                    inputField.parentNode.appendChild(errorElement);
                                }
                            });
                        } else {
                            toastr.error('Une erreur s\'est produite lors de la requête.', 'Erreur');
                        }
                    }
                }
            };
            request.send(formData);
        });
      
        var formulaire_modif = document.getElementById('formulaire_modif');
        formulaire_modif.addEventListener('submit', function(event) {
            event.preventDefault();
            var data_to_modify = new FormData(formulaire_modif);
            var request = new XMLHttpRequest();
            request.open('POST', '/edit_dette_financiere');
            request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            request.onreadystatechange = function() {
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        effacer_erreurs();
                        if(JSON.parse(request.responseText).creancierTypeError){
                            return toastr.warning('Erreur de type de créancier...');
                        }
                        toastr.success('Dette modifiée avec succès');
                    }else if(request.status === 419){
                        toastr.error('Cette a expiré! Veuillez recharger la page pour continuer...', 'Erreur');
                    }else {
                        var response = JSON.parse(request.responseText);
                        if (response.errors) {
                            effacer_erreurs();
                            var errors = response.errors;
                            Object.keys(errors).forEach(function(key) {
                                var inputField = formulaire_modif.querySelector('[name="' + key + '"]');
                                if (inputField) {
                                    var errorElement = document.createElement('span');
                                    errorElement.className = 'error-message text-red-500';
                                    errorElement.textContent = errors[key][0];
                                    inputField.parentNode.appendChild(errorElement);
                                }
                            });
                        } else {
                            toastr.error('Une erreur s\'est produite lors de la requête.', 'Erreur');
                        }
                    }
                }
            };
            request.send(data_to_modify);
        });
    </script> 
@endsection