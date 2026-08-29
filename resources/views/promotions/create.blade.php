<x-app-layout>

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen rounded-2xl border border-gray-200 bg-white px-5 py-7 dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">

            <div class="px-5 py-4 sm:px-6 sm:py-5 flex">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    création d'une promotion
                </h3>
            </div>
            <form action="{{ route('promotions.store') }}" method="POST">
                @csrf

                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="px-5 py-4 sm:px-6 sm:py-5">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                            Ajouter une Promotion
                        </h3>
                    </div>
                    <div class="grid grid-cols-12 gap-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                        <div class="col-span-6 lg:col-span-6">
                            <x-input-label for="nom" :value="__('Nom')" />
                            <x-text-input
                                id="nom"
                                class="w-full"
                                type="text"
                                name="nom"
                                :value="old('nom')"
                                autofocus
                                autocomplete="name" />
                            <x-input-error :messages="$errors->get('nom')" class="mt-2 " />
                        </div>
                        <div class="col-span-6 lg:col-span-6">
                            <x-input-label for="annee_creation" :value="__('Annee de creation')" />
                            <x-text-input
                                id="annee_creation"
                                class="w-full"
                                type="number"
                                name="annee_creation"
                                :value="old('annee_creation')"
                                autocomplete="name" />
                            <x-input-error :messages="$errors->get('annee_creation')" class="mt-2" />
                        </div>
                        <div class="col-span-6 lg:col-span-6">
                            <x-input-label for="date" :value="__('Date limite')" />
                            <x-text-input
                                id="date_limite"
                                class="w-full"
                                type="date"
                                name="date_limite"
                                :value="old('date_limite')"
                                autofocus
                                autocomplete="name" />
                            <x-input-error :messages="$errors->get('date_limite')" class="mt-2 " />
                        </div>

                        <div class="col-span-3 lg:col-span-3">
                            <x-input-label for="type" :value="__('Est Active')" />
                            <div
                                x-data="{ selectedType: '{{ old('est_active', 'oui') }}' }"
                                class="relative z-20 bg-transparent flex items-center">

                                <select
                                    name="est_active"
                                    id="est_active"
                                    x-model="selectedType"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                                    <option value="oui" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Oui
                                    </option>
                                    <option value="oui" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Oui
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('active')" class="mt-2 " />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-4 sm:px-6 sm:py-5 flex">
                    <div class="justify-end ml-auto flex space-x-2">
                        <x-secondary-button>
                            <a href="{{ route('promotions.index') }}">
                                {{ __('Annuler') }}
                            </a>
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('Enregistrer') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>