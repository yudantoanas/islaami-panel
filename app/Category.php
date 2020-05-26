<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @method static orderBy(string $string)
 * @method static find(int $id)
 * @method static firstOrCreate(array $array, array $array1)
 * @method static updateOrCreate(array $array, array $array1)
 * @method static where(string $string, $number)
 * @method static max(string $string)
 */
class Category extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function subcategories()
    {
        return $this->hasMany('App\Subcategory');
    }

    public function scopeSearch($query, $searchQuery)
    {
        if ($searchQuery == null) return $query;
        return $query->where('name', 'LIKE', "%{$searchQuery}%");
    }
}
