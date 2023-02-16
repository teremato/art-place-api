<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Lot extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia;

    protected $fillable = [
        'user_id', 'title',
        'description', 'price',
        'categories'
    ];

    public function getAllMedia($collection = 'pictures') {

        $media = $this->getMedia($collection);
        $photos = [];

        foreach($media as $mediaItem) {
            $photos[] = [
                'default' =>$mediaItem->getFullUrl(),
                'mini' => $mediaItem->getFullUrl('thumb')
            ];
        }
        return $photos;
    }

    public function registerMediaCollections(): void {

        $this->addMediaCollection('preview')
            ->singleFile()
            ->registerMediaConversions(function(Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(200)
                    ->height(200);
            });

        $this->addMediaCollection('pictures')
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(200)
                    ->height(200);
            });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
