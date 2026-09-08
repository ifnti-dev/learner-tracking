<x-app-layout>
    <x-http-message-swal />

    <div class="px-5 py-4 sm:px-6 sm:py-6 flex">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Modifier l'Emprunt
        </h3>
    </div>
    <form action="{{ route('emprunts.update', $emprunt->id) }}" method="POST">
        @csrf
        @method('PUT')
            <div class="grid grid-cols-12 gap-6  border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                <div class="col-span-4">
                    <x-input-label for="apprenant_id" value="Apprenant" />
                    <select name="apprenant_id" id="apprenant_id"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                        <option value="">sélectionner l'apprenant </option>
                        @foreach ($apprenants as $apprenant)
                        <option value="{{ $apprenant->id }}" @selected(old('apprenant_id', $emprunt->apprenant_id) == $apprenant->id)>
                            {{ $apprenant->nom }} {{ $apprenant->prenom }}
                        </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('apprenant_id')" class="mt-2" />
                </div>

                <div class="col-span-4">
                    <x-input-label for="document_id" value="Document" />
                    <select name="document_id" id="document_id"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                        <option value="">sélectionner document à emprunter</option>
                        @foreach ($document_pedagogiques as $document)
                        <option value="{{ $document->id }}" @selected(old('document_id', $documentAttache?->document_pedagogique_id) == $document->id)>
                            {{ $document->titre }}
                        </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('document_id')" class="mt-2" />
                </div>

                <div class="col-span-4">
                    <x-input-label for="date_restitution_prevue" value="Date prévue de restitution" />
                    <x-text-input id="date_restitution_prevue" name="date_restitution_prevue" type="date" :value="old('date_restitution_prevue',$emprunt->date_restitution_prevue)" />
                    <x-input-error :messages="$errors->get('date_restitution_prevue')" class="mt-2" />
                </div>
            </div>

            <div class="px-5 py-4 sm:px-6 sm:py-5 flex">
                <div class="justify-end ml-auto flex space-x-2">
                    <x-secondary-button>
                        <a href="{{ route('emprunts.index') }}">Annuler</a>
                    </x-secondary-button>
                    <x-primary-button type="submit">
                        Mettre à jour
                    </x-primary-button>
                </div>
            </div>
        
    </form>
</x-app-layout>