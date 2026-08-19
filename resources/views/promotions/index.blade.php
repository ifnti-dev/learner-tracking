<x-app-layout>
    <x-http-message-swal />
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 bg-gray-50 dark:bg-gray-900">
        <div
            class="min-h-screen rounded-2xl border border-gray-200 bg-white px-5 py-7 dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex ">

                <h3
                    class="text-base font-medium text-gray-800 dark:text-white/90">
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
            <div
                class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">

                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="max-w-full overflow-x-auto">
                        <table class="min-w-full">
                            <!-- table header start -->
                            <thead>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                Nom de la promotion
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                Année de création
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                Nombre d'apprenant
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
                            <!-- table header end -->
                            <!-- table body start -->
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse ($promotions as $promotion)
                                <tr>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">

                                                <div>
                                                    <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                        {{ $promotion->nom }}
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                {{ $promotion->annee_creation }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                {{ $promotion->apprenants_count }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6 ">
                                        <div class="flex items-center gap-x-4">
                                            <form action="{{route('promotions.destroy',$promotion->id)}}" onclick="deleteDialogue('Souhaitez vous vraiem.....', 'oui', 'annuler', this)" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button class="bg-red-500 ">
                                                    {{ __('Supprimer') }}
                                                </x-danger-button>
                                            </form>
                                            <x-secondary-button>
                                                <a href="{{route('promotions.edit',$promotion->id)}}">
                                                    {{ __('Modifier') }}
                                                </a>
                                            </x-secondary-button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-4 sm:px-6">
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
            </div>
        </div>
    </div>

</x-app-layout>