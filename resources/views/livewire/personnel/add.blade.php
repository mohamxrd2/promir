<div
    class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    {!! Toastr::message() !!}
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex justify-center items-center mb-2 mt-2">
            <h1 class="flex justify-center items-center text-black text-5xl">Ajouter un agent</h1>
        </div>
        <div id="add_personnel_modal" class="hiddnen transition-opacity duration-500">
            <div class="col-span-12 card 2xl:col-span-12 ">
                <div class="card-body">
                    <div>
                        <marquee behavior="scoll" direction="left">Certaines entreprises ont des travailleurs sans
                            matricule de travail prédéfini. Il peut s'agir de trés petites entreprises. Si c'est votre
                            cas et que cet agent n'a pas de matricule prédéfini, cochez "Générer" pour générer un
                            matricule unique.</marquee>
                    </div>
                    <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                        <div class="2xl:col-span-3 2xl:col-start-10">
                            <form wire:submit.prevent="register">
                                <div class="flex mb-2">
                                    <div class="col mr-2 w-full">
                                        <div>
                                            <label for="matricule">Matricule </label>
                                            (Générer <input type="checkbox" @if (!$auto_matricule)  @endif
                                                wire:click="toggle" id="toggle-checkbox" class="">)
                                        </div>
                                        <input @if ($auto_matricule) disabled @endif wire:model="matricule"
                                            type="text" name="matricule"
                                            class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                            placeholder="@if (!$auto_matricule) Matricule... @endif"
                                            autocomplete="on">
                                        @error('matricule')
                                            <span class="error text-red-500 ">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col w-full">
                                        <label for="nom">Nom </label>
                                        <input required wire:model="nom" type="text" name="nom"
                                            class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                            placeholder="Nom..." autocomplete="on">
                                        @error('nom')
                                            <span class="error text-red-500 ">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="flex mb-2">
                                    <div class="col mr-2 w-full">
                                        <label for="prenom">Prenom </label>
                                        <input required wire:model="prenom" type="text" name="prenom"
                                            class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full"
                                            placeholder="Prénom..." autocomplete="on">
                                        @error('prenom')
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
                                        <input wire:model="date_de_naissance" type="date" name="date_de_naissance"
                                            class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                            placeholder="Date de naissance..." autocomplete="on">
                                        @error('date_de_naissance')
                                            <span class="error text-red-500 ">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col mr-2 w-full">
                                        <label for="lieu_de_naissance">Lieu de naissance </label>
                                        <input wire:model="lieu_de_naissance" type="text" name="lieu_de_naissance"
                                            class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full"
                                            placeholder="Lieu de naissance..." autocomplete="on">
                                    </div>
                                    @error('lieu_de_naissance')
                                        <span class="error text-red-500 ">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="flex mb-2">
                                    <div class="col mr-2 w-full">
                                        <label for="date_recrutement">Date de recrutement</label>
                                        <input wire:model="date_recrutement" type="date" name="date_recrutement"
                                            class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                            placeholder="Date de recrutement..." autocomplete="on">
                                        @error('date_recrutement')
                                            <span class="error text-red-500 ">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col mr-2 w-full">
                                        <label for="titre_poste">Titre de poste</label>
                                        <input required wire:model="titre_poste" type="text" name="titre_poste"
                                            class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"
                                            placeholder="Titre de poste..." autocomplete="on">
                                        @error('titre_poste')
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

                                </div>


                                <div class="flex mb-2">

                                    <div class="col mr-2 w-full">
                                        <label for="nombre_enfants">Nombre d'enfants</label>
                                        <select wire:model="nombre_enfants" required name="nombre_enfants"
                                            class="ltr:pl-8 rtl:pr-8 form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full">
                                            <option value="" selected>Choisir ici</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                        @error('nombre_enfants')
                                            <span class="error text-red-500 ">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col mr-2 w-full">
                                        <label for="secteurIntervention">Secteur d'intervention</label>
                                        <select required wire:model="secteurIntervention" name="secteurIntervention"
                                            class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                            <option value="">Choisir ici...</option>
                                            <option value="MECANIQUE GENERALE">MECANIQUE GENERALE</option>
                                            <option value="INDUSTRIE EXTRACTIVES ET PROSPECTION">INDUSTRIE EXTRACTIVES
                                                ET PROSPECTION</option>
                                            <option value="MINIERE">MINIERE</option>
                                            <option value="INDUSTRIE ALIMENTAIRES">INDUSTRIE ALIMENTAIRES</option>
                                            <option value="INDUSTRIES DES CORPS GRAS">INDUSTRIES DES CORPS GRAS
                                            </option>
                                            <option value="INDUSTRIES CHIMIQUES">INDUSTRIES CHIMIQUES</option>
                                            <option value="AUTRES INDUSTRIES">AUTRES INDUSTRIES</option>
                                            <option value="TRANSPORT">TRANSPORT</option>
                                            <option value="BOIS">BOIS</option>
                                            <option value="TEXTILE">TEXTILE</option>
                                            <option value="TRANFORMATION DU THON">TRANFORMATION DU THON</option>
                                            <option value="POLYGRAPHIQUE">POLYGRAPHIQUE</option>
                                            <option value="HOTELLERIE ET TOURISME">HOTELLERIE ET TOURISME</option>
                                            <option value="PRODUCTION AGRICOLE">PRODUCTION AGRICOLE</option>
                                            <option value="SUCRE">SUCRE</option>
                                            <option value="AUXILIAIRES DE TRANSPORT">AUXILIAIRES DE TRANSPORT</option>
                                            <option value="BATIMENT-TRAVAUX PUBLICS ET ACTIVITES CONNEXES">
                                                BATIMENT-TRAVAUX PUBLICS ET ACTIVITES CONNEXES</option>
                                            <option value="COMMERCE–NEGOCE–PROFESSIONS LIBERALE">
                                                COMMERCE–NEGOCE–PROFESSIONS LIBERALE</option>
                                            <option value="AGRICOLE – ELEVAGE - FORESTIER">AGRICOLE – ELEVAGE -
                                                FORESTIER</option>
                                            <option value="BANQUES">BANQUES</option>
                                            <option value="ASSURANCES">ASSURANCES</option>
                                            <option value="ENTREPRISES PETROLIERES">ENTREPRISES PETROLIERES</option>
                                            <option value="INSTITUTS DE RECHERCHE">INSTITUTS DE RECHERCHE</option>
                                            <option value="TRANSPORT DE FONDS ET VALEURS">TRANSPORT DE FONDS ET VALEURS
                                            </option>
                                            <option value="SECURITE PRIVEE">SECURITE PRIVEE</option>
                                            <option value="DOCKERS">DOCKERS</option>
                                            <option value="GENS DE MAISON">GENS DE MAISON</option>
                                            <option value="ENTREPRISES PETROLIERES (distribution)">ENTREPRISES
                                                PETROLIERES (distribution)</option>
                                        </select>
                                        @error('secteurIntervention')
                                            <span class="error text-red-500 ">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col mr-2 w-full">
                                        <label for="Nationalite">Nationalité</label>
                                        <select required wire:model="Nationalite" name="Nationalite"
                                            class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                            <option value="">Choisir ici...</option>
                                            <option value="Ivoirienne">Ivoirienne</option>
                                            <option value="Autre africain">Autre africain</option>
                                            <option value="Expatrié">Expatrié</option>
                                        </select>
                                        @error('Nationalite')
                                            <span class="error text-red-500 ">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col mr-2 w-full">
                                        <label for="photo">Photo</label>
                                        <input wire:model="photo" type="file" name="photo"
                                            accept=".png, .jpeg, .jpg"
                                            class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full"
                                            placeholder="Photo..." autocomplete="on">
                                        @error('photo')
                                            <span class="error text-red-500 ">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="flex justify-end w-full">
                                    <a href="{{ route('gestion_personnel') }}"
                                        class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Fermer</a>
                                    <button type="submit"
                                        class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Ajouter</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <script>
        function showModal(btn) {
            btn.style = "display: none;";
            let window = document.getElementById('add_personnel_modal')
            window.classList.remove("hidden")
            window.classList.add("flex")
            window.classList.add("opacity-100")
        }

        function closeModale() {
            document.getElementById("btn_ajouter").style = "display: block;";
            let window = document.getElementById('add_personnel_modal')
            window.classList.add("hidden")
            window.classList.remove("flex")
            window.classList.remove("opacity-100")
        }
    </script> -->
</div>
