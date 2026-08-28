<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\ApprenantPersonneResponsable;
use App\Http\Requests\Message;
use App\Models\Apprenant;
use Illuminate\Http\Request;
use App\Models\Candidat;
use App\Models\Niveau;
use App\Models\PersonneResponsable;
use Illuminate\Validation\Rule;
use App\Models\Bulletin;
use Illuminate\Support\Facades\Storage;


use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class ApprenantController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view.apprenant',only:['index','show']),
            new Middleware('permission:create.apprenant',only:['create','store']),
            new Middleware('permission:update.apprenant',only:['edit','update']),
            new Middleware('permission:delete.apprenant',only:['destroy']),
        ];
    }

    public function index()
    {
        $apprenants = Apprenant::all();
        return view('apprenants.index', compact('apprenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $personne_reponsables = PersonneResponsable::all();
        $niveaux = Niveau::all();

        return view('apprenants.form', compact('personne_reponsables', 'niveaux'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|min:3',
            'prenom' => 'required|string|max:255|min:3',
            'telephone' => 'required|min:4|string|max:20|unique:candidats,telephone',
            'email' => 'required|email|max:255|unique:apprenants,email',
            'sexe' => 'required|in:M,F',
            'adresse' => 'required|string|max:255|min:3',
            'date_naissance' => 'required|date',
            'etablissement' => 'required|string|max:255|min:2',
            'personne_reponsable_id' => 'nullable|exists:personne_responsables,id',
            'bulletins' => 'nullable|array',
            'bulletins.*' => 'nullable|array',
            'bulletins.*.*' => 'nullable|mimes:jpg,png,pdf',
            'prise_en_charge' => 'required|integer|in:0,1'
        ]);

        //bulletins

        //dd($request->all());

        DB::transaction(
            function () use ($validated, $request) {
                $apprenant = Apprenant::create($validated);
                ApprenantPersonneResponsable::create(
                    [
                        'personne_responsable_id' => $validated['personne_reponsable_id'],
                        'apprenant_id' => $apprenant->id,
                    ]
                );

                if (isset($validated['bulletins'])) {
                    $bulletins = $validated['bulletins'];
                    $cles = array_keys($bulletins);
                    $niveau_id = 0;
                    foreach ($bulletins as $niveau) {
                        $num_buletin = 1;
                        $niveau_file_path = [];
                        $niveau_bd;
                        foreach ($niveau as $bulletin) {

                            $niveau_bd = Niveau::find($cles[$niveau_id]);
                            $file_name = $niveau_bd->nom . '-' . $num_buletin . '.' . $bulletin->extension();
                            $bulletin_path = $bulletin->storeAs('bulettins/' . $validated['nom'] . '.' . $validated['prenom'] . '/' . $cles[$niveau_id], $file_name, 'public');
                            $niveau_file_path[] = $bulletin_path;
                            $num_buletin++;
                        }

                        $bulletin = Bulletin::create(
                            [
                                'bulletin1' => $niveau_file_path[0] ?? null,
                                'bulletin2' => $niveau_file_path[1] ?? null,
                                'bulletin3' => $niveau_file_path[2] ?? null,
                                'bulletin4' => $niveau_file_path[3] ?? null,
                                'bulletin5' => $niveau_file_path[4] ?? null,
                                "niveau_id" => $niveau_bd->id,
                                "apprenant_id" => $apprenant->id,
                            ]
                        );
                        $niveau_id++;
                    }
                }
            }
        );







        $message = Message::success('Apprenant créer avec success !');

        return to_route('apprenants.index')->with($message->toMap());
    }

    /**
     * Display the specified resource.
     */
    public function show(Apprenant $apprenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apprenant $apprenant)
    {
        $personne_reponsables = PersonneResponsable::all();
        $niveaux = Niveau::all();

        return view('apprenants.form', compact('apprenant', 'personne_reponsables', 'niveaux'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apprenant $apprenant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|min:3',
            'prenom' => 'required|string|max:255|min:3',
            'telephone' => [
                'required',
                'min:4',
                'string',
                'max:20',
                Rule::unique('apprenants', 'telephone')->ignore($apprenant->id, 'id'),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'email',
                Rule::unique('apprenants', 'email')->ignore($apprenant->id, 'id'),

            ],
            'sexe' => 'required|in:M,F',
            'adresse' => 'required|string|max:255|min:3',
            'date_naissance' => 'required|date',
            'etablissement' => 'required|string|max:255|min:2',
            'personne_reponsable_id' => 'nullable|exists:personne_responsables,id',
            'bulletins' => 'nullable|array',
            'bulletins.*' => 'nullable|array',
            'bulletins.*.*' => 'nullable|mimes:jpg,png,pdf',
            'prise_en_charge' => 'required|integer|in:0,1',
        ]);

        DB::transaction(
            function () use ($validated, $request, $apprenant) {

                $apprenant->update($validated);

                ApprenantPersonneResponsable::firstOrCreate([
                    'apprenant_id' => $apprenant->id,
                    'personne_responsable_id' => $validated['personne_reponsable_id']
                ]);

             


                if (isset($validated['bulletins'])) {
                    $bulletins = $validated['bulletins'];

                    foreach ($bulletins as $niveau_id => $bulletin_files) {
                        $niveau_bd = Niveau::find($niveau_id);
                        if (!$niveau_bd) continue;

                        $bulletinModel = Bulletin::firstOrNew([
                            'niveau_id' => $niveau_bd->id,
                            'apprenant_id' => $apprenant->id,
                        ]);

                        $bulletins_limites = array_slice($bulletin_files, 0, 5);

                        $num_bulletin = 1;
                        foreach ($bulletins_limites as $bulletin_file) {
                            $champ_bulletin = 'bulletin' . $num_bulletin;

                            if (!empty($bulletinModel->$champ_bulletin)) {
                                if (Storage::disk('public')->exists($bulletinModel->$champ_bulletin)) {
                                    Storage::disk('public')->delete($bulletinModel->$champ_bulletin);
                                }
                            }

                            $file_name = $niveau_bd->nom . '-' . $num_bulletin . '.' . $bulletin_file->extension();
                            $bulletin_path = $bulletin_file->storeAs(
                                'bulettins/' . $validated['nom'] . '.' . $validated['prenom'] . '/' . $niveau_id,
                                $file_name,
                                'public'
                            );

                            $bulletinModel->$champ_bulletin = $bulletin_path;

                            $num_bulletin++;
                        }

                        $bulletinModel->save();
                    }
                }
            }
        );



        $message = Message::success('Apprenant â été mofifier avec success !');

        return to_route('apprenants.index')->with($message->toMap());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apprenant $apprenant)
    {
        $apprenant->delete();
        $message = Message::success('Apprenant supprimer avec success !');

        return to_route('apprenants.index')->with($message->toMap());
    }
}
