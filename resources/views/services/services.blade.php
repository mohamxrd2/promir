@extends('layouts.master')
@section('content')
    <div id="displaying_erea" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Liste des services</h1>
            </div>
                <div class="col-span-12 card 2xl:col-span-12">
                    <div class="card-body">
                        <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                            <div class="flex items-center">
                                <div class="2xl:col-span-3">
                                    <h5 class="mr-2">Ajouter</h5>
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
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Désignation</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Description</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Prix unitaire</th>
                                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Actions</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ( $services as $service )
                                        <tr
                                            data-id= "{{ $service->id}}"
                                            data-reference="{{ $service->reference }}"
                                            data-designation="{{ $service->designation }}"
                                            data-description="{{ $service->description }}"
                                            data-prix_unitaire="{{ $service->prix_unitaire }}">

                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{++$i}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">{{$service->reference}}</a></td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$service->designation}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$service->description}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$service->prix_unitaire}}</td>
                                            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                                <div class="relative dropdown">
                                                    <button id="orderAction1" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20 w-20"><i data-lucide="more-horizontal" class="size-4"></i></button>
                                                    <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction1">
                                                        <li>
                                                            <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!"><i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Afficher</span></a>
                                                        </li>
                                                        <li>
                                                            <button type="button" onclick="modifier()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="#!" ><i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Modifier</span></button>
                                                        </li>
                                                        <li>
                                                            <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"  href="{{ route('service.delete', ['id' => $service->id]) }}" onclick="return confirm('Cette action est irreversible! Êtes-vous sûr de vouloir supprimer cet service ?')"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Supprimer</span></a> 
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            </tr>
                                    @endforeach 
                                    @if($i == 0)
                                        <div id="aucunelement" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                            <strong class="font-bold">Vide!</strong>
                                            <span class="block sm:inline">Aucun service trouvé.</span>
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
                <h1 class="flex justify-center items-center text-black text-5xl">Ajouter un service</h1>
            </div>
                <div class=" transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form id="formulaire_ajout">
                                       
                                        <input class="hidden" type="text" name="id_service" id="id_serv">
                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                    <label for="reference">Reference 
                                                        (Générer <input type="checkbox" onclick="toggle()" id="toggle-checkbox" class="cursor-hand">)
                                                    </label>
                                                <input required type="text" name="reference" disabled id="reference_add" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div> 
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="designation">Désignation</label>
                                                <input required type="text" name="designation" id="des" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="description">Description</label>
                                                <input required type="text" name="description" id="desc" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="prix_unitaire">Prix unitaire</label>
                                                <input required type="number" name="prix_unitaire" id="prix_u" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
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

    <div id="modifying_erea" class="hidden group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Modifier un service</h1>
            </div>
                <div class="transition-opacity duration-500">
                    <div class="col-span-12 card 2xl:col-span-12 ">
                        <div class="card-body">
                            <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                                <div class="2xl:col-span-3 2xl:col-start-10">
                                    <form id="formulaire_modif">
                                       
                                        <input class="hidden" type="text" name="id_service" id="id_service">

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="reference">Reference</label>
                                                <input required type="text" name="reference" id="reference" class="row ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div> 
                                        </div>

                                        <div class="flex mb-2">
                                            <div class="col mr-2 w-full">
                                                <label for="designation">Désignation</label>
                                                <input required type="text" name="designation" id="designation" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="description">Description</label>
                                                <input required type="text" name="description" id="description" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
                                            </div>

                                            <div class="col mr-2 w-full">
                                                <label for="prix_unitaire">Prix unitaire</label>
                                                <input required type="number" name="prix_unitaire" id="prix_unitaire" class="ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 w-full" placeholder="Tapez ici..." autocomplete="on">
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

var checked = false;
        function toggle(){
            checked =! checked;
            if(checked){

                $.ajax({
                    url: '/generate_reference_service',
                    method: 'GET',
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
        function effacer_erreurs(){
            var errorMessageElements = document.querySelectorAll('.error-message');
            if(errorMessageElements.length > 0){
                errorMessageElements.forEach(function(element) {
                    element.parentNode.removeChild(element);
                });
            }
        }

        function disparition_table(){
            if(document.getElementById("aucunelement")){
                document.getElementById("personnelTable").style.display = 'none';
            }
        }

        disparition_table()
    
        function ajouter(){
            let adding = document.getElementById('adding_erea')
            adding.classList.remove("hidden")    
            
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")

            // const categorieInput2 = document.getElementById('categorieInput2');
            // const categorieSelect2 = document.getElementById('categorieSelect2');
            // const produitsSelect2 = document.getElementById('produitsSelect2');

            // let timerId;
            // categorieInput2.addEventListener('input', function(e) {
            //     clearTimeout(timerId);
            //     timerId = setTimeout(function() {
            //         const inputValue = e.target.value;
            //         $.ajax({
            //             url: '/rechercher-categories',
            //             method: 'GET',
            //             data: { query: inputValue },
            //             success: function(response) {
            //                 if(response.length > 0){
            //                     if(response.length == 1){
            //                         categorieSelect2.innerHTML = '<option disabled value="">1 résultat</option>';
            //                     }else{
            //                         categorieSelect2.innerHTML = '<option disabled value="">'+ response.length +' résultats</option>';
            //                     }
            //                     response.forEach(function(categorie) {
            //                         categorieSelect2.innerHTML += `<option value="${categorie.id}">${categorie.nom}</option>`;
            //                     });
            //                 }else{
            //                     document.getElementById('produitsSelect2').innerHTML = '<option disabled value="">0 résultat</option>';
            //                     categorieSelect2.innerHTML = '<option disabled value="">0 résultat</option>';
            //                     reference =  document.getElementById('reference_add')
            //                     reference.value = '';
            //                     reference.disabled = false;

            //                     designation =  document.getElementById('designation_add')
            //                     designation.value = '';
            //                     designation.disabled = false;

            //                     format =  document.getElementById('format_add')
            //                     format.value = '';
            //                     format.disabled = false;

            //                     type_produit =  document.getElementById('type_produit')
            //                     type_produit.value = '';
            //                     type_produit.disabled = false;

            //                     image =  document.getElementById('image')
            //                     image.disabled = false;

                               
            //                 }
            //             },
            //             error: function(xhr, status, error) {
            //                 console.error(error);
            //             }
            //         });
            //     }, 250);
            // });
            // category_on_change();
            // update_produits();
            // produit_on_change();
        }
    
        // function category_on_change(){
        //     categorieSelect2.addEventListener('change', function() {
        //         categorieInput2.value = categorieSelect2.options[categorieSelect2.selectedIndex].text;
        //         const produitsSelect2 = document.getElementById('produitsSelect2');
        //         $.ajax({
        //             url: '/render-produits',
        //             method: 'GET',
        //             data: { query: this.value },
        //             success: function(response) {
        //                 if(response.length > 0){
        //                     if(response.length == 1){
        //                         produitsSelect2.innerHTML = '<option disabled value="">1 résultat</option>';
        //                     }else{
        //                         produitsSelect2.innerHTML = '<option disabled value="">'+ response.length +' résultats</option>';
        //                     }
        //                     response.forEach(function(produit) {
        //                         produitsSelect2.innerHTML += `<option value="${produit.id}">${produit.designation}</option>`;
        //                     });
        //                 }else{
        //                     produitsSelect2.innerHTML = '<option disabled value="">0 résultat</option>';
        //                 }
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error(error);
        //             }
        //         });
        //     });
        // }

        // function produit_on_change(){
        //         produitsSelect2.addEventListener('change', function() {
        //             produitsInput2.value = '';
        //         produitsInput2.value = produitsSelect2.options[produitsSelect2.selectedIndex].text;
        //         $.ajax({
        //             url: '/render-produit_properties',
        //             method: 'GET',
        //             data: { query: this.value },
        //             success: function(response) {
        //                 if(response){
        //                     reference =  document.getElementById('reference_add')
        //                     reference.value = response.reference;
        //                     reference.disabled = true;

        //                     designation =  document.getElementById('designation_add')
        //                     designation.value = response.designation;
        //                     designation.disabled = true;

        //                     format =  document.getElementById('format_add')
        //                     format.value = response.format;
        //                     format.disabled = true;

        //                     type_produit =  document.getElementById('type_produit')
        //                     type_produit.value = response.type;
        //                     type_produit.disabled = true;

        //                     image =  document.getElementById('image')
        //                     image.disabled = true;
        //                     image.value = '';
        //                 }else{
        //                     produitsSelect2.innerHTML = '<option disabled value="">0 résultat</option>';
        //                 }
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error(error);
        //             }
        //         });
        //     });
        // }

        // function update_produits(){
        //     const produitsInput2 = document.getElementById('produitsInput2');
        //     const produitsSelect2 = document.getElementById('produitsSelect2');
        //         let timeId;
        //         produitsInput2.addEventListener('input', function(e) {
                
        //             clearTimeout(timeId);
        //             timeId = setTimeout(function() {
        //                 const categorie_id = document.getElementById('categorieSelect2').value;
        //                 if(!categorie_id) return;
        //                 var inputValue = e.target.value;
        //                 $.ajax({
        //                     url: '/rechercher-produits',
        //                     method: 'GET',
        //                     data: { query: inputValue, categorie: categorie_id },
        //                     success: function(response) {
        //                         if(response.length > 0){
        //                             if(response.length == 1){
        //                                 produitsSelect2.innerHTML = '<option disabled value="">1 résultat</option>';
        //                             }else{
        //                                 produitsSelect2.innerHTML = '<option disabled value="">'+ response.length +' résultats</option>';
        //                             }
        //                             response.forEach(function(produit) {
        //                                 produitsSelect2.innerHTML += `<option value="${produit.id}">${produit.designation}</option>`;
        //                             });
        //                         }else{
        //                             produitsSelect2.innerHTML = '<option disabled value="">0 résultat</option>';
        //                             reference =  document.getElementById('reference_add')
        //                             reference.value = '';
        //                             reference.disabled = false;

        //                             designation =  document.getElementById('designation_add')
        //                             designation.value = '';
        //                             designation.disabled = false;

        //                             format =  document.getElementById('format_add')
        //                             format.value = '';
        //                             format.disabled = false;

        //                             type_produit =  document.getElementById('type_produit')
        //                             type_produit.value = '';
        //                             type_produit.disabled = false;

        //                             image =  document.getElementById('image')
        //                             image.disabled = false;
        //                         }
        //                     },
        //                     error: function(xhr, status, error) {
        //                         console.error(error);
        //                     }
        //                 });
        //             }, 250);
        //         });
        // }
        
        function modifier(){
            let modifying = document.getElementById('modifying_erea')
            modifying.classList.remove("hidden")    
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.add("hidden")
            let trElement = event.target.closest('tr');
    
            const id_service = trElement.getAttribute('data-id');
            const reference = trElement.getAttribute('data-reference');
            const designation = trElement.getAttribute('data-designation');
            const  description = trElement.getAttribute('data-description');
            const prix_unitaire = trElement.getAttribute('data-prix_unitaire');

            const formulaire = document.getElementById('formulaire_modif');
            formulaire.querySelector('input[name="id_service"]').value = id_service ;
            formulaire.querySelector('input[name="reference"]').value = reference ;
            formulaire.querySelector('input[name="designation"]').value = designation ;
            formulaire.querySelector('input[name="description"]').value = description;
            formulaire.querySelector('input[name="prix_unitaire"]').value = prix_unitaire;
        }
    
        function afficher(){
            let displaying = document.getElementById('displaying_erea')
            displaying.classList.remove("hidden")
            let adding = document.getElementById('adding_erea')
            if(adding){
                adding.classList.add("hidden")
            }
            let modifying = document.getElementById('modifying_erea')
            if(modifying){
                modifying.classList.add("hidden")
            }
        }

        var formulaire_ajou = document.getElementById('formulaire_ajout');
        formulaire_ajou.addEventListener('submit', function(event) {
            event.preventDefault();
               document.getElementById('reference_add').disabled = false;

               var formData = new FormData(formulaire_ajou);
               var request = new XMLHttpRequest();
               request.open('POST', '/store_service');
               request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
               request.onreadystatechange = function() {
  
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        var response = JSON.parse(request.responseText);
                        effacer_erreurs();
                            toastr.success('Service entré avec succès!', 'OK');
                            // document.getElementById('reference_add').disabled = true;
                            return;
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
                            // document.getElementById('reference_add').disabled = true;
                        } else {
                            toastr.error('Une erreur s\'est produite lors de la requête.', 'Erreur');
                            // document.getElementById('reference_add').disabled = true;
                        }
                    }
                }
    
               };
               request.send(formData);
               document.getElementById('reference_add').disabled = true;
           
    
        });
      
        var formulaire_modif = document.getElementById('formulaire_modif');
        formulaire_modif.addEventListener('submit', function(event) {

            event.preventDefault();
            var data_to_modify = new FormData(formulaire_modif);
            var request = new XMLHttpRequest();
            request.open('POST', '/edit_service');
            request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            request.onreadystatechange = function() {
                
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        effacer_erreurs();
                        toastr.success('Service modifié avec succès!', 'OK');
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