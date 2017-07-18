<?php

namespace App\Http\Controllers;

use App\Countdown;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CountdownController extends Controller
{
    public function store(Request $request)
    {
        $userId = $request->user()->id;
        $countdown = Countdown::create([
            'name' => $request->input('name'),
            'user_id' => $userId,
            'date' => Carbon::createFromFormat('m/d/Y', $request->input('date'))
        ]);

        return JsonResponse::create($countdown);
    }

    public function update(Request $request)
    {
        $countdown = Countdown::findOrFail($request->input('id'));
        $countdown->name = $request->input('name');
        $countdown->date = Carbon::createFromFormat('m/d/Y', $request->input('date'));
        $countdown->save();

        return JsonResponse::create($countdown);
    }

    public function show($id)
    {
        return Countdown::with('images')->findOrFail($id);
    }

    public function index()
    {
        return Countdown::with('images')->where('user_id', auth()->user()->id)->get();
    }
}
