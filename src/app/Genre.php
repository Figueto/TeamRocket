<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genre';
    protected $primaryKey = 'idGenre';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nom'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
