<div>
@if ($currentePage == 'PAGEISLISTE')
<div id="displaying_erea" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="mb-8"></div>
            <div class="col-span-12 card 2xl:col-span-12">
                <div class="card-body">
                    <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                        <div class="flex items-center">
                            <div class="2xl:col-span-3">
                                <h5 class="mr-2">Gestion des ventes</h5>
                            </div>
                            <button wire:click="goToAddVentes()" class="inline-block rounded-full bg-white transition-all duration-300 ease-in-out hover:bg-gray-400 active:bg-gray-500">
                                <i id="btn_ajouter" class="align-baseline ltr:pr-1 rtl:pl-1 ri-add-line text-lg text-black"></i>
                            </button>
                            
                            <a href="#" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
                                <i data-lucide="box" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                <span class="align-middle">Produits brutes</span>
                            </a>

                            <a href="#" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
                                <i class="fas fa-industry inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                <span class="align-middle">Produits transformés</span>
                            </a>                            
                           
                            <a href="#" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
                                <i data-lucide="briefcase" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                <span class="align-middle">Services</span>
                            </a>
                            
                        </div>                    
                        <div class="2xl:col-span-3 2xl:col-start-10">
                            <div class="flex gap-3">
                                <div class="relative grow">
                                    <input id="searchInput" class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Cherchez ici ..." autocomplete="off">
                                    <i data-lucide="search" class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                                </div>
                                {{-- <button  type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i class="align-baseline ltr:pr-1 rtl:pl-1 ri-download-2-line"></i>Importer</button> --}}
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
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Nombre produits</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Total à régler</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Total réglé</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reste à régler</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Heure de vente</th>
                                    {{-- <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Prix vente</th> --}}
                                    {{-- <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Montant reglé</th> --}}
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
                                    <tr>
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
                                                        <button type="button" wire:click.prevent="openModifier({{ $vente->id }})" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Modifier</span></button>
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
                                    <div id="aucunelement" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <strong class="font-bold">Vide!</strong>
                                        <span class="block sm:inline">Aucune vente aujourd'hui.</span>
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
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reference du produit</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Designation du produit</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Prix unitaire</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Quantité livrée</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Valeur totale</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Quantité vendue</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Somme à régler</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Somme réglée</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reste à régler</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Quantité invendue</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Valeur des invendues</th>
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
    </div>
@endif

@if ($currentePage == 'PAGEISADD')
    @if ($modalQuickAddNewClient)
        <div wire:ignore.self class="fixed inset-0 z-50 flex items-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="card fixed relative mx-auto bg-white rounded-lg shadow-lg p-6" style="margin-top:100px;">
                <form wire:submit.prevent="saveNewClient">
                    <div class="flex mb-2">
                        <div class="col mr-2 mt-4 w-full">
                            <input wire:model.live.debounce.250ms ="addNewClientInput" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Entrez un client">
                            <select multiple wire:model.live.debounce.250ms="clientSelect" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                <option selected disabled>Vous pouvez rechercher ou ajouter un client</option>
                                @foreach ($clientsNonPresents as $cl)
                                    <option value={{"$cl->id"}}>Nom: {{$cl->nom}}, Phone: {{$cl->phone}}, Email: {{$cl->email}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex mb-2">
                        <div class="col mr-2 w-full">
                            <label for="type">Type</label>
                            <select required @if ($disableInputs) disabled @endif wire:model="quickAddNewClient.type" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                <option value="Choisissez un type" disabled selected>Choisissez un type</option>
                                <option value="Entreprise">Entreprise</option>
                                <option value="Particulier">Particulier</option>
                            </select>
                            @error('quickAddNewClient.type') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                        </div>
                        <div class="col mr-2 w-full">
                            <label for="nom">Nom complet</label>
                            <input  @if($disableInputs) disabled @endif type="text" wire:model="quickAddNewClient.nom" id="nom_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                            @error('quickAddNewClient.nom') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex mb-2">
                        <div class="col mr-2 w-full">
                            <label for="adresse">Adresse </label>
                            <input @if ($disableInputs) disabled @endif type="text" wire:model="quickAddNewClient.adresse" id="adresse_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                            @error('quickAddNewClient.adresse') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                        </div>

                        <div class="col mr-2 w-full">
                            <label for="email">Email</label>
                            <input @if ($disableInputs) disabled @endif type="text" wire:model="quickAddNewClient.email" id="email_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                            @error('quickAddNewClient.email') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex mb-2">
                        <div class="col mr-2 w-full">
                            <label for="phone">Téléphone 1</label>
                            <input @if ($disableInputs) disabled @endif type="tel" wire:model="quickAddNewClient.phone" id="phone_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                            @error('quickAddNewClient.phone') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                        </div>

                        <div class="col mr-2 w-full">
                            <label for="seconde_phone">Téléphone 2</label>
                            <input @if ($disableInputs) disabled @endif type="tel" wire:model="quickAddNewClient.seconde_phone" id="seconde_phone_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                            @error('quickAddNewClient.seconde_phone') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                        </div>

                        <div class="col mr-2 w-full">
                            <label for="pays">Pays</label>
                            <input @if ($disableInputs) disabled @endif type="text" wire:model="quickAddNewClient.pays" id="pays_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                            @error('quickAddNewClient.pays') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex mb-2">
                        <div class="col mr-2 w-full">
                            <label for="region">Region</label>
                            <input  @if ($disableInputs) disabled @endif type="text" id="region_add" wire:model="quickAddNewClient.region" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Photo..." autocomplete="on">
                            @error('quickAddNewClient.region') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                        </div>
                        <div class="col mr-2 w-full">
                            <label for="departement">Departement</label>
                            <input @if ($disableInputs) disabled @endif type="tel" wire:model="quickAddNewClient.departement" id="departement_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                            @error('quickAddNewClient.departement') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                        </div>

                        <div class="col mr-2 w-full">
                            <label for="localite">Localité</label>
                            <input @if ($disableInputs) disabled @endif type="text" wire:model="quickAddNewClient.localite" id="localite_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                            @error('quickAddNewClient.localite') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end w-full">
                        <button type="button" wire:click="cencelNewClientModal()" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Annuler</button>
                        <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

        <div id="adding_erea" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="mb-8"></div>
                <div class=" transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                               <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form wire:submit.prevent="saveVente">
                                        <div class="flex mb-2">

                                            <div class="col mr-2 w-full">
                                                <label for="type_de_vente">Type de vente</label>
                                                <select wire:model="addVente.type_de_vente" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="" disabled selected hidden>Choisissez un type de vente</option>
                                                    <option value="LOCALE">Locale</option>
                                                    <option value="EXTERIEURE">Extérieur</option>
                                                </select>
                                                @error('addVente.type_de_vente') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col mr-2 w-full">

                                                <label for="moyen_payement_add">Moyen de payement</label>
                                                <select id="moyen_payement_add" wire:ignore.self wire:model="addVente.moyen_payement" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="" disabled selected hidden>Choisissir un moyen</option>
                                                    <option value="Payement BIICF">Payement BIICF</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Orange money">Orange money</option>
                                                    <option value="MTN money">MTN money</option>
                                                    <option value="Moov money">Moov money</option>
                                                    <option value="Cash">Wave</option>
                                                    <option value="Trasor money">Trasor money</option>
                                                </select>
                                                @error('addVente.moyen_payement') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="status_vente"></label>Status de la vente
                                                <select id="status_vente_add" wire:model="addVente.status_vente" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="" disabled hidden>Choisissir un status</option>
                                                    <option value="En attente">En attente</option>
                                                    <option selected value="Conifimée">Conifimée</option>
                                                    <option value="Annulée">Annulée</option>
                                                </select>
                                                @error('addVente.status_vente') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        
                                        <div id ="div_clients" class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="ligne_client_systeme">Client
                                                    <a wire:click="goToNewClientModal()" class="inline-block rounded-full bg-white transition-all duration-300 ease-in-out hover:bg-gray-400 active:bg-gray-500">
                                                        <i class="align-baseline ltr:pr-1 rtl:pl-1 ri-add-line text-lg text-black"></i>
                                                    </a>
                                                </label>
                                                <input wire:ignore.self wire:model.live.debounce.250ms="clientAcheteurInput" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Cherchez par reference ou par designation">
                                                <select multiple wire:ignore.self wire:model.live.debounce.250ms="clientAcheteurSelect" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="-1" selected disabled>Choisir un client</option>
                                                    @foreach ($clientsPresents as $clientsPresent)
                                                        <option value="{{$clientsPresent->id}}">{{$clientsPresent->client->nom}}, {{$clientsPresent->client->type}}, {{$clientsPresent->client->email}}, {{$clientsPresent->client->phone}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    
                                        <div class="produit-item mb-8">
                                            <div class="flex mb-2">
                                                <div class="col mr-2 w-full">
                                                    <label for="element_a_vendre"></label>Produit
                                                    <input wire:ignore.self onchange="handleSelectChange()" wire:model="productsToAdd.0.produitsInput" class="element_a_vendre_input row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Cherchez par reference ou par designation">
                                                    <select wire:ignore.self multiple wire:model.live="productsToAdd.0.produitsSelect" class="element_a_vendre_selecte ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                        <option value="-1" selected disabled>Choisir un client</option>
                                                        @foreach ($produitsPresents as $produitsPresent)
                                                            <option value="{{$produitsPresent->id}}">{{$produitsPresent->produit->reference}}, {{$produitsPresent->produit->categorie->nom}}, {{$produitsPresent->produit->designation}}</option>
                                                        @endforeach
                                                    </select>
                                                @error('productsToAdd.0.produitsSelect') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="flex mb-2">
                                                <div class="div_quantite_envoyee col mr-2 w-full">
                                                    <label for="quantite_envoyee">Quantité livrée</label>
                                                    <input type="number" wire:model="productsToAdd.0.quantite_envoyee" class="quantite_envoyee ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                    @error('productsToAdd.0.quantite_envoyee') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="col mr-2 w-full">
                                                    <label for="quantite_vendue">Quantité vendue</label>
                                                    <input type="number" wire:model="productsToAdd.0.quantite_vendue" class="quantite_vendue ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                    @error('productsToAdd.0.quantite_vendue') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                                </div>   
                                                <div class="col mr-2 w-full">
                                                    <label for="prix_vente">Prix de vente</label>
                                                    <input disabled type="number" wire:model="productsToAdd.0.prix_vente"  class="prix_vente ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                    @error('productsToAdd.0.prix_vente') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="flex mb-2">
                                                <div class="col mr-2 w-full">
                                                    <label for="montant_regle">Montant réglé</label>
                                                    <input type="number" wire:model="productsToAdd.0.montant_regle" class="montant_regle ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                    @error('productsToAdd.0.montant_regle') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        @foreach ($productContainers as $key => $value)
                                            @php
                                                $counter = $key+1;
                                                
                                            @endphp
                                            <div class="produit-item mb-8">
                                                <div class="flex mb-2">
                                                    <div class="col mr-2 w-full">
                                                        <label for="element_a_vendre"></label>Produit
                                                        <input wire:model="productsToAdd.{{$counter}}.produitsInput" class="element_a_vendre_input row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Cherchez par reference ou par designation">
                                                        <select wire:ignore.self multiple value="" wire:model="productsToAdd.{{$counter}}.produitsSelect" class="element_a_vendre_selecte ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                            <option value="-1" selected disabled>Choisir un client</option>
                                                            @foreach ($produitsPresents as $produitsPresent)
                                                                <option value="{{$produitsPresent->id}}">{{$produitsPresent->produit->reference}}, {{$produitsPresent->produit->categorie->nom}}, {{$produitsPresent->produit->designation}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('productsToAdd.' . $counter . '.produitsSelect') 
                                                            <span class="error text-red-500 ">{{ $message }}</span> 
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="flex mb-2">
                                                    <div class="div_quantite_envoyee col mr-2 w-full">
                                                        <label for="quantite_envoyee">Quantité livrée</label>
                                                        <input type="number" wire:model="productsToAdd.{{$counter}}.quantite_envoyee" class="quantite_envoyee ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                        @error('productsToAdd.{{$counter}}.quantite_envoyee') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="col mr-2 w-full">
                                                        <label for="quantite_vendue">Quantité vendue</label>
                                                        <input type="number" wire:model="productsToAdd.{{$counter}}.quantite_vendue" class="quantite_vendue ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                        @error('productsToAdd.' . $counter . '.produitsSelect') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                                    </div>   
                                                    <div class="col mr-2 w-full">
                                                        <label for="prix_vente">Prix de vente</label>
                                                        <input disabled type="number" wire:model="productsToAdd.{{$counter}}.prix_vente"  class="prix_vente ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                        @error('productsToAdd.' . $counter . '.produitsSelect') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="flex mb-2">
                                                    <div class="col mr-2 w-full">
                                                        <label for="montant_regle">Montant réglé</label>
                                                        <input type="number" wire:model="productsToAdd.{{$counter}}.montant_regle" class="montant_regle ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                        @error('productsToAdd.' . $counter . '.produitsSelect') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="flex mb-2">
                                                    <button class="error text-red-500" type="button" wire:click="removeProduct({{$key}})"> - Supprimer</button>
                                                </div>
                                                <br>
                                            </div>
                                                
                                        @endforeach

                                        @if (!$addMoreProductBtnHide)
                                            <div class="flex mb-2">
                                                <button type="button" wire:click="addMoreProduct({{$productContainersCount}})">+ Ajouter un produit</button>
                                            </div>
                                        @endif

                                        <div class="flex justify-end w-full">
                                        <button type="button" wire:click="goToListVentes()" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Retour</button>
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
        </div>
    @endif
    

@if ($currentePage == 'PAGEISEDITE')
    <div id="modifying_erea" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="mb-8"></div> 
                <div class="transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form id="formulaire_modif" wire:submit.prevent="edite" >
                                        <input class="hidden" type="text" name="vente_id" id="vente_id">
                                        
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="reference">Reference</label>
                                                <input required type="text"  wire:model="editeVente.reference" disabled name="reference" id="reference_modif" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                                @error('editeVente.reference') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="moyen_payement">Moyen payement </label>
                                                <select required id="moyen_payement_modif"  wire:model="editeVente.moyen_payement" name="moyen_payement" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="" disabled selected hidden>Choisissir ici...</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Virement bancaire">Virement bancaire</option>
                                                    <option value="Orange money">Orange money</option>
                                                    <option value="Moov money">Moov money</option>
                                                    <option value="MTN money">MTN money</option>
                                                    <option value="Wave">Wave</option>
                                                    <option value="Trasor money">Trasor money</option>
                                                </select>
                                                @error('editeVente.moyen_payement') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="status_vente">Status vente</label>
                                                <select required id="status_vente_modif"  wire:model="editeVente.status_vente" name="status_vente" class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                    <option value="" disabled selected hidden>Choisissir ici...</option>
                                                    <option value="En attente">En attente</option>
                                                    <option value="Conifimée">Conifimée</option>
                                                    <option value="Annulée">Annulée</option>
                                                </select>
                                                @error('editeVente.status_vente') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="flex justify-end w-full">
                                            <button type="button" wire:click="goToListVentes()" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Retour</button>
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
@endif
    

<script>
    document.addEventListener('DOMContentLoaded', function () {
        messages('editedVente', 'success', 'Modification reussie!');
        messages('newClientAddSuccess', 'success', 'Client defini avec succès!');
        messages('duplicaionDeClient', 'warning', 'Ce client est déjà enregistré!');
        messages('ok', 'info', 'Le ok est la hein...');
    });
</script>
</div>

