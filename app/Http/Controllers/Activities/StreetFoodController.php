<?php

namespace App\Http\Controllers\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StreetFood;

class StreetFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $streetFoods = StreetFood::all();
        return view('activities.streetfood.index', compact('streetFoods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activities.streetfood.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'food_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        StreetFood::create($validated);

        return redirect()->route('streetfood.index')->with('success', 'Street food item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $streetFood = StreetFood::findOrFail($id);
        return view('activities.streetfood.show', compact('streetFood'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $streetFood = StreetFood::findOrFail($id);
        return view('activities.streetfood.edit', compact('streetFood'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'food_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $streetfood = StreetFood::findOrFail($id);
        $streetfood->update($validated);

        return redirect()->route('streetfood.index')->with('success', 'Street food item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $streetfood = StreetFood::findOrFail($id);
        $streetfood->delete();

        return redirect()->route('streetfood.index')->with('success', 'Street food item deleted successfully.');
    }
}