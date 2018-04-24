<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
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


    private static $admin_right = []; 
    private static $user_right = []; 
    /*
    *   Return true if the user has the right to ...
    *   @returns bool
    */
    public function has_right(string $right){
        switch($this->idNiveau){
            case 1: 
                //SuperAdmin  
                return true;
            case 2:
                //Admin
                if(in_array($right, $admin_right))
                    return true;
                return false;
            case 3:
                //User
                if(in_array($right, $user_right))
                    return true;
                return false;
            }
        return false;
    }
}
