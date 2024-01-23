<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeImpression extends Model
{
    public $timestamps = false;

    protected $table = 'coffee_impressions';
    use HasFactory;

    protected $guarded = [
        'id'
    ];
}
