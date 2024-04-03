<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  Class_subject extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'classe_id',
        'subject_id',
        'created_by',
        'status',
    ];

    static public function getClassSubject()
    {
        $return = self::select('class_subjects.*', 'classes.name as class_name', 'subjects.name as subject_name', 'users.name as created_by_name')
            ->join('classes', 'classes.id', 'class_subjects.classe_id')
            ->join('subjects', 'subjects.id', 'class_subjects.subject_id')
            ->join('users', 'users.id', 'class_subjects.created_by');
        if (!empty(request('subject_name'))) {
            $subject_name = request('subject_name');
            $return = $return->where('subjects.name', 'like', '%' . $subject_name . '%');
        }
        if (!empty(request('class_name'))) {
            $class_name = request('class_name');
            $return = $return->where('classes.name', 'like', '%' . $class_name . '%');
        }
        $return = $return->orderBy('class_subjects.id', 'desc')
            ->where('class_subjects.is_delete', 0)
            ->where('subjects.is_delete', 0)
            ->where('classes.is_delete', 0)
            ->where('subjects.status', 0)
            ->where('classes.status', 0)
            ->paginate(20);

        return $return;
    }
    static public function getSpecificClassSubject($class_subject)
    {
        $subject = self::where('classe_id', $class_subject->classe_id)->get();
        return $subject;
    }

    static public function getAlreadyFirst($class_id, $subject_id)
    {
        return self::where('classe_id', $class_id)->where('subject_id', $subject_id)->first();
    }

    static public function getAssignClassID($class_id)
    {
        return self::where('classe_id', $class_id)
            ->where('is_delete', 0)->first();
    }

    static public function deleteSubject($class_id)
    {
        return self::where('classe_id', $class_id)->delete();
    }

    static public function mySubjectName($class_id)
    {
        return  self::select('class_subjects.*', 'subjects.name as subject_name', 'subjects.type as subject_type', 'classes.name as class_name')
            ->join('classes', 'classes.id', 'class_subjects.classe_id')
            ->join('subjects', 'subjects.id', 'class_subjects.subject_id')
            ->join('users', 'users.id', 'class_subjects.created_by')
            ->where('class_subjects.classe_id', $class_id)
            ->where('class_subjects.is_delete', 0)
            ->where('class_subjects.status', 0)
            ->orderBy('class_subjects.id', 'desc')
            ->get();
    }
}
