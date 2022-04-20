<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->query("title", "");
        $per_page = $request->query("per_page", 10);

        $galleries = Gallery::searchByTitle($title)->paginate($per_page);

        return response()->json($galleries);
    }
}