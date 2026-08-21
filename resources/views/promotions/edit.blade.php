<x-app-layout>
    <x-http-message-swal />

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen rounded-2xl border border-gray-200 bg-white px-5 py-7 dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">

            <div class="px-5 py-4 sm:px-6 sm:py-5 flex">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Modifier une promotion
                </h3>
            </div>

            <form action="{{ route('promotions.update', $promotion->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="px-5 py-4 sm:px-6 sm:py-5">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                            Éditer une Promotion
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
                                :value="old('nom', $promotion->nom)"
                                autofocus
                                autocomplete="name" />
                            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                        </div>
                        <div class="col-span-6 lg:col-span-6">
                            <x-input-label for="annee_creation" :value="__('Année de création')" />
                            <x-text-input
                                id="annee_creation"
                                class="w-full"
                                type="number"
                                name="annee_creation"
                                :value="old('annee_creation', $promotion->annee_creation)"
                                autocomplete="off" />
                            <x-input-error :messages="$errors->get('annee_creation')" class="mt-2" />
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

                        <x-primary-button type="submit">
                            {{ __('Mettre à jour') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>