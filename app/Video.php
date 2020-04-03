<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @method static firstOrCreate(array $array, array $array1)
 * @method static find(int $id)
 * @method static updateOrCreate(array $array, array $array1)
 */
class Video extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'url', 'thumbnail', 'description', 'published_at', 'channel_id', 'category_id', 'subcategory_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'channel_id', 'category_id', 'subcategory_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* RELATIONSHIP */
    public function users()
    {
        return $this->belongsToMany('App\Users', 'later_video', 'video_id', 'user_id');
    }

    public function playlist()
    {
        return $this->belongsToMany('App\Playlist', 'playlist_video', 'video_id', 'playlist_id');
    }

    /**
     * Get the channel that owns the video.
     */
    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }

    /**
     * Get the category that owns the video.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Get the subcategory that owns the video.
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }

    /**
     * The labels that belongs to video.
     */
    public function labels()
    {
        return $this->belongsToMany('App\Label', 'video_labels');
    }

    /**
     * The views that belongs to video.
     */
    public function views()
    {
        return $this->belongsToMany('App\User', 'video_views', 'video_id', 'user_id');
    }
}
