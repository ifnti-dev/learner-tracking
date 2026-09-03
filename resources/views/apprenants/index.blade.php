<x-app-layout>
    <x-http-message-swal />


    <div class="px-5 py-4 sm:px-6 sm:py-5 flex ">
        <h3
            class="text-base font-medium text-gray-800 dark:text-white/90">
            Apprenants
        </h3>
        @can('create.apprenant')
        <div class="justify-end ml-auto">
            <x-primary-button>
                <a href="{{ route('apprenants.create') }}">
                    {{ __('Ajouter ') }}
                </a>
            </x-primary-button>
        </div>

        @endcan
    </div>
    <div
        class="">
        <!-- ====== Table Six Start -->

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
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
                                        Prénom
                                    </p>
                                </div>
                            </th>
                            <th class="px-5 py-3 sm:px-6">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Email
                                    </p>
                                </div>
                            </th>
                            <th class="px-5 py-3 sm:px-6">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Téléphone
                                    </p>
                                </div>
                            </th>
                            <th class="px-5 py-3 sm:px-6">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        sexe
                                    </p>
                                </div>
                            </th>
                            <th class="px-5 py-3 sm:px-6">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        adresse
                                    </p>
                                </div>
                            </th>
                            <th class="px-5 py-3 sm:px-6">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Etablisement
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
                        @forelse ($apprenants as $apprenant)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 ">
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <div class="flex items-center gap-3">

                                        <div>
                                            <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                {{ $apprenant->nom }}
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $apprenant->prenom }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $apprenant->email }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p
                                        class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                        {{ $apprenant->telephone }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p
                                        class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                        {{ $apprenant->sexe }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p
                                        class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                        {{ $apprenant->adresse }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p
                                        class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                        {{ $apprenant->etablissement }}
                                    </p>
                                </div>
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
                                    <div class="  absolute right-0 z-50 mt-1 w-48 origin-top-right rounded-lg border border-gray-200 bg-white py-1 shadow-lg dark:border-gray-700 dark:bg-gray-800">
                                        @can('update.apprenant')

                                        <a href="{{ route('apprenants.edit', $apprenant->id) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            Modifier
                                        </a>

                                        @endcan
                                        @can('view.bulletin')
                                        <a href="{{ route('bulletins', $apprenant) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            {{ __('Gerer bulletin') }}
                                        </a>
                                        @endcan
                                        @can('view.bulletin')
                                        <a href="{{ route('paiement_frais', $apprenant) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            {{ __('Aide financière') }}
                                        </a>
                                        @endcan
                                        @can('delete.apprenant')

                                        <form action="{{  route('apprenants.destroy', $apprenant->id)}}"
                                            method="POST" class="block"
                                            onclick="deleteDialogue('Souhaitez vous vraiment supprimer cet apprenant ?', 'oui', 'annuler', this)">
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
                            <td colspan="5" class="px-5 py-4 sm:px-6">
                                <div class="flex items-center justify-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        Aucun apprenant trouvé.
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