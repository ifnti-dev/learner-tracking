<x-app-layout>
    <x-http-message-swal />

    <div class="px-5 py-4 sm:px-6 sm:py-6 flex">
        <div>
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                Absents – {{ $seance->intitule }}
            </h3>
            <p class="text-sm text-gray-500 mt-1">
                {{ $seance->date }} | {{ $seance->heure_debut }} - {{ $seance->heure_fin }}
            </p>
        </div>
        <div class="ml-auto">
            <a href="{{ route('seances.enregisterAbsents', $seance->id) }}">
                <x-primary-button>Éditer</x-primary-button>
            </a>
        </div>
    </div>

    <div class="px-5 sm:px-6">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <th class="px-5 py-3 text-left">Apprenant</th>
                        <th class="px-5 py-3 text-left">Justifié</th>
                        <th class="px-5 py-3 text-left">Justification</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($absences as $absence)
                    <tr>
                        <td class="px-5 py-4">
                            {{ $absence->apprenant->nom}} {{ $absence->apprenant->prenom}}
                        </td>
                        <td class="px-5 py-4">
                            {{ $absence->est_justifie ? 'Oui' : 'Non' }}
                        </td>
                        <td class="px-5 py-4">
                            {{ $absence->justification ?? '—' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-5 py-4 text-center text-gray-500">
                            Aucun absent enregistré
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ route('seances.index') }}">
                <x-secondary-button>Retour à la liste</x-secondary-button>
            </a>
        </div>
    </div>
</x-app-layout>