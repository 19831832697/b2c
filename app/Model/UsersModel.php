<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    public $timestamps = false;
    public  $primaryKey = 'id';

    public function mer()
    {
        return $this->hasOne('App\Model\MerModel','mer_id');
    }
}
