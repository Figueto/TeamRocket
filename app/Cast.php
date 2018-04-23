<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    protected $table = 'cast';
    protected $primaryKey = 'idCast';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nom', 'prenom', 'illustration', 'dateNaissance', 'dateMort'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
