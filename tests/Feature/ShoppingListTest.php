<?php

namespace Tests\Feature;

use App\Models\ShoppingList;
use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class ShoppingListTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test can get all shopping lists.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::factory()->create();
        $shoppingList = ShoppingList::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('Dashboard')
            ->where('lists.0.id', $shoppingList->id));
    }

    /**
     * Test can get a specific list with it's corresponding items.
     *
     * @return void
     */
    public function testGet()
    {
        $user = User::factory()->create();
        $shoppingList = ShoppingList::factory()->create(['user_id' => $user->id]);
        $shoppingList->items()->attach(Item::factory()->create());

        $response = $this->actingAs($user)->get('/lists/' . $shoppingList->id);

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('EditList')
            ->where('list.name', $shoppingList->name)
            ->where('list.items', $shoppingList->items)
            ->where('list.items.0.id', $shoppingList->items->first()->id)
        );
    }
}