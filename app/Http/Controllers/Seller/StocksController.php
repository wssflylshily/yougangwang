<?php  
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use League\Flysystem\Exception;
use Request;
use Validator;
use App;
use Illuminate\Support\Facades\Auth;
use DB;
use Excel;
require('./PHPExcel/PHPExcel.php');//引入PHP EXCEL类


class StocksController extends Controller{

	// 发布现货
	public function publish(){
	    $area = DB::table('areas')->where('parentId', 0)->get();
	    $this->publishGoods();

        //品种
        $db1 = App\Variety::query();
        $result['varieties'] = $db1->get();

        //材质
        $db2 = App\Material::query();
        $result['materials'] = $db2->get();

        //标准
        $db3 = App\Standard::query();
        $result['standards'] = $db3->get();

        //钢厂
        $db4 = App\SteelMill::query();
        $result['steelmills'] = $db4->get();

		return view('seller.stocks.publish',['result' => "",'provinces' => $area], $result);
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

            //品种
            $db1 = App\Variety::query();
            $result['varieties'] = $db1->get();

            //材质
            $db2 = App\Material::query();
            $result['materials'] = $db2->get();

            //标准
            $db3 = App\Standard::query();
            $result['standards'] = $db3->get();

            //钢厂
            $db4 = App\SteelMill::query();
            $result['steelmills'] = $db4->get();

            if ($public_result == 1){
                return view('seller.stocks.publish',['result' => "发布成功！",'provinces' => $area],$result);
            }else{
                return view('seller.stocks.publish',['result' => $public_result,'provinces' => $area],$result);
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
        $sellerid = Auth::user()->id;
        $seller = App\Seller::query()->where('user_id',$sellerid)->first();
        //$sellerid = 1;
        $groups = $db->where('seller_id', $sellerid)
            ->groupBy('variety')->get();
        $i=0;
        $goods=array();
        foreach ($groups as $item)
        {
            $goods[$i] = App\Goods::query()->where('seller_id', $sellerid)
                ->where('variety', $item->variety)
                ->leftJoin('areas', 'areas.areaId', '=', 'goods.area_code')
                ->orderBy('created_at', 'desc')->take(10)->get();
            $i++;
        }
		return view('seller.stocks.mystores',['groups' => $groups, 'goods' => $goods,'seller'=>$seller]);
	}

    /**
     * 查看仓库
     * 孙璠
     * 2016.12.28
     */
	public function seeStores(){
        $db = App\Goods::query();
        $area = DB::table('areas')->where('parentId', 0)->get();
        $variety = Request::input('variety');
        $goods = $db->where('seller_id', Auth::user()->id)
            ->where('variety', Request::input('variety'))
            ->leftJoin('areas', 'areas.areaId', '=', 'goods.area_code')
            ->orderBy('created_at', 'desc')->paginate(10);
//dd($goods);
        session(['site'=>$goods]);
        //品种
        $db1 = App\Variety::query();
        $result['varieties'] = $db1->get();

        //材质
        $db2 = App\Material::query();
        $result['materials'] = $db2->get();

        //标准
        $db3 = App\Standard::query();
        $result['standards'] = $db3->get();

        //钢厂
        $db4 = App\SteelMill::query();
        $result['steelmills'] = $db4->get();

        return view('seller.stocks.see_stores',['goods' => $goods, 'provinces' => $area, 'result' => Request::input('result')?Request::input('result'):"",'variety'=>$variety], $result);
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

            //品种
            $db1 = App\Variety::query();
            $result['varieties'] = $db1->get();

            //材质
            $db2 = App\Material::query();
            $result['materials'] = $db2->get();

            //标准
            $db3 = App\Standard::query();
            $result['standards'] = $db3->get();

            //钢厂
            $db4 = App\SteelMill::query();
            $result['steelmills'] = $db4->get();

            return view('seller.stocks.editor_stores',['goods' => $goods, 'result' => '', 'provinces' => $area, 'cities' => $city], $result);
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

    /**
     * 开发票
     * 孙璠
     * 2016.12.29
     */
    protected function getInvoice()
    {
        //$this->changeOrderStatus(Request::input('order_sn'),8);
        $db_orders = App\Order::query();
        $order =$db_orders
            ->where('order_sn',Request::input('order_sn'))
            ->with('goods')
            ->with('seller')
            ->first();
        return view('seller.stocks.invoice', ['order' => $order, 'result' => '']);
    }

    //Excel导出
    //韩京远
    public function getOutput()
    {
        $sellerid = Auth::user()->id;
        $seller = App\Seller::query()->where('user_id',$sellerid)->first();
        //$session = new Session;
        $cellData = session('site');
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=test.xls");
        header("Content-type:application/vnd.ms-excel;charset=gbk");
        header('Cache-Control: max-age=0');
        $str = "";
        $title = array('特卖产品','地区','品种','材质','规格','钢厂','吨数','单价');
        for ($i = 0;$i < count($title);$i++){
            $str .= iconv("UTF-8", "GBK", "$title[$i]"). "\t";
        }
        $str .= "\n";
        foreach($cellData as $k=>$v){
            if($v['type'] == 9){
                $str .= iconv("UTF-8", "GBK","热卖"). "\t";
            }else{
                $str .= iconv("UTF-8", "GBK",""). "\t";
            }
            $str .= iconv("UTF-8", "GBK",$v['areaName']). "\t";
            $str .= iconv("UTF-8", "GBK",$v['variety']). "\t";
            $str .= iconv("UTF-8", "GBK",$v['material']). "\t";
            $str .= iconv("UTF-8", "GBK",$v['length']."*".$v['thickness']."*".$v['outer_diameter']). "\t";
            $str .= iconv("UTF-8", "GBK",$seller['name']). "\t";
            $str .= iconv("UTF-8", "GBK",$v['stock']). "\t";
            $str .= iconv("UTF-8", "GBK",$v['price']). "\t";
            $str .= "\n";
        }
        echo $str;
        die();
    }

    public function getFile()
    {
//        if ($_FILES["file"]["size"] < 20000)
//        {
        $name = time().'.xlsx';
            if ($_FILES["file"]["error"] > 0)
            {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            }
            else
            {
//                echo "Upload: " . $_FILES["file"]["name"] . "<br />";
//                echo "Type: " . $_FILES["file"]["type"] . "<br />";
//                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
//                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

                if (file_exists("./upload/" . $name))
                {
                    echo $_FILES["file"]["name"] . " already exists. ";
                }
                else
                {
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                        "./upload/" . $name);
//                    echo "Stored in: " . "./upload/" . $_FILES["file"]["name"];
                }
            }
//        }
//        else
//        {
//            echo "Invalid file";
//        }
            $new = $this->format_excel2array('./upload/'.$name);
       //dd($new);
            foreach ($new as $v)
            {
                //dd($v['A']);
                $db_goods = new App\Goods();
               // $db_area = new App\Areas();
                $db_goods->seller_id = Auth::user()->id;
                if($v['A'] =="热卖")
                {
                    $db_goods->type = 9;
                }else{
                    $db_goods->type = 0;
                }
                      //0.现货
                $db_goods->name = $v['B'];
                $db_goods->detail = $v['C'];
                $db_goods->price = $v['D'];
                $db_goods->unit = $v['E'];
                $db_goods->stock = $v['F'];
                $province = DB::table('areas')->where('areaName',$v['G'])->first();
               // dd( $province->areaId);
                if($province)
                {
                    $db_goods->province = $province->areaId;
                }else{
                    return "省错误！";
                }
                $province1 = DB::table('areas')->where('areaName',$v['H'])->first();
                if($province1)
                {
                    $db_goods->area_code = $province->areaId;
                }else{
                    return "市错误！";
                }
                $db_goods->variety = $v['I'];
                $db_goods->standard = $v['J'];
                $db_goods->material = $v['K'];
                $db_goods->steelmill = $v['L'];
                $db_goods->outer_diameter = $v['M'];
                $db_goods->thickness = $v['N'];
                $db_goods->length = $v['O'];
                $db_goods->save();
            }

                if ($db_goods->save()){
                    return "成功上传";
                }else{
                    return "网络错误！";
                }

    }

    public function getImport()
    {
        if ($_FILES["file"]["type"] == "excel/xlsx")
        {
            $name = time().'.xlsx';
            if ($_FILES["file"]["error"] > 0)
            {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            }
            else
            {
                echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                echo "Type: " . $_FILES["file"]["type"] . "<br />";
                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

                if (file_exists("upload/" . $_FILES["file"]["name"]))
                {
//                    echo $_FILES["file"]["name"] . " already exists. ";
                }
                else
                {
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                        "upload/" . $_FILES["file"]["name"]);
//                    echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
                }
            }
        }
        else
        {
            echo "文件格式不正确！";
        }
    }

    /*
    * 将excel转换为数组 by aibhsc
    * */

    function format_excel2array($filePath='',$sheet=0){
        if(empty($filePath) or !file_exists($filePath)){die('file not exists');}
        $PHPReader = new \PHPExcel_Reader_Excel2007();        //建立reader对象
        if(!$PHPReader->canRead($filePath)){
            $PHPReader = new \PHPExcel_Reader_Excel5();
            if(!$PHPReader->canRead($filePath)){
                echo 'no Excel';
                return ;
            }
        }
        $PHPExcel = $PHPReader->load($filePath);        //建立excel对象
        $currentSheet = $PHPExcel->getSheet($sheet);        //**读取excel文件中的指定工作表*/
        $allColumn = $currentSheet->getHighestColumn();        //**取得最大的列号*/
        $allRow = $currentSheet->getHighestRow();        //**取得一共有多少行*/
        $data = array();
        for($rowIndex=2;$rowIndex<=$allRow;$rowIndex++){        //循环读取每个单元格的内容。注意行从1开始，列从A开始
            for($colIndex='A';$colIndex<=$allColumn;$colIndex++){
                $addr = $colIndex.$rowIndex;
                $cell = $currentSheet->getCell($addr)->getValue();
                if($cell instanceof PHPExcel_RichText){ //富文本转换字符串
                    $cell = $cell->__toString();
                }
                $data[$rowIndex][$colIndex] = $cell;
            }
        }
        return $data;
    }



    public function read($filename,$encode='utf-8'){
        include_once('./Excel/PHPExcel.php');

        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($filename);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $excelData = array();
        for ($row = 1; $row <= $highestRow; $row++) {
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                $excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
        }
        return $excelData;
    }

}