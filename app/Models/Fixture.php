<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'home_club_id',
        'away_club_id',
        'venue_id',
        'home_club_score',
        'away_club_score',
        'kick_off',
        'round_id'
    ];

    public function round()
    {
        return $this->belongsTo(Round::class);
    }
}
