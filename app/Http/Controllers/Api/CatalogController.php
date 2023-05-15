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
            '*.title'       => 'required',
            '*.sap_code'    => 'required',
            '*.product_url' => 'required',
            '*.price'       => 'required',
        ]);
        
        $entries = [];
        
        foreach ($validatedData as $product) {
            $entry = Entry::make()
                ->collection('catalog')
                ->data([
                    'title'       => $product['title'],
                    'sap_codes'   => $product['sap_code'],
                    'categories'  => $request->input('category'),
                    'product_url' => $product['product_url'],
                    'price'       => $product['price'],
                    'published'   => false,
                    'status'      => 'draft'
                ])
                ->save();
                
            $entries[] = $entry;
        }
            
        return response()->json(['status'=>'success','message'=> $entries]);
    }
    
}
