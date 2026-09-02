<x-app-layout>
    <x-http-message-swal />


    <div class="px-5 py-4 sm:px-6 sm:py-5 flex ">
        <h3
            class="text-base font-medium text-gray-800 dark:text-white/90">
            Liste des document pedagogiques
        </h3>

        <div class="justify-end ml-auto">
            <x-primary-button>
                <a href="{{ route('document-pedagogiques.create') }}">
                    {{ __('Ajouter ') }}
                </a>
            </x-primary-button>
        </div>
    </div>
    <div
        class="">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="max-w-full overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3 sm:px-6">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Titre
                                    </p>
                                </div>
                            </th>
                            <th class="px-5 py-3 sm:px-6">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Description
                                    </p>
                                </div>
                            </th>
                             <th class="px-5 py-3 sm:px-6">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Niveaux
                                    </p>
                                </div>
                            </th>
                            <th class="px-5 py-3 sm:px-6">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Auteur
                                    </p>
                                </div>
                            </th>
                            <th class="px-5 py-3 sm:px-6">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Quantité
                                    </p>
                                </div>
                            </th>
                            <th class="px-5 py-3 sm:px-6">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Action
                                    </p>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($document_pedagogiques as $document)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 ">
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                {{ $document->titre }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $document->description }}
                                    </p>
                                </div>
                            </td>
                             <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $document->niveau->nom }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $document->auteur }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $document->quantite }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <x-secondary-button>
                                        <a href="{{ route('document-pedagogiques.edit', $document->id) }}">
                                            {{ __('Modifier') }}
                                        </a>
                                    </x-secondary-button>

                                    <form action="{{ route('document-pedagogiques.destroy', $document->id) }}" onclick="deleteDialogue('Souhaitez vous vraiem.....', 'oui', 'annuler', this)" method="POST" class="ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button>
                                            {{ __('Retirer') }}
                                        </x-danger-button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-4 sm:px-6">
                                <div class="flex items-center justify-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        Aucun document pedagogique trouvé.
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