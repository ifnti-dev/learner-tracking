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
            <form action="{{ route('apprenants.store') }}" method="POST">
                @csrf
                <div
                    class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="px-5 py-4 sm:px-6 sm:py-5">
                        <h3
                            class="text-base font-medium text-gray-800 dark:text-white/90">
                            Ajouter un apprenant
                        </h3>
                    </div>
                    <div
                        class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                        <!-- Elements -->

                        <div>
                            <x-input-label for="etablissement" :value="__('Établissement')" />
                            <x-text-input id="etablissement" class="" type="text" name="etablissement" :value="old('etablissement')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('etablissement')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="candidat_id" :value="__('Candidat')" />
                            <select name="candidat_id" id="candidat_id" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                @foreach ($candidats as $candidat)
                                    <option value="{{ $candidat->id }}" {{ old('candidat_id') == $candidat->id ? 'selected' : '' }}>
                                        {{ $candidat->prenom }} {{ $candidat->nom }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('candidat_id')" class="mt-2" />
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