<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Art extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia;

    /** meta | const */
    const TYPE_PHOTO = 'photo';
    const TYPE_ILLUSTRATION = 'illustration';
    const TYPE_GAME = 'game';

    /** media */
    public function registerMediaCollections(): void {

        $this->addMediaCollection('mini')
            ->registerMediaConversions(function(Media $media) {
                $this->addMediaConversion('mini')
                    ->width(320)->height(160);
            });
    }

    /** model relationships */
    public function author() {
        return $this->belongsTo(User::class);
    }

    public function likeableUsers() {
        return $this->MorphTo(Like::class, 'likeableUser');
    }

    /** actions */
    /** getter */
    /** checked */
}
