<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/7
 * Time: 11:19
 */
namespace App\Http\Controllers\Shop;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Request;
use Validator;
use DB;
class AffairController extends Controller
{
    public  function index()
    {
        $db = App\Order::query();
        $rs = $db
            ->where(function ($query) {
                $query->where('seller_id', '=', Auth::user()->id);
                $query->orWhere('user_id', '=', Auth::user()->id);
            })
            ->whereBetween('status', [3, 99])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('shop.affair.index', ['rs'=>$rs]);
    }
}