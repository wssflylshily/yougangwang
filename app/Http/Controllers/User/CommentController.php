<?php

/**
 * HomeController constructor.
 * 取消订单列表
 * 孙璠
 * 2016.12.21
 */

namespace App\Http\Controllers\User;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Request;
use Validator;

class CommentController extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'getLogo   ut']);
    }


    protected function getIndex()
    {
        //订单信息
        $db_orders = App\Comments::query();
        $rs =$db_orders
            ->with('order')
            ->paginate(8);
        return view('user.comment.index', ['rs' => $rs]);

    }



}
