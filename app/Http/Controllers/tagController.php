<?php

namespace App\Http\Controllers;

use App\Models\tag;
use Illuminate\Http\Request;

class tagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tag = tag::query();
        $tag->when($request->search, function ($query) use ($request) {
            return $query
                ->where('description', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%');
        });

        return view('cash.tag.index', [
            'title' => 'Tags',
            'datas' => $tag
                ->latest()
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tag $tag)
    {
        //
    }
}
