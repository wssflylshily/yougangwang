<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/12
 * Time: 18:49
 */
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Exception;
use App;
use Auth;
use Request;
use Validator;
use Session;
class GetloginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getNewLogin']);
    }

    public function getNewLogin()
    {
        Auth::logout();
        return redirect(route('shop.home'));
    }
}