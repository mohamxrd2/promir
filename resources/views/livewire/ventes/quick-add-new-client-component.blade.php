<div class="fixed inset-0 z-50 flex items-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
    <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
    <div class="card fixed relative mx-auto mt-12 bg-white rounded-lg shadow-lg p-6">
        <form wire:submit.prevent="saveNewClient">
            <div class="flex mb-2">
                <div class="col mr-2 w-full">
                    <input wire:model.live.debounce.250ms ="clientInput" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" autocomplete="off" placeholder="Entrez un client">
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
                        <option value="Choisissez un type" disabled selected hidden>Choisissez un type</option>
                        <option value="Entreprise">Entreprise</option>
                        <option value="Particulier">Particulier</option>
                    </select>
                    @error('quickAddNewClient.type') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                </div>
                <div class="col mr-2 w-full">
                    <label for="nom">Nom</label>
                    <input required @if($disableInputs) disabled @endif type="text" wire:model="quickAddNewClient.nom" id="nom_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                    @error('quickAddNewClient.nom') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex mb-2">
                <div class="col mr-2 w-full">
                    <label for="adresse">Adresse </label>
                    <input required @if ($disableInputs) disabled @endif type="text" wire:model="quickAddNewClient.adresse" id="adresse_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                    @error('quickAddNewClient.address') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                </div>

                <div class="col mr-2 w-full">
                    <label for="email">Email</label>
                    <input @if ($disableInputs) disabled @endif required type="text" wire:model="quickAddNewClient.email" id="email_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                    @error('quickAddNewClient.email') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex mb-2">
                <div class="col mr-2 w-full">
                    <label for="phone">Téléphone 1</label>
                    <input @if ($disableInputs) disabled @endif required type="tel" wire:model="quickAddNewClient.phone" id="phone_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                    @error('quickAddNewClient.phone') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                </div>

                <div class="col mr-2 w-full">
                    <label for="seconde_phone">Téléphone 2</label>
                    <input @if ($disableInputs) disabled @endif type="tel" wire:model="quickAddNewClient.seconde_phone" id="seconde_phone_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                    @error('quickAddNewClient.seconde_phone') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                </div>

                <div class="col mr-2 w-full">
                    <label for="pays">Pays</label>
                    <input @if ($disableInputs) disabled @endif required type="text" wire:model="quickAddNewClient.pays" id="pays_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
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
                    <input @if ($disableInputs) disabled @endif required type="tel" wire:model="quickAddNewClient.departement" id="departement_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                    @error('quickAddNewClient.departement') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                </div>

                <div class="col mr-2 w-full">
                    <label for="localite">Localité</label>
                    <input @if ($disableInputs) disabled @endif required type="text" wire:model="quickAddNewClient.localite" id="localite_add" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                    @error('quickAddNewClient.localite') <span class="error text-red-500 ">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end w-full">
                <button type="button" wire:click="cancelModal" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Annuler</button>
                <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Valider</button>
            </div>
        </form>
    </div>
</div>
