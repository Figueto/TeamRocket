<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InsuffisantDatasException;
use App\Exceptions\InvalidDatasException;


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

    /*
    *   Vérifie les attribus entrées
    *   @throws : InsuffisantDatasException - InvalidDatasException
    */
    public function hasRequiredAttribute(){
        if(empty($this->attributes['idPays']) || empty($this->attributes['nom']))
            throw new InsuffisantDatasException('idPays & nom needed');
        
        if(strlen($this->attributes['idPays']) !== 2)
            throw new InvalidDatasException('idPays : 2 chars only');
    }
}
