<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'email', 'phone'];

    public function borrows()
    {
        return $this->hasMany(Borrows::class);
    }
}
