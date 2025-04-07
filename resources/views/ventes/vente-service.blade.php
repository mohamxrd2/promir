@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div id="displaying_erea" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex justify-center items-center mb-2 mt-2">
            <h1 class="flex justify-center items-center text-black text-5xl">Liste des prestations de services</h1>
        </div> 
        <div class="col-span-12 card 2xl:col-span-12">
            <div class="card-body">
                <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                    <div class="flex items-center">
                        <div class="2xl:col-span-3">
                            <h5 class="mr-2">Gestion des prestations</h5>
                        </div>
                        <button onclick="ajouter()" class="inline-block rounded-full bg-white transition-all duration-300 ease-in-out hover:bg-gray-400 active:bg-gray-500">
                            <i id="btn_ajouter" class="align-baseline ltr:pr-1 rtl:pl-1 ri-add-line text-lg text-black"></i>
                        </button>
            
                        <a href="#" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
                            <i data-lucide="briefcase" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                            <span class="align-middle">Prestations</span>
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
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Moyen payement</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Status</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Nombre services</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Total à régler</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Total réglé</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reste à régler</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Heure de vente</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($ventes as $vente)
                                @php
                                $somme_a_payer = 0;
                                $montant_regle = 0;
                                $total_envoye = 0;
                                foreach ($vente->lignesVente as $produit) {
                                    $somme_a_payer +=  $produit->prix_vente * $produit->quantite_vendue;
                                    $montant_regle += $produit->montant_regle;
                                    $total_envoye += $produit->quantite_envoyee;
                                }
                                $reste = $somme_a_payer - $montant_regle;
                                @endphp
                                <tr
                                    data-id= "{{ $vente->id}}"
                                    data-reference="{{ $vente->reference }}"
                                    data-moyen_payement="{{ $vente->moyen_payement }}"
                                    data-status_vente="{{ $vente->status_vente}}"
                                >
                                    
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{++$i}}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">{{$vente->reference}}</a></td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$vente->moyen_payement}}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$vente->status_vente}}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$vente->lignesVente->count()}}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$somme_a_payer}}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$montant_regle}}</td>
                                    @if ($reste == 0)
                                        <td class="text-green-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ">{{$reste}}</td>
                                        @elseif ($reste > 0)
                                        <td class="text-red-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ">{{$reste}}</td>
                                    @endif
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$vente->created_at->format('H:i')}}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        <div class="relative dropdown">
                                            <button id="orderAction1" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20 w-20"><i data-lucide="more-horizontal" class="size-4"></i></button>
                                            <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction1">
                                                <li>
                                                    <button onclick="details_vente()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"><i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Afficher</span></button>
                                                </li>
                                                <li>
                                                    <button type="button" onclick="modifier()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Modifier</span></button>
                                                </li>
                                                <li>
                                                    <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="{{ route('vente.delete', ['id' => $vente->id]) }}" onclick="return confirm('Cette action est irreversible! Êtes-vous sûr de vouloir éffectuer la suppression ?')"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Supprimer</span></a> 
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            
                            @if($i == 0)
                                <div id="aucunevente" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                    <strong class="font-bold">Vide!</strong>
                                    <span class="block sm:inline">Aucune prestation aujourd'hui.</span>
                                </div>
                            @endif                                
                        </tbody>
                    </table>
                    
                    <table id="venteOverView" class="w-full whitespace-nowrap hidden">
                        <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
                            <tr>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                    N°
                                </th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reference du service</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Designation du service</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Prix</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Valeur totale</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Quantité offerte</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Somme réglée</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reste à régler</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Heure de vente</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody> 
                        </tbody>
                        
                        <div id="aucunelement" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Vide!</strong>
                            <span class="block sm:inline">Aucun produit trouvé.</span>
                        </div>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <div id="btnRetourDetailsListe" class=" hidden flex justify-end w-full">
            <button type="button" onclick="afficher(this)" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Retour</button>
        </div>

    </div>
    <div id="adding_erea" class="hidden group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Ajouter une prestation de services</h1>
            </div> 
            <div class=" transition-opacity duration-500">
                <div class="col-span-12 card 2xl:col-span-12 ">
                    <div class="card-body">
                        <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                            <div class="2xl:col-span-3 2xl:col-start-10">
                                <form id="formulaire_ajout">
                                    
                                    <div class="flex mb-2">
                                        <div class="col mr-2 w-full">
                                            <label for="type_de_vente">Type de vente</label>
                                            <select id="type_de_vente_add" name="type_de_vente" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                <option value="" disabled selected hidden>Choisissez le type de vente</option>
                                                <option value="Point de vente">Point de vente</option>
                                            </select>
                                        </div>
                                        <div class="col mr-2 w-full">
                                            <label for="moyen_payement_add">Moyen de payement</label>
                                            <select id="moyen_payement_add" name="moyen_payement" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                <option value="" disabled selected hidden>Choisissir un moyen</option>
                                                <option value="Payement BIICF">Payement BIICF</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Orange money">Orange money</option>
                                                <option value="MTN money">MTN money</option>
                                                <option value="Moov money">Moov money</option>
                                                <option value="Cash">Wave</option>
                                                <option value="Trasor money">Trasor money</option>
                                            </select>
                                        </div>
                                        <!-- <div class="col mr-2 w-full">
                                            <label for="status_vente"></label>Status de la vente
                                            <select id="status_vente_add" name="status_vente" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                <option value="" disabled>Choisissir un status</option>
                                                <option value="En attente">En attente</option>
                                                <option selected value="Conifimée">Conifimée</option>
                                                <option value="Annulée">Annulée</option>
                                            </select>
                                        </div> -->
                                    </div>

                                    <div id ="div_clients" class="flex mb-2">
                                        <div class="col mr-2 w-full">
                                            <label for="ligne_client_systeme">Client
                                                <a onclick="ajouterUnNoveauClient()" href="#!" class="inline-block rounded-full bg-white transition-all duration-300 ease-in-out hover:bg-gray-400 active:bg-gray-500">
                                                    <i id="btn_ajouter" class="align-baseline ltr:pr-1 rtl:pl-1 ri-add-line text-lg text-black"></i>
                                                </a>
                                            </label>
                                            <input id="ligne_client_systeme_input" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Cherchez par reference ou par designation">
                                            <select multiple  name="ligne_client_systeme" id="ligne_client_systeme_selecte" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                <option value="-1" selected disabled>Choisir un client...</option>
                                                @foreach ($clientsPresents as $clientsPresent )
                                                    <option value="{{$clientsPresent->id}}">{{$clientsPresent->client->nom}} ({{$clientsPresent->client->email}}) ({{$clientsPresent->client->phone}}) ({{$clientsPresent->client->type}}) </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    {{-- Ajout des produits a la vente --}}
                                    {{-- Rappele que chaque vente contient en elle plusieurs produits --}}
                                    <div id="service_template0" class="service-item mb-8">
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="element_a_vendre" class="serviceLabel"></label>Service 
                                                <input name="produits_input[0]" class="element_a_vendre_input row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Cherchez par reference ou par designation">
                                                <select multiple name="produits[0]" class="element_a_vendre_selecte ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                <option value="-1" disabled selected>Choisissir un service...</option>
                                                    @foreach ($produitsPresents as $produitsPresent)
                                                        <option value="{{$produitsPresent->id}}">{{$produitsPresent->reference}} | {{$produitsPresent->designation}} | {{$produitsPresent->prix_unitaire}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="quantite_vendue">Quantité offerte</label>
                                                <input type="number" name="quantite_vendue[0]" class="quantite_vendue ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>   
                                            <div class="col mr-2 w-full">
                                                <label for="prix_vente">Prix du service</label>
                                                <input disabled type="number" name="prix_vente[0]"  class="prix_vente ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="montant_regle">Montant réglé</label>
                                                <input type="number" name="montant_regle[0]" class="montant_regle ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>
                                        </div>
                                        <br>


                                        <div id="produits_container0" class="produits_container">
                                        </div>

                                        <div class="flex mb-2 boutonDiv">
                                            <button type="button" id="ajouter_produit0" class="btn ajouter_produit">+ Ajouter un produit</button>
                                        </div>

                                        <div id="produit_template0" class="produit-item mb-8 hidden">
                                            <div class="flex mb-2">
                                                <div class="col mr-2 w-full">
                                                    <label class="productLabel" for="element_a_utiliser_input"></label>
                                                    <input name="produits_utilise_in" class="element_a_utiliser_input row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Cherchez par reference ou par designation">
                                                    <select multiple value="" name="produits_u" class="element_a_utiliser_selecte ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                        <option value="-1" selected disabled>Cherchez dans les produits bruts</option>
                                                        @foreach ($produitsUtilises as $produitsUtilise)
                                                            <option value="{{$produitsUtilise->id}}">{{$produitsUtilise->produit->reference}} | {{$produitsUtilise->produit->categorie->nom}} | {{$produitsUtilise->produit->designation}} | {{$produitsUtilise->produit->format}} | {{$produitsUtilise->produit->type}} | {{$produitsUtilise->pua}} | {{$produitsUtilise->puv}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="flex mb-2">
                                                <div class="col mr-2 w-full">
                                                    <label for="quantite_utilisee">Quantité utilisée</label>
                                                    <input type="number" step="any" name="quantite_u" class="quantite_utilisee ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                </div>  
                                            </div>
                                        </div>
                                    </div>

                                    <div id="services_container"></div>

                                    <div class="flex mb-2">
                                        <button style="background-color: blue; color: white;" type="button" id="ajouter_service" class="btn">+ Ajouter un service</button>
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
            <h1 class="flex justify-center items-center text-black text-5xl">Modifier une prestation de services</h1>
        </div> 
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
                                                <input readonly type="text" disabled name="reference" id="reference_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
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

                                            <!-- <div class="col mr-2 w-full">
                                                <label for="status_vente">Status vente</label>
                                                <select required id="status_vente_modif" name="status_vente" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="" disabled selected hidden>Choisissir ici...</option>
                                                    <option value="En attente">En attente</option>
                                                    <option value="Conifimée">Conifimée</option>
                                                    <option value="Annulée">Annulée</option>
                                                </select>
                                            </div> -->
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

    


    <div id="add_new_client" class="hidden group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Ajouter un nouveau client</h1>
            </div> 
            <div class=" transition-opacity duration-500">
                <div class="col-span-12 card 2xl:col-span-12 ">
                    <div class="card-body">
                        <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                            <div class="2xl:col-span-3 2xl:col-start-10">
                                <form id="formulaire_ajout_new_client">
                                    <div class="flex mb-2">

                                        <div class="col mr-2 w-full">
                                            <input type="text" id="clientInput_id" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Entrez un client">
                                            <select multiple value="" id="clientSelected_id" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                <option selected disabled>Vous pouvez rechercher ou ajouter un client</option>
                                                @foreach ($clientsNonPresents as $clientsNonPresent)
                                                    <option value={{"$clientsNonPresent->id"}}>Nom: {{$clientsNonPresent->nom}}, Phone: {{$clientsNonPresent->phone}}, Email: {{$clientsNonPresent->email}}</option>
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
                                        <button type="button" onclick="retournerALaVente()" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Précédent</button>
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
            const element_a_vendre_selecte = $(element + ' .element_a_vendre_selecte');
        }

        addInputEventToSpecificInput('#service_template0');

        $(document).ready(function () {
            let servicesCounter = 1;
            $('#ajouter_service').on('click', function () {
                var newService = $('#service_template0').clone();
                newService.attr('id', 'service_template' + servicesCounter);
                newService.find('#produits_container0 .produit_template').remove();
                var deleteButton = $('<button type="button" class="supprimer_service error text-red-500">--Supprimer ce service</button>');
                newService.append(deleteButton);
                newService.find('.produits_container').attr('id', 'produits_container' + servicesCounter);
                let boutonUtiliserProduit = newService.find('.ajouter_produit');
                boutonUtiliserProduit.attr('id', 'ajouter_produit' + servicesCounter);
                // $('#ajouter_produit' + (servicesCounter - 1).toString()).prop('disabled', true);
                // newService.find('.serviceLabel').text(' '+(servicesCounter + 1).toString());
                newService.find('input, select').each(function() {
                    var name = $(this).attr('name');
                    name = name.replace('0', servicesCounter);
                    $(this).attr('name', name);
                    if ($(this).is('input')) {
                        $(this).val('');
                    } else if ($(this).is('select')) {
                        $(this).val('-1');
                    }
                });

                let produitCounter = 0;
                
                ajouterProduitsUtilises(boutonUtiliserProduit, servicesCounter, produitCounter, newService);
                newService.removeClass('hidden');
                $('#services_container').append(newService);
                var element = '#service_template' + String(servicesCounter);
                addInputEventToSpecificInput(element);
                deleteButton.on('click', function () {
                    newService.remove();
                });
                servicesCounter++;
            });

        });



        

        function ajouterUnNoveauClient(){
            let adding = document.getElementById('adding_erea')
            adding.classList.add("hidden")    
            let newClientArea = document.getElementById('add_new_client')
            newClientArea.classList.remove("hidden")
            ajouterClient(document.getElementById('formulaire_ajout_new_client'));
        }

        function ajouter(){

            let adding = document.getElementById('adding_erea')
            adding.classList.remove("hidden")    
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")
            const ligne_client_systeme_selecte = document.getElementById('ligne_client_systeme_selecte');
            let timerId;
            const produitTemplateInitial = $('#service_template0')
            updateClients();
            clients_on_change();
            let boutonUtiliserProduit = $('#ajouter_produit0');
            ajouterProduitsUtilises(boutonUtiliserProduit, 0, 0, $('#service_template0'));
        }
    
        
        function clients_on_change(){

            const ligne_client_systeme_selecte = document.getElementById('ligne_client_systeme_selecte');
            ligne_client_systeme_selecte.addEventListener('change', function() {
                ligne_client_systeme_input.value = ligne_client_systeme_selecte.options[ligne_client_systeme_selecte.selectedIndex].text;
            })
        }




    function updateClients(){    
        const ligne_client_systeme_input = document.getElementById('ligne_client_systeme_input');
        const ligne_client_systeme_selecte = document.getElementById('ligne_client_systeme_selecte');
            let timeId;
            ligne_client_systeme_input.addEventListener('input', function(e) {
                clearTimeout(timeId);
                timeId = setTimeout(function() {
                    var inputValue = e.target.value;
                    $.ajax({
                        url: '/rechercher-clients-pour-vente',
                        method: 'GET',
                        data: { query: inputValue},
                        success: function(response) {
                            if(response.length > 0){
                                if(response.length == 1){
                                    ligne_client_systeme_selecte.innerHTML = '<option disabled value="">1 résultat</option>';
                                }else{
                                    ligne_client_systeme_selecte.innerHTML = '<option disabled value="">'+ response.length +' résultats</option>';
                                }
                                response.forEach(function(mesClientTrouve) {
                                    ligne_client_systeme_selecte.innerHTML += `<option value="${mesClientTrouve.id}">${mesClientTrouve.client.nom} (${mesClientTrouve.client.email}) (${mesClientTrouve.client.phone}) (${mesClientTrouve.client.type})</option>`;
                                });
                            }else{
                                ligne_client_systeme_selecte.innerHTML = '<option disabled value="">Aucun client</option>';
                            }
                        },
                        error: function(xhr, status, error) {
                            toastr.error('Quelque chose a mal fonctioné! Veuillez recommencer...')
                            console.error(error);
                            return;
                        }
                    });
                }, 250);
            });
    }
        
    function details_vente(){
        let sells_table = document.getElementById('personnelTable');
        let details_table = document.getElementById('venteOverView');
        details_table.classList.remove("hidden")
        sells_table.classList.add("hidden")
        let trElement = event.target.closest('tr');
        const venteId = trElement.getAttribute('data-id');
        $.ajax({
            url: "{{route('render-details-vente_services')}}",
            method: 'GET',
            data: { query: venteId },
            success: function(response) {
                var lignesVente = response.lignesVente;
                if (lignesVente.length === 0) {
                    $('#aucunelement').removeClass('hidden');
                } else {
                    $('#aucunelement').addClass('hidden');
                }
                
                var tbody = $('#venteOverView tbody');
                tbody.empty();
                $.each(lignesVente, function(index, lignesVente) {
                    
                    var totale_valeur = lignesVente.prix_vente * lignesVente.quantite_vendue;
                    var reste_a_regler = totale_valeur - lignesVente.montant_regle;

                    var row = '<tr data-id="' + lignesVente.id + '">' +
                        '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + (index + 1) + '</td>' +
                        '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">' + lignesVente.service.reference + '</a></td>' +
                        '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + lignesVente.service.designation + '</td>' +
                        '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + lignesVente.prix_vente + '</td>' +
                        '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + totale_valeur + '</td>' +
                        '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + lignesVente.quantite_vendue + '</td>' +
                        '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + lignesVente.montant_regle + '</td>' +
                        '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ' + (reste_a_regler === 0 ? 'text-green-500' : 'text-red-500') + '">' + reste_a_regler + '</td>' +
                        '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + (new Date(lignesVente.created_at)).toLocaleTimeString() + '</td>' +
                        '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' +
                        '<a href="#" class="px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zinc-100 dark:hover:bg-zinc-500 dark:hover:text-zinc-200 dark:focus:bg-zinc-500 dark:focus:text-zinc-200"><i class="fas fa-edit inline-block size-3 ltr:mr-1 rtl:ml-1"></i></a>'+
                        '<a href="#" class="px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zinc-100 dark:hover:bg-zinc-500 dark:hover:text-zinc-200 dark:focus:bg-zinc-500 dark:focus:text-zinc-200"><i class="fas fa-trash-alt inline-block size-3 ltr:mr-1 rtl:ml-1"></i></a>'+
                        '</td>' +
                        '</tr>';
                    tbody.append(row);
                });
                $('#venteOverView').removeClass('hidden');
            },
            error: function(e) {
                toastr.error('Erreur lors de la récupération des données.');
            }
        });
        document.getElementById("btnRetourDetailsListe").classList.remove("hidden");
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
    
        function afficher(diappearBtn = null){
            if(!diappearBtn){
                let displaying = document.getElementById('displaying_erea')
                displaying.classList.remove("hidden")
                let adding = document.getElementById('adding_erea')
                if(adding){
                    adding.classList.add("hidden")
                }

                let newClientArea = document.getElementById('add_new_client')
                if(newClientArea){
                    newClientArea.classList.add("hidden")
                }

                let modifying = document.getElementById('modifying_erea')
                if(modifying){
                    modifying.classList.add("hidden")
                }
            }else if(diappearBtn){
                let sells_table = document.getElementById('personnelTable');
                if(sells_table){
                    sells_table.classList.remove("hidden")
                }
                let details_table = document.getElementById('venteOverView');
                if(details_table){
                    details_table.classList.add("hidden")
                }
                diappearBtn.parentNode.classList.add('hidden');
            }
            window.location.reload();
        }


        function retournerALaVente(){
            let newClientArea = document.getElementById('add_new_client')
            if(newClientArea){
                newClientArea.classList.add("hidden")
            }

            let adding = document.getElementById('adding_erea')
            if(adding){
                adding.classList.remove("hidden")
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
               request.open('POST', '/store_vente_service');
               request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
               request.onreadystatechange = function() {
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        var response = JSON.parse(request.responseText);
                        if(response.clientRequis){
                            var errorMessageElements = document.querySelectorAll('.error-message');
                            if(errorMessageElements.length > 0){
                                errorMessageElements.forEach(function(element) {
                                    element.parentNode.removeChild(element);
                                });
                            }
                            toastr.warning('Un client est requis!');
                            return;
                        }
                        if(response.duplication){toastr.info(response.duplication,'INFORMATION'); return;}
                        var errorMessageElements = document.querySelectorAll('.error-message');
                        if(errorMessageElements.length > 0){
                            errorMessageElements.forEach(function(element) {
                                element.parentNode.removeChild(element);
                            });
                        }
                            toastr.success('Vente éffectuée avec succès!');
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
                            let parts;
                            let k;
                            Object.keys(errors).forEach(function(key) {
                                parts = key.split('.');
                                if (parts.length == 1) {
                                    k = parts[0];
                                } else if (parts.length == 2) {
                                    k = parts[0] + '[' + parts[1] + ']';
                                } else if (parts.length == 3) {
                                    k = parts[0] + '[' + parts[1] + ']' + '[' + parts[2] + ']';
                                } else {
                                    k = "impossible";
                                }

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

        var formulaire_modif = document.getElementById('formulaire_modif');
        formulaire_modif.addEventListener('submit', function(event) {
            event.preventDefault();
            var data_to_modify = new FormData(formulaire_modif);
            var request = new XMLHttpRequest();
            request.open('POST', '/edit_vente_pt');
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

                        toastr.success('Vente modifiée avec succès!');
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

        if(document.getElementById("aucunevente")){
            document.getElementById("personnelTable").style.display = 'none';
        }
        
        fonction_de_recherche();
    </script>  
@endsection