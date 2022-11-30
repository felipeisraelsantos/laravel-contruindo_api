<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    public $timestamps = false;
    // protected $casts = ['watched' => 'boolean'];
    protected $fillabe = ['number'];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
