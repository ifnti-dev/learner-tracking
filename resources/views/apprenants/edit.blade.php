<x-app-layout>
    <x-http-message-swal />

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 bg-gray-50 dark:bg-gray-900">


        <div
            class="min-h-screen rounded-2xl border border-gray-200 bg-white px-5 py-7 dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex ">
                <h3
                    class="text-base font-medium text-gray-800 dark:text-white/90">
                    Apprenants
                </h3>


            </div>
            <form action="{{ route('apprenants.update',$apprenant->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div
                    class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="px-5 py-4 sm:px-6 sm:py-5">
                        <h3
                            class="text-base font-medium text-gray-800 dark:text-white/90">
                            Ajouter un apprenant
                        </h3>
                    </div>
                    <div
                        class="grid grid-cols-12 gap-4 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                        <!-- Elements -->

                        <div class="col-span-12 lg:col-span-6">
                            <x-input-label for="nom" :value="__('Nom')" />
                            <x-text-input id="nom" class="" type="text" name="nom" :value="old('nom',$apprenant->nom)" required autofocus />
                            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                        </div>

                        <!-- Elements -->

                        <div class="col-span-12 lg:col-span-6">
                            <x-input-label for="prenom" :value="__('Prénom')" />
                            <x-text-input id="prenom" class="" type="text" name="prenom" :value="old('prenom',$apprenant->prenom)" required autofocus />
                            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                        </div>

                        <div class="col-span-12 lg:col-span-2">
                            <x-input-label for="sexe" :value="__('Sexe')" />

                            <!-- Initialisation d'une vraie valeur par défaut pour Alpine -->
                            <div
                                x-data="{ selectedType: '{{ old('sexe', $apprenant->sexe) }}' }"
                                class="relative z-20 bg-transparent flex items-center">

                                <select
                                    name="sexe"
                                    id="sexe"
                                    x-model="selectedType"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                                    <option value="M" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Homme
                                    </option>
                                    <option value="F" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Femme
                                    </option>

                                </select>


                            </div>
                        </div>



                        <div class="col-span-12 lg:col-span-3">
                            <x-input-label for="date_naissance" :value="__('Date de naissance')" />
                            <div class="relative">
                                <input id="date_naissance" name="date_naissance" type="date" value="{{ old('date_naissance',$apprenant->date_naissance) }}" placeholder="Select date" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" onclick="this.showPicker()">
                                <span class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z" fill=""></path>
                                    </svg>
                                </span>
                            </div>
                            <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
                        </div>

                        <div class="col-span-12 lg:col-span-4"
                            x-data="{
                            selectedCountry: 'TG',
                            countryCodes: {
                                'US': '+1',
                                'GB': '+44',
                                'CA': '+1',
                                'AU': '+61',
                                'TG': '+228',
                            },
                            phoneNumber: ''
                        }">
                            <x-input-label for="telephone" :value="__('Téléphone')" />
                            <div class="relative">
                                <div class="absolute">
                                    <select
                                        x-model="selectedCountry"
                                        @change="phoneNumber = countryCodes[selectedCountry]"
                                        class="focus:border-brand-300 focus:ring-brand-500/10 appearance-none rounded-l-lg border-0 border-r border-gray-200 bg-transparent bg-none py-3 pr-8 pl-3.5 leading-tight text-gray-700 focus:ring-3 focus:outline-hidden dark:border-gray-800 dark:text-gray-400">
                                        <option
                                            value="US"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            US
                                        </option>
                                        <option
                                            value="GB"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            GB
                                        </option>
                                        <option
                                            value="CA"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            CA
                                        </option>
                                        <option
                                            value="AU"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            AU
                                        </option>
                                        <option
                                            value="TG"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            TG
                                        </option>
                                        <!-- Add more country codes as needed -->
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-700 dark:text-gray-400">
                                        <svg
                                            class="stroke-current"
                                            width="20"
                                            height="20"
                                            viewBox="0 0 20 20"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396"
                                                stroke=""
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                                <x-number-input id="telephone" class="pl-[84px]" type="text" name="telephone" :value="old('telephone',$apprenant->telephone)" required autofocus autocomplete="username" />
                            </div>
                            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                        </div>

                        <div class="col-span-12 lg:col-span-3">
                            <x-input-label for="adresse" :value="__('Adresse')" />
                            <x-text-input id="adresse" class="" type="text" name="adresse" :value="old('adresse',$apprenant->adresse)" required autofocus />
                            <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                        </div>
                        <!-- Elements -->
                        <div class="col-span-12 lg:col-span-6">
                            <x-input-label for="email" :value="__('Email')" />
                            <div class="relative">
                                <span
                                    class="absolute top-1/2 left-0 -translate-y-1/2 border-r border-gray-200 px-3.5 py-3 text-gray-500 dark:border-gray-800 dark:text-gray-400">
                                    <svg
                                        width="20"
                                        height="20"
                                        viewBox="0 0 20 20"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M3.04175 7.06206V14.375C3.04175 14.6511 3.26561 14.875 3.54175 14.875H16.4584C16.7346 14.875 16.9584 14.6511 16.9584 14.375V7.06245L11.1443 11.1168C10.457 11.5961 9.54373 11.5961 8.85638 11.1168L3.04175 7.06206ZM16.9584 5.19262C16.9584 5.19341 16.9584 5.1942 16.9584 5.19498V5.20026C16.9572 5.22216 16.946 5.24239 16.9279 5.25501L10.2864 9.88638C10.1145 10.0062 9.8862 10.0062 9.71437 9.88638L3.07255 5.25485C3.05342 5.24151 3.04202 5.21967 3.04202 5.19636C3.042 5.15695 3.07394 5.125 3.11335 5.125H16.8871C16.9253 5.125 16.9564 5.15494 16.9584 5.19262ZM18.4584 5.21428V14.375C18.4584 15.4796 17.563 16.375 16.4584 16.375H3.54175C2.43718 16.375 1.54175 15.4796 1.54175 14.375V5.19498C1.54175 5.1852 1.54194 5.17546 1.54231 5.16577C1.55858 4.31209 2.25571 3.625 3.11335 3.625H16.8871C17.7549 3.625 18.4584 4.32843 18.4585 5.19622C18.4585 5.20225 18.4585 5.20826 18.4584 5.21428Z"
                                            fill="#667085" />
                                    </svg>
                                </span>
                                <x-email-input id="email" class="" type="email" name="email" :value="old('email',$apprenant->email)" required autofocus autocomplete="username" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="col-span-12 lg:col-span-6">
                            <x-input-label for="etablissement" :value="__('Établissement')" />
                            <x-text-input id="etablissement" class="" type="text" name="etablissement" :value="old('etablissement',$apprenant->etablissement)" required autofocus />
                            <x-input-error :messages="$errors->get('etablissement')" class="mt-2" />
                        </div>
                        <!-- Elements -->

                        <div class="col-span-12 space-x-2">
                            <x-input-label for="personnes_reponsable_id" :value="__('Parents/Tuteur')" />
                            <div class="flex space-x-2">
                                <div class="w-1/2" x-data="{ selectedType: String('{{ old('personnes_reponsable_id', $apprenant->personneResponsables()->first()->id ?? '') }}') }">
                                    <select
                                        name="personnes_reponsable_id"
                                        id="personne_reponsables_id"
                                        x-model="selectedType"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                                        @foreach ($personne_reponsables as $personnes_reponsable)
                                        <option :value="String('{{ $personnes_reponsable->id }}')">
                                            {{ $personnes_reponsable->nom }} {{ $personnes_reponsable->prenom }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="w-1/2 ">
                                    <x-primary-button>
                                        <a href="{{ route('personne-responsables.index') }}">
                                            {{ __('Ajouter un personnes reponsables') }}
                                        </a>
                                    </x-primary-button>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('personnes_reponsable_id')" class="mt-2" />

                        </div>





                        <div class="px-5 py-4 sm:px-6 sm:py-5 flex ">


                            <div class="justify-end ml-auto flex space-x-2">
                                <x-secondary-button>
                                    <a href="{{ route('apprenants.index') }}">
                                        {{ __('Annuler') }}
                                    </a>
                                </x-secondary-button>



                                <x-primary-button type="submit">
                                    {{ __('Enregistrer') }}
                                </x-primary-button>

                            </div>
                        </div>
            </form>
        </div>

    </div>
</x-app-layout>