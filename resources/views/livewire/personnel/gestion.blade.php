<div>
    @if (isset($solvabilite) && isset($grade) && isset($tendances))
        <p><strong>Note de solvabilité :</strong> {{ $solvabilite }}</p>
        <p><strong>Grade :</strong> {{ $grade }}</p>

        <h2>Tendances des Ratios :</h2>
        <ul>
            @foreach ($tendances as $ratio => $valeur)
                <li><strong>{{ $ratio }} :</strong> {{ $valeur }}</li>
            @endforeach
        </ul>
    @else
        <p>⚠️ Données de solvabilité non disponibles.</p>
    @endif

    @if ($isOpenModifPage)
        <div
            class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
            <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
                <div class="flex justify-center items-center mb-2 mt-2">
                    <h1 class="flex justify-center items-center text-black text-5xl">Modifier un agent</h1>
                </div>
                <div id="add_personnel_modal" class="hiddnen transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form wire:submit.prevent="confimModification">
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="nom">Nom </label>
                                                <input required wire:model="nom" type="text" name="nom"
                                                    class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    placeholder="Nom..." autocomplete="on">
                                                @error('nom')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col w-full">
                                                <label for="prenom">Prenom </label>
                                                <input required wire:model="prenom" type="text" name="prenom"
                                                    class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full"
                                                    placeholder="Prénom..." autocomplete="on">
                                                @error('prenom')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="matricule">Matricule </label>
                                                <input required wire:model="matricule" type="text" name="matricule"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    placeholder="Matricule..." autocomplete="on">
                                                @error('matricule')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="tel">Téléphone</label>
                                                <input wire:model="tel" type="text" name="tel"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    placeholder="Téléphone..." autocomplete="on">
                                                @error('tel')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="date_de_naissance">Date de naissance </label>
                                                <input wire:model="date_de_naissance" type="date"
                                                    name="date_de_naissance"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    placeholder="Date de naissance..." autocomplete="on">
                                                @error('date_de_naissance')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="lieu_de_naissance">Lieu de naissance </label>
                                                <input wire:model="lieu_de_naissance" type="text"
                                                    name="lieu_de_naissance"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full"
                                                    placeholder="Lieu de naissance..." autocomplete="on">
                                            </div>
                                            @error('lieu_de_naissance')
                                                <span class="error text-red-500 ">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="situation_matrimoniale">Situation matrimoniale</label>
                                                <select wire:model="situation_matrimoniale" required
                                                    name="situation_matrimoniale"
                                                    class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    placeholder="Situation matrimoniale" autocomplete="on">
                                                    <option value="" selected>Choisir ici</option>
                                                    <option value="Célibataire">Célibataire</option>
                                                    <option value="Marié">Marié</option>
                                                    <option value="Divorcé">Divorcé</option>
                                                    <option value="Veuf">Veuf</option>
                                                </select>
                                                @error('situation_matrimoniale')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="nombre_enfants">Nombre d'enfants</label>
                                                <input required wire:model="nombre_enfants" type="text"
                                                    name="nombre_enfants"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    placeholder="Nombre d'enfants..." autocomplete="on">
                                                @error('nombre_enfants')
                                                    <span class="error text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="titre_poste">Titre de poste</label>
                                                <input required wire:model="titre_poste" type="text"
                                                    name="titre_poste"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    placeholder="Titre de poste..." autocomplete="on">
                                                @error('titre_poste')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="date_recrutement">Date de recrutement</label>
                                                <input wire:model="date_recrutement" type="date"
                                                    name="date_recrutement"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    placeholder="Date de recrutement..." autocomplete="on">
                                                @error('date_recrutement')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="num_cnps">Numéro cnps</label>
                                                <input required wire:model="num_cnps" type="text" name="num_cnps"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    placeholder="Numéro CNPS..." autocomplete="on">
                                                @error('num_cnps')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="num_cnps">Photo</label>
                                                <div class="row">
                                                    <input wire:model="photo" type="file" name="photo"
                                                        accept=".png, .jpeg, .jpg"
                                                        class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full"
                                                        placeholder="Photo..." autocomplete="on">
                                                    @error('photo')
                                                        <span class="error text-red-500 ">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex justify-between w-full">
                                            @if ($concernedPerson)
                                                <img class="w-10 h-10 rounded-full"
                                                    src="{{ asset('storage/' . $concernedPerson->photo) }}"
                                                    alt="Default avatar">
                                            @endif
                                            <div class="flex justify-end w-full">
                                                <button id="refresh" type="button" wire:click="annuler"
                                                    class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Annuler</button>
                                                <button type="submit"
                                                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Modifier</button>
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
    @elseif ($isOpenAccueil)
        <div>
            <div
                class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
                <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
                    <div class="flex justify-center items-center mb-2 mt-2">
                        <h1 class="flex justify-center items-center text-black text-5xl">Liste des agents</h1>
                    </div>
                    <div class="col-span-12 card 2xl:col-span-12">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="flex items-center">
                                    <div class="2xl:col-span-3">
                                        <h5 class="mr-2">Ajouter un agent</h5>
                                    </div>
                                    <a href="{{ route('add_personnel') }}"
                                        class="inline-block rounded-full bg-white transition-all duration-300 ease-in-out hover:bg-gray-400 active:bg-gray-500">
                                        <i id="btn_ajouter"
                                            class="align-baseline ltr:pr-1 rtl:pl-1 ri-add-line text-lg text-black"></i>
                                    </a>
                                </div>
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <div class="flex gap-3">
                                        <div class="relative grow">
                                            <input id="searchInput"
                                                class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                placeholder="Cherchez ici ..." autocomplete="off">
                                            <i data-lucide="search"
                                                class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                                        </div>
                                        <button type="button"
                                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i
                                                class="align-baseline ltr:pr-1 rtl:pl-1 ri-download-2-line"></i>Importer</button>
                                        <button type="button"
                                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i
                                                class="align-baseline ltr:pr-1 rtl:pl-1 ri-upload-2-line"></i>Exporter</button>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table id="personnelTable" class="w-full whitespace-nowrap">
                                    <thead
                                        class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
                                        <tr>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                N°
                                            </th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                Matricule</th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                Nom</th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                Prénom</th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                Date naiss.</th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                Date recru.</th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                Lieu naiss.</th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                Poste</th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                n° cnps</th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                Secteur intervention</th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                Situation matrimoniale</th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                Nombre enfants</th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                Nationalité</th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                Téléphone</th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                                Photo</th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500 text-center">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="contenu">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($people as $person)
                                            <tr>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ ++$i }}</td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    <a href="#">{{ $person->matricule }}</a></td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ $person->nom }}</td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ $person->prenom }}</td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ $person->date_de_naissance }}</td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ $person->date_recrutement }}</td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ $person->lieu_de_naissance }}</td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ $person->titre_poste }}</td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ $person->num_cnps }}</td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ $person->secteurIntervention }}</td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ $person->situation_matrimoniale }}</td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ $person->nombre_enfants }}</td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ $person->Nationalite }}</td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ $person->tel }}</td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    @if ($person->photo)
                                                        <img class="w-10 h-10 rounded-full"
                                                            src="{{ asset('storage/' . $person->photo) }}"
                                                            alt="Default avatar">
                                                    @else
                                                        <div
                                                            class="relative w-10 h-10 flex items-center justify-center overflow-hidden bg-gray rounded-full dark:bg-gray-600">
                                                            <svg class="absolute w-12 h-12 text-gray-400"
                                                                fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                style="left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                    <a title="Payer ce salarié..."
                                                        wire:click="openPayment({{ $person->id }})" href="#"
                                                        class="px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zinc-100 dark:hover:bg-zinc-500 dark:hover:text-zinc-200 dark:focus:bg-zinc-500 dark:focus:text-zinc-200"><i
                                                            class="fas fa-credit-card inline-block size-3 ltr:mr-1 rtl:ml-1"></i></a>
                                                    <a title="Modifier ce salarié..."
                                                        wire:click="openModifier({{ $person->id }})" href="#!"
                                                        class="px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zinc-100 dark:hover:bg-zinc-500 dark:hover:text-zinc-200 dark:focus:bg-zinc-500 dark:focus:text-zinc-200"><i
                                                            class="fas fa-edit inline-block size-3 ltr:mr-1 rtl:ml-1"></i></a>
                                                    <a title="Supprimer ce salarié..."
                                                        wire:click="deletePerson({{ $person->id }})"
                                                        wire:confirm="Etes-vous sur de vouloir confirmer la suppression? Cette action est irreversible!"
                                                        href="#!"
                                                        class="px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zinc-100 dark:hover:bg-zinc-500 dark:hover:text-zinc-200 dark:focus:bg-zinc-500 dark:focus:text-zink-200"><i
                                                            class="fas fa-trash inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                                        <span class="align-middle"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex flex-col items-center mt-5 md:flex-row">
                                <div class="mb-4 grow md:mb-0">
                                    <p class="text-slate-500 dark:text-zink-200"></p>
                                </div>
                                <ul class="flex flex-wrap items-center gap-2 shrink-0">
                                    <li>
                                        <a href="#!"
                                            class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto"><i
                                                class="mr-1 size-4 rtl:rotate-180" data-lucide="chevron-left"></i>
                                            Pré</a>
                                    </li>
                                    <li>
                                        <a href="#!"
                                            class="inline-flex items-center justify-center bg-white dark:bg-zink-700 w-8 h-8 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">1</a>
                                    </li>
                                    <li>
                                        <a href="#!"
                                            class="inline-flex items-center justify-center bg-white dark:bg-zink-700 w-8 h-8 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto active">2</a>
                                    </li>
                                    <li>
                                        <a href="#!"
                                            class="inline-flex items-center justify-center bg-white dark:bg-zink-700 w-8 h-8 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">3</a>
                                    </li>
                                    <li>
                                        <a href="#!"
                                            class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">Suiv<i
                                                class="ml-1 size-4 rtl:rotate-180"
                                                data-lucide="chevron-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($isOpenPayement)
        <div
            class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
            <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
                <div class="flex justify-center items-center mb-2 mt-2">
                    <h1 class="flex justify-center items-center text-black text-5xl">Payement du salarié
                        {{ $concernedPerson->nom }} {{ $concernedPerson->prenom }}</h1>
                </div>
                <div id="add_personnel_modal" class="hiddnen transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form wire:submit.prevent="confimPaie">
                                        <label class="mr-12 ">Période de paiement</label>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label class="mr-6">Du</label>
                                                <input
                                                    class="mr-6 ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    wire:model="du" type="date">
                                                <label class="mr-6">Au</label>
                                                <input
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    wire:model="au" type="date">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="salaireCategoriel">Salaire Categoriel</label>
                                                <input required wire:model="salaireCategoriel" disabled
                                                    id="salaireCategoriel" type="text" name="salaireCategoriel"
                                                    class="row 
                                                ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    placeholder="Salaire de base..." autocomplete="on">
                                                @error('salaireCategoriel')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col w-full">
                                                <label for="nombrePart">Nombre de parts</label>
                                                <input required wire:model="nombrePart" type="text" disabled
                                                    name="nombrePart"
                                                    class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full"
                                                    placeholder="Nombre de parts..." autocomplete="on">
                                                @error('nombrePart')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="primeTransport">Prime de Transport </label>
                                                <input required wire:model="primeTransport" type="text"
                                                    name="primeTransport"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    placeholder="Prime de transport..." autocomplete="on">
                                                @error('primeTransport')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="tauxAccidentTravail">Taux d'accident de travail</label>
                                                <input wire:model="tauxAccidentTravail" type="number" step="any"
                                                    disabled name="tauxAccidentTravail"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    placeholder="Taux d'accident de travail..." autocomplete="on">
                                                @error('tauxAccidentTravail')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="anciennete">Ancienneté</label>
                                                <input wire:model="anciennete" type="number" step="any" disabled
                                                    name="anciennete"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                                    placeholder="Ancienneté..." autocomplete="on">
                                                @error('anciennete')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="primeAnciennete">Prime d'ancienneté</label>
                                                <input wire:model="primeAnciennete" type="number" step="any"
                                                    disabled name="primeAnciennete"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full"
                                                    placeholder="Prime d'ancienneté..." autocomplete="on">
                                                @error('primeAnciennete')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="cotisationCmuPartSalariale">Cotisation CMU</label>
                                                <input wire:model="cotisationCmuPartSalariale" type="number"
                                                    step="any" name="cotisationCmuPartSalariale"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full"
                                                    placeholder="Cotisation CMU Part Salariale..." autocomplete="on">
                                                @error('cotisationCmuPartSalariale')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="autresAvantages">Autre avantage</label>
                                                <input wire:model="autresAvantages" type="number" step="any"
                                                    id="autresAvantages" step="any" name="autresAvantages"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full"
                                                    placeholder="Autre avantage..." autocomplete="on">
                                                @error('autresAvantages')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="sursalaire">Sursalaire</label>
                                                <input wire:model="sursalaire" type="number" step="any"
                                                    name="sursalaire"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full"
                                                    placeholder="Sursalaire..." autocomplete="on">
                                                @error('sursalaire')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="flex mb-2">

                                            <div class="col mr-2 w-full">
                                                <label for="salaireBrut">Salaire brut</label>
                                                <input required wire:model="salaireBrut" type="text" disabled
                                                    id="salaireBrut" name="salaireBrut"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                @error('salaireBrut')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="salaireBrutImposable">Salaire brut imposable</label>
                                                <input required wire:model="salaireBrutImposable" type="text"
                                                    disabled id="salaireBrutImposable" name="salaireBrutImposable"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                @error('salaireBrutImposable')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="impotBrut">Impôt brut avant RICF</label>
                                                <input required wire:model="impotBrut" type="text" disabled
                                                    id="impotBrut" name="impotBrut"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                @error('impotBrut')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="ricf">RIFC</label>
                                                <input wire:model="ricf" type="number" step="any" disabled
                                                    name="ricf"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full"
                                                    placeholder="RICF..." autocomplete="on">
                                                @error('ricf')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="retenu_ITS">Retenu ITS</label>
                                                <input wire:model="retenu_ITS" type="number" step="any" disabled
                                                    name="retenu_ITS"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full"
                                                    placeholder="Retenue ITS..." autocomplete="on">
                                                @error('retenu_ITS')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col mr-2 w-full">
                                                <label for="salaire_Net">Salaire Net </label>
                                                <input required wire:model="salaire_Net" disabled type="text"
                                                    name="salaire_Net"
                                                    class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                                @error('salaire_Net')
                                                    <span class="error text-red-500 ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="flex justify-between w-full">
                                            <div class="flex justify-end w-full">
                                                <button title="Abandonner la paie" id="refresh" type="button"
                                                    wire:click="annuler"
                                                    class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Annuler</button>
                                                <button title="Simuler la paie" type="button" wire:click="simuler"
                                                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 mr-2">Simuler</button>
                                                <button title="Confirmer la paie" type="submit"
                                                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Comfirmer</button>
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
    @endif

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let searchTerm = this.value.toLowerCase();
            filterResults(searchTerm)
        });

        function filterResults(searchTerm) {
            let tableau = document.getElementById('personnelTable');
            let rows = tableau.querySelectorAll('tbody tr:not(.font-semibold)');
            rows.forEach(row => {
                let matricule = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                let nom = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                let prenom = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                let date_de_naissance = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
                let date_de_recrutement = row.querySelector('td:nth-child(6)').textContent.toLowerCase();
                let lieu_de_naissance = row.querySelector('td:nth-child(7)').textContent.toLowerCase();
                let titre_poste = row.querySelector('td:nth-child(8)').textContent.toLowerCase();
                let numCnps = row.querySelector('td:nth-child(9)').textContent.toLowerCase();
                let tel = row.querySelector('td:nth-child(10)').textContent.toLowerCase();
                if (nom.includes(searchTerm) || prenom.includes(searchTerm) || matricule.includes(searchTerm) ||
                    numCnps.includes(searchTerm) || tel.includes(searchTerm) || date_de_naissance.includes(
                        searchTerm) || lieu_de_naissance.includes(searchTerm) || date_de_recrutement.includes(
                        searchTerm) || titre_poste.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>

</div>
