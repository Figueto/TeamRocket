<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table = 'serie';
    protected $primaryKey = 'idSerie';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titre', 'visible', 'resume', 'keywords'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
