@extends('layouts.master')
@section('content')
    <div id="displaying_erea" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Bilan personnel (propriétaire)</h1>
            </div>  
                <div class="col-span-12 card 2xl:col-span-12">
                    <div class="card-body">
                        <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                            <div class="flex items-center">
                                <div class="2xl:col-span-3">
                                    <h5 class="mr-2">Définir mon bilan</h5>
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
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Type</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Catégorie</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Libellé</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Valeur approximative</th>
                                        <!-- <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th> -->
                                    </tr>
                                </thead>
                               
                                <tbody> 
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ( $compositions as $composition )
                                        <tr
                                            data-id= "{{ $composition->id}}"
                                            >

                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{++$i}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$composition->type }}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$composition->categorie}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$composition->libelle}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$composition->valeur}}</td>

                                            <!-- <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                <div class="relative dropdown">
                                                    <button id="orderAction1" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20 w-20"><i data-lucide="more-horizontal" class="size-4"></i></button>
                                                    <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction1">
                                                        <li>
                                                            <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="{{ route('composition.delete', ['id' => $composition->id]) }}" onclick="return confirm('Cette action est irreversible! Êtes-vous sûr de vouloir éffectuer la suppression ?')"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Supprimer</span></a> 
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td> -->
                                            </tr>
                                    @endforeach 
                                    @if($i == 0)
                                        <div id="aucunelement" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                            <strong class="font-bold">Vide!</strong>
                                            <span class="block sm:inline">La composition de votre bilan s'affichent ici...</span>
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
                <h1 class="flex justify-center items-center text-black text-5xl">Définir un bilan</h1>
            </div>  
                <div class=" transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form id="formulaire_ajout">

                                        <div class="flex items-center mt-3">
                                            <h3 class="mx-auto"><strong>Actif</strong></h3>
                                        </div> 
                                        
                                        <div class="flex mt-1">
                                            <h3 class="mx-auto"><strong>Actif à court terme</strong></h3>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Encaisse (soldes de vos comptes chèques)" for="encaisse">Encaisse</label>
                                                <input type="number" step="any" name="encaisse" id="encaisse" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label title="Compte d’épargne" for="compte_d_epargne">Compte d’épargne</label>
                                                <input type="number" step="any" name="compte_d_epargne" id="compte_d_epargne" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            
                                            <div class="col mr-2 w-full">
                                                <label title="Obligations d’épargne" for="obligations_epargne">Obligations d’épargne</label>
                                                <input type="number" step="any" name="obligations_epargne" id="obligations_epargne" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Épargne à terme" for="epargne_terme_defini">Épargne à terme défini</label>
                                                <input type="number" step="any" name="epargne_terme_defini" id="epargne_terme_defini" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label title="Autres liquidités (Fonds de marché monétaire, bons du Trésor, etc.)" for="autres_liquidites">Autres liquidités</label>
                                                <input type="number" step="any" name="autres_liquidites" id="autres_liquidites" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                           
                                        </div> 

                                        <div class="flex mt-1">
                                            <h3 class="mx-auto"><strong>Placements non enregistrés</strong></h3>
                                        </div>

                                        <div class="flex mb-2">
                                           
                                            <div class="col mr-2 w-full">
                                                <label title="Épargne à terme indicielle" for="epargne_a_terme_indicielle">Épargne à terme indicielle</label>
                                                <input type="number" step="any" name="epargne_a_terme_indicielle" id="epargne_a_terme_indicielle" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Parts permanentes Desjardins" for="parts_permanentes_desjardins">Parts permanentes Desjardins</label>
                                                <input type="number" step="any" name="parts_permanentes_desjardins" id="parts_permanentes_desjardins" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label title="Obligations (ex. : obligations corporatives, coupons détachés, débentures). Ne pas inclure les obligations d’épargne." for="Obligations_obligations_corporatives_coupons_detaches_debentures">Obligations</label>
                                                <input type="number" step="any" name="Obligations_obligations_corporatives_coupons_detaches_debentures" id="Obligations_obligations_corporatives_coupons_detaches_debentures" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Fonds de placement" for="fonds_de_placement">Fonds de placement</label>
                                                <input type="number" step="any" name="fonds_de_placement" id="fonds_de_placement" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label title="Valeur de rachat d’assurances vie" for="Valeur_rachat_d_assurances_vie">Valeur de rachat d’assurances vie</label>
                                                <input type="number" step="any" name="Valeur_rachat_d_assurances_vie" id="Valeur_rachat_d_assurances_vie" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Capital régional et coopératif Desjardins" for="capital_regional_cooperatif_desjardins">Capital régional et coopératif Desjardins</label>
                                                <input type="number" step="any" name="capital_regional_cooperatif_desjardins" id="capital_regional_cooperatif_desjardins" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label title="Fonds des travailleurs (FTQ, CSN, etc.)" for="fonds_des_travailleurs">Fonds des travailleurs (FTQ, CSN, etc.)</label>
                                                <input type="number" step="any" name="fonds_des_travailleurs" id="fonds_des_travailleurs" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Régime d’épargne-actions (REA)" for="regime_epargne_actions_REA">Régime d’épargne-actions (REA)</label>
                                                <input type="number" step="any" name="regime_epargne_actions_REA" id="regime_epargne_actions_REA" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Fonds des travailleurs (FTQ, CSN, etc.)" for="fonds_des_travailleurs">Fonds des travailleurs (FTQ, CSN, etc.)</label>
                                                <input type="number" step="any" name="fonds_des_travailleurs" id="fonds_des_travailleurs" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Actions" for="Actions">Actions</label>
                                                <input type="number" step="any" name="Actions" id="Actions" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Autres placements non enregistrés" for="autre_placements_non_enregistres">Autres placements non enregistrés</label>
                                                <input type="number" step="any" name="autre_placements_non_enregistres" id="autre_placements_non_enregistres" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="flex mt-1">
                                            <h3 class="mx-auto"><strong>Régimes enregistrés</strong></h3>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Régime enregistré d’épargne-retraite (REER)" for="regime_enregistre_epargne_retraite_REER">Régime enregistré d’épargne-retraite (REER)</label>
                                                <input type="number" step="any" name="regime_enregistre_epargne_retraite_REER" id="regime_enregistre_epargne_retraite_REER" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Compte de retraite immobilisé (CRI) ou REER immobilisé" for="compte_de_retraite_immobilise_CRI_ou_REER_immobilise">Compte de retraite immobilisé (CRI) ou REER immobilisé</label>
                                                <input type="number" step="any" name="compte_de_retraite_immobilise_CRI_ou_REER_immobilise" id="compte_de_retraite_immobilise_CRI_ou_REER_immobilise" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Fonds enregistré de revenu de retraite (FERR)" for="fonds_enregistre_de_revenu_de_retraite_FERR">Fonds enregistré de revenu de retraite (FERR)</label>
                                                <input type="number" step="any" name="fonds_enregistre_de_revenu_de_retraite_FERR" id="fonds_enregistre_de_revenu_de_retraite_FERR" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Fonds de revenu viager (FRV)" for="fonds_de_revenu_viager_FRV">Fonds de revenu viager (FRV)</label>
                                                <input type="number" step="any" name="fonds_de_revenu_viager_FRV" id="fonds_de_revenu_viager_FRV" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div> 
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="régime enregistré d’épargne-études (REEE)" for="regime_enregistre_epargne_etudes_REEE">Régime enregistré d’épargne-études (REEE)</label>
                                                <input type="number" step="any" name="regime_enregistre_epargne_etudes_REEE" id="regime_enregistre_epargne_etudes_REEE" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Rente (viagère ou à échéance fixe)" for="rente_viagere_ou_a_echeance_fixe">Rente (viagère ou à échéance fixe)</label>
                                                <input type="number" step="any" name="rente_viagere_ou_a_echeance_fixe" id="rente_viagere_ou_a_echeance_fixe" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div> 
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Régime de pension agréé (caisse de retraite) " for="regime_de_pension_agree_caisse_de_retraite">Régime de pension agréé (caisse de retraite) </label>
                                                <input type="number" step="any" name="regime_de_pension_agree_caisse_de_retraite" id="regime_de_pension_agree_caisse_de_retraite" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Régime de participation différée aux bénéfices (RPDB)" for="regime_de_participation_differee_aux_benefices_RPDB">Régime de participation différée aux bénéfices (RPDB)</label>
                                                <input type="number" step="any" name="regime_de_participation_differee_aux_benefices_RPDB" id="regime_de_participation_differee_aux_benefices_RPDB" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Compte d’épargne libre d’impôt (CELI)" for="compte_pargne_libre_impot_CELI">Compte d’épargne libre d’impôt (CELI)</label>
                                                <input type="number" step="any" name="compte_pargne_libre_impot_CELI" id="compte_pargne_libre_impot_CELI" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Autres Régimes enregistrés" for="autres_regimes_enregistres">Autres Régimes enregistrés</label>
                                                <input type="number" step="any" name="autres_regimes_enregistres" id="autres_regimes_enregistres" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="flex mt-1">
                                            <h3 class="mx-auto"><strong>Biens personnels</strong></h3>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Meubles" for="meubles">Meubles</label>
                                                <input type="number" step="any" name="meubles" id="meubles" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Véhicules (auto, bateau, moto, motoneige, roulotte, motorisé, etc.)" for="vehicules_auto_bateau_moto_motoneige_roulotte_motorise">Véhicules (auto, bateau, moto, motoneige, roulotte, motorisé, etc.)</label>
                                                <input type="number" step="any" name="vehicules_auto_bateau_moto_motoneige_roulotte_motorise" id="vehicules_auto_bateau_moto_motoneige_roulotte_motorise" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Résidence principale" for="residence_principale">Résidence principale</label>
                                                <input type="number" step="any" name="residence_principale" id="residence_principale" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Résidences secondaires (chalet)" for="residences_secondaires_chalet">Résidences secondaires (chalet)</label>
                                                <input type="number" step="any" name="residences_secondaires_chalet" id="residences_secondaires_chalet" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Immeubles locatifs (à revenus)" for="immeubles_locatifs_a_revenus">Immeubles locatifs (à revenus)</label>
                                                <input type="number" step="any" name="immeubles_locatifs_a_revenus" id="immeubles_locatifs_a_revenus" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Terrains" for="terrains">Terrains</label>
                                                <input type="number" step="any" name="terrains" id="terrains" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Objets de collection" for="objets_de_collection">Objets de collection</label>
                                                <input type="number" step="any" name="objets_de_collection" id="objets_de_collection" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Oeuvres d’art" for="oeuvres_art">Oeuvres d’art</label>
                                                <input type="number" step="any" name="oeuvres_art" id="oeuvres_art" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Bijoux" for="bijoux">Bijoux</label>
                                                <input type="number" step="any" name="bijoux" id="bijoux" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Autres" for="autres_biens_personnels">Autres</label>
                                                <input type="number" step="any" name="autres_biens_personnels" id="autres_biens_personnels" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="flex items-center mt-3">
                                            <h3 class="mx-auto"><strong>Passifs</strong></h3>
                                        </div> 
                                        
                                        <div class="flex mt-1">
                                            <h3 class="mx-auto"><strong>Passif à court terme</strong></h3>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Cartes de crédit" for="cartes_de_credit">Cartes de crédit</label>
                                                <input type="number" step="any" name="cartes_de_credit" id="cartes_de_credit" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Marges de crédit" for="marges_de_credit">Marges de crédit</label>
                                                <input type="number" step="any" name="marges_de_credit" id="marges_de_credit" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Comptes à payer" for="comptes_a_payer">Comptes à payer</label>
                                                <input type="number" step="any" name="comptes_a_payer" id="comptes_a_payer" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="flex mt-1">
                                            <h3 class="mx-auto"><strong>Passif à moyen terme</strong></h3>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Prêts automobiles" for="prets_automobiles">Prêts automobiles</label>
                                                <input type="number" step="any" name="prets_automobiles" id="prets_automobiles" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="prêts personnels" for="prets_personnels">prêts personnels</label>
                                                <input type="number" step="any" name="prets_personnels" id="prets_personnels" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Autres passif à moyen terme" for="autres">Autres passif à moyen terme</label>
                                                <input type="number" step="any" name="autres_passif_a_moyen_terme" id="autres_passif_a_moyen_terme" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mt-1">
                                            <h3 class="mx-auto"><strong>Passif à long terme</strong></h3>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Prêts hypothécaire (résidence principale)" for="prets_hypothecaire_residence_principale">Prêts hypothécaire (résidence principale)</label>
                                                <input type="number" step="any" name="prets_hypothecaire_residence_principale" id="prets_hypothecaire_residence_principale" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Prêts hypothécaire (résidence secondaire)" for="prets_hypothecaire_residence_secondaire">Prêts hypothécaire (résidence secondaire)</label>
                                                <input type="number" step="any" name="prets_hypothecaire_residence_secondaire" id="prets_hypothecaire_residence_secondaire" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>


                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Prêts hypothécaire (immeubles locatifs)" for="prets_hypothecaire_immeubles_locatifs">Prêts hypothécaire (immeubles locatifs)</label>
                                                <input type="number" step="any" name="prets_hypothecaire_immeubles_locatifs" id="prets_hypothecaire_immeubles_locatifs" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Prêts pour investissement" for="prets_pour_investissement">Prêts pour investissement</label>
                                                <input type="number" step="any" name="prets_pour_investissement" id="prets_pour_investissement" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label title="Prêts étudiants" for="prets_etudiants">Prêts étudiants</label>
                                                <input type="number" step="any" name="prets_etudiants" id="prets_etudiants" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label title="Autres" for="autres">Autres Passifs à long terme</label>
                                                <input type="number" step="any" name="autres_passif_a_long_terme" id="autres" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
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
        fonction_de_recherche();
        disparition_table()
    
        function ajouter(){
            let adding = document.getElementById('adding_erea')
            adding.classList.remove("hidden")    
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")
            effacer_erreurs();
        }

        var formulaire_ajou = document.getElementById('formulaire_ajout');
        formulaire_ajou.addEventListener('submit', function(event) {
            event.preventDefault();
               var formData = new FormData(formulaire_ajou);
               var request = new XMLHttpRequest();
               request.open('POST', '/store_bilan');
               request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
               request.onreadystatechange = function() {
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        effacer_erreurs();
                        const response = JSON.parse(request.responseText);
                        if(response.libelleVide){
                            return toastr.info(response.libelleVide);
                        }
                        toastr.success('Bilan enregistré avec succès.');
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
    </script> 
@endsection