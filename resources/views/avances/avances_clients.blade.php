@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div id="displaying_erea" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex justify-center items-center mb-2 mt-2">
            <h1 class="flex justify-center items-center text-black text-5xl">Liste des avances</h1>
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
        
        <div id="modalDivForPayementValidation" class="hidden fixed inset-0 z-50 flex items-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="card relative mx-auto mt-12 bg-white rounded-lg shadow-lg max-w-lg p-6">
                <div class="flex justify-center items-center">
                    <div class="text-center">
                        <strong class="text-2xl">Valider une avance</strong>
                    </div>
                </div>
                <br><hr><br>
                <form id="formForPayementValidation">
                    <input type="hidden" name="avanceId">
                    <input type="hidden" name="reste_a_regler">
                    <div class="flex justify-center items-center">
                        <div class="text-center">
                            Vous êtes sur le point de valider cette avance et retirer les produits de votre stok.
                        </div>
                    </div>
                    <div class="mt-6 flex justify-between space-x-4">
                        <button type="button" onclick="cencelProcess()" class="text-white btn ml-8 bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 mr-2">Annuler</button>
                        <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Continuer</button>
                    </div>
                </form>
            </div>
        </div>    
        <div class="col-span-12 card 2xl:col-span-12">
                <div class="card-body">
                    <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                        <div class="flex items-center">
                            <div class="2xl:col-span-3">
                                <h5 class="mr-2">Avances clients</h5>
                            </div>
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
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Nombre produits</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Total à régler</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Montant avancé</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reste à régler</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Date de l'avance</th>
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
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$vente->lignesVente->count()}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$somme_a_payer}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$montant_regle}}</td>
                                        @if ($reste == 0)
                                            <td class="text-green-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ">{{$reste}}</td>
                                            @elseif ($reste != 0)
                                            <td class="text-red-500 px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ">{{$reste}}</td>
                                        @endif
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{$vente->created_at->format('d/m/yy H:i')}}</td>
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                            <div class="relative dropdown">
                                                <button id="orderAction1" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20 w-20"><i data-lucide="more-horizontal" class="size-4"></i></button>
                                                <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction1">
                                                    <li>
                                                        <button onclick="details_avance()" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"><i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Afficher</span></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                
                                @if($i == 0)
                                    <div id="aucunElement" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <strong class="font-bold">Vide!</strong>
                                        <span class="block sm:inline">Les avances client s'affichent ici...</span>
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
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Quantité</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Somme à régler</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Somme réglée</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Reste à régler</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Date de l'avance</th>
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
   
    <script>
        function details_avance(){
            let sells_table = document.getElementById('personnelTable');
            let details_table = document.getElementById('venteOverView');
            details_table.classList.remove("hidden")
            sells_table.classList.add("hidden")
            let trElement = event.target.closest('tr');
            const vente_id = trElement.getAttribute('data-id');
                $.ajax({
                    url: '/render-details-vente',
                    method: 'GET',
                    data: { query: vente_id },
                    success: function(response) {
                        let lignesVentes = response.lignesVente;
                        if (lignesVentes.length === 0) {
                            $('#aucunelement').removeClass('hidden');
                        } else {
                            $('#aucunelement').addClass('hidden');
                        }

                        let tbody = $('#venteOverView tbody');
                        tbody.empty();


                        $.each(lignesVentes, function(index, lignesVente) {
                            if (lignesVente.systeme_produit) {
                                let invendue = lignesVente.quantite_envoyee - lignesVente.quantite_vendue;
                                let valeur_vendue = lignesVente.prix_vente * lignesVente.quantite_vendue;
                                let reste_a_regler = valeur_vendue - lignesVente.montant_regle;

                                let row = '<tr data-id="' + lignesVente.id + '" data-reste_a_regler="' + reste_a_regler + '">' +
                                    '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + (index + 1) + '</td>' +
                                    '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="#">' + lignesVente.systeme_produit.produit.reference + '</a></td>' +
                                    '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + lignesVente.systeme_produit.produit.designation + '</td>' +
                                    '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + lignesVente.prix_vente + '</td>' +
                                    '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + lignesVente.quantite_vendue + '</td>' +
                                    '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + valeur_vendue + '</td>' +
                                    '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + lignesVente.montant_regle + '</td>' +
                                    '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 ' + (reste_a_regler === 0 ? 'text-green-500' : 'text-red-500') + '">' + reste_a_regler + '</td>' +
                                    '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' + (new Date(lignesVente.created_at)).toLocaleTimeString() + '</td>' +
                                    '<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' +
                                        '<a title="Ajouter un payement..." href="#" onclick="payement(event,\'detteSurAvance\')" class="px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zinc-100 dark:hover:bg-zinc-500 dark:hover:text-zinc-200 dark:focus:bg-zinc-500 dark:focus:text-zinc-200">'+'<i class="fas fa-credit-card inline-block size-3 ltr:mr-1 rtl:ml-1"></i>'+'</a>' +
                                        '<a title="Valider et reduire le stock..." href="#" onclick="finaliserPayement()" class="px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zinc-100 dark:hover:bg-zinc-500 dark:hover:text-zinc-200 dark:focus:bg-zinc-500 dark:focus:text-zinc-200">'+'<i class="fas fa-check-circle inline-block size-3 ltr:mr-1 rtl:ml-1"></i>'+'</a>' +
                                    '</td>'+
                                    '</tr>';
                                tbody.append(row);
                            }
                        });

                        $('#venteOverView').removeClass('hidden');
                    },
                    error: function(e) {
                        console.log(e)
                        toastr.error('Erreur lors de la récupération des données.');
                    }
                });
                document.getElementById("btnRetourDetailsListe").classList.remove("hidden");
            }

        function afficher(diappearBtn = null){
            if(!diappearBtn){
                let displaying = document.getElementById('displaying_erea')
                displaying.classList.remove("hidden")
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
        if(document.getElementById("aucunElement")){
            document.getElementById("personnelTable").style.display = 'none';
        }
        fonction_de_recherche();
        submitAvanceValidationData();
    </script>   
@endsection

