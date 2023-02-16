<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\Traits\LotTraits\CreateLot;
use App\Http\Resources\LotResourse;
use App\Models\Lot;

class LotController extends Controller
{

    use CreateLot;

    public function index()
    {
        $lots = Lot::with('user')->get();

        return LotResourse::collection($lots);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $form = $this->validateForm($request);

        $lot = $this->createLot($form, $user);

        return response()->json([
            'id' => $lot->id
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $lot = Lot::with('user')
            ->where('id', $id)
            ->first();

        return response(LotResourse::make($lot), Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {   
        $form = $this->validateForm($request);

        $lot = $this->getLotForId($id);
        $lot = $this->updateLot($form, $lot);

        return Response::HTTP_OK;
    }

    public function destroy($id)
    {
        $lot = $this->getLotForId($id);

        $lot->clearMediaCollection('pictures');
        $lot->clearMediaCollection('preview');
        $lot->delete();

        return Response::HTTP_OK;
    }
}
