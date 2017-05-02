<?php
/**
 * 管理员管理
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use App;
use Auth;
use Request;
use Validator;
use Session;
use DB;

class AdminController extends Controller
{

    public function getIndex()
    {
        $db_admin = App\User::query();
        $admins = $db_admin
            //->leftJoin('roles', 'roles.id', '=', 'Users.role_id')
            ->whereNotNull('role_id')
            ->paginate(10);
        return view('admin.admin.index',['admins' => $admins]);
    }

    public function getRole()
    {
        $db_role = App\Role::query();
        $roles = $db_role->paginate(10);
        return view('admin.admin.role', ['roles' => $roles]);
    }

    public function getRoleAdd()
    {
        $role_menu = App\Menu::query()
            ->where('parent_id', '-1')
            ->get();

        for ($i=0;$i<count($role_menu);$i++)
        {
            $role_menu[$i]['menu'] = App\Menu::query()
                ->where('parent_id', $role_menu[$i]->id)
                ->get();
        }
        return view('admin.admin.role_add', ['menus' => $role_menu]);
    }

    public function postRoleAdd()
    {
        $response = [
            'result'    => true,
            'message'   => '添加成功，正在跳转',
        ];

        $new_role = new App\Role();
        $new_role->name = Request::input('name');
        $new_role->detail = Request::input('detail');
        if (!$new_role->save())
        {
            $response = [
                'result'    => false,
                'message'   => '添加失败',
            ];
        }
        foreach (Request::input('menu_id') as $k=>$v)
        {
            $db_menu = App\Menu::query();
            $menu = $db_menu->where('id', $v)->first();

            $new_role_menu = new App\RoleMenu();
            $new_role_menu->role_id = $new_role->id;
            $new_role_menu->menu_id = $v;
            $new_role_menu->save();

            $new_role_menu = new App\RoleMenu();
            if (App\RoleMenu::query()->where('role_id', $new_role->id)->where('menu_id', $menu->parent_id)->first())
            {

            }else{
                $new_role_menu->role_id = $new_role->id;
                $new_role_menu->menu_id = $menu->parent_id;
                $new_role_menu->save();
            }
        }
        return $response;
    }

    public function getRoleEdit($id)
    {
        $role_menu = App\Menu::query()
            ->where('parent_id', '-1')
            ->get();

        for ($i=0;$i<count($role_menu);$i++)
        {
            $role_menu[$i]['menu'] = App\Menu::query()
                ->where('parent_id', $role_menu[$i]->id)
                ->get();
        }

        $role = App\Role::query()->where('id', $id)->first();
        $user_menus = App\RoleMenu::query()->where('role_id', $id)->get();
        return view('admin.admin.role_edit', ['menus' => $role_menu, 'user_menus' => $user_menus, 'role' => $role]);
    }

    public function postRoleEdit()
    {
        $response = [
            'result'    => true,
            'message'   => '修改成功，正在跳转',
        ];

        $new_role = App\Role::query();
        $role = $new_role->where('id', Request::input('id'))->update(['name' => Request::input('name'), 'detail' => Request::input('detail')]);

        $old_menu = App\RoleMenu::query()->where('role_id', Request::input('id'))->delete();

        foreach (Request::input('menu_id') as $k=>$v)
        {
            $db_menu = App\Menu::query();
            $menu = $db_menu->where('id', $v)->first();

            $new_role_menu = new App\RoleMenu();
            $new_role_menu->role_id = Request::input('id');
            $new_role_menu->menu_id = $v;
            $new_role_menu->save();

            $new_role_menu = new App\RoleMenu();
            if (App\RoleMenu::query()->where('role_id', Request::input('id'))->where('menu_id', $menu->parent_id)->first())
            {

            }else{
                $new_role_menu->role_id = Request::input('id');
                $new_role_menu->menu_id = $menu->parent_id;
                $new_role_menu->save();
            }
        }
        return $response;
    }

    public function getAdminAdd()
    {
        $db_role = App\Role::query();
        $roles = $db_role->get();
        return view('admin.admin.add',['roles' => $roles]);
    }

    public function postAdminAdd()
    {
        $response = [
            'result'    => true,
            'message'   => '添加成功，正在跳转',
            //'go_url'    => '{{ route(\'admin.admin.index\') }}',
        ];

        $validator = Validator::make(Request::all(), [
            'name'    => 'required',
            'email'    => 'required',
            'password' => 'required',
            'role_id' => 'required',
        ], [
            'name.required'   => '姓名不能为空!',
            'email.required'   => '邮箱不能为空!',
            'password.required'      => '密码不能为空!',
            'role_id.required'     => '管理员角色不能为空!',
        ]);

        if ($validator->fails()) {
            $response = [
                'result'    => false,
                'message'   => $validator->messages()->first(),
            ];
            return $response;
        }
        $new_user = new App\User();
        $new_user->name = Request::input('name');
        $new_user->email = Request::input('email');
        $new_user->role_id = Request::input('role_id');
        $new_user->password = bcrypt(Request::input('password'));
        $new_user->realname_auth = 0;
        $new_user->user_status = Request::input('state')?Request::input('state'):1;
        if (!$new_user->save())
        {
            $response = [
                'result'    => false,
                'message'   => '添加失败',
            ];
        }
        return $response;
    }

    public function getAdminEdit($id)
    {
        $db_role = App\Role::query();
        $roles = $db_role->get();

        $db_admin = App\User::query();
        $admin = $db_admin->where('id', $id)->first();

        return view('admin.admin.edit',['roles' => $roles, 'admin' => $admin]);
    }

    public function postAdminEdit()
    {
        $response = [
            'result'    => true,
            'message'   => '修改成功，正在跳转',
        ];

        $validator = Validator::make(Request::all(), [
            'name'    => 'required',
            'email'    => 'required',
            'role_id' => 'required',
        ], [
            'name.required'   => '姓名不能为空!',
            'email.required'   => '邮箱不能为空!',
            'role_id.required'     => '管理员角色不能为空!',
        ]);

        if ($validator->fails()) {
            $response = [
                'result'    => false,
                'message'   => $validator->messages()->first(),
            ];
            return $response;
        }
        $new_user = App\User::query();
        $rs = $new_user->where('id', Request::input('id'))->update([
            'name' => Request::input('name'),
            'email' => Request::input('email'),
            'role_id' => Request::input('role_id'),
            'user_status' => Request::input('state'),
        ]);
        if (!$rs)
        {
            $response = [
                'result'    => false,
                'message'   => '添加失败',
            ];
        }
        return $response;
    }

    public function postAdminDelete()
    {
        $response = [
            'result'    => true,
            'message'   => '删除成功',
        ];

        try {

            \App\User::destroy(Request::input('user_id'));

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function postRoleDelete()
    {
        $response = [
            'result'    => true,
            'message'   => '删除成功',
        ];

        try {

            \App\Role::destroy(Request::input('user_id'));

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

}
