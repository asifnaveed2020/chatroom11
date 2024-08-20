<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $images = Item::first();
        return view('images.index', compact('images'));
    }

    public function save(Request $request)
    {
        echo "<pre>";
        print_r( $request->input('existing_images', []));
        // $imagePaths= $this->cleanAndReindexArray( $request->input('existing_images', []));
        // print_r($imagePaths);
        // print_r($request->file('images'));







        // exit;
        // $request->validate([
        //     'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        // ]);

        $imagePaths = $request->input('existing_images', []);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                if ($image) {
                    $path = $image->store('public/images');
                    $imagePaths[$index] = $path;
                }
            }
        }
        $imagePaths = $this->cleanAndReindexArray($imagePaths);
        print_r($imagePaths);        

        $images = Item::first() ?: new Item();
        $images->images = json_encode($imagePaths);
        $images->save();
        exit;

        return redirect()->back()->with('success', 'Images saved successfully!');
    }
    function cleanAndReindexArray($array)
    {
        // Remove empty values from the array
        $array = array_filter($array, function ($value) {
            return !empty($value);
        });

        // Reindex the array
        $array = array_values($array);

        return $array;
    }

    public function delete(Request $request, $index)
    {
        $images = Item::first();
        if ($images) {
            $imagePaths = json_decode($images->images, true);
            if (isset($imagePaths[$index])) {
                Storage::delete($imagePaths[$index]);
                unset($imagePaths[$index]);
                $images->images = json_encode($imagePaths);
                $images->save();
            }
        }

        return redirect()->back()->with('success', 'Image deleted successfully!');
    }
}
