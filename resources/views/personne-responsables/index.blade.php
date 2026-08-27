<x-app-layout>
    <x-http-message-swal />


    <div class="px-5 py-4 sm:px-6 sm:py-6 flex ">
        <h3
            class="text-base font-medium text-gray-800 dark:text-white/90">
            Personne Responsables
        </h3>

        <div class="justify-end ml-auto">
            <x-primary-button>
                <a href="{{ route('personne-responsables.create') }}">
                    {{ __('Ajouter ') }}
                </a>
            </x-primary-button>
        </div>
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
                                        Type
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
                                        Action
                                    </p>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <!-- table header end -->
                    <!-- table body start -->
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($personneResponsables as $personneResponsable)
                        <tr class="hover:bg-gray-100  dark:hover:bg-gray-800  ">
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <div class="flex items-center gap-3">

                                        <div>
                                            <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                {{ $personneResponsable->nom }}
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $personneResponsable->prenom }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $personneResponsable->type }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p
                                        class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                        {{ $personneResponsable->telephone }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <x-secondary-button>
                                        <a href="{{ route('personne-responsables.edit', $personneResponsable->id) }}">
                                            {{ __('Modifier') }}
                                        </a>
                                    </x-secondary-button>
                                    <form action="{{ route('personne-responsables.destroy', $personneResponsable->id) }}" onclick="deleteDialogue('Souhaitez vous vraiem.....', 'oui', 'annuler', this)" method="POST" class="ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit">
                                            {{ __('Supprimer') }}
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
                                        Aucun personne responsable trouvé.
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