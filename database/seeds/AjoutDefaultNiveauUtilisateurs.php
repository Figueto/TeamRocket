<?php

use Illuminate\Database\Seeder;

class AjoutDefaultNiveauUtilisateurs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('niveauutilisateur')->insert([
            'idNiveau' => 1,
            'type' => 'Super Administrateur',
        ]);

        DB::table('niveauutilisateur')->insert([
            'idNiveau' => 2,
            'type' => 'Administrateur',
        ]);

        DB::table('niveauutilisateur')->insert([
            'idNiveau' => 5,
            'type' => 'Utilisateur',
        ]);
    }
}
