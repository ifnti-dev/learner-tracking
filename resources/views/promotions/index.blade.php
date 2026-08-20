<x-app-layout>
    <x-http-message-swal />
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen rounded-2xl border border-gray-200 bg-white px-5 py-7 dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex ">

                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Liste des promotions
                </h3>

                <div class="justify-end ml-auto">
                    <x-primary-button>
                        <a href="{{route('promotions.create')}}">
                            {{ __('Ajouter ') }}
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
                                            Nom de la promotion
                                        </p>
                                    </th>

                                    <th class="px-5 py-3 sm:px-6 text-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Année de création
                                        </p>
                                    </th>

                                    <th class="px-5 py-3 sm:px-6 text-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Nombre d'apprenant
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
                                @forelse ($promotions as $promotion)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.01]">

                                    <td class="px-5 py-4 sm:px-6 text-left">
                                        <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                            {{ $promotion->nom }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-4 sm:px-6 text-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $promotion->annee_creation }}
                                        </p>
                                    </td>

                                    <td class="px-5 py-4 sm:px-6 text-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $promotion->apprenants_count ?? 0 }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6 text-center">
                                        <div class="flex items-center justify-center gap-x-3">
                                            <x-secondary-button>
                                                <a href="{{route('promotions.edit',$promotion->id)}}">
                                                    {{ __('Modifier') }}
                                                </a>
                                            </x-secondary-button>
                                            <x-secondary-button>
                                                <a href="{{route('promotions.show',$promotion->id)}}">
                                                    {{ __('Gérer la promotion') }}
                                                </a>
                                            </x-secondary-button>
                                            <form action="{{route('promotions.destroy',$promotion->id)}}" method="POST" class="inline" onclick="deleteDialogue('Souhaitez vous vraiment supprimer cette promotion', 'oui', 'annuler', this)">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button class="bg-red-500 hover:bg-red-600">
                                                    {{ __('Supprimer') }}
                                                </x-danger-button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-8 sm:px-6 text-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            Aucune promotion trouvée
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