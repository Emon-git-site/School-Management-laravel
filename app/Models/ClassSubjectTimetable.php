<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectTimetable extends Model
{
    use HasFactory;
    
    protected $table = 'class_subject_timetable';

    static public function getRecordClassSubject($class_id, $subject_id, $week_id)
    {
        return self::where('classe_id', $class_id)->where('subject_id', $subject_id)->where('week_id', $week_id)->first();
    }

    static public function subjectTimetable($subject_id, $class_id)
    {
        return self::select('class_subject_timetable.*')
                 ->join('week', 'week.id', 'class_subject_timetable.week_id')
                  ->where('class_subject_timetable.classe_id', $class_id)
                  ->where('class_subject_timetable.subject_id', $subject_id)
                  ->where('week.name', date("l"))
                  ->get();
    }
}
