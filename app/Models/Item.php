<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShoppingList;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'found',
        'price'
    ];

    public function shoppingLists()
    {
        return $this->belongsToMany(ShoppingList::class, 'list_items')->withTimestamps();
    } 
}
