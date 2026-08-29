<x-app-layout>
    <x-http-message-swal />

    <div class="px-5 py-4 sm:px-6 sm:py-6 flex">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Liste des séances
        </h3>
        <div class="justify-end ml-auto">
            @can("planifier.seance")
            <x-primary-button>
                <a href="{{ route('seances.planifierSeance') }}">
                    {{ __('Planifier une séance') }}
                </a>
            </x-primary-button>
            @endcan
        </div>
    </div>

    <div class="">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="max-w-full overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Intitulé
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Date
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Horaire
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Type
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Promotion
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    État
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Action
                                </p>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($seances as $seance)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                            <td class="px-5 py-4 sm:px-6">
                                <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                    {{ $seance->intitule }}
                                </span>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $seance->date }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $seance->heure_debut }} - {{ $seance->heure_fin }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $seance->type_seance }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $seance->promotion->nom }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                    {{ $seance->etat }}
                                </span>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center space-x-3">
                                    @if($seance->etat === 'PLANIFIER')
                                    <form action="{{ route('seances.demarrer', $seance->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <x-secondary-button>
                                            Démarrer
                                        </x-secondary-button>
                                    </form>
                                    <form action="{{ route('seances.annuler', $seance->id) }}" method="POST" class="inline"
                                        onclick="deleteDialogue('Souhaitez vous vraiment annuler cette seance ?', 'oui', 'annuler', this)">
                                        @csrf
                                        @method('PATCH')
                                        <x-danger-button>
                                            Annuler
                                        </x-danger-button>
                                    </form>
                                    @endif

                                    @if($seance->etat === 'ENCOURS')
                                    <form action="{{ route('seances.terminer', $seance->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <x-secondary-button>
                                            Terminer
                                        </x-secondary-button>
                                    </form>
                                    @endif

                                    @if($seance->etat === 'TERMINER')
                                    <a href="{{ route('seances.enregisterAbsents', $seance->id) }}" class="inline">
                                        <x-secondary-button>
                                            Enregistrer les absents
                                        </x-secondary-button>
                                    </a>
                                    <a href="{{ route('seances.voirAbsents', $seance->id) }}">
                                        <x-secondary-button >
                                            Voir absents
                                        </x-secondary-button>
                                    </a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-5 py-4 sm:px-6">
                                <div class="flex items-center justify-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        Aucune séance trouvée
                                    </p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>