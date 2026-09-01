<x-app-layout>
    @php
    $is_edit = isset($bulletin);
    $action = $is_edit ? route('bulletins.update', [ $bulletin->id,$apprenant]) : route('bulletins.store',$apprenant);
    @endphp
    <x-http-message-swal />

    <template id="file-input-template">
        <x-uploade-file type="file" name="bulletins[]" />
    </template>

    <div class="px-5 py-4 sm:px-6 sm:py-5 flex ">
        <h3
            class=" font-medium text-gray-800 dark:text-white/90">
            Ajouter bulletins
        </h3>


    </div>

    <div
        class="z-0 rounded-2x">
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div
                class="grid grid-cols-12 gap-4  p-5 sm:p-6 dark:border-gray-800">




                <div class="  col-span-12 lg:col-span-2">
                    <x-input-label for="annee_scolaire" :value="__('Année Scolaire')" />
                    <div
                        x-data="{ selectedType: '{{ old('annee_scolaire', $bulletin->annee_scolaire ?? '') }}' }"
                        class="  bg-transparent flex items-center">

                        <select
                            name="annee_scolaire"
                            id="annee_scolaire"
                            x-model="selectedType"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            @foreach($annee_scolaires as $annee)
                            <option value="{{ $annee }}" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                {{ $annee }}
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
                                    {{ $niveau->id == old('niveau_id') ? 'selected' : '' }}>
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
                    @if ( isset($bulletin) && $bulletin->bulletin1 != null)
                    <div class="flex">
                        <x-input-label for="bulletin1" :value="__('Bulletin 1 ')" />
                        <x-input-label ><a  class='text-blue-500' href="{{ asset($bulletin->bulletin1) }}">Voir le bulletin 1</a>
                        </x-input-label>

                    </div>

                    @endif
                    <x-uploade-file type="file" name="bulletins1" />
                    <x-input-error :messages="$errors->get('bulletin1')" class="mt-2" />

                </div>
                <div class="col-span-12 lg:col-span-4">
                    @if ( isset($bulletin) && $bulletin->bulletin1 != null)
                    <div class="flex">
                        <x-input-label for="bulletin2" :value="__('Bulletin 2 ')" />
                        <x-input-label ><a  class='text-blue-500' href="{{ asset($bulletin->bulletin2) }}">Voir le bulletin 2</a>
                        </x-input-label>

                    </div>

                    @endif
                    <x-uploade-file type="file" name="bulletins2" />
                    <x-input-error :messages="$errors->get('bulletin2')" class="mt-2" />
                </div>
                <div class="col-span-12 lg:col-span-4">
                    <div class="flex "><x-input-label for="bulletin3" :value="__('Bulletin 3   ')" /><x-input-label class="text-red-500" for="bulletin3" :value="__('(si timestrielle)')" /> </div>
                    <x-uploade-file type="file" name="bulletins3" />
                    <x-input-error :messages="$errors->get('bulletin3')" class="mt-2" />
                </div>

                <div class="col-span-12 lg:col-span-12"></div>
                <div class="col-span-12 lg:col-span-3">
                    <div class="flex "><x-input-label for="CEPD" :value="__('CEPD')" /><x-input-label class="text-red-500" for="CEPD" :value="__('(si 6eme)')" /> </div>

                    <x-uploade-file type="file" name="CEPD" />
                    <x-input-error :messages="$errors->get('CEPD')" class="mt-2" />
                </div>
                <div class="col-span-12 lg:col-span-3">
                    <div class="flex "><x-input-label for="BEPC" :value="__('BEPC')" /><x-input-label class="text-red-500" for="BEPC" :value="__('(si Seconde)')" /> </div>

                    <x-uploade-file type="file" name="BEPC" />
                    <x-input-error :messages="$errors->get('BEPC')" class="mt-2" />
                </div>
                <div class="col-span-12 lg:col-span-3">
                    <div class="flex "><x-input-label for="BAC1" :value="__('BAC1')" /><x-input-label class="text-red-500" for="BAC1" :value="__('(si Terminale)')" /> </div>
                    <x-uploade-file type="file" name="BAC1" />
                    <x-input-error :messages="$errors->get('BAC1')" class="mt-2" />
                </div>
                <div class="col-span-12 lg:col-span-3">
                    <div class="flex "><x-input-label for="BAC2" :value="__('BAC2')" /><x-input-label class="text-red-500" for="BAC2" :value="__('(si Terminale)')" /> </div>
                    <x-uploade-file type="file" name="BAC2" />
                    <x-input-error :messages="$errors->get('BAC2')" class="mt-2" />
                </div>





            </div>







            <div class="px-5 py-4 sm:px-6 sm:py-5 flex ">


                <div class="justify-end ml-auto flex space-x-2">
                    <x-secondary-button>
                        <a href="{{ route('bulletins',$apprenant) }}">
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