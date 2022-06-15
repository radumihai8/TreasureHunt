<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $timestamps = False;
    public $guarded = [];
    protected $casts = [
        'date' => 'datetime',
    ];

    public function players()
    {
        return $this->belongsToMany(User::class, 'user_room');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }
}
