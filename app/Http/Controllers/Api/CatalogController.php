<?php

namespace App\Http\Controllers\Api;

use Statamic\Entries\Entry;
use Illuminate\Http\Request;
use Statamic\Facades\Collection;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    public function index()
    {
        return Collection::all();
    }

    public function show(Request $request, $id)
    {
        $entry = Entry::find($id);

        return response()->json($entry);
    }

    public function store(Request $request)
    {
        $entry = Entry::make()
            ->collection('catalog')
            ->data([
                'title'     => $request->input('title'),
                // 'slug'      => $request->input('slug'),
                'sap_codes'  => $request->input('sap_codes'),
                'categories' => $request->input('categories'),
                'published'  => false,
                'status'     => 'draft'
            ])
            ->save();

        return response()->json(['status'=>'success','message'=> $entry]);
    }
}
