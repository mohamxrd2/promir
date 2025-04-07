@extends('layouts.master')
@section('content')
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="transition-opacity duration-500">
                <div class="col-span-12 card 2xl:col-span-12 ">
                    <div class="card-body w-full overflow-x-auto">
                        <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                            <div class="2xl:col-span-3 2xl:col-start-10">
                                <table id="editableTable" class="min-w-full">
                                    <thead class="bg-orange-400" style="border-top: thick double #949394;">
                                        <tr class="h-16"> 
                                            <th style="font-size:16px;border-left: thick double #949394;" class="px-4 py-2 text-center text-gray-700 border-b">Trésorerie(N)</th>
                                            <th class="px-4 py-2 text-center text-gray-700 border-b">Janvier</th>
                                            <th class="px-4 py-2 text-center text-gray-700 border-b">Février</th>
                                            <th class="px-4 py-2 text-center text-gray-700 border-b">Mars</th>
                                            <th class="px-4 py-2 text-center text-gray-700 border-b">Avril</th>
                                            <th class="px-4 py-2 text-center text-gray-700 border-b">Mai</th>
                                            <th class="px-4 py-2 text-center text-gray-700 border-b">Juin</th>
                                            <th class="px-4 py-2 text-center text-gray-700 border-b">Juillet</th>
                                            <th class="px-4 py-2 text-center text-gray-700 border-b">Août</th>
                                            <th class="px-4 py-2 text-center text-gray-700 border-b">Septembre</th>
                                            <th class="px-4 py-2 text-center text-gray-700 border-b">Octobre</th>
                                            <th class="px-4 py-2 text-center text-gray-700 border-b">Novembre</th>
                                            <th style="font-size:16px;border-right: thick double #949394;" class="px-4 py-2 text-center text-gray-700 border-b">Décembre</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Apports en capital</td>
                                            <td class="border-black text-center border border-black numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                        </tr>

                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Apports en C.C.</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                        </tr>

                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Emprunts</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                        </tr>

                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Ventes</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalVente[$now . "-01"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalVente[$now . "-02"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalVente[$now . "-03"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalVente[$now . "-04"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalVente[$now . "-05"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalVente[$now . "-06"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalVente[$now . "-07"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalVente[$now . "-08"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalVente[$now . "-09"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalVente[$now . "-10"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalVente[$now . "-11"] ?? 0.0}}</td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true">{{$totalVente[$now . "-12"] ?? 0.0}}</td>
                                        </tr>

                                        <tr class="total-ca bg-gray-50">
                                            <td  style="font-size:16px;border-left: thick double #949394;" class="border-black text-left border">Total CA</td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell"></td>
                                        </tr>

                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Remb. crédit TVA</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                        </tr>
                                        
                                        <tr class="total-encaissements bg-gray-200">
                                            <td  style="font-size:16px;border-left: thick double #949394;" class="border-black text-left border" contenteditable="false">T. encaissements</td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell"></td>
                                        </tr>

                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Imm. corporelles</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$montantsImmobilisationsParMois[1]}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$montantsImmobilisationsParMois[2]}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$montantsImmobilisationsParMois[3]}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$montantsImmobilisationsParMois[4]}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$montantsImmobilisationsParMois[5]}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$montantsImmobilisationsParMois[6]}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$montantsImmobilisationsParMois[7]}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$montantsImmobilisationsParMois[8]}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$montantsImmobilisationsParMois[9]}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$montantsImmobilisationsParMois[10]}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$montantsImmobilisationsParMois[11]}}</td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true">{{$montantsImmobilisationsParMois[12]}}</td>
                                        </tr>

                                        <tr class="total-immobilisations bg-gray-50">
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border">Total Immobilisat.</td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell"></td>
                                        </tr>

                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Échances empr.</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                        </tr>

                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Achats marchand.</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalAchat[$now . "-01"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalAchat[$now . "-02"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalAchat[$now . "-03"] ?? 0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalAchat[$now . "-04"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalAchat[$now . "-05"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalAchat[$now . "-06"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalAchat[$now . "-07"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalAchat[$now . "-08"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalAchat[$now . "-09"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalAchat[$now . "-10"] ?? 0.0}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$totalAchat[$now . "-11"] ?? 0.0}}</td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true">{{$totalAchat[$now . "-12"] ?? 0.0}}</td>
                                        </tr>

                                        <tr class="total-achats bg-gray-50">
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border">Total Achats</td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell"></td>
                                        </tr>

                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Fouritures</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                        </tr>

                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Consommables</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                        </tr>

                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Services exteri.</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                        </tr>

                                        <tr class="total-charges-externes bg-gray-50">
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border">Total Charges ext.</td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell"></td>
                                        </tr>

                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Etat-impôt</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                        </tr>

                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Salaires nets</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$salaire}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$salaire}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$salaire}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$salaire}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$salaire}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$salaire}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$salaire}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$salaire}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$salaire}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$salaire}}</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true">{{$salaire}}</td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true">{{$salaire}}</td>
                                        </tr>

                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Charges sociales</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                        </tr>

                                        <tr class="total-charges-employes bg-gray-50">
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border">T. Char. employés</td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell"></td>
                                        </tr>

                                        <tr>
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">TVA à payer</td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                        </tr>

                                        <tr class="total-decaissements bg-gray-200">
                                            <td  style="font-size:16px;border-left: thick double #949394;" class="border-black text-left border" contenteditable="false">T. décaissements</td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell"></td>
                                        </tr>

                                        <tr class="solde-precedent">
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Solde précédent</td>
                                            <td class="border-black text-center border solde-precedent-debut" contenteditable="true"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell"></td>
                                        </tr>

                                        <tr class="variation-tresorerie">
                                            <td  style="font-size:16px;border-left: thick double #949394;"  class="border-black text-left border" contenteditable="false">Var. Trésorerie</td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell" contenteditable="true"></td>
                                        </tr>

                                        <tr class="solde-tresorerie bg-gray-200" style="font-size:16px;border-bottom: thick double #949394;">
                                            <td  style="font-size:16px;border-left: thick double #949394;" class="border-black text-left border" contenteditable="false">Solde trésorerie</td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td class="border-black text-center border numeric-cell"></td>
                                            <td style="font-size:16px;border-right: thick double #949394;" class="border-black text-center border numeric-cell"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 flex justify-end pr-3 pb-3">
                        <button id="addBtn" class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-bleu-600">Enregistrer</button>
                    </div>
                </div> 
            </div>
        </div>
    </div>

    <script>

        sendData();

        function sendData(){
            document.getElementById('addBtn').addEventListener('click', function () {
                const table = document.querySelector('#editableTable');
                const tableau = [];

                table.querySelectorAll('tbody tr').forEach(function (tr, rowIndex) {
                    tr.querySelectorAll('td').forEach(function (td, colIndex) {
                        if (!tableau[colIndex]) {
                            tableau[colIndex] = [];
                        }
                        
                        tableau[colIndex][rowIndex] = (convertirEnNombre(td.textContent.trim()) || 0.00);
                    });
                });


                $.ajax({
                    url: '/store-compte-tresorerie',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        donnees: tableau
                     },
                    success: function(response) {
                        if(response.ok){
                            toastr.success('Données inserées avec succès.');
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        toastr.error('Erreur de connexion. Veuillez réessayer.');
                    }
                });
            });

        }

       
        document.querySelectorAll('.numeric-cell').forEach((cell) => {
            controlCellInput(cell);
            cell.addEventListener('input', function () {
                const cellIndex = parseInt(Array.from(this.parentNode.children).indexOf(this));
                const rowIndex = parseInt(Array.from(this.parentNode.parentNode.children).indexOf(this.parentNode)) + 1;

                const rowGroups = {
                    caRows: [1, 2, 3, 4],
                    encaissementsRows: [1, 2, 3, 4, 6],
                    immobilisationsRows: [8],
                    achats: [10, 11],
                    chargesExternes: [13, 14, 15],
                    chargesEmployes: [17, 18, 19],
                    decaissementsRows: [8, 10, 11, 13, 14, 15, 17, 18, 19, 21],
                };

                Object.entries(rowGroups).forEach(([group, rows]) => {
                    if (rows.includes(rowIndex)) {
                        const totalRowSelector = `.total-${group.replace('Rows', '').toLowerCase()}`;
                        updateMonthTotal(cellIndex, rows, totalRowSelector);
                    }
                });

                // Mise à jour de la trésorerie
                const encaissements = parseFloat(document.querySelector('.total-encaissements').children[cellIndex]?.textContent) || 0;
                const decaissements = parseFloat(document.querySelector('.total-decaissements').children[cellIndex]?.textContent) || 0;
                const soldePrecedent = cellIndex !== 1 ? (parseFloat(document.querySelector('.solde-tresorerie').children[cellIndex - 1]?.textContent) || 0) : (parseFloat(document.querySelector('.solde-precedent').children[1]?.textContent) || 0);

                const variationTresorerie = encaissements - decaissements;
                const soldeTresorerie = soldePrecedent + variationTresorerie;

                if (!isNaN(variationTresorerie)) {
                    document.querySelector('.variation-tresorerie').children[cellIndex].textContent = variationTresorerie.toFixed(2);
                }
                if (!isNaN(soldePrecedent) && cellIndex !== 1) {
                    document.querySelector('.solde-precedent').children[cellIndex].textContent = soldePrecedent.toFixed(2);
                }
                if (!isNaN(soldeTresorerie)) {
                    document.querySelector('.solde-tresorerie').children[cellIndex].textContent = soldeTresorerie.toFixed(2);
                }
            });
        });

        const soldePrecedentElement = document.querySelector('#editableTable tbody tr.solde-precedent .solde-precedent-debut');
        controlCellInput(soldePrecedentElement);
        const soldeTresorerieElement = document.querySelector('.solde-tresorerie').children[1];
        const variationTresorerieElement = document.querySelector('.variation-tresorerie').children[1];

        soldePrecedentElement.addEventListener('input', function () {
            const soldePrecedent = parseFloat(this.textContent) || 0;
            const variationTresorerie = parseFloat(variationTresorerieElement.textContent) || 0;
            soldeTresorerieElement.textContent = (soldePrecedent + variationTresorerie).toFixed(2);
        });





        const mois = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        function updateMonthTotal(cellIndex, elementRows, totalRow) {
            let total = 0;
            document.querySelectorAll('#editableTable tbody tr').forEach((row, index) => {
                if (elementRows.includes(index + 1)) {
                    const value = parseFloat(row.children[cellIndex].textContent) || 0;
                    total += value;
                }
            });
            const totalCell = document.querySelector(totalRow)?.children[cellIndex];
            if (totalCell) {
                totalCell.textContent = total.toFixed(2);
            }
        }
    </script>

    
    <div id="pageEstCompteDeTresorerie" class="hidden"></div>
@endsection
