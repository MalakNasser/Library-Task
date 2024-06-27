<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'book_id', 'status_id'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function borrows()
    {
        return $this->hasMany(Borrows::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
