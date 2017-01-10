<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// 身份认证（登录，注册，密码找回，重置）
Route::group(['prefix' => config('const.auth_prefix', ''), 'namespace' => 'Auth'], function () {
    Route::get('/login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);
    Route::post('/login', ['as' => 'auth.login.post', 'uses' => 'AuthController@postLogin']);
    Route::get('/register', ['as' => 'auth.register', 'uses' => 'AuthController@getRegister']);
    Route::post('/register', ['as' => 'auth.register.post', 'uses' => 'AuthController@postRegister']);
    Route::get('/logout', ['as' => 'auth.logout', 'uses' => 'AuthController@getLogout']);

    Route::controller('/password', 'PasswordController', [
        'getFind'   => 'auth.password.find',
        'postFind'  => 'auth.password.find.post',
    ]);
});


// 商城前台
Route::group(['prefix' => config('const.shop_prefix', ''), 'namespace' => 'Shop'], function () {
    Route::get('/', ['as' => 'shop.home', 'uses' => 'HomeController@getIndex']);

    Route::get('/stocks', ['as' => 'shop.stocks', 'uses' => 'StocksController@getIndex']);				//现货列表
    Route::get('/special', ['as' => 'shop.special', 'uses' => 'StocksController@getSpecial']);			//特卖列表
   	Route::get('/special/detail/', ['as' => 'shop.special.detail', 'uses' => 'StocksController@getDetail']);		//特卖商品详情
    Route::get('/futures', ['as' => 'shop.futures', 'uses' => 'FuturesController@getIndex']);			//期货列表
    Route::get('/futures/detail/{order_id}', ['as' => 'shop.futures.detail', 'uses' => 'FuturesController@getDetail']);	//期货详情
    Route::post('/futures/addOffer', ['as' => 'shop.futures.addOffer', 'uses' => 'FuturesController@postOffer']);	//期货详情
    Route::get('/futures/publish', ['as' => 'shop.futures.publish', 'uses' => 'FuturesController@publish']);		//发布期货
    Route::post('/futures/addFuture', ['as' => 'shop.futures.addFuture', 'uses' => 'FuturesController@postFuture']);		//发布期货提交期货信息
    Route::get('/futures/publish2', ['as' => 'shop.futures.publish2', 'uses' => 'FuturesController@publishtwo']);	//发布期货第二步
    Route::post('/futures/addFutureDetail', ['as' => 'shop.futures.addDetail', 'uses' => 'FuturesController@addFutureDetail']);	//发布期货第二步,添加期货详细
    Route::post('/futures/addFutureOrder', ['as' => 'shop.futures.addFutureOrder', 'uses' => 'FuturesController@postFutureOrder']);	//确认发布期货
    Route::get('/futures/signContract', ['as' => 'shop.futures.signContract', 'uses' => 'FuturesController@signContract']);	//签订合同
    Route::get('/futures/payOrder', ['as' => 'shop.futures.payOrder', 'uses' => 'FuturesController@payOrder']);	//签订合同
    Route::get('/futures/produce', ['as' => 'shop.futures.produce', 'uses' => 'FuturesController@produce']);	//生产
    Route::get('/futures/logistic/{order_id}', ['as' => 'shop.futures.logistic', 'uses' => 'FuturesController@getLogistic']);	//物流查询
    Route::get('/futures/receipt', ['as' => 'shop.futures.receipt', 'uses' => 'FuturesController@receipt']);	//收货
    Route::get('/futures/invoive', ['as' => 'shop.futures.invoive', 'uses' => 'FuturesController@invoive']);	//发票处理
    Route::get('/futures/complete', ['as' => 'shop.futures.complete', 'uses' => 'FuturesController@complete']);	//交易完成
    Route::get('/futures/getCities', ['as' => 'shop.futures.getCities', 'uses' => 'FuturesController@getCitiesByAreaId']);	//根据地区编号查找城市
    Route::get('/city', ['as' => 'shop.area.city', 'uses' => 'StocksController@getCities']);

    // 已登录才能访问
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/cart', ['as' => 'shop.cart', 'uses' => 'CartController@getIndex']);				//购物车
        Route::post('/cart/count', ['as' => 'shop.cart.count.post', 'uses' => 'CartController@postCount']);			//统计购物车
        Route::post('/cart/add', ['as' => 'shop.cart.add.post', 'uses' => 'CartController@postAdd']);				//添加购物车
        Route::post('/cart/delete', ['as' => 'shop.cart.delete.post', 'uses' => 'CartController@postDelete']);				//删除购物车

        Route::post('/order/checkout', ['as' => 'shop.order.checkout.post', 'uses' => 'OrderController@postCheckout']);		//结算购物车
        Route::post('/order/pay', ['as' => 'shop.order.pay.post', 'uses' => 'OrderController@postPay']);		//结算购物车
        Route::post('/order/check-now', ['as' => 'shop.order.checknow.post', 'uses' => 'OrderController@postCheckNow']);		//立即支付
        Route::post('/order/pay-now', ['as' => 'shop.order.paynow.post', 'uses' => 'OrderController@postPayNow']);		//立即支付--提交订单

//        Route::get('/contract/sign/{sn?}', ['as' => 'shop.contract.sign', 'uses' => 'ContractController@getSign']);
//        Route::post('/contract/sign/{sn}', ['as' => 'shop.contract.sign.post', 'uses' => 'ContractController@postSign']);
    });
});


// 管理后台
Route::group(['prefix' => config('const.admin_prefix', 'admin'), 'namespace' => 'Admin'], function () {
    Route::get('/login', ['as' => 'admin.login', 'uses' => 'AuthController@getLogin']);
    Route::post('/login', ['as' => 'admin.login.post', 'uses' => 'AuthController@postLogin']);
    Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'AuthController@getLogout']);

    // 已登录后台才能访问
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/', ['as' => 'admin.home', 'uses' => 'HomeController@getIndex']);

        Route::controller('/user', 'UserController', [
            'getIndex' => 'admin.user.index',
            'getAdd' => 'admin.user.add',
            'getEdit' => 'admin.user.edit',
            'postAdd' => 'admin.user.add.post',
        ]);
        //卖家
        Route::controller('/seller', 'SellerController', [
            'getIndex' => 'admin.seller.index',
            'getAdd' => 'admin.seller.add',
            'getEdit' => 'admin.seller.edit',
            'postAdd' => 'admin.seller.add.post',
        ]);
        //现货
        Route::controller('/stock', 'StockController', [
            'getIndex' => 'admin.stock.index',
            'getAdd' => 'admin.stock.add',
            'getEdit' => 'admin.stock.edit',
            'postAdd' => 'admin.stock.add.post',
            'getCities' => 'admin.future.getcities',
        ]);
        //期货
        Route::controller('/future', 'FutureController', [
            'getIndex' => 'admin.future.index',
            'getAdd' => 'admin.future.add',
            'getEdit' => 'admin.future.edit',
            'postAdd' => 'admin.future.add.post',
            'getCities' => 'admin.future.getcities',
        ]);
        //特卖
        Route::controller('/hot', 'HotController', [
            'getIndex' => 'admin.hot.index',
            'getAdd' => 'admin.hot.add',
            'getEdit' => 'admin.hot.edit',
            'postAdd' => 'admin.hot.add.post',
        ]);

        //订单
        Route::controller('/order', 'OrderController', [
            'getIndex' => 'admin.order.index',
            'getFuture' => 'admin.order.future',
            'getAdd' => 'admin.order.add',
            'getEdit' => 'admin.order.edit',
            'postAdd' => 'admin.order.add.post',
        ]);

        //合同
        Route::controller('/contract', 'ContractController', [
            'getIndex' => 'admin.stock.index',
            'getAdd' => 'admin.stock.add',
            'getEdit' => 'admin.stock.edit',
            'postAdd' => 'admin.stock.add.post',

        ]);
        //banner
        //合同
        Route::controller('/banner', 'BannerController', [
            'getIndex' => 'admin.banner.index',
            'getAdd' => 'admin.banner.add',
            'getEdit' => 'admin.banner.edit',
            'postAdd' => 'admin.banner.add.post',

        ]);
    });
});


// 用户中心
Route::group(['prefix' => config('const.user_prefix', 'user'), 'namespace' => 'User', 'middleware' => 'auth'], function () {
    Route::get('/', ['as' => 'user.home', 'uses' => 'HomeController@getIndex']);//首页
    Route::get('/home-futures', ['as' => 'user.home-futures', 'uses' => 'HomeController@getIndexFutures']);//首页期货

    Route::get('/stocks', ['as' => 'user.stocks', 'uses' => 'StocksController@getStocks']);//现货
    Route::get('/stocks-history', ['as' => 'user.stocks-history', 'uses' => 'StocksController@getStocksHistory']);//现货历史
    Route::get('/pay', ['as' => 'user.pay', 'uses' => 'StocksController@toPay']);//现货--去支付
    Route::get('/logistic', ['as' => 'user.logistic', 'uses' => 'StocksController@getLogistic']);//现货--查物流
    Route::get('/invoice', ['as' => 'user.invoice', 'uses' => 'StocksController@getInvoice']);//现货--开发票
    Route::post('/invoice', ['as' => 'user.post.invoice', 'uses' => 'StocksController@postInvoice']);//现货--开发票
    Route::get('/stocks/contract', ['as' => 'user.stocks.contract', 'uses' => 'StocksController@signContract']);//现货--签合同
    Route::get('/stocks/completion', ['as' => 'user.stocks.completion', 'uses' => 'StocksController@toCompletion']);//现货--评价
    Route::post('/stocks/comment', ['as' => 'user.stocks.comment.post', 'uses' => 'StocksController@toComment']);//现货--评价
    Route::post('/stocks/contract/sign', ['as' => 'user.stocks.contract.sign.post', 'uses' => 'StocksController@postSignContract']);//现货--签合同

    Route::get('/futures', ['as' => 'user.futures', 'uses' => 'FuturesController@getFutures']);//我的期货
    Route::get('/futures-history', ['as' => 'user.futures-history', 'uses' => 'FuturesController@getFuturesHistory']);//期货历史
    Route::get('/selectSellers/{order_id}/{seller_id}', ['as' => 'user.futures.selectSeller', 'uses' => 'FuturesController@getOfferSellers']);//我的期货
    Route::get('/changeStatus/{order_id}/{status}', ['as' => 'user.futures.changeStatus', 'uses' => 'FuturesController@changeOrderStatus']);//我的期货
    Route::get('/futureInvoice/{order_id}', ['as' => 'user.futures.invoice', 'uses' => 'FuturesController@invoice']);//期货填写发票页面
    Route::post('/addFutureInvoice/', ['as' => 'user.futures.addInvoice', 'uses' => 'FuturesController@postInvoice']);//期货提交发票信息
    Route::get('/futures/takeOrder', ['as' => 'user.futures.takeOrder', 'uses' => 'FuturesController@takeOrder']);	//商家接单
    
    Route::get('/contract', ['as' => 'user.contract', 'uses' => 'ContractController@getContract']);//合同
    Route::get('/contract-already', ['as' => 'user.contract.already', 'uses' => 'ContractController@getContractAlready']);//合同
    Route::get('/contract-history', ['as' => 'user.contract-history', 'uses' => 'ContractController@getContractHistory']);//合同历史

    Route::get('/userinfo', ['as' => 'user.userinfo', 'uses' => 'UserInfoController@getUserInfo']);//个人资料
    Route::get('/address', ['as' => 'user.address', 'uses' => 'UserInfoController@getUserAddress']);//添加收货地址
    Route::post('/address', ['as' => 'user.address', 'uses' => 'UserInfoController@postUserAddress']);//提交添加收货地址
    Route::post('/userinfo',['as'=>'user.userinfo','uses'=>'UserInfoController@postUserInfo']);   // 修改个人资料
    Route::get('/companyinfo',['as'=>'user.companyinfo','uses'=>'UserInfoController@getCompanyInfo']); // 公司资料
    Route::post('/companyinfo',['as'=>'user.companyinfo','uses'=>'UserInfoController@postCompanyInfo']);   // 提交公司资料
    Route::get('/getnextarea', ['as' => 'user.nextarea', 'uses' => 'UserInfoController@getNextarea']);//获取下级地区列表
    Route::get('/getoneaddrinfo', ['as' => 'user.oneaddrinfo', 'uses' => 'UserInfoController@getAddrInfo']);//获取要修改的地址的信息
    Route::get('/deloneaddress', ['as' => 'user.deloneaddr', 'uses' => 'UserInfoController@delAddress']);//删除一个用户收货地址

    Route::get('/setdefaultaddr', ['as' => 'user.setdefaultaddr', 'uses' => 'UserInfoController@setDefaultaddr']);//设置一个地址为默认地址

    Route::get('/stocks-change', ['as' => 'user.stocks.change', 'uses' => 'StocksController@changeStatus']);	//修改订单状态
    Route::get('/order/cancel', ['as' => 'user.order.cancel', 'uses' => 'HomeController@cancelOrder']);	//取消订单



    Route::get('/cancel-order/index', ['as' => 'user.order.cancel.index', 'uses' => 'CancelOrderController@getIndex']);	//取消的订单---现货订单
    Route::get('/cancel-order/futures', ['as' => 'user.order.cancel.futures', 'uses' => 'CancelOrderController@getFutures']);	//取消的订单---期货订单


    Route::get('/comment/index', ['as' => 'user.comment.index', 'uses' => 'CommentController@getIndex']);	//评价



});

// 消息中心
Route::group(['prefix' => config('const.notification_prefix', 'Notification'), 'namespace' => 'Notification', 'middleware' => 'auth'], function () {
    Route::get('/index', ['as' => 'notification.index', 'uses' => 'HomeController@getIndex']);
    Route::get('/read/{id}', ['as' => 'notification.read', 'uses' => 'HomeController@read']);
});


// 商铺中心
Route::group(['prefix' => config('const.seller_prefix', 'seller'), 'namespace' => 'Seller', 'middleware' => 'seller.auth'], function () {
    Route::get('/', ['as' => 'seller.home', 'uses' => 'HomeController@getIndex']);
    Route::get('/sellerinfo', ['as' => 'seller.sellerinfo', 'uses' => 'SellerInfoController@getSellerInfo']);  // 公司信息
    Route::post('/sellerinfo',['as' =>'seller.sellerinfo.post','uses' =>'SellerInfoController@postSellerInfo']);    // 保存公司信息
    Route::get('/contract', ['as' => 'seller.contract.home', 'uses' => 'HomeController@getMyContract']);			//我的合同--未签约
    Route::get('/contract-already', ['as' => 'seller.contract.already', 'uses' => 'HomeController@getContractAlready']);			//我的合同--已签约
    Route::get('/futures', ['as' => 'seller.futures', 'uses' => 'FuturesController@getIndex']);		//我的期货
    Route::get('/futuresList', ['as' => 'seller.futuresList', 'uses' => 'FuturesController@getFutures']);	//期货询单
    Route::get('/futuresDetail/{order_id}', ['as' => 'seller.futures.detail', 'uses' => 'FuturesController@getDetail']);	//期货详情
    Route::get('/futuresOffer', ['as' => 'seller.futures.offer', 'uses' => 'FuturesController@getOfferFutures']);//期货报单
    Route::get('/futuresOrders', ['as' => 'seller.futures.orders', 'uses' => 'FuturesController@getOrders']);	//期货订单列表
    Route::get('/futuresLogistics/{order_id}', ['as' => 'seller.futures.logistics', 'uses' => 'FuturesController@getLogistics']);	//期货订单物流信息
    Route::post('/addFuturesLogistics', ['as' => 'seller.futures.addLogistics', 'uses' => 'FuturesController@postLogistics']);	//提交期货订单物流信息
    Route::get('/changeStatus/{order_id}/{status}', ['as' => 'seller.futures.changeStatus', 'uses' => 'FuturesController@changeOrderStatus']);//更改期货状态
    
    Route::get('/stocks /publish',['as'=>'seller.stocks','uses'=>'StocksController@publish']);   // 发布现货
    Route::get('/stocks/stores',['as'=>'seller.stocks.stores','uses'=>'StocksController@mystores']);  // 我的仓库
    Route::get('/stocks/seeStores',['as'=>'seller.stocks.all','uses'=>'StocksController@seeStores']);   // 查看仓库
    Route::post('/stocks/stores/publish',['as'=>'seller.stores.publish','uses'=>'StocksController@publishGoods']);   // 仓库--发布现货
    Route::post('/publish', ['as' => 'seller.publish', 'uses' => 'StocksController@postGoods']);//现货--发布
    Route::post('/republish', ['as' => 'seller.republish', 'uses' => 'StocksController@postRepublish']);//现货--再次发布（修改后）
    Route::get('/stores/tm', ['as' => 'seller.stores.tm', 'uses' => 'StocksController@setTm']);//现货--设置/取消特卖
    Route::get('/stores/delete', ['as' => 'seller.stores.delete', 'uses' => 'StocksController@deleteGoods']);//现货--批量删除
    Route::get('/stores/deleteOne', ['as' => 'seller.stores.deleteOne', 'uses' => 'StocksController@deleteOneGoods']);//现货--删除
    Route::get('/stores/editor', ['as' => 'seller.stores.editor', 'uses' => 'StocksController@editor_stores']);//现货--修改
    Route::get('/stocks/order', ['as' => 'seller.stocks.order', 'uses' => 'StocksController@getOrder']);//现货--订单
    Route::get('/stocksOrders', ['as' => 'seller.stocks.orders', 'uses' => 'StocksController@getOrders']);	//现货订单列表
    Route::get('/stocksLogistics', ['as' => 'seller.stocks.logistics', 'uses' => 'StocksController@getLogistics']);	//现货订单物流信息
    Route::get('/stocks-change', ['as' => 'seller.stocks.change', 'uses' => 'StocksController@changeOrderStatus']);	//修改订单状态
    Route::get('/stocks/logistics', ['as' => 'seller.stocks.logistics', 'uses' => 'StocksController@getLogistics']);	//物流
    Route::post('/stocks/logistics', ['as' => 'seller.stocks.postLogistics', 'uses' => 'StocksController@postLogistics']);	//新增物流
});

// 共通
Route::group(['prefix' => config('const.auth_prefix', 'common'), 'namespace' => 'Common'], function () {
    Route::post('/captcha/sms', ['as' => 'common.captcha.sms.post', 'uses' => 'CaptchaController@postCaptchaSms']);
});
