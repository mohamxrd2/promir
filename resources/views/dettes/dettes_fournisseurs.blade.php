@extends('layouts.master')
@section('content')
    <div id="displaying_erea" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Dettes fournisseur</h1>
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
                            <!-- Generer la partie dynamique(soit on affiche une modalité périodique, soit on affiche une modalité échellonnée) du formulaire de payement ici...-->
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
<!--Debut generation du formulaire d'affichage des modalités de payement de la dete  -->
            <div id="modaliteModalDiv" class="hidden fixed inset-0 z-50 flex items-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
                
            </div>
<!--Fin generation du formulaire d'affichage des modalités de payement de la dete  -->

            <div class="col-span-12 card 2xl:col-span-12">
                <div class="card-body">
                    <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                        <div class="flex items-center">
                            <div class="2xl:col-span-3">
                                <h5 class="mr-2">Dettes fournisseurs</h5>
                            </div>
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
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Nom fournisseur</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Adresse fournisseur</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Mail fournisseur</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Phone fournisseur</th>

                                    <!-- <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Objet</th> -->
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Date effet</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Date échéance</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Taux de pénalité</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Montant dû</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Montant reglé</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reste à regler</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Status</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ( $detteFournisseurs as $detteFournisseur )
                                    @php
                                        $reste = $detteFournisseur->montant - $detteFournisseur->montant_paye;
                                    @endphp
                                    <tr
                                    
                                        data-id= "{{ $detteFournisseur->id}}"
                                        data-montant="{{ $detteFournisseur->montant }}"
                                        data-montant_paye="{{ $detteFournisseur->montant_paye }}"
                                        data-date_echeance="{{ $detteFournisseur->date_echeance }}"
                                        data-date_effet="{{ $detteFournisseur->date_effet }}"
                                        data-taux_de_penalite="{{ $detteFournisseur->taux_de_penalite }}"
                                        data-periodicite_de_penalite="{{ $detteFournisseur->periodicite_de_penalite }}"
                                        data-status="{{ $detteFournisseur->status }}"
                                        data-manierePayement="{{ $detteFournisseur->manierePayement }}"
                                        data-modalitePeriodiqueMontant="{{ $detteFournisseur->modalitePeriodique}}"
                                        data-modalitesEchellonnees="{{ $detteFournisseur->modalitesEchellonnees}}"
                                        >

                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{++$i}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">{{$detteFournisseur->approvisionnementSystemProduit->approvisionnement->ligneFournisseur->fournisseur->nom}}</a></td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$detteFournisseur->approvisionnementSystemProduit->approvisionnement->ligneFournisseur->fournisseur->adresse}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$detteFournisseur->approvisionnementSystemProduit->approvisionnement->ligneFournisseur->fournisseur->email}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$detteFournisseur->approvisionnementSystemProduit->approvisionnement->ligneFournisseur->fournisseur->phone}}</td>
                                        <!-- <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">Dette approvionnement</td> -->
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $detteFournisseur->date_echeance ? $detteFournisseur->date_effet->format('d-m-Y') : '...' }}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $detteFournisseur->date_echeance ? $detteFournisseur->date_echeance->format('d-m-Y') : '...' }}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500" title="Cette dette subira une augmentation de {{$detteFournisseur->taux_de_penalite ? $detteFournisseur->taux_de_penalite : '...'}}% pour chaque {{ $detteFournisseur->periodicite_de_penalite ? $detteFournisseur->periodicite_de_penalite : '...'}} de depassement">{{$detteFournisseur->taux_de_penalite ? $detteFournisseur->taux_de_penalite . '% par ' . $detteFournisseur->periodicite_de_penalite  : '...'}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$detteFournisseur->montant}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$detteFournisseur->montant_paye}}</td>
                                        @if ($reste == 0)
                                            <td class="text-green-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ">{{$reste}}</td>
                                            <td class="text-green-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$detteFournisseur->status}}</td>
                                        @elseif ($reste > 0)
                                            <td class="text-red-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ">{{$reste}}</td>
                                            <td class="text-red-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$detteFournisseur->status}}</td>
                                        @endif

                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                            <div class="relative dropdown">
                                                <button id="orderAction1" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20 w-20"><i data-lucide="more-horizontal" class="size-4"></i></button>
                                                <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction1">

                                                    @if ($detteFournisseur->modalitePeriodique !== null || ($detteFournisseur->modalitesEchellonnees && !$detteFournisseur->modalitesEchellonnees->isEmpty()))
                                                        <li>
                                                            <a onclick="payement(event, 'detteFournisseur')" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!"><i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Payement</span></a>
                                                        </li> 
                                                    @endif
                                                    
                                                    @if ($detteFournisseur->modalitePeriodique !== null || ($detteFournisseur->modalitesEchellonnees && !$detteFournisseur->modalitesEchellonnees->isEmpty()))
                                                        <li>
                                                            <a onclick="voirModalitePayement()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!"><i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Voir modalités</span></a>
                                                        </li>
                                                    @endif
                                                    

                                                    <li>
                                                        <button type="button" onclick="modifier()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Modifier</span></button>
                                                    </li>
                                                    <li>
                                                        <button type="button" onclick="gestionDeLaDette()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Planifier cette dette</span></button>
                                                    </li>
                                                    <!-- <li>
                                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="{{ route('dette.delete', ['id' => $detteFournisseur->id]) }}" onclick="return confirm('Cette action est irreversible! Êtes-vous sûr de vouloir éffectuer la suppression ?')"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Supprimer</span></a> 
                                                    </li> -->
                                                </ul>
                                            </div>
                                        </td>
                                        </tr>
                                @endforeach 
                                @if($i == 0)
                                    <div id="aucunelement" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <strong class="font-bold">Vide!</strong>
                                        <span class="block sm:inline">Vos dettes fournisseurs s'affichent ici...</span>
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
                <h1 class="flex justify-center items-center text-black text-5xl">Planifier une dette fournisseur</h1>
            </div> 
                <div class=" transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form id="formulaire_ajout">
                                       

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="montant-dette">Montant dette</label>
                                                <input disabled type="number" step="any" name="montant-dette" id="montant-dette" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>
                                        <div class="flex mb-2">

                                            <div class="col mr-2 w-full">
                                                <label for="date_effet">Date effet</label>
                                                <input required type="date" name="date_effet" id="date_effet_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="date_echeance">Date échéance</label>
                                                <input required type="date" name="date_echeance" id="date_echeance_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>

                                        <input class="hidden" type="number" name="dette_fournisseur_id">

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="taux_de_penalite">Taux de pénalité (%)</label>
                                                <input required type="number" step="any" name="taux_de_penalite" id="taux_de_penalite_modify" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="periodicite_de_penalite">Périodicité de pénalité</label>
                                                <select required name="periodicite_de_penalite" id="periodicite_de_penalite_modify" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
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
                                                <select required name="typeModalite" id="typeModalite_add" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
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

                                        <div id="sections_container" class="hidden"> </div>

                                        <div class="flex mb-2 hidden" id="ajouter_date_payement_div">
                                            <button title="Ajouter une date de reglement" style="background-color:blue; color:white;" type="button" id="ajouter_date_payement" class="ajouter_date_payement btn"><strong>+</strong></button>
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
                <h1 class="flex justify-center items-center text-black text-5xl"> Ajouter une dette fournisseur</h1>
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
                                                <label for="objet">Objet</label>
                                                <input required type="text" name="objet" id="objet" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="date_effet">Date effet</label>
                                                <input required type="date" name="date_effet" id="date_effet" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="date_echeance">Date échéance</label>
                                                <input required type="date" name="date_echeance" id="date_echeance" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="montant">Montant dû</label>
                                                <input required type="number" step="any" name="montant" id="montant" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="montant_paye">Montant reglé</label>
                                                <input required type="number" step="any" name="montant_paye" id="montant_paye" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <!-- <div class="col mr-2 w-full">
                                                <label for="status">Status</label>
                                                <input required type="text" name="status" id="status" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div> -->
                                        </div>

                                        
                                        <div class="flex mb-2">

                                            <div class="col mr-2 w-full">
                                                <input id="ligne_fournisseur_input_modify" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Cherchez par reference ou par designation">
                                                <select multiple  name="ligne_fournisseur" id="ligne_fournisseur_selecte_modify" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="-1" selected disabled>Choisir un fournisseur...</option>
                                                    @foreach ($fournisseursPresents as $fournisseursPresent )
                                                        <option value="{{$fournisseursPresent->id}}">{{$fournisseursPresent->fournisseur->nom}} ({{$fournisseursPresent->fournisseur->email}}) ({{$fournisseursPresent->fournisseur->phone}}) ({{$fournisseursPresent->fournisseur->type}}) </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="taux_de_penalite">Taux de pénalité (%)</label>
                                                <input required type="number" step="any" name="taux_de_penalite" id="taux_de_penalite_modify" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="periodicite_de_penalite">Périodicité de pénalité</label>
                                                <select required name="periodicite_de_penalite" id="periodicite_de_penalite_modify" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
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
    
        function gestionDeLaDette(){


            let adding = document.getElementById('adding_erea')
            adding.classList.remove("hidden")    
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")
            let trElement = event.target.closest('tr');
            const dette_fournisseur_id = trElement.getAttribute('data-id');
            const montant = trElement.getAttribute('data-montant');
            const date_echeance = trElement.getAttribute('data-date_echeance');
            const date_effet = trElement.getAttribute('data-date_effet');
            const taux_de_penalite = trElement.getAttribute('data-taux_de_penalite');
            const periodicite_de_penalite = trElement.getAttribute('data-periodicite_de_penalite');
            const manierePayement = trElement.getAttribute('data-manierePayement');
            let modalitePeriodiqueMontant = trElement.getAttribute('data-modalitePeriodiqueMontant')
            if(modalitePeriodiqueMontant && modalitePeriodiqueMontant != null && modalitePeriodiqueMontant != undefined){
                modalitePeriodiqueMontant = JSON.parse(modalitePeriodiqueMontant);
            }

            // {"id":3,"dette_fournisseur_id":2,"montant":5,"status":"En cours","periodicite_payement":"trimestre","created_at":"2024-09-03T15:02:02.000000Z","updated_at":"2024-09-03T15:02:02.000000Z"}


            const formulaire = document.getElementById('formulaire_ajout');
            const selectElement = formulaire.querySelector('select[name="typeModalite"]');
            if (manierePayement === "Périodique") {
                selectElement.querySelector('option[value="Échelonnée"]').disabled = true;
                formulaire.querySelector('select[name="periodicite_payement"]').value = modalitePeriodiqueMontant.periodicite_payement?modalitePeriodiqueMontant.periodicite_payement:'';
                formulaire.querySelector('input[id="montantARegler_add"]').value = modalitePeriodiqueMontant.montant?modalitePeriodiqueMontant.montant:'';
            } else if (manierePayement === "Échelonnée") {
                selectElement.querySelector('option[value="Périodique"]').disabled = true;
            }

            if(periodicite_de_penalite != null && date_effet != null && date_echeance != null && taux_de_penalite != null){
                formulaire.querySelector('select[name="periodicite_de_penalite"]').value = periodicite_de_penalite;
                formulaire.querySelector('input[name="date_effet"]').value = date_effet.split(' ')[0];
                formulaire.querySelector('input[name="date_echeance"]').value = date_echeance.split(' ')[0];
                formulaire.querySelector('input[name="taux_de_penalite"]').value = taux_de_penalite;
                formulaire.querySelector('input[name="montant-dette"]').value = montant;
            }

            formulaire.querySelector('input[name="dette_fournisseur_id"]').value = dette_fournisseur_id;



            // const input_element = document.getElementById("ligne_fournisseur_input_add")
            // const select_element = document.getElementById("ligne_fournisseur_selecte_add")
            // inputFournisseurs(input_element, select_element);
            // onChangeFournisseurs(input_element, select_element)
            effacer_erreurs();
            gestionTypeModalite();
        }
        

        function gestionTypeModalite(){
            document.getElementById('typeModalite_add').addEventListener('change', function(){

                if(this.value === "Périodique"){

                    document.getElementById('date_reglement_div').classList.add('hidden');
                    document.getElementById('ajouter_date_payement_div').classList.add('hidden');
                    document.getElementById('date_reglement').setAttribute('disabled', 'disabled');
                    document.getElementById('periodicite_payement_div').classList.remove('hidden');
                    document.getElementById('periodicite_payement_add').removeAttribute('disabled');
                    document.getElementById('date_reglement').removeAttribute('required');
                    
                }else if(this.value === "Échelonnée"){
                    document.getElementById('date_reglement').removeAttribute('disabled');
                    document.getElementById('ajouter_date_payement_div').classList.remove('hidden');
                    document.getElementById('periodicite_payement_div').classList.add('hidden');
                    document.getElementById('periodicite_payement_add').setAttribute('disabled', 'disabled');
                    document.getElementById('date_reglement_div').classList.remove('hidden');
                }
            })
        }

        
        function modifier(){
            let modifying = document.getElementById('modifying_erea')
            modifying.classList.remove("hidden")    
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")
            let trElement = event.target.closest('tr');
            const id_dette = trElement.getAttribute('data-id');
            const montant = trElement.getAttribute('data-montant');
            const date_echeance = trElement.getAttribute('data-date_echeance');
            const taux_de_penalite = trElement.getAttribute('data-taux_de_penalite');
            const periodicite_de_penalite = trElement.getAttribute('data-periodicite_de_penalite');
            const date_effet = trElement.getAttribute('data-date_effet');
            const objet = trElement.getAttribute('data-objet');
            const montant_paye = trElement.getAttribute('data-montant_paye');
            const status = trElement.getAttribute('data-status');
    
            const formulaire = document.getElementById('formulaire_modif');
            formulaire.querySelector('input[name="id_dette"]').value = id_dette;
            formulaire.querySelector('select[name="ligne_fournisseur"]').value = ligne_fournisseur;
            formulaire.querySelector('input[name="montant"]').value = montant;
            formulaire.querySelector('input[name="date_echeance"]').value = date_echeance;
            formulaire.querySelector('input[name="date_effet"]').value = date_effet;
            formulaire.querySelector('select[name="periodicite_de_penalite"]').value = periodicite_de_penalite;
            formulaire.querySelector('input[name="taux_de_penalite"]').value = taux_de_penalite;
            formulaire.querySelector('input[name="objet"]').value = objet;
            formulaire.querySelector('input[name="montant_paye"]').value = montant_paye;
            // formulaire.querySelector('select[name="status"]').value = status;

            const input_element = document.getElementById("ligne_fournisseur_input_modify")
            const select_element = document.getElementById("ligne_fournisseur_selecte_modify")
            inputFournisseurs(input_element, select_element);
            onChangeFournisseurs(input_element, select_element)
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
                document
               var formData = new FormData(formulaire_ajou);
               var request = new XMLHttpRequest();
               request.open('POST', '/store_plan_dette_fournisseur');
               request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
               request.onreadystatechange = function() {
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {

                        effacer_erreurs();
                        if(JSON.parse(request.responseText).erreurMontant){
                            toastr.warning('Erreur de montant');
                            return;
                        }
                        
                        if(JSON.parse(request.responseText).typeError){
                            toastr.warning('Erreur de type...');
                            return;
                        }
                        toastr.success('Ajout éffectué avec succès.');
                    } else {
                        var response = JSON.parse(request.responseText);
                        console.log(response);
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
            request.open('POST', '/edit_dette_fournisseur');
            request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            request.onreadystatechange = function() {
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        effacer_erreurs();
                        if(JSON.parse(request.responseText).erreurMontant){
                            toastr.warning('Erreur de montant');
                            return;
                        }
                        toastr.success('Dette modifiée avec succès');
                    }else if(request.status === 419){
                        toastr.error('Cette a expiré! Veuillez recharger la page pour continuer...', 'Erreur');
                    }else {

                        console.log(request.status);return;
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



