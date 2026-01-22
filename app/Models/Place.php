<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'repair',
        'work',
        'user_id'
    ];

    protected $casts = [
        'repair' => 'boolean',
        'work'   => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function uses(): HasMany
    {
        return $this->hasMany(Using::class);
    }

    public function things()
    {
        return $this->belongsToMany(Thing::class, 'usings', 'place_id', 'thing_id')
            ->withPivot('amount', 'user_id')
            ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('work', true)->where('repair', false);
    }
}