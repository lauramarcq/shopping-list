<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Http\Requests\ItemCreateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ShoppingListController extends Controller
{
    /**
     * Get all lists.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Dashboard', [
            'lists' => ShoppingList::query()
                ->where('user_id', auth()->id())
                ->get()
        ]);
    }

    /**
     * Get a specific list with corresponding items.
     */
    public function get(Request $request): Response
    {
        return Inertia::render('EditList', [
            'list' => ShoppingList::query()
                ->where('user_id', auth()->id())
                ->where('id', $request->listId)
                ->with('items')
                ->first()
        ]);
    }

    /**
     * Add an item to specific list.
     */
    public function create(ItemCreateRequest $request): RedirectResponse
    {
      
        try {
            $item = $request->validated();

            $itemInstance = Item::create($item);
            $itemInstance->shoppingLists()->attach(auth()->id(), ['shopping_list_id' => $request->listId]);
    
            return Redirect::route('lists.get', ['listId' => $request->listId]);
            
        } catch (\Exception $e) {
            Log::error('Error in ShoppingListController@create: ' . $e->getMessage());
            throw $e;
        }
    }

}
