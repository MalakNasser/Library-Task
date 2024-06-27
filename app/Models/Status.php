<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'status'];

    public function borrows()
    {
        return $this->hasMany(Borrows::class);
    }

    public function copies()
    {
        return $this->hasMany(Copy::class);
    }
}
