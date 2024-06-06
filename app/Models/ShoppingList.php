<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item;

class ShoppingList extends Model
{
    use HasFactory;

    protected $fillable = [
        'list_name',
        'created_at',
        'updated_at'
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'list_items')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
