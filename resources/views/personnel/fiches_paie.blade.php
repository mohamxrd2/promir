@extends('layouts.master')
@section('content')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            padding: 5px;
            align-items: center;
            color: #000;
        }
            
        table td {
            padding: 5px;
            text-align: center;
        }
        
        table td.text-left {
            text-align: left;
        }

        .total {
            font-weight: bold;
            background-color: #f1f1f1;
        }
        
    </style>
    <div id="display_contrat" class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">Fiches de paies</h1>
            </div>
            <div class="col-span-12 card 2xl:col-span-12">
                <div class="card-body">
                    <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                        <div class="flex items-center">
                            <label class="mr-3" for="date_debut">Debut</label>


                            <input type="date" id="date_debut" name="date_debut" class="w-full ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full"  autocomplete="off">

                            <label class="mr-3" for="date_fin">Fin</label>
                            
                            <input type="date" id="date_fin" name="date_fin" class="mr-3 w-full ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" autocomplete="off">
                            
                            
                            
                            
                            <input type="text" name="matricule" id="matricule" class="w-full ltr:pl-8 rtl:pr-8 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 mr-2 w-full" placeholder="Entrez un matricule..." autocomplete="off">
                            <button type="button" id="chercher" class="mr-2 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i class="align-baseline ltr:pr-1 rtl:pl-1 ri-search-line"></i></button>
                            <button title="Imprimer la fiche de paie" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i class="align-baseline ltr:pr-1 rtl:pl-1 ri-download-2-line"></i></button>
                        </div>                    
                    </div>
                    <table>
                        @for ($i = 1; $i<= 10; $i++)
                            <col style="width: 10%;"> 
                        @endfor
                        <thead>
                            <tr style="border-top: 4px solid black;" class="text-center">
                                <th rowspan="2" colspan="6" style="font-size:30px; border-left: 4px solid black;"><img src="assets/images/promir-paie-without-font.png" alt="logo promir paie"></th>
                                <th class="text-center" style="border-left: 4px solid black;border-bottom: 4px solid black;border-right: 4px solid black;background-color:#C9CAC9;" colspan = "4">BULETTIN DE PAIE</th>
                            </tr>
                            <tr class="text-center">
                                <th id="periodePaie" style="border-bottom: 4px solid black;border-right: 4px solid black;" colspan = "4" class="text-center">LA PAIE DU .../.../... </th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td class="text-left" colspan="2" style="font-size:17px;border-top: 4px solid black;border-left: 4px solid black;"></td>
                                <td class="text-left" colspan="3" style="font-size:17px;border-top: 4px solid black;border-right: 4px solid black;" ></td>
                                <td class="text-left" colspan="1" style="font-size:17px;"></td>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;border-top: 4px solid black;">Matricule</td>
                                <td class="text-left" id="matriculetd" colspan="2" style="font-size:17px;border-right: 4px solid black;border-top: 4px solid black;">...</td>
                            </tr>
                            
                            <tr>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;">ADRESSE</td>
                                <td class="text-left" id="adresse" colspan="3" style="font-size:17px;border-right: 4px solid black;">...</td>
                                <td class="text-left" colspan="1" style="font-size:17px;"></td>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;">Nom</td>
                                <td class="text-left" id="nom" colspan="2" style="font-size:17px;border-right: 4px solid black;">...</td>
                            </tr>
                            
                            <tr>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;">SIEGE SOCIAL</td>
                                <td class="text-left" id="siege_social" colspan="3" style="font-size:17px;border-right: 4px solid black;">...</td>
                                <td class="text-left" colspan="1" style="font-size:17px;"></td>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;">Prénom</td>
                                <td class="text-left" id="prenom" colspan="2" style="font-size:17px;border-right: 4px solid black;">...</td>
                            </tr>

                            <tr>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;">N° CNPS</td>
                                <td class="text-left" id="num_cnps"colspan="3" style="font-size:17px;border-right: 4px solid black;">...</td>
                                <td class="text-left" colspan="1" style="font-size:17px;"></td>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;">Emploi</td>
                                <td class="text-left" id="emploi" colspan="2" style="font-size:17px;border-right: 4px solid black;">...</td>
                            </tr>

                            <tr>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;">N° CC</td>
                                <td class="text-left"  id="numeroContribuable" colspan="3" style="font-size:17px;border-right: 4px solid black;">...</td>
                                <td class="text-left" colspan="1" style="font-size:17px;"></td>
                                <td class="text-left"  colspan="2" style="font-size:17px;border-left: 4px solid black;">Catégorie</td>
                                <td class="text-left" id="categorie" colspan="2" style="font-size:17px;border-right: 4px solid black;">...</td>
                            </tr>

                            <tr>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;">Email</td>
                                <td class="text-left" id="emailEntreprise" colspan="3" style="font-size:17px;border-right: 4px solid black;">...</td>
                                <td class="text-left" colspan="1" style="font-size:17px;"></td>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;">Nbr de parts</td>
                                <td class="text-left" id="nombreParts" colspan="2" style="font-size:17px;border-right: 4px solid black;">...</td>
                            </tr>

                            <tr>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;">TELEPHONE</td>
                                <td class="text-left" id="telephone" colspan="3" style="font-size:17px;border-right: 4px solid black;">...</td>
                                <td class="text-left" colspan="1" style="font-size:17px;"></td>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;">Date d'emboche</td>
                                <td class="text-left" id="dateEmboche" colspan="2" style="font-size:17px;border-right: 4px solid black;">...</td>
                            </tr>

                            <tr>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td class="text-left" colspan="3" style="font-size:17px;border-right: 4px solid black;"></td>
                                <td class="text-left" colspan="1" style="font-size:17px;"></td>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;">Date de naissance</td>
                                <td class="text-left" id="dateNaissance" colspan="2" style="font-size:17px;border-right: 4px solid black;">...</td>
                            </tr>

                            <tr>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td class="text-left" colspan="3" style="font-size:17px;border-right: 4px solid black;"></td>
                                <td class="text-left" colspan="1" style="font-size:17px;"></td>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;">Nationalité</td>
                                <td class="text-left" id="Nationalite" colspan="2" style="font-size:17px;border-right: 4px solid black;">...</td>
                            </tr>

                            <tr>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;border-bottom: 4px solid black;"></td>
                                <td class="text-left" colspan="3" style="font-size:17px;border-bottom: 4px solid black;border-right: 4px solid black;"></td>
                                <td class="text-left" colspan="1" style="font-size:17px;"></td>
                                <td class="text-left" colspan="2" style="font-size:17px;border-left: 4px solid black;border-bottom: 4px solid black;">N° Sécurité</td>
                                <td class="text-left" id="numeroSecurite" colspan="2" style="font-size:17px;border-right: 4px solid black;border-bottom: 4px solid black;">...</td>
                            </tr>
                            
                            <tr>
                                <td colspan="10" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border: 4px solid black;background-color:#C9CAC9;">N° Rubriques</td>
                                <td colspan="3" class="text-left" style="font-size:17px;border: 4px solid black;background-color:#C9CAC9;">LIBELLE</td>
                                <td colspan="1" style="font-size:17px;border: 4px solid black;background-color:#C9CAC9;">BASE</td>
                                <td colspan="1" style="font-size:17px;border: 4px solid black;background-color:#C9CAC9;">TAUX</td>
                                <td colspan="1"  style="font-size:17px;border: 4px solid black;background-color:#C9CAC9;">GAINS</td>
                                <td colspan="1"  style="font-size:17px;border: 4px solid black;background-color:#C9CAC9;">RETENUS</td>
                                <td colspan="1"  style="font-size:17px;border: 4px solid black;background-color:#C9CAC9;">TAUX P.P</td>
                                <td colspan="1" style="font-size:17px;border: 4px solid black;background-color:#C9CAC9;">MONTANT P.P</td>
                            </tr>
                            
                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00010</td>
                                <td colspan="3" class="text-left" class="text-left"  style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">SALAIRE DE BASE</td>
                                <td id="salaireDeBase" colspan="1" style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td id="gainsSalaireBase" colspan="1"  style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00020</td>
                                <td  colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">AVANTAGE EN NATURE</td>
                                <td id="avantageEnNature" colspan="1" style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td id="gainsAvantageEnNature" colspan="1"  style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00500</td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;">SALAIRE BRUT</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                                <td id="salaireBrut" colspan="1"  style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;">...</td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00501</td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;">BRUT IMPOSABLE</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                                <td id="brutImposable" colspan="1"  style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;">...</td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00511</td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">Impôt employeur</td>
                                <td id="baseImpotEmployeur" colspan="1" style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td  colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">...</td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00512</td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">T.A</td>
                                <td id="baseTA" colspan="1" style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td id="tauxTA" colspan="1"  style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td id="valeurTauxTA" colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">...</td>
                            </tr>
                            
                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00512</td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">F.D.F.P</td>
                                <td id="baseFdfp" colspan="1" style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td id="tauxFdfp" colspan="1"  style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td id="valeurTauxFdfp" colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">...</td>
                            </tr>

                           

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"><strong>Total Charges Fiscales Employeur</strong></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"><strong id="totalChargesFiscalesEmplyeur"></strong></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00520</td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">C.N.P.S/Prestation famille</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">70000</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00521</td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">CNPS/Accident de Travail</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">70000</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00522</td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">C.N.P.S/Caisse Retraite</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00523</td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">CMU/ASSURANCE MALADIE</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">1000</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td id="tauxCMM" colspan="1"  style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td id="valeurCMU" colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">...</td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"><strong>Total Charges Sociales Employeur</strong></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"><strong id="totalChargesSocialesEmplyeur"></strong></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"><strong>Total Charges Patronales</strong></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"><strong id="TotalChargesPatronales"></strong></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00540</td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">RETENUS ITS</td>
                                <td id="baseRetuITS" colspan="1" style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td id="retenuITS" colspan="1" style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00543</td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">Retenu C.N.P.S</td>
                                <td id="baseRetenuCNPS" colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00544</td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">Retenu CMU</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">1000</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">50%</td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td id="valeurRetenuCMU" colspan="1" style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>
                            
                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"><strong>Total Retenus</strong> </td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td id="totalRetenus" colspan="1"  style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="3" class="text-left" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;">SALAIRE NET</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                                <td id="salaireNet" colspan="1"  style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;">...</td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;border-top: 2px dashed black;border-bottom: 2px dashed black;"></td>
                            </tr>

                            <tr>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">00630</td>
                                <td colspan="3" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;">TRANSPORT NON IMPOSABLE</td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;">30000</td>
                                <td  colspan="1" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;">30000</td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1"  style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="1" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;"></td>
                            </tr>
                            
                            <tr>
                                <td colspan="7" class="text-center" rowspan="2" style="font-size:17px;border-left: 4px solid black;border-right: 4px solid black;border-top: 4px solid black;border-bottom: 4px solid black;">CUMUL DE PAIE</td>
                                <td colspan="1" style="font-size:17px;border-top: 4px solid black;">GAINS</td>
                                <td id="totalGains" colspan="2" style="font-size:17px;border-top: 4px solid black;border-right: 4px solid black;">...</td>
                            </tr> 
                            
                            <tr>
                                <td colspan="1" style="font-size:17px;border-top: 4px solid black;border-bottom: 4px solid black;">RETENUS</td>
                                <td id="totalRetenu" colspan="2" style="font-size:17px;border-top: 4px solid black;border-right: 4px solid black;border-bottom: 4px solid black;">...</td>
                            </tr> 
                            
                            <tr>
                                <td colspan="4" style="font-size:17px;border-top: 4px solid black;border-left: 4px solid black;">ITS</td>
                                <td colspan="3" style="font-size:17px;border-top: 4px solid black;border-right: 4px solid black;">CMU</td>
                                <td colspan="2" rowspan="2" style="font-size:17px;border-top: 4px solid black;">NET A PAYER</td>
                                <td id="netAPayer" colspan="1" rowspan="2" style="font-size:17px;border-top: 4px solid black;border-right: 4px solid black;">...</td>
                            </tr>

                            <tr>
                                <td id="its_" colspan="4" style="font-size:17px;border-left: 4px solid black;">...</td>
                                <td id="cmu" colspan="3" style="font-size:17px;border-right: 4px solid black;">...</td>
                            </tr>

                            <tr>
                                <td colspan="4" style="font-size:17px;border-left: 4px solid black;"></td>
                                <td colspan="3" style="font-size:17px;border-right: 4px solid black;"></td>
                                <td colspan="2"  style="font-size:17px;border-top: 4px solid black;">REGLEMENT</td>
                                <td colspan="1" style="font-size:17px;border-top: 4px solid black;border-right: 4px solid black;">VIREMENT</td>
                            </tr>

                            <tr>
                                <td colspan="4" style="font-size:17px;border-bottom: 4px solid black;border-left: 4px solid black;"></td>
                                <td colspan="3" style="font-size:17px;border-bottom: 4px solid black;border-right: 4px solid black;"></td>
                                <td colspan="2"  style="font-size:17px;border-bottom: 4px solid black;">...</td>
                                <td colspan="1" style="font-size:17px;border-right: 4px solid black;border-bottom: 4px solid black;">...</td>
                            </tr>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("chercher").addEventListener('click', function(){
            const debut = document.getElementById("date_debut").value;
            const fin = document.getElementById("date_fin").value;
            const matr = document.getElementById("matricule").value;
            
            $.ajax({
                url: '/rechercher-fiche-paie',
                method: 'GET',
                data: { matricule: matr, dateDebut: debut, dateFin: fin},
                success: function(response) {
                    if(response.dateIncorrecte){
                        return toastr.info("Entrez une période correcte");
                    }

                    if(response.matriculeIncorrecte){
                        return toastr.info("Entrez un bon matricule");
                    }
                    
                    if(response.autreProbleme){
                        console.log(response.autreProbleme)
                        return toastr.error("Un problème est survenu");
                    }
                    
                    if(response.ficheNonTrouvee){
                        return toastr.error("Aucun paiement pour ce salarié en cette période");
                    }

                    if(response.fiche){
                        let periode = response.fiche.periode_paie;
                        periode = periode.split(" ");
                        let debut = periode[1];
                        let fin = periode[3];

                        debut = new Date(debut);
                        fin = new Date(fin);

                        debut = new Intl.DateTimeFormat('fr-FR').format(debut);
                        fin = new Intl.DateTimeFormat('fr-FR').format(fin);
                        
                        
                        $("#periodePaie").text("LA PAIE DU "+debut+" AU "+ fin);
                        $("#adresse").text(response.fiche.personnel.systeme_client.adresse_geographique);
                        $("#siege_social").text(response.fiche.personnel.systeme_client.localite);
                        $("#emailEntreprise").text(response.fiche.personnel.systeme_client.mail_entreprise);
                        $("#num_cnps").text(response.fiche.personnel.systeme_client.num_cnps);
                        $("#telephone").text(response.fiche.personnel.systeme_client.tel);
                        $("#nom").text(response.fiche.personnel.nom);
                        $("#nombreParts").text(response.fiche.nombre_de_parts);
                        $("#prenom").text(response.fiche.personnel.prenom);
                        $("#dateEmboche").text(response.fiche.personnel.date_recrutement);
                        $("#dateNaissance").text(response.fiche.personnel.date_de_naissance);
                        $("#Nationalite").text(response.fiche.personnel.Nationalite);
                        $("#salaireDeBase").text(response.fiche.salaire_base);
                        $("#gainsSalaireBase").text(response.fiche.salaire_base);
                        $("#avantageEnNature").text(response.fiche.autres_avantages + response.fiche.sursalaire);
                        $("#gainsAvantageEnNature").text(response.fiche.autres_avantages + response.fiche.sursalaire);
                        $("#salaireBrut").text(response.fiche.autres_avantages + response.fiche.salaire_base + response.fiche.sursalaire + response.fiche.prime_transport);
                        $("#brutImposable").text(response.fiche.salaireBrutImposable);
                        $("#baseTA").text(response.fiche.salaireBrutImposable);
                        $("#salaireNet").text("");
                        $("#baseRetuITS").text(response.fiche.salaireBrutImposable);
                        $("#retenuITS").text(response.fiche.retenu_ITS);

                        $("#totalGains").text(response.fiche.salaire_base + response.fiche.autres_avantages + response.fiche.sursalaire + response.fiche.prime_transport);
                        $("#totalRetenus").text(response.fiche.retenu_ITS);
                        $("#totalRetenu").text(response.fiche.retenu_ITS);

                        
                        $("#tauxTA").text("0.4%");
                        $("#tauxCMM").text("50%");
                        $("#valeurTauxTA").text(0.004*response.fiche.salaireBrutImposable);
                        $("#valeurCMU").text(0.5*1000);
                        $("#valeurRetenuCMU").text(0.5*1000);
                        $("#cmu").text(0.5*1000 + 0.5*1000);
                        $("#totalChargesSocialesEmplyeur").text(0.5*1000);
                        $("#totalChargesFiscalesEmplyeur").text(0.004*response.fiche.salaireBrutImposable + 0.006*response.fiche.salaireBrutImposable + 0);
                        $("#TotalChargesPatronales").text(0.004*response.fiche.salaireBrutImposable + 0.006*response.fiche.salaireBrutImposable + 0.5*1000);
                        

                        $("#its_").text(response.fiche.retenu_ITS);
                        $("#netAPayer").text(response.fiche.salaire_base + response.fiche.autres_avantages + response.fiche.sursalaire + response.fiche.prime_transport - response.fiche.retenu_ITS);

                        $("#baseFdfp").text(response.fiche.salaireBrutImposable);
                        $("#tauxFdfp").text("0.6%");
                        $("#valeurTauxFdfp").text(0.006*response.fiche.salaireBrutImposable);

                        $("#numeroSecurite").text(response.fiche.personnel.num_cnps);
                        $("#categorie").text(response.fiche.personnel.contrat.categorie);
                        $("#emploi").text(response.fiche.personnel.titre_poste);
                        $("#numeroContribuable").text("____________");
                        $("#matriculetd").text(response.fiche.personnel.matricule);
                        
                    }
                },
                error: function() {
                    toastr.error('Erreur de connexion. Veuillez réessayer.');
                }
            });
        });
    </script>
@endsection