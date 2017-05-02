<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use App;
use Auth;
use Request;
use Validator;
use Session;

class CommonController extends Controller
{
    public function getIndex()
    {
        //Auth::user()->id
        $db_admin = App\User::query();
        $db_role_menu = App\RoleMenu::query();
        $admin = $db_admin->where('id', Auth::user()->id)->first();
        $role_menu = $db_role_menu
            ->leftJoin('menus', 'menus.id', '=', 'role_menus.menu_id')
            ->where('role_id', $admin->role_id )
            ->where('parent_id', '-1')
            ->get();

        for ($i=0;$i<count($role_menu);$i++)
        {
            $role_menu[$i]['menu'] = App\RoleMenu::query()
                ->leftJoin('menus', 'menus.id', '=', 'role_menus.menu_id')
                ->where('role_id', $admin->role_id )
                ->where('parent_id', $role_menu[$i]->id)
                ->get();
        }

        return json_encode($role_menu);
    }

}
