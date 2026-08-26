<x-app-layout>
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen rounded-2xl border border-gray-200 bg-white px-5 py-7 dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">

            <div class="mb-6">
                <x-input-label for="apprenant_id" :value="__('Apprenants disponibles')" />
                <form action="{{ route('promotions.apprenants.ajouter', $promotion->id) }}" method="POST" class="mt-2">
                    @csrf
                    <div class=" flex space-x-2 col-span-6 lg:col-span-6">
                        <select name="apprenant_id" id="apprenant_id"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                           
                            @forelse($apprenantsDisponibles as $apprenant)
                            <option value="{{ $apprenant->id }}">
                                {{ $apprenant->nom }} {{ $apprenant->prenom }} ({{ $apprenant->etablissement }})
                            </option>
                            @empty
                            <option >Aucun apprenant disponible</option>
                            @endforelse
                        </select>
                         <x-input-error :messages="$errors->get('apprenant_id')" class="mt-2 " />
                        <x-primary-button type="submit">
                            {{ __('Ajouter') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            <div class="px-5 py-4 sm:px-6 sm:py-5">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Les apprenants de la Promotion : <span class="text-blue-500">{{ $promotion->nom }}</span>
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="max-w-full overflow-x-auto">
                        <table class="min-w-full table-fixed md:table-auto">
                            <thead>
                                <tr class="border-b border-gray-100 dark:border-gray-800">

                                    <th class="px-5 py-3 sm:px-6 text-left w-1/4">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Nom</p>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6 text-left w-1/4">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Prénom</p>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6 text-left w-1/3">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Établissement</p>
                                    </th>

                                    <th class="px-5 py-3 sm:px-6 text-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Action</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse ($promotion->apprenants as $apprenant)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.01]">
                                    <td class="px-5 py-4 sm:px-6 text-left whitespace-nowrap">
                                        <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                            {{ $apprenant->nom }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6 text-left whitespace-nowrap">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $apprenant->prenom }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6 text-left">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400 truncate max-w-xs md:max-w-none" title="{{ $apprenant->etablissement }}">
                                            {{ $apprenant->etablissement }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">

                                        <div class="flex items-center justify-end gap-x-3">
                                            <x-secondary-button>
                                                <a href="{{ route('apprenants.edit', $apprenant->id) }}">
                                                    {{ __('Modifier') }}
                                                </a>
                                            </x-secondary-button>
                                            <form action="{{ route('promotions.apprenants.retirer', [$promotion->id, $apprenant->id]) }}" method="POST" class="inline" onclick="deleteDialogue('Souhaitez vous vraiment retirer cet apprenant', 'oui', 'annuler', this)" >
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button type="submit">
                                                    {{ __('Retirer') }}
                                                </x-danger-button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-8 text-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            Aucun apprenant dans cette promotion
                                            
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