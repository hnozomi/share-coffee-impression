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


    public function fetchAllCoffeeImpression()
    {
        return $this->with('user')->get();
    }

    public function fetchOnlyCoffeeImpression($id)
    {
        return $this->with('comments.replies')->find($id);
    }

    public function addCoffeeImpressions($validatedData)
    {
        $coffee_impression = $this->create([
            'userId' => $validatedData['userId'],
            'coffeeName' => $validatedData['coffeeName'],
            'purchaseDate' => $validatedData['purchaseDate'],
            'price' => $validatedData['price'],
            'place' => $validatedData['place'],
            'rate' => $validatedData['rate'],
            'scent' => $validatedData['scent'],
            'acidity' => $validatedData['acidity'],
            'bitter' => $validatedData['bitter'],
            'rich' => $validatedData['rich'],
            'taste' => $validatedData['taste'],
        ]);

            return $coffee_impression;
    }

    public function updateCoffeeImpression($id, $validatedData)
    {
        $coffee_impression = $this->findOrFail($id);

        $coffee_impression->update($validatedData);

        return $coffee_impression;
    }

    public function deleteCoffeeImpression($id, $validatedData)
    {
        $coffee_impression = $this->findOrFail($id);

        $coffee_impression->delete($validatedData);

        return $coffee_impression;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class, 'coffeeImpressionId')->whereNull('parentId');
    }

}
