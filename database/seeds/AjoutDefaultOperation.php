<?php

use Illuminate\Database\Seeder;

class AjoutDefaultOperation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('enumoperation')->insert([
            'idEnumOperation' => 1,
            'intitule' => 'Ajout',
        ]);

        DB::table('enumoperation')->insert([
            'idEnumOperation' => 2,
            'intitule' => 'Suppression',
        ]);

        DB::table('enumoperation')->insert([
            'idEnumOperation' => 3,
            'intitule' => 'Modification',
        ]);
    }
}
