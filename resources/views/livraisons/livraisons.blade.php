@extends('layouts.master')
@section('content')

    <div id="displaying_erea" class=" group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Liste des produits en dépôt vente</h1>
            </div>
            <div class="col-span-12 card 2xl:col-span-12">
                <div class="card-body">
                    <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                        <div class="flex items-center">
                            <div class="2xl:col-span-3">
                                <h5 class="mr-2">Faire un dépôt vente</h5>
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
                                <button type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i class="align-baseline ltr:pr-1 rtl:pl-1 ri-upload-2-line"></i>Exporter</button>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table id="personnelTable" class=" w-full whitespace-nowrap">
                            <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
                                <tr>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        N°
                                    </th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reference</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Categorie</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Désignation</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Format</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Cnditmnt</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Q. E.</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Prix U. Achat</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Prix U. M. Vente</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">V. M. Q. E.</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Nom du client</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Type du client</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Image</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($livraisons as $livraison)
                                    @if (!$livraison->systemProduit or $livraison->produitTransforme)
                                        <tr
                                            data-id = "{{ $livraison->id}}"
                                            data-quantite_livree="{{ $livraison->quantite_livree }}"
                                            data-nom_client="{{ $livraison->ligneClientSysteme->client->nom}}"
                                            data-type_client="{{ $livraison->ligneClientSysteme->client->type}}"
                                            data-reference_produit="{{ $livraison->produitTransforme->reference }}"
                                            data-designation_produit="{{ $livraison->produitTransforme->designation }}"
                                            >
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{++$i}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">{{$livraison->produitTransforme->reference}}</a></td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{'Produit fini'}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->produitTransforme->designation}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">...</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">...</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->quantite_livree}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">...</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->produitTransforme->prix_unitaire_portion}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->produitTransforme->prix_unitaire_portion * $livraison->quantite_livree}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->ligneClientSysteme->client->nom}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->ligneClientSysteme->client->type}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">...</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                <div class="relative dropdown">
                                                    <button id="orderAction1" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20 w-20"><i data-lucide="more-horizontal" class="size-4"></i></button>
                                                    <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction1">
                                                        <li>
                                                            <a class="flex px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="{{ route('livraison.annuler', ['id' => $livraison->id]) }}" onclick="return confirm('Annuler vraiment cette livraison?')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                                </svg>
                                                                <span class="align-middle">Annuler</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button type="button" onclick="modifier()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Modifier</span></button>
                                                        </li>
                                                        <li>
                                                            <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="{{ route('livraison.delete', ['id' => $livraison->id]) }}" onclick="return confirm('Cette action est irreversible! Êtes-vous sûr de vouloir supprimer cet element ?')"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Supprimer</span></a> 
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        <tr
                                            data-id = "{{ $livraison->id}}"
                                            data-quantite_livree="{{ $livraison->quantite_livree }}"
                                            data-nom_client="{{ $livraison->ligneClientSysteme->client->nom}}"
                                            data-type_client="{{ $livraison->ligneClientSysteme->client->type}}"
                                            data-reference_produit="{{ $livraison->systemProduit->produit->reference }}"
                                            data-designation_produit="{{ $livraison->systemProduit->produit->designation }}"
                                            >
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{++$i}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">{{$livraison->systemProduit->produit->reference}}</a></td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->systemProduit->produit->categorie->nom}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->systemProduit->produit->designation}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->systemProduit->produit->format}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->systemProduit->produit->conditionnement}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->quantite_livree}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->systemProduit->pua}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->systemProduit->puv}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->systemProduit->puv * $livraison->quantite_livree}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->ligneClientSysteme->client->nom}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->ligneClientSysteme->client->type}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                @if ($livraison->systemProduit->produit->image)
                                                    <img class="w-10 h-10 rounded" src="{{ asset('storage/' . $livraison->systemProduit->produit->image) }}" alt="Default avatar">
                                                @else
                                                <div class="relative w-10 h-10 flex items-center justify-center overflow-hidden bg-yellow-500 rounded-full dark:bg-yellow-600">
                                                    <svg class="absolute w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" style="left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                                        <path fill-rule="evenodd" d="M14 4.414V3a1 1 0 00-1-1H7a1 1 0 00-1 1v1.414L4.707 6.707A1 1 0 004 7v8a2 2 0 002 2h8a2 2 0 002-2V7a1 1 0 00-.707-1.293L14 4.414zM8 4h4v2H8V4zm4 11H8v-1h4v1zm-1-4a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                                
                                                                                        
                                                @endif
                                            </td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                <div class="relative dropdown">
                                                    <button id="orderAction1" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20 w-20"><i data-lucide="more-horizontal" class="size-4"></i></button>
                                                    <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction1">
                                                        <li>
                                                            <a class="flex px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="{{ route('livraison.annuler', ['id' => $livraison->id]) }}" onclick="return confirm('Annuler vraiment cette livraison?')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                                </svg>
                                                                <span class="align-middle">Annuler</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button type="button" onclick="modifier()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Modifier</span></button>
                                                        </li>
                                                        <li>
                                                            <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="{{ route('livraison.delete', ['id' => $livraison->id]) }}" onclick="return confirm('Cette action est irreversible! Êtes-vous sûr de vouloir supprimer cet element ?')"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Supprimer</span></a> 
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach 
                                
                                @if($i == 0)
                                    <div id="aucuncontrat" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <strong class="font-bold">Vide!</strong>
                                        <span class="block sm:inline">Aucune livraison active .</span>
                                    </div>
                                @endif                                
                            </tbody>
                        </table>
                    </div>


                    {{--Debut A revoir --}}
                    {{-- <div  class="hidden overflow-x-auto">
                        <table id="personnelTable2" class=" w-full whitespace-nowrap">
                            <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
                                <tr>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        N°
                                    </th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reference</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Désignation</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Q. E.</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Prix U. M. Vente</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">V. M. Q. E.</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Nom du client</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Type du client</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($livraisons as $livraison)
                                    @if ($livraison->systemProduit or !$livraison->produitTransforme)
                                        @continue
                                    @endif
                                    <tr
                                        data-id = "{{ $livraison->id}}"
                                        data-quantite_livree="{{ $livraison->quantite_livree }}"
                                        data-nom_client="{{ $livraison->ligneClientSysteme->client->nom}}"
                                        data-type_client="{{ $livraison->ligneClientSysteme->client->type}}"
                                        data-reference_produit="{{ $livraison->produitTransforme->reference }}"
                                        data-designation_produit="{{ $livraison->produitTransforme->designation }}"
                                        >
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{++$i}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">{{$livraison->produitTransforme->reference}}</a></td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->produitTransforme->designation}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->quantite_livree}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->produitTransforme->prix_unitaire_portion}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->produitTransforme->prix_unitaire_portion * $livraison->quantite_livree}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->ligneClientSysteme->client->nom}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$livraison->ligneClientSysteme->client->type}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                            <div class="relative dropdown">
                                                <button id="orderAction1" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20 w-20"><i data-lucide="more-horizontal" class="size-4"></i></button>
                                                <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction1">
                                                    
                                                    <li>
                                                        <a class="flex px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="{{ route('livraison.annuler', ['id' => $livraison->id]) }}" onclick="return confirm('Annuler vraiment cette livraison?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                            </svg>
                                                            <span class="align-middle">Annuler</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <button type="button" onclick="modifier()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Modifier</span></button>
                                                    </li>
                                                    <li>
                                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="{{ route('livraison.delete', ['id' => $livraison->id]) }}" onclick="return confirm('Cette action est irreversible! Êtes-vous sûr de vouloir supprimer cet element ?')"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Supprimer</span></a> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        </tr>
                                @endforeach 
                                @if($i == 0)
                                    <div id="aucuncontrat" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <strong class="font-bold">Vide!</strong>
                                        <span class="block sm:inline">Aucune livraison de produit transfomé active</span>
                                    </div>
                                @endif                                
                            </tbody>
                        </table>
                    </div> --}}
                    {{-- Fin A revoir --}}
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
                                                <label for="type_de_produits">Type de produits</label>
                                                <select id="type_de_produits_add" name="type_de_produits" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="default" disabled selected>Choisissez le type de produits</option>
                                                    <option value="Produit transformé">Produit transformé</option>
                                                    <option value="Produit non transformé">Produit non transformé</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <input type="text" id="produitsInput2" name="produit" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Recherchez un produit par designation, reference...">
                                                <select multiple id="produitsSelect2" name="produitsSelect2" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option disabled>Les produits s'affichent ici...</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="reference">Reference</label>
                                                <input disabled type="text" name="reference" id="reference_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="designation">Désignation</label>
                                                <input type="text" name="designation" id="designation_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                           
                                            <div class="col mr-2 w-full">
                                                <label for="conditionnement">Conditionnement</label>
                                                <input type="text" name="conditionnement" id="conditionnement_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="format">Format </label>
                                                <input type="text" name="format" id="format_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full" style = "display:none">
                                                <label for="portion_unitaire">Portion unitaire </label>
                                                <input type="text" name="portion_unitaire" id="portion_unitaire_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full" style = "display:none">
                                                <label for="prix_portion_unitaire">Prix Portion u. </label>
                                                <input type="text" name="prix_portion_unitaire" id="prix_portion_unitaire_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="calibrage">Particularité</label>
                                                <input type="text" id="calibrage" name="calibrage" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="format">Origine</label>
                                                <select id="type_produit" name="type_produit" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="" disabled selected hidden>Choisissez une origine</option>
                                                    <option value="Importé">Importé</option>
                                                    <option value="Locale">Locale</option>
                                                </select>
                                            </div>

                                        </div>


                                        
                                        <div class="flex mb-2">
                                            {{-- <div class="col mr-2 w-full">
                                                <label for="qte_stck">Stock initial</label>
                                                <input required type="number" name="qte_stck" id="qte_stck_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div> --}}

                                            <div class="col mr-2 w-full">
                                                <label for="pua">P.U.A</label>
                                                <input type="number" name="pua" id="pua_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="puv">P.U.M.V</label>
                                                <input type="number" name="puv" id="puv_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div> 
                                            
                                            <div class="col mr-2 w-full" style = "display:none">
                                                <label for="qte_en_portions">Qté en stock</label>
                                                <input type="number" name="qte_en_portions" id="qte_en_portions_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            
                                            <div class="col mr-2 w-full">
                                                <label for="puv">Quantité à livrer</label>
                                                <input required type="number" step="any" name="quantite_livree" id="quantite_livree_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center mb-2">
                                            <h3 class="mx-auto"><strong>Client</strong></h3>
                                        </div>
                                        
                                       
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <input type="text" id="clientInput_id" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Recherchez un client par nom, téléphone, email...">
                                                <select multiple value="" id="clientSelected_id" name="clientSelect2" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option selected disabled>Rechercher le client</option>
                                                    @foreach ($clients as $cl)
                                                        <option value={{"$cl->id"}}>Nom: {{$cl->client->nom}}, Phone: {{$cl->client->phone}}, Email: {{$cl->client->email}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="type">Type</label>
                                                <select required id="type_add" name="type" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="Choisissez un type" disabled selected hidden>Choisissez un type</option>
                                                    <option value="Entreprise">Entreprise</option>
                                                    <option value="Particulier">Particulier</option>
                                                </select>
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="nom">Nom</label>
                                                <input required type="text" name="nom" id="nom_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="adresse">Adresse </label>
                                                <input required type="text" name="adresse" id="adresse_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="email">Email</label>
                                                <input required type="text" name="email" id="email_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>


                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="phone">Téléphone 1</label>
                                                <input required type="tel" name="phone" id="phone_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="seconde_phone">Téléphone 2</label>
                                                <input type="tel" name="seconde_phone" id="seconde_phone_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="pays">Pays</label>
                                                <input required type="text" name="pays" id="pays_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>

                                        <div class="flex mb-2">

                                            <div class="col mr-2 w-full">
                                                <label for="region">Region</label>
                                                <input  type="text" id="region_add" name="region" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Photo..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="departement">Departement</label>
                                                <input required type="tel" name="departement" id="departement_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="localite">Localité</label>
                                                <input required type="text" name="localite" id="localite_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
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





    <div id="modify_produit" class="hidden group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="mb-8"></div> 
                <div class="transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form id="formulaire_modif">
                                       <input type="number" name="id_livraison" class="hidden">
                                       
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="reference">Reference</label>
                                                <input required disabled type="text" name="reference_produit" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="designation">Désignation</label>
                                                <input required type="text" disabled name="designation_produit" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>
                                       
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="nom">Nom du client</label>
                                                <input required type="text" disabled name="nom_client" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="type">Type de client</label>
                                                <select required disabled name="type_client" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="Choisissez un type" disabled selected hidden>Choisissez un type</option>
                                                    <option value="Entreprise">Entreprise</option>
                                                    <option value="Particulier">Particulier</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="puv">Quantité livrée</label>
                                                <input type="number" min="1" name="quantite_livree" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
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
        function ableDisable(boolValue, value1, value2, value3, value4, value5, value6, value7, value8, value9, value10){
            type =  document.getElementById('type_add')
            if(typeof value1 != 'undefined'){
                type.value = value1;
            }
            type.disabled = boolValue;

            nom = document.getElementById('nom_add')
           
            if(typeof value2 != 'undefined'){
                nom.value = value2;
            }
            nom.disabled = boolValue;

            adresse =  document.getElementById('adresse_add')
            if(typeof value3 != 'undefined'){
                adresse.value = value3;
            }
            adresse.disabled = boolValue;

            email =  document.getElementById('email_add')
            if(typeof value4 != 'undefined'){
                email.value = value4;
            }
            email.disabled = boolValue;

            phone =  document.getElementById('phone_add')
            if(typeof value5 != 'undefined'){
                phone.value = value5;
            }
            phone.disabled = boolValue;

            seconde_phone =  document.getElementById('seconde_phone_add')
            if(typeof value6 != 'undefined'){
                seconde_phone.value = value6;
            }
            seconde_phone.disabled = boolValue;

            region =  document.getElementById('region_add')
            if(typeof value7 != 'undefined'){
                region.value = value7;
            }
            region.disabled = boolValue;

            departement =  document.getElementById('departement_add')
            if(typeof value8 != 'undefined'){
                departement.value = value8;
            }
            departement.disabled = boolValue;

            localite =  document.getElementById('localite_add')
            if(typeof value9 != 'undefined'){
                localite.value = value9;
            }
            localite.disabled = boolValue;

            pays =  document.getElementById('pays_add')
            if(typeof value10 != 'undefined'){
                pays.value = value10;
            }
            pays.disabled = boolValue;
        }


        function client_on_change(){
            clientSelected_id.addEventListener('change', function() {
                clientInput_id.value = clientSelected_id.options[clientSelected_id.selectedIndex].text;
                $.ajax({
                    url: '/render-client_for_livraison',
                    method: 'GET',
                    data: { query: this.value },
                    success: function(response) {
                        if(response){
                            ableDisable(true, response.client.type, response.client.nom, response.client.adresse, response.client.email, response.client.phone, response.client.seconde_phone, response.client.region, response.client.departement, response.client.localite, response.client.pays);
                        }else{
                            clientSelected_id.innerHTML = '<option disabled value="">0 résultat</option>';
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        }


        function update_clients(){
            const clientInput_id = document.getElementById('clientInput_id');
            const clientSelected_id = document.getElementById('clientSelected_id');
            let timeId;
            clientInput_id.addEventListener('input', function(e) {
                clearTimeout(timeId);
                timeId = setTimeout(function() {
                    var inputValue = e.target.value;
                    $.ajax({
                        url: '/rechercher-clients_for_livraison',
                        method: 'GET',
                        data: { query: inputValue},
                        success: function(response) {
                            if(response.length > 0){
                                if(response.length == 1){
                                    clientSelected_id.innerHTML = '<option disabled value="">1 résultat</option>';
                                }else{
                                    clientSelected_id.innerHTML = '<option disabled value="">'+ response.length +' résultats</option>';
                                }
                                response.forEach(function(clientTrouve) {
                                    clientSelected_id.innerHTML += `<option value="${clientTrouve.id}">Nom: ${clientTrouve.client.nom}, Phone: ${clientTrouve.client.phone}, Email: ${clientTrouve.client.email}</option>`;
                                });
                            }else{
                                clientSelected_id.innerHTML = '<option disabled value="">0 résultat</option>';
                                ableDisable(false,'Choisissez un type','','','','','','','','','');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }, 250);
            });
        }

        function produit_on_change(){
                produitsSelect2.addEventListener('change', function() {
                // produitsInput2.value = '';
                produitsInput2.value = produitsSelect2.options[produitsSelect2.selectedIndex].text;
                const type_de_produits = document.getElementById('type_de_produits_add').value;
                $.ajax({
                    url: '/render-produit_properties_for_livraison',
                    method: 'GET',
                    data: { query: this.value, type_produit : type_de_produits },
                    success: function(response) {
                        if(response.produit_brut){
                            reference =  document.getElementById('reference_add')
                            reference.value = response.produit_brut.produit.reference;
                            reference.disabled = true;

                            designation =  document.getElementById('designation_add')
                            designation.value = response.produit_brut.produit.designation;
                            designation.disabled = true;

                            document.getElementById('portion_unitaire_add').style.display = 'none';
                            document.getElementById('prix_portion_unitaire_add').style.display = 'none';
                            
                            format =  document.getElementById('format_add');
                            format.parentNode.style.display = '';
                            format.value = response.produit_brut.produit.format;
                            format.disabled = true;

                            type_produit =  document.getElementById('type_produit')
                            type_produit.parentNode.style.display = '';

                            type_produit.value = response.produit_brut.produit.type;
                            type_produit.disabled = true;

                            conditionnement =  document.getElementById('conditionnement_add')
                            conditionnement.parentNode.style.display = '';

                            conditionnement.value = response.produit_brut.produit.conditionnement;
                            conditionnement.disabled = true;
                            

                            document.getElementById('portion_unitaire_add').parentNode.style.display = 'none';
                            document.getElementById('prix_portion_unitaire_add').parentNode.style.display = 'none';
                            document.getElementById('qte_en_portions_add').parentNode.style.display = 'none';
                                        
                            calibrage =  document.getElementById('calibrage')
                            calibrage.parentNode.style.display = '';
                            calibrage.value = response.produit_brut.produit.calibrage;
                            calibrage.disabled = true;

                            pua_add =  document.getElementById('pua_add')
                            pua_add.parentNode.style.display = '';
                            pua_add.value = response.produit_brut.pua;
                            pua_add.disabled = true;

                            puv_add =  document.getElementById('puv_add')
                            puv_add.parentNode.style.display = '';
                            puv_add.value = response.produit_brut.puv;
                            puv_add.disabled = true;
                        }else if(response.produit_transforme){
                            reference =  document.getElementById('reference_add')
                            reference.value = response.produit_transforme.reference;
                            reference.disabled = true;

                            designation =  document.getElementById('designation_add')
                            designation.value = response.produit_transforme.designation;
                            designation.disabled = true;

                            portion_unitaire =  document.getElementById('portion_unitaire_add');
                            portion_unitaire.parentNode.style.display = '';
                            portion_unitaire.value = response.produit_transforme.portion_unitaire;
                            portion_unitaire.disabled = true;
                            
                            prix_portion_unitaire =  document.getElementById('prix_portion_unitaire_add');
                            prix_portion_unitaire.parentNode.style.display = '';
                            prix_portion_unitaire.value = response.produit_transforme.prix_unitaire_portion;
                            prix_portion_unitaire.disabled = true;
                            
                            qte_en_portions =  document.getElementById('qte_en_portions_add');
                            qte_en_portions.parentNode.style.display = '';
                            qte_en_portions.value = response.produit_transforme.qte_en_portions;
                            qte_en_portions.disabled = true;

                            format =  document.getElementById('format_add').parentNode.style.display = 'none';
                            
                            type_produit =  document.getElementById('type_produit').parentNode.style.display = 'none';
                            
                            conditionnement =  document.getElementById('conditionnement_add').parentNode.style.display = 'none';
                            
                            calibrage =  document.getElementById('calibrage').parentNode.style.display = 'none';
                            
                            pua_add =  document.getElementById('pua_add').parentNode.style.display = 'none';
                            
                            puv_add =  document.getElementById('puv_add').parentNode.style.display = 'none';
                           
                        }else{
                            produitsSelect2.innerHTML = '<option disabled value="">0 résultat</option>';
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        }


        function ajouter(){
            let adding = document.getElementById('adding_erea')
            adding.classList.remove("hidden")    
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")
            const produitsInput2 = document.getElementById('produitsInput2');
            const produitsSelect2 = document.getElementById('produitsSelect2');
            const clientSelected_id = document.getElementById('clientSelected_id');
            let timerId;
            // update_produits();
            client_on_change();
            update_clients();
            produit_on_change();
            charger_elements_de_vente();
        }


    
        
        let timeId;
        $('#produitsInput2').on('input', function () {
            clearTimeout(timeId);
            const type_de_produits = document.getElementById('type_de_produits_add').value;
            const produitsSelect2 = document.getElementById('produitsSelect2');
            const terme = $(this).val();
            var link;
            if(type_de_produits == "Produit non transformé"){
                link =  '/rechercher-lignes_system_produit';
            }else if(type_de_produits == "Produit transformé"){
                link =  '/rechercher-lignes_system_produit_pt';
            }else if (type_de_produits == "default"){
                return toastr.info('Vous devez selectionner un type de produit');
            }

            timeId = setTimeout(function () {
                $.ajax({
                    url: link,
                    method: 'GET',
                    data: { query: terme },
                    success: function (response) {
                        if(response.produits_brut){
                            if(response.produits_brut.length > 0){
                                if(response.produits_brut.length == 1){
                                    produitsSelect2.innerHTML = '<option disabled value="">1 résultat</option>';
                                }else{
                                    produitsSelect2.innerHTML = '<option disabled value="">'+ response.produits_brut.length +' résultats</option>';
                                }
                                response.produits_brut.forEach(function(produit) {
                                    produitsSelect2.innerHTML += `<option value="${produit.id}">${produit.produit.designation} (${produit.produit.reference}) (${produit.produit.format}) (${produit.puv} FCFA ) </option>`;
                                });
                            }else{
                                produitsSelect2.innerHTML = '<option disabled value="">0 résultat</option>';
                                reference =  document.getElementById('reference_add')
                                reference.value = '';
                                // reference.disabled = false;

                                designation =  document.getElementById('designation_add')
                                designation.value = '';
                                // designation.disabled = false;

                                format =  document.getElementById('format_add')
                                format.value = '';
                                // format.disabled = false;

                                type_produit =  document.getElementById('type_produit')
                                type_produit.value = '';
                                // type_produit.disabled = false;

                                conditionnement =  document.getElementById('conditionnement_add')
                                conditionnement.value = '';
                                // conditionnement.disabled = false;

                                calibrage =  document.getElementById('calibrage')
                                calibrage.value = '';
                                // calibrage.disabled = false;
                            }
                            return;
                        }else if(response.produitsTransformes){
                            if(response.produitsTransformes.length > 0){
                                    if(response.produitsTransformes.length == 1){
                                        produitsSelect2.innerHTML = '<option disabled value="">1 résultat</option>';
                                    }else{
                                        produitsSelect2.innerHTML = '<option disabled value="">'+ response.produitsTransformes.length +' résultats</option>';
                                    }
                                    response.produitsTransformes.forEach(function(produit) {
                                        produitsSelect2.innerHTML += `<option value="${produit.id}">${produit.designation} (${produit.reference}) (${produit.portion_unitaire}) (${produit.prix_unitaire_portion } FCFA )</option>`;
                                    });
                                }else{
                                    produitsSelect2.innerHTML = '<option disabled value="">0 résultat</option>';
                                    reference =  document.getElementById('reference_add')
                                    reference.value = '';
                                    // reference.disabled = false;

                                    designation =  document.getElementById('designation_add')
                                    designation.value = '';
                                    designation.disabled = false;

                                    format =  document.getElementById('format_add')
                                    format.value = '';
                                    // format.disabled = false;

                                    type_produit =  document.getElementById('type_produit')
                                    type_produit.value = '';
                                    // type_produit.disabled = false;

                                    conditionnement =  document.getElementById('conditionnement_add')
                                    conditionnement.value = '';
                                    // conditionnement.disabled = false;

                                    calibrage =  document.getElementById('calibrage')
                                    calibrage.value = '';
                                    // calibrage.disabled = false;

                                }
                            return;
                        }
                        else if(response.type_error){
                            toastr.error('Le type de produits n\'est pas pris en charge.'); return;
                        }else if(response.other_error){
                            toastr.error('Une erreur s\'est produite. Veuillez recommencer.'); return;
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        return;
                    }
                });
            }, 250);
        });


       
        function update_produits(){
            $('#produitsInput2').on('input', function () {
            clearTimeout(timeId);
            const type_de_produits = document.getElementById('type_de_produits_add').value;
            const produitsSelect2 = document.getElementById('produitsSelect2');
            const terme = $(this).val();
            timeId = setTimeout(function () {
                $.ajax({
                    url: '/rechercher-lignes_system_produit',
                    method: 'GET',
                    data: { query: terme, type_produits : type_de_produits },
                    success: function (response) {
                        if(response.produits_brut){
                            if(response.length > 0){
                                if(response.length == 1){
                                    produitsSelect2.innerHTML = '<option disabled value="">1 résultat</option>';
                                }else{
                                    produitsSelect2.innerHTML = '<option disabled value="">'+ response.length +' résultats</option>';
                                }
                                response.forEach(function(produit) {
                                    produitsSelect2.innerHTML += `<option value="${produit.id}">${produit.produit.designation}</option>`;
                                });
                            }else{
                                produitsSelect2.innerHTML = '<option disabled value="">0 résultat</option>';
                                reference =  document.getElementById('reference_add')
                                reference.value = '';
                                // reference.disabled = false;

                                designation =  document.getElementById('designation_add')
                                designation.value = '';
                                // designation.disabled = false;

                                format =  document.getElementById('format_add')
                                format.value = '';
                                // format.disabled = false;

                                type_produit =  document.getElementById('type_produit')
                                type_produit.value = '';
                                // type_produit.disabled = false;

                                conditionnement =  document.getElementById('conditionnement_add')
                                conditionnement.value = '';
                                // conditionnement.disabled = false;

                                calibrage =  document.getElementById('calibrage')
                                calibrage.value = '';
                                // calibrage.disabled = false;
                            }
                            return;
                        }else if(response.produits_transformes){
                            if(response.length > 0){
                                    if(response.length == 1){
                                        produitsSelect2.innerHTML = '<option disabled value="">1 résultat</option>';
                                    }else{
                                        produitsSelect2.innerHTML = '<option disabled value="">'+ response.length +' résultats</option>';
                                    }
                                    response.forEach(function(produit) {
                                        produitsSelect2.innerHTML += `<option value="${produit.id}">${produits_transforme.designation} (${produits_transforme.reference}) (${produits_transforme.portion_unitaire}) (${produits_transforme.prix_unitaire_portion } FCFA</option>`;
                                    });
                                }else{
                                    produitsSelect2.innerHTML = '<option disabled value="">0 résultat</option>';
                                    reference =  document.getElementById('reference_add')
                                    reference.value = '';
                                    // reference.disabled = false;

                                    designation =  document.getElementById('designation_add')
                                    designation.value = '';
                                    designation.disabled = false;

                                    format =  document.getElementById('format_add')
                                    format.value = '';
                                    // format.disabled = false;

                                    type_produit =  document.getElementById('type_produit')
                                    type_produit.value = '';
                                    // type_produit.disabled = false;

                                    conditionnement =  document.getElementById('conditionnement_add')
                                    conditionnement.value = '';
                                    // conditionnement.disabled = false;

                                    calibrage =  document.getElementById('calibrage')
                                    calibrage.value = '';
                                    // calibrage.disabled = false;

                                }
                            return;
                        }
                        else if(response.type_error){
                            toastr.error('Le type de produits n\'est pas pris en charge.'); return;
                        }else if(response.other_error){
                            toastr.error('Une erreur s\'est produite. Veuillez recommencer.'); return;
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

        function modifier(){
            let adding = document.getElementById('modify_produit')
            adding.classList.remove("hidden")    
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")
            let trElement = event.target.closest('tr');
    

            const id_livraison = trElement.getAttribute('data-id');
            const quantite_livree = trElement.getAttribute('data-quantite_livree');
            const nom_client = trElement.getAttribute('data-nom_client');
            const type_client = trElement.getAttribute('data-type_client');
            const reference_produit = trElement.getAttribute('data-reference_produit');
            const designation_produit = trElement.getAttribute('data-designation_produit');

            const formulaire = document.getElementById('formulaire_modif');
            formulaire.querySelector('input[name="id_livraison"]').value = id_livraison ;
            formulaire.querySelector('input[name="quantite_livree"]').value = quantite_livree ;
            formulaire.querySelector('input[name="nom_client"]').value = nom_client;
            formulaire.querySelector('select[name="type_client"]').value = type_client;
            formulaire.querySelector('input[name="reference_produit"]').value = reference_produit;
            formulaire.querySelector('input[name="designation_produit"]').value = designation_produit;
        }
    
        
    
    
       
        
        
        // document.getElementById('matricule').addEventListener('change', function (){
        //     const id = this.value;
        //     var input_peronnel = document.getElementById("id_personnel");
        //     input_peronnel.value = id;
        //     if(id){
        //         var request = new XMLHttpRequest();
        //         request.open('GET', '/display_personnel_for_contrat/' + id);
        //         request.onreadystatechange = function() {
        //             if (request.readyState === XMLHttpRequest.DONE) {
        //                 if (request.status === 200) {
        //                     const response = JSON.parse(request.responseText);
        //                     document.querySelector('input[name="nom"]').value = response.nom;
        //                     document.querySelector('input[name="prenom"]').value = response.prenom;
        //                     document.querySelector('input[name="tel"]').value = response.tel;
        //                     document.querySelector('input[name="date_de_naissance"]').value = response.date_de_naissance;
        //                     document.querySelector('input[name="lieu_de_naissance"]').value = response.lieu_de_naissance;
        //                     document.querySelector('input[name="date_recrutement"]').value = response.date_recrutement;
        //                     document.querySelector('input[name="titre_poste"]').value = response.titre_poste;
        //                     document.querySelector('input[name="num_cnps"]').value = response.num_cnps;
        //                 } else {
        //                     console.error('Une erreur s\'est produite lors de la requête.');
        //                 }
        //             }
        //         };
        //         request.send();
        //     }
        // })

        var formulaire_ajou = document.getElementById('formulaire_ajout');
        formulaire_ajou.addEventListener('submit', function(event) {

            event.preventDefault();
            reference =  document.getElementById('reference_add')
            reference.disabled = false;
            designation =  document.getElementById('designation_add')
            designation.disabled = false;
            format =  document.getElementById('format_add')
            format.disabled = false;
            type_produit =  document.getElementById('type_produit')
            type_produit.disabled = false;
            conditionnement =  document.getElementById('conditionnement_add')
            conditionnement.disabled = false;
            calibrage =  document.getElementById('calibrage')
            calibrage.disabled = false;

            pua_add =  document.getElementById('pua_add')
            pua_add.disabled = false;

            puv_add =  document.getElementById('puv_add')
            puv_add.disabled = false;

               var formData = new FormData(formulaire_ajou);
             
               var request = new XMLHttpRequest();
               request.open('POST', '/store_livraison');
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
                        
                        if(response.quantiteInsuffisante){
                            toastr.info('Stock insuffisant pour éffectuer cette livraison!');
                            return;
                        }
                        if (response.errors) {
                            var errors = response.errors;
                            Object.keys(errors).forEach(function(key) {
                                var inputField = document.querySelector('[name="' + key + '"]');
                                if (inputField) {
                                    var errorElement = document.createElement('span');
                                    errorElement.className = 'error-message text-red-500';
                                    errorElement.textContent = errors[key][0];
                                    inputField.parentNode.appendChild(errorElement);
                                }
                            });
                        } else {
                            toastr.success(JSON.parse(request.responseText).message);
                        }
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
                                var inputField = document.querySelector('[name="' + key + '"]');
                                if (inputField) {
                                    var errorElement = document.createElement('span');
                                    errorElement.className = 'error-message text-red-500';
                                    errorElement.textContent = errors[key][0];
                                    inputField.parentNode.appendChild(errorElement);
                                }
                                reference.disabled = true;
                            });
                        } else {
                            toastr.error('Une erreur s\'est produite lors de la requête.', 'Erreur');
                            reference.disabled = true;
                        }
                    }
                }
    
               };
               request.send(formData);
               reference.disabled = true;
        });
      
    
        var formulaire_modif = document.getElementById('formulaire_modif');
        formulaire_modif.addEventListener('submit', function(event) {
            event.preventDefault();
            var data_to_modify = new FormData(formulaire_modif);
            var request = new XMLHttpRequest();
            request.open('POST', '/edit_livraison');
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
                        toastr.success('Modification reussie!');
                        window.location.reload();
                    }else if(request.status === 419){
                        toastr.error('Cette a expiré! Veuillez recharger la page pour continuer...', 'Erreur');
                    }else {
                        var response = JSON.parse(request.responseText);
                        if (response.errors) {
                            alert()
                            var errorMessageElements = document.querySelectorAll('.error-message');
                            if(errorMessageElements.length > 0){
                                errorMessageElements.forEach(function(element) {
                                    element.parentNode.removeChild(element);
                                });
                            }
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

        function charger_elements_de_vente(){
            document.getElementById('type_de_produits_add').addEventListener('change', function(){
                $('#produitsInput2').val('');
                $.ajax({
                        url: '/render-element-a-livrer',
                        method: 'GET',
                        data: { type_produit: this.value },
                        success: function(response) {
                                var select = $('#produitsSelect2');
                                if(response.produits_brut){
                                    select.empty();
                                    select.append('<option selected disabled value="">Choisir un produit ici...</option>');
                                    $.each(response.produits_brut, function(index, produit_brut){
                                        select.append(
                                            $('<option></option>').attr('value', produit_brut.id).text(produit_brut.produit.designation + ' (' + produit_brut.produit.reference + ')' + ' (' + produit_brut.pua + ' FCFA)'+ ' (' + produit_brut.puv + ' FCFA)'+ ' (' + produit_brut.portion + ')'+ ' (' + produit_brut.nombre_portions + ')')
                                        );
                                    })
                                }else if(response.produits_transformes){
                                    select.empty();
                                    select.append('<option selected disabled value="">Choisir un produit ici...</option>');
                                    $.each(response.produits_transformes, function(index, produits_transforme){
                                        select.append(
                                            $('<option></option>').attr('value', produits_transforme.id).text(produits_transforme.designation + ' (' + produits_transforme.reference + ')' + ' (' + produits_transforme.portion_unitaire + ')'+ ' (' + produits_transforme.nombre_portions_prevues + ')'+ ' (' + produits_transforme.prix_unitaire_portion + ' FCFA)')
                                        );
                                    })
                                }else if(response.services){
                                    select.empty();
                                    select.append('<option selected disabled value="">Choisir un service ici...</option>');
                                    $.each(response.services, function(index, service){
                                        select.append(
                                            $('<option></option>').attr('value', service.id).text(service.designation + ' (' + service.reference + ')' +' (' + service.prix_unitaire + ' FCFA)')
                                        );
                                    })
                                }else if(response.type_error){
                                    toastr.error('Ce type est non pris en charge.')
                                }else if(response.other_error){
                                    toastr.error('Un erreur s\'est produite.')
                                }
                         
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            })
        }
          



    </script>
@endsection