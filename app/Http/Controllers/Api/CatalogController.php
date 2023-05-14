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
        $validatedData = $request->validate([
            'category'  => 'required',
            'name'      => 'required',
            'sap_codes' => 'required|array'
        ]);
    
        foreach ($validatedData['sap_codes'] as $sap_code) {
            if(!empty($sap_code)) {
                $entry = Entry::make()
                ->collection('catalog')
                ->data([
                    'title'      => $validatedData['name'],
                    'sap_codes'  => $sap_code,
                    'categories' => $validatedData['category'],
                    'published'  => false,
                    'status'     => 'draft'
                ])
                ->save();
            }
        }
    
        return response()->json(['status'=>'success','message'=> $entry]);
    }
}
