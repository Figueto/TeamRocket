<?php

use Illuminate\Database\Seeder;

class AjoutSuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('utilisateur')->insert([
            'pseudo' => 'superAdmin',
            'mail' => 'superAdmin@admin.com',
            'pass' => bcrypt('admin'),
            'actif' => '1',
            'idNiveau' => '1',
        ]);
    }
}
