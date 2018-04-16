<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

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
            'pass' => Crypt::encrypt('admin'),
            'actif' => '1',
            'idNiveau' => '1',
        ]);
    }
}
