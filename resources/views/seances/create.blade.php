<x-app-layout>
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Créer la séance : {{ $seance->intitule }}</h2>
        <div class="bg-white shadow-md rounded-lg mb-6 overflow-hidden border border-gray-200">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="mb-2"><strong class="text-gray-700">Date :</strong> {{ $seance->date }}</p>
                        <p class="mb-2"><strong class="text-gray-700">Horaire :</strong> {{ $seance->heure_debut }} - {{ $seance->heure_fin }}</p>
                    </div>
                    <div>
                        <p class="mb-2"><strong class="text-gray-700">Type :</strong> {{ $seance->type_seance }}</p>
                        <p class="mb-2"><strong class="text-gray-700">Promotion :</strong> {{ $seance->promotion->nom ?? '-' }}</p>
                        <p class="mb-2"><strong class="text-gray-700">État actuel :</strong> <span class="px-2 py-1 text-xs font-semibold rounded bg-blue-100 text-blue-800">{{ $seance->etat }}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('seances.store', $seance) }}" method="POST" class="space-y-6">
            @csrf
            <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h5 class="text-lg font-semibold text-gray-800 mb-0">Sélectionner les apprenants absents et renseigner les détails</h5>
                </div>
                <div class="p-6 space-y-4">
                    @forelse($apprenants as $apprenant)
                        <div class="p-4 border border-gray-200 rounded-md bg-gray-50 space-y-3">
                            <x-form.checkbox
                                name="absents[{{ $apprenant->id }}]"
                                :value="$apprenant->id"
                                :label="$apprenant->nom . ' ' . $apprenant->prenom . ' (Marquer comme absent)'" />
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pl-6 border-t border-gray-200 pt-3 mt-2">
                                <x-form.checkbox
                                    name="est_justifie[{{ $apprenant->id }}]"
                                    value=""
                                    label="L'absence est justifiée" 
                                />
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Motif / Justification</label>
                                    <input 
                                        type="text" 
                                        name="justification[{{ $apprenant->id }}]" 
                                        placeholder="Ex: Certificat médical, convocation..." 
                                        class="w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-500">
                            <p class="mb-0">Aucun apprenant inscrit dans cette promotion.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="flex justify-end items-center space-x-3 mt-6">
               
                <a href="{{ route('seances.index') }}">
                    <x-danger-button type="button">
                        {{ __('ANNULER') }}
                    </x-danger-button>
                </a>
                @if($seance->etat !== 'TERMINER')
                    <x-primary-button type="submit">
                        {{ __('créer la seance') }}
                    </x-primary-button>
                @endif
            </div>
        </form>
    </div>
</x-app-layout>
