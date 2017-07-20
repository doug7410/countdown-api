<?php

namespace App\Http\Controllers;

use App\Countdown;
use App\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function store(Request $request) {
        $userId = auth()->user()->id;
        $countdownId = $request->input('countdown_id');
        $file = $request->file('image');
        $imageName = $file->getClientOriginalName();
        $uploadedImage = Storage::disk('s3')->put("images/$userId/$countdownId", $file, 'public');

        return Image::create([
            'countdown_id'  => $countdownId,
            'user_id'       => $userId,
            'path'          => "https://s3.amazonaws.com/staging.countdown.images/$uploadedImage",
            'name'          => $imageName
        ]);
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
