<?php

namespace App\Http\Controllers;

use Statamic\Facades\Term;

class TaxonomyTermController extends Controller
{
    public function create($taxonomy, $term)
    {
        $terms = Term::whereTaxonomy($taxonomy);
        $term = $terms->firstWhere('slug', $term);
        
        if ($term) {
            $title = $term->value('title');
            return view('taxonomies.taxonomy-term', compact('term', 'title'));
        } else {
            return view('errors.404');
        }
    }
}
