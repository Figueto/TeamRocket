<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnumOperation extends Model
{
    protected $table = 'enumoperation';
    protected $primaryKey = 'idEnumOperation';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['intitule'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
