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
            ->where('list.0.name', $shoppingList->name)
            ->where('list.0.items', $shoppingList->items)
            ->where('list.0.items.0.id', $shoppingList->items->first()->id)
        );
    }

    /**
     * Test can create an item and attach it to a list.
     *
     * @return void
     */
    public function testCreate()
    {
        $user = User::factory()->create();
        $shoppingList = ShoppingList::factory()->create(['user_id' => $user->id]);
        $item = Item::factory()->make();
        
        $response = $this->actingAs($user)->post('/lists/' . $shoppingList->id . '/item/create', [
            'name' => $item->name,
            'price' => $item->price,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/lists/' . $shoppingList->id);
            
            $this->assertDatabaseHas('items', [
                'name' => $item->name,
                'price' => $item->price,
            ]);
    
            $this->assertDatabaseHas('list_items', [
                'item_id' => Item::where('name', $item->name)->first()->id,
                'shopping_list_id' => $shoppingList->id,
            ]);
    }

    /**
     * Test can delete an item from a list.
     *
     * @return void
     */
    public function testDelete()
    {
        $user = User::factory()->create();
        $shoppingList = ShoppingList::factory()->create(['user_id' => $user->id]);
        $item = Item::factory()->create();
        $shoppingList->items()->attach($item);

        $response = $this->actingAs($user)->delete('/lists/' . $shoppingList->id . '/' . $item->id . '/delete');

        $response->assertStatus(302);
        $response->assertRedirect('/lists/' . $shoppingList->id);
            
            $this->assertDatabaseMissing('items', [
                'id' => $item->id,
            ]);
    
            $this->assertDatabaseMissing('list_items', [
                'item_id' => $item->id,
                'shopping_list_id' => $shoppingList->id,
            ]);
    }
}