<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Sku extends RowAction
{
    public $name = '添加sku';

    public function handle(Model $model)
    {
        return $this->response()->success('Success message.')->refresh();
    }

    /**
     * 跳转页面
     * @return string
     */
    public function href()
    {
        $goods_id = $this->getKey();
        return "/admin/sku/$goods_id";
    }
}
