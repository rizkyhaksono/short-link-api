<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Links;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Links::where('short_url', request('short_url'))->increment('views');

        $links = Links::all();
        return response()->json($links);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'short_url' => 'required',
            'original_url' => 'required|url',
            'user_id' => 'required|exists:users,id'
        ]);

        $link = Links::create([
            'short_url' => $request->short_url,
            'original_url' => $request->original_url,
            'user_id' => $request->user_id,
            'views' => 0
        ]);
        return response()->json($link, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Links::where('short_url', $id)->increment('views');

        $link = Links::where('short_url', $id)->first();
        return response()->json($link, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $link = Links::where('short_url', $id)->first();
        $link->update($request->all());
        return response()->json($link, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Links::where('short_url', $id)->delete();
        return response()->json(null, 204);
    }
}
