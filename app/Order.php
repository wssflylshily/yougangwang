<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    // 关系
    public function goods()
    {
        return $this->hasMany('App\OrderGoods');
    }

    public function seller()
    {
        return $this->belongsTo('App\Seller');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function contract()
    {
        return $this->hasOne('App\Contract');
    }

    //关联期货详细表
    public function futures()
    {
    	return $this->hasMany('App\OrderFutures');
    }
    //关联期货报价表
    public function offers()
    {
    	return $this->hasMany('App\FutureOffers');
    }

    //报价商家数
    public function offers_cnt()
    {
    	return FutureOffers::where('order_id', $this->id)->lists('seller_id')->unique()->count();
    }

    //物流
    public function logistics()
    {
        return $this->hasMany('App\Logistics');
    }
}
