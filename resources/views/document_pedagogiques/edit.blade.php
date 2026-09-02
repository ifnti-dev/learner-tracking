<x-app-layout>
    <x-http-message-swal />

    <div class="px-5 py-4 sm:px-6 sm:py-6 flex">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Modifier le document pedagogique 
        </h3>
    </div>

    <form action="{{ route('document-pedagogiques.update',$documentPedagogique->id) }}" method="POST">
        @csrf
         @method('PUT')
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="grid grid-cols-12 gap-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">

                <div class="col-span-6">
                    <x-input-label for="titre" value="titre" />
                    <x-text-input id="titre" name="titre" type="text" :value="old('titre',$documentPedagogique->titre)" />
                    <x-input-error :messages="$errors->get('titre')" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <x-input-label for="auteur" value="Auteur" />
                    <x-text-input id="auteur" name="auteur" type="text" :value="old('auteur',$documentPedagogique->auteur)" />
                    <x-input-error :messages="$errors->get('auteur')" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <x-input-label for="niveau_id" value="Niveaux" />
                    <select name="niveau_id" id="niveau_id"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                       
                        <option value="">Niveau concerné</option>
                        @foreach ($niveaux as $niveau)
                        @if($niveau->id===$documentPedagogique->niveau_id)
                        <option value="{{ $niveau->id }}" selected>
                            {{ $niveau->nom }}
                        </option>
                        @else
                        <option value="{{ $niveau->id }}">
                            {{ $niveau->nom }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('niveau_id')" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <x-input-label for="quantite" value="Quantité" />
                    <input id="quantite" name="quantite" type="number" value="{{ old('quantite',$documentPedagogique->quantite) }}"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                    <x-input-error :messages="$errors->get('quantite')" class="mt-2" />
                </div>
                <div class="col-span-12">
                    <x-input-label for="description" value="Description" />
                    <textarea id="description" name="description" rows="3"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">{{ old('description',$documentPedagogique->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>

            <div class="px-5 py-4 sm:px-6 sm:py-5 flex">
                <div class="justify-end ml-auto flex space-x-2">
                    <x-secondary-button>
                        <a href="{{ route('document-pedagogiques.index') }}">Annuler</a>
                    </x-secondary-button>
                    <x-primary-button type="submit">
                        Envoyer
                    </x-primary-button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>