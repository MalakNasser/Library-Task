<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name'];

    public function copies()
    {
        return $this->hasMany(Copy::class);
    }
}
