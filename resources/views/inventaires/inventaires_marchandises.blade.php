@extends('layouts.master')
@section('content')

    <div id="displaying_erea" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex justify-center items-center mb-2 mt-2">
            <h1 class="flex justify-center items-center text-black text-5xl">Inventaire de stock</h1>
        </div>     
        <div class="col-span-12 card 2xl:col-span-12">
                <div class="card-body">
                    <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                        <div class="flex items-center">
                            <div class="2xl:col-span-3">
                                <h5 class="mr-2">Faire un inventaire</h5>
                            </div>
                            <button onclick="ajouter()" class="inline-block rounded-full bg-white transition-all duration-300 ease-in-out hover:bg-gray-400 active:bg-gray-500">
                                <i id="btn_ajouter" class="align-baseline ltr:pr-1 rtl:pl-1 ri-add-line text-lg text-black"></i>
                            </button>
                            <a href="#" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
                                <i data-lucide="clipboard" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                <span class="align-middle">Inventaires</span>
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
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Qté théorique</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Prix unitaire</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Valeur théorique</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Qté physique</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Valeur physique</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Ecart stock</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Valeur écart</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($inventaires as $inventaire)
                                   
                                    <tr
                                        data-id= "{{ $inventaire->id}}"
                                        data-quantite_physique="{{ $inventaire->quantite_physique}}"
                                        data-date_inventaire="{{ $inventaire->date_inventaire }}"
                                    >

                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{++$i}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">{{$inventaire->produitable->reference}}</a></td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$inventaire->produitable->designation}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$inventaire->produitable->qte_en_portions}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$inventaire->prix_unitaire}}</td>
                                        <td class="@if($inventaire->valeur_theorique >= 0) text-green-500 @else text-red-500 @endif px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ">{{$inventaire->valeur_theorique}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$inventaire->quantite_physique}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$inventaire->valeur_physique}}</td>
                                        <td class="@if($inventaire->ecart >= 0) text-green-500 @else text-red-500 @endif px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ">{{$inventaire->ecart}}</td>
                                        <td class="@if($inventaire->valeur_ecart >= 0) text-green-500 @else text-red-500 @endif px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ">{{$inventaire->valeur_ecart}}</td>
                                       
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                            <div class="relative dropdown">
                                                <button id="orderAction1" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20 w-20"><i data-lucide="more-horizontal" class="size-4"></i></button>
                                                <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction1">
                                                    <li>
                                                        <button type="button" onclick="modifier()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Modifier</span></button>
                                                    </li>
                                                    <li>
                                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="{{ route('inventaire.delete', ['id' => $inventaire->id]) }}" onclick="return confirm('Cette action est irreversible! Êtes-vous sûr de vouloir confirmer la suppression ?')"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Supprimer</span></a> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                
                                @if($i == 0)
                                    <div id="aucunelement" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <strong class="font-bold">Vide!</strong>
                                        <span class="block sm:inline">Votre inventaire s'affiche ici...</span>
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
                <h1 class="flex justify-center items-center text-black text-5xl">Faire un inventaire</h1>
            </div> 
             <div class=" transition-opacity duration-500">
                <div class="col-span-12 card 2xl:col-span-12 ">
                    <div class="card-body">
                        <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                            <div class="2xl:col-span-3 2xl:col-start-10">
                                <form id="formulaire_ajout">
                                    <div class="flex mb-2">
                                        <div class="col mr-2 w-full">
                                            <label for="date_inventaire">Date inventaire</label>
                                            <input type="date" name="date_inventaire" class="date_inventaire ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                        </div>
                                    </div>
                                    <div id="produit_template0" class="produit-item mb-8">
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label class="productLabel" for="element_a_transformer_input">Produit </label>
                                                <input name="produits_input[0]" class="produit_inventorie_input row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Cherchez par reference ou par designation">
                                                <select multiple name="produits[0]" class="produit_inventorie_selecte ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="-1" selected disabled>Cherchez dans vos produits finis</option>
                                                    @foreach($produits as $produit)
                                                        <option value="{{$produit->id}}">{{$produit->reference}}, {{$produit->designation}}, {{$produit->portion_unitaire}}</option>
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
                                        
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="portion_unitaire">Unité min</label>
                                                <input readonly type="text" name="portion_unitaire[0]" class="portion_unitaire ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="prix_unitaire_portion">Prix unitaire min</label>
                                                <input readonly type="number" step="any" name="prix_unitaire_portion[0]" class="prix_unitaire_portion ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div> 
                                            <div class="col mr-2 w-full">
                                                <label for="quantite_physique">Quantité physique</label>
                                                <input type="number" step="any" name="quantite_physique[0]" class="quantite_physique ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <div id="produit_container"></div>

                                    <div class="flex mb-2 justify-between">
                                        <button style="background-color: #5555ff; color: white;" type="button" id="ajouter_produit" class="btn">+ Ajouter un produit</button>
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
    <div id="modifying_erea" class="hidden group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Modifier un inventaire</h1>
            </div>  
                <div class="transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form id="formulaire_modif">
                                        <input class="hidden" type="number" name="inventaire_id" id="inventaire_id">
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="date_inventaire">Date invnetaire</label>
                                                <input type="date" name="date_inventaire" class="date_inventaire ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="quantite_physique">Quantité physique</label>
                                                <input type="number" step="any" name="quantite_physique" class="quantite_physique ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
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
        </div>
   
    <script>
        function addInputEventToSpecificInput(element){
            let timeId;
            const produit_inventorie_selecte = $(element + ' .produit_inventorie_selecte');
            produit_inventorie_selecte.on('change', function(){
                const idProduit = $(this).val();
                $.ajax({
                    url: '/render-produit-finis-inventorie',
                    method: 'GET',
                    data: {
                        idProduit: idProduit ? idProduit[0] : null,
                    },
                    success: function(produit) {
                        if(produit.other_error){
                            return toastr.error('Une erreur s\'est produite. Veuillez recommencer...');
                        }
                        if (produit) {
                            $(element + ' .produit_inventorie_input').val(produit.designation);
                            $(element + ' .reference').val(produit.reference);
                            $(element + ' .designation').val(produit.designation);
                            $(element + ' .portion_unitaire').val(produit.portion_unitaire);
                            $(element + ' .prix_unitaire_portion').val(produit.prix_unitaire_portion);
                        }
                    },
                    error: function(error) {
                        toastr.error('Erreur de connexion. Veuillez réessayer.');
                    }
                });
            
            });




            $(element + ' .produit_inventorie_input').on('input', function () {
                clearTimeout(timeId);
                let terme = $(this).val();
                timeId = setTimeout(function () {
                    $.ajax({
                        url: '/rechercher-lignes_system_produit_pt',
                        method: 'GET',
                        data: { terme: terme},
                        success: function (produits) {
                            if(produits.other_error){
                                return toastr.error('Une erreur s\'est produite. Veuillez recommencer...'); 
                            }
                            if(produits){
                                produit_inventorie_selecte.empty();
                                produit_inventorie_selecte.append('<option selected disabled value="">Choisir un produit ici...</option>');
                                $.each(produits, function(index, produit){
                                    produit_inventorie_selecte.append(
                                        $('<option></option>').attr('value', produit.id).text(produit.designation + ' (' + produit.reference + ')' + ' (' + produit.portion_unitaire + ')' + ' (' + produit.prix_unitaire_portion + ' FCFA)')
                                    );
                                });
                                return;
                            }
                        },
                        error: function () {
                            return toastr.error('Erreur de connexion. Veuillez réessayer.');
                        }
                    });
                }, 250);
            });
  }

        addInputEventToSpecificInput('#produit_template0');

        $(document).ready(function () {
            let produitCounter = 1;
            $('#ajouter_produit').on('click', function () {
                let newProduit = $('#produit_template0').clone();
                newProduit.attr('id', 'produit_template' + produitCounter);
                
                let deleteButton = $('<button type="button" class="supprimer_produit error text-red-500">--Supprimer</button>');
                newProduit.append(deleteButton);

                newProduit.find('input, select').each(function() {
                    let name = $(this).attr('name');
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

                let element = '#produit_template' + String(produitCounter);
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
            const produitTemplateInitial = $('#produit_template0')
        }     

        function modifier(){
            let modifying = document.getElementById('modifying_erea')
            modifying.classList.remove("hidden")  
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")
            let trElement = event.target.closest('tr');

            const inventaire_id = trElement.getAttribute('data-id');
            const quantite_physique = trElement.getAttribute('data-quantite_physique');

            const date_inventaire = trElement.getAttribute('data-date_inventaire');
           
            formulaire = document.getElementById('formulaire_modif');
            formulaire.querySelector('input[name="inventaire_id"]').value = inventaire_id;
            formulaire.querySelector('input[name="quantite_physique"]').value = quantite_physique;
            formulaire.querySelector('input[name="date_inventaire"]').value = date_inventaire;
        }


        let formulaire_ajou = document.getElementById('formulaire_ajout');
        formulaire_ajou.addEventListener('submit', function(event) {
            event.preventDefault();
               let formData = new FormData(formulaire_ajou);
               let request = new XMLHttpRequest();
               request.open('POST', '/store_inventaire_pt');
               request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
               request.onreadystatechange = function() {
  
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        effacer_erreurs();
                        return toastr.success("Opération reussie");
                    } else {
                        let response = JSON.parse(request.responseText);
                        if (response.errors) {
                            effacer_erreurs()
                            let errors = response.errors;
                            Object.keys(errors).forEach(function(key) {
                                k = key.replace(/(\w+)\.(\d+)/, '$1[$2]');

                                let inputField = formulaire_ajou.querySelector('[name="' + k + '"]');
                                
                                if (inputField) {
                                    let errorElement = document.createElement('span');
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

    
        let formulaire_modif = document.getElementById('formulaire_modif');
        formulaire_modif.addEventListener('submit', function(event) {
            event.preventDefault();
            let data_to_modify = new FormData(formulaire_modif);
            let request = new XMLHttpRequest();
            request.open('POST', '/edit_inventaire_pt');
            request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            request.onreadystatechange = function() {
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        effacer_erreurs();
                        toastr.success('Opération reussie');
                    }else if(request.status === 419){
                        toastr.error('Cette page a expiré! Veuillez la recharger pour continuer...');
                    }else {
                        let response = JSON.parse(request.responseText);
                        if (response.errors) {
                            effacer_erreurs();
                            let errors = response.errors;
                            Object.keys(errors).forEach(function(key) {
                                let inputField = formulaire_modif.querySelector('[name="' + key + '"]');
                                if (inputField) {
                                    let errorElement = document.createElement('span');
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

        disparition_table();
        fonction_de_recherche();
    </script>   
@endsection