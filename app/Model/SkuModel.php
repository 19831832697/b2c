<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SkuModel extends Model
{
    protected $table = 'p_sku';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function goods()
    {
        return $this->belongsTo('App\Model\SkuModel','id','id');
    }
}
