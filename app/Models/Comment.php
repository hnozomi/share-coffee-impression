<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;

    protected $table = 'comments';
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function coffee_impression()
    {
        return $this->belongsTo(CoffeeImpression::class, 'coffeeImpressionId');
    }

    // 子コメントへのリレーション
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parentId');
    }

    // 親コメントへのリレーション
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parentId');
    }
}
