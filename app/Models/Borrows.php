<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrows extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'student_id', 'copy_id', 'borrow_date', 'expected_return_date', 'return_date', 'status_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function copy()
    {
        return $this->belongsTo(Copy::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
