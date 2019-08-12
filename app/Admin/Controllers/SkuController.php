<?php

namespace App\Admin\Controllers;

use App\Model\SkuModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SkuController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Model\SkuModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SkuModel);

        $grid->column('id', __('Id'));
        $grid->column('goods_id', __('Goods id'));
        $grid->column('goods_sn', __('Goods sn'));
        $grid->column('sku', __('Sku'));
        $grid->column('desc', __('Desc'));
        $grid->column('create_at', __('Create at'));
        $grid->column('update_at', __('Update at'));
        $grid->column('price0', __('Price0'));
        $grid->column('price', __('Price'));
        $grid->column('store', __('Store'));

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
        $show = new Show(SkuModel::findOrFail($id));

//        $show->field('id', __('Id'));
        $show->field('goods_id', __('Goods id'));
        $show->field('goods_sn', __('Goods sn'));
        $show->field('sku', __('Sku'));
        $show->field('desc', __('Desc'));
        $show->field('create_at', __('Create at'));
        $show->field('update_at', __('Update at'));
        $show->field('price0', __('Price0'));
        $show->field('price', __('Price'));
        $show->field('store', __('Store'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SkuModel);

        $form->number('goods_id', __('Goods id'));
        $form->text('goods_sn', __('Goods sn'));
        $form->text('sku', __('Sku'));
        $form->text('desc', __('Desc'));
        $form->text('create_at', __('Create at'));
        $form->datetime('update_at', __('Update at'))->default(date('Y-m-d H:i:s'));
        $form->number('price0', __('Price0'));
        $form->number('price', __('Price'));
        $form->number('store', __('Store'));

        return $form;
    }
}
