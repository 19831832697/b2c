<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    protected $table = 'shop_goods';
//    public $timestamps = false;
    public $primaryKey = 'goods_id';

    public function sku()
    {
        return $this->hasMany('App\Model\GoodsModel','goods_id');
    }
}