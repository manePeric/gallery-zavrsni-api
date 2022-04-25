<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\CreateGalleryRequest;
use App\Http\Requests\EditGalleryRequest;
use Illuminate\Support\Facades\Auth;

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

    public function store(CreateGalleryRequest $request)
    {
        $data = $request->validated();
        $gallery = Gallery::create([
            "user_id" => Auth::user()->id,
            "title" => $data["title"],
            "description" => $data["description"],
        ]);

        $imagesArray = [];
        foreach ($data["images"] as $images) {
            $imagesArray[] = Image::create([
                "gallery_id" => $gallery->id,
                "url" => $images["url"],
            ]);
        }

        $gallery->load("images", "user", "comments", "comments.user");
        return response()->json($gallery, 201);
    }

    public function show($id)
    {
        $gallery = Gallery::with([
            "images",
            "user",
            "comments",
            "comments.user",
        ])->find($id);
        return response()->json($gallery);
    }

    public function update($id, EditGalleryRequest $request)
    {
        $data = $request->validated();
        $gallery = Gallery::findOrFail($id);
        $gallery->update($data);
        $gallery->images()->delete();

        $imagesArray = [];

        foreach ($request["images"] as $image) {
            $imagesArray[] = Image::create([
                "gallery_id" => $gallery->id,
                "url" => $image["url"],
            ]);
        }
        $gallery->load("images", "user", "comments", "comments.user");
        return response()->json($gallery);
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return response()->noContent();
    }
}