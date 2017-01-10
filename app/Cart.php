<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'carts';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    // 关系
    public function seller()
    {
        return $this->belongsTo('App\Seller');
    }

    public function ori()
    {
        return $this->belongsTo('App\Goods', 'goods_id');
    }
}
