<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FinalMark extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['midterm_mark_id', 'marks', 'student_id', 'subject_id'];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function midtermMark()
    {
        return $this->belongsTo(MidtermMark::class);
    }
}
