<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->call(AjoutDefaultGenre::class);
       $this->call(AjoutDefaultNiveauUtilisateurs::class);
       $this->call(AjoutDefaultOperation::class);
       $this->call(AjoutSuperAdmin::class);
    }
}
