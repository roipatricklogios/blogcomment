<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'tbl_comment';
    protected $fillable = [
        'parent_comment_id', 'comment', 'comment_sender_name'
    ];
}
