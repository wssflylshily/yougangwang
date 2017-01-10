<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sellers';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    // 关系
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function stocks()
    {
        return $this->hasMany('App\Goods');
    }

//    public function cart_goods()
//    {
//        return $this->hasMany('App\CartGoods')->has('ori')->orderBy('created_at', 'desc');
//    }

//    public function futures()
//    {
//        return $this->hasMany('App\Future');
//    }
//
//    public function contracts()
//    {
//        return $this->hasMany('App\Contract');
//    }
}
