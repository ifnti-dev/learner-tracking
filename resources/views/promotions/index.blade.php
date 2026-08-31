<x-app-layout>
    <x-http-message-swal />
    <div class="px-5 py-4 sm:px-6 sm:py-6 flex">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Liste des promotions
        </h3>
        @can("promotion.create")
        <div class="justify-end ml-auto">
            <x-primary-button>
                <a href="{{ route('promotions.create') }}">
                    {{ __('Ajouter ') }}
                </a>
            </x-primary-button>
        </div>
        @endcan
    </div>

    <div class="">

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="max-w-full overflow-x-auto">
                <table class="min-w-full">

                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Nom de la promotion
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Année de création
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Nombre d'apprenant
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Date de Limite
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Est active
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
                        @forelse ($promotions as $promotion)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                            <td class="px-5 py-4 sm:px-6">
                                <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                    {{ $promotion->nom }}
                                </span>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $promotion->annee_creation }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $promotion->apprenants_count ?? 0 }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $promotion->date_limite }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $promotion->est_active }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6 relative">
                                <details class="relative inline-block text-left">
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
                                        @can("promotion.update")
                                        <a href="{{ route('promotions.edit', $promotion->id) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            Modifier
                                        </a>
                                        @endcan

                                        @can("promotion.view")
                                        <a href="{{ route('promotions.show', $promotion->id) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            Gérer la promotion
                                        </a>
                                        @endcan
                                        <a href="{{ route('candidater', $promotion->id) }}"
                                            class="block px-4 py-2 text-sm text-blue-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            partager le lien
                                        </a>
                                        @can("promotion.destroy")
                                        <form action="{{ route('promotions.destroy', $promotion->id) }}"
                                            method="POST" class="block"
                                            onclick="deleteDialogue('Souhaitez vous vraiment supprimer cette promotion ?', 'oui', 'annuler', this)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                                                Supprimer
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </details>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-5 py-4 sm:px-6">
                                <div class="flex items-center justify-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        Aucune promotion trouvée
                                    </p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- ====== Table Six End -->
    </div>
</x-app-layout>