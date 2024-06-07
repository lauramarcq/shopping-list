<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

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
                ->get()
        ]);
    }

}
