<?php

namespace App\Http\Controllers;

use App\Models\acount;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AcountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $acount = acount::query();
        $acount->when($request->search, function ($query) use ($request) {
            return $query
                ->where('description', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%');
        });

        return view('cash.acount.index', [
            'title' => 'Acount',
            'datas' => $acount
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
        return view('cash.acount.create', [
            'title' => 'Create Acount',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:acounts',
            'slug' => 'required|unique:acounts',
            'description' => 'required',
            'state' => 'required',
        ]);

        acount::create($validateData);

        return redirect('/cash/acount')->with(
            'success',
            'Data Has Been added.!!'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(acount $acount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(acount $acount)
    {
        return view('cash.acount.edit', [
            'title' => 'edit Acount',
            'data' => $acount,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, acount $acount)
    {
        $rules = [
            'description' => 'required',
            'state' => 'required',
        ];

        if ($request->name != $acount->name) {
            $rules['name'] = 'required|unique:acounts';
        }
        if ($request->slug != $acount->slug) {
            $rules['slug'] = 'required|unique:acounts';
        }

        $validateData = $request->validate($rules);

        acount::where('id', $acount->id)->update($validateData);

        return redirect('cash/acount')->with(
            'success',
            'Data Has Been Updated'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(acount $acount)
    {
        $acount->destroy($acount->id);

        return redirect('cash/acount')->with(
            'success',
            'Data has Been Deleted.'
        );
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(acount::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
