<?php

namespace App\Admin\Controllers;

use App\Model\GoodsAttrModel;
use App\Model\GoodsAttrValueModel;
use App\Model\GoodsModel;
use App\Model\SkuModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SkuController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Model\SkuModel';

    /**
     * sku
     * @param $goods_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sku($id)
    {
        $goodsInfo = DB::table('shop_goods')->where(['goods_id'=>$id])->first();
        return view('sku.sku',['goodsInfo'=>$goodsInfo]);
    }

    /**
     * 添加sku
     * @param Request $request
     */
    public function skuInsert(Request $request)
    {
        $sku = $request->input('sku');
        $price = $request->input('price');
        $price0 = $request->input('price0');
        $arr = [
            'sku'=>$sku,
            'price'=>$price,
            'price0'=>$price0,
            'goods_id'=>$_POST['goods_id'],
            'goods_sn'=>$_POST['goods_sn'],
            'create_at'=>date('Y-m-d H:i:s',time()),
            'update_at'=>date('Y-m-d H:i:s',time()),
        ];
        $skuInfo = DB::table('p_sku')->insert($arr);
        var_dump($skuInfo);
    }

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

    /**
     * 静态页面
     * @param Content $content
     * @param $id
     * @return Content
     */
    public function skuDetail(Content $content,$id)
    {
        $form = new Form(new SkuModel);
        $form->setAction('/admin/sku-detail-update?id='.$id);
        $form->text('goods_id', __('Goods id'))->default($id);
        $form->text('goods_sn', __('商品编号'));

        //获取当前商品属性
        $attr = GoodsModel::find($id)->toArray();
        if($attr['attr']){
            $attr_arr = explode(',',$attr['attr']);
            $i = 0;
            foreach($attr_arr as $k=>$v)
            {
                $attr_info = GoodsAttrModel::find($v);
                $attr_value = GoodsAttrValueModel::select('id','title')->where(['attr_id'=>$v])->orderBy('order','asc')->get()->toArray();
                $option = [];
                foreach($attr_value as $k1=>$v1){
                    $option[$v1['id']] = $v1['title'];
                }
                $form->select('attr'.$i, __($attr_info->title))->options($option);
                $i++;
            }
        }

        $form->text('sku', __('Sku'));
        $form->number('price0', __('定价'));
        $form->number('price', __('售价'));
        $form->number('store', __('库存'));

        return $content->body($form);
    }

    /**
     * sku添加执行
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function skuUpdate()
    {
        $attr_path = '';
        for($i=0;$i<3;$i++)
        {
            if(isset($_GET['attr'.$i])){
                $attr_path .= $_GET['attr'.$i] . ',';
                unset($_GET['attr'.$i]);
            }
        }

        $_GET['attr_path'] = rtrim($attr_path,',');
        unset($_GET['_token']);
        SkuModel::insert($_GET);
        admin_toastr('添加成功','success');
        return redirect('/admin/sku-detail/'.$_GET['id']);
    }
}
