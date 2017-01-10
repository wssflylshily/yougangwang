<?php  
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use League\Flysystem\Exception;
use Request;
use Validator;
use App;
use Illuminate\Support\Facades\Auth;
use DB;

class StocksController extends Controller{

	// 发布现货
	public function publish(){
	    $area = DB::table('areas')->where('parentId', 0)->get();
	    $this->publishGoods();
		return view('seller.stocks.publish',['result' => "",'provinces' => $area]);
	}

    /**
     * 发布现货--表单提交
     * 孙璠
     * 2016.12.28
     */
	public function postGoods()
    {
        try{
            $area = DB::table('areas')->where('parentId', 0)->get();
            $public_result = $this->publishGoods();
            if ($public_result == 1){
                return view('seller.stocks.publish',['result' => "发布成功！",'provinces' => $area]);
            }else{
                return view('seller.stocks.publish',['result' => $public_result,'provinces' => $area]);
            }
        }catch (Exception $e){
            throw $e;
        }
    }

    /**
     * 我的仓库
     * 孙璠
     * 2016.12.28
     */
	public function mystores(){
        $db = App\Goods::query();
        $goods = $db->orderBy('created_at', 'desc')->take(10)->get();
		return view('seller.stocks.mystores',['goods' => $goods]);
	}

    /**
     * 查看仓库
     * 孙璠
     * 2016.12.28
     */
	public function seeStores(){
        $db = App\Goods::query();
        $area = DB::table('areas')->where('parentId', 0)->get();
        $goods = $db->leftJoin('areas', 'areas.areaId', '=', 'goods.area_code')->orderBy('created_at', 'desc')->paginate(10);
		return view('seller.stocks.see_stores',['goods' => $goods, 'provinces' => $area, 'result' => Request::input('result')?Request::input('result'):""]);
	}

    /**
     * 仓库--发布现货
     * 孙璠
     * 2016.12.28
     */
    public function postGoods_store()
    {
        try{
            $area = DB::table('areas')->where('parentId', 0)->get();
            $public_result = $this->publishGoods();
            if ($public_result == 1){
                return view('seller.stocks.see_stores',['result' => "发布成功！",'provinces' => $area]);
            }else{
                return view('seller.stocks.see_stores',['result' => $public_result,'provinces' => $area]);
            }
        }catch (Exception $e){
            throw $e;
        }
    }

	public function publishGoods()
    {
        try{
            $db_goods = new App\Goods;
            $validator = Validator::make(Request::all(), [
                'province'    => 'required',
                'city' => 'required',
                'goods_price' => 'required',
                'variety' => 'required',
                'standard' => 'required',
                'material' => 'required',
                'steelmill' => 'required',
                'outer_diameter' => 'required',
                'thickness' => 'required',
                'length' => 'required',
                'unit' => 'required',
                'stock' => 'required'
            ], [
                'province.required'   => '地区不能为空!',
                'city.required'      => '城市不能为空!',
                'goods_price.required'     => '价格不能为空!',
                'variety.required'     => '品种不能为空!',
                'standard.required' => '标准不能为空!',
                'material.required' => '材质不能为空!',
                'steelmill.required' => '钢厂不能为空!',
                'outer_diameter.required' => '外径不能为空!',
                'thickness.required' => '厚度不能为空!',
                'length.required' => '长度不能为空!',
                'unit.required' => '单位不能为空!',
                'stock.required' => '库存不能为空!',
            ]);

            if ($validator->fails()) {
                //return view('seller.stocks.publish',['result' => $validator->messages()->first(),'provinces' => $area]);
                return $validator->messages()->first();
            }

            $db_goods->seller_id = Auth::user()->id;
            $db_goods->type = 0;        //0.现货
            $db_goods->province = Request::input('province');
            $db_goods->area_code = Request::input('city');
            $db_goods->price = Request::input('goods_price');
            $db_goods->variety = Request::input('variety');
            $db_goods->standard = Request::input('standard');
            $db_goods->material = Request::input('material');
            $db_goods->steelmill = Request::input('steelmill');
            $db_goods->outer_diameter = Request::input('outer_diameter');
            $db_goods->thickness = Request::input('thickness');
            $db_goods->length = Request::input('length');
            $db_goods->unit = Request::input('unit');
            $db_goods->stock = Request::input('stock');
            if ($db_goods->save()){
                return 1;
            }else{
                return "网络错误！";
            }
        }catch (Exception $e){
            throw $e;
        }
    }

    /**
     * 设置/取消特卖
     * 孙璠
     * 2016.12.28
     */
    public function setTm()
    {
        try{
            $db = App\Goods::query();
            $ids = Request::input('id');
            $type = Request::input('type');

            if ($ids && $type != null)
            {
                $db->whereIn('id', $ids)
                    ->update(['type' => Request::input('type')]);
                return "操作成功！";
            }else
            {
                return "没有可供操作的数据!";
            }

        }catch (Exception $e){
            return $e;
        }
    }

    /**
     * 批量删除现货
     * 孙璠
     * 2016.12.28
     */
    public function deleteGoods()
    {
        try{
            $db = App\Goods::query();
            $ids = Request::input('id');
            $type = Request::input('type');
            if ($ids && $type != null)
            {
                $db->whereIn('id', $ids)
                    ->delete();
                return "操作成功！";
            }else
            {
                return "没有可供操作的数据!";
            }

        }catch (Exception $e){
            throw $e;
        }
    }

    /**
     * 删除现货
     * 孙璠
     * 2016.12.28
     */
    public function deleteOneGoods()
    {
        try{
            $db = App\Goods::query();
            $id = Request::input('id');
            $type = Request::input('type');
            if ($id != null)
            {
                $db->where('id', $id)
                    ->delete();
                return "操作成功！";
            }else
            {
                return "没有可供操作的数据!";
            }

        }catch (Exception $e){
            throw $e;
        }
    }

    /**
     * 修改现货信息
     * 孙璠
     * 2016.12.28
     */
    public function editor_stores()
    {
        try{
            $db = App\Goods::query();
            $area = DB::table('areas')->where('parentId', 0)->get();
            $goods = $db->where('id', Request::input('id'))->first();
            $city = DB::table('areas')->where('parentId', $goods->province)->get();
            return view('seller.stocks.editor_stores',['goods' => $goods, 'result' => '', 'provinces' => $area, 'cities' => $city]);
        }catch (Exception $e){
            throw $e;
        }
    }

    /**
     * 提交 修改现货信息
     * 孙璠
     * 2016.12.28
     */
    public function postRepublish()
    {
        try{
            $db_goods = App\Goods::query();
            $area = DB::table('areas')->where('parentId', 0)->get();
            $goods = $db_goods->where('id', Request::input('id'))->first();
            $city = DB::table('areas')->where('parentId', $goods->province)->get();
            $validator = Validator::make(Request::all(), [
                'province'    => 'required',
                'city' => 'required',
                'goods_price' => 'required',
                'variety' => 'required',
                'standard' => 'required',
                'material' => 'required',
                'steelmill' => 'required',
                'outer_diameter' => 'required',
                'thickness' => 'required',
                'length' => 'required',
                'unit' => 'required',
                'stock' => 'required'
            ], [
                'province.required'   => '地区不能为空!',
                'city.regex'      => '城市不能为空!',
                'goods_price.exists'     => '价格不能为空!',
                'variety.exists'     => '品种不能为空!',
                'standard.required' => '标准不能为空!',
                'material.required' => '材质不能为空!',
                'steelmill.required' => '钢厂不能为空!',
                'outer_diameter.required' => '外径不能为空!',
                'thickness.required' => '厚度不能为空!',
                'length.required' => '长度不能为空!',
                'unit.required' => '单位不能为空!',
                'stock.required' => '库存不能为空!',
            ]);

            if ($validator->fails()) {
                return view('seller.stocks.editor_stores',['goods' => $goods, 'result' => $validator->messages()->first(), 'provinces' => $area, 'cities' => $city]);
                //return $validator->messages()->first();
            }

            $rs = $db_goods->where('id', Request::input('id'))
                ->update([
                    'province' => Request::input('province'),
                    'area_code' => Request::input('city'),
                    'price' => Request::input('goods_price'),
                    'variety' => Request::input('variety'),
                    'standard' => Request::input('standard'),
                    'material' => Request::input('material'),
                    'steelmill' => Request::input('steelmill'),
                    'outer_diameter' => Request::input('outer_diameter'),
                    'thickness' => Request::input('thickness'),
                    'length' => Request::input('length'),
                    'unit' => Request::input('unit'),
                    'stock' => Request::input('stock'),
                ]);
            $goods = $db_goods->where('id', Request::input('id'))->first();
            //return view('seller.stocks.editor_stores',['goods' => $goods, 'result' => "修改成功！", 'provinces' => $area, 'cities' => $city]);
            return redirect(route('seller.stocks.all', ['result' => "修改成功！"]));
        }catch (Exception $e){
            throw $e;
        }
    }

    /**
     * 商铺订单
     * 孙璠
     * 2016.12.29
     */
    protected function getOrder()
    {
        return view('seller.stocks.order');
    }
    
    /**
     * 现货订单列表
     */
    protected function getOrders(){
        $db_orders = App\Order::query();
        if (Request::input('type') != null)
        {
            $db_orders->where('status' , Request::input('type'));
        }
        $orders =$db_orders
            ->where('seller_id', Auth::user()->id)
            ->where('type',1)
//            ->leftJoin('users', 'users.id', '=', 'orders.user_id' )
//            ->orderBy('orders.created_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->with('goods')
            ->with('seller')
            //->get();
            ->paginate(8);

    	return view('seller.stocks.orders', ['order_goods' => $orders]);
    }

    /**
     * 查看物流信息
     */
    protected function getLogistics(){
        $db_orders = App\Order::query();
        $order =$db_orders
            ->where('order_sn',Request::input('order_sn'))
            ->with('goods')
            ->with('seller')
            ->first();

        $db_logistic = App\Logistics::query();
        $logistic = $db_logistic->where('order_id', $order->id)->orderBy('created_at', 'desc')->get();
    	return view('seller.stocks.logistics_write',['order' => $order, 'logistic' => $logistic]);
    }

    /**
     *
     */
    protected function postLogistics()
    {
        if (Request::input('order_id') && Request::input('news'))
        {
            App\Logistics::create(['message' => Request::input('news'), 'order_id' => Request::input('order_id')]);
        }
        return 1;
    }

    /**
     * 修改订单状态---临时
     * 孙璠
     * 2016.12.29
     */
    protected function changeOrderStatus()
    {
        $db = App\Order::query();
        if (Request::input('order_sn') && Request::input('status'))
        {
            $db->where('order_sn', Request::input('order_sn'))->update(['status' => Request::input('status')]);
        }
        return redirect(route('seller.stocks.orders'));
    }

}