<x-app-layout>
    <x-http-message-swal />

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 bg-gray-50 dark:bg-gray-900">


        <div
            class="min-h-screen rounded-2xl border border-gray-200 bg-white px-5 py-7 dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex ">
                <h3
                    class="text-base font-medium text-gray-800 dark:text-white/90">
                    Personne Responsables
                </h3>


            </div>
            <form action="{{ route('personne-responsables.store') }}" method="POST">
                @csrf
                <div
                    class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="px-5 py-4 sm:px-6 sm:py-5">
                        <h3
                            class="text-base font-medium text-gray-800 dark:text-white/90">
                            Ajouter un tuteur
                        </h3>
                    </div>
                    <div
                        class=" gap-4 grid grid-cols-12 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                        <!-- Elements -->

                        <div class="col-span-12 lg:col-span-6">
                            <x-input-label for="nom" :value="__('Nom')" />
                            <x-text-input id="nom" class="" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                        </div>

                        <!-- Elements -->

                        <div class="col-span-12 lg:col-span-6">
                            <x-input-label for="prenom" :value="__('Prénom')" />
                            <x-text-input id="prenom" class="" type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                        </div>

                        <!-- Elements -->
                        
                        <div class="col-span-12 lg:col-span-4">
                            <x-input-label for="type" :value="__('Type')" />

                            <!-- Initialisation d'une vraie valeur par défaut pour Alpine -->
                            <div
                                x-data="{ selectedType: '{{ old('type', 'TUTEUR') }}' }"
                                class="relative z-20 bg-transparent flex items-center">

                                <select
                                    name="type"
                                    id="type"
                                    x-model="selectedType"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                                    <option value="TUTEUR" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Tuteur
                                    </option>
                                    <option value="PERE" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Père
                                    </option>
                                    <option value="MERE" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Mère
                                    </option>
                                </select>

                                
                            </div>
                        </div>


                        <!-- Elements -->
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
                                <x-number-input id="telephone" class="pl-[84px]" type="text" name="telephone" :value="old('telephone')" required autofocus autocomplete="username" />
                            </div>
                            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                        </div>

                    </div>
                </div>
                <div class="px-5 py-4 sm:px-6 sm:py-5 flex ">


                    <div class="justify-end ml-auto flex space-x-2">
                        <x-secondary-button>
                            <a href="{{ route('personne-responsables.index') }}">
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