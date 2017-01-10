<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Logistics extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'logistics';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $fillable = ['message', 'order_id'];


}
