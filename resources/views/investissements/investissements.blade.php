@extends('layouts.master')

@section('content')
    <div id="displaying_erea" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Liste des investissements</h1>
            </div>
            <div id="modalDiv" class="hidden fixed inset-0 z-50 flex items-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
                <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
                <div class="card relative mx-auto mt-12 bg-white rounded-lg shadow-lg max-w-lg p-6">
                    <div class="flex justify-center items-center">
                        <div class="text-center">
                            Ajouter un payement
                        </div>
                    </div>
                    <form id="payement">
                        <div class="flex mb-2 mt-2">
                            <input hidden type="number" name="idDette">
                            <div class="col mr-2 w-full">
                                <label for="montantARegler">Montant</label>
                                <input placeholder="Saisir le montant ici..." name="montantARegler" id="montantARegler" type="number" step="any" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" autocomplete="off">
                            </div>
                        </div>
                        <div class="flex mb-2 mt-2">
                            <div class="col mr-2 w-full">
                                <label for="reference">Reference de payement</label>
                                <input placeholder="Saisir la reference de payement ici..." name="reference" id="reference" type="text" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" autocomplete="off">
                            </div>
                            <div class="col mr-2 w-full">
                                <label for="fichier_joint">Ou/Et fichier de payement</label>
                                <input name="fichier_joint" id="fichier_joint" type="file" accept=".pdf,.png,.jpeg,.jpg" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                            </div>
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
                                <h5 class="mr-2">Investissements</h5>
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
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Date d'acquisition</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Durée de vie</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Valeur totale en {{session('devise')}}</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Valeur reglée en {{session('devise')}}</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reste</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Status</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ( $investissements as $investissement)
                                    @php
                                        $reste = $investissement->montant - $investissement->montant_paye;
                                    @endphp
                                    <tr
                                        data-id= "{{ $investissement->id}}"
                                        data-type="{{ $investissement->type }}"
                                        data-categorie="{{ $investissement->categorie }}"
                                        data-libelle="{{ $investissement->libelle }}"
                                        data-montant="{{ $investissement->montant }}"
                                        data-date_acquisition="{{ $investissement->date_acquisition }}"
                                        data-duree_de_vie="{{$investissement->duree_de_vie }}"
                                        data-montant_paye="{{$investissement->montant_paye }}"
                                    >
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{++$i}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$investissement->type}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$investissement->categorie}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$investissement->libelle}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$investissement->date_acquisition}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                            @if ($investissement->duree_de_vie == 1)
                                            {{$investissement->duree_de_vie}} an</td>
                                            @elseif ($investissement->duree_de_vie>1)
                                            {{$investissement->duree_de_vie}} ans</td>
                                            @endif
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$investissement->montant}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$investissement->montant_paye}}</td>
                                            @if ($reste == 0)
                                                <td class="text-green-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ">{{$reste}}</td>
                                                <td class="text-green-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">Totalement réglé</td>
                                            @elseif ($reste > 0)
                                                <td class="text-red-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ">{{$reste}}</td>
                                                <td class="text-red-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">En cours de reglement</td>
                                            @endif

                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                            <div class="relative dropdown">
                                                <button id="orderAction1" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20 w-20"><i data-lucide="more-horizontal" class="size-4"></i></button>
                                                <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction1">
                                                        @if($reste != 0)
                                                            <li>
                                                                <a onclick="payement(event, 'investissement')" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!"><i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Payement</span></a>
                                                            </li> 
                                                        @endif
                                                        <li>
                                                            <button type="button" onclick="modifier()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Modifier</span></button>
                                                        </li>
                                                        <li>
                                                            <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="{{ route('investissement.delete', ['id' => $investissement->id]) }}" onclick="return confirm('Cette action est irreversible! Êtes-vous sûr de vouloir éffectuer la suppression ?')"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Supprimer</span></a> 
                                                        </li>
                                                    </ul>
                                            </div>
                                        </td>
                                        </tr>
                                @endforeach 
                                @if($i == 0)
                                    <div id="aucunelement" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <strong class="font-bold">Vide!</strong>
                                        <span class="block sm:inline">Vos investissements s'affichent ici...</span>
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
                <h1 class="flex justify-center items-center text-black text-5xl">Ajouter un investissement</h1>
            </div>  
            <div class=" transition-opacity duration-500">
                <div class="col-span-12 card 2xl:col-span-12 ">
                    <div class="card-body">
                        <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                            <div class="2xl:col-span-3 2xl:col-start-10">
                                <form id="formulaire_ajout">
                                    <div class="flex mb-2">
                                        <div class="col mr-2 w-full">
                                            <label for="type">Type</label>
                                            <select type="text" name="type" id="type" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                <option selected disabled>Choisir ici</option>
                                            </select>
                                        </div>
                                        <div class="col mr-2 w-full">
                                            <label for="categorie">Catégorie</label>
                                            <select type="text" name="categorie" id="categorie" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                <option selected disabled>Choisir ici</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex mb-2">
                                        <div class="col mr-2 w-full">
                                            <label for="libelle">Libellé</label>
                                            <select type="text" name="libelle" id="libelle" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                <option selected disabled>Choisir ici</option>
                                            </select>
                                        </div>
                                        <div class="col mr-2 w-full">
                                            <label for="montant">Valeur totale en {{session('devise')}}</label>
                                            <input required type="number" name="montant" id="montant" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                        </div> 
                                        
                                        <div class="col mr-2 w-full">
                                            <label for="montant_paye">Valeur règlée en {{session('devise')}}</label>
                                            <input required type="number" name="montant_paye" id="montant_paye" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                        </div>
                                    </div>
                                    
                                    <div id="dateetduree" class="hidden flex mb-2">
                                        <div class="col mr-2 w-full">
                                            <label for="date_acquisition">Date d'acquisition</label>
                                            <input type="date" name="date_acquisition" id="date_acquisition" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                        </div>
                                        <div class="col mr-2 w-full">
                                            <label for="duree_de_vie">Durée de vie (années)</label>
                                            <input type="number" name="duree_de_vie" id="duree_de_vie" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                        </div>
                                    </div>
                                    
                                    <div id="sections_container" class="hidden border-t p-2 pt-5 mt-10">
                                            
                                    </div>
                                    

                                    <div class="flex justify-between w-full">
                                        <div class="flex mb-2" id="ajouter_date_payement_div">
                                            <button title="Ajouter une date de reglement" style="background-color:blue; color:white;" type="button" id="ajouter_date_payement" class="ajouter_date_payement btn"><strong>+</strong></button>
                                        </div>
                                        <div class="flex justify-end w-full">
                                            <button type="button" onclick="afficher()" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Annuler</button>
                                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Valider</button>
                                        </div> 
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
                <h1 class="flex justify-center items-center text-black text-5xl">Modifier un investissement</h1>
            </div>  
                <div class="transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form id="formulaire_modif">
                                        <input class="hidden" type="text" name="id_investissement" id="id_investissement">
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="type">Type</label>
                                                <input readonly type="text" name="type" id="type_modify" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="categorie">Catégorie</label>
                                                <input readonly type="text" name="categorie" id="categorie_modify" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                            </div>
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="libelle">Libellé</label>
                                                <input readonly type="text" name="libelle" id="libelle_modify" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="montant">Valeur totale en {{session('devise')}}</label>
                                                <input required type="number" name="montant" id="montant_modify" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>


                                            <div class="col mr-2 w-full">
                                                <label for="montant_paye_modify">Valeur règlée en {{session('devise')}}</label>
                                                <input required type="number" name="montant_paye_modify" id="montant_paye_modify" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>


                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="date_acquisition">Date d'acquisition</label>
                                                <input type="date" name="date_acquisition" id="date_acquisition_modif" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="duree_de_vie">Durée de vie (années)</label>
                                                <input type="number" name="duree_de_vie" id="duree_de_vie_modif" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="off">
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

        
        function toggleDateEtDuree(){
            document.getElementById("type").addEventListener('change', function(){
                this.value === "Circulant" ? document.getElementById('dateetduree').classList.add('hidden') : document.getElementById('dateetduree').classList.remove('hidden');
            })
        }

        fonction_de_recherche();
        disparition_table()
        function ajouter(){
            let adding = document.getElementById('adding_erea')
            adding.classList.remove("hidden")    
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")
            effacer_erreurs();
            chargerElementInvestissementsJson();
            toggleDateEtDuree();
            addReglementFutureSection();
        }
        
        function modifier(){
            let modifying = document.getElementById('modifying_erea')
            modifying.classList.remove("hidden")    
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")
            let trElement = event.target.closest('tr');
    
            const categorie = trElement.getAttribute('data-categorie');
            const type = trElement.getAttribute('data-type');
            const id_investissement = trElement.getAttribute('data-id');
            const libelle = trElement.getAttribute('data-libelle');
            const montant = trElement.getAttribute('data-montant');
            const date_acquisition = trElement.getAttribute('data-date_acquisition');
            const duree_de_vie = trElement.getAttribute('data-duree_de_vie');
            const montant_paye = trElement.getAttribute('data-montant_paye');

            const formulaire = document.getElementById('formulaire_modif');
            formulaire.querySelector('input[name="categorie"]').value = categorie;
            formulaire.querySelector('input[name="type"]').value = type;
            formulaire.querySelector('input[name="id_investissement"]').value = id_investissement;
            formulaire.querySelector('input[name="libelle"]').value = libelle;
            formulaire.querySelector('input[name="montant"]').value = montant;
            formulaire.querySelector('input[name="duree_de_vie"]').value = duree_de_vie;
            formulaire.querySelector('input[name="montant_paye_modify"]').value = montant_paye;
            formulaire.querySelector('input[name="date_acquisition"]').value = date_acquisition;
        }
    
       
        var formulaire_ajou = document.getElementById('formulaire_ajout');
        formulaire_ajou.addEventListener('submit', function(event) {
            event.preventDefault();
               var formData = new FormData(formulaire_ajou);
               var request = new XMLHttpRequest();
               request.open('POST', '/store_investissement');
               request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
               request.onreadystatechange = function() {
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        effacer_erreurs();
                        const response = JSON.parse(request.responseText);
                        if(response.libelleVide){
                            return toastr.info(response.libelleVide);
                        } 
                        
                        if(response.erreurMontantPaye){
                            return toastr.info(response.erreurMontantPaye);
                        } 
                        
                        if(response.erreurDuree){
                            return toastr.info(response.erreurDuree);
                        }
                        toastr.success("Ajout éffectué avec succès");
                    } else {
                        var response = JSON.parse(request.responseText);
                        if (response.errors) {
                           effacer_erreurs();
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
        });
      
        var formulaire_modif = document.getElementById('formulaire_modif');
        formulaire_modif.addEventListener('submit', function(event) {
            event.preventDefault();
            var data_to_modify = new FormData(formulaire_modif);
            var request = new XMLHttpRequest();
            request.open('POST', '/edit_investissement');
            request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            request.onreadystatechange = function() {
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        let response = JSON.parse(request.responseText);
                        effacer_erreurs();
                        if(response.erreurMontantPaye){
                            return toastr.info(response.erreurMontantPaye);
                        } 
                        toastr.success('Charge modifiée avec succès!');
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