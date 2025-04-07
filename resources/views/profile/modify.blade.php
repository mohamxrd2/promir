
@extends('layouts.master')
@section('content')


<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Profil</h1>
            </div> 
                <div class="transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                <form id="formModifyProfile"> 
                                        <a class="flex gap-3 mb-3 items-center">
                                            <div class="relative inline-block shrink-0">
                                                <div class="rounded-full bg-slate-100 dark:bg-zink-500">
                                                    <img id="profileImage" src="{{ asset('storage/profile_images/' . Auth::user()->photo) }}" alt="" class="w-12 h-12 rounded-full cursor-pointer">
                                                    <input type="file" id="imageUpload" name="photo" accept="image/*" class="hidden"> 
                                                </div>
                                            </div>
                                            <div>
                                                <span class="mb-1 mt-1 text-20">Photo</span>
                                                <h6 class="text-15">{{$user->email}}</h6>
                                            </div>
                                        </a>
                                        <hr>
                                        <!-- Champ Nom -->
                                        <div class="flex mb-2 mt-2">
                                            <div class="col mr-2 w-full">
                                                <label for="username-field" class="inline-block mb-2 text-base font-medium">Nom</label>
                                                <input type="text" value="{{$user->name}}" name="name" id="username-field" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>
                                        <!-- Champ Prénom -->
                                        <div class="flex mb-2 mt-2">
                                            <div class="col mr-2 w-full">
                                                <label for="last_stname-field" class="inline-block mb-2 text-base font-medium">Prénom</label>
                                                <input type="text" value="{{$user->last_stname}}" name="last_stname" id="last_stname-field" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>

                                        <!-- Champ Téléphone 1 -->
                                        <div class="flex mb-2 mt-2">
                                            <div class="col mr-2 w-full">
                                                <label for="phone_number-field" class="inline-block mb-2 text-base font-medium">Téléphone 1</label>
                                                <input type="text" value="{{$user->phone_number}}" name="phone_number" id="phone_number-field" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici..." autocomplete="off">
                                            </div>

                                            <!-- Champ Téléphone 2 -->
                                            <div class="col mr-2 w-full">
                                                <label for="second_phone_number-field" class="inline-block mb-2 text-base font-medium">Téléphone 2</label>
                                                <input type="text" value="{{$user->second_phone_number}}" name="second_phone_number" id="second_phone_number-field" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici..." autocomplete="off">
                                            </div>
                                        </div>

                                        <!-- Champ Genre -->
                                        <div class="flex mb-2 mt-2">
                                            <div class="col mr-2 w-full">
                                                <label for="gender" required class="inline-block mb-2 text-base font-medium">Genre</label>
                                                <select id="gender"  name="gender" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                    <option @if ($user->gender == "homme") selected @endif  value="homme">Homme</option>
                                                    <option @if ($user->gender == "femme") selected @endif value="femme">Femme</option>
                                                </select>
                                            </div>

                                            <!-- Champ Fonction -->
                                            <div class="col mr-2 w-full">
                                                <label for="fonction" required class="inline-block mb-2 text-base font-medium">Fonction</label>
                                                <select id="fonction" name="fonction" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                    <option @if ($user->fonction == "Directeur général") selected @endif value="Directeur général" selected>Directeur général</option>
                                                    <option @if ($user->fonction == "Directeur Informatique et technique") selected @endif value="Directeur Informatique et technique">Directeur Informatique et technique</option>
                                                    <option @if ($user->fonction == "Secrétaire DG") selected @endif value="Secrétaire DG">Secrétaire DG</option>
                                                    <option @if ($user->fonction == "Analyste des relations client") selected @endif value="Analyste des relations client">Analyste des relations client</option>
                                                    <option @if ($user->fonction == "Gestionnaire commercial") selected @endif value="Gestionnaire commercial">Gestionnaire commercial</option>
                                                    <option @if ($user->fonction == "DRH") selected @endif value="DRH">DRH</option>
                                                    <option @if ($user->fonction == "Manager") selected @endif value="Manager">Manager</option>
                                                    <option @if ($user->fonction == "Autre") selected @endif value="Autre">Autre</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="flex justify-end w-full">
                                            <button type="button" onclick="actualiser()" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Reinitialiser les champs</button>
                                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Soumettre les changements</button>
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


        
        gestionImageProfile(document.getElementById('profileImage'), document.getElementById('imageUpload'));

        effacer_erreurs()
        const form = document.getElementById('formModifyProfile');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(form);
            var request = new XMLHttpRequest();
            request.open('POST', '{{ route('user.profile.update') }}');
            request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            request.onreadystatechange = function() {
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        effacer_erreurs()
                        var response = JSON.parse(request.responseText);
                        // window.location.reload();

                        toastr.success('Profil mis à jour avec succès !');

                    } else {
                        var response = JSON.parse(request.responseText);
                        if (response.errors) {
                            effacer_erreurs()
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
            request.send(formData);
        });


      
        function modifier(){
            const formulaire = document.getElementById('formulaire_modif');
            formulaire.querySelector('input[name="id_element"]').value = id_element;
            formulaire.querySelector('select[name="type"]').value = type;
            formulaire.querySelector('input[name="libelle"]').value = libelle;
            formulaire.querySelector('input[name="montant"]').value = montant;
            formulaire.querySelector('input[name="montant_regle"]').value = montant_regle;
            formulaire.querySelector('select[name="moyen_payement"]').value = moyen_payement;
            formulaire.querySelector('input[name="reference_payement"]').value = reference_payement;
            formulaire.querySelector('input[name="beneficiaire"]').value = beneficiaire;
        }
    
       
       
    </script> 
@endsection