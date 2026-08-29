<x-app-layout>
    <x-http-message-swal />

    <div class="px-5 py-4 sm:px-6 sm:py-6">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Gérer les absents – {{ $seance->intitule }}
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            {{ $seance->date }} | {{ $seance->heure_debut }} - {{ $seance->heure_fin }} | {{ $seance->promotion->nom }}
        </p>
    </div>

    <div class="px-5 sm:px-6">
        <form action="{{ route('seances.enregistrerAbsents', $seance->id) }}" method="POST">
            @csrf

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3 text-left">Apprenant</th>
                            <th class="px-5 py-3 text-left">Absent ?</th>
                            <th class="px-5 py-3 text-left">Justifié ?</th>
                            <th class="px-5 py-3 text-left">Justification</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($apprenants as $apprenant)
                        @php
                        $absence = $absencesExistantes[$apprenant->id] ?? null;
                        @endphp
                        <tr>
                            <td class="px-5 py-4">
                                {{ $apprenant->nom }} {{ $apprenant->prenom }}
                                <input type="hidden" name="absents[{{ $loop->index }}][apprenant_id]" value="{{ $apprenant->id }}">
                            </td>
                            <td class="px-5 py-4">
                                <input type="checkbox"
                                    name="absents[{{ $loop->index }}][absent]"
                                    value="1"
                                    {{ $absence ? 'checked' : '' }}
                                    onchange="this.closest('tr').querySelectorAll('.justifie-fields').forEach(el => el.style.display = this.checked ? 'table-cell' : 'none')">
                                <x-input-error :messages="$errors->get('absents.' . $loop->index . '.absent')"
                                    </td>
                            <td class="px-5 py-4 justifie-fields">
                                <input type="checkbox"
                                    name="absents[{{ $loop->index }}][est_justifie]"
                                    value="1"
                                    {{ ($absence && $absence->est_justifie) ? 'checked' : '' }}>
                                <x-input-error :messages="$errors->get('absents.' . $loop->index . '.est_justifie')" class="mt-2" />
                            </td>
                            <td class="px-5 py-4 justifie-fields">
                                <input type="text"
                                    name="absents[{{ $loop->index }}][justification]"
                                    value="{{ $absence->justification ?? '' }}"
                                    class="w-full rounded border-gray-300 text-sm"
                                    placeholder="Raison de l'absence">
                                <x-input-error :messages="$errors->get('absents.' . $loop->index . '.justification')" class="mt-2" />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex gap-3">
                <x-primary-button type="submit">
                    Enregistrer les absences
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>