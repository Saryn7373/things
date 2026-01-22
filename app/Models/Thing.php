<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'wrnt',
        'user_id'
    ];

    protected $casts = [
        'wrnt' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function uses()
    {
        return $this->hasMany(Using::class);
    }

    // Связь многие-ко-многим через таблицу uses
    public function places()
    {
        return $this->belongsToMany(Place::class, 'usings', 'thing_id', 'place_id')
            ->withPivot('amount', 'user_id')
            ->withTimestamps();
    }

    public function currentUse()
    {
        return $this->uses()->latest()->first();
    }

    // Получить текущее место хранения
    public function currentPlace()
    {
        $currentUse = $this->currentUse();
        return $currentUse ? $currentUse->place : null;
    }
}
