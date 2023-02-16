<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MediaController extends Controller
{
    public function mediaLot(Request $request, $id) {

        $lot = Lot::where('id', $id)->first();

        foreach($request->file('media') as $media) {
            $lot->addMedia($media)->toMediaCollection('pictures');
        }

        return response($lot, Response::HTTP_OK);
    }
}
