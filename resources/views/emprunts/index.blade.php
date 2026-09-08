<x-app-layout>
    <x-http-message-swal />

    <div class="px-5 py-4 sm:px-6 sm:py-6 flex">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Liste des emprunts
        </h3>
        @can("emprunt.create")
        <div class="justify-end ml-auto">
            <x-primary-button>
                <a href="{{ route('emprunts.create') }}">
                    {{ __('Ajouter ') }}
                </a>
            </x-primary-button>
        </div>
        @endcan
    </div>
    <div>
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="max-w-full overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Date Emprunt
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Date Prévue 

                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Date de Restitution
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Apprenant
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Document
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-center">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Restitué
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
                        @forelse ($emprunts as $emprunt)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                            <td class="px-5 py-4 sm:px-6">
                                <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                    {{ $emprunt->date_emprunt }}
                                </span>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $emprunt->date_restitution_prevue }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $emprunt->date_restitution ?? '-' }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400 font-semibold">
                                    {{ $emprunt->nom ?? '' }} {{ $emprunt->prenom ?? '' }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $emprunt->titre }} ({{ $emprunt->niveau_nom }})
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6 text-center">
                                @if($emprunt->est_restitue)
                                <span class="px-3 py-1 text-xs font-bold text-green-700 bg-green-100 rounded-full">Oui</span>
                                @else
                                <span class="px-3 py-1 text-xs font-bold text-red-700 bg-red-100 rounded-full">Non</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <details class=" ">
                                    <summary
                                        class="cursor-pointer list-none rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="size-5">
                                                <path
                                                    d="M10 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM10 8.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM11.5 15.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                                            </svg>
                                        </span>
                                    </summary>
                                    <div
                                        class="absolute right-0 z-50 mt-1 w-48 origin-top-right rounded-lg border border-gray-200 bg-white py-1 shadow-lg dark:border-gray-700 dark:bg-gray-800">
                                        @can("emprunt.view")
                                        <a href="{{ route('emprunts.show', $emprunt->id) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            Consulter
                                        </a>
                                        @endcan
                                        @if(!$emprunt->est_restitue)
                                        @can("emprunt.restituer")
                                        <form action="{{ route('emprunts.restituer', $emprunt->id) }}" method="POST" class="block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-full px-4 py-2 text-left text-sm text-green-700 hover:bg-green-50 dark:text-green-400 dark:hover:bg-green-900/20">
                                                Restituer
                                            </button>
                                        </form>
                                        @endcan
                                        @can("emprunt.update")
                                        <a href="{{ route('emprunts.edit', $emprunt->id) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            Modifier
                                        </a>
                                        @endcan
                                        @endif
                                        @can("emprunt.destroy")
                                        <form action="{{ route('emprunts.destroy', $emprunt->id) }}" method="POST" class="block"
                                            onclick="deleteDialogue('Souhaitez-vous vraiment retirer cet emprunt ?', 'oui', 'annuler', this)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                                                Retirer
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </details>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-5 py-4 sm:px-6">
                                <div class="flex items-center justify-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        Aucun emprunt trouvé.
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