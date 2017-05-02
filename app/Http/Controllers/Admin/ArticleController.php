<?php

/**
 * 文章管理
 * 孙璠
 * 2017.1.11
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Request;
use Validator;
use App;
use Illuminate\Support\Facades\DB;
use Exception;

class ArticleController extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getIndex($type)
    {
        $request= Request();
        /*dd($type);
        $type = $request->type;*/

       /* $result['article_list'] = \App\Goods::withTrashed()->orderBy('id', 'desc')->paginate(20);
        return view('admin.article.article_list', $result);
        return view('admin.article.article_list');*/
        /*$result['contract_list'] = \App\Contract::withTrashed()->orderBy('id', 'desc')->paginate(10);
       /*dd($result);exit;*/
        //return view('admin.contract.contract_list', $result);
        $query = App\Article::query();
        /*dd($query);*/
        if($type){
            $query->where('type','=',"$type");
        }
        if (!empty(Request::query())){
            //文章标题
            if (Request::input('title'))
            {
                $query->where('title','like',"%".Request::input('title')."%");
            }
            //文章内容
            if (Request::input('content'))
            {
                $query->where('content','like',"%".Request::input('content')."%");
            }
        }

        $article['article_list'] = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        /*dd($article);*/
        return view('admin.article.article_list', $article,['type'=>$type]);
    }

    public function getEdit($id){
        $request = Request();
        $query = App\Article::query();
        if($id){
            //获取当前文章的信息
            $article_info = $query->where('id',$id)->first();
            /*dd($article_info);*/
            return view('admin.article.article_edit',['info'=>$article_info,'id'=>$id]);
        }else{
            return view('admin.article.article_edit');
        }

    }

    //添加文章操作
    public function postEdit(){
        $id = Request::input('id');
        $response = [
            'result'    => true,
            'message'   => '保存成功,正在跳转...',
            'go_url' => "/admin/article/edit/".$id,
        ];
        try {

            $validator = Validator::make(Request::all(), [
                'title'     => 'required',
                'content'  => 'required',
                'published_at' => 'required',
                'type'=>'required'
            ], [
                'title.required' => '文章标题不能为空',
                'content.required' => '文章内容不能为空',
                'published_at.required' => '发布时间不能为空',
                'type.required' => '数据异常,请返回重试',
            ]);

            if ($validator->fails())
            {
                throw new Exception($validator->errors()->first());
            }

            $query = new \App\Article();
            $new_article = $query::find($id);
            $new_article->title     = Request::input('title');
            $new_article->content    = Request::input('content');
            $new_article->type    = Request::input('type');
            $new_article->published_at    = Request::input('published_at');
            $new_article->is_show    = Request::input('is_show');

            $new_article->save();

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;


    }

    //添加文章页面
    public function getAdd($type){
        /*dd($type);*/

        return view('admin.article.article_add',['type'=>$type]);
    }

    //添加文章操作
    public function postAdd(){
        $type = Request::input('type');
        $response = [
            'result'    => true,
            'message'   => '保存成功,正在跳转...',
            /*'go_url' => "{{ route('admin.article.list',['type'=>1]) }}",*/
            'go_url' => "/admin/article/index/".$type,
        ];
        try {

            $validator = Validator::make(Request::all(), [
                'title'     => 'required',
                'content'  => 'required',
                'published_at' => 'required',
                'type'=>'required'
            ], [
                'title.required' => '文章标题不能为空',
                'content.required' => '文章内容不能为空',
                'published_at.required' => '发布时间不能为空',
                'type.required' => '数据异常,请返回重试',
            ]);

            if ($validator->fails())
            {
                throw new Exception($validator->errors()->first());
            }

            $new_article = new \App\Article();

            $new_article->title     = Request::input('title');
            $new_article->content    = Request::input('content');
            $new_article->type    = Request::input('type');
            $new_article->published_at    = Request::input('published_at');
            $new_article->is_show    = Request::input('is_show');
            /*$new_article->password = bcrypt(Request::input('password'));*/

            $new_article->save();

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;


    }

    //删除文章
    public function postDel(){
        $response = [
            'result'    => true,
            'message'   => '删除成功',
        ];

        try {

            \App\article::destroy(Request::input('article_ids'));

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    //启用文章
    public function postStart(){
        $response = [
            'result'    => true,
            'message'   => '启用成功',
        ];
        try {
            App\article::whereIn('id', Request::input('article_ids'))
                ->update(['is_show' => 1]);
        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }


    //启用文章
    public function postForbid(){
        $response = [
            'result'    => true,
            'message'   => '禁用成功',
        ];
        try {
            App\article::whereIn('id', Request::input('article_ids'))
                ->update(['is_show' => 0]);
            /*DB::table('articles')->whereIn('id', Request::input('article_ids'))
                ->update(['is_show' => -1]);*/
        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

}
