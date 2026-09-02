<x-app-layout>
    @php
    $is_edit = isset($bulletin);
    $action = $is_edit ? route('bulletins.update', [ $bulletin->id,$apprenant]) : route('bulletins.store',$apprenant);
    @endphp
    <x-http-message-swal />

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
            @method($is_edit ? 'PUT' : 'POST')

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
                                    {{ (string) $niveau->id === (string) old('niveau_id', isset($bulletin) && $bulletin->niveau()->first() ? $bulletin->niveau()->first()->id : '') ? 'selected' : '' }}>
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
                        <x-input-label><a class='text-blue-500' href="{{ asset('storage/' . $bulletin->bulletin1) }}">Voir le bulletin 1</a>
                        </x-input-label>

                    </div>
                    @else
                    <x-input-label for="bulletin1" :value="__('Bulletin 1 ')" />

                    @endif
                    <x-uploade-file type="file" name="bulletin1" />
                    <x-input-error :messages="$errors->get('bulletin1')" class="mt-2" />

                </div>
                <div class="col-span-12 lg:col-span-4">
                    @if ( isset($bulletin) && $bulletin->bulletin2 != null)
                    <div class="flex">
                        <x-input-label for="bulletin2" :value="__('Bulletin 2 ')" />
                        <x-input-label><a class='text-blue-500' href="{{ asset('storage/' . $bulletin->bulletin2) }}">Voir le bulletin 2</a>
                        </x-input-label>

                    </div>
                    @else
                    <x-input-label for="bulletin2" :value="__('Bulletin 2 ')" />
                    @endif
                    <x-uploade-file type="file" name="bulletin2" />
                    <x-input-error :messages="$errors->get('bulletin2')" class="mt-2" />
                </div>
                <div class="col-span-12 lg:col-span-4">
                    @if ( isset($bulletin) && $bulletin->bulletin3 != null)
                    <div class="flex">
                        <x-input-label for="bulletin3" :value="__('Bulletin 3 ')" />
                        <x-input-label><a class='text-blue-500' href="{{ asset('storage/' . $bulletin->bulletin3) }}">Voir le bulletin 3</a>
                        </x-input-label>

                    </div>
                    @else
                    <div class="flex "><x-input-label for="bulletin3" :value="__('Bulletin 3   ')" /><x-input-label class="text-red-500" for="bulletin3" :value="__('(si timestrielle)')" /> </div>
                    @endif
                    <x-uploade-file type="file" name="bulletin3" />
                    <x-input-error :messages="$errors->get('bulletin3')" class="mt-2" />
                </div>

                <div class="col-span-12 lg:col-span-12"></div>
                <div class="col-span-12 lg:col-span-3">
                    @if ( isset($bulletin) && $bulletin->releveCEPD != null)
                    <div class="flex">
                        <x-input-label for="releveCEPD" :value="__('CEPD ')" />
                        <x-input-label><a class='text-blue-500' href="{{ asset('storage/' . $bulletin->releveCEPD) }}">Voir le CEPD</a>
                        </x-input-label>

                    </div>
                    @else
                    <div class="flex "><x-input-label for="releveCEPD" :value="__('CEPD ')" /><x-input-label class="text-red-500" for="releveCEPD" :value="__('(si 6eme)')" /> </div>
                    @endif
                    <x-uploade-file type="file" name="releveCEPD" />
                    <x-input-error :messages="$errors->get('releveCEPD')" class="mt-2" />
                </div>
                <div class="col-span-12 lg:col-span-3">
                    @if ( isset($bulletin) && $bulletin->releveBEPC != null)
                    <div class="flex">
                        <x-input-label for="releveBEPC" :value="__('BEPC ')" />
                        <x-input-label><a class='text-blue-500' href="{{ asset('storage/' . $bulletin->releveBEPC) }}">Voir le BEPC</a>
                        </x-input-label>

                    </div>
                    @else
                    <div class="flex "><x-input-label for="releveBEPC" :value="__('BEPC ')" /><x-input-label class="text-red-500" for="releveBEPC" :value="__('(si Seconde)')" /> </div>
                    @endif
                    <x-uploade-file type="file" name="releveBEPC" />
                    <x-input-error :messages="$errors->get('releveBEPC')" class="mt-2" />
                </div>
                <div class="col-span-12 lg:col-span-3">
                    @if ( isset($bulletin) && $bulletin->releveBAC1 != null)
                    <div class="flex">
                        <x-input-label for="releveBAC1" :value="__('BAC1 ')" />
                        <x-input-label><a class='text-blue-500' href="{{ asset('storage/' . $bulletin->releveBAC1) }}">Voir le BAC1</a>
                        </x-input-label>
                    </div>
                    @else
                    <div class="flex "><x-input-label for="releveBAC1" :value="__('BAC1')" /><x-input-label class="text-red-500" for="releveBAC1" :value="__('(si Terminale)')" /> </div>
                    @endif
                    <x-uploade-file type="file" name="releveBAC1" />
                    <x-input-error :messages="$errors->get('releveBAC1')" class="mt-2" />
                </div>
                <div class="col-span-12 lg:col-span-3">
                    @if ( isset($bulletin) && $bulletin->releveBAC2 != null)
                    <div class="flex">
                        <x-input-label for="releveBAC2" :value="__('BAC2 ')" />
                        <x-input-label><a class='text-blue-500' href="{{ asset('storage/' . $bulletin->releveBAC2) }}">Voir le BAC2</a>
                        </x-input-label>
                    </div>
                    @else
                    <div class="flex "><x-input-label for="releveBAC2" :value="__('BAC2')" /><x-input-label class="text-red-500" for="releveBAC2" :value="__('(si Terminale)')" /> </div>
                    @endif
                    <x-uploade-file type="file" name="releveBAC2" />
                    <x-input-error :messages="$errors->get('releveBAC2')" class="mt-2" />
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