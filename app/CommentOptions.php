<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentOptions extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comment_options';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}
