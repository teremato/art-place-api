<?php

namespace App\Http\Controllers\Traits\LotTraits;

use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;

trait CreateLot {

    public function validateForm(Request $request): array 
    {
        return $request->validate([
            'title' => ['required', 'min:5', 'string'],
            'description' => ['nullable', 'max:300', 'string'],
            'categories' => ['string', 'required',],
            'price' => ['required'],
            'media' => ['required', 'array', 'min:1', 'max:3'],
        ]);
    }

    public function createLot(array $form, User $user): Lot 
    {
        return Lot::create([
            'user_id' => $user->id,
            'title' => $form['title'],
            'description' => $form['description'],
            'categories' => $form['categories'],
            'price' => $this->convertPriceToInt($form['price'])
        ]);
    }
    
    public function updateLot(array $form, Lot $lot)
    {
        $lot->update($form);
        $lot->save();
    }

    public function getLotForId($id): Lot 
    {
        return Lot::where('id', $id)->first();
    }

    private function convertPriceToInt($price): int 
    {
        return intval($price);
    }
}