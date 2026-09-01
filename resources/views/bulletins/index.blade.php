<x-app-layout>
    <x-http-message-swal />


    <div class="px-5 py-4 sm:px-6 sm:py-6 flex ">
        <h3
            class="text-base font-medium text-gray-800 dark:text-white/90">
            Gerer les bulletins de {{$apprenant->nom}}
        </h3>
        @can('create.personne.responsable')
        <div class="justify-end ml-auto">
            
            <x-primary-button>
                <a href="{{ route('bulletins.create',$apprenant) }}">
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
                                        Annee Scolaire
                                    </p>
                                </div>
                            </th>
                            <th class="px-5 py-3 sm:px-6">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Niveau
                                    </p>
                                </div>
                            </th>
                            <th class="px-5 py-3 sm:px-6">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Status
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
                        @forelse ($bulletins as $bulletin)
                        <tr class="hover:bg-gray-100  dark:hover:bg-gray-800  ">
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <div class="flex items-center gap-3">

                                        <div>
                                            <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                {{ $bulletin->annee_scolaire }}
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $bulletin->niveau()->first()->nom }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $bulletin->status }}
                                    </p>
                                </div>
                            </td>
                            
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center">
                                    @can('update.bulletin')
                                    <x-secondary-button>
                                        <a href="{{ route('bulletins.edit',[ $bulletin->id,$apprenant->id]) }}">
                                            {{ __('Modifier') }}
                                        </a>
                                    </x-secondary-button>
                                    @endcan
                                    @can('delete.bulletin')
                                    <form action="{{ route('bulletins.destroy', [ $bulletin->id,$apprenant]) }}" onclick="deleteDialogue('Souhaitez vous vraiem.....', 'oui', 'annuler', this)" method="POST" class="ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit">
                                            {{ __('Supprimer') }}
                                        </x-danger-button>
                                    </form>
                                    @endcan
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