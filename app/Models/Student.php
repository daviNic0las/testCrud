<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;
    protected $state = 'students';
    protected $fillable = [
        'name',
        'date_of_birth',
        'category_id',
        'class',
        'student_id',
        'school', 
        'image',
    ];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id'); 
    }
}
