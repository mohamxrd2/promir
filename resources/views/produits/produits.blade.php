@extends('layouts.master')
@section('content')
    <div id="display_contrat" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Liste des produits</h1>
            </div>
            <div class="col-span-12 card 2xl:col-span-12">
                <div class="card-body">
                    <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                        <div class="flex items-center">
                            <div class="2xl:col-span-3">
                                <h5 class="mr-2">Ajouter un produit</h5>
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
                        <table id="personnelTable" class="w-full whitespace-nowrap">
                            <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
                                <tr>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        N°
                                    </th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reference</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Categorie</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Désignation</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Format</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Conditionnement</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Calibrage</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Origine</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">P.U.A</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">P.U.M.V</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Quantité en stock</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Piéce unitaire</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Nombre pièces U.</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Portion unitaire</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">N.P.U Par piéce</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Image</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                    use App\Models\CategorieProduit;
                                    $i = 0;
                                @endphp
                                @foreach ( $produits as $p )
                                    @php
                                        $categorie = CategorieProduit::where('id', $p->produit->categorie_produit_id)->first();
                                    @endphp
                                    <tr
                                        data-id= "{{ $p->id}}"
                                        data-num-qte_stck="{{ $p->qte_stck }}"
                                        data-puv="{{ $p->puv }}"
                                        data-pua="{{ $p->pua }}"
                                        data-portion="{{ $p->portion }}"
                                        data-nom_piece="{{ $p->nom_piece }}"
                                        data-nombre_pieces="{{ $p->nombre_pieces }}"
                                        data-nombre_portions="{{ $p->nombre_portions }}"
                                        data-reference="{{ $p->produit->reference }}"
                                        data-designation="{{ $p->produit->designation }}"
                                        data-format="{{ $p->produit->format }}"
                                        data-type="{{ $p->produit->type }}"
                                        data-image="{{ $p->produit->image }}"
                                        data-categorie="{{$categorie->nom}}"
                                        >
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{++$i}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">{{$p->produit->reference}}</a></td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$categorie->nom}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$p->produit->designation}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$p->produit->format}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$p->produit->conditionnement}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$p->produit->calibrage}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$p->produit->type}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$p->pua}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$p->puv }}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$p->qte_stck}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$p->nom_piece}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$p->nombre_pieces}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$p->portion}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$p->nombre_portions}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                            @if ($p->produit->image)
                                            {{-- <div>{{$p->produit->image}}</div> --}}
                                                <img class="w-10 h-10 rounded" src="{{ asset('storage/' . $p->produit->image) }}" alt="image">
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
                                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!"><i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Afficher</span></a>
                                                    </li>
                                                    <li>
                                                        {{-- <button onclick="modifier()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Modifier</span></button> --}}
                                                        <button type="button" onclick="modifier()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Modifier</span></button>
                                                    </li>
                                                    <li>
                                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="{{ route('system_produit.delete', ['id' => $p->id]) }}" onclick="return confirm('Cette action est irreversible! Êtes-vous sûr de vouloir supprimer cet produit ?')"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Supprimer</span></a> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        </tr>
                                @endforeach 
                                @if($i == 0)
                                    <div id="aucuncontrat" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <strong class="font-bold">Vide!</strong>
                                        <span class="block sm:inline">Aucun produit trouvé.</span>
                                    </div>
                                @endif                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="add_contrat" class="hidden group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Ajouter un produit</h1>
            </div>
                <div class=" transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form id="formulaire_ajout">
                                       
                                        <input class="hidden" type="text" name="personnel_id" id="id_personnel">
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <input type="text" id="categorieInput2" name="categorie" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="on" placeholder="Entrez le nom de la catégorie">
                                                <select multiple id="categorieSelect2"  class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option disabled>Catégories suggérées</option>
                                                    @foreach ($categories as $categorie)
                                                        <option value="{{$categorie->id}}">{{$categorie->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <input type="text" id="produitsInput2" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="on" placeholder="Entrez le nom du produit">
                                                <select multiple id="produitsSelect2" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option selected>Produits suggérés</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="reference">Reference 
                                                    (Générer <input type="checkbox" onclick="toggle()" id="toggle-checkbox" class="">)
                                                </label>
                                                <input required disabled type="text" name="reference" id="reference_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="designation">Désignation</label>
                                                <input required type="text" name="designation" id="designation_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                           
                                            <div class="col mr-2 w-full">
                                                <label for="conditionnement">Conditionnement</label>
                                                <input required type="text" name="conditionnement" id="conditionnement_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="format">Format </label>
                                                <input required type="text" name="produit_format" id="format_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="calibrage">Particularité</label>
                                                <input required type="text" id="calibrage" name="calibrage" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="format">Origine</label>
                                                <select required id="type_produit" name="type_produit" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="" disabled selected hidden>Choisissez une origine</option>
                                                    <option value="Importé">Importé</option>
                                                    <option value="Locale">Locale</option>
                                                </select>
                                            </div>

                                        </div>



                                        <div class="flex mb-2">

                                            <div class="col mr-2 w-full">
                                                <label for="qte_stck">Stock initial</label>
                                                <input required type="number" name="qte_stck" id="qte_stck_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>


                                            <div class="col mr-2 w-full">
                                                <label for="pua">P.U.A</label>
                                                <input required type="number" name="pua" id="pua_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="puv">P.U.M.V</label>
                                                <input required type="number" name="puv" id="puv_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            
                                            <div class="col mr-2 w-full">
                                                <label for="image">Image</label>
                                                <input  type="file" id="image" name="image" accept=".png, .jpeg, .jpg" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Photo..." autocomplete="on">
                                            </div>
                                        </div>

                                        <div class="flex items-center mb-2">
                                            <h3 class="mx-auto"><strong>Autres spécifications du produit</strong></h3>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="nom_piece">Nom Unité</label>
                                                <input required type="text" name="nom_piece" id="nom_piece" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="nombre_pieces">Nombre unités</label>
                                                <input required type="number" value="1" name="nombre_pieces" id="nombre_pieces" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="libelle_portion">Portion unitaire</label>
                                                <input required type="text" name="libelle_portion" id="libelle_portion" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="nombre_portions">Nbr port. par unité</label>
                                                <input required type="number" value="1" name="nombre_portions" id="nombre_portion" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
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
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Modifier un produit</h1>
            </div> 
                <div class="transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form id="formulaire_modif">
                                        <input class="hidden" type="text" name="produit_id" id="produit_id">
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="qte_stck">Stock initial</label>
                                                <input required type="number" name="qte_stck" id="qte_stck_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="pua">P.U.A</label>
                                                <input required type="number" name="pua" id="pua_modif" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="puv">P.U.M.V</label>
                                                <input required type="number" name="puv" id="puv_modif" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                            
                                        </div>

                                        <div class="flex items-center mb-2">
                                            <h3 class="mx-auto"><strong>Autres spécifications du produit</strong></h3>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="nom_piece">Pièce unitaire</label>
                                                <input required type="text" name="nom_piece" id="nom_pieces_modif" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="nombre_pieces">Nombre piéces</label>
                                                <input required type="number" name="nombre_pieces" id="nombre_pieces_modif" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="libelle_portion">Portion unitaire</label>
                                                <input required type="text" name="libelle_portion" id="libelle_portion_modif" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="nombre_portions">Nombre portions par pièce</label>
                                                <input required type="number"  name="nombre_portions" id="nombre_portion_modif" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
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
        
    
        function ajouter(){
            let adding = document.getElementById('add_contrat')
            adding.classList.remove("hidden")    
            
            let displaying = document.getElementById('display_contrat')
            displaying.classList.add("hidden")


            
            const categorieInput2 = document.getElementById('categorieInput2');
            const categorieSelect2 = document.getElementById('categorieSelect2');
            const produitsSelect2 = document.getElementById('produitsSelect2');

            let timerId;
            categorieInput2.addEventListener('input', function(e) {
                

                clearTimeout(timerId);
                timerId = setTimeout(function() {
                    const inputValue = e.target.value;
                    $.ajax({
                        url: '/rechercher-categories',
                        method: 'GET',
                        data: { query: inputValue },
                        success: function(response) {
                            if(response.length > 0){
                                if(response.length == 1){
                                    categorieSelect2.innerHTML = '<option disabled value="">1 résultat</option>';
                                }else{
                                    categorieSelect2.innerHTML = '<option disabled value="">'+ response.length +' résultats</option>';
                                }
                                response.forEach(function(categorie) {
                                    categorieSelect2.innerHTML += `<option value="${categorie.id}">${categorie.nom}</option>`;
                                });
                            }else{

                                document.getElementById('produitsSelect2').innerHTML = '<option disabled value="">0 résultat</option>';
                                categorieSelect2.innerHTML = '<option disabled value="">0 résultat</option>';
                                reference =  document.getElementById('reference_add')
                                reference.value = '';

                                designation =  document.getElementById('designation_add')
                                designation.value = '';
                                designation.disabled = false;

                                format =  document.getElementById('format_add')
                                format.value = '';
                                format.disabled = false;

                                type_produit =  document.getElementById('type_produit')
                                type_produit.value = '';
                                type_produit.disabled = false;

                                conditionnement =  document.getElementById('conditionnement_add')
                                conditionnement.value = '';
                                conditionnement.disabled = false;
 
                                calibrage = document.getElementById('calibrage')
                                calibrage.value = '';
                                calibrage.disabled = false;
                                
                                image =  document.getElementById('image')
                                image.disabled = false;

                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }, 250);
            });
            category_on_change();
            update_produits();
            produit_on_change();
        }


        function category_on_change(){
            categorieSelect2.addEventListener('change', function() {
                categorieInput2.value = categorieSelect2.options[categorieSelect2.selectedIndex].text;
                const produitsSelect2 = document.getElementById('produitsSelect2');
                $.ajax({
                    url: '/render-produits',
                    method: 'GET',
                    data: { query: this.value },
                    success: function(response) {
                        if(response.length > 0){
                            if(response.length == 1){
                                produitsSelect2.innerHTML = '<option disabled value="">1 résultat</option>';
                            }else{
                                produitsSelect2.innerHTML = '<option disabled value="">'+ response.length +' résultats</option>';
                            }
                            response.forEach(function(produit) {
                                produitsSelect2.innerHTML += `<option value="${produit.id}">${produit.designation}</option>`;
                            });
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

        
        function produit_on_change(){
                produitsSelect2.addEventListener('change', function() {
                    produitsInput2.value = '';
                produitsInput2.value = produitsSelect2.options[produitsSelect2.selectedIndex].text;
                $.ajax({
                    url: '/render-produit_properties',
                    method: 'GET',
                    data: { query: this.value },
                    success: function(response) {
                        if(response){
                            console.log(typeof response);
                            reference =  document.getElementById('reference_add')
                            reference.value = response.reference;
                            reference.disabled = true;

                            designation =  document.getElementById('designation_add')
                            designation.value = response.designation;
                            designation.disabled = true;

                            format =  document.getElementById('format_add')
                            format.value = response.format;
                            format.disabled = true;

                            type_produit =  document.getElementById('type_produit')
                            type_produit.value = response.type;
                            type_produit.disabled = true;

                            conditionnement =  document.getElementById('conditionnement_add')
                            conditionnement.value = response.conditionnement;
                            conditionnement.disabled = true;

                            calibrage =  document.getElementById('calibrage')
                            calibrage.value = response.calibrage;
                            calibrage.disabled = true;

                            image =  document.getElementById('image')
                            image.disabled = true;
                            image.value = '';
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

       
        function update_produits(){
            const produitsInput2 = document.getElementById('produitsInput2');
            const produitsSelect2 = document.getElementById('produitsSelect2');
                let timeId;
                produitsInput2.addEventListener('input', function(e) {
                    clearTimeout(timeId);
                    timeId = setTimeout(function() {
                        const categorie_id = document.getElementById('categorieSelect2').value;
                        
                        if(!categorie_id) return;
                        var inputValue = e.target.value;
                        $.ajax({
                            url: '/rechercher-produits',
                            method: 'GET',
                            data: { query: inputValue, categorie: categorie_id },
                            success: function(response) {
                                if(response.length > 0){
                                    if(response.length == 1){
                                        produitsSelect2.innerHTML = '<option disabled value="">1 résultat</option>';
                                    }else{
                                        produitsSelect2.innerHTML = '<option disabled value="">'+ response.length +' résultats</option>';
                                    }
                                    response.forEach(function(produit) {
                                        produitsSelect2.innerHTML += `<option value="${produit.id}">${produit.designation}</option>`;
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
                                    format.disabled = false;

                                    type_produit =  document.getElementById('type_produit')
                                    type_produit.value = '';
                                    type_produit.disabled = false;

                                    conditionnement =  document.getElementById('conditionnement_add')
                                    conditionnement.value = '';
                                    conditionnement.disabled = false;

                                    calibrage =  document.getElementById('calibrage')
                                    calibrage.value = '';
                                    calibrage.disabled = false;


                                    image =  document.getElementById('image')
                                    image.disabled = false;
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }, 250);
                });
        }
        
        var checked = false;
        function toggle(){
            checked =! checked;
            if(checked){

                $.ajax({
                    url: '/generate_reference',
                    method: 'GET',
                    // data: { query: this.value },
                    success: function(response) {
                        if(response){
                           $('#reference_add').val(response)
                        }else{
                            toastr.warning('Un problème est survenu. Veuillez recommencer.');
                            return;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
            
        }

        function modifier(){
            let adding = document.getElementById('modify_produit')
            adding.classList.remove("hidden")    
            let displaying = document.getElementById('display_contrat')
            displaying.classList.add("hidden")
            let trElement = event.target.closest('tr');
    

            const produit_id = trElement.getAttribute('data-id');
            const qte_stck = trElement.getAttribute('data-num-qte_stck');
            const pua = trElement.getAttribute('data-pua');
            const puv = trElement.getAttribute('data-puv');
            const libelle_portion = trElement.getAttribute('data-portion');
            const nom_piece = trElement.getAttribute('data-nom_piece');
            const nombre_pieces = trElement.getAttribute('data-nombre_pieces');
            const nombre_portions = trElement.getAttribute('data-nombre_portions');

            const formulaire = document.getElementById('formulaire_modif');
            formulaire.querySelector('input[name="produit_id"]').value = produit_id ;
            formulaire.querySelector('input[name="qte_stck"]').value = qte_stck ;
            formulaire.querySelector('input[name="pua"]').value = pua;
            formulaire.querySelector('input[name="puv"]').value = puv;
            formulaire.querySelector('input[name="nom_piece"]').value = nom_piece;
            formulaire.querySelector('input[name="nombre_pieces"]').value = nombre_pieces;
            formulaire.querySelector('input[name="libelle_portion"]').value = libelle_portion;
            formulaire.querySelector('input[name="nombre_portions"]').value = nombre_portions;
        }
    
        
    
    
        function afficher(){
            let displaying = document.getElementById('display_contrat')
            displaying.classList.remove("hidden")
            let adding = document.getElementById('add_contrat')
            if(adding){
                adding.classList.add("hidden")
            }
            let modifying = document.getElementById('modify_contrat')
            if(modifying){
                modifying.classList.add("hidden")
            }
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
            image =  document.getElementById('image')
            image.disabled = false;

               var formData = new FormData(formulaire_ajou);
             
               var request = new XMLHttpRequest();
               request.open('POST', '/store_system_produit');
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
                        if(response.duplicationDeProduit){
                            toastr.info('Ce produit est déjà enregistré.');
                            reference.disabled = true;
                            return;
                        }
                        if (response.errors) {
                            var errors = response.errors;
                            Object.keys(errors).forEach(function(key) {
                                var inputField = formulaire_ajou.querySelector('[name="' + key + '"]');
                                if (inputField) {
                                    var errorElement = document.createElement('span');
                                    errorElement.className = 'error-message text-red-500';
                                    errorElement.textContent = errors[key][0];
                                    inputField.parentNode.appendChild(errorElement);
                                }
                                reference.disabled = true;
                            });
                        } else {
                            toastr.success('Produit entré avec succès!', 'OK');
                            reference.disabled = true;
                        }
                    } else {
                        reference.disabled = true;
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
            request.open('POST', '/edit_produit');
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
                            toastr.success('Contrat modifié avec succès!', 'OK');
                            window.location.reload();
                        }
                    }else if(response.status === 419){
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
                                var inputField = document.querySelector('[name="' + key + '"]');
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
    </script>


     
@endsection