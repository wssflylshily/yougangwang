<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderFutures extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_futures';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    //关联期货报价表
    public function offer()
    {
    	return $this->belongsTo('App\FutureOffers');
    }
    
    public function order(){
    	return $this->belongsTo('App\Order');
    }
}
