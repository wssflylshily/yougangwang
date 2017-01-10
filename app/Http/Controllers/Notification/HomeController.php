<?php
/**
 * 消息中心
 * 孙璠
 * 2017.1.4
 */
namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Exception;
use App;
use Auth;
use Request;
use Validator;
use Session;

class HomeController extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getIndex()
    {
        $db = App\Notification::query();
        $rs = $db
            ->where('notifications.user_id', Auth::user()->id)
            ->where('notifications.status', 1)
            ->leftJoin('sellers', 'sellers.id', '=', 'notifications.from_id')
            ->orderBy('notifications.created_at', 'asc')
            ->select('*','notifications.id as nid')
            ->get();
        return json_encode($rs);
    }

    //标记为已读
    public function read($id)
    {
        $db = App\Notification::query();
        $rs = $db->where('id', $id)->update(['status'=> '-1']);
        return redirect(route('user.home'));
    }
}
