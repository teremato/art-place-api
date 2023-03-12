<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, 
        HasFactory, 
        Notifiable,
        InteractsWithMedia;

    /** meta | const */

    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';
    const ROLE_AUTHOR = 'author';

    protected $fillable = [ 'name', 'email', 'password' ];
    protected $hidden = [ 'password', 'remember_token', ];
    protected $casts = [ 'email_verified_at' => 'datetime', ];

    /** media */
    public function registerMediaCollections(): void {
        
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->registerMediaConversions(function(Media $media) {
                $this->addMediaConversion('mini')
                    ->width(150)->height(150);
            });
    }

    public function getAvatar(): Media {
        return $this->getFirstMedia('avatar'); 
    }

    /** model relationships */
    public function likeableArts() {
        return $this->morphTo(Like::class, 'likeableModel');
    }

    public function arts() {
        return $this->hasMany(Art::class, 'author_id');
    }

    /** checked */

    /** getters */
    public function getWatchCount(Collection $arts) {
        return $arts->sum('watch_count');
    }   

    public function getLikesCount(Collection $arts) {

        $commonLikes = 0;

        $arts->each(function($item) use($commonLikes) {
            $commonLikes += $item->likeableUsers()->count();
        });

        return $commonLikes;
    }
}
