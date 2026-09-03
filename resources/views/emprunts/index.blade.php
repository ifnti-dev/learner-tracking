<x-app-layout>
    <x-http-message-swal />

    <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Liste des emprunts
        </h3>
         <div class="justify-end ml-auto">
            <x-primary-button>
                <a href="{{ route('emprunts.create')}}">
                    {{ __('Ajouter ') }}
                </a>
            </x-primary-button>
        </div>
    </div>

    <div>
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="max-w-full overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Date de l'emprunt
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Date de restitution
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Apprenants
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Documents
                                </p>
                            </th>
                            <th class="px-5 py-3 sm:px-6 text-left">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Actions
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($emprunts as $emprunt)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                            <td class="px-5 py-4 sm:px-6">
                                <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                    {{ $emprunt->date }}
                                </span>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $emprunt->date_restitution }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $emprunt->nom }} {{ $emprunt->prenom }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $emprunt->titre }} ({{$emprunt->niveau_nom}})
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center gap-2">
                                    <x-secondary-button>
                                        <a href="{{ route('emprunts.edit', $emprunt->id) }}">
                                            {{ __('Modifier') }}
                                        </a>
                                    </x-secondary-button>
                                    <form action="{{ route('emprunts.destroy', $emprunt->id) }}" onclick="deleteDialogue('Souhaitez-vous vraiment retirer cet emprunt ?', 'oui', 'annuler', this)" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit">
                                            {{ __('Retirer') }}
                                        </x-danger-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty-
                        <tr>
                            <td colspan="5" class="px-5 py-8 text-center">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    Aucun emprunt trouvé.
                                </p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>