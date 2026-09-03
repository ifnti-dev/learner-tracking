<x-app-layout>
    @php
    $is_edit = isset($paiementFrais);
    $action = $is_edit ? route('paiement_frais.update', [ $paiementFrais->id,$apprenant]) : route('paiement_frais.store',$apprenant);
    @endphp
    <x-http-message-swal />

    <div class="px-5 py-4 sm:px-6 sm:py-5 flex ">
        <h3
            class=" font-medium text-gray-800 dark:text-white/90">
            Ajouter un paiement de frais pour {{$apprenant->nom}}
        </h3>


    </div>

    <div
        class="z-0 rounded-2x">
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($is_edit ? 'PUT' : 'POST')

            <div
                class="grid grid-cols-12 gap-4  p-5 sm:p-6 dark:border-gray-800">




                <div class="  col-span-12 lg:col-span-2">
                    <x-input-label for="annee_scolaire" :value="__('Année Scolaire')" />
                    <div
                        x-data="{ selectedType: '{{ old('annee_scolaire', $paiementFrais->annee_scolaire ?? '') }}' }"
                        class="  bg-transparent flex items-center">

                        <select
                            name="annee_scolaire"
                            id="annee_scolaire"
                            x-model="selectedType"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            @foreach($niveaux as $niveau)
                                <option value="{{ $niveau->annee_scolaire }}" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">

                                    {{ $niveau->annee_scolaire }}
                                </option>
                            @endforeach


                        </select>
                        <x-input-error :messages="$errors->get('annee_scolaire')" class="mt-2" />


                    </div>
                </div>

                <div class="col-span-12 lg:col-span-2">
                    <x-input-label for="niveau_id" :value="__('Niveau ')" />
                    <div>
                        <div>
                            <select
                                name="niveau_id"
                                id="niveau_id"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                                @foreach ($niveaux as $niveau)
                                <option
                                    :value="String('{{ $niveau->id }}')"
                                    {{ (string) $niveau->id === (string) old('niveau_id', isset($paiementFrais) && $paiementFrais->niveau ? $paiementFrais->niveau->id : '') ? 'selected' : '' }}>
                                    {{ $niveau->nom }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('niveau_id')" class="mt-2" />

                </div>
                <div class="col-span-12 lg:col-span-12"></div>
                <div class="col-span-12 lg:col-span-4">
                    <x-input-label for="montant" :value="__('Montant Totale')" />
                    <x-text-input id="montant" class="" type="number" name="montant" :value="old('montant', $paiementFrais->montant ?? '')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('montant')" class="mt-2" />
                </div>

                <div class="col-span-12 lg:col-span-4">
                    @if ( isset($paiementFrais) && $paiementFrais->piece_justificatif != null)
                    <div class="flex space-x-2">
                        <x-input-label for="justificatif" :value="__('Justificatif ')" />
                        <x-input-label><a class='text-blue-500' href="{{ asset('storage/' . $paiementFrais->piece_justificatif) }}">Voir le justificatif</a>
                        </x-input-label>

                    </div>
                    @else

                    <div class="flex space-x-2"><x-input-label for="piece_justificatif" :value="__('Justificatif ')" /><x-input-label class="text-green-500" for="piece_justificatif" :value="__('(optionnel)')" /> </div>
                    @endif
                    <x-uploade-file type="file" name="piece_justificatif" />
                    <x-input-error :messages="$errors->get('piece_justificatif')" class="mt-2" />
                </div>



            </div>





            <div class="px-5 py-4 sm:px-6 sm:py-5 flex ">


                <div class="justify-end ml-auto flex space-x-2">
                    <x-secondary-button>
                        <a href="{{ route('paiement_frais', $apprenant) }}">
                            {{ __('Annuler') }}
                        </a>
                    </x-secondary-button>



                    <x-primary-button type="submit">
                        {{ __('Enregistrer') }}
                    </x-primary-button>

                </div>
            </div>
        </form>

</x-app-layout>