<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Links;
use App\Helpers\BaseResponse;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Links::all();
        return BaseResponse::success($links, 'Links retrieved successfully');
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
        ]);

        return BaseResponse::success($link, 'Link created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $link = Links::find($id);

        if (!$link) {
            return BaseResponse::notFound('Link not found');
        }

        $link->increment('views');
        return BaseResponse::success($link, 'Link retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'short_url' => 'required',
            'original_url' => 'required|url',
            'user_id' => 'required|exists:users,id'
        ]);

        $link = Links::find($id);

        if (!$link) {
            return BaseResponse::notFound('Link not found');
        }

        $link->update([
            'short_url' => $request->short_url,
            'original_url' => $request->original_url,
            'user_id' => $request->user_id,
        ]);

        return BaseResponse::success($link, 'Link updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $link = Links::find($id);

        if (!$link) {
            return BaseResponse::notFound('Link not found');
        }

        $link->delete();
        return BaseResponse::success(null, 'Link deleted successfully');
    }
}
