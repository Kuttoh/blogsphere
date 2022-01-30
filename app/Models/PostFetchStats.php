<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostFetchStats extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'post_fetch_stats';

    protected $guarded = ['id'];
}
