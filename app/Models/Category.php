<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $state = 'category';
    protected $fillable = [
        'nome',
    ];
    public function products(): Hasmany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
