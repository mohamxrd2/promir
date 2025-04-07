@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div id="displaying_erea" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="mb-8"></div>
            <div class="col-span-12 card 2xl:col-span-12">
                <div class="card-body">
                    <div id="modalDiv" class="hidden fixed inset-0 z-50 flex items-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
                        <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
                        <div class="card relative mx-auto mt-12 bg-white rounded-lg shadow-lg max-w-lg p-6">
                            <form id="modifyProduFitOfApprovisionnement">
                                <div class="flex mb-2 mt-2">
                                    <input class="hidden" type="number" name="idProduit">
                                    <div class="col mr-2 w-full">
                                        <label for="quantite_entree">Quantité entrée</label>
                                        <input name="quantite_entree" id="quantite_entreez" type="number" step="any" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                    </div>

                                    <div class="col mr-2 w-full">
                                        <label for="prix_unitaire_achat">PU Achat</label>
                                        <input name="prix_unitaire_achat" id="prix_unitaire_achatz" type="number" step="any" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                    </div>
                                    
                                    <div class="col mr-2 w-full">
                                        <label for="somme_reglee">Montant règlé</label>
                                        <input name="somme_reglee" id="somme_regleez" type="number" step="any" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                    </div>
                                </div>
                                <div class="mt-6 flex justify-between space-x-4">
                                    <button type="button" onclick="cencelProcess()" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Retour</button>
                                    <button type="button" onclick="actualiser()" class="text-white btn ml-8 bg-gray-500 border-gray-500 hover:text-white hover:bg-gray-600 hover:border-gray-600 active:text-white active:bg-gray-600 active:border-gray-600 active:ring active:ring-gray-100 dark:ring-gray-400/20 mr-2">Actualiser</button>
                                    <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Confirmer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                        <div class="flex items-center">
                            <div class="2xl:col-span-3">
                                <h5 class="mr-2">Gestion des approvisionnements</h5>
                            </div>
                            <button onclick="ajouter()" class="inline-block rounded-full bg-white transition-all duration-300 ease-in-out hover:bg-gray-400 active:bg-gray-500">
                                <i id="btn_ajouter" class="align-baseline ltr:pr-1 rtl:pl-1 ri-add-line text-lg text-black"></i>
                            </button>
                
                            <a href="#" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
                                <i class="fas fa-industry inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                <span class="align-middle">Approvisionnement</span>
                            </a>   
                            
                            <div class="relative">
                                <i data-lucide="calendar-range" class="absolute size-4 ltr:left-3 rtl:right-3 top-3 text-slate-500 dark:text-zink-200"></i>
                                <input type="text" class="ltr:pl-10 rtl:pr-10 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" readonly="readonly" placeholder="Select Date">
                            </div>

                        </div>                    
                        <div class="2xl:col-span-3 2xl:col-start-10">
                            <div class="flex gap-3">
                                <div class="relative grow">
                                    <input id="searchInput" class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Cherchez ici ..." autocomplete="off">
                                    <i data-lucide="search" class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                                </div>
                                <button type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i class="align-baseline ltr:pr-1 rtl:pl-1 ri-upload-2-line"></i>Exporter</button>
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
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reference payement</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Moyen payement</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Description </th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Montant total payé</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                    $i = 0;
                                @endphp
                                    @foreach ($approvisionnements as $approvisionnement)
                                        <tr
                                        data-id= "{{ $approvisionnement->id}}"
                                        data-reference_payement="{{ $approvisionnement->reference_payement }}"
                                        data-moyen_payement="{{ $approvisionnement->moyen_payement}}"
                                        data-description="{{ $approvisionnement->description}}"
                                        data-montant_paye="{{ $approvisionnement->montant_paye}}">



                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{++$i}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">{{$approvisionnement->reference_payement}}</a></td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$approvisionnement->moyen_payement}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$approvisionnement->description}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$approvisionnement->montant_paye}}</td>
                                       
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                            <div class="relative dropdown">
                                                <button id="orderAction1" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20 w-20"><i data-lucide="more-horizontal" class="size-4"></i></button>
                                                <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction1">
                                                    <li>
                                                        <button onclick="details_approvisionnement()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"><i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Afficher</span></button>
                                                    </li>
                                                    <li>
                                                        <button type="button" onclick="modifier()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Modifier</span></button>
                                                    </li>
                                                    <li>
                                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="{{ route('approvisionnement.delete', ['id' => $approvisionnement->id]) }}" onclick="return confirm('Cette action est irreversible! Êtes-vous sûr de vouloir éffectuer la suppression ?')"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Supprimer</span></a> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        </tr>
                                @endforeach 
                                @if($i == 0)
                                    <div id="aucunelement" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <strong class="font-bold">Vide!</strong>
                                        <span class="block sm:inline">Vos approvisionements journaliers s'affichent ici...</span>
                                    </div>
                                @endif                                
                            </tbody>
                        </table>
                        <table id="approvisionnementOverView" class="w-full whitespace-nowrap hidden">
                            <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
                                <tr>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        N°
                                    </th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reference du produit</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Designation du produit</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Prix unitaire</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Format</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Type</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Calibrage</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Conditionnement</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Quantité entrée</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">PU Achat</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Montant règlé</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Coût partiel</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                            </tbody>
                            <div id="aucunelement" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Vide!</strong>
                                <span class="block sm:inline">Les produit approvisionnés s'affichent ici...</span>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="adding_erea" class="hidden group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="mb-8"></div> 
                <div class=" transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form id="formulaire_ajout">

                                      
                                        <div class="flex mb-2">
                                           
                                            <div class="col mr-2 w-full">
                                                <label for="fournisseur_input">Fournisseur</label>
                                                <input id="fournisseur_input" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Cherchez par reference ou par designation">
                                                <select multiple  name="fournisseur" id="fournisseur_select" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="-1" selected disabled>Choisir ici...</option>
                                                    @foreach($fournisseurs as $fournisseur)
                                                        <option value="{{$fournisseur->id}}">{{$fournisseur->fournisseur->nom}}, {{$fournisseur->fournisseur->type}}, {{$fournisseur->fournisseur->adresse}}, {{$fournisseur->fournisseur->email}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="typeApproisionnement">Type d'approvisionnement</label>
                                                <select  name="typeApproisionnement" id="typeApproisionnement" class="type ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="Au comptant" selected>Au comptant</option>
                                                    <option value="À crédit">À crédit</option>
                                                </select>
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="moyen_payement">Moyen de payement</label>
                                                <select id="moyen_payement" name="moyen_payement" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="" disabled selected>Choisissir un moyen</option>
                                                    <option value="Payement BIICF">Payement BIICF</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Orange money">Orange money</option>
                                                    <option value="MTN money">MTN money</option>
                                                    <option value="Moov money">Moov money</option>
                                                    <option value="Cash">Wave</option>
                                                    <option value="Trasor money">Trasor money</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="montant_paye">Montant total payé</label>
                                                <input required type="number" id="montant_paye" name="montant_paye" class="montant_paye ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="reference_payement">Reference payement</label>
                                                <input required type="text" id="reference_payement" name="reference_payement" class="reference_payement ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="description">Description</label>
                                                <textarea id="description" name="description" class="description ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on"></textarea>
                                            </div>
                                        </div>

                                        <div class="flex items-center mt-3">
                                            <h3 class="mx-auto"><strong>Produits à approvisionner</strong></h3>
                                        </div>
                                        


                                        <div id="produit_template0" class="produit-item mb-8">
                                            <div class="flex mb-2">
                                                <div class="col mr-2 w-full">
                                                    <label class="productLabel" for="element_a_approvisionner_input">Produit 1 </label>
                                                    <input name="produits_input[0]" class="element_a_approvisionner_input row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Cherchez par reference ou par designation">
                                                    <select multiple value="" name="produits[0]" class="element_a_approvisionner_selecte ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                        <option value="-1" selected disabled>Cherchez dans vos produits</option>
                                                        @foreach ($produitsPresents as $produitsPresent)
                                                            <option value="{{$produitsPresent->id}}">{{$produitsPresent->produit->reference}}, {{$produitsPresent->produit->categorie->nom}}, {{$produitsPresent->produit->designation}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="flex mb-2">
                                                <div class="col mr-2 w-full">
                                                    <label for="reference">Reference </label>
                                                    <input readonly type="text" name="reference[0]" class="reference row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                </div>
                                                <div class="col mr-2 w-full">
                                                    <label for="designation">Désignation</label>
                                                    <input readonly type="text" name="designation[0]" class="designation row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                </div>
                                            </div>

                                            <div class="flex mb-2">
                                                <div class="col mr-2 w-full">
                                                    <label for="conditionnement">Conditionnement</label>
                                                    <input readonly type="text" name="conditionnement[0]" class="conditionnement row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                </div>
                                                <div class="col mr-2 w-full">
                                                    <label for="format">Format</label>
                                                    <input readonly type="text" name="format[0]" class="format row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                </div>
                                                <div class="col mr-2 w-full">
                                                    <label for="calibrage">Particularité</label>
                                                    <input readonly type="text" name="calibrage[0]" class="calibrage row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                </div>
                                                <div class="col mr-2 w-full">
                                                    <label for="format">Origine</label>
                                                    <select readonly name="type[0]" class="type ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                        <option value="" disabled selected>L'origine s'affiche ici...</option>
                                                        <option value="Importé">Importé</option>
                                                        <option value="Locale">Locale</option>
                                                    </select>
                                                </div>
                                            </div>

                                        <div class="flex mb-2">

                                            <div class="col mr-2 w-full">
                                                <label for="qte_stck">Qté en stock</label>
                                                <input readonly type="number" step="any" name="qte_stck[0]" class="qte_stck row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>


                                            <div class="col mr-2 w-full">
                                                <label for="pua">P.U.M.A</label>
                                                <input readonly type="number" step="any" name="pua[0]" class="pua ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="puv">P.U.M.V</label>
                                                <input readonly type="number" step="any" name="puv[0]" class="puv ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div> 
                                            
                                        </div>

                                        
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="nom_piece">Nom Unité</label>
                                                <input readonly type="text" name="nom_piece[0]" class="nom_piece ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="nombre_pieces">Nombre unités</label>
                                                <input readonly type="number" step="any" value="1" name="nombre_pieces[0]" class="nombre_pieces ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="libelle_portion">Portion unitaire</label>
                                                <input readonly type="text" name="libelle_portion[0]" class="libelle_portion ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="nombre_portions">Nbr port. par unité</label>
                                                <input readonly type="number" step="any" value="1" name="nombre_portions[0]" class="nombre_portions ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="quantite_entree">Quantité entrée</label>
                                                <input required type="number" step="any" min="0" name="quantite_entree[0]" class="quantite_entree ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="prix_unitaire_achat">PU Achat</label>
                                                <input required type="number" step="any" min="0" name="prix_unitaire_achat[0]" class="prix_unitaire_achat ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            
                                            <div class="col mr-2 w-full">
                                                <label for="somme_reglee">Montant règlé</label>
                                                <input name="somme_reglee[0]" id="somme_reglee" type="number" step="any" min="0" class="somme_reglee ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"  placeholder="Tapez ici..." autocomplete="on" >
                                            </div>
                                        </div>


                                    </div>


                                    <div id="produit_container">
                                    </div>

                                        <div class="flex mb-2 flex justify-between">
                                            <button type="button" id="ajouter_produit" class="btn">+ Ajouter un produit</button>
                                            <label class="mr-12" for="totalPrixCalcule" id="totalPrixCalcule"> Coût total: ...</label>
                                        </div>

                                        <div class="flex justify-end w-full">
                                            <button type="button" onclick="afficher()" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Retour</button>
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
        <input class="hidden" type="text" id="devise" value="{{auth()->user()->system_client->devise}}">

    <script>

        let prixTotale = 0.0;
        const devise = $('#devise').val();
        function modifyProduitOfApprovisionnement(){
            let trElement = event.target.closest('tr');
            var idProduit = trElement.getAttribute('data-id');
            var somme_reglee = trElement.getAttribute('data-somme_reglee');
            var prixUnitaireAchat = trElement.getAttribute('data-prix_unitaire_achat');
            var quantiteEntree = trElement.getAttribute('data-quantite_entree');
            const modifyProduitOfApprovisionnementForm = document.getElementById('modifyProduitOfApprovisionnement');
            modifyProduitOfApprovisionnementForm.querySelector('input[name="quantite_entree"]').value = quantiteEntree;
            modifyProduitOfApprovisionnementForm.querySelector('input[name="prix_unitaire_achat"]').value = prixUnitaireAchat;
            modifyProduitOfApprovisionnementForm.querySelector('input[name="somme_reglee"]').value = somme_reglee;
            modifyProduitOfApprovisionnementForm.querySelector('input[name="idProduit"]').value = idProduit;
            document.getElementById('modalDiv').classList.remove('hidden');
            submitModifyProduit(modifyProduitOfApprovisionnementForm);
        }

        function submitModifyProduit(modifyProduitOfApprovisionnementForm){
            modifyProduitOfApprovisionnementForm.addEventListener('submit', function(event) {
                event.preventDefault();
                var data_to_modify = new FormData(modifyProduitOfApprovisionnementForm);
                var request = new XMLHttpRequest();
                request.open('POST', '/edit_produit_of_approvisionnement');
                request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                request.onreadystatechange = function() {
                    
                    if (request.readyState === XMLHttpRequest.DONE) {
                        if (request.status === 200) {

                            var response = JSON.parse(request.responseText);
                            var errorMessageElements = document.querySelectorAll('.error-message');
                            if(errorMessageElements.length > 0){
                                errorMessageElements.forEach(function(element) {
                                    element.parentNode.removeChild(element);
                                });
                            }
                            toastr.success('Valeurs modifiées avec succès!', 'OK');
                            // document.getElementById('modalDiv').classList.add('hidden');
                            // window.location.reload();
                        }else if(request.status === 419){
                            toastr.error('Cette a expiré! Veuillez recharger la page pour continuer...', 'Erreur');
                        }else {
                            var response = JSON.parse(request.responseText);
                            if (response.errors) {
                                var errorMessageElements = document.querySelectorAll('.error-message');
                                if(errorMessageElements.length > 0){
                                    errorMessageElements.forEach(function(element) {
                                        element.parentNode.removeChild(element);
                                    });
                                }
                                var errors = response.errors;
                                Object.keys(errors).forEach(function(key) {
                                    var inputField = modifyProduitOfApprovisionnementForm.querySelector('[name="' + key + '"]');
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
        }

        let prixUnitaireProduit = 0.0;
        let coutTotal = 0.0;
        var marge = 0.0;
        

      
        function addInputEventToSpecificInput(element){
            let timeId;
            const element_a_approvisionner_selecte = $(element + ' .element_a_approvisionner_selecte');
            const quantite_entree = $(element + ' .quantite_entree');
            const prix_unitaire_achat = $(element + ' .prix_unitaire_achat');

            $( element + ' .somme_reglee').css('border', "1px solid rgba(0, 0, 0, 0.1)");

            $( element + ' .somme_reglee').on('input', function(){
                if($('#typeApproisionnement').val() == "Au comptant"){
                    if($(this).val() < (quantite_entree.val() * prix_unitaire_achat.val())){
                        $(this).css("border", "1px solid rgba(255, 0, 0, 0.5)");
                    }else if($(this).val() == (quantite_entree.val() * prix_unitaire_achat.val())){
                        $(this).css("border", "1px solid rgba(0, 255, 0, 0.5)");
                    }else if($(this).val() > (quantite_entree.val() * prix_unitaire_achat.val())){
                        $(this).css("border", "1px solid rgba(128, 0, 128, 0.5)");
                    }
                }
            });
            


            $( element + ' .prix_unitaire_achat').on('input', function(){
                prixTotale = 0.0;
                $('.produit-item').each(function() {
                    prixTotale += $(this).find('input.quantite_entree').val() * $(this).find('input.prix_unitaire_achat').val();
                });

                $("#totalPrixCalcule").text("Prix total: " + prixTotale);
            });

            $( element + ' .quantite_entree').on('input', function(){
                prixTotale = 0.0;
                $('.produit-item').each(function() {
                    prixTotale += $(this).find('input.quantite_entree').val() * $(this).find('input.prix_unitaire_achat').val();
                });

                $("#totalPrixCalcule").text("Prix total: " + prixTotale);
            });
            


            element_a_approvisionner_selecte.on('change', function(){
                $.ajax({
                    url: "{{ route('render-product_properties_for_vente') }}",
                    method: 'GET',
                    data: { id_produit: $(this).val()[0]},
                    success: function(response) {
                        if(response){
                            if(response.produit_brut){
                                $(element + ' .element_a_approvisionner_input').val(response.produit_brut.produit.designation);
                                $(element + ' .reference').val(response.produit_brut.produit.reference);
                                $(element + ' .designation').val(response.produit_brut.produit.designation);
                                $(element + ' .conditionnement').val(response.produit_brut.produit.conditionnement);
                                $(element + ' .format').val(response.produit_brut.produit.format);
                                $(element + ' .calibrage').val(response.produit_brut.produit.calibrage);
                                $(element + ' .type').val(response.produit_brut.produit.type);
                                $(element + ' .qte_stck').val(response.produit_brut.qte_stck);
                                $(element + ' .pua').val(response.produit_brut.pua);
                                $(element + ' .puv').val(response.produit_brut.puv);
                                $(element + ' .nom_piece').val(response.produit_brut.nom_piece);
                                $(element + ' .nombre_pieces').val(response.produit_brut.nombre_pieces);
                                $(element + ' .libelle_portion').val(response.produit_brut.portion);
                                $(element + ' .nombre_portions').val(response.produit_brut.nombre_portions);
                                return;
                            }
                        }else{
                            toastr.error('Une erreur s\'est produite lors du rendu de traitement. Veuillez recommencer.'); return;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            })

            $(element + ' .element_a_approvisionner_input').on('input', function () {
                clearTimeout(timeId);
                const terme = $(this).val();
                timeId = setTimeout(function () {
                    $.ajax({
                        url: '/rechercher-lignes_system_produit',
                        method: 'GET',
                        data: { terme: terme},
                        success: function (response) {
                            if(response.produits_brut){
                                element_a_approvisionner_selecte.empty();
                                element_a_approvisionner_selecte.append('<option selected disabled value="">Choisir un produit ici...</option>');
                                    $.each(response.produits_brut, function(index, produit_brut){
                                        element_a_approvisionner_selecte.append(
                                            $('<option></option>').attr('value', produit_brut.id).text(produit_brut.produit.designation + ' (' + produit_brut.produit.reference + ')' + ' (' + produit_brut.pua + ' FCFA)'+ ' (' + produit_brut.puv + ' FCFA)'+ ' (' + produit_brut.portion + ')'+ ' (' + produit_brut.nombre_portions + ')')
                                        );
                                    });
                                    return;
                                }else if(response.other_error){
                                    toastr.error('Une erreur s\'est produite. Veuillez recommencer...'); return;
                                }
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                            return;
                        }
                    });
                }, 250);
            });
        }

        addInputEventToSpecificInput('#produit_template0');
        $(document).ready(function () {
            var produitCounter = 1;
            $('#ajouter_produit').on('click', function () {
                var newProduit = $('#produit_template0').clone();
                newProduit.attr('id', 'produit_template' + produitCounter);
                var deleteButton = $('<button type="button" class="supprimer_produit error text-red-500">--Supprimer</button>');
                newProduit.append(deleteButton);
                newProduit.find('.productLabel').text("Produit " + (produitCounter+1));
                newProduit.find('input, select').each(function() {
                    var name = $(this).attr('name');
                    name = name.replace('0', produitCounter);
                    $(this).attr('name', name);
                    if ($(this).is('input')) {
                        $(this).val('');
                    } else if ($(this).is('select')) {
                        $(this).val('-1');
                    }
                });
                newProduit.removeClass('hidden');
                $('#produit_container').append(newProduit);

                var element = '#produit_template' + String(produitCounter);
                addInputEventToSpecificInput(element);


                deleteButton.on('click', function () {
                    newProduit.remove();
                });
                produitCounter++;
            });
        });


        function ajouter(){

            let adding = document.getElementById('adding_erea')
            adding.classList.remove("hidden")    
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")
            let timerId;
        }

    
   
    function details_approvisionnement(){

        let sells_table = document.getElementById('personnelTable');
        let details_table = document.getElementById('approvisionnementOverView');
        details_table.classList.remove("hidden")
        sells_table.classList.add("hidden")
        let trElement = event.target.closest('tr');
        var idApprovisionnement = trElement.getAttribute('data-id');
        const message = "Cette action est irreversible! Êtes-vous sûr de vouloir éffectuer la suppression ?"
        $.ajax({
            url: '/render-details-approvisionnement',
            method: 'GET',
            data: { query: idApprovisionnement },
            success: function(response) {
                
                var produitsApprovisionnes = response.produitsApprovisionnes;
                if (produitsApprovisionnes.length === 0) {
                    $('#aucunelement').removeClass('hidden');
                } else {
                    $('#aucunelement').addClass('hidden');
                }
                var tbody = $('#approvisionnementOverView tbody');
                tbody.empty();

                $.each(produitsApprovisionnes, function(index, produitsApprovisionne) {
                    if (produitsApprovisionne.produit) {
                        let url = '{{ route("produitOpfApprovisionnement.detach", [":idProduit", ":idApprovisionnement"]) }}'.replace(':idProduit', produitsApprovisionne.id).replace(':idApprovisionnement', idApprovisionnement);
                        // var coutPartiel = coutPortionUnitaire(produitsApprovisionne.pua, produitsApprovisionne.qte_stck_satic_apres_appro, produitsApprovisionne.nombre_pieces, produitsApprovisionne.nombre_portions) * produitsApprovisionne.pivot.quantite_entree;
                        // coutPartiel = Math.round((coutPartiel + Number.EPSILON) * 100000) / 100000;
                        var row = '<tr data-id="' + produitsApprovisionne.pivot.id + '" data-quantite_entree="' + produitsApprovisionne.pivot.quantite_entree + '" data-prix_unitaire_achat="' + produitsApprovisionne.pivot.prix_unitaire_achat+ '" data-somme_reglee="' + produitsApprovisionne.pivot.somme_reglee + '">' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + (index + 1) + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">' + produitsApprovisionne.produit.reference + '</a></td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsApprovisionne.produit.designation + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsApprovisionne.pua + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsApprovisionne.produit.format + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsApprovisionne.produit.type + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsApprovisionne.produit.calibrage + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsApprovisionne.produit.conditionnement + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsApprovisionne.pivot.quantite_entree + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsApprovisionne.pivot.prix_unitaire_achat + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsApprovisionne.pivot.somme_reglee + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsApprovisionne.pivot.prix_unitaire_achat * produitsApprovisionne.pivot.quantite_entree + '</td>' +
                            // '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + coutPartiel + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' +
                            '<a onclick="modifyProduitOfApprovisionnement()" class="px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zinc-100 dark:hover:bg-zinc-500 dark:hover:text-zinc-200 dark:focus:bg-zinc-500 dark:focus:text-zinc-200"><i class="fas fa-edit inline-block size-3 ltr:mr-1 rtl:ml-1"></i></a>'+
                            '<a href="' + url + '" onclick="return confirm(\'' + message + '\')" class="px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zinc-100 dark:hover:bg-zinc-500 dark:hover:text-zinc-200 dark:focus:bg-zinc-500 dark:focus:text-zinc-200"><i class="fas fa-trash-alt inline-block size-3 ltr:mr-1 rtl:ml-1"></i></a>'+
                            '</td>' +
                            '</tr>';

                        tbody.append(row);
                    }
                });

                $('#approvisionnementOverView').removeClass('hidden');
            },
            error: function() {
                toastr.error('Erreur lors de la récupération des données.');
            }
        });
    }


        function modifier(){
            let modifying = document.getElementById('modifying_erea')
            modifying.classList.remove("hidden")  
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")
            let trElement = event.target.closest('tr');
    
            const vente_id = trElement.getAttribute('data-id');
            const reference = trElement.getAttribute('data-reference');
            const moyen_payement = trElement.getAttribute('data-moyen_payement');
            const status_vente = trElement.getAttribute('data-status_vente');
            
            
            formulaire = document.getElementById('formulaire_modif');
            formulaire.querySelector('input[name="vente_id"]').value = vente_id;
            formulaire.querySelector('input[name="reference"]').value = reference;
            formulaire.querySelector('select[name="moyen_payement"]').value = moyen_payement;
            formulaire.querySelector('select[name="status_vente"]').value = status_vente;
        }
    
        function afficher(){
            window.location.reload();
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.remove("hidden")
            let adding = document.getElementById('adding_erea')
            if(adding){
                adding.classList.add("hidden")
            }

            let modifying = document.getElementById('modify_contrat')
            if(modifying){
                modifying.classList.add("hidden")
            }
        }

        function verificationReglements() {
            const t = document.getElementById('typeApproisionnement').value;
            if (t === "Au comptant") {
                let i = 0;
                let produitNonPaye = null;
                $('.produit-item').each(function() {
                    i++;
                    const quantite_entree = $(this).find('input.quantite_entree').val();
                    const prix_unitaire_achat = $(this).find('input.prix_unitaire_achat').val();
                    const somme_reglee = $(this).find('input.somme_reglee').val();
                    if (Number(quantite_entree) * Number(prix_unitaire_achat) != Number(somme_reglee)) {
                        produitNonPaye = {
                            trueFalse: true,
                            numeroProduit: i
                        };
                        return false;
                    }
                });
                if (produitNonPaye) {
                    return produitNonPaye;
                } else {
                    return {
                        trueFalse: false,
                        numeroProduit: null
                    };
                }
            }
        }



        var formulaire_ajou = document.getElementById('formulaire_ajout');
        formulaire_ajou.addEventListener('submit', function(event) {
            event.preventDefault();

            const t = document.getElementById('typeApproisionnement').value;
            if (t === "Au comptant") {
                if(Number(prixTotale) != Number($('#montant_paye').val())){

                    return toastr.warning('Vous devez tout payer! Le montant à payer est de ' + prixTotale +' '+ devise);
                }

                if(verificationReglements().trueFalse === true && verificationReglements().numeroProduit !== null){
                    return toastr.warning('Le montant du produit ' + verificationReglements().numeroProduit + ' est incorrecte! Veuillez entrer une valeur cerrecte...');
                }
            }
            
            
               var formData = new FormData(formulaire_ajou);
               var request = new XMLHttpRequest();
               request.open('POST', '/store_approvisionnement');
               request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
               request.onreadystatechange = function() {
  
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        var response = JSON.parse(request.responseText);
                        var errorMessageElements = document.querySelectorAll('.error-message');
                        if(errorMessageElements.length > 0){
                            errorMessageElements.forEach(function(element) {
                                element.parentNode.removeChild(element);
                            });
                        }

                        
                        if(response.error){
                            toastr.info(response.error);
                            return;
                        }
                        toastr.success('Approvisionnement ajouté avec succès!');
                    } else {
                        var response = JSON.parse(request.responseText);
                      
                        if (response.errors) {
                            var errorMessageElements = document.querySelectorAll('.error-message');
                            if(errorMessageElements.length > 0){
                                errorMessageElements.forEach(function(element) {
                                    element.parentNode.removeChild(element);
                                });
                            }
                            var errors = response.errors;
                            Object.keys(errors).forEach(function(key) {
                                k = key.replace(/(\w+)\.(\d+)/, '$1[$2]');

                                var inputField = formulaire_ajou.querySelector('[name="' + k + '"]');
                                
                                if (inputField) {
                                    var errorElement = document.createElement('span');
                                    errorElement.className = 'error-message text-red-500';
                                    errorElement.textContent = errors[key][0];
                                    inputField.parentNode.appendChild(errorElement);
                                }
                            });
                        } else {
                            console.log(JSON.parse(request.responseText))
                            toastr.error('Une erreur s\'est produite lors de la requête.', 'Erreur');
                        }
                    }
                }
    
            };
            request.send(formData);
          
        });

       
   
        if(document.getElementById("aucuncontrat")){
            document.getElementById("personnelTable").style.display = 'none';
        }
    
        function fonction_de_recherche(){
            document.getElementById('searchInput').addEventListener('input', function() {
                let filter = this.value.toLowerCase(); 
                let rows = document.querySelectorAll('#personnelTable tbody tr');
                rows.forEach(function(row) {
                    let cells = row.querySelectorAll('td');
                    let found = false;
            
                    cells.forEach(function(cell) {
                        if (cell.textContent.toLowerCase().includes(filter)) { 
                            found = true; 
                        }
                    });
                    row.style.display = found ? '' : 'none';
                });
            });

        }


        fonction_de_recherche();
        addInputEventToFournisseurInput();

            function addInputEventToFournisseurInput(){
                let timeId;
                const element_a_approvisionner_selecte = $('#fournisseur_select');
                $(document).ready(function() {
                    element_a_approvisionner_selecte.on('change', function() {
                        const idFournisseur = $(this).val();
                        $.ajax({
                            url: "{{ route('render-lignefournisseur_properties') }}",
                            method: 'GET',
                            data: {
                                idFournisseur: idFournisseur ? idFournisseur[0] : null,
                            },
                            success: function(response) {
                                if (response.lignefournisseur) {
                                    
                                    var lignefournisseur = response.lignefournisseur;

                                    $('#fournisseur_input').val(lignefournisseur.fournisseur.nom);
                                } else {
                                    toastr.error('Une erreur s\'est produite lors du rendu de traitement. Veuillez recommencer...');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error)
                                toastr.error('Erreur de connexion. Veuillez réessayer.');
                            }
                        });
                    });

                $('#fournisseur_input').on('input', function() {
                    clearTimeout(timeId);
                    const terme = $(this).val();
                    timeId = setTimeout(function () {
                        $.ajax({
                            url: '/rechercher-lignes_fournisseurs',
                            method: 'GET',
                            data: { query: terme},
                            success: function (response) {
                                if(response.lignesFounisseurs){
                                    element_a_approvisionner_selecte.empty();
                                    element_a_approvisionner_selecte.append('<option selected disabled value="">Choisir un fournisseur ici...</option>');
                                        $.each(response.lignesFounisseurs, function(index, lignesFounisseurs){
                                            element_a_approvisionner_selecte.append(
                                                $('<option></option>').attr('value', lignesFounisseurs.id).text(lignesFounisseurs.fournisseur.nom + ' (' + lignesFounisseurs.fournisseur.phone + ')' + ' (' + lignesFounisseurs.fournisseur.email + ')' + ' (' + lignesFounisseurs.fournisseur.adresse + ')' + ' (' + lignesFounisseurs.fournisseur.type + ')')
                                            );
                                        });
                                        return;
                                    }else if(response.other_error){

                                        toastr.error('Une erreur s\'est produite. Veuillez recommencer...'); return;
                                    }
                            },
                            error: function (xhr, status, error) {
                                toastr.error('Quelque chose a mal fonctioné! Veuillez recommencer...')
                                return;
                            }
                        });
                    }, 250);
                });
            });
        }
    </script>   
@endsection