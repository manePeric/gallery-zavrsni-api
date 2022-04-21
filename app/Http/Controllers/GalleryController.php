<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Http\Requests\CreateGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->query("title", "");
        $per_page = $request->query("per_page", 10);

        $galleries = Gallery::scopeSearchByTitle($title);

        return response()->json($galleries);
    }

    public function show(Gallery $gallery)
    {
        return response()->json($gallery);
    }

    public function store(CreateGalleryRequest $request)
    {
        $data = $request->validated();
        $gallery = Gallery::create($data);

        return response()->json($gallery, 201);
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();
        $gallery->update($data);

        return response()->json($gallery);
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return response()->json($gallery);
    }
}