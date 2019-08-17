<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MerModel extends Model
{
    protected $table = "merchant";
    public $timestamps = false;
    public $primaryKey = 'mer_id';

    public function getUser()
    {
        return $this->belongsTo('App\Model\UsersModel','mer_id','mer_id');
    }
}
