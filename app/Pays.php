<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    protected $table = 'pays';
    protected $primaryKey = 'idPays';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['idPays', 'nom'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
