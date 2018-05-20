<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oeuvre extends Model
{
    protected $table = 'oeuvre';
    protected $primaryKey = 'idOeuvre';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titre', 'dateSortie', 'lienBandeAnnonce','illustration', 'slug', 'resume', 'keywords', 'saison', 'numEpisode', 'idSerie'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
