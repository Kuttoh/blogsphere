<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes, ClearsResponseCache;

    protected $table = 'blog_posts';

    protected $fillable = [
        'title',
        'description',
        'publication_date',
        'author_id'
    ];

    protected $casts = ['publication_date' => 'datetime'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
