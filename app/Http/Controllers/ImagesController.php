<?php

namespace App\Http\Controllers;

use App\Countdown;
use App\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function store(Request $request) {
        $userId = auth()->user()->id;
        $countdownId = $request->input('countdown_id');
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $uploadedImage =  $image->storeAs("images/$userId/$countdownId", $imageName, 'public');

        $image = Image::create([
            'countdown_id'  => $countdownId,
            'user_id'       => $userId,
            'path'          => $uploadedImage,
            'name'          => $imageName
        ]);

        return Countdown::findOrFail($countdownId)->images;
    }

    public function show(Request $request, $countdownId) {
        $countdown = Countdown::findOrFail($countdownId);

        return $countdown->images;
    }

    public function destroy($id) {
        if (Image::findOrFail($id)->delete()) {
            return JsonResponse::create([]);
        }
    }
}
