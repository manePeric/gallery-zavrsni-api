<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $term = $request->query("term", "");
        $userId = $request->query("user_id", "");
        $galleries = Gallery::searchByTerm($term, $userId)
            ->latest()
            ->paginate(10);

        return response()->json($galleries);
    }
}