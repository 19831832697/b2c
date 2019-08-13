<?php

namespace App\Admin\Controllers;

use App\Model\GoodsModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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
        $grid->column('is_tell', __('Is tell'));
//        $grid->column('goods_img', __('Goods img'));
        $grid->column('goods_price', __('Goods price'));
        $grid->column('goods_shelf', __('Goods shelf'));
        $grid->column('goods_sn', __('Goods sn'));
        $grid->column('goods_num', __('Goods num'));
        $grid->column('goods_hot', __('Goods hot'));
//        $grid->column('sale_num', __('Sale num'));
        $grid->column('mer_id', __('Mer id'));
        $grid->column('goods_desc', __('Goods desc'));
        $grid->column('is_del', __('Is del'));

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
        $show->field('is_tell', __('Is tell'));
//        $show->field('goods_img', __('Goods img'));
        $show->field('goods_price', __('Goods price'));
        $show->field('goods_shelf', __('Goods shelf'));
        $show->field('goods_sn', __('Goods sn'));
        $show->field('goods_num', __('Goods num'));
        $show->field('goods_hot', __('Goods hot'));
//        $show->field('sale_num', __('Sale num'));
        $show->field('mer_id', __('Mer id'));
        $show->field('goods_desc', __('Goods desc'));
        $show->field('is_del', __('Is del'));

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
        $form->number('is_tell', __('Is tell'))->default(2);
//        $form->text('goods_img', __('Goods img'));
        $form->file('path');
        $form->decimal('goods_price', __('Goods price'));
        $form->text('goods_shelf', __('Goods shelf'))->default('1');
        $form->text('goods_sn', __('Goods sn'));
        $form->number('goods_num', __('Goods num'));
        $form->text('goods_hot', __('Goods hot'));
        $form->number('sale_num', __('Sale num'));
        $form->text('mer_id', __('Mer id'));
        $form->text('goods_desc', __('Goods desc'));
        $form->number('is_del', __('Is del'))->default(1);

        return $form;
    }
}
