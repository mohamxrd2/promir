@extends('layouts.app')
@section('content')
    <div class="mb-0 w-screen lg:w-[500px] card shadow-lg border-none shadow-slate-100 relative">
        <div class="!px-10 !py-12 card-body">
            {{-- <a href="#!">
                <img src="assets/images/logo-light.png" alt="" class="hidden h-6 mx-auto dark:block">
                <img src="assets/images/logo-dark.png" alt="" class="block h-6 mx-auto dark:hidden">
            </a> --}}

            <div class="mt-8 text-center">
                <h4 class="mb-1 text-custom-500 dark:text-custom-500">Créez votre compte gratuitement</h4>
                <p class="text-slate-500 dark:text-zink-200">Créez un compte maintenant pour gérer votre entreprise</p>
            </div>

            <form action="{{ route('register') }}" class="mt-10" method="POST">
                @csrf
                <div id="firstSection">
                    <div class="mb-3">
                        <label for="username-field" class="inline-block mb-2 text-base font-medium">Votre nom</label>
                        <input type="text" name="name" id="username-field" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>

                    <div class="mb-3">
                        <label for="last_stname-field" class="inline-block mb-2 text-base font-medium">Votre prénom</label>
                        <input type="text" name="last_stname" id="last_stname-field" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="phone_number-field" class="inline-block mb-2 text-base font-medium">Votre téléphone</label>
                        <input type="text" name="phone_number" id="phone_number-field" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="second_phone_number-field" class="inline-block mb-2 text-base font-medium">Votre deuxième téléphone</label>
                        <input type="text" name="second_phone_number" id="second_phone_number-field" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>

                    <div class="mb-3">
                        <label for="email-field" class="inline-block mb-2 text-base font-medium">Votre Email</label>
                        <input type="mail" name="email" id="email-field" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="inline-block mb-2 text-base font-medium">Votre mot de passe</label>
                        <input type="password" name="password" id="password" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="inline-block mb-2 text-base font-medium">Confirmez votre mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="gender" required class="inline-block mb-2 text-base font-medium">Votre genre</label>
                        <select id="gender" name="gender" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                            <option value="homme">Homme</option>
                            <option value="femme">Femme</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fonction" required class="inline-block mb-2 text-base font-medium">Votre fonction au sein de l'entreprise</label>
                        <select id="fonction" name="fonction" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                            <option value="Directeur général" selected>Directeur général</option>
                            <option value="Directeur Informatique et technique" >Directeur Informatique et technique</option>
                            <option value="Secrétaire DG">Secrétaire DG</option>
                            <option value="Analyste des relations client">Analyste des relations client</option>
                            <option value="Gestionnaire commercial">Gestionnaire commercial</option>
                            <option value="Manager">Manager</option>
                            <option value="DRH">DRH</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                    
                </div>

                <div id="secondSection" style="display: none;">
                    <div class="mb-3">
                        <label for="deno_sociale-field" class="inline-block mb-2 text-base font-medium">Dénomination sociale</label>
                        <input type="text" name="deno_sociale" id="deno_sociale-field" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                   
                    <div class="mb-3">
                        <label for="devise"  class="inline-block mb-2 text-base font-medium">Devise</label>
                        <select id="devise-field" required name="devise" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                            <option selected disabled value="">Choisir votre devise</option>
                            <option value="XOF">CFA Franc BCEAO (XOF)</option>
                            <option value="XAF">CFA Franc BEAC (XAF)</option>
                            <option value="AFN">Afghani (AFN)</option>
                            <option value="ALL">Lek (ALL)</option>
                            <option value="DZD">Algerian Dinar (DZD)</option>
                            <option value="USD">US Dollar (USD)</option>
                            <option value="EUR">Euro (EUR)</option>
                            <option value="AOA">Kwanza (AOA)</option>
                            <option value="XCD">East Caribbean Dollar (XCD)</option>
                            <option value="ARS">Argentine Peso (ARS)</option>
                            <option value="AMD">Armenian Dram (AMD)</option>
                            <option value="AWG">Aruban Florin (AWG)</option>
                            <option value="AUD">Australian Dollar (AUD)</option>
                            <option value="AZN">Azerbaijan Manat (AZN)</option>
                            <option value="BSD">Bahamian Dollar (BSD)</option>
                            <option value="BHD">Bahraini Dinar (BHD)</option>
                            <option value="BDT">Taka (BDT)</option>
                            <option value="BBD">Barbados Dollar (BBD)</option>
                            <option value="BYN">Belarusian Ruble (BYN)</option>
                            <option value="BZD">Belize Dollar (BZD)</option>
                            <option value="BMD">Bermudian Dollar (BMD)</option>
                            <option value="INR">Indian Rupee (INR)</option>
                            <option value="BTN">Ngultrum (BTN)</option>
                            <option value="BOB">Boliviano (BOB)</option>
                            <option value="BOV">Mvdol (BOV)</option>
                            <option value="BAM">Convertible Mark (BAM)</option>
                            <option value="BWP">Pula (BWP)</option>
                            <option value="NOK">Norwegian Krone (NOK)</option>
                            <option value="BRL">Brazilian Real (BRL)</option>
                            <option value="BND">Brunei Dollar (BND)</option>
                            <option value="BGN">Bulgarian Lev (BGN)</option>
                            <option value="BIF">Burundi Franc (BIF)</option>
                            <option value="CVE">Cabo Verde Escudo (CVE)</option>
                            <option value="KHR">Riel (KHR)</option>
                            <option value="CAD">Canadian Dollar (CAD)</option>
                            <option value="KYD">Cayman Islands Dollar (KYD)</option>
                            <option value="CLP">Chilean Peso (CLP)</option>
                            <option value="CLF">Unidad de Fomento (CLF)</option>
                            <option value="CNY">Yuan Renminbi (CNY)</option>
                            <option value="COP">Colombian Peso (COP)</option>
                            <option value="COU">Unidad de Valor Real (COU)</option>
                            <option value="KMF">Comorian Franc (KMF)</option>
                            <option value="CDF">Congolese Franc (CDF)</option>
                            <option value="NZD">New Zealand Dollar (NZD)</option>
                            <option value="CRC">Costa Rican Colon (CRC)</option>
                            <option value="HRK">Kuna (HRK)</option>
                            <option value="CUP">Cuban Peso (CUP)</option>
                            <option value="CUC">Peso Convertible (CUC)</option>
                            <option value="ANG">Netherlands Antillean Guilder (ANG)</option>
                            <option value="CZK">Czech Koruna (CZK)</option>
                            <option value="DKK">Danish Krone (DKK)</option>
                            <option value="DJF">Djibouti Franc (DJF)</option>
                            <option value="DOP">Dominican Peso (DOP)</option>
                            <option value="EGP">Egyptian Pound (EGP)</option>
                            <option value="SVC">El Salvador Colon (SVC)</option>
                            <option value="ERN">Nakfa (ERN)</option>
                            <option value="SZL">Swazi Lilangeni (SZL)</option>
                            <option value="ETB">Ethiopian Birr (ETB)</option>
                            <option value="FJD">Fiji Dollar (FJD)</option>
                            <option value="XOF">CFA Franc BCEAO (XOF)</option>
                            <option value="XPF">CFP Franc (XPF)</option>
                            <option value="GMD">Dalasi (GMD)</option>
                            <option value="GEL">Lari (GEL)</option>
                            <option value="GHS">Ghana Cedi (GHS)</option>
                            <option value="GIP">Gibraltar Pound (GIP)</option>
                            <option value="GTQ">Quetzal (GTQ)</option>
                            <option value="GBP">Pound Sterling (GBP)</option>
                            <option value="GNF">Guinean Franc (GNF)</option>
                            <option value="GYD">Guyana Dollar (GYD)</option>
                            <option value="HTG">Gourde (HTG)</option>
                            <option value="HNL">Lempira (HNL)</option>
                            <option value="HKD">Hong Kong Dollar (HKD)</option>
                            <option value="HUF">Forint (HUF)</option>
                            <option value="ISK">Iceland Krona (ISK)</option>
                            <option value="INR">Indian Rupee (INR)</option>
                            <option value="IDR">Rupiah (IDR)</option>
                            <option value="XDR">SDR (IMF) (XDR)</option>
                            <option value="IRR">Iranian Rial (IRR)</option>
                            <option value="IQD">Iraqi Dinar (IQD)</option>
                            <option value="ILS">New Israeli Sheqel (ILS)</option>
                            <option value="JMD">Jamaican Dollar (JMD)</option>
                            <option value="JPY">Yen (JPY)</option>
                            <option value="JOD">Jordanian Dinar (JOD)</option>
                            <option value="KZT">Tenge (KZT)</option>
                            <option value="KES">Kenyan Shilling (KES)</option>
                            <option value="KPW">North Korean Won (KPW)</option>
                            <option value="KRW">Won (KRW)</option>
                            <option value="KWD">Kuwaiti Dinar (KWD)</option>
                            <option value="KGS">Som (KGS)</option>
                            <option value="LAK">Lao Kip (LAK)</option>
                            <option value="LBP">Lebanese Pound (LBP)</option>
                            <option value="LSL">Loti (LSL)</option>
                            <option value="LRD">Liberian Dollar (LRD)</option>
                            <option value="LYD">Libyan Dinar (LYD)</option>
                            <option value="CHF">Swiss Franc (CHF)</option>
                            <option value="MOP">Pataca (MOP)</option>
                            <option value="MKD">Denar (MKD)</option>
                            <option value="MGA">Malagasy Ariary (MGA)</option>
                            <option value="MWK">Malawi Kwacha (MWK)</option>
                            <option value="MYR">Malaysian Ringgit (MYR)</option>
                            <option value="MVR">Rufiyaa (MVR)</option>
                            <option value="MRU">Ouguiya (MRU)</option>
                            <option value="MUR">Mauritius Rupee (MUR)</option>
                            <option value="XUA">ADB Unit of Account (XUA)</option>
                            <option value="MXN">Mexican Peso (MXN)</option>
                            <option value="MXV">Mexican Unidad de Inversion (UDI) (MXV)</option>
                            <option value="MDL">Moldovan Leu (MDL)</option>
                            <option value="MNT">Tugrik (MNT)</option>
                            <option value="MAD">Moroccan Dirham (MAD)</option>
                            <option value="MZN">Mozambique Metical (MZN)</option>
                            <option value="MMK">Kyat (MMK)</option>
                            <option value="NAD">Namibia Dollar (NAD)</option>
                            <option value="NPR">Nepalese Rupee (NPR)</option>
                            <option value="NIO">Cordoba Oro (NIO)</option>
                            <option value="NGN">Naira (NGN)</option>
                            <option value="OMR">Rial Omani (OMR)</option>
                            <option value="PKR">Pakistan Rupee (PKR)</option>
                            <option value="PAB">Balboa (PAB)</option>
                            <option value="PGK">Kina (PGK)</option>
                            <option value="PYG">Guarani (PYG)</option>
                            <option value="PEN">Nuevo Sol (PEN)</option>
                            <option value="PHP">Philippine Peso (PHP)</option>
                            <option value="PLN">Zloty (PLN)</option>
                            <option value="QAR">Qatari Rial (QAR)</option>
                            <option value="RON">Romanian Leu (RON)</option>
                            <option value="RUB">Russian Ruble (RUB)</option>
                            <option value="RWF">Rwanda Franc (RWF)</option>
                            <option value="SHP">Saint Helena Pound (SHP)</option>
                            <option value="WST">Tala (WST)</option>
                            <option value="STN">Dobra (STN)</option>
                            <option value="SAR">Saudi Riyal (SAR)</option>
                            <option value="RSD">Serbian Dinar (RSD)</option>
                            <option value="SCR">Seychelles Rupee (SCR)</option>
                            <option value="SLL">Leone (SLL)</option>
                            <option value="SGD">Singapore Dollar (SGD)</option>
                            <option value="XSU">Sucre (XSU)</option>
                            <option value="SBD">Solomon Islands Dollar (SBD)</option>
                            <option value="SOS">Somali Shilling (SOS)</option>
                            <option value="ZAR">South African Rand (ZAR)</option>
                            <option value="SSP">South Sudanese Pound (SSP)</option>
                            <option value="LKR">Sri Lanka Rupee (LKR)</option>
                            <option value="SDG">Sudanese Pound (SDG)</option>
                            <option value="SRD">Surinam Dollar (SRD)</option>
                            <option value="SEK">Swedish Krona (SEK)</option>
                            <option value="SYP">Syrian Pound (SYP)</option>
                            <option value="TWD">New Taiwan Dollar (TWD)</option>
                            <option value="TJS">Somoni (TJS)</option>
                            <option value="TZS">Tanzanian Shilling (TZS)</option>
                            <option value="THB">Baht (THB)</option>
                            <option value="TOP">Pa’anga (TOP)</option>
                            <option value="TTD">Trinidad and Tobago Dollar (TTD)</option>
                            <option value="TND">Tunisian Dinar (TND)</option>
                            <option value="TRY">Turkish Lira (TRY)</option>
                            <option value="TMT">Turkmenistan New Manat (TMT)</option>
                            <option value="UGX">Uganda Shilling (UGX)</option>
                            <option value="UAH">Hryvnia (UAH)</option>
                            <option value="AED">UAE Dirham (AED)</option>
                            <option value="UYU">Peso Uruguayo (UYU)</option>
                            <option value="UZS">Uzbekistan Sum (UZS)</option>
                            <option value="VUV">Vatu (VUV)</option>
                            <option value="VES">Bolívar Soberano (VES)</option>
                            <option value="VND">Dong (VND)</option>
                            <option value="YER">Yemeni Rial (YER)</option>
                            <option value="ZMW">Zambian Kwacha (ZMW)</option>
                            <option value="ZWL">Zimbabwe Dollar (ZWL)</option>
                            
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="type" required class="inline-block mb-2 text-base font-medium">Type d'entreprise</label>
                        <select id="type-field" name="type" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                            <option value="Grande" selected>Grande</option>
                            <option value="Moyenne" >Moyenne</option>
                            <option value="Petite" >Petite</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sigle-field" class="inline-block mb-2 text-base font-medium">Sigle</label>
                        <input type="text" name="sigle" id="sigle-field" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="date_creation-field" class="inline-block mb-2 text-base font-medium">Date de création</label>
                        <input type="date" name="date_creation" id="date_creation-field" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>

                    <div class="mb-3">
                        <label for="pays-field" class="inline-block mb-2 text-base font-medium">Pays</label>
                        <input type="text" name="pays" id="pays-field"required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="region-field" class="inline-block mb-2 text-base font-medium">Région</label>
                        <input type="text" name="region" id="region-field"required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="localite-field" class="inline-block mb-2 text-base font-medium">Localité</label>
                        <input type="text" name="localite" id="localite-field"required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="adresse_geographique-field" class="inline-block mb-2 text-base font-medium">Adresse géographique</label>
                        <input type="text" name="adresse_geographique" id="adresse_geographique-field"required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="tel-field" class="inline-block mb-2 text-base font-medium">Téléphone</label>
                        <input type="text" name="tel" id="tel-field" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="cel-field" class="inline-block mb-2 text-base font-medium">Céllulaire</label>
                        <input type="text" name="cel" id="cel-field" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="mail_entreprise-field" class="inline-block mb-2 text-base font-medium">Adresse mail de l'entreprise</label>
                        <input type="mail" name="mail_entreprise" id="mail_entreprise-field" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="capital_social-field" class="inline-block mb-2 text-base font-medium">Capital social</label>
                        <input value="0" type="number" step="any" name="capital_social" id="capital_social-field" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="nbr_employes-field" class="inline-block mb-2 text-base font-medium">Nombre d'employés</label>
                        <input type="number" min="0" name="nbr_employes" id="nbr_employes-field" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="chiffre_affaire-field" class="inline-block mb-2 text-base font-medium">Chiffre d'affaire</label>
                        <input type="number" name="chiffre_affaire" id="chiffre_affaire-field" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="sect_activite-field" class="inline-block mb-2 text-base font-medium">Secteur d'activité</label>
                        <select required wire:model="sect_activite" name="sect_activite" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                            <option value="">Choisir ici...</option>
                            <option value="MECANIQUE GENERALE">MECANIQUE GENERALE</option>
                            <option value="INDUSTRIE EXTRACTIVES ET PROSPECTION">INDUSTRIE EXTRACTIVES ET PROSPECTION</option>
                            <option value="MINIERE">MINIERE</option>
                            <option value="INDUSTRIE ALIMENTAIRES">INDUSTRIE ALIMENTAIRES</option>
                            <option value="INDUSTRIES DES CORPS GRAS">INDUSTRIES DES CORPS GRAS</option>
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
                            <option value="BATIMENT-TRAVAUX PUBLICS ET ACTIVITES CONNEXES">BATIMENT-TRAVAUX PUBLICS ET ACTIVITES CONNEXES</option>
                            <option value="COMMERCE–NEGOCE–PROFESSIONS LIBERALE">COMMERCE–NEGOCE–PROFESSIONS LIBERALE</option>
                            <option value="AGRICOLE – ELEVAGE - FORESTIER">AGRICOLE – ELEVAGE - FORESTIER</option>
                            <option value="BANQUES">BANQUES</option>
                            <option value="ASSURANCES">ASSURANCES</option>
                            <option value="ENTREPRISES PETROLIERES">ENTREPRISES PETROLIERES</option>
                            <option value="INSTITUTS DE RECHERCHE">INSTITUTS DE RECHERCHE</option>
                            <option value="TRANSPORT DE FONDS ET VALEURS">TRANSPORT DE FONDS ET VALEURS</option>
                            <option value="SECURITE PRIVEE">SECURITE PRIVEE</option>
                            <option value="DOCKERS">DOCKERS</option>
                            <option value="GENS DE MAISON">GENS DE MAISON</option>
                            <option value="ENTREPRISES PETROLIERES (distribution)">ENTREPRISES PETROLIERES (distribution)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="regime_fiscal-field" class="inline-block mb-2 text-base font-medium">Régime fiscal</label>
                        <input type="text" name="regime_fiscal" id="regime_fiscal-field" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="num_cnps-field" class="inline-block mb-2 text-base font-medium">Numéro CNPS</label>
                        <input type="text" name="num_cnps" id="num_cnps-field" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="centre_impot-field" class="inline-block mb-2 text-base font-medium">Centre de rattachement pour les impots</label>
                        <input type="text" name="centre_impot" id="centre_impot-field" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    <div class="mb-3">
                        <label for="num_rccm-field" class="inline-block mb-2 text-base font-medium">Numéro de registre de commerce et de crédit mobilier RCCM</label>
                        <input type="text" name="num_rccm" id="num_rccm-field" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>
                    
                    <div class="mb-3">
                        <label for="lien_site_web-field" class="inline-block mb-2 text-base font-medium">Lien de votre site internet</label>
                        <input type="text" name="lien_site_web" id="lien_site_web-field" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>

                    <div class="mb-3">
                        <label for="lien_page_fbook-field" class="inline-block mb-2 text-base font-medium">Lien de votre page facebook</label>
                        <input type="text" name="lien_page_fbook" id="lien_page_fbook-field" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    </div>

                    <div class="mb-3">
                        <label for="" class="inline-block mb-2 text-base font-medium">À quel(s) jour(s) ne travaillez-vous pas dans la semaine ?</label>
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="trvl_mercredi" name="trvl_mercredi" class="form-checkbox border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                                <label for="trvl_mercredi" class="ml-2">Mercredi</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="trvl_vendredi" name="trvl_vendredi" class="form-checkbox border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                                <label for="trvl_vendredi" class="ml-2">Vendredi</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="trvl_samedi" name="trvl_samedi" class="form-checkbox border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                                <label for="trvl_samedi" class="ml-2">Samedi</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="trvl_dimanche" name="trvl_dimanche" class="form-checkbox border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                                <label for="trvl_dimanche" class="ml-2">Dimanche</label>
                            </div>
                        </div>
                    </div>



                    <p class="italic text-15 text-slate-500 dark:text-zink-200">En vous inscrivant, vous acceptez les <a href="#!" class="underline">termes d'utilisation de PROMIR.</a></p>
                    
                    <div class="mt-10">
                        <button type="submit" class="w-full text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 mb-4">S'inscrire</button>
                    </div>
                   
                </div>


                {{-- <div style=" display: flex;justify-content: flex-end;">
                    <div id="toggleButton" class="inline-flex items-center mr-20 px-4 py-2 bg-blue-300 text-blue-800 font-semibold rounded-lg shadow-md hover:bg-blue-400 cursor-pointer">
                        Suivant
                        <svg class="w-4 h-4 ml-2 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                      </div>
                </div>
                   --}}


                <div class="flex justify-end">
                    <div id="toggleButton" class="inline-flex items-center mr-4 px-4 py-2 bg-blue-300 text-blue-800 font-semibold rounded-lg shadow-md hover:bg-blue-400 cursor-pointer">
                        Suivant
                        <svg class="w-4 h-4 ml-2 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>
                
                  

                <div class="relative text-center my-9 before:absolute before:top-3 before:left-0 before:right-0 before:border-t before:border-t-slate-200 dark:before:border-t-zink-500">
                    <h5 class="inline-block px-2 py-0.5 text-sm bg-white text-slate-500 dark:bg-zink-600 dark:text-zink-200 rounded relative">Créer votre compte avec</h5>
                </div>

                <div class="flex flex-wrap justify-center gap-2">
                    <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600"><i data-lucide="facebook" class="w-4 h-4"></i></button>
                    <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-orange-500 border-orange-500 hover:text-white hover:bg-orange-600 hover:border-orange-600 focus:text-white focus:bg-orange-600 focus:border-orange-600 active:text-white active:bg-orange-600 active:border-orange-600"><i data-lucide="mail" class="w-4 h-4"></i></button>
                    <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-sky-500 border-sky-500 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 active:text-white active:bg-sky-600 active:border-sky-600"><i data-lucide="twitter" class="w-4 h-4"></i></button>
                    <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-slate-500 border-slate-500 hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 active:text-white active:bg-slate-600 active:border-slate-600"><i data-lucide="github" class="w-4 h-4"></i></button>
                </div>
                
                <div class="mt-10 text-center">
                    <p class="mb-0 text-slate-500 dark:text-zink-200">Déjà un compte ?
                        <a href="{{ route('login') }}" class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500">Connectez-vous</a>
                    </p>
                </div>
            </form>
        </div>
    </div>







    <script>
        document.getElementById("toggleButton").addEventListener("click", function() {
            var firstSection = document.getElementById("firstSection");
            var secondSection = document.getElementById("secondSection");
    
            if (firstSection.style.display === "none") {
                firstSection.style.display = "block";
                secondSection.style.display = "none";
                toggleButton.innerHTML = "Suivant <svg class='w-4 h-4 ml-2 text-blue-800' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 5l7 7-7 7'></path></svg>";
            } else {
                firstSection.style.display = "none";
                secondSection.style.display = "block";
                
                toggleButton.innerHTML = "<svg class='w-4 h-4 mr-2 text-blue-800 transform rotate-180' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 19l-7-7 7-7'></path></svg>  Retour";
                
            }
        });
    </script>

@if ($errors->any())
<ul>
    @foreach ($errors->all() as $error)
    <li>
       {{ $error }}
    </li>
@endforeach
</ul>
    
@endif

    @section('script')
       
    @endsection
@endsection
