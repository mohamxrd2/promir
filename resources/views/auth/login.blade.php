@extends('layouts.app')
@section('content')
    <div class="mb-0 w-screen lg:mx-auto lg:w-[500px] card shadow-lg border-none shadow-slate-100 relative">
        <div class="!px-10 !py-12 card-body">
            {{-- <a href="#!">
                <img src="assets/images/logo-light.png" alt="" class="hidden h-6 mx-auto dark:block">
                <img src="assets/images/logo-promir.png" alt="" class="block h-6 mx-auto dark:hidden">
            </a>  --}}

            <div class="mt-8 text-center">
                <h4 class="mb-1 text-custom-500 dark:text-custom-500">Bienvenue !</h4>
                <p class="text-slate-500 dark:text-zink-200">Connectez-vous pour en profiter!</p>
            </div>

            <form action="{{ route('login') }}" class="mt-10" id="" method="POST">
                @csrf
                <div class="hidden px-4 py-3 mb-3 text-sm text-green-500 border border-green-200 rounded-md bg-green-50 dark:bg-green-400/20 dark:border-green-500/50" id="successAlert">
                    Connexion <b>établie</b> avec succès.
                </div>
                <div class="mb-3">
                    <label for="username" class="inline-block mb-2 text-base font-medium">Email ou nom d'utilisateur</label>
                    <input type="text" id="email" name="email" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    <div id="username-error" class="hidden mt-1 text-sm text-red-500">Entrez une adresse mail valide.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="inline-block mb-2 text-base font-medium">Mot de passe</label>
                    <input type="password" id="password" name="password" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Tapez ici...">
                    <div id="password-error" class="hidden mt-1 text-sm text-red-500">Le mot de passe doit contenir au moins 8 caractères composés de lettres et de chiffres.</div>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <input id="checkboxDefault1" class="border rounded-sm appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400" type="checkbox" value="">
                        <label for="checkboxDefault1" class="inline-block text-base font-medium align-middle cursor-pointer">Se souvenir de moi</label>
                    </div>
                    {{-- <div id="remember-error" class="hidden mt-1 text-sm text-red-500">Please check the "Remember me" before submitting the form.</div> --}}
                </div>
                <div class="mt-10">
                    <button type="submit" class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Se connecter</button>
                </div>

                <!-- <div class="relative text-center my-9 before:absolute before:top-3 before:left-0 before:right-0 before:border-t before:border-t-slate-200 dark:before:border-t-zink-500">
                    <h5 class="inline-block px-2 py-0.5 text-sm bg-white text-slate-500 dark:bg-zink-600 dark:text-zink-200 rounded relative">Se connecter avec</h5>
                </div>

                <div class="flex flex-wrap justify-center gap-2">
                    <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600"><i data-lucide="facebook" class="size-4"></i></button>
                    <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-orange-500 border-orange-500 hover:text-white hover:bg-orange-600 hover:border-orange-600 focus:text-white focus:bg-orange-600 focus:border-orange-600 active:text-white active:bg-orange-600 active:border-orange-600"><i data-lucide="mail" class="size-4"></i></button>
                    <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-sky-500 border-sky-500 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 active:text-white active:bg-sky-600 active:border-sky-600"><i data-lucide="twitter" class="size-4"></i></button>
                </div> -->

                <div class="mt-10 text-center">
                    <p class="mb-0 text-slate-500 dark:text-zink-200">Pas de compte ?
                        <a href="{{ route('register') }}" class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500"> Créez-en pour votre entreprise</a>
                    </p>
                </div>
            </form>
        </div>
    </div> 
    @section('script')
       
    @endsection
@endsection
