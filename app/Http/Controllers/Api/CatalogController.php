<?php

namespace App\Http\Controllers\Api;

use Statamic\Entries\Entry;
use Illuminate\Http\Request;
use Statamic\Facades\Collection;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    /**
     * Display a listing of the Collections.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Collection::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $entry = Entry::find($id);

        return response()->json($entry);
    }

    /**
     * Store a newly created resource in Collection catalog.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            '*.title'       => 'required',
            '*.sap_code'    => 'required',
            '*.category'    => 'required',
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
                    'categories'  => $product['category'],
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
