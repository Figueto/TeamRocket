<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NiveauUtilisateur extends Model
{
    protected $table = 'niveauutilisateur';
    protected $primaryKey = 'idNiveau';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
