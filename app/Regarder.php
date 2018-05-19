<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regarder extends Model
{
    protected $table = 'regarder';
    //doute : primary ou foreign ?
    protected $primaryKey = ['idUtilisateur', 'idOeuvre'];
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['idUtilisateur', 'idOeuvre', 'dateVisionnage', 'note', 'avis'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
