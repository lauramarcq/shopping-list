<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ShoppingList;
use App\Models\Item;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $sampleUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'secret123'
        ]);

        $shoppingList = ShoppingList::factory(1)->create([
            'name' => 'Test List',
            'user_id' => $sampleUser->id
        ])->first();

        $items = Item::factory(10)->create(
            [
                'bought' => false,
                'price' => 10.00

            ]
        );

        // This so I can attach the items to the shopping list and seed the pivot table
        foreach ($items as $item) {
            $shoppingList->items()->attach($item->id);
        }
    }
}
