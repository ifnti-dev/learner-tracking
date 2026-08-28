<x-app-layout>
    <x-http-message-swal />

    <div class="px-5 py-4 sm:px-6 sm:py-6 flex">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Liste des séances
        </h3>
        <div class="justify-end ml-auto">
            <x-primary-button>
                <a href="{{ route('seances.planifierSeance') }}">
                    {{ __('Planifier une séance') }}
                </a>
            </x-primary-button>
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
                                    <div class="flex items-center">
                                        <x-primary-button>
                                            <a href="{{ route('seances.create', $seance->id) }}">
                                                {{ __('Demarrer la seance') }}
                                            </a>
                                        </x-primary-button>
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