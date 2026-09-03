<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentPedagogiqueEmpruntSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $document_pedagogique_ids = DB::table("document_pedagogiques")->pluck('id')->all();
        $emprunt_ids = DB::table("emprunts")->pluck('id')->all();


        DB::table('document_pedagogique_emprunts')->insert([
            [
                'document_pedagogique_id' => $document_pedagogique_ids[0],
                'emprunt_id'              => $emprunt_ids[0],
                'created_at'              => now(),
                'updated_at'              => now(),
            ],
            [
                'document_pedagogique_id' => $document_pedagogique_ids[1],
                'emprunt_id'              => $emprunt_ids[1],
                'created_at'              => now(),
                'updated_at'              => now(),
            ],
            [
                'document_pedagogique_id' => $document_pedagogique_ids[1],
                'emprunt_id'              => $emprunt_ids[2],
                'created_at'              => now(),
                'updated_at'              => now(),
            ],
            [
                'document_pedagogique_id' => $document_pedagogique_ids[0],
                'emprunt_id'              => $emprunt_ids[3],
                'created_at'              => now(),
                'updated_at'              => now(),
            ],
        ]);
        echo "document_pedagogiqueEmprunt seeder";
    }
}
