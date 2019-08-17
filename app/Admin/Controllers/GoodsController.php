<?php

namespace App\Admin\Controllers;

use App\Model\GoodsModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\Sku;
use Illuminate\Support\Facades\DB;

class GoodsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Model\GoodsModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GoodsModel);

        $grid->column('goods_id', __('Goods id'));
        $grid->column('goods_name', __('Goods name'));
        $grid->column('goods_sn', __('Goods sn'));
        $grid->column('goods_shelf', __('Goods shelf'));
        $grid->column('goods_num', __('Goods num'));
        $grid->column('goods_img', __('Goods img'))->image();
        $grid->column('goods_desc', __('Goods desc'));

        $grid->actions(function ($actions) {
            $actions->add(new Sku);
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(GoodsModel::findOrFail($id));

        $show->field('goods_id', __('Goods id'));
        $show->field('goods_name', __('Goods name'));
        $show->field('goods_sn', __('Goods sn'));
        $show->field('goods_shelf', __('Goods shelf'));
        $show->field('goods_num', __('Goods num'));
        $show->field('goods_img', __('Goods img'))->image();
        $show->field('goods_desc', __('Goods desc'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new GoodsModel);

        $form->number('goods_id', __('Goods id'));
        $form->text('goods_name', __('Goods name'));
        $form->text('goods_sn', __('Goods sn'));
        $form->number('goods_shelf', __('Goods shelf'));
        $form->number('goods_num', __('Goods num'));
        $form->file('goods_img', __('Goods img'));
        $form->text('goods_desc', __('Goods desc'));
        return $form;
    }
}
