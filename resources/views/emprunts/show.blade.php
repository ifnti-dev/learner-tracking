<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg shadow-xl w-full">
            
            <div class="px-4 py-5 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    Détails de l'emprunt sur l'apprenant : {{ $emprunt->apprenant->nom ?? '' }} {{ $emprunt->apprenant->prenom ?? '' }}
                </h3>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200 dark:sm:divide-gray-700">
                    
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Date d'emprunt
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2 sm:text-right">
                            {{ $emprunt->date_emprunt }}
                        </dd>
                    </div>

                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Date prévue de restitution
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2 sm:text-right">
                            {{ $emprunt->date_restitution_prevue }}
                        </dd>
                    </div>

                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Date de restitution
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2 sm:text-right">
                            {{ $emprunt->date_restitution ?? 'Non encore restitué' }}
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Est restitué ?
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2 sm:text-right">
                            @if($emprunt->est_restitue)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    Oui (Restitué)
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                    Non (En cours)
                                </span>
                            @endif
                        </dd>
                    </div>

                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Document(s) Emprunté(s)
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2 sm:text-right">
                            <ul class="space-y-1 inline-block text-left sm:text-right">
                                @foreach($emprunt->document_pedagogiques as $doc)
                                    <li>
                                        <span class="font-semibold">{{ $doc->titre ?? '' }}</span> 
                                        <span class="text-xs text-gray-500 dark:text-gray-400">(Niveau: {{ $doc->niveau->nom ?? ''}})</span>
                                    </li>
                                @endforeach
                            </ul>
                        </dd>
                    </div>

                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
