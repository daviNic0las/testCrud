<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sector extends Model
{
    use HasFactory;
    protected $state = 'sectors';
    protected $fillable = [
        'nome',
    ];
    public function employees(): Hasmany
    {
        return $this->hasMany(Sector::class, 'sector_id');
    }
}
