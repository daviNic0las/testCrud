<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $state = 'employee';
    protected $fillable = [
        'nomeF',
        'setor',
        'salario',
    ];
}
