<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InsuffisantDatasException;
use App\Exceptions\InvalidDatasException;


class Pays extends Model
{
    protected $table = 'pays';
    protected $primaryKey = 'idPays';
    public $incrementing = false;       //Sinon return tjrs 0 en primary key
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
