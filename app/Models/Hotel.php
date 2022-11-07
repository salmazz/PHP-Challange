<?php

namespace App\Models;

use App\Filters\HotelFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'description', 'city_id', 'rating'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Room::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeFilter(Builder $builder, $request)
    {
        return (new HotelFilter($request))->filter($builder);
    }
}
