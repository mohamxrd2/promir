@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div id="displaying_erea" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Liste des productions</h1>
            </div> 
                <div class="col-span-12 card 2xl:col-span-12">
                    <div class="card-body">
                        <div id="divModifyProduitOfProduction" class="hidden fixed inset-0 z-50 flex items-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
                            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
                            <div class="card relative mx-auto mt-12 bg-white rounded-lg shadow-lg max-w-lg p-6">
                                <form id="modifyProduitOfProduction">
                                    <div class="flex mb-2 mt-2">
                                        <input hidden type="number" name="idProduit">
                                        <div class="col mr-2 w-full">
                                            <label for="nbr_portions">Quantité (en portions)</label>
                                            <input name="nbr_portions" id="nbr_portionsz" type="number" step="any" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                        </div>
                                    </div>
                                    <div class="mt-6 flex justify-between space-x-4">
                                        <button type="button" onclick="annulerModificationProduit()" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Retour</button>
                                        <button type="button" onclick="actualiser()" class="text-white btn ml-8 bg-gray-500 border-gray-500 hover:text-white hover:bg-gray-600 hover:border-gray-600 active:text-white active:bg-gray-600 active:border-gray-600 active:ring active:ring-gray-100 dark:ring-gray-400/20 mr-2">Actualiser</button>
                                        <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Confirmer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                            <div class="flex items-center">
                                <div class="2xl:col-span-3">
                                    <h5 class="mr-2">Gestion des productions</h5>
                                </div>
                                <button onclick="ajouter()" class="inline-block rounded-full bg-white transition-all duration-300 ease-in-out hover:bg-gray-400 active:bg-gray-500">
                                    <i id="btn_ajouter" class="align-baseline ltr:pr-1 rtl:pl-1 ri-add-line text-lg text-black"></i>
                                </button>
                    
                                <a href="#" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
                                    <i class="fas fa-industry inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                    <span class="align-middle">Production</span>
                                </a>                            

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
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reference</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Désignation</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Portion u.</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Prix u. portion</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Nbre Prod. prévus</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($productions as $production)
                                        <tr
                                        data-id= "{{ $production->id}}"
                                        data-reference="{{ $production->produitTransforme->reference }}"
                                        data-designation="{{ $production->produitTransforme->designation}}"
                                        data-portion_unitaire="{{ $production->produitTransforme->portion_unitaire}}"
                                        data-prix_unitaire_portion="{{ $production->produitTransforme->prix_unitaire_portion}}"
                                        data-nbr_portions="{{ $production->nbr_portions}}">

                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{++$i}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">{{$production->produitTransforme->reference}}</a></td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$production->produitTransforme->designation}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$production->produitTransforme->portion_unitaire}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$production->produitTransforme->prix_unitaire_portion}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$production->nbr_portions}}</td>
                                    
                                        {{-- <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$p}}</td> --}}

                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                            <div class="relative dropdown">
                                                <button id="orderAction1" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20 w-20"><i data-lucide="more-horizontal" class="size-4"></i></button>
                                                <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction1">
                                                    <li>
                                                        <button onclick="details_production()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"><i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Afficher</span></button>
                                                    </li>
                                                    <li>
                                                        <button type="button" onclick="modifier()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Modifier</span></button>
                                                    </li>
                                                    <li>
                                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="{{ route('production.delete', ['id' => $production->id]) }}" onclick="return confirm('Cette action est irreversible! Êtes-vous sûr de vouloir éffectuer la suppression ?')"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Supprimer</span></a> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        </tr>
                                @endforeach 
                                @if($i == 0)
                                    <div id="aucunelement" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <strong class="font-bold">Vide!</strong>
                                        <span class="block sm:inline">Vos productions journalières s'affichent ici.</span>
                                    </div>
                                @endif                                
                            </tbody>
                        </table>
                        <table id="productionOverView" class="w-full whitespace-nowrap hidden">
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
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Quantité (portions)</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Coût partiel</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                            </tbody>
                            <div id="aucunelement" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Vide!</strong>
                                <span class="block sm:inline">Les composants s'affichent ici...</span>
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
                                                <label for="produit_transforme_input">Produit transformé</label>
                                                <input id="produit_transforme_input" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Cherchez par reference ou par designation">
                                                <select multiple  name="produit_transforme" id="produit_transforme_select" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="-1" selected disabled>Choisir ici...</option>
                                                    @foreach($produitTransformes as $produitTransforme)
                                                        <option value="{{$produitTransforme->id}}">{{$produitTransforme->reference}}, {{$produitTransforme->designation}}, {{$produitTransforme->portion_unitaire}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="reference">Reference</label>
                                                <input type="text" readonly name="referencept" id="reference" class="reference row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="designation">Désignation</label>
                                                <input type="text"  name="designationpt" id="designation" class="designation row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="portion_unitaire">Unité</label>
                                                <input type="text" name="portion_unitaire" id="portion_unitaire" class="portion_unitaire row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="prix_unitaire_portion">Prix unitaire</label>
                                                <input type="number" step="any" name="prix_unitaire_portion" id="prix_unitaire_portion" class="prix_unitaire_portion row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="qte_en_portions">Quantité en stock</label>
                                                <input readonly type="text" name="qte_en_portions" id="qte_en_portions" class="qte_en_portions row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>
                                        <div class="flex items-center mt-3">
                                            <h3 class="mx-auto"><strong>______________________________</strong></h3>
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="nbr_portions">Nombre P.P.</label>
                                                <input required type="number" min="0" step="any" id="nbr_portions" name="nbr_portions" class="nbr_portions ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div> 
                                            <div class="col mr-2 w-full">
                                                <label for="vma">V. Min. A.</label>
                                                <input required type="number" step="any" id="vma" name="vma" class="vma ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="coutTotal">Cout Total</label>
                                                <input required type="number" step="any" id="coutTotal" name="coutTotal" class="coutTotal ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div> 

                                            <div class="col mr-2 w-full">
                                                <label for="marge">Marge Com. Brute</label>
                                                <input required type="number" step="any" id="marge" name="marge" class="marge ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div> 
                                        </div>

                                        <div class="flex items-center mt-3">
                                            <h3 class="mx-auto"><strong>Composition en produits</strong></h3>
                                        </div>

                                        {{-- Ajout des produits a la vente --}}
                                      


                                        <div id="produit_template0" class="produit-item mb-8">
                                            <div class="flex mb-2">
                                                <div class="col mr-2 w-full">
                                                    <label class="productLabel" for="element_a_transformer_input">Produit 1 </label>
                                                    <input name="produits_input[0]" class="element_a_transformer_input row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Cherchez par reference ou par designation">
                                                    <select multiple value="" name="produits[0]" class="element_a_transformer_selecte ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                        <option value="-1" selected disabled>Cherchez dans les produits bruts</option>
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
                                                        <option value="" disabled selected hidden>Choisissez une origine</option>
                                                        <option value="Importé">Importé</option>
                                                        <option value="Locale">Locale</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="flex mb-2">
                                                <div class="col mr-2 w-full">
                                                    <label for="qte_stck">Quantité en stock</label>
                                                    <input readonly type="number" step="any" name="qte_stck[0]" class="qte_stck row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                </div>
                                                <div class="col mr-2 w-full">
                                                    <label for="pua">P.U.A</label>
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
                                                    <label for="quantite_utilisee">Quantité utilisée (portion)</label>
                                                    <input required type="number" step="any" min="0" name="quantite_utilisee[0]" class="quantite_utilisee ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                </div>
                                            </div>
                                        </div>


                                        <div id="produit_container">
                                        </div>

                                        <div class="flex mb-2 justify-between">
                                            <button style="background-color: #5555ff; color: white;" type="button" id="ajouter_produit" class="btn">+ Ajouter un produit</button>
                                            <label class="mr-8" for="coutProduit" id="coutProduit">Coût produits: ...</label>
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


    <!-- <div id="modifying_erea" class="hidden group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="mb-8"></div> 
                <div class="transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form id="formulaire_modif">
                                        <input class="hidden" type="text" name="vente_id" id="vente_id">
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="reference">Reference</label>
                                                <input required type="text" name="reference" id="reference_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="moyen_payement">Moyen payement </label>
                                                <select required id="moyen_payement_modif" name="moyen_payement" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="" disabled selected hidden>Choisissir ici...</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Virement bancaire">Virement bancaire</option>
                                                    <option value="Orange money">Orange money</option>
                                                    <option value="Moov money">Moov money</option>
                                                    <option value="MTN money">MTN money</option>
                                                    <option value="Wave">Wave</option>
                                                    <option value="Trasor money">Trasor money</option>
                                                </select>
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="status_vente">Status vente</label>
                                                <select required id="status_vente_modif" name="status_vente" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="" disabled selected hidden>Choisissir ici...</option>
                                                    <option value="En attente">En attente</option>
                                                    <option value="Conifimée">Conifimée</option>
                                                    <option value="Annulée">Annulée</option>
                                                </select>
                                            </div>
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
    </div> -->

    


    
   
    <script>

        function annulerModificationProduit(){
            document.getElementById('divModifyProduitOfProduction').classList.add('hidden');
            return;
        }
        
        function actualiser(){
            window.location.reload();
        }
        
        function modifyProduitOfProduction(){
            let trElement = event.target.closest('tr');
            var idProduit = trElement.getAttribute('data-id');
            var NbrPortions = trElement.getAttribute('data-nbr_portions');
            const modifyProductionForm = document.getElementById('modifyProduitOfProduction');
            modifyProductionForm.querySelector('input[name="nbr_portions"]').value = NbrPortions;
            modifyProductionForm.querySelector('input[name="idProduit"]').value = idProduit;
            document.getElementById('divModifyProduitOfProduction').classList.remove('hidden');
            submitModifyProduit(modifyProductionForm);
        }

        function submitModifyProduit(modifyProductionForm){
            modifyProductionForm.addEventListener('submit', function(event) {
                event.preventDefault();
                var data_to_modify = new FormData(modifyProductionForm);
                var request = new XMLHttpRequest();
                request.open('POST', '/edit_produit_of_production');
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
                            toastr.success('Quantité modifiée avec succès!', 'OK');
                            // document.getElementById('divModifyProduitOfProduction').classList.add('hidden');
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
                                    var inputField = modifyProductionForm.querySelector('[name="' + key + '"]');
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
        
        function handleNombrPortionInput(){
            $('#nbr_portions').on('input', function(){
                $('#vma').val($(this).val() * prixUnitaireProduit)
                marge = ($('#vma').val() != '' )  ? $('#vma').val() - coutTotal : 0.0;
                $('#marge').val(marge);
            });

            $('#vma').on('input', function(){
                $(this).val($('#nbr_portions').val() * prixUnitaireProduit)
            });
        }

        
        function addInputEventToSpecificInput(element){
            let timeId;
            $(element + ' .quantite_utilisee').on('input', function () {
                clearTimeout(timeId);
                const terme = $(this).val();
                
                var coutPartiel;
                var quantiteUtilisee = $('.quantite_utilisee');
                coutTotal = 0.0
                $.each(quantiteUtilisee, function(index, quantite){

                    if(quantite.value !=''){
                        const pua = $(element + ' .pua').val();
                        // const qte_stck_satic_apres_appro = ($(element + ' .qte_stck_satic_apres_appro').val() != '') ? $(element + ' .qte_stck_satic_apres_appro').val() : 1;
                        const nombre_pieces = ($(element + ' .nombre_pieces').val() != '') ? $(element + ' .nombre_pieces').val() : 1;
                        const nombre_portions = ($(element + ' .nombre_portions').val() != '') ? $(element + ' .nombre_portions').val() : 1;
                        coutPartiel = coutPortionUnitaire(pua, nombre_pieces, nombre_portions) * quantite.value;
                        coutTotal += coutPartiel;
                    }
                });

                $('#coutTotal').val(coutTotal);
                marge = ($('#vma').val() != '' )  ? $('#vma').val() - coutTotal : 0.0;
                $('#marge').val(marge);

            });


            
            const element_a_transformer_selecte = $(element + ' .element_a_transformer_selecte');
            element_a_transformer_selecte.on('change', function(){
                $.ajax({
                    url: "{{ route('render-product_properties_for_vente') }}",
                    method: 'GET',
                    data: { id_produit: $(this).val()[0]},
                    success: function(response) {
                        if(response){
                            if(response.produit_brut){
                                $(element + ' .element_a_transformer_input').val(response.produit_brut.produit.designation);
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
                                // $(element + ' .qte_stck_satic_apres_appro').val(response.produit_brut.qte_stck_satic_apres_appro);
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

            $(element + ' .element_a_transformer_input').on('input', function () {
                clearTimeout(timeId);
                const terme = $(this).val();
                timeId = setTimeout(function () {
                    $.ajax({
                        url: '/rechercher-lignes_system_produit',
                        method: 'GET',
                        data: { terme: terme},
                        success: function (response) {
                            if(response.produits_brut){
                                element_a_transformer_selecte.empty();
                                element_a_transformer_selecte.append('<option selected disabled value="">Choisir un produit ici...</option>');
                                    $.each(response.produits_brut, function(index, produit_brut){
                                        element_a_transformer_selecte.append(
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

            $('#coutTotal').on('input', function(){
                $(this).val(coutTotal);
            })

            $('#marge').on('input', function(){
                
                marge = ($('#vma').val() != '' )  ? $('#vma').val() - coutTotal : 0.0;
                $(this).val(marge);
            });

            let adding = document.getElementById('adding_erea')
            adding.classList.remove("hidden")    
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")
            let timerId;
            handleNombrPortionInput();
        }


    // function updateProduits(){
    //     $('.element_a_transformer_input').each(function () {
    //     })    
    //     const element_a_transformer_input = document.querySelectorAll('. element_a_transformer_input');
    //     const element_a_transformer_selecte = document.getElementById('element_a_transformer_selecte');
    //         let timeId;
    //         element_a_transformer_input.addEventListener('input', function(e) {
    //             clearTimeout(timeId);
    //             timeId = setTimeout(function() {
    //                 var inputValue = e.target.value;
    //                 $.ajax({
    //                     url: '/rechercher-clients-pour-vente',
    //                     method: 'GET',
    //                     data: { query: inputValue},
    //                     success: function(response) {
    //                         if(response.length > 0){
    //                             if(response.length == 1){
    //                                  .innerHTML = '<option disabled value="">1 résultat</option>';
    //                             }else{
    //                                 element_a_transformer_selecte.innerHTML = '<option disabled value="">'+ response.length +' résultats</option>';
    //                             }
    //                             response.forEach(function(mesClientTrouve) {
    //                                 element_a_transformer_selecte.innerHTML += `<option value="${mesClientTrouve.id}">${mesClientTrouve.client.nom} (${mesClientTrouve.client.email}) (${mesClientTrouve.client.phone}) (${mesClientTrouve.client.type})</option>`;
    //                             });
    //                         }else{
    //                             element_a_transformer_selecte.innerHTML = '<option disabled value="">Aucun client</option>';
    //                         }
    //                     },
    //                     error: function(xhr, status, error) {
    //                         console.error(error);
    //                     }
    //                 });
    //             }, 250);
    //         });
    // }




    
   
    function details_production(){
        let sells_table = document.getElementById('personnelTable');
        let details_table = document.getElementById('productionOverView');
        details_table.classList.remove("hidden")
        sells_table.classList.add("hidden")
        let trElement = event.target.closest('tr');
        var idProduction = trElement.getAttribute('data-id');
        const message = "Cette action est irreversible! Êtes-vous sûr de vouloir éffectuer la suppression ?"
        $.ajax({
            url: '/render-details-production',
            method: 'GET',
            data: { query: idProduction },
            success: function(response) {
                
                var produitsUtilises = response.produitsUtilises;
                if (produitsUtilises.length === 0) {
                    $('#aucunelement').removeClass('hidden');
                } else {
                    $('#aucunelement').addClass('hidden');
                }
                var tbody = $('#productionOverView tbody');
                tbody.empty();

                $.each(produitsUtilises, function(index, produitsUtilise) {
                    if (produitsUtilise.produit) {
                        const detach = 'produit.detach';
                        let url = '{{ route("produit.detach", [":idProduit", ":idProduction"]) }}'.replace(':idProduit', produitsUtilise.id).replace(':idProduction', idProduction);

                        var coutPartiel = coutPortionUnitaire(produitsUtilise.pua, produitsUtilise.nombre_pieces, produitsUtilise.nombre_portions) * produitsUtilise.pivot.quantite_utilisee;
                        coutPartiel = Math.round((coutPartiel + Number.EPSILON) * 100000) / 100000;
                        var row = '<tr data-id="' + produitsUtilise.pivot.id + '" data-nbr_portions="' + produitsUtilise.pivot.quantite_utilisee + '">' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + (index + 1) + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">' + produitsUtilise.produit.reference + '</a></td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsUtilise.produit.designation + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsUtilise.pua + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsUtilise.produit.format + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsUtilise.produit.type + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsUtilise.produit.calibrage + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsUtilise.produit.conditionnement + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + produitsUtilise.pivot.quantite_utilisee + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + coutPartiel + '</td>' +
                            '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' +
                                '<a onclick="modifyProduitOfProduction()" class="px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zinc-100 dark:hover:bg-zinc-500 dark:hover:text-zinc-200 dark:focus:bg-zinc-500 dark:focus:text-zinc-200"><i class="fas fa-edit inline-block size-3 ltr:mr-1 rtl:ml-1"></i></a>'+
                                '<a href="' + url + '" onclick="return confirm(\'' + message + '\')" class="px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zinc-100 dark:hover:bg-zinc-500 dark:hover:text-zinc-200 dark:focus:bg-zinc-500 dark:focus:text-zinc-200"><i class="fas fa-trash-alt inline-block size-3 ltr:mr-1 rtl:ml-1"></i></a>'+
                            '</td>' +
                            '</tr>';

                        tbody.append(row);
                    }
                });

                $('#productionOverView').removeClass('hidden');
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



        var formulaire_ajou = document.getElementById('formulaire_ajout');
        formulaire_ajou.addEventListener('submit', function(event) {
            event.preventDefault();


            $('.prix_vente').each(function() {
                $(this).prop('disabled', false);
            });
               var formData = new FormData(formulaire_ajou);
               var request = new XMLHttpRequest();
               request.open('POST', '/store_production');
               request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
               request.onreadystatechange = function() {
  
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {

                        var response = JSON.parse(request.responseText);
                        if(response.quantiteInsufisante){
                            toastr.warning('La qantité du produit ' + response.quantiteInsufisante +" est insuffisante!"); 
                            return;
                        }
                        var errorMessageElements = document.querySelectorAll('.error-message');
                        if(errorMessageElements.length > 0){
                            errorMessageElements.forEach(function(element) {
                                element.parentNode.removeChild(element);
                            });
                        }

                        if(response.duplicationDeProduit){
                            toastr.info('Le produit que vous essayez de definir semble exister! Veuillez le selectionner dans la liste.');
                            return;
                        }

                        toastr.success('Production ajoutée avec succès!');
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
                            toastr.error('Une erreur s\'est produite lors de la requête.', 'Erreur');
                        }
                    }
                }
    
            };
            request.send(formData);
            $('.prix_vente').each(function() {
                $(this).prop('disabled', true);
            });
        });

        // var formulaire_modif = document.getElementById('formulaire_modif');
        // formulaire_modif.addEventListener('submit', function(event) {
        //     event.preventDefault();
        //     var data_to_modify = new FormData(formulaire_modif);
        //     var request = new XMLHttpRequest();
        //     request.open('POST', '/edit_vente');
        //     request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        //     request.onreadystatechange = function() {
                
        //         if (request.readyState === XMLHttpRequest.DONE) {
        //             if (request.status === 200) {
        //                 var response = JSON.parse(request.responseText);
        //                 var errorMessageElements = document.querySelectorAll('.error-message');
        //                 if(errorMessageElements.length > 0){
        //                     errorMessageElements.forEach(function(element) {
        //                         element.parentNode.removeChild(element);
        //                     });
        //                 }

        //                 toastr.success('Vente modifiée avec succès!', 'OK');
        //                 // window.location.reload();
        //             }else if(request.status === 419){
        //                 toastr.error('Cette a expiré! Veuillez recharger la page pour continuer...', 'Erreur');
        //             }else {
        //                 var response = JSON.parse(request.responseText);
        //                 if (response.errors) {
        //                     var errorMessageElements = document.querySelectorAll('.error-message');
        //                     if(errorMessageElements.length > 0){
        //                         errorMessageElements.forEach(function(element) {
        //                             element.parentNode.removeChild(element);
        //                         });
        //                     }
        //                     var errors = response.errors;
        //                     Object.keys(errors).forEach(function(key) {
        //                         var inputField = formulaire_modif.querySelector('[name="' + key + '"]');
        //                         if (inputField) {
        //                             var errorElement = document.createElement('span');
        //                             errorElement.className = 'error-message text-red-500';
        //                             errorElement.textContent = errors[key][0];
        //                             inputField.parentNode.appendChild(errorElement);
        //                         }
        //                     });
        //                 } else {
        //                     toastr.error('Une erreur s\'est produite lors de la requête.', 'Erreur');
        //                 }
        //             }
        //         }
    
        //     };
        //     request.send(data_to_modify);
    
        // });




   
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
            addInputEventToProduitTransformeInput();
            function addInputEventToProduitTransformeInput(){
                let timeId;
                const element_a_transformer_selecte = $('#produit_transforme_select');
                $(document).ready(function() {
                    element_a_transformer_selecte.on('change', function() {
                        const idProduit = $(this).val();
                        $.ajax({
                            url: "{{ route('render-product_properties_for_vente_pt') }}",
                            method: 'GET',
                            data: {
                                idProduit: idProduit ? idProduit[0] : null,
                            },
                            success: function(response) {
                                if (response.produitTransforme) {
                                    
                                    var produitTransforme = response.produitTransforme;

                                    $('#produit_transforme_input').val(produitTransforme.designation);
                                    $('#reference').val(produitTransforme.reference);
                                    $('#designation').val(produitTransforme.designation);
                                    $('#portion_unitaire').val(produitTransforme.portion_unitaire);
                                    $('#prix_unitaire_portion').val(produitTransforme.prix_unitaire_portion);
                                    $('#qte_en_portions').val(produitTransforme.qte_en_portions);

                                    // $('#reference').attr('readonly', 'readonly');
                                    $('#designation').attr('readonly', 'readonly');
                                    $('#portion_unitaire').attr('readonly', 'readonly');
                                    $('#prix_unitaire_portion').attr('readonly', 'readonly');

                                    prixUnitaireProduit = produitTransforme.prix_unitaire_portion;
                                    
                                    $('#vma').val($('#nbr_portions').val() * prixUnitaireProduit);
                                    marge = ($('#vma').val() != '' )  ? $('#vma').val() - coutTotal : 0.0;
                                    

                                } else {
                                    toastr.error('Une erreur s\'est produite lors du rendu de traitement. Veuillez recommencer.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                                toastr.error('Erreur de connexion. Veuillez réessayer.');
                            }
                        });
                    });

                    $('#produit_transforme_input').on('input', function() {
                        $('#reference').val('');
                        $('#designation').val('');
                        $('#portion_unitaire').val('');
                        $('#prix_unitaire_portion').val('');
                        $('#qte_en_portions').val('');

                        // $('#reference').removeAttr('readonly');
                        $('#designation').removeAttr('readonly');
                        $('#portion_unitaire').removeAttr('readonly');
                        $('#prix_unitaire_portion').removeAttr('readonly');

                        clearTimeout(timeId);
                        const terme = $(this).val();
                        timeId = setTimeout(function () {
                            $.ajax({
                                url: '/rechercher-lignes_system_produit_pt',
                                method: 'GET',
                                data: { query: terme},
                                success: function (response) {
                                    if(response.produitsTransformes){
                                        element_a_transformer_selecte.empty();
                                        element_a_transformer_selecte.append('<option selected disabled value="">Choisir un produit ici...</option>');
                                        $.each(response.produitsTransformes, function(index, produitsTransformes){
                                            element_a_transformer_selecte.append(
                                                $('<option></option>').attr('value', produitsTransformes.id).text(produitsTransformes.designation + ' (' + produitsTransformes.reference + ')' + ' (' + produitsTransformes.prix_unitaire_portion + ' FCFA)' + ' (' + produitsTransformes.portion_unitaire + ')')
                                            );
                                        });
                                        return;
                                    }else if(response.other_error){

                                        toastr.error('Une erreur s\'est produite. Veuillez recommencer...'); return;
                                    }
                            },
                            error: function (xhr, status, error) {
                                toastr.error('Quelque chose a mal fonctioné! Veuillez recommencer...')
                                console.error(error);
                                return;
                            }
                        });
                    }, 250);
                });
            });
        }
    </script>   
@endsection