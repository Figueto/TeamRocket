<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InsuffisantDatasException;
use App\Exceptions\InvalidDatasException;

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

     public function hasRequiredAttribute(){
         if(empty($this->attributes['nom']) || empty($this->attributes['prenom']))
            throw new InsuffisantDatasException('nom & prenom needed');

         if(strlen($this->attributes['nom']) > 64 || strlen($this->attributes['prenom']) > 64)
            throw new InvalidDatasException('nom or prenom too long : 64 char max');
     }
}
