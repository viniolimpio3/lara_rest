<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //mass-assignment -> maneira de proteger as inserções no banco, de uma requisição com o fillable
    protected $fillable = [
        'name',
        'price',
        'description'
    ];
}
