<x-app-layout>
    <x-http-message-swal />

    <div class="px-5 py-4 sm:px-6 sm:py-6 flex">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Planifier une séance de travail
        </h3>
    </div>

    <form action="{{ route('seances.creer') }}" method="POST">
        @csrf

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="grid grid-cols-12 gap-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">

               
                <div class="col-span-5">
                    <x-input-label for="intitule" value="Intitulé de la séance" />
                    <x-text-input id="intitule" name="intitule" type="text" :value="old('intitule')" autofocus />
                    <x-input-error :messages="$errors->get('intitule')" class="mt-2" />
                </div>

              
                <div class="col-span-4">
                    <x-input-label for="promotion_id" value="Promotion" />
                    <select name="promotion_id" id="promotion_id"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                        <option value="">Promotion concernée</option>
                        @foreach ($promotions as $promotion)
                            <option value="{{ $promotion->id }}" @selected(old('promotion_id') == $promotion->id)>
                                {{ $promotion->nom }} ({{ $promotion->annee_creation }})
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('promotion_id')" class="mt-2" />
                </div>

                
                <div class="col-span-3">
                    <x-input-label for="type_seance" value="Type de séance" />
                    <select name="type_seance" id="type_seance"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                        <option value="PRESENTIEL" @selected(old('type_seance') === 'PRESENTIEL')>PRESENTIEL</option>
                        <option value="ENLIGNE" @selected(old('type_seance') === 'ENLIGNE')>ENLIGNE</option>
                    </select>
                    <x-input-error :messages="$errors->get('type_seance')" class="mt-2" />
                </div>

               
                <div class="col-span-4">
                    <x-input-label for="date" value="Date de la séance" />
                    <input id="date" name="date" type="date" value="{{ old('date') }}"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>

               
                <div class="col-span-4">
                    <x-input-label for="heure_debut" value="Heure de début" />
                    <x-text-input id="heure_debut" name="heure_debut" type="time" :value="old('heure_debut')" />
                    <x-input-error :messages="$errors->get('heure_debut')" class="mt-2" />
                </div>

               
                <div class="col-span-4">
                    <x-input-label for="heure_fin" value="Heure de fin" />
                    <x-text-input id="heure_fin" name="heure_fin" type="time" :value="old('heure_fin')" />
                    <x-input-error :messages="$errors->get('heure_fin')" class="mt-2" />
                </div>

               
                <div id="lien-visio-container" class="col-span-12 {{ old('type_seance') === 'ENLIGNE' ? '' : 'hidden' }}">
                    <x-input-label for="lien_visio" value="Lien de la réunion (Teams / Google Meet)" />
                    <x-text-input id="lien_visio" name="lien_visio" type="url"
                        placeholder="https://teams.microsoft.com/ ou https://meet.google.com/"
                        :value="old('lien_visio')" />
                    <x-input-error :messages="$errors->get('lien_visio')" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-input-label for="description" value="Description" />
                    <textarea id="description" name="description" rows="3"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>

            <div class="px-5 py-4 sm:px-6 sm:py-5 flex">
                <div class="justify-end ml-auto flex space-x-2">
                    <x-secondary-button>
                        <a href="{{ route('seances.index') }}">Annuler</a>
                    </x-secondary-button>
                    <x-primary-button type="submit">
                        Planifier la séance
                    </x-primary-button>
                </div>
            </div>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('type_seance');
            const lienContainer = document.getElementById('lien-visio-container');

            function toggleLienVisio() {
                if (typeSelect.value === 'ENLIGNE') {
                    lienContainer.classList.remove('hidden');
                } else {
                    lienContainer.classList.add('hidden');
                }
            }

            typeSelect.addEventListener('change', toggleLienVisio);
            toggleLienVisio(); 
        });
    </script>
</x-app-layout>