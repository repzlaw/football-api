<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'season',
        'league',
    ];

    public function fixtures()
    {
        return $this->hasMany(Fixture::class);
    }
}
