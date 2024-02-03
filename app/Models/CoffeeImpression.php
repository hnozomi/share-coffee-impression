<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoffeeImpression extends Model
{
    public $timestamps = false;

    protected $table = 'coffee_impressions';
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class, 'coffeeImpressionId')->whereNull('parentId');
    }

}
