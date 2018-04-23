<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InsuffisantDatasException;
use App\Exceptions\InvalidDatasException;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Utilisateur extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    protected $table = 'utilisateur';
    protected $primaryKey = 'idUtilisateur';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pseudo', 'mail'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['idNiveau', 'actif', 'pass'];

    /*
    *   Vérifie les attribus entrées
    *   @throws : InsuffisantDatasException - InvalidDatasException
    */
    public function hasRequiredAttribute(){
        if(empty($this->attributes['pseudo']) || empty($this->attributes['mail']) || empty($this->attributes['pass']))
            throw new InsuffisantDatasException('pseudo & mail & password needed');

        if(strlen($this->attributes['pseudo']) > 32 || strlen($this->attributes['mail']) > 32)
            throw new InvalidDatasException('pseudo or mail too long : 32 char max');
    }
}
