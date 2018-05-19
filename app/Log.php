<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';
    protected $primaryKey = 'idLog';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['idAdministrateur', 'idOeuvre', 'idSerie', 'idEnumOperation', 'idCast', 'idUtilisateur'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
