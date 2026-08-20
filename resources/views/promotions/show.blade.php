<x-app-layout>
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 bg-gray-50 dark:bg-gray-900">
        <div
            class="min-h-screen rounded-2xl border border-gray-200 bg-white px-5 py-7 dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex ">

                <h3
                    class="text-base font-medium text-gray-800 dark:text-white/90">
                    Les apprenants de la Promotion : <span class="text-blue-500">{{ $promotion->nom }}</span>
                </h3>

                <div class="justify-end ml-auto">
                    <x-primary-button>
                        <a href="">
                            {{ __('Inscrire un apprenant ') }}
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
                                                Nom 
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                Prenom 
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                Etablissement
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
                               @forelse ($promotion->apprenants as $apprenant)
                                <tr>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">

                                                <div>
                                                    <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                        {{ $apprenant->candidat->nom }}
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                {{ $apprenant->candidat->prenom }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                {{ $apprenant->etablissement }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6 ">
                                        <div class="flex items-center gap-x-4">
                                            <form action="" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button >
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