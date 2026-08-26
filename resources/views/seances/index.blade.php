<x-app-layout>
    <x-http-message-swal />

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen rounded-2xl border border-gray-200 bg-white px-5 py-7 dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex">

                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Liste des séances
                </h3>

                <!-- @if(auth()->user()->hasRole(['enseignant', 'responsable']))
                 @endif -->
                <div class="justify-end ml-auto">
                    <x-primary-button>
                        <a href="{{ route('seances.planifierSeance') }}">
                            {{ __('Planifier une séance') }}
                        </a>
                    </x-primary-button>
                </div>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="max-w-full overflow-x-auto">

                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-white/[0.01]">
                                    <th class="px-5 py-3 sm:px-6 text-left">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Intitulé
                                        </p>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6 text-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Date
                                        </p>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6 text-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Horaire
                                        </p>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6 text-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Type
                                        </p>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6 text-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Promotion
                                        </p>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6 text-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            État
                                        </p>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6 text-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Action
                                        </p>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse ($seances as $seance)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.01]">
                                    <td class="px-5 py-4 sm:px-6 text-left">
                                        <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                            {{ $seance->intitule }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-4 sm:px-6 text-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $seance->date }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6 text-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $seance->heure_debut }} - {{ $seance->heure_fin }}
                                        </p>
                                    </td>

                                    <td class="px-5 py-4 sm:px-6 text-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $seance->type_seance }}
                                        </p>
                                    </td>

                                    <td class="px-5 py-4 sm:px-6 text-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $seance->promotion->nom  }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6 text-center">

                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium  'bg-gray-100 text-gray-700' }}">
                                            {{ $seance->etat}}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6 text-center">
                                        <!-- @if(auth()->user()->hasRole(['secretaire']))
                                        @endif -->

                                        <div class="flex items-center justify-center gap-x-2">
                                            <x-primary-button>
                                                <a href="{{ route('seances.create',$seance->id) }}">
                                                    {{ __('créer une séance') }}
                                                </a>
                                            </x-primary-button>
                                        </div>
                                        
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-5 py-8 sm:px-6 text-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            Aucune séance trouvée
                                        </p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>