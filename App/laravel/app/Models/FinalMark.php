<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FinalMark extends Model
{
    use HasFactory, SoftDeletes;
<<<<<<< HEAD
    protected $fillable = ['mid_term_marks', 'marks', 'student_id', 'subject_id'];
=======
    protected $fillable = ['marks', 'student_id', 'subject_id'];
>>>>>>> df3f393260d273b15f526a8272aaf8044f8c05bd
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
